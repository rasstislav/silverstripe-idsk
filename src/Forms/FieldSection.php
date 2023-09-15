<?php

namespace Rasstislav\IdSk\Forms;

use SilverStripe\Forms\FieldGroup;

class FieldSection extends FieldGroup
{
    protected $expanded = false;

    public function setIsExpanded($bool)
    {
        $this->expanded = (bool)$bool;
        return $this;
    }

    public function isExpanded()
    {
        return $this->expanded;
    }
}
