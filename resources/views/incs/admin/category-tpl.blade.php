
<tr wire:key="category-{{ $item['id'] }}">
    <td>{{ $item['id'] }}</td>
    <td>{{ $tab . $item['title'] }}</td>
    <td>{{ $item['slug'] }}</td>
    <td>
        <a href="{{ route('admin.categories.edit', $item['id']) }}" class="btn btn-secondary btn-sm">
            <i class="far fa-edit"></i>
        </a>
        <button wire:click="deleteCategory({{ $item['id'] }})" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
        </button>

    </td>
</tr>

    @if (isset($item["children"]))

            {!! \App\Helpers\Category\Category::getHtml($item['children'], "$tab --- ") !!}

    @endif
