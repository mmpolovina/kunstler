<div class="row">

    <div class="col-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Orders List</a>
            </div>
            <div class="card-body">

                <form wire:submit="save">
                    <div class="mb-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                Order #{{ $order->id }} ({{ $order->status ? 'Completed' : 'New' }})
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>#</th>
                                                <td>{{ $order->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Customer name</th>
                                                <td>{{ $order->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Customer email</th>
                                                <td>{{ $order->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <select class="custom-select" wire:model="status"
                                                        style="width: 120px">
                                                        <option value="0">Pending</option>
                                                        <option value="1">Completed</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td>${{ $order->total }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created</th>
                                                <td>{{ $order->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated</th>
                                                <td>{{ $order->updated_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Note</th>
                                                <td>{{ $order->note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                Order products
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->orderProducts as $product)
                                                <tr wire:key="{{ $product->id }}">
                                                    <td><img src="{{ asset($product->image) }}" height="50" alt=""></td>
                                                    <td>{{ $product->title }}</td>
                                                    <td>${{ $product->price }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-right font-weight-bold">
                                                    Total: ${{ $order->total }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">
                                Save
                                <div wire:loading wire:target="save">
                                    <div class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </button>
                        </div>

                </form>

            </div>
        </div>

    </div>

</div>