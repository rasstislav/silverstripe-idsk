<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;

class RemoveImageDimensionsExtension extends Extension
{
    public function updateAttributes(&$attributes)
    {
        if ($this->owner->getIsImage()) {
            unset($attributes['width']);
            unset($attributes['height']);
        }
    }
}
