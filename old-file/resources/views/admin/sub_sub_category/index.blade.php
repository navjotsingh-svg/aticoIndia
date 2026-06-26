@extends('admin.layouts.master')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')

<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">                
                <h1 class="page-header">{!! lang('sub_sub_category.sub_sub_category') !!} Listing <a class="btn btn-sm btn-primary pull-right" href="{!! route('sub_sub_category.create') !!}"> <i class="fa fa-plus fa-fw"></i> {!! lang('common.create_heading', lang('sub_sub_category.sub_sub_category')) !!} </a><a style="margin-right: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-success pull-right">Back</a></h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">
                      <h3>Sub Sub Category Details</h3>

                        {{-- for message rendering --}}
                        @include('admin.layouts.messages')

                        <div class="row">
                            <div class="col-md-12 question-filter">
                                <div class="panel panel-default">
                                    <div class="panel-heading panel-inner">
                                        Sub Sub Category Filter
                                    </div>
                                    
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            {!! Form::open(array('method' => 'POST',
                                            'route' => array('sub_sub_category.paginate'), 'id' => 'ajaxForm')) !!}
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        {!! Form::label('category_id', lang('category.category'), array('class' => 'control-label')) !!}
                                                        {!! Form::select('category_id', $categories, (session('category_id') != "") ? session('category_id') : '', array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        {!! Form::label('name', lang('common.name'), array('class' => 'control-label')) !!}
                                                        {!! Form::text('name', (session('name') != "") ? session('name') : '', array('class' => 'form-control', 'placeholder' => 'Search by Name', 'autocomplete' => 'off')) !!}
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        {!! Form::label('slug', lang('common.slug'), array('class' => 'control-label')) !!}
                                                        {!! Form::text('slug', (session('slug') != "") ? session('slug') : '', array('class' => 'form-control', 'placeholder' => 'Search by slug', 'autocomplete' => 'off')) !!}
                                                    </div>
                                                </div>

                                                                                             
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        {!! Form::label('status', lang('common.status'), array('class' => 'control-label')) !!}
                                                        {!! Form::select('status', $statuses, (session('status') != "") ? session('status') : '', array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-3 margintop20">
                                                    <div class="form-group">
                                                        {!! Form::hidden('form-search', 1) !!}
                                                        {!! Form::submit(lang('common.filter'), array('class' => 'btn btn-primary')) !!}
                                                        <a href="{!! route('sub_sub_category.index') !!}" class="btn btn-success"> {!! lang('common.reset_filter') !!}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{!! route('sub_sub_category.excel') !!}" class="btn btn-success"> Export Excel</a>

                        <form action="#" method="post">
                            <div class="col-md-3 text-right pull-right padding0 marginbottom10">
                                {!! lang('common.per_page') !!}: {!! Form::select('name', ['20' => '20', '40' => '40', '100' => '100', '200' => '200', '300' => '300'], '20', ['id' => 'per-page']) !!}
                            </div>
                            <div class="col-md-3 padding0 marginbottom10">
                                {!! Form::hidden('page', 'search') !!}
                                {!! Form::hidden('_token', csrf_token()) !!}
                                {!! Form::text('name', null, array('class' => 'form-control live-search', 'placeholder' => 'Search sub_sub_category by name')) !!}
                            </div>
                            <table id="paginate-load" data-route="{{ route('sub_sub_category.paginate') }}" class="table table-hover">
                            </table>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop


