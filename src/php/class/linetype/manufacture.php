<?php
namespace linetype;

class manufacture extends \Linetype
{
    function __construct()
    {
        $this->table = 'manufacture';
        $this->icon = 'man';
        $this->label = 'Manufacture';
        $this->children = [
            (object) [
                'label' => 'products',
                'linetype' => 'stocktransfer',
                'parent_link' => 'manufactureproduct',
                'rel' => 'many',
            ],
            (object) [
                'label' => 'ingredients',
                'linetype' => 'stocktransfer',
                'parent_link' => 'manufactureingredient',
                'rel' => 'many',
            ],
        ];
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'factory'",
                'derived' => true,
            ],
            (object) [
                'name' => 'date',
                'type' => 'date',
                'fuse' => 't.date',
                'main' => true,
            ],
            (object) [
                'name' => 'description',
                'type' => 'text',
                'fuse' => 't.description',
            ],
            (object) [
                'name' => 'method',
                'type' => 'multiline',
                'fuse' => 't.method',
                'sacrifice' => true,
            ],
        ];
        $this->unfuse_fields = [
            't.date' => ':date',
            't.description' => ':description',
            't.method' => ':method',
        ];
    }

    function astext($line, $child_sets) {
        $skumetas = get_sku_meta();
        $printout = '';
        $printout .= str_pad("Manufacture", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n";
        $printout .= str_pad($line->description, 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= str_pad("{$line->date}", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n\n";

        $subtotal = '0.00';
        $unitsWidth = array_reduce($child_sets['ingredients']->lines, function($c, $v) use($skumetas) {
            return max($c, strlen(@$skumetas[$v->sku]->unit));
        });

        $printout .= str_pad("Makes", 42, " ", STR_PAD_BOTH);

        $printout .= "\n\n";

        foreach ($child_sets['products']->lines as $i => $product) {
            $meta = @$skumetas[$product->sku];
            $product_title = @$meta->title ?: $product->sku;
            $product_unit = @$meta->unit;
            $qty_line = "{$product_title} ";
            $printout .= $qty_line;
            $unit = str_pad($product_unit, $unitsWidth);
            $printout .= str_pad(' ' . (1 * $product->amount) . ' ' . $unit, 42 - strlen($qty_line), '.', STR_PAD_LEFT);
            $subtotal = bcadd($subtotal, $product->amount, 2);
            $printout .= "\n";
        }

        $printout .= "\n";
        $printout .= str_pad("Ingredients", 42, " ", STR_PAD_BOTH);
        $printout .= "\n\n";

        foreach ($child_sets['ingredients']->lines as $i => $ingredient) {
            $meta = @$skumetas[$ingredient->sku];
            $ingredient_title = @$meta->title ?: $ingredient->sku;
            $ingredient_unit = @$meta->unit;
            $qty_line = "{$ingredient_title} ";
            $printout .= $qty_line;
            $unit = str_pad($ingredient_unit, $unitsWidth);
            $printout .= str_pad(' ' . (-$ingredient->amount) . ' ' . $unit, 42 - strlen($qty_line), '.', STR_PAD_LEFT);
            $subtotal = bcadd($subtotal, $ingredient->amount, 2);
            $printout .= "\n";
        }

        $printout .= "\n";
        $printout .= wordwrap($line->method, 42) . "\n\n";

        return $printout;
    }
}
