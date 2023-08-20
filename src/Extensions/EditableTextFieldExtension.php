<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\TextareaField;

class EditableTextFieldExtension extends Extension
{
    public function afterUpdateFormField($field)
    {
        if ($field instanceof TextareaField) {
            if ($maxlength = $field->getAttribute('data-rule-maxlength')) {
                $field->setMaxLength($maxlength);
            }
        }
    }
}
