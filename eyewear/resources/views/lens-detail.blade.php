@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($product_data->category_meta_title)) ? $product_data->category_meta_title : "{$product_data->name} Meta Title";
$meta_description = (!empty($product_data->category_meta_description)) ? $product_data->category_meta_description : "{$product_data->name} Meta Description";
$meta_keywords = (!empty($product_data->category_meta_keywords)) ? $product_data->category_meta_keywords : "{$product_data->name} Meta Keywords";
@endphp

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('og')
<meta property="og:title" content="{{ $product_data->name}}" />
<meta property="og:url" content="{{ url('/lens/'.$product_data->slug_name.'.html')}}" />
<meta property="og:image" content="{{asset('uploaded_files/lens/'.$product_data->lens_image_name)}}" />
<meta property="og:description" content="{{ $product_data->description}}" />
<meta property="og:site_name" content="{{ $admin_data->admin_company_name}}" />
@endsection

{{-- Meta tag Section End --}}

@section('content')

<div class="sun-breadcrumb-01">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<h1>{{$product_data->name}}</h1>
<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">{{$product_data->name}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>




<section>
<div class=" container">
<div class="row">

<div class="col-lg-6">                                  
<div class="thumbnail-wrap">
<div class="thumbnail">
<div class="thumbnail-img light-bg">


<div class="flipper" style="display: block; width: 220px;">

 <div class="">
      @if(!empty($product_data->lens_image_name))  
      <a href="{{url('/lens/'.$product_data->slug_name.'.html')}}">  <img src="{{asset('uploaded_files/lens/'.$product_data->lens_image_name)}}"></a>
      @else
      <a href="{{url('/frame/'.$product_data->slug_name.'.html')}}"> <img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt=""> </a>
      @endif
      </div>


<div class="sale-tag right"> <span> sale </span> </div>

</div>
</div>
</div>
</div>                  
</div>

<div class="col-lg-6">
<div class="modal-right">
<h2>{{$product_data->name}}</h2>
<div class="modal_price mb-10">
<span class="new_price">₹{{$product_data->price}}</span>    
<!--<span class="old_price">₹78.99</span> -->   
</div>
<div class="modal_description mb-15">
<p>{!!$product_data->description!!}</p>    
</div>

<div class="modal_social">
    <h2>Share this product</h2>
<div class="sharethis-inline-share-buttons"></div>    
</div>

</div>
</div>

</div>
</div>
</section>


@endsection
