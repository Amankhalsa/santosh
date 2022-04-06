@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Payment Options Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Payment Options Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Payment Options Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}

 @section('content')
<div class="sun-breadcrumb-01 pt-5">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">{{$meta_tag->page_name}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="privacy-page pt-5">
  <div class="container">
    <div class="row">
     
     <div class="col-lg-12 text-center">
         <h3><b>{{$meta_tag->page_name}}</b></h3>
         {!!$meta_tag->page_content!!}
     </div>

    </div>  
  </div>
    </div>
 @endsection
