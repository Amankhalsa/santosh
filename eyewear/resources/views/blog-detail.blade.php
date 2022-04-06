@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = "Blog Detail Meta Title";
 $meta_description = "Blog Detail Meta Description";
 $meta_keywords = "Blog Detail Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}

 @section('content')
 
 <div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<h1>{{$meta_tag->page_name}}</h1>
<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">{{$meta_tag->page_name}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
 
 

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
<h1>{{$blog->blog_name}}</h1>
	<ul class="vastu-breadcrumb">
	<a href="{{url('/')}}"><li><i class="fas fa-home"></i> Home </li></a>
		<li><i class="fas fa-caret-right"></i></li>
        <a href="{{url('/blog.html')}}"><li> Blog </li></a>
        <li><i class="fas fa-caret-right"></i></li>
		<a href="{{url('/blog/'.$blog->blog_slug_name.'.html')}}"><li>{{$blog->blog_name}}</li></a>
	</ul>
	</div>
</div>
</div>
</div>
</div>
</div>

<div class="padd-40">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-3 col-12 ">
            <div class="rudra-heading">
                <h2>{{$blog->blog_name}}</h2>
            </div>
            </div>
        </div>
        
        <div class="row">
           
            
            <div class="col-lg-8 col-6">
               <div class="">
               {!! $blog->blog_desc !!}
                <br>
                <a href="{{url('/about-us.html')}}">Read More</a>
               </div>
              
            </div>
            
             <div class="col-lg-4 col-6">
                <div class="">
                    
<img src="{{asset('blog/'.$blog->blog_image_name)}}" class="img" style="width: 100%;">

                </div>
            </div>
        </div>
    </div>
    
</div>

 @endsection
