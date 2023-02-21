<?php

namespace Rasstislav\IdSk\Extensions;

use DateTime;
use IntlDateFormatter;
use Rasstislav\IdSk\Enums\DimensionEnum;
use SilverStripe\i18n\i18n;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\DateField;

class FormFieldExtension extends Extension
{
    public function onBeforeRenderHolder($context, $properties)
    {
        if ($context->getMessageType() === 'required') {
            $context->addExtraClass('govuk-form-group--error');

            $context->setMessage(
                $context->getMessage(),
                'govuk-error-message',
                $context->getMessageCast(),
            );
        }
    }

    public function onBeforeRender($context, $properties)
    {
        if ($context->getMessageType() === 'govuk-error-message') {
            $context->addExtraClass('govuk-input--error');
            $context->removeExtraClass('govuk-form-group--error');
        }
    }

    public function setDimension(DimensionEnum $case)
    {
        $this->owner->dimensionClass = $case->value;

        return $this->owner;
    }

    public function DimensionClass()
    {
        return $this->owner->dimensionClass;
    }

    public function NiceValue()
    {
        $value = $this->owner->Value();

        if ($value && $this->owner instanceof DateField) {
            $intlDateFormatter = new IntlDateFormatter(i18n::get_locale(), IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE);

            $value = $intlDateFormatter->format(new DateTime($value));
        }

        return $value;
    }
}
