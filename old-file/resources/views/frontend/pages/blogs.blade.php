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
                        <h1 class="entry-title"> Blog Grid View</h1>
                     </div>
                  </div>
                  <div class="breadcrumb-wrapper">
                     <div class="container">
                        <div class="breadcrumb-wrapper-inner">
                           <!-- Breadcrumb NavXT output --><span><a title="Go to LabtechCO." href="{{ route('home') }}" class="home"><span>Atico India</span></a></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><span>Blog Grid View</span></span>
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
<div id="content-wrapper" class="site-content-wrapper blog-page">
   <div id="content" class="site-content ">
      <div id="content-inner" class="site-content-inner ">
         <div id="primary" class="content-area  ">
            <main id="main" class="site-main">
               <article id="post-6642" class="post-6642 page type-page status-publish hentry">
                  <header class="single-entry-header ts-hide">
                     <h2 class="entry-title">Blog Grid View</h2>
                  </header>
                  <!-- .entry-header -->
                  <div class="entry-content">
                     <div data-vc-full-width="true" data-vc-full-width-init="false" class="ts-row wpb_row vc_row-fluid ts-total-col-1 ts-zindex-0 ts-bgimage-position-center_center">
                        <div class="vc_row container">
                           <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
                              <div class="vc_column-inner">
                                 <div class="wpb_wrapper">
                                    <div class="themestek-boxes themestek-boxes-blog themestek-boxes-view-default themestek-boxes-col-three themestek-boxes-sortable-no themestek-boxes-textalign-center themestek-boxes-sortablebutton-">
                                       <div class="themestek-boxes-inner themestek-boxes-blog-inner ">
                                          <div class="row multi-columns-row themestek-boxes-row-wrapper">
                                             @if(count($blogs)>0)
                                             @foreach($blogs as $key => $blog)
                                             <div class="ts-box-col-wrapper col-lg-4 col-sm-6 col-md-4 col-xs-12 forensic-science single-blog-thumb">
                                                <article class="themestek-box themestek-box-blog ts-blogbox-style-1 themestek-box-style1 themestek-blogbox-format-gallery ">
                                                   <div class="post-item">
                                                      <div class="ts-blog-image-with-meta">
                                                         <div class="ts-post-format-icon-w"><i class="ts-labtechco-icon-gallery-1"></i></div>
                                                         <div class="ts-featured-wrapper ts-post-featured-wrapper ts-post-format-gallery">
                                                            <div class="ts-slick-carousel-wrapper">
                                                               <div class="ts-flexslider">
                                                                  <ul class="slides">
                                                                     <li><a href="{{ route('blog_detail', $blog->slug) }}"><img width="750" height="500" src="{{ asset('uploads/blog_images/'.$blog->image) }}" class="attachment-themestek-img-800x700 size-themestek-img-800x700" alt="" /></a></li>
                                                                  </ul>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="themestek-box-content">
                                                         <div class="ts-entry-meta-wrapper">
                                                            <div class="entry-meta ts-entry-meta ts-entry-meta-blogbox"><span class="ts-meta-line byline">  <span class="author vcard"><span class="screen-reader-text ts-hide">Author </span>By <a class="url fn n" href="{{ route('blog_detail', $blog->slug) }}">admin</a></span></span><span class="ts-meta-line posted-on"><span class="screen-reader-text ts-hide">Posted on </span><a href="{{ route('blog_detail', $blog->slug) }}" rel="bookmark"><time class="entry-date published" datetime="2017-08-10T11:28:41+00:00">{{ $blog->created_at->format('F d, Y') }}</time><time class="updated ts-hide" datetime="2018-08-25T10:20:35+00:00">August 25, 2018</time></a></span></div>
                                                         </div>
                                                         <div class="themestek-box-title">
                                                            <h2 style="font-size: 20px;"><a href="{{ route('blog_detail', $blog->slug) }}">{!! $blog->name !!}</a></h2>
                                                         </div>
                                                         <!-- <div class="themestek-box-desc">
                                                            <div class="themestek-box-desc-text">{!! str_limit($blog->description, $limit = 200, $end = '...') !!}</div>
                                                         </div> -->
                                                         <div class="ts-bottom-meta-wrapper clearfix">
                                                            <div class="pull-left">
                                                               <div class="themestek-blogbox-footer-left"><a href="{{ route('blog_detail', $blog->slug) }}">Read More</a></div>
                                                            </div>
                                                            <div class="themestek-blogbox-footer-commnent pull-right">
                                                               <span class="ts-blogbox-comment-w">
                                                               <a href="{{ route('blog_detail', $blog->slug) }}">
                                                               <i class="themifyicon ti-comment"></i>
                                                               <span class="comments">{{ countBlogComments($blog['id']) }}</span>
                                                               </a>
                                                               </span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </article>
                                             </div>
                                             @endforeach
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="vc_row-full-width vc_clearfix"></div>
                  </div>
                  <!-- .entry-content -->
               </article>
               <!-- #post-## -->
            </main>
            <!-- #main .site-main -->
         </div>
         <!-- #primary .content-area -->
      </div>
      <!-- .site-content-inner -->
   </div>
   <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->
@endsection