<?php

namespace Rasstislav\IdSk\ModelAdmins;

use Rasstislav\IdSk\Models\Feedback;
use SilverStripe\Admin\ModelAdmin;

class FeedbackAdmin extends ModelAdmin
{
    private static $managed_models = [
        Feedback::class,
    ];

    private static $url_segment = 'feedback';
    private static $menu_title = 'Spätná väzba';
    private static $menu_icon_class = 'font-icon-white-question';

    public $showImportForm = false;
}
