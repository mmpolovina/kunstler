<div>
                @section('title') {{'Search results'}} @endsection

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs" id="products">
                    <ul>
                        <li><a href="{{ route('home')}}">Home</a></li>
                        <li><span>Search result</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">

        <div class="update-loading" wire:loading wire:target.except="add2Cart">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <h1 class="h3"><span>Search result for "{{ $query}}"</span></h1>
                    </div>
                </div>
                @if(count($products))
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-sm-6 mb-3" wire:key="{{ $product->id }}">
                                @include('incs.product-card')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ $products->links( data: ['scrollTo' => '#products']) }}
                        </div>
                    </div>
                @else
                    <p>No products found...</p>
                @endif

            </div>
        </div>
    </div>
</div>
