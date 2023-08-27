<?php

namespace Rasstislav\IdSk\Forms;

use SilverStripe\Forms\TextareaField as VendorTextareaField;

class TextareaField extends VendorTextareaField
{
    public function validate($validator)
    {
        if (!is_null($this->maxLength) && mb_strlen($this->value ?? '') > $this->maxLength) {
            $name = strip_tags($this->Title() ? $this->Title() : $this->getName());
            $validator->validationError(
                $this->name,
                _t(
                    'SilverStripe\\Forms\\TextField.VALIDATEMAXLENGTH',
                    'The value for {name} must not exceed {maxLength} characters in length',
                    ['name' => $name, 'maxLength' => $this->maxLength]
                ),
                "validation"
            );
            return false;
        }
        return true;
    }
}
