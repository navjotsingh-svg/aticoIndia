<ul class="list-group cat_ul">
	@foreach($sub_sub_cats as $key => $sub_sub_cat)
	<li class="list-group-item"><input class="check_cat" name="category_id[]"  type="checkbox" value="{!! $sub_sub_cat->id !!}"><span class="main_cat">{!! $sub_sub_cat->name !!}</span>
	
</li>
@endforeach
</ul>

