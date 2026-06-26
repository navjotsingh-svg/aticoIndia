<option value="">-Select Sub Category-
@foreach($sub_cats as $key => $sub_cat)
	<option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}
@endforeach