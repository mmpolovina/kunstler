<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Categories')]

class CategoryIndexComponent extends Component
{

    public function deleteCategory(Category $category)
    {
        try {
            DB::beginTransaction();

            DB::table('category_filters')
                ->where('category_id', $category->id)
                ->delete();
            $category->delete();

            DB::commit();

            session()->flash('success', 'Category deleted successfully.');
            cache()->forget('categories_html');
            $this->redirectRoute(name: 'admin.categories.index', navigate: true);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error deleting category: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while deleting the category.');
            $this->redirectRoute(name: 'admin.categories.index', navigate: true);
        }

    }

    public function render()
    {
        return view('livewire.admin.category.category-index-component');
    }
}
