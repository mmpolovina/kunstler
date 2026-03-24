<div class="row">

    <div class="col-12 mb-4 position-relative">

         <div class="update-loading" wire:loading wire:target="save, category_id">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Products List</a>
            </div>
            <div class="card-body">

                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="title" class="form-label required">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Product Title" wire:model="title">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select wire:model.live="category_id" id="category_id"
                            class="custom-select @error('category_id') is-invalid @enderror">
                            <option value="0">Select Category</option>
                            {!! \App\Helpers\Category\Category::getMenu('incs.admin.menu-tpl') !!}
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        @foreach ($this->filters as $k => $filter_group)
                            <div class="col-lg-3 col-md-6" wire:key="{{ $k }}">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold">{{ $filter_group[0]->title }}</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($filter_group as $filter)
                                            <div class="form-check" wire:key="{{ $filter->filter_id }}">
                                                <input class="form-check-input"
                                                        type="checkbox"
                                                        id="filter-{{ $filter->filter_id }}"
                                                        wire:model="selectedFilters"
                                                        value="{{ $filter->filter_id }}"
                                                >

                                                <label class="form-check-label" for="filter-{{ $filter->filter_id }}">
                                                    {{ $filter->filter_title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label required">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            placeholder="Product price" wire:model="price">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="old_price" class="form-label">Old price</label>
                        <input type="number" class="form-control @error('old_price') is-invalid @enderror" id="old_price"
                            placeholder="Product old price" wire:model="old_price">
                        @error('old_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_hit" class="form-check-label">Is hit</label>
                        <input type="checkbox" class=" @error('is_hit') is-invalid @enderror"
                                id="is_hit" wire:model="is_hit">
                        @error('is_hit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_new" class="form-check-label">Is new</label>
                        <input type="checkbox" class=" @error('is_new') is-invalid @enderror"
                                id="is_new" wire:model="is_new">
                        @error('is_new')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="short_content" class="form-label">Short description</label>
                        <input type="text" class="form-control @error('short_content') is-invalid @enderror" id="short_content"
                            placeholder="Product short description" wire:model="short_content">
                        @error('short_content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Description</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                            placeholder="Product description" wire:model="content" rows="10"></textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label required">Image</label>
                        <input type="file" class="form-control h-100 @error('image') is-invalid @enderror" id="image"
                            placeholder="Product image" wire:model="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="image">
                            <span class="text-success">Uploading...</span>
                        </div>

                        @if (!$errors->has('image')  && $image)
                            <div class="mt-2" style="position: relative; display: inline-block;">
                                <img src="{{ $image->temporaryUrl() }}"
                                alt="Image preview"
                                width="250"
                                >
                                <div class="text-danger position-absolute" style="top:0px; right: 0px; cursor:pointer;">
                                    <button type="button" class="btn btn-sm btn-danger" wire:click="removeUpload('image', '{{ $image->getFilename() }}')">X</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="gallery" class="form-label required">Gallery</label>
                        <input type="file" class="form-control h-100 @error('gallery.*') is-invalid @enderror" id="gallery"
                            placeholder="Product gallery image" wire:model="gallery" multiple>
                        @error('gallery.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="gallery">
                            <span class="text-success">Uploading...</span>
                        </div>

                        @if (!$errors->has('gallery.*')  && $gallery)

                            @foreach ($gallery as $photo)

                                @if ($photo->isPreviewable())

                                <div class="mt-2" style="position: relative; display: inline-block;">
                                    <img src="{{ $photo->temporaryUrl() }}"
                                    alt="Image preview"
                                    width="250"
                                    >
                                    <div class="text-danger position-absolute" style="top:0px; right: 0px; cursor:pointer;">
                                        <button type="button" class="btn btn-sm btn-danger" wire:click="removeUpload('gallery', '{{ $photo->getFilename() }}')">X</button>
                                    </div>
                                </div>
                                @else
                                    <spqn class="text-danger">Error!</spqn>
                                @endif


                            @endforeach
                        @endif
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
