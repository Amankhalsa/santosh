var tokkenfornav=1;
$(document).ready(function(){
    $(".putdown1").click(function(){
        $(".puttingdown1").slideToggle();
        $(".puttingdown2").slideUp();
        $(".puttingdown3").slideUp();
        $(".puttingdown4").slideUp();
        $(".puttingdown5").slideUp();
        $(".puttingdown6").slideUp();
    });
    $(".putdown2").click(function(){
        $(".puttingdown2").slideToggle();
        $(".puttingdown1").slideUp();
        $(".puttingdown3").slideUp();
        $(".puttingdown4").slideUp();
        $(".puttingdown5").slideUp();
        $(".puttingdown6").slideUp();
    });
    $(".putdown3").click(function(){
        $(".puttingdown3").slideToggle();
        $(".puttingdown1").slideUp();
        $(".puttingdown2").slideUp();
        $(".puttingdown4").slideUp();
        $(".puttingdown5").slideUp();
        $(".puttingdown6").slideUp();
    });
    $(".putdown4").click(function(){
        $(".puttingdown4").slideToggle();
        $(".puttingdown1").slideUp();
        $(".puttingdown2").slideUp();
        $(".puttingdown3").slideUp();
        $(".puttingdown5").slideUp();
        $(".puttingdown6").slideUp();
    });
    $(".putdown5").click(function(){
        $(".puttingdown5").slideToggle();
        $(".puttingdown1").slideUp();
        $(".puttingdown2").slideUp();
        $(".puttingdown3").slideUp();
        $(".puttingdown4").slideUp();
        $(".puttingdown6").slideUp();
    });
    $(".putdown6").click(function(){
        $(".puttingdown6").slideToggle();
        $(".puttingdown1").slideUp();
        $(".puttingdown2").slideUp();
        $(".puttingdown3").slideUp();
        $(".puttingdown4").slideUp();
        $(".puttingdown5").slideUp();
    });
    $("#check-pd").click(function(){
        $("#showpd1").toggle();
        $("#showpd2").toggle();
    })
    $("#togprism").click(function(){
        $("#prismadd").toggle();
    })
    $('select').on('change', function() {
        // var e=$("#sph_right");
        // var r=$("#sph_left");
        var f=$("#cyl_right");
        var g=$("#cyl_left");
        // if(e.val()!=0 && r.val()!=0)
        // {
        //     $('#pressubmit').show();
        // }
        // else if(e.val()==0 || r.val()==0)
        // {
        //     $('#pressubmit').hide();
        // }
        if(f.val()!=0)
        {
            $('#axis_right').removeAttr('disabled');
        }
        else if(f.val()==0)
        {
            $('#axis_right').attr('disabled',true);
        }
        if(g.val()!=0)
        {
            $('#axis_left').removeAttr('disabled');
        }
        else if(g.val()==0)
        {
            $('#axis_left').attr('disabled',true);
        }
     });  
     
});
function bynavtokken(x)
{
    var first=document.getElementById("first-nav");
    var second=document.getElementById("second-nav");
    var third=document.getElementById("third-nav");
    var fourth=document.getElementById("fourth-nav");
    var fifth=document.getElementById("fifth-nav");
    var sixth=document.getElementById("sixth-nav");
    if(x==first.getAttribute("id") && (tokkenfornav==1 || tokkenfornav==2 || tokkenfornav==3 || tokkenfornav==4 || tokkenfornav==5 || tokkenfornav==6))
    {
       first.classList.add("navactive");
       second.classList.remove("navactive");
       third.classList.remove("navactive");
       fourth.classList.remove("navactive");
       fifth.classList.remove("navactive");
       sixth.classList.remove("navactive");
       document.getElementById("first-card").style.display="block";
       document.getElementById("second-card").style.display="none";
       document.getElementById("third-card").style.display="none";
       document.getElementById("fourth-card").style.display="none";
       document.getElementById("fifth-card").style.display="none";
       document.getElementById("sixth-card").style.display="none";
    }
    if(x==second.getAttribute("id") && (tokkenfornav==2 || tokkenfornav==3 || tokkenfornav==4 || tokkenfornav==5 || tokkenfornav==6))
    {
        first.classList.remove("navactive");
       second.classList.add("navactive");
       third.classList.remove("navactive");
       fourth.classList.remove("navactive");
       fifth.classList.remove("navactive");
       sixth.classList.remove("navactive");
       document.getElementById("first-card").style.display="none";
       document.getElementById("second-card").style.display="block";
       document.getElementById("third-card").style.display="none";
       document.getElementById("fourth-card").style.display="none";
       document.getElementById("fifth-card").style.display="none";
       document.getElementById("sixth-card").style.display="none";
    }
    if(x==third.getAttribute("id") && (tokkenfornav==3 || tokkenfornav==4 || tokkenfornav==5 || tokkenfornav==6))
    {
        first.classList.remove("navactive");
        second.classList.remove("navactive");
        third.classList.add("navactive");
        fourth.classList.remove("navactive");
        fifth.classList.remove("navactive");
        sixth.classList.remove("navactive");
        document.getElementById("first-card").style.display="none";
        document.getElementById("second-card").style.display="none";
        document.getElementById("third-card").style.display="block";
        document.getElementById("fourth-card").style.display="none";
        document.getElementById("fifth-card").style.display="none";
        document.getElementById("sixth-card").style.display="none";
    }
    if(x==fourth.getAttribute("id") && (tokkenfornav==4 || tokkenfornav==5 || tokkenfornav==6))
    {
        first.classList.remove("navactive");
        second.classList.remove("navactive");
        third.classList.remove("navactive");
        fourth.classList.add("navactive");
        fifth.classList.remove("navactive");
        sixth.classList.remove("navactive");
        document.getElementById("first-card").style.display="none";
        document.getElementById("second-card").style.display="none";
        document.getElementById("third-card").style.display="none";
        document.getElementById("fourth-card").style.display="block";
        document.getElementById("fifth-card").style.display="none";
        document.getElementById("sixth-card").style.display="none";
    }
    if(x==fifth.getAttribute("id") && (tokkenfornav==5 || tokkenfornav==6))
    {
        first.classList.remove("navactive");
        second.classList.remove("navactive");
        third.classList.remove("navactive");
        fourth.classList.remove("navactive");
        fifth.classList.add("navactive");
        sixth.classList.remove("navactive");
        document.getElementById("first-card").style.display="none";
        document.getElementById("second-card").style.display="none";
        document.getElementById("third-card").style.display="none";
        document.getElementById("fourth-card").style.display="none";
        document.getElementById("fifth-card").style.display="block";
        document.getElementById("sixth-card").style.display="none";
    }
    if(x==sixth.getAttribute("id") && tokkenfornav==6)
    {
        first.classList.remove("navactive");
        second.classList.remove("navactive");
        third.classList.remove("navactive");
        fourth.classList.remove("navactive");
        fifth.classList.remove("navactive");
        sixth.classList.add("navactive");
        document.getElementById("first-card").style.display="none";
        document.getElementById("second-card").style.display="none";
        document.getElementById("third-card").style.display="none";
        document.getElementById("fourth-card").style.display="none";
        document.getElementById("fifth-card").style.display="none";
        document.getElementById("sixth-card").style.display="block";
    }
}
function tokkenset(x)
{
    var first=document.getElementById("first-card");
    var second=document.getElementById("second-card");
    var third=document.getElementById("third-card");
    var fourth=document.getElementById("fourth-card");
    var fifth=document.getElementById("fifth-card");
    var sixth=document.getElementById("sixth-card");
    if(x==first.getAttribute("id"))
    {
        tokkenfornav=2;
       first.style.display="none";
       second.style.display="block";
       third.style.display="none";
       fourth.style.display="none";
       fifth.style.display="none";
       sixth.style.display="none";
       document.getElementById("first-nav").classList.remove("navactive");
       document.getElementById("second-nav").classList.add("navactive");
    }
    if(x==second.getAttribute("id"))
    {
        tokkenfornav=3;
        first.style.display="none";
       second.style.display="none";
       third.style.display="block";
       fourth.style.display="none";
       fifth.style.display="none";
       sixth.style.display="none";
       document.getElementById("second-nav").classList.remove("navactive");
       document.getElementById("third-nav").classList.add("navactive");
    }
    if(x==third.getAttribute("id"))
    {
        tokkenfornav=4;
        first.style.display="none";
       second.style.display="none";
       third.style.display="none";
       fourth.style.display="block";
       fifth.style.display="none";
       sixth.style.display="none";
       document.getElementById("third-nav").classList.remove("navactive");
       document.getElementById("fourth-nav").classList.add("navactive");
    }
    if(x==fourth.getAttribute("id"))
    {
        tokkenfornav=5;
        first.style.display="none";
        second.style.display="none";
        third.style.display="none";
        fourth.style.display="none";
        fifth.style.display="block";
        sixth.style.display="none";
        document.getElementById("fourth-nav").classList.remove("navactive");
        document.getElementById("fifth-nav").classList.add("navactive");
    }
    if(x==fifth.getAttribute("id"))
    {
        tokkenfornav=6;
        first.style.display="none";
       second.style.display="none";
       third.style.display="none";
       fourth.style.display="none";
       fifth.style.display="none";
       sixth.style.display="block";
       document.getElementById("fifth-nav").classList.remove("navactive");
       document.getElementById("sixth-nav").classList.add("navactive");
    }
}
function setborder(x)
{
    $(".img-color").css("border","0");
    x.style.border = "1px solid black";
    x.style.borderRadius = "100%";
    $(".btn-color").removeAttr('disabled');
}
