  <footer>
    <div class="footer_section">
      <div class="footer_fade"></div>
        <div class="container">
          <div class="newsletter_content newsletter_space_section">
            <h2 class="whiteColor">NEWSLETTER</h2>
            <p class="whiteColor">Once you subscribe to our newsletter, we will send our promo offers and  news to your email.</p>
            <div class="subscribe_col">
              <input class="sub_input_style" type="text" placeholder="Enter Your Email">
              <button class="sub_btn_style" type="button" onclick="addSubscriber()">SUBSCRIBE US</button>
            </div>
          </div>
        </div>
        <div class="bottom_footer darkBGColor">
          <div class="container">
            <div class="row gy-5">
              <div class="col-xl-auto col-lg-12 col-sm-12 ">
                <div class="foot_logo_content">
                  <div class="footer_logo">
                    <a href="{{url('/')}}"><img src="{{asset('uploaded_files/assets/images/footer-logo.svg')}}" alt="..."></a>
                  </div>
                  <p class="whiteColor">Luxuryeyewear ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt ornare viverra.</p>
                  <ul class="foot_social_icon">
                    <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/foot_facebook_icon.svg')}}" alt="..."></a></li>
                    <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/foot_twitter_icon.svg')}}" alt="..."></a></li>
                    <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/foot_instagram_icon.svg')}}" alt="..."></a></li>
                    <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/foot_linkedin_icon.svg')}}" alt="..."></a></li>
                    <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/foot_youtube_icon.svg')}}" alt="..."></a></li>
                  </ul>
                </div>
              </div>
              <div class="col">
                <div class="footer_imp_links">
                  <div class="row gy-5">
                    <div class="col-sm col-lg">
                      <div class="imp_links_col">
                        <div class="imp_link_head">
                          <h3 class="foot_link_head_style">Quick Links</h3>
                        </div>
                        <ul class="foot_link_list">
                            
                            @php
$pages = DB::table('manage_pages')->where('page_status','Active')->where('set_for_footer','Yes')->orderBy('page_order_by')
->where(function($q) {
  $q->where('page_link','payment-options')
   ->orWhere('page_link','track-order')
   ->orWhere('page_link','find-a-store');
})->get();
@endphp  


 
 
 @foreach($pages as $page)
    <li><a href="{{url('/'.$page->page_link.'.html')}}">{{$page->page_name}}</a></li>
 @endforeach
   <!--policy-->
   @php
$pages = DB::table('manage_pages')->where('page_status','Active')->where('set_for_footer','Yes')->orderBy('page_order_by')
->where(function($q) {
  $q->where('page_link','return-and-exchange')
   ->orWhere('page_link','cancellation')
   ->orWhere('page_link','shipping')
   ->orWhere('page_link','privacy-policy')
   ->orWhere('page_link','terms-and-conditions');
})->get();
@endphp  

 @foreach($pages as $page)
    <li><a href="{{url('/'.$page->page_link.'.html')}}">{{$page->page_name}}</a></li>
 @endforeach
   <!--policy end-->
               
                        </ul>
                      </div>
                    </div>
                    <div class="col-sm col-lg">
                      <div class="imp_links_col">
                        <div class="imp_link_head">
                          <h3 class="foot_link_head_style">usefull links</h3>
                        </div>
                        <ul class="foot_link_list">
                          <li><a href="{{url('/')}}">home</a></li>
                          <li><a href="javascript:void(0)">about us</a></li>
                          <li><a href="javascript:void(0)">contact us</a></li>
                          <li><a href="javascript:void(0)">privacy policy</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-auto">
                      <div class="imp_links_col add_cont">
                        <div class="imp_link_head">
                          <h3 class="foot_link_head_style">Get In Touch</h3>
                        </div>
                        <ul class="foot_link_list contact">
                          <li><a href="javascript:void(0)">C-12 Paryavaran Complex Ignu Road New Delhi, Delhi - 110030, India</a></li>
                          <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/phone-icon.svg')}}" alt="..." style="width:30px;">9990360806</a></li>
                          <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/email_icon.svg')}}" alt="..." style="width:30px;">Support@Luxuryeyewear.In</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="copyright_col">
              <div class="row align-items-center gy-4">
                <div class="col-xl col-lg-12 ">
                  <div class="courier_logo justify-content-center">
                    <ul>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/dhl_icon.png')}}" alt="..."></a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/fedex_icon.png')}}" alt="..."></a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/ups_icon.png')}}" alt="..."></a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/aramex_icon.png')}}" alt="..."></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-xl-auto col-lg-12">
                  <div class="payment_method_logo">
                    <ul>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/visa.png')}}" alt="..."></a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/mastercard.png')}}" alt="..."></a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/american-express.png')}}" alt="..."></a></li>
                      <li><a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/paypal.png')}}" alt="..."></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-xl-auto col-md-12 order-xl-first">
                  <p class="mb-xl-0">Copyright © {{date('Y')}} by luxuryeyewear. All Rights reserved</p>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </footer>
<!--new footer-->
