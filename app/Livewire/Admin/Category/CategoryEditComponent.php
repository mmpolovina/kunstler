<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Edit Category')]

class CategoryEditComponent extends Component
{
    public string $title;
    public int $parent_id = 0;
    public int $id;
    public Category $category;

    public function mount(Category $category)
    {
        $this->id = $category->id;
        $this->title = $category->title;
        $this->parent_id = $category->parent_id;
        $this->category = $category;

    }

    public function save()
    {
        $category = $this-> validate([

            'title' => 'required|string|max:255',
            'parent_id' => 'required|integer',
        ]);

        $parentCategorySlug = $category['parent_id'] ? Category::find($category['parent_id'])->slug.'-' : '';
        $category['slug'] = Str::slug($parentCategorySlug . $this->title);
        if (Category::where('slug', $category['slug'])->exists()) {
            $this->addError('title', 'The title has already been taken.');
            return redirect()->back();
        }

        $this->category->update($category);

        session()->flash('success', 'Category updated successfully.');
        cache()->forget('categories_html');
        $this->redirectRoute(name: 'admin.categories.index',  navigate: true);

    }
    public function render()
    {
        return view('livewire.admin.category.category-edit-component');
    }
}
