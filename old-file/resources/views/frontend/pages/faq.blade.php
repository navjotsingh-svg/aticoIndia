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
                        <h1 class="entry-title"> FAQ</h1>
                     </div>
                  </div>
                  <div class="breadcrumb-wrapper">
                     <div class="container">
                        <div class="breadcrumb-wrapper-inner">
                           <span><a href="{{ route('home') }}" class="home"><span>Home</span></a></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><span>FAQ</span></span>
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
<div class="entry-content py-5">
   <div class="ts-row wpb_row vc_row-fluid ts-total-col-1 ts-zindex-0 vc_row container ts-bgimage-position-center_center">
      <div class="ts-column wpb_column vc_column_container vc_col-sm-12 ts-zindex-0">
         <div class="vc_column-inner">
            <div class="wpb_wrapper">
               <h3 style="text-align:left;" class="ts-custom-heading " >Frequently Asked Questions</h3>
              
               <div class="vc_tta-container" data-vc-action="collapse">
                  <div class="vc_general vc_tta vc_tta-accordion vc_tta-color-skincolor vc_tta-style-classic vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-gap-10 vc_tta-controls-align-left vc_tta-o-no-fill">
                     <div class="vc_tta-panels-container">
                        <div class="vc_tta-panels">

                           <div id="accordion">
                                       @if(count($faqs)>0)
                                       @foreach($faqs as $key => $faq)
                                       <div class="card mb-4">
                                          <div class="card-header">
                                             <a class="card-link {{ $loop->iteration == '1' ? '' : 'collapsed' }}" data-toggle="collapse" href="#collapse-{{ $faq->id }}">
                                                {!! $faq->name !!}
                                             </a>
                                          </div>
                                          <div id="collapse-{{ $faq->id }}" class="collapse {{ $loop->iteration == '1' ? 'show' : '' }}" data-parent="#accordion">
                                             <p class="mb-0">{!! $faq->description !!}</p>
                                          </div>
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
   </div>
 
</div>
<!-- .entry-content -->
</article><!-- #post-## -->
</main><!-- #main .site-main -->
</div><!-- #primary .content-area -->
</div><!-- .site-content-inner -->
</div><!-- .site-content -->
</div><!-- .site-content-wrapper -->


@endsection