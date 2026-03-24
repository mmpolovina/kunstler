<?php

namespace App\Livewire\Admin\Product;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Edit Product')]
class ProductEditComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.product.product-edit-component');
    }
}
