<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroups;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Modify Filter Group')]
class FilterGroupEditComponent extends Component
{
    public string $title;

    public FilterGroups $filter_group;

    public function mount(FilterGroups $filter_group)
    {
        $this->filter_group = $filter_group;
        $this->title = $this->filter_group->title;
    }
    public function save()
    {
        $validate = $this->validate(
            [
                'title' => 'required|string|max:255',
            ]
        );
        $this->filter_group->update($validate);
        session()->flash('success', 'Filter group updated successfully.');
        $this->redirectRoute(name: 'admin.filter_groups.index', navigate: true);

    }
    public function render()
    {
        return view('livewire.admin.filter.filter-group-edit-component');
    }
}
