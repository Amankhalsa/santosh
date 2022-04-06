$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


/* Add To Wishlist Function */

function addWishlist(product_id){
  $.ajax({
    url:site_url+"/add-wishlist",
    type:"post",
    dataType:"json",
    data:{product_id:product_id},
    success:function(response){
      if(response.status==0){
        Swal.fire({
         title: 'Error',
         text: "Please login first!",
         icon: 'error'
        })
      }else if(response.status==1){
        Swal.fire({
         title: 'Success',
         text: "Product added in Wishlist!",
         icon: 'success',
         allowOutsideClick: false
        }).then((result) => {
      if (result.value) {
       window.location.href=window.location;
      }
    })
      }else if(response.status==2){
        Swal.fire({
         title: 'Warning',
         text: "Product already exist in Wishlist!",
         icon: 'warning'
        })
      }
    },error:function(response){
      alert(response)
    }
  });
}


/* Add To Cart */

 function addCart(product_id){
  $.ajax({
    url:site_url+"/add-to-cart",
    type:"post",
    dataType:"json",
    data:{product_id:product_id},
    success:function(response){
      if(response.status==1){
        /*$('#total-price').html(response.total_price);
        $('#total-cart').html(response.total_cart);
        Swal.fire({
         title: 'Success',
         text: "Product added in Cart!",
         icon: 'success'
        })*/

        window.location.href=site_url+"/checkout.html";


      }
    },error:function(response){
      alert(response)
    }
  });
}


 function removeCartItem(cart_id){
  $.ajax({
    url:site_url+"/add-to-cart/remove-cart-item",
    type:"post",
    dataType:"json",
    data:{cart_id:cart_id},
    success:function(response){
      $('#total-price').html(response.total_price);
      $('#total-cart').html(response.total_cart);
        Swal.fire({
         title: 'Success',
         text: "Product removed from Cart!",
         icon: 'success'
        })

/* Load Mini Cart */

    $.ajax({
      url:"/add-to-cart/load",
      type:"post",
      success:function(response){
        $('#mini-cart').html(response);
      },error:function(response){
        alert(response);
      }

    });
    },error:function(response){
      alert(response)
    }
  });
 }


/* Lens Cart Section */

function addLensCart(product_id){
 var prd_qty = $('.prd_qty').val();
 var url = site_url+"/buy-with-lens/"+product_id+"/"+prd_qty;
 window.location.href=url;
}

function getPrescription(vision_id,func_type="add"){
   $('.add_right').val("");
   $('.add_left').val("");    
   $('.vision_id').val(vision_id);
   if(vision_id==3){
      $('.add_right').attr('disabled',true).val("");
      $('.add_left').attr('disabled',true).val("");
   }else{
      $('.add_right').attr('disabled',false);
      $('.add_left').attr('disabled',false);
   }
    $.ajax({
     url:site_url+"/get-vision-price",
     type:"post",
     dataType:"json",
     data:{vision_id:vision_id},
     success:function(res){
      if(res.is_power=="Yes"){
        tokkenset('first-card');
        $("#second-nav").removeClass('disabled');
      }else{
        tokkenset('second-card'); 
        document.getElementById("first-nav").classList.remove("navactive");
        $("#second-nav").addClass('disabled');
      }
            
     },error:function(res){
         alert(res)
     }
    });
   
}

function getLensBrands(is_tint,subcolor_id,func_type="add"){
  var lens_color_id=$('#tintval'+subcolor_id).val();
  
  var product_id=$('.product_id').val();
  var qty=$('.qty').val();
  var vision_id=$('.vision_id').val();
  
/*****************/  
  
  $.ajax({
    url:site_url+"/get-lens-brands",
    type:"post",
    data:{lens_color_id:lens_color_id,vision_id:vision_id,product_id:product_id,qty:qty,is_tint:is_tint},
    success:function(res){
        
      $('.view-lens-brands').html(res);
     
    },error:function(){
      alert(res);
    }
  });
}

function getLenses(lens_brand,lens_color_id1,is_tint,func_type="add"){
  var lens_color_id="";
  if(is_tint=="tint"){
      lens_color_id=$('.tint_color').val();
  }else{
     lens_color_id=lens_color_id1;
  }
  
  var product_id=$('.product_id').val();
  var qty=$('.qty').val();
  var vision_id=$('.vision_id').val();
  
/*****************/  
  
  $.ajax({
    url:site_url+"/get-lenses",
    type:"post",
    data:{lens_brand:lens_brand,lens_color_id:lens_color_id,vision_id:vision_id,product_id:product_id,func_type:func_type,qty:qty,is_tint:is_tint},
    success:function(res){
        
     /* $('#lens_brands_tab').removeClass('btn-info active').addClass('btn-default');
      $('#lens_tab').removeClass('btn-default disabled').addClass('btn-info'); 
      $('[href="#lens"]').tab('show');*/
        
      $('.view-lenses').html(res);
     
    },error:function(){
      alert(res);
    }
  });
}

 function prescription(func_type){

  var is_prescription_upload = $('.is_prescription_upload').val();
if(is_prescription_upload=="No"){  
 var pupillary_distance_left="";
 var pupillary_distance_right ="";
 var pupillary_distance ="";
  var sph_right = $('.sph_right').val();
  var sph_left = $('.sph_left').val();
  var cyl_right = $('.cyl_right').val();
  var cyl_left = $('.cyl_left').val();
  var axis_right = $('.axis_right').val();
  var axis_left = $('.axis_left').val();
  var add_right = $('.add_right').val();
  var add_left = $('.add_left').val();
  var is_pd2 = $('.is_pd2').val();
  var prescription_comment = $('.prescription_comment').val();

  if((sph_right>0 && sph_left<0) || (sph_left>0 && sph_right<0)){
      Swal.fire({
     title: 'Oops!',
     text: "That's unusual! For most people, both eyes have either negative ( - ) or positive ( + ) SPH values. Are you sure your prescription shows both?",
     icon: 'warning'
    })
  }
  
  // PRISM PRESCRIPTION
 var is_prism = $('.is_prism').val();
 var prism_right_vertical = $('.prism_right_vertical').val();
 var prism_right_vertical_direction = $('.prism_right_vertical_direction').val();
 var prism_right_horizontal = $('.prism_right_horizontal').val();
 var prism_right_horizontal_direction = $('.prism_right_horizontal_direction').val();
 
 var prism_left_vertical = $('.prism_left_vertical').val();
 var prism_left_vertical_direction = $('.prism_left_vertical_direction').val();
 var prism_left_horizontal = $('.prism_left_horizontal').val();
 var prism_left_horizontal_direction = $('.prism_left_horizontal_direction').val();
 
  if(is_pd2=="Yes"){
    pupillary_distance_right = $('.pupillary_distance_right').val();  
    pupillary_distance_left = $('.pupillary_distance_left').val();
  }else{
     pupillary_distance = $('.pupillary_distance').val(); 
  }
  
 if((cyl_right=="0.00" || cyl_right=="plano") && (cyl_left=="0.00" || cyl_left=="plano") && (sph_right=="0.00" || sph_left=="0.00")){
    Swal.fire({
     title: 'Oops!',
     text: "Enter SPH!",
     icon: 'warning'
    })
  }else if($(".axis_right").prop('disabled') == false && $(".axis_right").val()==""){
     Swal.fire({
     title: 'Oops!',
     text: "Enter Axis Right!",
     icon: 'warning'
    })
  }else if($(".axis_left").prop('disabled') == false && $(".axis_left").val()==""){
     Swal.fire({
     title: 'Oops!',
     text: "Enter Axis Left!",
     icon: 'warning'
    }) 
  }
  else if($("[class='prism_checkbox']:checked").length > 0 && $('.prism_right_vertical').val()==""){
    Swal.fire({
     title: 'Oops!',
     text: "Please choose prism value!",
     icon: 'warning'
    }) 
  }else if($("[class='prism_checkbox']:checked").length > 0 && $('.prism_right_vertical_direction').val()==""){
    Swal.fire({
     title: 'Oops!',
     text: "Please choose vertical base direction!",
     icon: 'warning'
    }) 
  }else if($("[class='prism_checkbox']:checked").length > 0 && $('.prism_right_horizontal').val()!="" && $('.prism_right_horizontal_direction').val()==""){
    Swal.fire({
     title: 'Oops!',
     text: "Please choose horizontal base direction!",
     icon: 'warning'
    }) 
  }
  
  else if($("[class='prism_checkbox']:checked").length > 0 && $('.prism_left_vertical').val()!="" && $('.prism_left_vertical_direction').val()==""){
    Swal.fire({
     title: 'Oops!',
     text: "Please choose prism value!",
     icon: 'warning'
    }) 
  }else if($("[class='prism_checkbox']:checked").length > 0 && $('.prism_left_horizontal').val()!="" && $('.prism_left_horizontal_direction').val()==""){
    Swal.fire({
     title: 'Oops!',
     text: "Please choose horizontal base direction!",
     icon: 'warning'
    }) 
  }else if(is_pd2=="Yes" && (pupillary_distance_right=="" || pupillary_distance_left=="")){
     Swal.fire({
     title: 'Oops!',
     text: "Please select your pupillary distance (PD).Pupillary distance or PD is the distance from the center of the pupil in one eye to the center of the pupil in the other eye.",
     icon: 'warning'
    }) 
  }
  else{
//CHECK SPH & CYL LIMIT   
/*var prd_id = $('.product_id').val();
  $.ajax({
      url:site_url+"/check-prescription",
      type:"get",
      data:{prd_id:prd_id,sph_right:sph_right,sph_left:sph_left,cyl_right:cyl_right,cyl_left:cyl_left},
      success:function(res){
        alert(res)  
      },error:function(res){
        alert(res)  
      }
  }); 
   exit;*/
    $.ajax({
      url:site_url+"/add-prescription",
      type:"post",
      data:{func_type:func_type,is_prescription_upload:is_prescription_upload,sph_right:sph_right,sph_left:sph_left,cyl_right:cyl_right,cyl_left:cyl_left,axis_right:axis_right,axis_left:axis_left,add_right:add_right,add_left:add_left,pupillary_distance:pupillary_distance,pupillary_distance_right:pupillary_distance_right,pupillary_distance_left:pupillary_distance_left,is_pd2:is_pd2,is_prism:is_prism,prism_right_vertical:prism_right_vertical,prism_right_vertical_direction:prism_right_vertical_direction,prism_right_horizontal:prism_right_horizontal,prism_right_horizontal_direction:prism_right_horizontal_direction,prism_left_vertical:prism_left_vertical,prism_left_vertical_direction:prism_left_vertical_direction,prism_left_horizontal:prism_left_horizontal,prism_left_horizontal_direction:prism_left_horizontal_direction,prescription_comment:prescription_comment},
      success:function(res){
       tokkenset('second-card')
      },error:function(res){
        alert(res) 
      }
    });
  }
 }else{
 var formData = new FormData($('.upload_prescription_form')[0]);
 formData.append('func_type', func_type);

 $.ajax({
      url:site_url+"/add-prescription",
      type:"post",
      processData: false,
      contentType: false,
      data:formData,
      success:function(res){ 
        tokkenset('second-card')
      },error:function(res){
        alert(res+"Error") 
      }
    });
 }
}

 function reviewCart(func_type,lens_id,product_id,qty,lens_color_id,is_tint){
     
    var coating_ids="";
    var coating_len = $("[name='coatings[]']:checked").length;  
    if(coating_len>0){
     var i=1;
        $('input[name="coatings[]"]:checked').each(function(){
        if(i == 1){
        coating_ids = $(this).val();
        } else{
        coating_ids += ","+$(this).val();
        }
        i++;
        });
    }
    
     $.ajax({
         url:site_url+"/review-cart",
         type:"post",
         data:{func_type:func_type,lens_id:lens_id,product_id:product_id,qty:qty,lens_color_id:lens_color_id,is_tint:is_tint,coating_ids:coating_ids},
         success:function(res){
          $('.review-cart').html(res);
         }
     });
 }

$(document).ready(function() {
    $(".upload_prescription").change(function(){
      $('.hide-prescription-fields').fadeOut();
      $('.mobile_no').fadeIn();
      $('.is_prescription_upload').val('Yes');
    });
});    


 function productPreview(product_id){
     $.ajax({
         url:site_url+"/product-preview",
         type:"post",
         data:{product_id:product_id},
         success:function(res){
            $('.product-content').html(res);
            $('#product-preview').modal();
         },error:function(res){
             alert(res)
         }
     });
 }

 
 function setTint(tint_color,subcolor_id){
     $('#tintval'+subcolor_id).val(tint_color)
 }

/* Apply Coupon */

  function applyCoupon(){
   var coupon_code = $('#coupon_code').val();
   if(coupon_code==""){
        Swal.fire({
         title: 'Oops!',
         text: "Please enter coupon code!",
         icon: 'error'
        })
   }else{

   $.ajax({
    url:site_url+"/apply-coupon",
    type:"post",
    dataType:"json",
    data:{coupon_code:coupon_code},
    success:function(res){
      if(res.condition == "Nologin"){
        Swal.fire({
          title: 'Please login first!',
          icon: 'warning',
        })
      }
      else if(res.condition == "InvalidCode"){
        Swal.fire({
          title: 'Invalid Coupon Code!',
          icon: 'warning',
        })
      }
      else if(res.condition == "Used"){
        Swal.fire({
          title: 'Coupon is already used',
          icon: 'warning',
        })
      }else if(res.condition == "Invalid"){
        Swal.fire({
          title: 'Coupon not applied',
          icon: 'error',
        })
      }else if(res.condition == "Valid"){
        Swal.fire({
          title: 'Coupon applied',
          icon: 'success',
        }).then((result) => {
          window.location.href=site_url+"/cart.html";
        })
      }
    },error:function(res){
      alert(res)
    }
   });
 }
 }

 function isPrism(){
    if($("[class='prism_checkbox']:checked").length > 0){
      $('.is_prism').val('Yes');
    }else{
        $('.is_prism').val('No');
    }
  }
  
  $(document).ready(function(){
      if($('.cyl_right').val()=="0.00" || $('.cyl_right').val()=="Plano"){
          $('.axis_right').attr('disabled',true);
      }else{
          $('.axis_right').attr('disabled',false);
      }
      
      if($('.cyl_left').val()=="0.00" || $('.cyl_left').val()=="Plano"){
          $('.axis_left').attr('disabled',true);
      }else{
          $('.axis_left').attr('disabled',false);
      }
  
  $('.cyl_right').change(function(){
      if($(this).val()=="0.00" || $(this).val()=="Plano"){
          $('.axis_right').attr('disabled',true);
      }else{
          $('.axis_right').attr('disabled',false); 
      }
  });
  
  $('.cyl_left').change(function(){
      if($(this).val()=="0.00" || $(this).val()=="Plano"){
          $('.axis_left').attr('disabled',true);
      }else{
          $('.axis_left').attr('disabled',false); 
      }
  });
      
  });
  
  
  