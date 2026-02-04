<div>

    <div class="container">
        <div class="col-12">
            <nav class="breadcrumbs">
                <ul>
                    <li><a wire:navigate href="{{ route('home') }}">Home</a></li>
                    <li><a wire:navigate href="{{ route('account') }}">Account</a></li>
                    <li><a wire:navigate href="{{ route('orders') }}">Orders</a></li>
                    <li><span>Your Order Details</span></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 mb-3">

                <div class="Checkout p-3 h-100 bg-white">

                    <h1 class="section-title h5"><span>Links</span></h1>
                    <ul class="list-unstyled">
                        <li><a wire:navigate href="{{ route('account') }}">Account Overview</a></li>
                        <li><a wire:navigate href="{{ route('change-account') }}">Change Account</a></li>
                        <li><a wire:navigate href="{{ route('orders') }}">Orders</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 mb-3">

                <div class="cart-content p-3 h-100 bg-white">
                    <h1 class="section-title h5"><span>Order #{{ $order->id }}</span></h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderProducts as $product)
                                    <tr wire:key="product-{{ $order->id }}" class="text-center">
                                        <td><img src="{{ asset($product->image) }}" alt="{{ $product->title }}"
                                                class="img-fluid" width="50"></td>
                                        <td class="text-start"><a wire:navigate
                                                href="{{ route('product', $product->slug) }}">{{ $product->title }}</a></td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>${{ $product->price * $product->quantity }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5" class="text-end">
                                        Total: ${{ $order->total }}
                                    </th>
                                </tr>
                                @if ($order->note)
                                    <tr>
                                        <td colspan="5" class="text-start">
                                            Note: {{ $order->note }}
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
