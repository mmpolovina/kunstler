<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroups;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Filter groups')]

class FilterGroupIndexComponent extends Component
{
    public function deleteFilterGroup($id)
    {
        $filter_group = FilterGroups::find($id);
        if ($filter_group) {
            try {
                DB::beginTransaction();

                $filter_group->delete();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'An error occurred while deleting the filter group: ' . $e->getMessage());
                $this->redirectRoute(name: 'admin.filter_groups.index', navigate: true);
                return;
            }

            session()->flash('success', 'Filter group deleted successfully.');
        } else {
            session()->flash('error', 'Filter group not found.');
        }
        $this->redirectRoute(name: 'admin.filter_groups.index', navigate: true);
    }
    public function render()
    {
        $filter_groups = FilterGroups::all();
        return view('livewire.admin.filter.filter-group-index-component', compact('filter_groups'));
    }
}
