@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Return & Exchange Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Return & Exchange Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Return & Exchange Meta Keywords";
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

<div id="content" class="site-content">
<div class="container">
<div class="row">
<!-- .woocommerce-breadcrumb -->
<div id="primary" class="content-area">
<main id="main" class="site-main">
<div class="type-page hentry privacy-page">
<header class="entry-header">
<div class="page-header-caption text-center">
<h3 class="entry-title"><b>{{$meta_tag->page_name}}</b></h3>
</div>
</header>
<!-- .entry-header -->
<div class="entry-content pt-5">

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
<!-- .row -->
</div>
<!-- .col-full -->
</div>

 @endsection
