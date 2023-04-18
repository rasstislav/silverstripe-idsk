<?php

namespace Rasstislav\IdSk\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\ArrayList;

class ContentControllerExtension extends Extension
{
    public function FooterMenu()
    {
        $result = SiteTree::get()->filter([
            'ShowInFooter' => 1,
        ]);

        $visible = [];

        if ($result) {
            foreach ($result as $page) {
                /** @var SiteTree $page */
                if ($page->canView()) {
                    $visible[] = $page;
                }
            }
        }

        return new ArrayList($visible);
    }
}
