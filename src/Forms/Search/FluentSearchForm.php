<?php

namespace Rasstislav\IdSk\Forms\Search;

use Fromholdio\FulltextFilters\ORM\Filters\FulltextBooleanFilter;
use SilverStripe\ORM\DB;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\CMS\Search\SearchForm;
use SilverStripe\ORM\PaginatedList;

class FluentSearchForm extends SearchForm
{
    public function getResults()
    {
        $request = $this->getRequestHandler()->getRequest();

        $keywords = $request->requestVar('Search');

        $andProcessor = fn($matches) => ' +' . $matches[2] . ' +' . $matches[4] . ' ';
        $notProcessor = fn($matches) => ' -' . $matches[3];

        $keywords = preg_replace_callback('/()("[^()"]+")( and )("[^"()]+")()/i', $andProcessor, $keywords ?? '');
        $keywords = preg_replace_callback('/(^| )([^() ]+)( and )([^ ()]+)( |$)/i', $andProcessor, $keywords ?? '');
        $keywords = preg_replace_callback('/(^| )(not )("[^"()]+")/i', $notProcessor, $keywords ?? '');
        $keywords = preg_replace_callback('/(^| )(not )([^() ]+)( |$)/i', $notProcessor, $keywords ?? '');

        $keywords = $this->addStarsToKeywords($keywords);

        $booleanSearch =
            strpos($keywords ?? '', '"') !== false ||
            strpos($keywords ?? '', '+') !== false ||
            strpos($keywords ?? '', '-') !== false ||
            strpos($keywords ?? '', '*') !== false;

        $keywords = DB::get_conn()->escapeString($keywords);

        $filter = class_exists(FulltextBooleanFilter::class) && $booleanSearch ? 'FulltextBoolean' : 'Fulltext';

        $results = SiteTree::get()->filter([
            "SearchFields:$filter" => $keywords,
            'ShowInSearch' => 1,
        ]);

        if ($results) {
            foreach ($results as $result) {
                if (!$result->canView()) {
                    $results->remove($result);
                }
            }
        }

        return PaginatedList::create(
            $results,
            $this->getRequest(),
        );
    }
}
