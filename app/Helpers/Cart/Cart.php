<?php
  
namespace App\Helpers\Cart;

use App\Models\Product;

class Cart
{
    
    public static function add2Cart(int $productId, int $quantity = 1):bool
    {
        $added = false;

        if(self::hasProductInCart($productId)){
            session(["cart.{$productId}.quantity" => session("cart.{$productId}.quantity") + $quantity]);
            $added = true;

        }else{
            $product = Product::find($productId);
            if($product){
                $ses_product = [
                    "title" => $product->title,
                    "slug" => $product->slug,
                    "image" => $product->getImage(),
                    "price" => $product->price,
                    "quantity" => $quantity,

                ];
                // dd(vars: $ses_product);
                session(["cart.{$productId}" => $ses_product]);
                $added = true;
            }
        }

        return $added;
    }   

    public static function hasProductInCart(int $productId): bool{

        return session()->has("cart.$productId");  

    }

    public static function getCart(): array
    {
        return session("cart") ?: [];
    }

    public static function getCartQuantityItems(): int
    {
        return  count(self::getCart());
    }
    public static function getCartQuantityTotal(): int
    {
        $cart = self::getCart();
        return array_sum(array_column($cart, 'quantity'));
    }
    public static function getCartTotal(): int
    {
        $cart = self::getCart();
        $total = 0;
        foreach($cart as $product){
            $total += $product['price']*$product['quantity'];
        }
        return $total;
    }

    public static function removeFromCart($productId):bool{

        if(self::hasProductInCart($productId)){
            session()->forget("cart.{$productId}");
            return true;

        }
        return false;
    }
    public static function clarCart()
    {
        session()->forget('cart');
    }

    public static function updateItemQuantity($productId, $quantity)
    {
        $updated = false;
        if(self::hasProductInCart($productId)){
            session(["cart.{$productId}.quantity" => $quantity]);
            $updated = true;
        }

        return $updated;
    }
}