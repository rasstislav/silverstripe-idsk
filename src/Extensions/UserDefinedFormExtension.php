<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;

class UserDefinedFormExtension extends Extension
{
    public function updateFormOptions(&$options)
    {
        $options->removeByName('EnableLiveValidation');
    }
}
