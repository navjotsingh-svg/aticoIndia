<thead>
<tr>
    <th width="5%" class="text-center">{!! lang('common.id') !!}</th>
    <th>{!! lang('common.name') !!}</th>
    <th> {!! lang('category.categories') !!} </th>
    <th> {!! lang('common.route') !!} </th>
    <th> {!! lang('common.sort') !!} </th>
    <th width="6%" class="text-center"> {!! lang('common.status') !!} </th>
    <th class="text-center">{!! lang('common.action') !!}</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>
@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td>
        <a href="{!! route('group.edit', [$detail->id]) !!}">
            {!! $detail->name !!}
        </a>
    </td>
    <td>
        @foreach(getGroupCats($detail->id) as $key => $value)
            {!!$value['cat_name'].','!!}
        @endforeach
    </td>
    <td>{!! $detail->route !!}</td>
    <td>{!! $detail->sort !!}</td>


    <td class="text-center">
        <a href="javascript:void(0);" class="toggle-status" data-message="{!! lang('messages.change_status') !!}" data-route="{!! route('group.toggle', $detail->id) !!}">
            {!! HTML::image('assets/images/' . $detail->status . '.gif') !!}
        </a>
    </td>
    <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" href="{{ route('group.edit', [$detail->id]) }}"><i class="fa fa-edit"></i></a>

        <a title="{!! lang('common.delete') !!}" class="btn btn-xs btn-danger __drop" data-route="{!! route('group.drop', [$detail->id]) !!}" data-message="{!! lang('messages.sure_delete', string_manip(lang('group.group'))) !!}" href="javascript:void(0)">
            <i class="fa fa-times"></i>
        </a>
    </td>    
</tr>
@endforeach
@if (count($data) < 1)
<tr>
    <td class="text-center" colspan="8"> {!! lang('messages.no_data_found') !!} </td>
</tr>
@else
<tr>
    <td colspan="10">
        {!! paginationControls($page, $total, $perPage) !!}
    </td>
</tr>
@endif
</tbody>