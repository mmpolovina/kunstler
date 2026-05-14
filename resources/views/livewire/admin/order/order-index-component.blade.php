<div class="row">

<div class="col-12 mb-4 position-relative">

         <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Orders list</a>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th>User name</th>
                        <th>User email</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $item)
                        <tr wire:key="order-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->status ?  "Completed" :"Pending"  }}</td>
                            <td>${{ number_format($item->total, 0) }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.orders.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button wire:click="deleteOrder({{ $item->id }})" wire:confirm="Are you sure?" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>

</div>

</div>
