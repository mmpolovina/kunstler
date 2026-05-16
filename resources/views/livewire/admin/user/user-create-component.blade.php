<div class="row">

    <div class="col-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Users List</a>
            </div>
            <div class="card-body">

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="name" class="form-label required">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="User Name" wire:model="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="User Email" wire:model="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label required">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="User Password" wire:model="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Is Admin?</label>
                         <select class="custom-select" wire:model="is_admin" style="width: 120px" id="is_admin">
                                        <option value="false">No</option>
                                        <option value="true">Yes</option>
                        </select>
                        @error('is_admin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
