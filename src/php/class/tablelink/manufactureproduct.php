<?php
namespace tablelink;

class manufactureproduct extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['manufacture', 'stocktransfer'];
        $this->middle_table = 'tablelink_manufacture_product';
        $this->ids = ['manufactureproduct', 'product'];
        $this->type = 'oneone';
    }
}
