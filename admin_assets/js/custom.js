// FUNCTION FOR CHECKBOX VALIDATION
var btn="";
$('.req_for').click(function(){
 btn=$(this).val();
});
function checkboxValidation(){
   if(btn!="Update Order"){
    if($("[id='ids[]']:checked").length <= 0){
        Swal.fire({
            icon:'warning',
            html:'Please select atleast one !',
            confirmButtonText: "Ok",
            customClass: 'swal-wide',
          });
        return false;
    }}
   }




$(document).ready(function() {
  // FUNCTION FOR ACCEPT ONLY NUMERIC VALUE FOR MOBILE NO IN ::MANAGE USERS::
    $(".user-mobile").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) { // let it happen, don't do anything
      }else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault();
            }}
    });

$('#bologna-list a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})

});

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// FUNCTION FOR DELETE USER VIA AJAX ::MANAGE USERS::
function delete_user(id,site_url){
  var url=site_url+"/admin/manage-users/delete";
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
       $.ajax({
         url:url,
         type:"POST",
         data: {id:id},
         success:function(data){
          Swal.fire({
            title: 'Deleted',
            icon: 'success'
          }).then((result) => {
            window.location.href=site_url+"/admin/manage-users";
          })

         }
       });
      }
    })

  }

     // FUNCTION FOR CHANGE USER PASSWORD VIA AJAX ::MANAGE USERS::
  function change_user_password(id,site_url){
    let new_password,confirm_password="";
    var url=site_url+"/admin/manage-users/change-password";
    Swal.mixin({
      input: 'password',
      confirmButtonText: 'Next &rarr;',
      showCancelButton: true,
      progressSteps: ['1', '2'],
      inputValidator: (value) => {
        return !value && "you can't leave this field blank!"
      }
    }).queue([
      {
        title: 'Change Password',
        text: 'Enter New Password'
      },
      {
        title: 'Change Password',
        text: 'Enter Confirm Password'
      }
    ]).then((result) => {
      if (result.value) {
        const answers = JSON.stringify(result.value)
        var data = answers.replace(/[&\/\\#+()$~%.'":*?<>[\]{}]/g, '');
        data = data.split(',');

        // START AJAX
        $.ajax({
          url:url,
          type:"POST",
          dataType:"text",
          data: {id:id,new_password:data[0],confirm_password:data[1]},
          success:function(data){

            if(data==0){
              Swal.fire({
                icon:'error',
                title: 'Error!',
                text:'Invalid format for Old Password',
                confirmButtonText: 'Ok'
              })
            }else if(data==1){
              Swal.fire({
                icon:'error',
                title: 'Error!',
                text:'Your Old Password is Invalid',
                confirmButtonText: 'Ok'
              })
            }else if(data==2){
              Swal.fire({
                icon:'error',
                title: 'Error!',
                text:'Invalid format for New Password',
                confirmButtonText: 'Ok'
              })
            }else if(data==3){
              Swal.fire({
                icon:'error',
                title: 'Error!',
                text:"Old & New Password can't be same",
                confirmButtonText: 'Ok'
              })
            }else if(data==4){
              Swal.fire({
                icon:'error',
                title: 'Error!',
                text:'Invalid format for Confirm Password',
                confirmButtonText: 'Ok'
              })
            }else if(data==5){
              Swal.fire({
                icon:'error',
                title: 'Error!',
                text:"New & Confirm Password does'nt match",
                confirmButtonText: 'Ok'
              })
            }else if(data==6){
              Swal.fire({
                icon:"success",
                title: 'Password Changed successfully...!',
                confirmButtonText: 'Ok'
              })
            }
           //window.location.href="manage-users";
          }
        });

      }
    })
  }

    // FUNCTION FOR DISPLAY ADMIN ROLES ::MANAGE USERS::

    function admin_roles(roles){
      var roles_list="";
      if(roles.includes(1)){
        roles_list="# Manage Site Pages";
      }if(roles.includes(2)){
        roles_list+="<br> # Manage Frame";
      }if(roles.includes(3)){
        roles_list+="<br> # Manage Users";
      }if(roles.includes(4)){
        roles_list+="<br> # Manage Slider";
      }if(roles.includes(5)){
        roles_list+="<br> # Manage Testimonial";
      }if(roles.includes(6)){
        roles_list+="<br> # Manage Our Team";
      }if(roles.includes(7)){
        roles_list+="<br> # Manage Client Logo";
      }if(roles.includes(8)){
        roles_list+="<br> # Manage Enquiry";
      }if(roles.includes(9)){
        roles_list+="<br> # Contact Update";
      }if(roles.includes(10)){
        roles_list+="<br> # Change Password";
      }if(roles.includes(11)){
        roles_list+="<br> # Social Links";
      }if(roles.includes(12)){
        roles_list+="<br> # Manage Blog";
      }if(roles.includes(13)){
        roles_list+="<br> # Manage Registration";
      }if(roles.includes(14)){
        roles_list+="<br> # Manage Order";
      }if(roles.includes(15)){
        roles_list+="<br> # Manage Invoice";
      }if(roles.includes(16)){
        roles_list+="<br> # Manage Coupon";
      }if(roles.includes(17)){
        roles_list+="<br> # Product Color";
      }if(roles.includes(18)){
        roles_list+="<br> # Manage Rating";
      }if(roles.includes(19)){
        roles_list+="<br> # Manage Subscriber";
      }if(roles.includes(20)){
        roles_list+="<br> # Manage Vision";
      }if(roles.includes(21)){
        roles_list+="<br> # Manage Lens";
      }if(roles.includes(22)){
        roles_list+="<br> # Prescription Type";
      }if(roles.includes(23)){
        roles_list+="<br> # Attribute Type";
      }if(roles.includes(24)){
        roles_list+="<br> # Lens Color";
      }if(roles.includes(25)){
        roles_list+="<br> # Lens Brand";
      }if(roles.includes(26)){
        roles_list+="<br> # Lens Toggle";
      }if(roles.includes(27)){
        roles_list+="<br> # Lens Index";
      }if(roles.includes(28)){
        roles_list+="<br> # Manage Currency";
      }if(roles.includes(29)){
        roles_list+="<br> # Uploaded Prescription";
      }
      Swal.fire({
        title: 'Admin Roles:',
        html:"<font style='color:green'>"+roles_list+"</font>"
      })
    }

    // FUNCTION FOR DISPLAY ENQUIRY MESSAGE ::MANAGE ENQUIRY::

    function enquiry_msg(enq_msg){
        Swal.fire({
           title: 'Enquiry Message:',
           html: "<font style='color:darkgrey'>"+enq_msg+"</font>",
           customClass: 'swal-wide'
        })
    }

 // FUNCTION FOR CHANGE STATE DYNAMICALLY
    function getStates(site_url){
    var cid = $('#country').val();
    var url=site_url+"/admin/manage-registration/get-states";
    if(cid){
    $.ajax({
    type:"post",
    url:url,
    dataType:"json",
    data:{cid:cid}, 
    success:function(res)
    {       
        if(res)
        {
            $("#state").empty();
            $("#state").append('<option>Select State</option>');
            $.each(res,function(key,value){
                $("#state").append('<option value="'+key+'">'+value+'</option>');
            });
        }
    },error:function(res){
      alert(res)
    }

    });
    }
    }

function editColor(color_id,color_name,color_code){
    $('.color_code').val(color_code);
    $('.color_name').val(color_name);
    $('.color_id').val(color_id);
    $('#addColorModal').modal();
  }

  function popupWindow(url, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

  function colorTypeDetail(site_url){
    var cid = $('#color_type_id').val();
    var url=site_url+"/admin/manage-lens/get-colors";
    if(cid){
    $.ajax({
    type:"post",
    url:url,
    data:{cid:cid}, 
    success:function(res)
    {
        $('#color_tint').html(res);
    },error:function(res){
      alert(res)
    }

    });
    }
    }
    
    function getCoating(site_url){
        brand_id=$('#brand_id').val();
        if(brand_id){
            $.ajax({
                url:site_url+"/admin/manage-lens/get-coating",
                type:"get",
                data:{brand_id:brand_id},
                success:function(res){
                    $('#coating_section').html(res);
                },error:function(res){
                    
                }
            });
        }
    }
    
  