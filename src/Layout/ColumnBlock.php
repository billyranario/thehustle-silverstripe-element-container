<?php

namespace TheHustle\Layout;

use DNADesign\Elemental\Extensions\ElementalAreasExtension;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use SilverStripe\ORM\FieldType\DBVarchar;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;

class ColumnBlock extends BaseElement
{

    private static string $table_name = 'ColumnBlock';
    private static string $title = 'Group';
    private static string $description = 'Orderable list of elements';
    private static string $singular_name = 'Column Block';
    private static string $plural_name = 'Column Blocks';
    private static string $icon = 'font-icon-block-file-list';

    private static $db = [
        'CSSClass' => DBVarchar::class,
        'ColumnWidth' => DBVarchar::class
    ];

    private static $column_width_sizes = [
        'w-full' => 'Full (100%)',
        'w-11/12' => '11/12 (about 92%)',
        'w-5/6' => '5/6 (about 83%)',
        'w-3/4' => '3/4 (75%)',
        'w-2/3' => '2/3 (67%)',
        'w-7/12' => '7/12 (about 58%)',
        'w-1/2' => 'Half (6/12, 50%)',
        'w-5/12' => '5/12 (about 42%)',
        'w-1/3' => '1/3 (33%)',
        'w-1/4' => '1/4 (25%)',
        'w-1/6' => '1/6 (about 17%)',
        'w-1/12' => '1/12 (about 8%)',
    ];
    
    
    private static $has_one = [
        'Elements' => ElementalArea::class,
        'BackgroundImage' => Image::class,
    ];

    private static $owns = [
        'BackgroundImage',
        'Elements'
    ];

    private static array $cascade_deletes = [
        'Elements'
    ];

    private static array $cascade_duplicates = [
        'Elements'
    ];

    private static array $extensions = [
        ElementalAreasExtension::class
    ];

    public function getType(): string
    {
        return _t(__CLASS__ . '.BlockType', 'Container Column Blocks');
    }

    public function getSummary(): string
    {
        $count = $this->Elements()->Elements()->Count();
        $suffix = $count === 1 ? 'element' : 'elements';

        return 'Contains ' . $count . ' ' . $suffix;
    }

    public function getOwnedAreaRelationName(): string
    {
        $has_one = $this->config()->get('has_one');

        foreach ($has_one as $relationName => $relationClass) {
            if ($relationClass === ElementalArea::class && $relationName !== 'Parent') {
                return $relationName;
            }
        }

        return 'Elements';
    }

    public function inlineEditable(): bool
    {
        return false;
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $cssField = TextField::create('CSSClass', 'Column CSS Class');
        
        $columnWidthSizes = self::$column_width_sizes;
        $columnWidthField = DropdownField::create(
            'ColumnWidth',
            'Column Width',
            $columnWidthSizes
        );
    
        $fields->insertAfter('Title', $columnWidthField);
        $fields->insertAfter('ColumnWidth', $cssField)
            ->setDescription('Separate multiple classes with spaces. e.g. "col-md-6 bg-primary"');
    
        return $fields;
    }
}
