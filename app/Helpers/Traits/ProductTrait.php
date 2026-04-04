<?php

namespace App\Helpers\Traits;

use App\Helpers\Category\Category as HelpersCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

trait ProductTrait
{
    public string $title;
    public string $category_id;
    public int $price;
    public int $old_price;

    public string $short_content = '';
    public string $content = '';

    public bool $is_hit = false;
    public bool $is_new = false;

    #[Validate]
    public $image;
    #[Validate]
    public $gallery = [];

    public array $selectedFilters = [];

    public function updatedCategoryId($value)
    {
        $this->selectedFilters = [];
    }

    #[Computed]
    public function filters()
    {

        $filter_groups = [];

        if (isset($this->category_id)) {

            $ids = HelpersCategory::getIds($this->category_id) . $this->category_id;

            $category_filters = DB::table('category_filters')
                ->select('category_filters.filter_group_id', 'filter_groups.title', 'filters.id as filter_id', 'filters.title as filter_title')
                ->join('filter_groups', 'category_filters.filter_group_id', '=', 'filter_groups.id')
                ->join('filters', 'filters.filter_group_id', '=', 'filter_groups.id')
                ->whereIn('category_filters.category_id', explode(',', $ids))
                ->get();

            foreach ($category_filters as $filter) {
                $filter_groups[$filter->filter_group_id][] = $filter;
            }
        }

        return $filter_groups;

    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|integer|min:0',
            'old_price' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB Max
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB Max for each image
            'short_content' => 'max:255',
            'content' => 'required',
            'is_hit' => 'boolean',
            'is_new' => 'boolean',
            'selectedFilters.*' => 'integer|exists:filters,id',
        ];
    }
    public function addCustomValidation(&$validate)
    {

        if (!empty($validate['old_price']) && $validate['old_price'] < $validate['price']) {
            $this->addError('old_price', 'The old price must be greater than or equal to the price.');
        }elseif (empty($validate['old_price'])) {
            unset($validate['old_price']);
        }

        $validate['slug'] = Str::slug(Category::find($this->category_id, 'title')->title . '-' . $validate['title']);
        if (Product::where('slug', $validate['slug'])
                    ->where('id', '!=', $this->product->id ?? 0)
                    ->exists()) {
            $this->addError('title', 'The title has already been taken.');
        }
    }

    public function saveImage($image)
    {
        $folder = 'products/' . date('Y/m/d');
        return "uploads/" . $image->store($folder);
    }

}

