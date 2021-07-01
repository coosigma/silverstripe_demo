<?php

namespace Elements;

use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\CompositeValidator;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\RequiredFields;

class TwoColumnModule extends CustomBaseElement
{

    private static $table_name = "two_columns";
    private static $singular_name = 'Two-column Module';
    private static $plural_name = 'Two-column Modules';
    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar',
        'ImagePosition' => 'Enum("Left, Right", "Left")',
        'Content' => 'HTMLText',
    ];

    private static $defaults = [
        'ImagePosition' => 'Left',
    ];

    private static $has_one = [
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $option_types = [
        "Left" => "Left Side",
        "Right" => "Right Side",
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            OptionsetField::create(
                'ImagePosition',
                'Image Position',
                Config::inst()->get(self::class, 'option_types')
            )->setDescription('This setting affects the image position and the section layout'),
            HTMLEditorField::create('Content', 'Content'),
        ]
        );

        return $fields;
    }

}
