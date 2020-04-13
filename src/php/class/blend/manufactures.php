<?php
namespace blend;

class manufactures extends \Blend
{
    public function __construct()
    {
        $this->label = 'Manufactures';
        $this->linetypes = ['manufacture',];
        $this->showass = ['list', 'calendar',];
        $this->groupby = 'date';
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
            ],
            (object) [
                'name' => 'type',
                'type' => 'date',
                'main' => true,
            ],
            (object) [
                'name' => 'date',
                'type' => 'text',
                'groupable' => true,
            ],
            (object) [
                'name' => 'description',
                'type' => 'text',
                'default' => '',
                'sacrifice' => true,
            ],
        ];
    }
}
