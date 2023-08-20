<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Convert;
use SilverStripe\Core\Extension;

class CheckboxSetFieldExtension extends Extension
{
    public function getReferenceID()
    {
        return $this->owner->ID() . '_' . Convert::raw2htmlid(array_key_first($this->owner->getSource()));
    }
}
