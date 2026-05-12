<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroups;
use App\Models\Filters;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.admin')]
#[Title('Update Filter')]
class FilterEditComponent extends Component
{
    public string $title;
    public int $filter_group_id;
    public Filters $filter;

    public function mount(Filters $filter)
    {
        $this->title = $filter->title;
        $this->filter_group_id = $filter->filter_group_id;
        $this->filter = $filter;
    }   
    public function save()
    {
        $validate = $this->validate([
            'title' => 'required|string|max:255',
            'filter_group_id' => 'required|integer|exists:filter_groups,id',
        ]);

        $this->filter->update($validate);

        session()->flash('message', 'Filter update successfully!');
        $this->redirectRoute(name: 'admin.filters.index', navigate: true);
    }
    public function render()
    {
        $filter_groups = FilterGroups::all();
        return view('livewire.admin.filter.filter-edit-component', compact('filter_groups'));       
    }
}
