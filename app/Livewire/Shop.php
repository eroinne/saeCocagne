<?php

namespace App\Livewire;

use Livewire\Component;

class Shop extends Component
{

    public $type_purchase = [];
    public $type = [];
    public $delivery = [];

    public function render()
    {
        return view('livewire.shop');
    }
}
