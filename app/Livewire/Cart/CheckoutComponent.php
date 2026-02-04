<?php

namespace App\Livewire\Cart;

use App\Helpers\Cart\Cart;
use App\Mail\OrderClient;
use App\Mail\OrderManager;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutComponent extends Component
{

    public string $name;
    public string $email;
    public string $note;

    public function mount()
    {
        $this->name = auth()->user()->name ?? '';
        $this->email = auth()->user()->email ?? '';
    }
    public function render()
    {
        return view('livewire.cart.checkout-component');
    }

    public function saveOrder()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'note' => 'string|nullable',

        ]);
        $validated = array_merge($validated, [
            'user_id' => auth()->id(),
            'total' => Cart::getCartTotal()
        ]);

        try {
            DB::beginTransaction();


            $order = Order::query()->create($validated);
            $order_products = [];
            $cart = Cart::getCart();

            foreach ($cart as $product_id => $product) {
                $order_products[] = [
                    'product_id' => $product_id,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => $product['quantity'],
                    'slug' => $product['slug'],
                ];
            }
            $order->orderProducts()->createMany($order_products);

            try {

                Mail::to($order['email'])->send(new OrderClient(
                    $order_products,
                    $validated['total'],
                    $order->id,
                    $validated['note']
                ));

                sleep(10);

                Mail::to('admin@kunstler.com')->send(new OrderManager($order->id));
            } catch (Exception $e) {
                Log::error('Mail error: ' . $e->getMessage());
            }

            Cart::clarCart();
            $this->dispatch('cart-updated');
            $this->js("toastr.success('Susscessful checkout!')");

            DB::commit();


        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error checkout!')");
        }


    }
}
