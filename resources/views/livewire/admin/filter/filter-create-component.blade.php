<div class="row">

    <div class="col-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header">
                <a href="{{ route('admin.filters.index') }}" class="btn btn-primary">Filters List</a>
            </div>
            <div class="card-body">

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="title" class="form-label required">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Filter Name" wire:model="title">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="filter_group_id" class="form-label required">Filter Group</label>
                        
                            <select class="custom-select  @error('filter_group_id') is-invalid @enderror" wire:model="filter_group_id">
                                <option value="">Select Filter Group</option>

                                @foreach ($filter_groups  as  $k => $group)
                                     <option value="{{ $group->id }}">{{ $group->title }}</option>
                                @endforeach
                            </select>
                        @error('filter_group_id')
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
