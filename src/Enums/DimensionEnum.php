<?php

namespace Rasstislav\IdSk\Enums;

enum DimensionEnum: string
{
    case ONE_QUARTER = 'govuk-grid-column-one-quarter-from-desktop';
    case ONE_THIRD = 'govuk-grid-column-one-third-from-desktop';
    case ONE_HALF = 'govuk-grid-column-one-half-from-desktop';
    case TWO_THIRDS = 'govuk-grid-column-two-thirds-from-desktop';
    case THREE_QUARTERS = 'govuk-grid-column-three-quarters-from-desktop';
    case FULL = 'govuk-grid-column-full-from-desktop';
}
