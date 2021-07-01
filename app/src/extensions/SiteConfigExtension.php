<?php

namespace SSDemo\Extension;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'UpgradeURL' => 'Varchar',
        'FooterPhrase' => 'Varchar',
        'PhoneNumber' => 'Varchar',
        'SSLink' => 'Varchar',
        'FBLink' => 'Varchar',
        'LILink' => 'Varchar',
        'Address' => 'Text',
    ];

    private static $has_one = array(
        'NamedLogo' => Image::class,
        'LogoBadge' => Image::class,
    );

    private static $owns = array(
        'NamedLogo',
        'LogoBadge',
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('UpgradeURL', 'Upgrade Now URL'),
            TextField::create('FooterPhrase', 'Footer Phrase'),
            TextField::create('PhoneNumber', 'Phone Number'),
            TextField::create('SSLink', 'SilverStripe Link'),
            TextField::create('FBLink', 'Facebook Link'),
            TextField::create('LILink', 'LinkedIn Link'),
            TextField::create('Address', 'Address'),
            UploadField::create('NamedLogo', 'Named Logo'),
            UploadField::create('LogoBadge', 'Logo Badge'),
        ]);
    }
}
