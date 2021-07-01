<?php

namespace Elements;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use WebTorque\AdvancedLink\AdvancedLink;
use WebTorque\AdvancedLink\WTHasOneButtonField;

class HeroModule extends CustomBaseElement
{

    private static $table_name = "heros";
    private static $singular_name = 'Hero Module';
    private static $plural_name = 'Hero Modules';
    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
    ];

    private static $has_one = [
        'Image' => Image::class,
        'CTAButton' => AdvancedLink::class,
    ];

    private static $owns = [
        'Image',
        'CTAButton',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(array('CTAButtonID'));
        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content', 'Content'),
            WTHasOneButtonField::create($this, 'CTAButton'),
        ]
        );

        return $fields;
    }

}
