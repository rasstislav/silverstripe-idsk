<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\DataExtension;

class UserDefinedFormExtension extends DataExtension
{
    private static $db = [
        'ShowCounterOnFieldGroups' => 'Boolean',
        'StartButton' => 'Boolean',
    ];

    private static $field_labels = [
        'ShowCounterOnFieldGroups' => 'Zobraziť očíslovanie obaľovacích skupín',
        'StartButton' => 'Spúšťacie tlačidlo odoslania (so šípkou)',
    ];

    public function updateFormOptions(&$options)
    {
        $options->removeByName('EnableLiveValidation');

        $options->insertBefore('ShowClearButton', CheckboxField::create(
            'ShowCounterOnFieldGroups',
            $this->owner->fieldLabel('ShowCounterOnFieldGroups'),
            $this->owner->ShowCounterOnFieldGroups,
        ));

        $options->insertBefore('ShowClearButton', CheckboxField::create(
            'StartButton',
            $this->owner->fieldLabel('StartButton'),
            $this->owner->StartButton,
        ));
    }
}
