<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

  <title>@yield('title') - Luxury Eye Wear</title>

  <style>
      #loader {
      /*border: 5px solid #f3f3f3;*/
      /*border-radius: 50%;*/
      /*border-top: 5px solid skyblue;*/
      width: 30px;
      height: 30px;
      /*animation: spin 1s linear infinite;*/
      } 
      .center {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}
  </style>
</head>

<body>

<img src="{{asset('assets/images/loader.gif')}}" class=" center" alt=" loader" id="loader"  >
@include('frontend.body.header')
 
<!-- content  -->

@yield('content')
<!-- content  -->



<!-- footer  -->
@include('frontend.body.footer')
<!-- footer -->

<div class="backDrop"></div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('assets/js/script.js')}}"></script>
  <script>
    var swiper = new Swiper(".logoSwiper", {
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
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

// ============ loader =============
document.onreadystatechange = function() {
	if (document.readyState !== "complete") {
	document.querySelector(
	"body").style.visibility = "hidden";
	document.querySelector(
	"#loader").style.visibility = "visible";
	} else {
	document.querySelector(
	"#loader").style.display = "none";
	document.querySelector(
	"body").style.visibility = "visible";
	}
	};

</script>



</body>
</html>
