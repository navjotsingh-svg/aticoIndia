



<thead>

    

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

    <td>{!! $detail->message !!}</td>

    <td>

        @if ($detail->file_name)

            <a href="/public{{ $detail->file_name }}" target="_blank">View Document</a>

        @else

            No document available

        @endif

    </td>

        <td>{!! $detail->created_at !!}</td>

<!-- Inside your table loop -->

<!-- Inside your table loop -->

<td>

    <input type="checkbox" name="selected_enquiries[]" value="{{ $detail->id }}">

</td>



<td>

    <form action="{{ route('enquiry.destroy', $detail->id) }}" method="POST">

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