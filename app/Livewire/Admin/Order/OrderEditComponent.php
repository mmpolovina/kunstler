<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Order Update')]
class OrderEditComponent extends Component
{
    public Order $order;
    public  $status;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->status = $order->status; 
    }   

    public function save()
    {
        $validate = $this->validate([
            'status' => 'nullable|in:0,1',
        ]);
        
        if($this->status !== $this->order->status) {
            $this->order->update($validate);
        }

        session()->flash('message', 'Order status updated successfully.');
        return $this->redirectRoute(name: 'admin.orders.index', navigate: true);

    }

    public function render()
    {

        return view('livewire.admin.order.order-edit-component');
    }
}
