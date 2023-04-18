<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class SiteTreeExtension extends DataExtension
{
    private static $db = [
        'ShowInFooter' => 'Boolean',
    ];

    private static $field_labels = [
        'ShowInFooter' => 'Zobraziť v pätičke?',
    ];

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->insertAfter('ShowInMenus', new CheckboxField('ShowInFooter', $this->owner->fieldLabel('ShowInFooter')));
    }
}
