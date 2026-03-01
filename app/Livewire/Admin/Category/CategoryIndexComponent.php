<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Categories')]

class CategoryIndexComponent extends Component
{

    public function deleteCategory(Category $category)
    {

        $category->delete();

        session()->flash('success', 'Category deleted successfully.');
        cache()->forget('categories_html');
        $this->redirectRoute(name: 'admin.categories.index',  navigate: true);

    }

    public function render()
    {
        return view('livewire.admin.category.category-index-component');
    }
}
