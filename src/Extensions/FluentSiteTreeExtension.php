<?php

namespace Rasstislav\IdSk\Extensions;

use Rasstislav\IdSk\Pages\SearchResultsPage;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\FieldType\DBIndexable;
use TractorCow\Fluent\Extension\FluentSiteTreeExtension as CoreFluentSiteTreeExtension;

class FluentSiteTreeExtension extends CoreFluentSiteTreeExtension
{
    protected function augmentDatabaseRequireTable($localisedTable, $fields, $indexes)
    {
        $owner = $this->owner;

        if (get_class($owner) === $owner->baseClass()) {
            $indexes['SearchFields'] = [
                'type' => DBIndexable::TYPE_FULLTEXT,
                'columns' => [
                    'Title',
                    'MenuTitle',
                    'Content',
                    'MetaDescription',
                ],
            ];
        }

        parent::augmentDatabaseRequireTable($localisedTable, $fields, $indexes);
    }

    public function updatelocaliseCondition(&$query, $table, $field, $locale)
    {
        if (
            ($controller = Controller::curr()) instanceof ContentController
            && $controller->data() instanceof SearchResultsPage
            && in_array($field, ['Title', 'MenuTitle', 'Content', 'MetaDescription'], true)
        ) {
            $joinAlias = $this->owner->getLocalisedTable($table, $locale->Locale);
            $query = "\"{$joinAlias}\".\"{$field}\"";
        }
    }
}
