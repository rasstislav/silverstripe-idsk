<?php

use Rasstislav\IdSk\TinyMCEConfig;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\Search\FulltextSearchable;
use SilverStripe\View\Requirements;

Requirements::set_force_js_to_bottom(true);

$editorConfig = TinyMCEConfig::get('cms')
    ->enablePlugins([
        'advlist' => null,
        'charmap' => null,
        'codesample' => null,
        'fullscreen' => null,
        'help' => null,
        'hr' => null,
        'insertdatetime' => null,
        'nonbreaking' => null,
        'preview' => null,
        'print' => null,
        'searchreplace' => null,
        'toc' => null,
        'visualblocks' => null,
        'visualchars' => null,
        'wordcount' => null,
    ])
    ->setOption('insertdatetime_formats', ['%d. %m. %Y', '%H:%M:%S'])
    ->setOption('paste_as_text', true)
;

$editorConfig->insertButtonsAfter('table', '|');

$formats = $editorConfig->getOption('formats');
$formats['underline'] = ['inline' => 'u', 'exact' => true];
$formats['strikethrough'] = ['inline' => 's'];

$editorConfig->setOption('formats', $formats);

$editorConfig->setOption('valid_elements',
    $editorConfig->getOption('valid_elements')
    . ',-s[class]',
);

$editorConfig
    // Content Formatting (https://www.tiny.cloud/docs-4x/configure/content-formatting/#block_formats)
    ->setOption('block_formats', 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4')
    ->addInvalidElements('h1', 'h5', 'h6')
    ->addInvalidElements('strike')
    ->addInvalidElements('blockquote', 'cite')
    ->addInvalidElements('pre', 'address')
    ->addInvalidElements('map', 'area')
;

/* Fulltext search */
FulltextSearchable::enable([SiteTree::class]);
