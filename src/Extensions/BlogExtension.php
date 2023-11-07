<?php

namespace Rasstislav\IdSk\Extensions;

use gorriecoe\Link\Models\Link;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class BlogExtension extends DataExtension
{
    private static $db = [
        'ShowBackLinkInPosts' => 'Boolean',
        'PostsSubtitle' => 'Varchar(255)',
    ];

    private static $field_labels = [
        'ShowBackLinkInPosts' => 'Zobraziť tlačidlo späť v príspevkoch',
        'PostsSubtitle' => 'Podnadpis príspevkov',
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root.Settings', LiteralField::create(
            'PostsSettings',
            '<h2>Nastavenia príspevkov</h2>',
        ));

        $fields->addFieldToTab(
            'Root.Settings',
            CheckboxField::create('ShowBackLinkInPosts', $this->owner->fieldLabel('ShowBackLinkInPosts')),
        );

        $fields->addFieldToTab(
            'Root.Settings',
            TextField::create('PostsSubtitle', $this->owner->fieldLabel('PostsSubtitle')),
        );
    }

    public function PostBackLink()
    {
        return Link::create([
            'ID' => -1,
            'Title' => $this->owner->Title,
            'Type' => 'SiteTree',
            'SiteTreeID' => $this->owner->ID,
        ]);
    }
}
