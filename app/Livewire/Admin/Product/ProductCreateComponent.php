<?php

namespace App\Livewire\Admin\Product;

use App\Helpers\Category\Category as HelpersCategory;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;


#[Layout('components.layouts.admin')]
#[Title('Create Product')]
class ProductCreateComponent extends Component
{
    use WithFileUploads;
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

    public function updateCategoryId($value)
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
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB Max
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB Max for each image
            'short_content' => 'max:255',
            'content' => 'required',
            'is_hit' => 'boolean',
            'is_new' => 'boolean',
            'selectedFilters.*' => 'integer|exists:filters,id',
        ];
    }

    public function save()
    {
        $validate = $this->validate();

        $validate['slug'] = Str::slug(Category::find($this->category_id, 'title')->title . '-' . $validate['title']);
        if (Product::where('slug', $validate['slug'])->exists()) {
            $this->addError('title', 'The title has already been taken.');
            return redirect()->back();
        }

        $folder = 'products/' . date('Y/m/d');
        if ($validate['image']) {
            $validate['image'] = $validate['image']->store($folder);

        }
        if (!empty($validate['gallery'])) {
            foreach ($validate['gallery'] as $key => $image) {
                $validate['gallery'][$key] = $image->store($folder);
            }
        }

        try {

            DB::beginTransaction();

            // Create the product
            $product = Product::create($validate);

            // Attach filters to the product
            if (!empty($validate['selectedFilters'])) {
                $filter_groups = Filters::whereIn('id', $validate['selectedFilters'])->get();
                $productFilters = [];
                foreach ($filter_groups as $filter) {
                    $productFilters[] = [
                        'filter_id' => $filter->id,
                        'filter_group_id' => $filter->filter_group_id,
                        'product_id' => $product->id
                    ];
                }
                DB::table('filter_products')->insert($productFilters);
            }

            DB::commit();

            session()->flash('success', 'Product created successfully.');
            return redirect()->route('admin.products.index');

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back();
        }

        dd($validate);

    }
    public function render()
    {
        return view('livewire.admin.product.product-create-component');
    }
}
