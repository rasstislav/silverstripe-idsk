<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class BlogExtension extends DataExtension
{
    private static $db = [
        'PostsSubtitle' => 'Varchar(255)',
    ];

    private static $field_labels = [
        'PostsSubtitle' => 'Podnadpis príspevkov',
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Settings',
            new TextField('PostsSubtitle', $this->owner->fieldLabel('PostsSubtitle')),
        );
    }
}
