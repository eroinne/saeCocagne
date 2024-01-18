<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produits;
use App\Models\Abonnements;

class Shop extends Component
{

    public $type_purchase = [];
    public $type = [];
    public $delivery = [];


    public function getItems($modelClass)
    {
        // Logique de récupération des éléments en fonction des filtres
        $query = $modelClass::query();

        // If it's Abonnements, then check if the structure_id is the same than the user
        if ($modelClass == Abonnements::class) {
            $query->where('structures_id', auth()->user()->structures_id);
        }

        if (!empty($this->type)) {
            $query->whereIn('type', $this->type);
        }


        // if (!empty($this->delivery)) {
        //     $query->whereIn('delivery', $this->delivery);
        // }

        return $query->get();
    }

    public function render()
    {

        // Initliaze the variables
        $products = collect([]);
        $subscriptions = collect([]);

        if (!empty($this->type_purchase)) {

            // If there is produits, then call the getItems method with the Produits class
            if(in_array('produits', $this->type_purchase)){
                $products = $this->getItems(Produits::class);
            }

            //If there is abonnements, then call the getItems method with the Abonnements class
            if(in_array('abonnements', $this->type_purchase)){
                $subscriptions = $this->getItems(Abonnements::class);
            }

        } else {
            $products = $this->getItems(Produits::class);
            $subscriptions = $this->getItems(Abonnements::class);
        }


        // Merge both collections
        $all_products = $products->merge($subscriptions);

        return view('livewire.shop', [
            'products' => $all_products,
        ]);
    }
}
