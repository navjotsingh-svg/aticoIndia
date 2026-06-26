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
                <h1 class="page-header">{!! lang('faq.faq') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('faq.index') !!}"> <i class="fa fa-plus fa-fw"></i> All {!! lang('faq.faq') !!} </a><a style="margin-right: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-success pull-right">Back</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h4>{!! lang('faq.faq') !!} Information</h4>
                            </div>
                            <div class="form-body">
                                @if($route == 'faq.create')
                                {!! Form::open(array('method' => 'POST', 'route' => array('faq.store'), 'id' => 'faq-form', 'class' => '', 'files' => 'true')) !!}
                                @elseif($route == 'faq.edit')
                                {!! Form::model($result, array('route' => array('faq.update', $result->id), 'method' => 'PATCH', 'id' => 'faq-form', 'class' => '', 'files' => 'true')) !!}
                                @else
                                Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('name', lang('common.name'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::text('name', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('description', lang('common.description'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::textarea('description', null, array('class' => 'form-control', 'rows' => '20')) !!}
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