<?php

namespace Rasstislav\IdSk\Models;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;

class Feedback extends DataObject
{
    private static $table_name = 'Feedback';

    private static $singular_name = 'Spätná väzba';
    private static $plural_name = 'Spätná väzba';

    private static $db = [
        'Type' => 'Enum("PageUsefulness, PageIssue", null)',
        'Output' => 'Varchar(25)',
        'Url' => 'Varchar(2083)',
    ];

    private static $has_one = [
        'Page' => SiteTree::class,
    ];

    private static $summary_fields = [
        'Type',
        'Output',
        'Page.Title',
        'Created.Nice',
    ];

    private static $searchable_fields = [
        'Type',
        'Output',
        'PageID',
    ];

    private static $field_labels = [
        'Type' => 'Typ',
        'Output' => 'Výstup',
        'Page' => 'Stránka',
        'Page.Title' => 'Stránka',
        'Created.Nice' => 'Podaná',
        'PageID' => 'Stránka',
    ];

    private static $default_sort = '"Feedback"."ID" DESC';

    public function getTitle()
    {
        return "$this->Type: $this->Output";
    }

    public function canEdit($member = null)
    {
        return false;
    }

    public function canDelete($member = null)
    {
        return false;
    }

    public function canCreate($member = null, $context = [])
    {
        return false;
    }
}
