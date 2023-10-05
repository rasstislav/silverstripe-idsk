<?php

namespace Rasstislav\IdSk\Extensions;

use Rasstislav\IdSk\TinyMCEConfig;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FormScaffolder;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'CookiesBanner' => 'Boolean',
        'CookiesBannerHeading' => 'Varchar(255)',
        'CookiesBannerText' => 'HTMLText',
        'CookiesBannerButtons' => 'Boolean(1)',
        'CookiesBannerAcceptButtonTitle' => 'Varchar(55)',
        'CookiesBannerRejectButtonTitle' => 'Varchar(55)',
        'CookiesBannerAccepted' => 'HTMLText',
        'CookiesBannerRejected' => 'HTMLText',
    ];

    private static $has_one = [
        'HeaderLogo' => Image::class,
        'FooterLogo' => Image::class,
        'CookiesPage' => SiteTree::class,
    ];

    private static $owns = [
        'HeaderLogo',
        'FooterLogo',
    ];

    private static $field_labels = [
        'HeaderLogo' => 'Logo',
        'FooterLogo' => 'Logo',
        'CookiesBanner' => 'Povoliť cookies a zobrazenie cookies bannera',
        'CookiesBannerHeading' => 'Nadpis',
        'CookiesBannerText' => 'Obsah',
        'CookiesBannerButtons' => 'Zobraziť tlačidlá pre povolenie všetkých cookies',
        'CookiesBannerAcceptButtonTitle' => 'Nápis na tlačidle prijať',
        'CookiesBannerRejectButtonTitle' => 'Nápis na tlačidle odmietnuť',
        'CookiesBannerAccepted' => 'Text po prijatí cookies',
        'CookiesBannerRejected' => 'Text po odmietnutí cookies',
        'CookiesPage' => 'Stránka s nastaveniami cookies',
    ];

    public function updateCMSFields(FieldList $fields) {
        $fields->insertBefore(TabSet::create('Header', 'Hlavička',
            Tab::create('Main', _t(FormScaffolder::class . '.TABMAIN', 'Main'),
                $this->owner->dbObject('HeaderLogoID')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('HeaderLogo')),
            ),
            // TODO: optional unclecheese/silverstripe-display-logic
            Tab::create('Cookies', 'Cookies',
                $this->owner->dbObject('CookiesBanner')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBanner')),
                $this->owner->dbObject('CookiesBannerHeading')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerHeading')),
                $cookiesBannerTextField = $this->owner->dbObject('CookiesBannerText')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerText'))
                    ->setRows(3),
                $this->owner->dbObject('CookiesBannerButtons')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerButtons')),
                $this->owner->dbObject('CookiesBannerAcceptButtonTitle')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerAcceptButtonTitle')),
                $this->owner->dbObject('CookiesBannerRejectButtonTitle')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerRejectButtonTitle')),
                $cookiesBannerAcceptedField = $this->owner->dbObject('CookiesBannerAccepted')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerAccepted'))
                    ->setRows(3),
                $cookiesBannerRejectedField = $this->owner->dbObject('CookiesBannerRejected')->scaffoldFormField()
                    ->setTitle($this->owner->fieldLabel('CookiesBannerRejected'))
                    ->setRows(3),
                TreeDropdownField::create('CookiesPageID', $this->owner->fieldLabel('CookiesPage'), SiteTree::class),
            )
        ), 'Access');

        $fields->insertBefore(Tab::create('Footer', 'Pätička',
            $this->owner->dbObject('FooterLogoID')->scaffoldFormField()
                ->setTitle($this->owner->fieldLabel('FooterLogo')),
        ), 'Access');

        $tinyMCEConfig = TinyMCEConfig::get('cms');

        $tinyMCEConfig->setMode($cookiesBannerTextField, TinyMCEConfig::MODE_MINIMAL);
        $tinyMCEConfig->setMode($cookiesBannerAcceptedField, TinyMCEConfig::MODE_MINIMAL);
        $tinyMCEConfig->setMode($cookiesBannerRejectedField, TinyMCEConfig::MODE_MINIMAL);
    }
}
