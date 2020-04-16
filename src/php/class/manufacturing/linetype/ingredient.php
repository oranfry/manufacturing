<?php
namespace manufacturing\linetype;

class ingredient extends \Linetype
{
    public function __construct()
    {
        $this->table = 'ingredient';
        $this->label = 'Ingredient';
        $this->icon = 'lemon';
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'lemon'",
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
        ];
        $this->unfuse_fields = [
            't.sku' => ':sku',
            't.amount' => ':amount',
        ];
    }

    public function get_suggested_values()
    {
        $suggested_values = [];

        $suggested_values['sku'] = get_values('stocktransfer', 'sku');

        return $suggested_values;
    }

    public function validate($line)
    {
        $errors = [];

        if ($line->sku == null) {
            $errors[] = 'no sku';
        }

        if ($line->amount == null) {
            $errors[] = 'no amount';
        }

        return $errors;
    }
}
