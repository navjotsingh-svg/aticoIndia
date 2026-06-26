<thead>
<tr>
    <th width="5%" class="text-center">{!! lang('common.id') !!}</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Country</th>
    <th>Product</th>
    <th>Query</th>
    <th>Date</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>
@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td>{!! $detail->name !!}</td>
    <td>{!! $detail->email !!}</td>
    <td>{!! $detail->mobile_no !!}</td>
    <td>{!! $detail->country !!}</td>
    <td>{!! $detail->product !!}</td>
    <td>{!! $detail->query !!}</td>
    <td>{!! $detail->created_at !!}</td>


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