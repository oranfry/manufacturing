<?php
namespace linetype;

class recipe extends \Linetype
{
    public function __construct()
    {
        $this->table = 'recipe';
        $this->icon = 'docmartini';
        $this->label = 'Recipe';
        $this->children = [
            (object) [
                'label' => 'ingredients',
                'linetype' => 'ingredient',
                'parent_link' => 'recipeingredient',
                'rel' => 'many',
            ],
        ];
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'docmartini'",
                'derived' => true,
            ],
            (object) [
                'name' => 'sku',
                'type' => 'text',
                'fuse' => 't.sku',
            ],
            (object) [
                'name' => 'amount',
                'type' => 'number',
                'fuse' => 't.amount',
            ],
            (object) [
                'name' => 'method',
                'type' => 'multiline',
                'fuse' => 't.method',
                'sacrifice' => true,
            ],
        ];
        $this->unfuse_fields = [
            't.sku' => ':sku',
            't.method' => ':method',
            't.amount' => ':amount',
        ];
    }
}
