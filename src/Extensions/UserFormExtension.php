<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;

class UserFormExtension extends Extension
{
    public function updateFormActions($actions)
    {
        if ($this->owner->controller->StartButton) {
            $actions->dataFieldByName('action_process')->setUseStartButton(true);
        }
    }
}
