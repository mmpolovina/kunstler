<?php

namespace App\Livewire\Admin\Product;

use App\Helpers\Traits\ProductTrait;
use App\Models\Filters;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Edit Product')]
class ProductEditComponent extends Component
{
    use WithFileUploads, ProductTrait;

    public Product $product;
    public $photo;
    public $photos;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->title = $this->product->title;
        $this->category_id = $this->product->category_id;
        $this->price = $this->product->price;
        $this->old_price = $this->product->old_price;
        $this->short_content = $this->product->short_content;
        $this->content = $this->product->content;
        $this->is_hit = $this->product->is_hit;
        $this->is_new = $this->product->is_new;
        $this->photos = $this->product->gallery;
        $this->photo = $this->product->image;
        $this->selectedFilters = $this->product->filters()->pluck('filter_id')->toArray();


    }

    public function save()
    {
        $validate = $this->validate();

        $this->addCustomValidation($validate);
        if ($this->getErrorBag()->isNotEmpty()) {
            return redirect()->back()->withErrors($this->getErrorBag());
        }


        if (!empty($validate['image'])) {
            $validate['image'] = $this->saveImage($validate['image']);
        }else {
            $validate['image'] = $this->photo;
        }

        if (!empty($validate['gallery'])) {
            foreach ($validate['gallery'] as $key => $image) {
                $validate['gallery'][$key] = $this->saveImage($image);
            }
            $validate['gallery'] = array_merge($this->photos, $validate['gallery']);
        }else {
            $validate['gallery'] = $this->photos;

        }
        try {

            DB::beginTransaction();
            $this->product->update($validate);

            DB::table('filter_products')->where('product_id', $this->product->id)->delete();
            if (!empty($validate['selectedFilters'])) {
                $filter_groups = Filters::whereIn('id', $validate['selectedFilters'])->get();
                $productFilters = [];
                foreach ($filter_groups as $filter) {
                    $productFilters[] = [
                        'filter_id' => $filter->id,
                        'filter_group_id' => $filter->filter_group_id,
                        'product_id' => $this->product->id
                    ];
                }
                DB::table('filter_products')->insert($productFilters);
            }

            DB::commit();

            session()->flash('success', 'Product modified successfully.');
            return redirect()->route('admin.products.index');

        } catch (\Exception $e) {

            DB::rollBack();
            $this->addError('title', 'Failed to edit product in Database.' . $e->getMessage());
            Log::error('Error editing product: ' . $e->getMessage());
            return redirect()->back();
        }

    }

    public function removeGalleryItem($index)
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            $this->photos = array_values($this->photos); // Reindex the array
        }
    }
    public function render()
    {

        return view('livewire.admin.product.product-edit-component');
    }
}
