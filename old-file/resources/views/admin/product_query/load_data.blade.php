<thead>
<tr>
    <th width="5%" class="text-center">{!! lang('common.id') !!}</th>
    <th>Product name</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Country</th>
    <th>Quantity</th>
    <th>Message</th>
    <th>Date</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>
@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td>
        <a target="_blank" href="{!! route('product_detail', [$detail->slug]) !!}">
            {!! $detail->product_name !!}
        </a>
    </td>

    <td>{!! $detail->name !!}</td>
    <td>{!! $detail->email !!}</td>
    <td>{!! $detail->phone_number !!}</td>
    <td>{!! $detail->country !!}</td>
    <td>{!! $detail->quantity !!}</td>
    <td>{!! $detail->message !!}</td>
    <td>{!! $detail->created_at !!}</td>
<!-- Inside your table loop -->
<td>
    <form action="{{ route('product_query.destroy', $detail->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
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