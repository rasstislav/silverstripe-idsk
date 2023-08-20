<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;

class FormExtension extends Extension
{
    public function isValid()
    {
        return ($valid = $this->owner->getSessionValidationResult()?->isValid()) === null ? true : $valid;
    }
}
