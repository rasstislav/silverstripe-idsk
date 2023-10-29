<?php

namespace Rasstislav\IdSk\View;

use SilverStripe\View\SSViewer_BasicIteratorSupport as CoreSSViewer_BasicIteratorSupport;
use SilverStripe\View\TemplateIteratorProvider;

class SSViewer_BasicIteratorSupport extends CoreSSViewer_BasicIteratorSupport implements TemplateIteratorProvider
{
    public static function get_template_iterator_variables()
    {
        return [
            'LoopPos' => ['method' => 'Pos'],
        ];
    }
}
