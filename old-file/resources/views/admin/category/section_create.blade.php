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
                <h1 class="page-header">{!! lang('sector.sector') !!} <a style="margin-right: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-success pull-right">Back</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('sector.sector') !!} Information</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'sector_section_create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('sector_section_post'), 'id' => 'sector-form', 'class' => '', 'files' => 'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            {!! Form::label('section_heading', lang('common.section_heading'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                             {!! Form::text('section_heading', isset($result->section_heading) ? $result->section_heading : null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('section_description', lang('common.section_description'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                             {!! Form::text('section_description', isset($result->section_description) ? $result->section_description : null, array('class' => 'form-control', 'rows' => '20')) !!}
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