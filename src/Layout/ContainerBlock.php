<?php

namespace TheHustle\Layout;

use DNADesign\Elemental\Extensions\ElementalAreasExtension;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use SilverStripe\ORM\FieldType\DBBoolean;
use SilverStripe\ORM\FieldType\DBVarchar;
use SilverStripe\Assets\Image;

class ContainerBlock extends BaseElement
{

    private static string $table_name = 'ContainerBlock';
    private static string $title = 'Group';
    private static string $description = 'Orderable list of elements';
    private static string $singular_name = 'Container Block';
    private static string $plural_name = 'Container Blocks';
    private static string $icon = 'font-icon-block-file-list';

    private static $db = [
        'CSSClass' => DBVarchar::class,
        'NoGutters' => DBBoolean::class,
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
        return _t(__CLASS__ . '.BlockType', 'Container');
    }

    public function getSummary(): string
    {
        $count = $this->Elements()->Elements()->Count();
        $suffix = $count === 1 ? 'column' : 'columns';

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
}
