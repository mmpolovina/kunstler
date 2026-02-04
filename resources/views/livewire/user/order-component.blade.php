<div>

    <div class="container">
        <div class="col-12">
            <nav class="breadcrumbs">
                <ul>
                    <li><a wire:navigate href="{{ route('home') }}">Home</a></li>
                    <li><a wire:navigate href="{{ route('account') }}">Account</a></li>
                    <li><span>Your Ordes</span></li>
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
                    <h1 class="section-title h5"><span>Orders</span></h1>
                    @if ($orders->isNotEmpty())
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th><i class="fa-solid fa-eye"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr wire:key="order-{{ $order->id }}" class="text-center">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->status ? 'Comleted' : 'New'}}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>{{ $order->updated_at->format('d M Y') }}</td>
                                    <td><a wire:navigate href="{{ route('order-show', $order->id) }}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        {{ $orders->links()}}
                    @else
                         <p>You have no orders yet.</p>
                    @endif

                </div>
            </div>
        </div>

    </div>

</div>
