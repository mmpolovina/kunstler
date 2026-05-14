<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Orders')]
class OrderIndexComponent extends Component
{
    use WithPagination;

    public function deleteOrder(Order $order)
    {
        try {
            DB::beginTransaction();
            $order->delete();
            DB::commit();
            session()->flash('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete order: ' . $e->getMessage());
        }

        return $this->redirectRoute(name: 'admin.orders.index', navigate: true);
    }

    public function render()
    {   
        $orders = Order::query()->orderBy('id', 'desc')->paginate();
        return view('livewire.admin.order.order-index-component', compact('orders'));
    }
}
