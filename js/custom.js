// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 1250) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 function addSubscriber(){
 	var subscriber_email = $('#subscriber_email').val();
	if(subscriber_email!=""){
	 if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(subscriber_email)){
		 Swal.fire({
         title: 'Error',
         text: "Enter valid email!",
         icon: 'error'
        })
	 }else{
	 	$.ajax({
	 		url:"/add-subscriber",
	 		type:"post",
	 		data:{subscriber_email:subscriber_email},
	 		success:function(res){
	 			if(res==0){
					Swal.fire({
					title: 'Oops',
					text: "You are already subscribed!",
					icon: 'warning'
					})
	 			}else if(res==1){
	 				Swal.fire({
					title: 'Success',
					text: "Thankyou for subscribes us!",
					icon: 'success'
					})
	 			}
	 			$('#subscriber_email').val("");
	 		},error:function(res){
	 			alert(res)
	 		}
	 	});
	 }	
	}else{
		 Swal.fire({
         title: 'Error',
         text: "Enter your email!",
         icon: 'error'
        })
	}
 }


 function change_value(valuee){
   	document.getElementById("rating").value=valuee;	
	for(var i=1; i<=5; i++)
	{
		if(i<=valuee)
		{
			document.getElementById("rating_"+i).style.background = "orange";
		}else{
			document.getElementById("rating_"+i).style.background = "";
		}
		
	}
}

function rating_submit()
{
    var rating_value=document.getElementById("rating").value;
    if(rating_value=="")
    {
    	Swal.fire({
         title: 'Error',
         text: "Please give us rating!",
         icon: 'error'
        })  
    }else{
        $('#rating_form').attr('onsubmit','');
    }   
}

 // FUNCTION FOR CHANGE STATE DYNAMICALLY
    function getStates(){
    var cid = $('.country').val();
    var url=site_url+"/user/get-states";

    if(cid){
    $.ajax({
    type:"get",
    url:url,
    dataType:"json",
    data:{cid:cid}, 
    success:function(res)
    {       
        if(res)
        {
            $(".state").empty();
            $(".state").append('<option>Select State</option>');
            $.each(res,function(key,value){
                $(".state").append('<option value="'+key+'">'+value+'</option>');
            });
        }
    },error:function(res){
      alert(res)
    }

    });
    }
  }

     // FUNCTION FOR CHANGE STATE DYNAMICALLY
    function getStates1(){
    var cid = $('.country1').val();
    var url="/user/get-states";
    if(cid){
    $.ajax({
    type:"get",
    url:url,
    dataType:"json",
    data:{cid:cid}, 
    success:function(res)
    {       
        if(res)
        {
            $(".state1").empty();
            $(".state1").append('<option>Select State</option>');
            $.each(res,function(key,value){
                $(".state1").append('<option value="'+key+'">'+value+'</option>');
            });
        }
    },error:function(res){
      alert(res)
    }

    });
    }
    }

  function ship_addr_check(){
        if($("[id='ship-address-check']:checked").length > 0){
              $('#shipping-address').fadeIn();
        }else{
            $('#shipping-address').fadeOut();
        }

  }
  
  function popupWindow(url, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

$('#sunglass-frame').owlCarousel({
    loop:true,
    margin:0,
    items:4,
    dots: false,
    nav:false,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    responsive: {
		              0: {
		                items: 1
		                
		              },
		              768: {
		                items: 2
		              },
		              1170: {
		                items: 4
		              }
		            }
    
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[900])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});

$('#sunglass-related').owlCarousel({
    loop:true,
    margin:0,
    items:4,
    dots: false,
    nav:false,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    responsive: {
		              0: {
		                items: 2
		                
		              },
		              768: {
		                items: 2
		              },
		              1170: {
		                items: 4
		              }
		            }
    
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[900])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});

$('#eyeglass-frame').owlCarousel({
    loop:true,
    margin:0,
    items:5,
    dots: false,
    nav:false,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    responsive: {
		              0: {
		                items: 2
		              },
		              768: {
		                items: 2
		              },
		              1170: {
		                items: 5
		              }
		            }
    
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[900])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});

$('#sunglass').owlCarousel({
    loop:true,
    margin:0,
    items:5,
    dots: false,
    nav:false,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    responsive: {
		              0: {
		                items: 2
		              },
		              768: {
		                items: 2
		              },
		              1170: {
		                items: 5
		              }
		            }
    
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[900])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});


$('#testi').owlCarousel({
    loop:true,
    margin:0,
    items:4,
    dots: false,
    nav:false,
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    responsive: {
		              0: {
		                items: 2
		              },
		              768: {
		                items: 2
		              },
		              1170: {
		                items: 4
		              }
		            }
    
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[900])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});


/*---mini cart activation---*/
    $('.cart-btn > a').on('click', function(){
        $('.my-cart,.off_canvars_overlay').addClass('active')
    });
    
    $('.cart-close,.off_canvars_overlay').on('click', function(){
        $('.my-cart,.off_canvars_overlay').removeClass('active')
    });
    
/*---mini wishlist activation---*/
    $('.wishlist-btn > a').on('click', function(){
        $('.my-wishlist,.off_canvars_overlay').addClass('active')
    });
    
    $('.wishlist-close,.off_canvars_overlay').on('click', function(){
        $('.my-wishlist,.off_canvars_overlay').removeClass('active')
    });
	
	
	
	$('#sunglass-popup').owlCarousel({
    loop:true,
    margin:0,
    items:5,
    dots: false,
    nav:false,
    autoplay:false,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    responsive: {
		              0: {
		                items: 2
		              },
		              768: {
		                items: 2
		              },
		              1170: {
		                items: 5
		              }
		            }
    
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[900])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});

$(function(){
		
	$('#thumbnail li').click(function(){
		var thisIndex = $(this).index()
			
		if(thisIndex < $('#thumbnail li.active').index()){
			prevImage(thisIndex, $(this).parents("#thumbnail").prev("#image-slider"));
		}else if(thisIndex > $('#thumbnail li.active').index()){
			nextImage(thisIndex, $(this).parents("#thumbnail").prev("#image-slider"));
		}
			
		$('#thumbnail li.active').removeClass('active');
		$(this).addClass('active');

		});
	});

var width = $('#image-slider').width();

function nextImage(newIndex, parent){
	parent.find('li').eq(newIndex).addClass('next-img').css('left', width).animate({left: 0},600);
	parent.find('li.active-img').removeClass('active-img').css('left', '0').animate({left: -width},600);
	parent.find('li.next-img').attr('class', 'active-img');
}
function prevImage(newIndex, parent){
	parent.find('li').eq(newIndex).addClass('next-img').css('left', -width).animate({left: 0},600);
	parent.find('li.active-img').removeClass('active-img').css('left', '0').animate({left: width},600);
	parent.find('li.next-img').attr('class', 'active-img');
}

/* Thumbails */
var ThumbailsWidth = ($('#image-slider').width() - 18.5)/7;
$('#thumbnail li').find('img').css('width', ThumbailsWidth);



 !function ($) {

        "use strict"; // jshint ;_;

        /* MAGNIFY PUBLIC CLASS DEFINITION
         * =============================== */

        var Magnify = function (element, options) {
            this.init('magnify', element, options)
        }

        Magnify.prototype = {

            constructor: Magnify

            , init: function (type, element, options) {
                var event = 'mousemove'
                    , eventOut = 'mouseleave';

                this.type = type
                this.$element = $(element)
                this.options = this.getOptions(options)
                this.nativeWidth = 0
                this.nativeHeight = 0

                this.$element.wrap('<div class="magnify" \>');
                this.$element.parent('.magnify').append('<div class="magnify-large" \>');
                this.$element.siblings(".magnify-large").css("background", "url('" + this.$element.attr("src") + "') no-repeat");

                this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
                this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
            }

            , getOptions: function (options) {
                options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

                if (options.delay && typeof options.delay == 'number') {
                    options.delay = {
                        show: options.delay
                        , hide: options.delay
                    }
                }

                return options
            }

            , check: function (e) {
                var container = $(e.currentTarget);
                var self = container.children('img');
                var mag = container.children(".magnify-large");

                // Get the native dimensions of the image
                if (!this.nativeWidth && !this.nativeHeight) {
                    var image = new Image();
                    image.src = self.attr("src");

                    this.nativeWidth = image.width;
                    this.nativeHeight = image.height;

                } else {

                    var magnifyOffset = container.offset();
                    var mx = e.pageX - magnifyOffset.left;
                    var my = e.pageY - magnifyOffset.top;

                    if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                        mag.fadeIn(100);
                    } else {
                        mag.fadeOut(100);
                    }

                    if (mag.is(":visible")) {
                        var rx = Math.round(mx / container.width() * this.nativeWidth - mag.width() / 2) * -1;
                        var ry = Math.round(my / container.height() * this.nativeHeight - mag.height() / 2) * -1;
                        var bgp = rx + "px " + ry + "px";

                        var px = mx - mag.width() / 2;
                        var py = my - mag.height() / 2;

                        mag.css({ left: px, top: py, backgroundPosition: bgp });
                    }
                }

            }
        }


        /* MAGNIFY PLUGIN DEFINITION
         * ========================= */

        $.fn.magnify = function (option) {
            return this.each(function () {
                var $this = $(this)
                    , data = $this.data('magnify')
                    , options = typeof option == 'object' && option
                if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
                if (typeof option == 'string') data[option]()
            })
        }

        $.fn.magnify.Constructor = Magnify

        $.fn.magnify.defaults = {
            delay: 0
        }


        /* MAGNIFY DATA-API
         * ================ */

        $(window).on('load', function () {
            $('[data-toggle="magnify"]').each(function () {
                var $mag = $(this);
                $mag.magnify()
            })
        })

    }(window.jQuery);
    
    
    
    
    
    
    
    
    
    
    
    
    $(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        var href = $(e.target).attr('href');
        var $curr = $(".checkout-bar  a[href='" + href + "']").parent();

        $('.checkout-bar li').removeClass();

        $curr.addClass("active");
        $curr.prevAll().addClass("visited");


    });
    
});
   
function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
   
   
    function check_two_pd(){
        if($("[id='check-pd']:checked").length > 0){
              $('.is_pd2').val('Yes');
        }else{
            $('.is_pd2').val('No');
        }

  }

  viewPrescription = (cart_id)=>{
    if(cart_id){
     $.ajax({
         url:site_url+"/view-prescription",
         type:"get",
         data:{cart_id:cart_id},
         success:function(res){
             $('.view-prescription').html(res);
             $('#viewPrescription').modal();
         },error:function(res){
             alert(res)
         }
     });    
    }   
 }
  
  $('[data-fancybox="images"]').fancybox({
	thumbs : {
		autoStart : true
	}
});


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  e.target // newly activated tab
  e.relatedTarget // previous active tab
})


