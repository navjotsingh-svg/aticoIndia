   <footer id="colophon" class="site-footer">
   <div class="footer_inner_wrapper footer ts-bg ts-bgcolor-grey ts-bgimage-no py-3">
      <div class="site-footer-bg-layer ts-bg-layer"></div>
      <div class="site-footer-w">
         <div class="footer-rows">
            <div class="footer-rows-inner">
               <div id="second-footer" class="sidebar-container second-footer ts-bg ts-bgcolor-transparent ts-textcolor-dark ts-bgimage-no" role="complementary">
                  <div class="second-footer-bg-layer ts-bg-layer"></div>
                  <div class="container">
                     <div class="second-footer-inner">
                        <div class="row multi-columns-row">
                           <div class="col-lg-12 col-md-12">
                              <div id="nav_menu-7" class="widget_nav_menu block footer-widget mb-4 mb-lg-0">
                                 @foreach(getGroups() as $key => $group)
                                 <div class="new_class">
                                    <h4 class="footer-nav-title text-light">{!! $group->name !!}</h4>
                                    <div class="menu-our-solutions-container">
                                       <ul id="menu-our-solutions" class="menu">
                                          @if(isset($group->categories))
                                          @foreach($group->categories as $key => $category)
                                          <li id="menu-item-587" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-587">
                                             <a href="{{ route('categories', $category->slug) }}">{!! isset($category->short_name)?$category->short_name:$category->name !!}</a>
                                          </li>
                                          @if(isset($category->sub_categories))
                                          @foreach($category->sub_categories as $key => $sub_category)
                                          <li id="menu-item-587" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-587">
                                             <a href="{{ route('categories', $sub_category->slug) }}">{!! isset($sub_category->short_name)?$sub_category->short_name:$sub_category->name !!}</a>
                                          </li>
                                          @endforeach
                                          @endif
                                          @endforeach
                                          @endif
                                       </ul>
                                    </div>
                                 </div>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                        <!-- .row.multi-columns-row -->
                     </div>
                     <!-- .second-footer-inner -->
                  </div>
                  <!--  -->
               </div>
               <!-- #secondary -->
            </div>
            <!-- .footer-inner -->
         </div>
         <!-- .footer -->
         <!-- <div id="bottom-footer-text" class="bottom-footer-text ts-bottom-footer-text site-info  ts-bg ts-bgcolor-transparent ts-textcolor-dark ts-bgimage-no">
            <div class="bottom-footer-bg-layer ts-bg-layer"></div>
            <div class="container">
               <div class="bottom-footer-inner">
                  <div class="row multi-columns-row">
                     <div class="col-xs-12 col-sm-12 ts-footer2-left ">
                        Copyright © 2018 <a href="../index.html">LabtechCO</a>. All rights reserved.
                     </div>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</footer>


<div class="copyright">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 footer_bottom">
        <h5 class="my-2">AticoIndia © <?= date('Y') ?> </h5>
        <p>Atico India is providing its services to following countries: Afghanistan, Albania, Algeria, American Samoa, Andorra, Angola, Anguilla, Antigua & Barbuda, Argentina, Armenia, Aruba, Australia, Austria, Azerbaijan, Bahamas, Bahrain, Bangladesh, Barbados, Belarus, Belgium, Belize, Benin, Bermuda, Bhutan, Bolivia, Bonaire, Bosnia & Herzegovina, Botswana, Brazil, British Indian Ocean Ter, Brunei, Bulgaria, Burkina Faso, Burundi, Cambodia, Cameroon, Canada, Canary Islands, Cape Verde, Cayman Islands, Central African Republic, Chad, Channel Islands, Chile, China, Christmas Island, Colombia, Cocos Island, Comoros, Congo, Cook Islands, Costa Rica, Cote DIvoire, Croatia, Cuba, Curacao, Cyprus, Czech Republic, Denmark, Djibouti, Dominica, Dominican Republic, East Timor, Ecuador, Egypt, El Salvador, Equatorial Guinea, Eritrea, Estonia, Ethiopia, Falkland Islands, Faroe Islands, Fiji, Finland, France, French Guiana, French Polynesia, French Southern Ter, Gabon, Gambia, Georgia, Germany, Ghana, Gibraltar, Great Britain, Greece, Greenland, Grenada, Guadeloupe, Guam, Guatemala, Guinea, Guyana, Haiti, Hawaii, Honduras, Hong Kong, Hungary, Iceland, India, Indonesia, Iran, Iraq, Ireland, Isle of Man, Israel, Italy, Jamaica, Japan, Jordan, Kazakhstan, Kenya, Kiribati, Korea North, Korea South, Kuwait, Kyrgyzstan, Laos, Latvia, Lebanon, Lesotho, Liberia, Libya, Liechtenstein, Lithuania, Luxembourg, Macau, Macedonia, Madagascar, Malaysia, Malawi, Maldives, Mali, Malta, Marshall Islands, Martinique, Mauritania, Mauritius, Mayotte, Mexico, Midway Islands, Moldova, Monaco, Mongolia, Montserrat, Morocco, Mozambique, Myanmar, Nambia, Nauru, Nepal, Netherland Antilles, Netherlands (Holland, Europe), Nevis, New Caledonia, New Zealand, Nicaragua, Niger, Nigeria, Niue, Norfolk Island, Norway, Oman, Pakistan, Palau Island, Palestine, Panama, Papua New Guinea, Paraguay, Peru, Philippines, Pitcairn Island, Poland, Portugal, Puerto Rico, Qatar, Republic of Montenegro, Republic of Serbia, Reunion, Romania, Russia, Rwanda, St Barthelemy, St Eustatius, St Helena, St Kitts-Nevis, St Lucia, St Maarten, St Pierre & Miquelon, St Vincent & Grenadines, Saipan, Samoa, Samoa American, San Marino, Sao Tome & Principe, Saudi Arabia, Senegal, Serbia, Seychelles, Sierra Leone, Singapore, Slovakia, Slovenia, Solomon Islands, Somalia, South Africa, Spain, Sri Lanka, Sudan, Suriname, Swaziland, Sweden, Switzerland, Syria, Tahiti, Taiwan, Tajikistan, Tanzania, Thailand, Togo, Tokelau, Tonga, Trinidad & Tobago, Tunisia, Turkey, Turkmenistan, Turks & Caicos Is, Tuvalu, Uganda, Ukraine, United Arab Emirates, United Kingdom, United States of America, Uruguay, Uzbekistan, Vanuatu, Vatican City State, Venezuela, Vietnam, Virgin Islands (Brit), Virgin Islands (USA), Wake Island, Wallis & Futana Is, Yemen, Zaire, Zambia, Zimbabwe
        </p>
      </div>
      <div class="col-md-8">
        <div class="block copyright-content mb-2 mb-md-0">
          <ul class="footer_bottom_menu pl-0 mb-2">
            <li><a href="{{ route('about_us_page') }}">About us</a></li>
            <li><a href="{{ route('certificate_page') }}">Certificates</a></li>
            <li><a href="{{ route('lab_tender_page') }}">Lab Tenders</a></li>
            <li><a href="{{ route('faq_page') }}">FAQ</a></li>
            <li><a href="{{ route('terms_page') }}">Terms & Privacy</a></li>
            <li><a href="{{ route('blog_page') }}">Blog</a></li>
            <li><a href="{{ route('contact_us_page') }}">Contact</a></li>
          </ul>
          <p class="m-0 text-light">
            Copyrights © <?= date('Y') ?> All Rights Reserved by
            <a class="company-name activeColor text-uppercase" href="{{ route('home') }}">Atico</a>
          </p>
          
        </div>
      </div>
      <div class="col-md-4">
        <div class="block social-media d-flex justify-content-center  justify-content-md-end">
          <a class="ct-facebook d-flex justify-content-center align-items-center" href="https://www.facebook.com/aticoexport" target="_self">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a class="ct-twitter d-flex justify-content-center align-items-center" href="https://twitter.com/aticoindia" target="_self">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a class="ct-linkedin d-flex justify-content-center align-items-center" href="https://www.linkedin.com/in/aticoexport/" target="_self">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
          </a>
          <a class="ct-skype d-flex justify-content-center align-items-center" href="https://www.pinterest.com/aticoexports/" target="_self">
            <i class="fa fa-pinterest-p" aria-hidden="true"></i>
          </a>
          <a class="ct-instagram d-flex justify-content-center align-items-center" href="https://www.instagram.com/aticoindia/" target="_self">
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

       <script type="text/javascript">
         setTimeout(
  function() 
  {
    $("#mobileno").attr("name","mobile_no");
  }, 10000);
          
       </script>