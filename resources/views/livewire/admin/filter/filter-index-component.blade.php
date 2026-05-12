<div class="row">

<div class="col-12 mb-4 position-relative">

         <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="{{ route('admin.filters.create') }}" class="btn btn-primary">Create filter</a>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th>Title</th>
                        <th>Filter Group</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($filters as $item)
                        <tr wire:key="filter-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->group->title }}</td>
                            <td>
                                <a href="{{ route('admin.filters.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button wire:click="deleteFilter({{ $item->id }})" wire:confirm="Are you sure?" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</div>
