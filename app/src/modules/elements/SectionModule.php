<?php

namespace Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\CompositeValidator;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\RequiredFields;
use WebTorque\AdvancedLink\AdvancedLink;
use WebTorque\AdvancedLink\WTHasOneButtonField;

class SectionModule extends CustomBaseElement
{

    private static $table_name = "sections";
    private static $singular_name = 'Section';
    private static $plural_name = 'Sections';
    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar',
        'ImagePosition' => 'Enum("BG, Left, Right", "BG")',
        'Content' => 'HTMLText',
    ];

    private static $defaults = [
        'ImagePosition' => 'BG',
    ];

    private static $has_one = [
        'Image' => Image::class,
        'CTAButton' => AdvancedLink::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $option_types = [
        "BG" => "Background",
        "Left" => "Left Side",
        "Right" => "Right Side",
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(array('CTAButtonID'));
        $fields->addFieldsToTab('Root.Main', [
            OptionsetField::create(
                'ImagePosition',
                'Image Position',
                Config::inst()->get(self::class, 'option_types')
            )->setDescription('This setting affects the image position and the section layout'),
            HTMLEditorField::create('Content', 'Content'),
            WTHasOneButtonField::create($this, 'CTAButton'),
        ]
        );

        return $fields;
    }

    public function validate()
    {
        $result = parent::validate();

        return $result;
    }

    public function getCMSCompositeValidator(): CompositeValidator
    {
        $compositeValidator = parent::getCMSCompositeValidator();
        $compositeValidator->addValidator(RequiredFields::create([
        ]));
        return $compositeValidator;
    }
}
