<option wire:key="{{$item['id']}}"
        value="{{$item['id']}}"
        @if($item['parent_id'] == 0) class="font-weight-bold" @endif
>{!!  $tab . $item['title'] !!}</option>

    @if (isset($item["children"]))
            {!! \App\Helpers\Category\Category::getHtml($item['children'], "&nbsp;".$tab . "-&nbsp;") !!}
    @endif
