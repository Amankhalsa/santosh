@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($sub_category->category_meta_title)) ? $sub_category->category_meta_title : "Category Meta Title";
 $meta_description = (!empty($sub_category->category_meta_description)) ? $sub_category->category_meta_description : "Category Meta Description";
 $meta_keywords = (!empty($sub_category->category_meta_keywords)) ? $sub_category->category_meta_keywords : "Category Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}

 @section('content')

 <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div class="row">
    <nav class="woocommerce-breadcrumb">
    <a href="{{url('/')}}">Homes</a>
    <span class="delimiter">
    <i class="tm tm-breadcrumbs-arrow-right"></i>
    </span>{{$sub_category->category_name}}
    </nav>
    <!-- .woocommerce-breadcrumb -->
    <div id="primary" class="content-area">
    <main id="main" class="site-main">
    <section class="section-product-categories">
    <header class="section-header">
    <h1 class="woocommerce-products-header__title page-title">{{$sub_category->category_name}} Categories</h1>
    </header>
    <div class="woocommerce columns-5">
    <div class="product-loop-categories">

@foreach($products as $product)
    
  <div class="product-category product first">
  <a href="{{url('/'.$main_category->category_slug_name.'/'.$sub_category->category_slug_name.'/'.$product->category_slug_name.'.html')}}">

  @if(!empty($product->category_image_name))  
  <img src="{{asset('uploaded_files/finalcat/'.$product->category_image_name)}}" style="width: 100%;height: 200px;">
  @else
  <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:200px;" alt="products" title="products" class="rounded"/>
  @endif

      <h2 class="woocommerce-loop-category__title"> {{$product->category_name}}
          <mark class="count">(5)</mark>
      </h2>
  </a>
  </div>

 @endforeach   

    </div>
    <!-- .product-loop-categories -->
    </div>
    <!-- .woocommerce -->
    </section>

    <!-- .section-products-carousel -->
    </main>
    <!-- #main -->
    </div>

    </div>
    <!-- .row -->
    </div>
    <!-- .col-full -->
    </div>
    <!-- #content -->
    <div class="col-full">
    @include('index-brands')

    </div>

 @endsection
