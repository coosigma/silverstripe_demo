<?php

namespace Elements;

use phpDocumentor\Reflection\DocBlock\Description;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

class SubscribeModule extends CustomBaseElement
{

    private static $table_name = "subscribes";
    private static $singular_name = 'Subscribe Module';
    private static $plural_name = 'Subscribe Modules';
    private static $inline_editable = false;

    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
        'Label' => 'HTMLText',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content', 'Content'),
            HTMLEditorField::create('Label', 'Label'),
        ]);

        return $fields;
    }

}
