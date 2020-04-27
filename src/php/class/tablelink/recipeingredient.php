<?php
namespace tablelink;

class recipeingredient extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['recipe', 'ingredient'];
        $this->middle_table = 'tablelink_recipe_ingredient' ;
        $this->ids = ['recipe', 'ingredient'];
        $this->type = 'onemany';
    }
}
