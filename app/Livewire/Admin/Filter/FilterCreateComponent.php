<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroups;
use App\Models\Filters;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.admin')]
#[Title('Create Filter')]

class FilterCreateComponent extends Component
{
    public string $title = '';
    public int $filter_group_id = 0;

    public function save()
    {
        $validate = $this->validate([
            'title' => 'required|string|max:255',
            'filter_group_id' => 'required|integer|exists:filter_groups,id',
        ]);

        Filters::create($validate);

        session()->flash('message', 'Filter created successfully!');
        $this->redirectRoute(name: 'admin.filters.index', navigate: true);
    }
    public function render()
    {
        $filter_groups = FilterGroups::all();
        return view('livewire.admin.filter.filter-create-component', compact('filter_groups')); 
    }
}
