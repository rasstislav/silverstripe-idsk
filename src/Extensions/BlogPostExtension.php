<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\ArrayData;

class BlogPostExtension extends DataExtension
{
    private static $db = [
        'ShowFeaturedImage' => 'Boolean(1)',
        'InPageNavigationListItems' => 'Text',
    ];

    private static $field_labels = [
        'ShowFeaturedImage' => 'Zobraziť hlavný obrázok v príspevku',
    ];

    public function onBeforeWrite()
    {
        $result = [];

        if ($this->owner->Content) {
            preg_match_all('/<a\s+id="([^"]+)"><\/a>(.*?)<\/h[1-6]>/', $this->owner->Content, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                if ($heading = strip_tags($match[2])) {
                    $result[$match[1]] = $this->mb_ucfirst($heading);
                }
            }
        }

        $this->owner->InPageNavigationListItems = $result ? json_encode($result) : null;
    }

    public function updateCMSFields(FieldList $fields)
    {
        $fields->insertAfter(
            'FeaturedImage',
            new CheckboxField('ShowFeaturedImage', $this->owner->fieldLabel('ShowFeaturedImage')),
        );
    }

    public function getInPageNavigationListItemsData()
    {
        $items = new ArrayList();

        if ($this->owner->InPageNavigationListItems) {
            foreach (json_decode($this->owner->InPageNavigationListItems, true) as $anchor => $title) {
                $items->push(
                    new ArrayData([
                        'Anchor' => $anchor,
                        'Title' => $title,
                    ])
                );
            }
        }

        return $items;
    }

    private function mb_ucfirst($string)
    {
        return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1, null);
    }
}
