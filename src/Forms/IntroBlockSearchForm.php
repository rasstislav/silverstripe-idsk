<?php

namespace Rasstislav\IdSk\Forms;

use SilverStripe\Control\Controller;
use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;
use Translatable;

class IntroBlockSearchForm extends Form
{
    public function __construct(
        RequestHandler $controller = null,
        $name = 'IntroBlockSearchForm',
        FieldList $fields = null,
        FieldList $actions = null
    ) {
        if (!$fields) {
            $fields = FieldList::create(
                TextField::create('Search', _t(__CLASS__.'.SEARCH', 'Search'))
                    ->setInputType('search'),
            );
        }

        if (class_exists('Translatable')
            && SiteTree::singleton()->hasExtension('Translatable')
        ) {
            $fields->push(HiddenField::create('searchlocale', 'searchlocale', Translatable::get_current_locale()));
        }

        if (!$actions) {
            $actions = FieldList::create(
                IntroBlockSearchFormAction::create('results', _t(__CLASS__.'.GO', 'Go'))
                    ->setUseButtonTag(true)
                    ->setName(null),
            );
        }

        parent::__construct($controller, $name, $fields, $actions);

        $this->setFormMethod('GET');
        $this->setFormAction(Controller::curr()->Link('SearchForm/'));
        $this->disableSecurityToken();
    }
}
