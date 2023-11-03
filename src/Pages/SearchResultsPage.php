<?php

namespace Rasstislav\IdSk\Pages;

use Page;

class SearchResultsPage extends Page
{
    private static $table_name = 'SearchResultsPage';

    private static $singular_name = 'Stránka výsledkov vyhľadávania';
    private static $plural_name = 'Stránka výsledkov vyhľadávania';
    private static $description = 'Zobrazuje výsledky fulltext vyhľadávania na stránke';
    private static $icon_class = 'fi font-icon-search';
}
