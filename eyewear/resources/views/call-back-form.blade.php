<?php ?>                                                                                                                                                                                                                         
<div class="alert alert-success alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{ session('form_success') }}
</div>
@endif 
      
<div class="side-bar">
<h3>Request A Call Back</h3>
<div class="Side-bar-inner">
<form id="" method="post" action="{{url('/call-back-form')}}" role="form" onsubmit="return checkValidationdd()" enctype="multipart/form-data">
@csrf
@method('POST')

<div class="controls">

<input type="hidden" name="source" value="{{Request::path()}}">

<div class="row">
<div class="col-12">
<div class="form-group">
<input type="text" name="unamedd" id="unamedd" class="form-control" placeholder="Your Name *" style="position: relative;" onkeyup="errName();">
<div class="help-block with-errors" id="nameErr"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="form-group">
<input type="text" name="uemaildd" id="uemaildd" class="form-control" placeholder="Your email *" style="position: relative;" onkeyup="errEmail();">
<div class="help-block with-errors" id="emailErr"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
 <div class="form-group">
<input type="text" name="uphonedd" id="uphonedd" maxlength="10" class="form-control" placeholder="Your phone No*" style="position: relative;" onkeyup="errPhone();">
<div class="help-block with-errors" id="phoneErr"></div>
</div>
</div>
</div>


<div class="row">
<div class="col-12">
<div class="form-group">
<textarea  class="form-control" name="umessagedd" id="umessagedd" style="resize:none;position:relative; height:80px;" onkeyup="errMsg();" placeholder="Message"></textarea>
<div class="help-block with-errors" id="msgErr"></div>
</div>
</div>
</div>

<div class="row">
<div class="col-4">
<div class="form-group">

<input placeholder="Enter Captcha" type="text" id="captcha" class="form-control" style="position:relative;" onkeyup="errCaptcha();" maxlength="4" />
<div class="help-block with-errors" id="captchaErr"></div>

</div> 
</div>

<div class="col-4">
<div class="form-group">
<input type="text" size="5" readonly placeholder="Captcha" id="txtCaptcha" 
    style="background-image:url('/images/captcha.jpg'); text-align:center; border:none;
    font-weight:bold; font-family:Modern" />
   
</div> 
</div>

<div class="col-4">
<div class="form-group">
    <i style="color:darkgrey;font-size:19px;cursor: pointer;" class="fa fa-refresh" onclick="DrawCaptcha();"></i>
</div>

</div>
</div>

<div class="row">
<div class="col-12">
<input type="submit" class="btn btn-success btn-send" value="Send Message" name="submit">
</div></div>


<div class="messages"></div>


</div>

</form>
</div>
</div>

<script type="text/javascript">
  // Remove the spaces from the entered and generated code
    function removeSpaces(string)
    {
        return string.split(' ').join('');
    }
         function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 9)+ '';
        var b = Math.ceil(Math.random() * 9)+ '';       
        var c = Math.ceil(Math.random() * 9)+ '';  
        var d = Math.ceil(Math.random() * 9)+ '';  
        
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d;
        document.getElementById("txtCaptcha").value = code
    }
     DrawCaptcha();


         function trimfield(str) 
        { 
            return str.replace(/^\s+|\s+$/g,''); 
        }
    function checkValidationdd(){
        var i=0,flag=0;
        var name=document.getElementById("unamedd");
        var phone=document.getElementById("uphonedd");
        var email=document.getElementById("uemaildd");
        var message=document.getElementById("umessagedd");
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var captcha = removeSpaces(document.getElementById('captcha').value);

        if(name.value==""){
            $('#nameErr').css({"color":"red"});
            $('#nameErr').html("Enter your name !");
            $('#unamedd').css({"border-color":"red"});
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "0px"},"fast");
            
            name.focus();
            return false;
        }if(name.value.length<3){
            $('#nameErr').css({"color":"red"});
            $('#nameErr').html("Name must be 3 chars long !");
             $('#unamedd').css({"border-color":"red"});
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "0px"},"fast");
            name.focus();
            return false;
        }if (/[0-9]/g.test(name.value)) {
            $('#nameErr').css({"color":"red"});
            $('#nameErr').html("Numbers are not allow !");
                 $('#unamedd').css({"border-color":"red"});
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "-5px"},"fast");
            $("#unamedd").animate({left: "5px"},"fast");
            $("#unamedd").animate({left: "0px"},"fast");
                name.focus();
                return false;
        }
        if(email.value==""){
            $('#emailErr').css({"color":"red"});
            $('#emailErr').html("Enter your email !");
             $('#uemaildd').css({"border-color":"red"});
            $("#uemaildd").animate({left: "-5px"},"fast");
            $("#uemaildd").animate({left: "5px"},"fast");
            $("#uemaildd").animate({left: "-5px"},"fast");
            $("#uemaildd").animate({left: "5px"},"fast");
            $("#uemaildd").animate({left: "-5px"},"fast");
            $("#uemaildd").animate({left: "5px"},"fast");
            $("#uemaildd").animate({left: "0px"},"fast");
            email.focus();
            return false;            
        }if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
            $('#emailErr').css({"color":"red"});
            $('#emailErr').html("Invalid email !");
             $('#uemaildd').css({"border-color":"red"});
            $("#uemaildd").animate({left: "-5px"},"fast");
            $("#uemaildd").animate({left: "5px"},"fast");
            $("#uemaildd").animate({left: "-5px"},"fast");
            $("#uemaildd").animate({left: "5px"},"fast");
            $("#uemaildd").animate({left: "-5px"},"fast");
            $("#uemaildd").animate({left: "5px"},"fast");
            $("#uemaildd").animate({left: "0px"},"fast");
            email.focus();
            return false;
        }if(phone.value==""){
             $('#phoneErr').css({"color":"red"});
            $('#phoneErr').html("Enter your mobile no !");
             $('#uphonedd').css({"border-color":"red"});
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "0px"},"fast");
            phone.focus();
            return false;
        }if(isNaN(phone.value)){
             $('#phoneErr').css({"color":"red"});
            $('#phoneErr').html("characters are not allow !");
             $('#uphonedd').css({"border-color":"red"});
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "0px"},"fast");
            phone.focus();
            return false;
        }if(phone.value.length<10 || phone.value.length>10){
             $('#phoneErr').css({"color":"red"});
            $('#phoneErr').html("Mobile no must be 10 digits long !");
             $('#uphonedd').css({"border-color":"red"});
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "-5px"},"fast");
            $("#uphonedd").animate({left: "5px"},"fast");
            $("#uphonedd").animate({left: "0px"},"fast");
            phone.focus();
            return false; 
        }if(trimfield(message.value)==""){
            $('#msgErr').css({"color":"red"});
            $('#msgErr').html("Enter message detail !");
             $('#umessagedd').css({"border-color":"red"});
            $("#umessagedd").animate({left: "-5px"},"fast");
            $("#umessagedd").animate({left: "5px"},"fast");
            $("#umessagedd").animate({left: "-5px"},"fast");
            $("#umessagedd").animate({left: "5px"},"fast");
            $("#umessagedd").animate({left: "-5px"},"fast");
            $("#umessagedd").animate({left: "5px"},"fast");
            $("#umessagedd").animate({left: "0px"},"fast");
            message.focus();
            return false;
        }if(captcha==""){
             $('#captchaErr').css({"color":"red"});
            $('#captchaErr').html("Enter captcha !");
            $('#captcha').css({"border-color":"red"});
            $("#captcha").animate({left: "-5px"},"fast");
            $("#captcha").animate({left: "5px"},"fast");
            $("#captcha").animate({left: "-5px"},"fast");
            $("#captcha").animate({left: "5px"},"fast");
            $("#captcha").animate({left: "-5px"},"fast");
            $("#captcha").animate({left: "5px"},"fast");
            $("#captcha").animate({left: "0px"},"fast");
            $("#captcha").focus();
            return false;
        }if (str1 != captcha){
            $('#captchaErr').css({"color":"red"});
            $('#captchaErr').html("You entered wrong captcha !");
            $('#captcha').css({"border-color":"red"});
            $("#captcha").animate({left: "-5px"},"fast");
            $("#captcha").animate({left: "5px"},"fast");
            $("#captcha").animate({left: "-5px"},"fast");
            $("#captcha").animate({left: "5px"},"fast");
            $("#captcha").animate({left: "-5px"},"fast");
            $("#captcha").animate({left: "5px"},"fast");
            $("#captcha").animate({left: "0px"},"fast");
            $("#captcha").focus();
            return false;
        }
    }
    
    function errName(){
        $('#unamedd').css({"border-color":"#49aecc"});
        $('#nameErr').html("");
    }
    function errEmail(){
        $('#uemaildd').css({"border-color":"#49aecc"});
        $('#emailErr').html("");
    }
    function errPhone(){
        $('#uphonedd').css({"border-color":"#49aecc"});
        $('#phoneErr').html("");
    }
     function errMsg(){
        $('#umessagedd').css({"border-color":"#49aecc"});
        $('#msgErr').html("");
    }
    function errCaptcha(){
        $('#captcha').css({"border-color":"#49aecc"});
        $('#captchaErr').html("");
    }
   
    </script>