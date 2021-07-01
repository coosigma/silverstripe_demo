<?php

namespace Elements;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\ElementalVirtual\Model\ElementVirtual;
use SilverStripe\Assets\File;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\Debug;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FormField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\View\Requirements;
use SilverStripe\View\SSViewer;

class CustomBaseElement extends BaseElement
{
    private static $table_name = 'CustomBaseElement';
    private static $singular_name = 'Custom Base';
    private static $plural_name = 'Custom Base';
    private static $description = 'Custom Base Module';

    private static $db = [
        'PaddingTop' => 'Varchar',
        'PaddingBottom' => 'Varchar',
        'MobilePaddingTop' => 'Varchar',
        'MobilePaddingBottom' => 'Varchar',
        // 'CustomAnchor' =>'Varchar'
    ];

    private static $defaults = [
        'PaddingTop' => '80',
        'PaddingBottom' => '80',
        'MobilePaddingTop' => '40',
        'MobilePaddingBottom' => '40',
    ];

    private static $summary_fields = [
        'Title',
        'ModuleType',
    ];

    public function searchableFields()
    {
        return [
            'Title' => [
                'filter' => 'PartialMatchFilter',
                'title' => 'Title',
                'field' => TextField::class,
            ],
            'ModuleType' => [
                'filter' => 'PartialMatchFilter',
                'title' => 'Module Type',
                'field' => DropdownField::create('Type')
                    ->setSource(CustomBaseElement::get()->map('ModuleType', 'ModuleType'))
                    ->setEmptyString('-- All Types --'),
            ],
        ];
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->ModuleType = $this->config()->singular_name;

        if (!$this->Title) {
            $this->Title = $this->config()->singular_name;
        }

    }

    public function getType()
    {
        return $this->config()->singular_name;
    }

    private static $spacings = [
        '0' => '0',
        '10' => '10',
        '20' => '20',
        '30' => '30',
        '40' => '40',
        '50' => '50',
        '60' => '60',
        '70' => '70',
        '80' => '80',
        '90' => '90',
        '100' => '100',
        '110' => '110',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['LinkTracking', 'FileTracking', 'ExtraClass']);

        $fields->addFieldsToTab('Root.Settings', array(
            TextField::create('CustomAnchor', 'Anchor')->setDescription('Note: only one word'),
            DropdownField::create('PaddingTop', 'Padding Top', Config::inst()->get(CustomBaseElement::class, 'spacings')),
            DropdownField::create('PaddingBottom', 'Padding Bottom', Config::inst()->get(CustomBaseElement::class, 'spacings')),
            DropdownField::create('MobilePaddingTop', 'Mobile Padding Top', Config::inst()->get(CustomBaseElement::class, 'spacings')),
            DropdownField::create('MobilePaddingBottom', 'Mobile Padding Bottom', Config::inst()->get(CustomBaseElement::class, 'spacings')),
        ));

        return $fields;
    }

    public function currentLink()
    {
        return Controller::curr()->Link();
    }

    public function currController()
    {
        return Controller::curr();
    }

    public function getReindex()
    {
        return '';
    }

    public function cleanText($des)
    {
        return Convert::html2raw($des);
    }

    private function indexRecords($tableRows, $key)
    {
        $res = [];
        foreach ($tableRows as $row) {
            $res[strtolower($row->$key)] = $row;
        }
        return $res;
    }

    private function clearSpans($str)
    {
        $pattern = '/<span>(?=\{)|(?<=\})<\/span>/';
        $str = preg_replace($pattern, '', $str);
        return $str;
    }
}
