<?php

namespace Rasstislav\IdSk\Control;

use SilverStripe\Control\HTTPResponse;
use SilverStripe\UserForms\Control\UserDefinedFormController as VendorUserDefinedFormController;

class UserDefinedFormController extends VendorUserDefinedFormController
{
    private static $allowed_actions = [
        'finished',
    ];

    public function finished()
    {
        $data = parent::finished();

        if ($data instanceof HTTPResponse) {
            return $data;
        }

        return $this->customise([
            'Form' => $data->Content,
        ]);
    }
}
