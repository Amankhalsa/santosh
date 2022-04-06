<!--<div class="padd-nee-002">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-4 col-12" style="padding-left:5px; padding-right:5px;">-->
<!--                <div class="img-effect">-->
<!--                    <a href="{{url('/gentle-man.html')}}">-->
<!--                        <img src="img/man.jpg">-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="image_description">-->
<!-- <h3 style="color:#fff">Gentle Man</h3><p style="color:#fff">Happy glasses</p> </div>-->
<!--            </div>-->
            
<!--            <div class="col-lg-4 col-12" style="padding-left:5px; padding-right:5px;" >-->
<!--                <div class="img-effect">-->
<!--                    <a href="{{url('/woman.html')}}">-->
<!--                        <img src="img/woman.jpg">-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="image_description">-->
<!-- <h3>Woman</h3><p>Happy glasses</p> </div>-->
<!--            </div>-->
            
<!--            <div class="col-lg-4 col-12" style="padding-left:5px; padding-right:5px;">-->
<!--                <div class="img-effect">-->
<!--                    <a href="{{url('/junior.html')}}">-->
<!--                        <img src="img/kids.jpg">-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="image_description">-->
<!-- <h3>Junior</h3><p>Happy glasses</p> </div>-->
<!--            </div>-->
            
            
            
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


@if($eyeglasses->isNotEmpty())
<div class="sun-head padd-nee-002 pro-he">
    <div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-12">
<div class="sunglass-heading">
<h2>Eyeglasses</h2>
</div>
</div>
</div>


<div class="row">


@foreach($eyeglasses as $product)
 @php
  $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
 @endphp

    <div class=" col-md-3">
    <div class="thumbnail-wrap">
<div class="thumbnail" style="height:300px;">
    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
<div class="thumbnail-img light-bg">


<div class="flipper" >

<div class="front">
@if(!empty($product->category_image_name))    
<img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}"  >
@else
<img  src="{{ asset('admin_assets/images/no_image.jpg') }}" alt="" >
@endif
</div>
<div class="back">
@if(!empty($product->category_image_name2))    
<img src="{{asset('uploaded_files/product/'.$product->category_image_name2)}}" >
@else
<img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt="" >
@endif
</div>

@if($product['category_is_discount']=="Yes")      
 <div class="sale-tag right"> <span> {{$product['category_discount']}}% </span> </div>
@endif

</div>

</div>
<div class="sun-product-detail">
<span style="font-family: utopia-std,Charter,Georgia,serif;
    font-weight: 600;
    line-height: calc(1em + 6px);
    margin-top: 0;
    margin-bottom: 0;
    font-size: 20px;
    color: #414B56;
    margin-bottom: 0px;">{{$brand->category_name}}</span><br>
<a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
<span style="color: #212121;
    font-family: Nunito,sans-serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 2px;
    text-transform: uppercase;
"> {{Str::limit($product->category_name,17,$end='...')}}</span>
</a>
<p>
{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)}} 
@if($product->category_is_discount=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}}</strike>
@endif
</p>
@php
$get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
@endphp
<div class="product-color">

@php
 $group_ids = explode(',',$product->category_group_ids);
 $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
 $i=1;
@endphp
@if(!empty($product->category_group_ids))  

@foreach($group_prd as $group)
 @php
$color_data = DB::table('product_colors')->where('id',$group->category_color)->first(); 
 @endphp    
<a href="{{url('/frame/'.$group->category_slug_name.'.html')}}" class="pro-ibtn  btn-tool @if($group->category_slug_name==$product->category_slug_name) color-btn @endif ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>
@php
  $i++;
 @endphp   
@endforeach
@else

<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="pro-ibtn  btn-tool color-btn ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>

@endif
</div>
</div>
</a>
</div>
</div>
    </div>
@endforeach

</div>

<div class="row">
    <div class="col-lg-4 col-4"></div>
    <div class="col-lg-4 col-4">
<a href="{{url('/eyeglasses/men')}}" class="viewall-btn">Shop Now &nbsp; <i class="fa fa-angle-right"></i></a>
</div>
<div class="col-lg-4 col-4"></div>
</div>
</div>

</div>

@endif





