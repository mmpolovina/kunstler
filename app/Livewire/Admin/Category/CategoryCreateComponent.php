<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Add Category')]
class CategoryCreateComponent extends Component
{
    public string $title;
    public int $parent_id = 0;

    public function save()
    {
        $category = $this->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'required|integer',
        ]);

        $parentCategorySlug = $category['parent_id'] ? Category::find($category['parent_id'])->slug.'-' : '';
        $category['slug'] = Str::slug($parentCategorySlug . $this->title);

        if (Category::where('slug', $category['slug'])->exists()) {
            $this->addError('title', 'The title has already been taken.');
            return redirect()->back();
        }

        Category::create($category);

        session()->flash('success', 'Category created successfully.');
        cache()->forget('categories_html');
        $this->redirectRoute(name: 'admin.categories.index',  navigate: true);

    }

    public function render()
    {
        return view('livewire.admin.category.category-create-component');
    }
}
