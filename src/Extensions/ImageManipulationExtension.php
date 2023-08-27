<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\Core\Extension;

class ImageManipulationExtension extends Extension
{
    public function updateAttributes(&$attributes)
    {
        if ($this->owner->getIsImage()) {
            unset($attributes['width']);
            unset($attributes['height']);
        }
    }

    public function Crop(int $width, int $height)
    {
        if ($this->owner->getIsImage()) {
            if ($this->owner->hasMethod('FocusFill')) {
                return $this->owner->FocusFill($width, $height);
            }

            return $this->owner->Fill($width, $height);
        }

        return $this->owner;
    }
}
