<?php

namespace App\Livewire\Admin\Filter;

use App\Models\FilterGroups;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Add Filter Group')]
class FilterGroupCreateComponent extends Component
{
    public string $title;

    public function save()
    {
        $validate = $this->validate(
            [
                'title' => 'required|string|max:255',
            ]
        );
        FilterGroups::create($validate);
        session()->flash('success', 'Filter group created successfully.');
        $this->redirectRoute(name: 'admin.filter_groups.index', navigate: true);

    }
    public function render()
    {
        return view('livewire.admin.filter.filter-group-create-component');
    }
}
