<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class OrderShowComponent extends Component
{
    public int $id;

    public function mount(int $id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $order = Order::whereBelongsTo(auth()->user())->findOrFail($this->id);

        return view('livewire.user.order-show-component', [
            'order' => $order,
            ]);
    }
}
