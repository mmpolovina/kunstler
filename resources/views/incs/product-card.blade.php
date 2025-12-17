<div class="product-card">
    <div class="product-card-offer">
        @if ($product->is_hit)
        <div class="offer-hit">Hit</div>
        @endif
        @if ($product->is_new)
        <div class="offer-new">New</div>
        @endif
    </div>
    <div class="product-thumb">
        <a href="{{ route('product', $product->slug)}}" wire:navigate><img src="{{asset($product->getImage())}}" alt=""></a>
    </div>
    <div class="product-details">
        <h4>
            <a href="{{ route('product', $product->slug)}}" wire:navigate>{{ $product->title}}</a>
        </h4>
        <div class="product-bottom-details d-flex justify-content-between">
            <div class="product-price">
                <small>@if ($product->old_price)
                    ${{$product->old_price}}
                    @endif</small>
                ${{$product->price}}
            </div>
           <div class="product-links">
            
                <button class="btn btn-outline-secondary add-to-cart" wire:click="add2Cart({{$product->id}})"
                    wire:loading.class="disabled">
                    <div wire:loading.remove wire:target="add2Cart({{$product->id}})">
                        <i class="fas fa-shopping-cart"></i>
            
                    </div>
            
                    <div wire:loading wire:target="add2Cart({{$product->id}})">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </button>
            
            
            </div>
    </div>
</div>
</div>