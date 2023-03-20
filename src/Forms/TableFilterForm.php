<?php

namespace Rasstislav\IdSk\Forms;

use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\Validator;

class TableFilterForm extends Form
{
    protected $expandFormOnEmptyData = true;

    public function __construct(
        RequestHandler $controller = null,
        $name = 'TableFilterForm',
        FieldList $fields = null,
        FieldList $actions = null,
        Validator $validator = null
    ) {
        if (!$actions) {
            $actions = new FieldList([
                TableFilterFormAction::create('doFilter', _t(__CLASS__.'.GO', 'Filtrovať'))
                    ->setUseButtonTag(true)
                    ->setName(null),
            ]);
        }

        parent::__construct($controller, $name, $fields, $actions, $validator);

        $this->setFormMethod('GET');
        $this->setFormAction($controller?->Link());
        $this->disableSecurityToken(true);
    }

    public function getLegend()
    {
        return $this->legend ?: 'Filtrovať obsah';
    }

    public function setExpandFormOnEmptyData($bool)
    {
        $this->expandFormOnEmptyData = (bool)$bool;
        return $this;
    }

    public function getExpandFormOnEmptyData()
    {
        return $this->expandFormOnEmptyData;
    }

    public function isEmpty()
    {
        $data = $this->getData();

        foreach ($this->validationResult()->getMessages() as $message) {
            unset($data[$message['fieldName']]);
        }

        return !array_filter($data, fn($value) => !is_null($value) && $value !== '');
    }

    public function loadMessagesFrom($result)
    {
        return $this;
    }
}
