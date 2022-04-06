@extends('layouts.app')


@section('title',"Meta for {$search_keyword}")
@section('description',"Meta for {$search_keyword}")
@section('keywords',"Meta for {$search_keyword}")

{{-- Meta tag Section End --}}

@section('content')
<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">

<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">{{$search_keyword}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="">
    <div class="container-fluid pl-0 pr-0">
        <div class="row">
<div class="col-12">
<div class="product-banner">
<img src="{{asset('img/luxury-search.jpg')}}" style="width:100%">
</div>
</div>
</div>
    </div>
<div class="container-fluid">
<div class="row">

<div class="col-lg-12">
    

<div class="row">
<div class="col-lg-12">
<div class="search-refine">

</div>
</div>
</div>

<div class="row text-center">
    <div class="col-12 text-left mt-5 mb-5">
        <h3><b>Search Result for "{{$search_keyword}}"</b></h3>
        <hr>
    </div>
@foreach($search_result as $product)
 @php
  $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
 @endphp
<div class="col-lg-3 col-12 cate-box">
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
<p>{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)}} 
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

<div class="sun-pagination">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="">

</div>
<div class="col-lg-6">
<ul class="pagination">
{{$search_result->links()}}
</ul>



</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


@endsection
