<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Versioned\Versioned;
use TractorCow\Fluent\State\FluentState;

class VersionedExtension extends DataExtension
{
    public function isFirstPublishedVersion()
    {
        if ($this->owner->hasExtension(Versioned::class)) {
            $callback = fn() => $this->owner->Versions('"WasPublished" = 1')->count() === 1;

            if (class_exists(FluentState::class)) {
                return FluentState::singleton()->withState(function (FluentState $state) use ($callback): bool {
                    $state->setLocale(null);

                    return $callback();
                });
            } else {
                return $callback();
            }
        }

        return false;
    }

    public function PublishedUpdated()
    {
        return $this->isFirstPublishedVersion() ? 'Vypublikované' : 'Aktualizované';
    }
}
