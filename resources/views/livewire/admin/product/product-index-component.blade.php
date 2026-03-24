<div class="row">

<div class="col-12 mb-4">

    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create product</a>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 5%">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr wire:key="category-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ asset($item->getImage()) }}" style="height:100px">
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->category->title }}</td>
                            <td>
                                <a href="{{ route('product', $item->slug) }}" class="btn btn-secondary btn-sm" target="_blank">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button wire:click="deleteProduct({{ $item->id }})" wire:confirm="Are you sure?" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}

        </div>
    </div>

</div>

</div>
