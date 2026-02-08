<?php

namespace App\Livewire;

use App\Helpers\Traits\CartTrait;
use App\Models\Product;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Livewire\Component;

class HomeComponent extends Component
{

    use CartTrait;


    public function render()
    {

        $hits_products = Product::query()
            ->orderBy('id')
            ->where('is_hit', 1)
            ->limit(4)
            ->get();

        $new_products = Product::query()
            ->orderBy('id')
            ->where('is_new', 1)
            ->limit(8)
            ->get();


        return view('livewire.home-component', [
            'hits_products' => $hits_products,
            'new_products' => $new_products
        ]);
    }
}
