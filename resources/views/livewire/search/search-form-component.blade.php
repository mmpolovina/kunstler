<div class="col-sm-6 mt-2 mt-md-0">
    <div class="search-form">
        <form wire:submit="search">
            <div class="input-group">
                <input type="text" class="form-control" wire:model.live.debounce.500ms="term" placeholder="Searching..."
                    aria-label="Searching..." aria-describedby="button-search">


                <button class="btn btn-outline-warning @if(!$term) disabled @endif" type="submit" id="button-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                                @if($term)

                <span class="search-empty" x-on:click="$wire.term = ''; $wire.$refresh(); "><i class="fa-solid fa-xmark"></i></span>
                                @endif

            </div>

        </form>
        @if (count($search_results))
            <ul class="search-result">
                @foreach ($search_results as $result)
                    <li><a wire:navigate
                            href="{{ route('product', $result->slug) }}"><span>{{ $result->title }}</span><span>${{ $result->price }}</span></a>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>
</div>
