
  <footer>
    <div class="footer_section">
      <div class="footer_fade"></div>
        <div class="container">
          <div class="newsletter_content newsletter_space_section">
            <h2 class="whiteColor">NEWSLETTER</h2>
            <p class="whiteColor">Once you subscribe to our newsletter, we will send our promo offers and  news to your email.</p>
            <div class="subscribe_col">
              <input class="sub_input_style" type="text" placeholder="ENTER YOUR EMAIL" name="email" id="subscriber_email">
              <button class="sub_btn_style" type="button" type="submit" onclick="addSubscriber()">SUBSCRIBE US</button>
            </div>
          </div>
        </div>
        <div class="bottom_footer darkBGColor">
          <div class="container">
            <div class="row gy-5">
              <div class="col-xl-auto col-lg-12 col-sm-12 ">
                <div class="foot_logo_content">
                  <div class="footer_logo">
                    <a href="{{url('/')}}"><img src="{{asset('uploaded_files/assets/images/footer_new_logo.png')}}" alt="..."></a>
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
                          <li><a href="tel:{{$admin_data->admin_mobile}}"><img src="{{asset('uploaded_files/assets/images/phone-icon.svg')}}" alt="..." style="width:30px;">9990360806</a></li>
                          <li><a href="mailto:{{$admin_data->admin_email}}"><img src="{{asset('uploaded_files/assets/images/email_icon.svg')}}" alt="..." style="width:30px;">Support@Luxuryeyewear.In</a></li>
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



<section class="modal" id="product-preview">
<div class="modal-dialog modal-lg product-modal container">
<div class="modal-content row product-content">
</div>
</div>
</section>
<!-- / Product Preview Popup -->

<!-- Enquiry Popup -->
<section class="modal" id="enquiry-popup">
<div class="modal-dialog modal-lg container">
<div class="modal-content row">

<a aria-hidden="true" data-dismiss="modal" class="sb-close-btn close icon_close" href="#">
<i class="far fa-times-circle"></i>
</a>              
<!-- Single Products Slider Starts --> 
<section>
<div class=" container-fluid">
<div class="row contact-info">
    <div class="col-md-12 left-col">
    <div class="text-block">
    <h2 class="contact-page-title">Leave us a Message</h2>
    <hr>
          </div>
    <div class="contact-form">
    <div role="form" class="wpcf7" id="wpcf7-f425-o1" lang="en-US" dir="ltr">
    <div class="screen-reader-response"></div>
    
<form class="wpcf7-form" method="post" action="{{url('/contact-form-submit')}}" role="form" enctype="multipart/form-data" name="contact-form-popup">
    @csrf
  
    
<input type="hidden" name="source" value="{{Request::path()}}">

<div class="form-group row">
<div class="col-xs-12 col-md-12">
<label>Name
<abbr title="required" class="required">*</abbr>
</label>
<br>
<span class="wpcf7-form-control-wrap first-name">
<input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" name="name">
</span>
</div>
<!-- .col -->
<div class="col-xs-12 col-md-6">
<label>Mobile No.
<abbr title="required" class="required">*</abbr></label>
<br>
<span class="wpcf7-form-control-wrap email">
<input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" name="mobile" maxlength="10">
</span>
</div>
<!-- .col -->
<div class="col-xs-12 col-md-6">
    <!-- .form-group -->
<div class="form-group">
<label>Email
  <abbr title="required" class="required">*</abbr>
</label>
<br>
<span class="wpcf7-form-control-wrap email">
<input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" name="email">

</span>
</div>
</div>

<div class="col-xs-12 col-md-12">
<!-- .form-group -->
<div class="form-group">
<label>Your Message</label>
<br>
<span class="wpcf7-form-control-wrap your-message">
<textarea aria-invalid="false" class="wpcf7-form-control wpcf7-textarea" rows="5" cols="40" name="message"></textarea>
</span>
</div>
<!-- .form-group-->

</div>
</div>


    <div class="form-group clearfix">
        <p>
            <input type="submit" value="Send Message" class="wpcf7-form-control wpcf7-submit" />
        </p>
    </div>
    <!-- .form-group-->
    <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
    
    </div>
    
    </div>
    
    </div>
    
    </div>
</div>
</section>    
    
</div>
</div>
</section>
<!-- / Enquiry Popup -->



<div class="modal" id="viewPrescription">
<div class="modal-dialog">
<div class="modal-content view-prescription">
</div>
</div>
</div>

<!-- JAVASCRIPT FILES -->
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src='https://unpkg.com/splitting@1.0.5/dist/splitting.min.js'></script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
<script type="text/javascript" src="{{asset('webslidemenu/webslidemenu.js')}}"></script>
<script type="text/javascript">var site_url='{{$admin_data->admin_website_url}}';</script>
<script type="text/javascript" src="{{asset('js/owl-carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cart.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.ui.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.elevatezoom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/buywithlens.js')}}"></script>
<script type="text/javascript" src="{{asset('js/filter.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fe2f30ff8e0d2001b2cfd4f&product=inline-share-buttons" async="async"></script>
<script type="text/javascript" src="{{asset('js/nice-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/multistep.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.fancybox.min.js')}}"></script>



<script>

enquiryPopup = () =>{
   $('#enquiry-popup').modal()
}

let element = $("#multistep");

element.multistep({
navigation: {
  onSend: function() {
     $.ajax({
         type: "POST",
         url: "mail.php",
         data: element.serialize(),
         dataType: 'json'
     }).done(function(data) {
         if (data.success) {
             alert('Thank you for contacting us.')
         } else {
             alert('Something went wrong, please try again.')
         }
     });
  }
}
})
</script>

<script>
    {{-- For Success --}}
    var success_msg = '{{Session::get('success_msg')}}';
    var success_msg_exist = '{{Session::has('success_msg')}}';
    if(success_msg_exist){
      Swal.fire({
      text: success_msg,
      icon: 'success'
    })
    $('.my-cart,.off_canvars_overlay').addClass('active')
    }
    
     {{-- For error --}}
    var error_msg = '{{Session::get('error_msg')}}';
    var error_msg_exist = '{{Session::has('error_msg')}}';
    if(error_msg_exist){
      Swal.fire({
      text: error_msg,
      icon: 'error'
    })
    }
    
  



    
    
</script>

<script>
        $(document).ready(function () {
            $('input[name=product_id]').val()
            var product = $('input[name=product_id]').val();
            var token = $('input[name=_token]').val();
            $('.add_to_wishlist').on('click',function(){
                var wishlist_mssg;
                $(this).addClass('disabled')
                wishlist_mssg = $(this).parents('.row').next('.row')
                $('.wish_list_mssg').text('');
                $.ajax({
                type: "POST",
                url: "{{route('add_to_wishlist')}}",
                data: { product_id:product,_token: token}, 
                success: function( result ) {
                    $('.add_to_wishlist').removeClass('disabled')
                    var mssg = wishlist_mssg.find('.wish_list_mssg')
                    if(result.status == 0){
                        mssg.addClass('text-danger').text(result.message)
                    }
                    if(result.status == 1){
                        
                        mssg.addClass('text-success').text(result.message)
                    }
                    if(result.status == 2){
                        
                        mssg.addClass('text-warning').text(result.message)
                    }
                    
                    //alert( msg );
                }
            });    
            })
            
        })
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{asset('js/contact-validation.js')}}"></script>
<!-- JAVASCRIPT FILES -->
<script>
    $(document).ready(function(){
  $("#pre").click(function(){
    $("#prescr").slideToggle();
  });
});
</script>
<!--========== new js ===========-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('js/new/bootstrap.bundle.min.js')}}"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('js/new/script.js')}}"></script>
 
  <script>
    var swiper = new Swiper(".logoSwiper", {
           autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      slidesPerView: 1,
      spaceBetween: 5,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
          375: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          480: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 4,
            spaceBetween: 10,
          },
          1200: {
            slidesPerView: 5,
            spaceBetween: 10,
          },
        },
    });
  </script>

  <script>
    var swiper = new Swiper(".testimonialSlider", {
              autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      spaceBetween: 30,
      effect: "fade",
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
  <script>
    var swiper = new Swiper(".bannerSlider", {
      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
    
    // loader


	$(document).ready(function(){
    //     $('.mySwiper .swiper-slide').hover(function() {
    //         $('.swiper-button-next').click();
            
    //   });
      
       $('#thumb .swiper-slide').hover(function() {
      $( this ).trigger( "click" );
   });

    });
	
</script>

 
<!--============= new js end =============-->
<!-------------------------------------->


</body>

</html>
