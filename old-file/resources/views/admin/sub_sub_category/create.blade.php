@extends('admin.layouts.master')
@section('css')
{!! HTML::script('assets/js/nicEdit-latest.js') !!}  <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
//]]>
</script>
@stop
@section('content')
@include('admin.layouts.messages')
@php
$route  = \Route::currentRouteName();
@endphp
<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-10">
                <h1 class="page-header">{!! lang('sub_sub_category.sub_sub_category') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('sub_sub_category.index') !!}"> <i class="fa fa-plus fa-fw"></i> All {!! lang('sub_sub_category.sub_sub_category') !!} </a><a style="margin-right: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-success pull-right">Back</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h4>{!! lang('sub_sub_category.sub_sub_category') !!} Information</h4>
                            </div>
                            <div class="form-body">
                                @if($route == 'sub_sub_category.create')
                                {!! Form::open(array('method' => 'POST', 'route' => array('sub_sub_category.store'), 'id' => 'sub_sub_category-form', 'class' => '', 'files' => 'true')) !!}
                                @elseif($route == 'sub_sub_category.edit')
                                {!! Form::model($result, array('route' => array('sub_sub_category.update', $result->id), 'method' => 'PATCH', 'id' => 'sub_sub_category-form', 'class' => '', 'files' => 'true')) !!}
                                @else
                                Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(!isset($result))
                                        <div class="form-group">
                                            {!! Form::label('parent_id', 'Category', array('class' => '')) !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::select('parent_id_old',$categories,'', array('class' => 'select2 form-control1', 'onchange' => 'getSubCat(this.value)')) !!}
                                        </div>
                                        <div class="form-group"> 
                                            {!! Form::label('parent_id', 'Record Sub Category', array('class' => '')) !!}
                                            <select name="parent_id" id="sub-cat" class="select2 form-control1">
                                                <option value="">-Select Sub Category-</option>
                                            </select>
                                        </div>
                                        @else

                                        <div class="form-group"> 
                                            {!! Form::label('parent_id', 'Record Sub Category', array('class' => '')) !!}
                                            <select name="parent_id" class="select2 form-control1">
                                                <option value="">-Select Sub Category-</option>
                                                @foreach($cats as $key => $cat)
                                                <option value="{{ $cat->id }}" {{ $cat->id == $result['parent_id'] ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @endif
                                        
                                        <div class="form-group">
                                            {!! Form::label('name', lang('common.name'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::text('name', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('short_name', lang('common.short_name'), array('class' => '')) !!}
                                            {!! Form::text('short_name', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('name', lang('common.slug'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::text('slug', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>
                                        <!-- <div class="form-group">
                                            {!! Form::label('heading', lang('common.heading'), array('class' => '')) !!}
                                            {!! Form::text('heading', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div> -->
                                        <div class="form-group">
                                            {!! Form::label('description', lang('common.description'), array('class' => '')) !!}
                                            
                                            {!! Form::textarea('description', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('meta_tag', lang('common.meta_tag'), array('class' => '')) !!}
                                            {!! Form::text('meta_tag', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('meta_description', lang('common.meta_description'), array('class' => '')) !!}
                                            {!! Form::text('meta_description', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('meta_title', lang('common.meta_title'), array('class' => '')) !!}
                                            {!! Form::text('meta_title', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        
                                        <div class="form-group">
                                            {!! Form::label('image', lang('common.image'), array('class' => '')) !!}
                                           
                                            {!! Form::file('image', null, array('class' => 'form-control')) !!}
                                            @if(!empty($result->image))
                                            <div class="form-group">
                                                <img src="{{ asset('uploads/product_images/'.$result->image) }}" class="img-responsive" style="max-height: 70px;">
                                            </div>
                                            @endif
                                        </div>
                                         <div class="form-group">
                                            {!! Form::label('img_alt','Image Alt', array('class' => '')) !!}
                                            {!! Form::text('img_alt', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>
                                        <!--   <div class="form-group">
                                            {!! Form::label('sort', lang('common.sort'), array('class' => '')) !!}
                                            {!! Form::number('sort', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div> -->
                                    </div>
                                    
                                    
                                </div>
                                <div class="row">
                                    <p>&nbsp;</p>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-default w3ls-button">Submit</button>
                                    </div>
                                </div>
                                
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getSubCat(val) {
    $.ajax({
    type: "GET",
    url: "{{ route('get_sub_cat') }}",
    data: {'cat_id' : val},
    success: function(data){
        $("#sub-cat").html(data);
    }
    });
}
</script>
@stop