<div class="row">

<div class="col-12 mb-4 position-relative">

         <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th>User name</th>
                        <th>User email</th>
                        <th>Admin</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr wire:key="user-{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->is_admin ? 'Yes' : 'No' }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                @if ($item->id !== auth()->id())
                                <button wire:click="deleteUser({{ $item->id }})" wire:confirm="Are you sure?" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>

</div>

</div>
