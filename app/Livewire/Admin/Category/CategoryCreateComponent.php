<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\FilterGroups;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public array $selectedCategoryFilters = [];

    public function save()
    {
        $category = $this->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'required|integer',
            'selectedCategoryFilters.*' => 'numeric',
        ]);

        $parentCategorySlug = $category['parent_id'] ? Category::find($category['parent_id'])->slug . '-' : '';
        $category['slug'] = Str::slug($parentCategorySlug . $this->title);


        if (Category::where('slug', $category['slug'])->exists()) {
            $this->addError('title', 'The title has already been taken.');
            return redirect()->back();
        }

        try {

            DB::beginTransaction();

            $newCategory = Category::create($category);

            if (!empty($this->selectedCategoryFilters)) {

                $categoryFilters = array_map(function ($filterGroupId) use ($newCategory) {
                    return ['filter_group_id' => $filterGroupId, 'category_id' => $newCategory->id];
                }, $category['selectedCategoryFilters']);

                DB::table('category_filters')->insert($categoryFilters);
            }

            DB::commit();

            session()->flash('success', 'Category created successfully.');
            cache()->forget('categories_html');
            $this->redirectRoute(name: 'admin.categories.index', navigate: true);

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->back();
        }

    }

    public function render()
    {
        $filter_groups = FilterGroups::all();
        return view('livewire.admin.category.category-create-component', compact('filter_groups'));
    }
}
