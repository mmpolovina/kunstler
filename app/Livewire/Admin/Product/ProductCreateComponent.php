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
#[Title('Create Product')]
class ProductCreateComponent extends Component
{
    use WithFileUploads, ProductTrait;

    public function save()
    {
        $validate = $this->validate();
        $this->addCustomValidation($validate);
        if ($this->getErrorBag()->isNotEmpty()) {
            return redirect()->back()->withErrors($this->getErrorBag());
        }


        if ($validate['image']) {
            $validate['image'] = $this->saveImage($validate['image']);
        }
        if (!empty($validate['gallery'])) {
            foreach ($validate['gallery'] as $key => $image) {
                $validate['gallery'][$key] = $this->saveImage($image);
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
            $this->addError('title', 'Failed to create product in Database.'. $e->getMessage());
            Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back();
        }

    }
    public function render()
    {
        return view('livewire.admin.product.product-create-component');
    }
}
