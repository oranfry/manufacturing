<?php
namespace blend;

class recipes extends \Blend
{
    public $label = 'Recipes';
    public $printable = true;
    public $linetypes = ['recipe'];

    public function __construct()
    {
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
            ],
            (object) [
                'name' => 'sku',
                'type' => 'text',
            ],
        ];
    }
}
