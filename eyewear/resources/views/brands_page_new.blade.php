@extends('layouts.app')
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Eyewear Brands";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Eyewear Brands Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Eyewear Brands Meta Keywords";
@endphp
 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)
 <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/'.$admin_data->admin_favicon) }}">
 
@section('content')
 
 
<section>
    <div class="brand_banner">
      <div class="container">
        <div class="brand_banner_content">
          <div class="brand_banner_content_text text-center">
            <h1 class="brand_bannner_head">Eyewear Brands</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumbStyle justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('home.page')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Brands</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="brand_logo_section pb-0">
      <div class="container">
    <b>  Total Brand:<span class="">{{count($brand_img)}}</span></b>

        <div class="brand_logo_list">
          <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-2 justify-content-center">
              @foreach($brand_img as $brand)
              
            <div class="col">
              <div class="brand_logo_link">
                <a href="{{$brand->url}}" class="blankLink" target="_blank">
                <img src="{{asset($brand->image)}}" alt="..."></a>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </section>  
        <div class="btnCol text-center">
              <a href="" class=""></a>
            </div>
 
  @endsection