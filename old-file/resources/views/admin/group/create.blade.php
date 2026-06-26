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
                <h1 class="page-header">{!! lang('group.group') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('group.index') !!}"> <i class="fa fa-plus fa-fw"></i> All {!! lang('group.group') !!} </a><a style="margin-right: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-success pull-right">Back</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h4>{!! lang('group.group') !!} Information</h4>
                            </div>
                            <div class="form-body">
                                @if($route == 'group.create')
                                {!! Form::open(array('method' => 'POST', 'route' => array('group.store'), 'id' => 'group-form', 'class' => '', 'files' => 'true')) !!}
                                @elseif($route == 'group.edit')
                                {!! Form::model($result, array('route' => array('group.update', $result->id), 'method' => 'PATCH', 'id' => 'group-form', 'class' => '', 'files' => 'true')) !!}
                                @else
                                Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group cats">
                                            
                                            <div class="form-title">
                                                <h4>{!! lang('category.category') !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup></h4>
                                            </div>
                                            
                                            
                                            <ul class="list-group cat_ul" id="myDiv">
                                                @foreach($cats as $key => $cat)
                                                <li class="list-group-item"><input class="check_cat"  type="checkbox" name="category_id[]" {{ in_array($key, $group_cats) ? 'checked' : '' }} value="{{ $key }}"><span class="main_cat">{!! $cat !!}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('name', lang('common.name'), array('class' => '')) !!}
                                        <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                        {!! Form::text('name', null, array('class' => 'form-control', 'rows' => '20')) !!}
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
                                        {!! Form::label('sort', lang('common.sort'), array('class' => '')) !!}
                                        <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                        {!! Form::number('sort', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('route', lang('common.route'), array('class' => '')) !!}
                                        {!! Form::text('route', null, array('class' => 'form-control', 'rows' => '20')) !!}
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
@stop