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
                <h1 class="page-header">{!! lang('status.status') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('status.index') !!}"> <i class="fa fa-plus fa-fw"></i> All {!! lang('status.statuses') !!}</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('status.status_info') !!}</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'status.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('statuses.store'), 'id' => '', 'class' => '', 'files' => 'true')) !!}
                                @elseif($route == 'status.edit')
                                    {!! Form::model($result, array('route' => array('status.update', $result->id), 'method' => 'PATCH', 'id' => 'status-form', 'class' => '', 'files' => 'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group"> 
                                            {!! Form::label('name', lang('common.name'), array('class' => '')) !!}
                                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
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

