<?php

namespace Rasstislav\IdSk\Extensions;

use Rasstislav\IdSk\Pages\SearchResultsPage;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataObject;

class SearchFormExtension extends Extension
{
    public function onBeforeRender($context)
    {
        if ($searchResultsPage = DataObject::get_one(SearchResultsPage::class)) {
            $context->setFormAction($searchResultsPage->Link());
        }
    }
}
