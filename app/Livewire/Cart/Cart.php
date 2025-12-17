<?php

namespace App\Livewire\Cart;

use App\Helpers\Traits\CartTrait;
use Livewire\Component;

class Cart extends Component
{
    use CartTrait;
    public function render()
    {

        return view('livewire.cart.cart');
    }
}
