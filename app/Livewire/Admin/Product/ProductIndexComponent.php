<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Products')]

class ProductIndexComponent extends Component
{
    use WithPagination;

    public function deleteProduct(Product $product)
    {
        $image = $product->image;
        $gallery = $product->gallery;

        try {
            DB::beginTransaction();

            DB::table('filter_products')->where('product_id1', $product->id)->delete();
            $product->delete();

            DB::commit();

            if ($image) {
                Storage::disk('public_uploads_delete')->delete($image);
            }
            if ($gallery) {
                Storage::disk('public_uploads_delete')->delete($gallery);
            }

            session()->flash('success', 'Product deleted successfully.');
            $this->redirectRoute(name: 'admin.products.index', navigate: true);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting product: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete product. Please try again.');
            $this->redirectRoute(name: 'admin.products.index', navigate: true);
        }

    }

    public function render()
    {

        $products = Product::with('category')
            ->orderByDesc('id')
            ->paginate();

        return view('livewire.admin.product.product-index-component', compact('products'));
    }
}
