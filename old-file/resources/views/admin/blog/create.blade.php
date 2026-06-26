@extends('admin.layouts.master')
@section('css')
{!! HTML::script('assets/js/nicEdit-latest.js') !!}
<script type="text/javascript">
//<![CDATA[
       // bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>
<!-- <script src="https://cdn.tiny.cloud/1/80v85fsz54hfphxo2f3pn0ozkp479l55hsvh95fubq7r7lze/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>


<script>
tinymce.init({
  selector: 'textarea',
  plugins: 'image link code lists',
  toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | image link | code',
  images_upload_url: '/upload-image', // Laravel route
  automatic_uploads: true,
  images_upload_handler: function (blobInfo, success, failure) {
    let formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());
    fetch('/upload-image', {
      method: 'POST',
      body: formData
    }).then(res => res.json())
      .then(data => success(data.location))
      .catch(() => failure('Image upload failed.'));
  }
});
</script> -->

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>

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
                <h1 class="page-header">{!! lang('blog.blog') !!} <a class="btn btn-sm btn-primary pull-right" href="{!! route('blog.index') !!}"> <i class="fa fa-plus fa-fw"></i> All {!! lang('blog.blog') !!} </a><a style="margin-right: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-success pull-right">Back</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>{!! lang('blog.blog') !!} Information</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'blog.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('blog.store'), 'id' => 'blog-form', 'class' => '', 'files' => 'true')) !!}

                                @elseif($route == 'blog.edit')
                                    {!! Form::model($result, array('route' => array('blog.update', $result->id), 'method' => 'PATCH', 'id' => 'blog-form', 'class' => '', 'files' => 'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            {!! Form::label('name', lang('common.name'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                             {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                            
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('slug', lang('common.slug'), array('class' => '')) !!}
                                             {!! Form::text('slug', null, array('class' => 'form-control', 'readonly')) !!}                                            
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('meta_title', lang('common.meta_title'), array('class' => '')) !!}
                                             {!! Form::text('meta_title', null, array('class' => 'form-control')) !!}
                                            
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('meta_tag', lang('common.meta_tag'), array('class' => '')) !!}
                                             {!! Form::text('meta_tag', null, array('class' => 'form-control')) !!}
                                            
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('meta_description', lang('common.meta_description'), array('class' => '')) !!}
                                             {!! Form::text('meta_description', null, array('class' => 'form-control')) !!}
                                            
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('description', lang('common.description'), array('class' => '')) !!}
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                             {!! Form::textarea('description', null, array('class' => 'form-control', 'rows' => '20', 'id' => 'description')) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('file', lang('common.image'), array('class' => '')) !!}(Height : 100-200px and Width : 200-300px)
                                            <sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup>
                                            {!! Form::file('image', null, array('class' => 'form-control')) !!}

                                        </div>  
                                        @if(!empty($result->image))
                                            <div class="form-group"> 
                                                {!! HTML::image(asset('uploads/blog_images/'.$result->image),'' ,array('width' => 70 , 'height' => 70,'class'=>'img-responsive') ) !!}
                                            </div>
                                        @endif    

                                         <div class="form-group">
                                            {!! Form::label('img_alt','Image Alt', array('class' => '')) !!}
                                            {!! Form::text('img_alt', null, array('class' => 'form-control', 'rows' => '20')) !!}
                                        </div> 
                                        
                                        @if(!isset($result))
                                        <div class="form-group cats">
                                            
                                            <div class="form-title">
                                                <h4>{!! lang('category.category') !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup></h4>
                                            </div>
                                            
                                            
                                            <ul class="list-group cat_ul" id="myDiv">
                                                @foreach($cats as $key => $cat)
                                                <li class="list-group-item"><input class="check_cat"  type="checkbox" name="category_id[]" value="{{ $key }}"><span class="main_cat">{!! $cat !!}</span>
                                                
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group cats">
                                        <div class="form-title">
                                            <h4>{!! lang('sub_category.sub_category') !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup></h4>
                                        </div>
                                       
                                        
                                        <div id="sub-cat"></div>
                                    </div>
                                    <div class="form-group cats">
                                        <div class="form-title">
                                            <h4>{!! lang('sub_sub_category.sub_sub_category') !!}</h4>
                                        </div>
                                      
                                       
                                        <div id="sub-sub-cat"></div>
                                    </div>
                                    
                                    @else
                                    <div class="form-group cats">
                                        <div class="form-title">
                                            <h4>{!! lang('category.category') !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup></h4>
                                        </div>
                                        
                                        <ul class="list-group cat_ul" id="myDiv">
                                            @foreach($cats as $key => $cat)
                                            <li class="list-group-item"><input class="check_cat"  type="checkbox" name="category_id[]" value="{{ $key }}" {{ in_array($key, $product_cats) ? 'checked' : '' }}><span class="main_cat">{!! $cat !!}</span>
                                            
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="form-group cats">
                                    <div class="form-title">
                                        <h4>{!! lang('sub_category.sub_category') !!}<sup class="req_field"><i class="fa fa-star" aria-hidden="true"></i></sup></h4>
                                    </div>
                                    <div id="sub-cat">
                                        <ul class="list-group cat_ul">
                                            @foreach($sub_cats as $key => $sub_cat)
                                            <li class="list-group-item"><input class="check_cat"  type="checkbox" name="category_id[]" value="{{ $sub_cat->id }}" {{ in_array($sub_cat->id, $product_cats) ? 'checked' : '' }}><span class="main_cat">{!! $sub_cat->name !!}</span>
                                            
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group cats">
                                <div class="form-title">
                                    <h4>{!! lang('sub_sub_category.sub_sub_category') !!}</h4>
                                </div>
                                
                                <div id="sub-sub-cat">
                                    <ul class="list-group cat_ul">
                                        @foreach($sub_sub_cats as $key => $sub_sub_cat)
                                        <li class="list-group-item"><input class="check_cat"  type="checkbox" name="category_id[]" value="{{ $sub_sub_cat->id }}" {{ in_array($sub_sub_cat->id, $product_cats) ? 'checked' : '' }}><span class="main_cat">{!! $sub_sub_cat->name !!}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                                        <div class="checkbox"> 
                                            <label>{!! Form::checkbox('status', '1', true) !!} Status </label> 
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
<meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

class MyUploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    upload() {
        return this.loader.file.then(file => {
            return new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);

                fetch("{{ url('/upload-image') }}", {
                    method: "POST",
                    body: data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    console.log("STATUS:", response.status);
                    return response.json();
                })
                .then(data => {
                    console.log("RESPONSE:", data);

                    if (data.url) {
                        resolve({
                            default: data.url
                        });
                    } else {
                        reject("Upload failed");
                    }
                })
                .catch(error => {
                    console.error(error);
                    reject("Upload failed");
                });
            });
        });
    }

    abort() {}
}

ClassicEditor
.create(document.querySelector('#description'))
.then(editor => {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new MyUploadAdapter(loader);
    };
})
.catch(error => {
    console.error(error);
});
</script>
<script>
$('#myDiv').change(function() {
var values = [];
{
$('#myDiv :checked').each(function() {
//if(values.indexOf($(this).val()) === -1){
values.push($(this).val());
// }
});
$.ajax({
type: "GET",
url: "{{ route('get_prod_sub_cat') }}",
data: {'cat_id' : values},
success: function(data){
$("#sub-cat").html(data);
}
});
}
});
$('#sub-cat').change(function() {
var sub_values = [];
{
$('#sub-cat :checked').each(function() {
//if(sub_values.indexOf($(this).val()) === -1){
sub_values.push($(this).val());
// }
});
$.ajax({
type: "GET",
url: "{{ route('get_prod_sub_sub_cat') }}",
data: {'cat_id' : sub_values},
success: function(data){
$("#sub-sub-cat").html(data);
}
});
}
});
/*function valueChange(val) {
alert(val);
$.ajax({
type: "GET",
url: "{{ route('get_sub_cat') }}",
data: {'cat_id' : val},
success: function(data){
$("#sub-cat").html(data);
}
});
}*/
</script>
@stop