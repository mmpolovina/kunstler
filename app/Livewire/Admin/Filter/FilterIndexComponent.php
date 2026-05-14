<?php

namespace App\Livewire\Admin\Filter;

use App\Models\Filters;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Filters')]
class FilterIndexComponent extends Component
{
    use WithPagination;
    public function deleteFilter(Filters $filter)
    {
        try {
            DB::beginTransaction();
            $filter->delete();
            DB::commit();
            session()->flash('success', 'Filter deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while deleting the filter: ' . $e->getMessage());
        }

        $this->redirectRoute(name: 'admin.filters.index', navigate: true);
    }

    public function render()
    {   
        $filters = Filters::query()->with('group')->orderBy('id', 'desc')->paginate();
        return view('livewire.admin.filter.filter-index-component', compact('filters'));
    }
}
