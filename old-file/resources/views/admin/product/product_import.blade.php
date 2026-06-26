@extends('admin.layouts.master')
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-header">{!! lang('user.product_import') !!}</h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('user.upload_file') !!} </h4>
                            </div>
                            <div class="form-body">
                                @if($route == 'product.import')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('product-word.upload'), 'id' => 'ajaxSave', 'class' => '','files'=>'true')) !!}
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group"> 
                                            {!! Form::label('file', lang('common.upload'), array('class' => '')) !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::file('file', array('class' => 'form-control')) !!}
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

