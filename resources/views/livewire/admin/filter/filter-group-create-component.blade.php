<div class="row">

    <div class="col-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header">
                <a href="{{ route('admin.filter_groups.index') }}" class="btn btn-primary">Filter Groups List</a>
            </div>
            <div class="card-body">

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="title" class="form-label required">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Filter Group Name" wire:model="title">
                        @error('title')
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
