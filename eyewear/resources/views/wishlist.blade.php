@extends('layouts.app')



 @section('title',"Wishlist")
 @section('description',"Wishlist")
 @section('keywords',"Wishlist")

 {{-- Meta tag Section End --}}

 @section('content')

    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div class="row">
    <nav class="woocommerce-breadcrumb">
    <a href="{{url('/')}}">Home</a>
    <span class="delimiter">
    <i class="tm tm-breadcrumbs-arrow-right"></i>
    </span>Wishlist
    </nav>
    <!-- .woocommerce-breadcrumb -->
    <div id="primary" class="content-area">
    <main id="main" class="site-main">

@auth('user')

    <section class="section-product-categories">
    <header class="section-header">
    <h1 class="woocommerce-products-header__title page-title">Wishlist</h1>
    </header>
    <div class="woocommerce columns-5">
    <div class="product-loop-categories">
@php
 $wishlists = DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->get();
@endphp
@foreach($wishlists as $wishlist)
 @php
  $product_data = DB::table('categories')->where('id',$wishlist->product_id)->first();
  $finalcat_data = DB::table('categories')->where('id',$product_data->category_parent_id)->first();
  $subcat_data = DB::table('categories')->where('id',$finalcat_data->category_parent_id)->first();
 @endphp

  <div class="product-category product first">
      @if(isset($subcat_data->category_slug_name) && isset($product_data->category_slug_name) && isset($subcat_data->category_slug_name))
  <a href="{{url('/'.$subcat_data->category_slug_name.'/'.$finalcat_data->category_slug_name.'/'.$product_data->category_slug_name.'.html')}}">
    @endif
  @if(!empty($product_data->category_image_name))  
  <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" style="width: 100%;height: 200px;">
  @else
  <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:200px;" alt="products" title="products" class="rounded"/>
  @endif

      <h2 class="woocommerce-loop-category__title"> {{$product_data->category_name}}
          <span><a href="{{url('/remove-wishlist',$wishlist->id)}}"><i class="fas fa-times-circle" title="Remove from wishlist"></i></a></span>
      </h2>
  </a>
  </div>

 @endforeach   

    </div>
    <!-- .product-loop-categories -->
    </div>
    <!-- .woocommerce -->
    </section>

@else

Please Login first to see wishlist

@endauth

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
