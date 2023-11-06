<?php

namespace Rasstislav\IdSk\Extensions;

use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class SiteTreeExtension extends DataExtension
{
    private static $db = [
        'ShowInFooter' => 'Boolean',
    ];

    private static $has_one = [
        'BackLink' => Link::class,
    ];

    private static $cascade_duplicates = [
        'BackLink',
    ];

    private static $field_labels = [
        'ShowInFooter' => 'Zobraziť v pätičke?',
        'BackLink' => 'Tlačidlo späť',
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->insertAfter('ShowInMenus', CheckboxField::create('ShowInFooter', $this->owner->fieldLabel('ShowInFooter')));

        if (class_exists(LinkField::class)) {
            $fields->insertAfter('Visibility',
                LinkField::create(
                    'BackLink',
                    $this->owner->fieldLabel('BackLink'),
                    $this->owner,
                    [
                        'types' => [
                            'SiteTree',
                            'URL',
                        ],
                    ],
                )
            );
        }
    }
}
