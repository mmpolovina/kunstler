<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{

    public $quantity = 1;
    public function add2Cart($product_id, $quantity = false)
    {


        $quantity = $quantity ? (int) $this->quantity : 1;
        if ($quantity < 1) {
            $quantity = 1;
        }

        if (Cart::add2Cart($product_id, $quantity)) {
            $this->js("toastr.success('Success')");
            $this->dispatch('cart-updated');

        } else {
            $this->js("toastr.success('Error')");

        }
    }

    public function removeFromCart($productId): void
    {
        if (Cart::removeFromCart($productId)) {
            $this->js("toastr.success('Success')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Error')");

        }
    }

    public function updateItemQuantity($productId, $quantity)
    {
        if ($quantity <= 0) {
            $quantity = 1;
        }
        if (Cart::updateItemQuantity($productId, $quantity)) {
            $this->dispatch('cart-updated');
            $this->js("toastr.success('Quantity updated!')");

        } else {
            $this->js("toastr.error('Error of updating!')");

        }
    }

    public function clearCart()
    {
        Cart::clarCart();
        $this->dispatch('cart-updated');
        $this->js("toastr.success('Cart cleared successfuly!')");
        

    }
}
