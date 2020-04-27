<?php
namespace tablelink;

class manufactureingredient extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['manufacture', 'stocktransfer'];
        $this->middle_table = 'tablelink_manufacture_ingredient';
        $this->ids = ['manufactureingredient', 'ingredient'];
        $this->type = 'onemany';
    }
}
