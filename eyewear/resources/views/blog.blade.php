@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Blog Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Blog Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Blog Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}

 @section('content')

<style type="text/css">
	#main_section{
		margin-top: 50px;
		margin-bottom: 50px;
	}
</style>

 <div class="vastu-banner-respons">
<div class="container-fluid">
<div class="row top-banner">
<div class="col-12 banner">
<div class="vastu-banner">
<img src="{{asset('images/top-banner.jpg')}}" alt="">
<div class="vastu-banner-text">
<h1>{{$meta_tag->page_name}}</h1>
	<ul class="vastu-breadcrumb">
	<a href="{{url('/')}}"><li><i class="fas fa-home"></i> Home </li></a>
		<li><i class="fas fa-caret-right"></i></li>
		<a href="{{url('/blog.html')}}"><li>{{$meta_tag->page_name}}</li></a>
	</ul>
	</div>
</div>
</div>
</div>
</div>
</div>

<br> 
@if($blogs->isNotEmpty())

<div class="">
<div class="container-fluid ">
<div class="row">
<div class="col-lg-3 col-12">
<div class="rudra-heading">
<h2>{{$meta_tag->page_name}}</h2>
</div>
</div>
</div>


<div class="row">
 @foreach($blogs as $blog)   
    <div class="col-lg-3 col-6">
    <a href="{{url('/blog/'.$blog->blog_slug_name)}}">
    <div class="vastu-product">
        <img src="{{asset('blog/thumb/'.$blog->blog_image_name)}}" style="widows: 100%;height: 350px;">
        <h4>{{Str::limit($blog->blog_name,25,$end='...')}}</h4>
    </div>
    </a>
    </div>
  @endforeach  
    
</div>
</div>
</div>
@endif

 @endsection
