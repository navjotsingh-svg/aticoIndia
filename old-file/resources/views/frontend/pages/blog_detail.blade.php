@extends('frontend.layouts.app')
@section('content')




<div class="ts-titlebar-wrapper ts-bg ts-bgcolor-transparent ts-titlebar-align-left ts-textcolor-white ts-bgimage-yes">
   <div class="ts-titlebar-wrapper-bg-layer ts-bg-layer"></div>
   <div class="ts-titlebar entry-header">
      <div class="ts-titlebar-inner-wrapper">
         <div class="ts-titlebar-main">
            <div class="container">
               <div class="ts-titlebar-main-inner">
                  <div class="entry-title-wrapper">
                     <div class="container">
                        <h1 class="entry-title"> {!! $blog->name !!}</h1>
                     </div>
                  </div>
                  <div class="breadcrumb-wrapper">
                     <div class="container">
                        <div class="breadcrumb-wrapper-inner">
                           <span><a href="{{ route('home') }}" class="home"><span>Home</span></a></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><span>{!! $blog->name !!}</span></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- .ts-titlebar-main -->
      </div>
      <!-- .ts-titlebar-inner-wrapper -->
   </div>
   <!-- .ts-titlebar -->
</div>
<!-- .ts-titlebar-wrapper -->


<div id="content-wrapper" class="site-content-wrapper">
   <div id="content" class="site-content container">
      <div id="content-inner" class="site-content-inner row multi-columns-row">
         <div id="primary" class="content-area col-md-8 col-lg-8 col-xs-12">
            <main id="main" class="site-main">
               <div class="themestek-common-box-shadow">
                  <article id="post-140" class="themestek-box-blog-classic post-140 post type-post status-publish format-standard has-post-thumbnail hentry category-scientific-laboratory tag-chemistry tag-physics" >
                     <div class="ts-blog-classic-featured-wrapper">
                        <div class="ts-blog-classic-datebox-overlay">
                           <div class="ts-blog-classic-dbox-date">{{ $blog->created_at->format('F d, Y') }}</div>
                        </div>
                        <div class="ts-featured-wrapper ts-post-featured-wrapper ts-post-format-"><img width="750" height="500" src="{{ asset('uploads/blog_images/'.$blog->image) }}" class="attachment-full size-full wp-post-image" alt=""></div>
                     </div>
                     <div class="ts-blog-classic-box-content ">
                        <!-- Blog classic meta Start -->
                        <div class="ts-featured-meta-wrapper ts-featured-overlay">
                           <div class="ts-blog-post-date">
                              <span class="ts-meta-line"><span class="screen-reader-text ts-hide">Date </span> <i class="ts-labtechco-icon-clock"></i> <a href="index.html">{{ $blog->created_at->format('F d, Y') }}</a></span>
                           </div>
                         
                           <div class="themestek-box-title">
                              <h2>{!! $blog->name !!}</h2>
                           </div>
                        </div>
                        <!-- Blog classic meta End -->
                        <div class="entry-content" style="color: black;">
                           {!! $content !!}
                        </div>
                        <!-- .entry-content -->
                     </div>
                     <!-- .ts-blog-classic-box-content -->
                  </article>
                  <!-- #post-## -->


                 


                  <div class="ts-blog-classic-box-content" style="display: none;">
                     <div id="comments" class="comments-area">
                        <h2 class="comments-title">
                           {{ count($blog_comments) }} Replies to &ldquo;Methods of the recruitment&rdquo;    
                        </h2>
                        <ol class="comment-list">


                           @if(count($blog_comments)>0)
                           @foreach($blog_comments as $key => $blog_comment)
                           <li class="comment even thread-even depth-1" id="comment-3">
                              <div id="div-comment-3" class="comment-body">
                                 <div class="comment-author vcard">
                                    <img alt='' src="{{ asset('assets/frontend/images/user-img1.png') }}" class='avatar avatar-100 photo' />      
                                 </div>
                                 <div class="comment-meta commentsetadata">
                                    <cite class="ts-comment-owner fn">{!! $blog_comment->name !!}</cite> <span class="says">says:</span>
                                    <a href="index.html#comment-3">
                                    {{ $blog_comment->created_at->format('F d, Y') }}</a>      
                                 </div>
                                 <p>{!! $blog_comment->comment !!}</p>
                                 
                              </div>
                           </li>
                           @endforeach
                           @endif


                        </ol>
                        <!-- .comment-list -->
                      <div class="blog-comment-area col-md-12 p-0 mt-xl-5">
                     <div id="leave-comment" class="nd-post-comment">
                        <div id="respond" class="comment-respond">
                           <h3 class="comment-title">Leave a Reply </h3>

                           <form action="{{ route('blog_comment.store') }}" method="post" class="validate-form formcomment-box">
                              {!! csrf_field() !!}
                              <div class="form-group">
                                 <textarea id="message" class="form-control rounded-0" name="comment" rows="6" cols="30" placeholder="Comment" required>{{ old('comment') }}</textarea>
                              </div>
                              <div class="row">
                                 <div class="form-group col-md-6">
                                    <input id="author" class="form-control rounded-0"  required name="name" value="{{ old('name') }}" type="text" placeholder="Name *" size="30"/>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <input id="email" class="form-control rounded-0"  required name="email" type="email" value="{{ old('email') }}" placeholder="Email *" size="30"/>
                                 </div>
                              </div>
                             
                              <input type="hidden" name="blog_id" value="{{ $blog['id'] }}">
                              <button type="submit" class="btn btn-primary">Post Comment</button>
                           </form>
                        </div>
                        <!-- #respond -->
                     </div>
                     <!-- #comments -->
                  </div>
                        <!-- #respond -->
                     </div>
                     <!-- .comments-area -->
                  </div>
                  <!-- .ts-blog-classic-box-content -->
               </div>
               <!-- .themestek-common-box-shadow-->
            </main>
            <!-- .site-main -->
         </div>
         <!-- .content-area -->
         <aside id="sidebar-right" class="widget-area col-md-4 col-lg-4 col-xs-12 sidebar">
         <form action="{{ route('enquiry.store') }}" method="post" class="wpcf7-form" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="contact-feedback-block">
            <div class="form-row">
              <div class="form-group col-md-6 pr-lg-3"><span class="wpcf7-form-control-wrap your-name"><input type="text" required="true" name="name" value="{{ old('name') }}" class="wpcf7-form-control wpcf7-text form-control rounded-0" placeholder="First Name*" /></span></div>
              <div class="form-group col-md-6">
                <span class="wpcf7-form-control-wrap your-email"><input type="email" required="true" name="email" value="{{ old('email') }}" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" placeholder="Email*"/></span>
              </div>
              <div class="form-group col-md-6 pr-lg-3">
                <span class="wpcf7-form-control-wrap your-email"><input type="number" min="0" required="true" name="mobile_no" value="{{ old('mobile_no') }}" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" placeholder="Mobile Number" /></span>
              </div>
              <div class="form-group col-md-6">
                <span class="wpcf7-form-control-wrap your-email">
                  <select required="true" name="country" class="wpcf7-form-control wpcf7-text wpcf7-email form-control rounded-0" aria-invalid="false" >
                    <option value="">Select Country</option>
                    @foreach(getCountries() as $key => $country)
                    <option value="{!! $country->name !!}">{!! $country->name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <?php
$min  = 1;
$max  = 300;
$num1 = rand( $min, $max );
$num2 = rand( $min, $max );
$sum  = $num1 + $num2;
?>
              <div class="form-group">
                <span class="wpcf7-form-control-wrap your-message"><textarea required="true" name="message" cols="80" rows="5" class="wpcf7-form-control wpcf7-textarea form-control rounded-0" placeholder="How can we help?" >{!! old('message') !!}</textarea></span>
              </div>
              <div class="form-group">
              <input type="file" name="file_name" id="file_name" accept=".xls,.xlsx,.pdf">
                                          </div>
               <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6LdxTXQoAAAAALx5i79u3FVOWj-Rgh0XguRBmwM_"></div>
</div>
              <p><button data-res="<?php echo $sum; ?>" type="submit" class="get_quote_btn">send message</button>
              </div>
            </form>
            <aside id="themestek-recent-posts-2" class="widget themestek_widget_recent_entries">
               <h3 class="widget-title">Recent Posts</h3>
               <ul class="ts-recent-post-list">
                  
                  @if(count($latest_blogs)>0)
                  @foreach($latest_blogs as $key => $latest_blog)
                  <li class="ts-recent-post-list-li"><a href="{{ route('blog_detail', $latest_blog->slug) }}"><img width="150" height="150" src="{{ asset('uploads/blog_images/'.$latest_blog->image) }}" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" ></a><a href="{{ route('blog_detail', $latest_blog->slug) }}">{!! $latest_blog->name !!}</a><span class="post-date">{{ $latest_blog->created_at->format('F d, Y') }}</span></li>
                  @endforeach
                  @endif
               </ul>
            </aside>
           
          
         </aside>
         <!-- #sidebar-right -->
      </div>
      <!-- .site-content-inner -->
   </div>
   <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->

<div id="successModal" class="modal fade">
      <div class="modal-dialog modal-confirm">
        <div class="modal-content">
          <div class="modal-header">
            <div class="icon-box">
              <i class="material-icons">&#xE876;</i>
            </div>
            <h4 class="modal-title">Success!</h4>
          </div>
          <div class="modal-body">
            <p class="text-center mb-0" id="modal_success_message"> Success </p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
<script>
    const submitButton = document.querySelector('[type="submit"]');
const quizInput = document.querySelector(".quiz-control");
quizInput.addEventListener("input", function(e) {
	const res = submitButton.getAttribute("data-res");
	if ( this.value == res ) {
		submitButton.removeAttribute("disabled");
	} else {
		submitButton.setAttribute("disabled", "");
	}
});
</script>
@endsection
@section('script')
<!-- Image Zoom Close -->
<script type="text/javascript">
   @if (Session::has('success'))
   $("#modal_success_message").html( "{!! Session::get('success') !!}" );
   $('#successModal').modal('show');
   //swal('Success!', "{{ Session::get('success') }}", 'success');
   @endif
</script>
@endsection