<?php

namespace App\Livewire\Search;

use App\Helpers\Traits\CartTrait;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination, CartTrait;
    public string $query = '';

    public function mount()
    {
        $this->query = request()->get('query', '');
    }

    public function render()
    {

        $products = [];
        if (mb_strlen($this->query) >= 1) {
            $products = Product::where('title', 'like', '%' . $this->query . '%')
                ->paginate(12);
        }

        return view('livewire.search.search-component', compact('products'));
    }
}
