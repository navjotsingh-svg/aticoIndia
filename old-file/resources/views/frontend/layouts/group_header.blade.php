<div id="ts-stickable-header-w" class="ts-stickable-header-w ts-bgcolor-custom">
   <div id="site-header" class="site-header ts-bgcolor-custom ts-sticky-bgcolor-white ts-responsive-icon-dark ts-header-menu-position-right ts-mmmenu-override-yes ts-above-content-yes  ts-stickable-header new-header">
      <div class="site-header-main ts-table container-fluid row">
         
         <div id="site-header-menu" class="site-header-menu  ts-table-cell" style="width: 100%;">
            <nav id="site-navigation" class="main-navigation" aria-label="Primary Menu" data-sticky-height="90">        
            <button id="menu-toggle" class="menu-toggle">
               <span class="ts-hide">Toggle menu</span><i class="ts-labtechco-icon-bars"></i>
               </button>       
               <div class="nav-menu nav-menu-new">
                  <ul id="menu-main-menu" class="nav-menu nav-menu-new">
                    
                    @foreach(getGroups() as $key => $group)
                     <li id="menu-item-6599" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-6599">
                        <a class="header-menu-white" href="{{ route('categories', $group->route) }}">{!! $group->name !!}</a>
                        @if(isset($group->categories))
                        <ul class="sub-menu">
                            @foreach($group->categories->slice(0,9) as $key => $category)
                           <li id="menu-item-6596" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-6596"><a href="{{ route('categories', $category->slug) }}">{!! isset($category->short_name)?$category->short_name:$category->name !!}</a>

                            @if(isset($category->sub_categories))
                            <ul class="sub-menu">
                                @foreach($category->sub_categories->slice(0,15) as $key => $sub_category)
                                <li id="menu-item-6596" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-6596"><a href="{{ route('categories', $sub_category->slug) }}">{!! isset($sub_category->short_name)?$sub_category->short_name:$sub_category->name !!}</a></li>
                                @endforeach
                                @if(count($category->sub_categories)>15)
                                <li id="menu-item-6596" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-6596"><a href="{{ route('categories', $category->slug) }}">View More</a></li>
                                @endif
                            </ul>
                            @endif
                           </li>
                          @endforeach
                          @if(count($group->categories)>9)
                          <li id="menu-item-6596" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-6596"><a href="{{ route('group_categories', $group->id) }}">View More</a></li>
                          @endif
                        </ul>
                        @endif
                     </li>
                     @endforeach

                     <li id="menu-item-6599" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-6599">
                        <a class="header-menu-white" href="{{ route('all_categories') }}">More</a>
                    </li>


                     <!-- <li id="menu-item-6604" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6604"><a href="../contacts/index.html">Contacts</a></li> -->
                  </ul>
               </div>
            </nav>
            <!-- .main-navigation -->
         </div>
         <!-- .site-header-menu -->
      </div>
      <!-- .site-header-main -->
   </div>
</div>