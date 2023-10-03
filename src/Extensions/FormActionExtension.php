<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;

class FormActionExtension extends Extension
{
    public $useStartButton = false;

    public function setUseStartButton($bool)
    {
        $this->owner->setUseButtonTag(true);

        $this->useStartButton = $bool;

        return $this;
    }

    public function getUseStartButton()
    {
        return $this->useStartButton;
    }
}
