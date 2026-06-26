@extends('admin.layouts.master')
@section('css')
{!! HTML::script('assets/js/nicEdit-latest.js') !!}
<script type="text/javascript">
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
                <h1 class="page-header">{!! lang('sidebar_category.sidebar_category') !!} </h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('sidebar_category.sidebar_category') !!}</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'sidebar_category.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('sidebar_category.store'), 'id' => '', 'class' => '','files'=>'true')) !!}
                               
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

