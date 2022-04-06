@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Faq Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Faq Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Faq Meta Keywords";
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
<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">{{$meta_tag->page_name}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div id="content" class="site-content">
<div class="container">
<div class="row">
    <div class="col-12">
<!-- .woocommerce-breadcrumb -->
<div id="primary" class="content-area">
<main id="main" class="site-main">
<div class="type-page hentry privacy-page">
<header class="entry-header">
<div class="page-header-caption text-center">
<h3><b>{{$meta_tag->page_name}}</b></h3>
</div>
</header>
<!-- .entry-header -->
<div class="entry-content">

{!! $meta_tag->page_content !!}

</div>
<!-- .entry-content -->
</div>
<!-- .hentry -->
</main>
<!-- #main -->
</div>
<!-- #primary -->
</div>
</div>
<!-- .row -->
</div>
<!-- .col-full -->
</div>

 @endsection
