<?php

namespace Rasstislav\IdSk\Forms;

use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\Validator;

class TableFilterForm extends Form
{
    protected $enabledSubmission = true;
    protected $enabledEmptySubmission = false;

    protected $expanded = false;
    protected $expandFormOnEmptyData = true;

    public function __construct(
        RequestHandler $controller = null,
        $name = 'TableFilterForm',
        FieldList $fields = null,
        FieldList $actions = null,
        Validator $validator = null,
        $loadDataFromGetParameters = true,
        $fixIncorrectData = true,
    ) {
        if (!$actions) {
            $actions = new FieldList([
                TableFilterFormAction::create('doFilter', _t(__CLASS__.'.GO', 'Filtrovať'))
                    ->setUseButtonTag(true)
                    ->setDisabled(true),
            ]);
        }

        parent::__construct($controller, $name, $fields, $actions, $validator);

        $this->setFormMethod('GET');
        $this->setFormAction($controller?->Link());
        $this->disableSecurityToken(true);

        if ($loadDataFromGetParameters) {
            $defaultData = $fixIncorrectData ? $this->getData() : [];

            $this->loadDataFrom($this->getRequest()->getVars(), parent::MERGE_AS_INTERNAL_VALUE);

            if ($fixIncorrectData) {
                $loadedData = $this->getData();

                foreach ($this->validationResult()->getMessages() as $errors) {
                    $loadedData[$fieldName = $errors['fieldName']] = $defaultData[$fieldName];
                }

                $this->loadDataFrom($loadedData, parent::MERGE_AS_INTERNAL_VALUE);
            }
        }
    }

    public function getLegend()
    {
        return $this->legend ?: 'Filtrovať obsah';
    }

    public function setIsEnabledSubmission($bool)
    {
        $this->enabledSubmission = (bool)$bool;
        return $this;
    }

    public function isEnabledSubmission()
    {
        return $this->enabledSubmission;
    }

    public function setIsEnabledEmptySubmission($bool)
    {
        $this->enabledEmptySubmission = (bool)$bool;
        return $this;
    }

    public function isEnabledEmptySubmission()
    {
        return $this->enabledEmptySubmission;
    }

    public function setIsExpanded($bool)
    {
        $this->expanded = (bool)$bool;
        return $this;
    }

    public function isExpanded()
    {
        return $this->expanded;
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
        return !array_filter($this->getData(), fn($value) => !is_null($value) && $value !== '');
    }

    public function isSubmitted()
    {
        return !!array_intersect_key($this->getRequest()->getVars(), $this->getData());
    }

    public function loadMessagesFrom($result)
    {
        return $this;
    }
}
