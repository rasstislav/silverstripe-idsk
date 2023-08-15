<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Versioned\Versioned;

class VersionedExtension extends DataExtension
{
    public function isFirstPublishedVersion()
    {
        return $this->owner->hasExtension(Versioned::class)
            && $this->owner->Versions('"WasPublished" = 1')->count() === 1;
    }

    public function PublishedUpdated()
    {
        return $this->isFirstPublishedVersion() ? 'Vypublikované' : 'Aktualizované';
    }
}
