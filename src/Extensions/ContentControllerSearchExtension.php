<?php

namespace Rasstislav\IdSk\Extensions;

use Rasstislav\IdSk\Pages\SearchResultsPage;
use SilverStripe\CMS\Search\ContentControllerSearchExtension as CoreContentControllerSearchExtension;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataObject;

class ContentControllerSearchExtension extends CoreContentControllerSearchExtension
{
    public function results($data, $form, $request)
    {
        if ($searchResultsPage = DataObject::get_one(SearchResultsPage::class)) {
            return $this->owner->redirect(Controller::join_links(
                $searchResultsPage->Link(),
                ($searchQuery = $form->getSearchQuery()) ? '?Search=' . urlencode($searchQuery) : null,
            ));
        }

        return parent::results($data, $form, $request);
    }
}
