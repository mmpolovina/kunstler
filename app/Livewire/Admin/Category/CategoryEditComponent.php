<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\FilterGroups;
use Illuminate\Support\Facades\DB;
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
    public array $selectedCategoryFilters = [];

    public function mount(Category $category)
    {
        $this->id = $category->id;
        $this->title = $category->title;
        $this->parent_id = $category->parent_id;
        $this->category = $category;
        $this->selectedCategoryFilters = DB::table('category_filters')
            ->where('category_id', $this->id)
            ->pluck('filter_group_id')
            ->toArray();

    }

    public function save()
    {
        $category = $this->validate([

            'title' => 'required|string|max:255',
            'parent_id' => 'required|integer',
            'selectedCategoryFilters.*' => 'numeric',

        ]);


        $parentCategorySlug = $category['parent_id'] ? Category::find($category['parent_id'])->slug . '-' : '';
        $category['slug'] = Str::slug($parentCategorySlug . $this->title);

        if ($category['slug'] !== $this->category->slug && Category::where('slug', $category['slug'])->exists()) {
            $this->addError('title', 'The title has already been taken.');
            return redirect()->back();
        }

        try {

            DB::beginTransaction();

            DB::table('category_filters')
                ->where('category_id', $this->category->id)
                ->delete();

            if (!empty($this->selectedCategoryFilters)) {

                $categoryFilters = array_map(function ($filterGroupId) {
                    return ['filter_group_id' => $filterGroupId, 'category_id' => $this->category->id];
                }, $category['selectedCategoryFilters']);

                DB::table('category_filters')->insert($categoryFilters);
            }

            $this->category->update($category);

            DB::commit();

            session()->flash('success', 'Category updated successfully.');
            cache()->forget('categories_html');
            $this->redirectRoute(name: 'admin.categories.index', navigate: true);


        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while updating the category.');
            return redirect()->back();
        }



    }
    public function render()
    {

        $filter_groups = FilterGroups::all();

        return view('livewire.admin.category.category-edit-component', compact('filter_groups'));
    }
}
