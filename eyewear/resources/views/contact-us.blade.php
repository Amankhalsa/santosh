@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Contact Us Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Contact Us Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Contact Us Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}

 @section('content')

<style type="text/css">
  .iframe-rwd {position: relative;padding-bottom: 50%;padding-top: 30px;height: 0;overflow: hidden;}
.iframe-rwd iframe {position: absolute;top: 0;left: 0;width: 100%;height: 100%;}
</style>

    <div id="content" class="site-content">
    <div class="col-full">
        <div class="container">
    <div class="row">
    <nav class="woocommerce-breadcrumb">
    <a href="{{url('/')}}">Home</a>
    <span class="delimiter">
    <i class="tm tm-breadcrumbs-arrow-right"></i>
    </span>
    {{$meta_tag->page_name}}
    </nav>
    <!-- .woocommerce-breadcrumb -->
    <div id="primary" class="content-area mt-5 mb-5">
    <main id="main" class="site-main">
    <div class="type-page hentry">
    <div class="entry-content">
    <!--<div class="stretch-full-width-map">-->
    <!--<div id="map_section" class="iframe-rwd">-->
    <!--  {!! $admin_data->admin_map !!}-->
    <!--  </div> -->
    <!--</div>-->
    <!-- .stretch-full-width-map -->
    <div class="row contact-info pt-5 ">
    <div class="col-md-9 left-col">
    <div class="text-block">
    <h2 class="contact-page-title">Leave us a Message</h2>
    <hr>
      @if(session('form_success'))
      <div class="alert alert-success alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {{ session('form_success') }}
      </div>
      @endif
    </div>
    <div class="contact-form">
    <div role="form" class="wpcf7" id="wpcf7-f425-o1" lang="en-US" dir="ltr">
    <div class="screen-reader-response"></div>
    
<form class="wpcf7-form" method="post" action="{{url('/contact-form-submit')}}" role="form" enctype="multipart/form-data" name="contact-form">
    @csrf
  
    
<input type="hidden" name="source" value="{{Request::path()}}">

<div class="form-group row">
<div class="col-xs-12 col-md-12">
<label>Name
<abbr title="required" class="required">*</abbr>
</label>
<br>
<span class="wpcf7-form-control-wrap first-name">
<input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" name="name">
</span>
</div>
<!-- .col -->
<div class="col-xs-12 col-md-6">
<label>Mobile No.
<abbr title="required" class="required">*</abbr></label>
<br>
<span class="wpcf7-form-control-wrap email">
<input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" name="mobile" maxlength="10">
</span>
</div>
<!-- .col -->
<div class="col-xs-12 col-md-12">
    <!-- .form-group -->

<label>Email
  <abbr title="required" class="required">*</abbr>
</label>
<br>
<span class="wpcf7-form-control-wrap email">
<input type="text" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" name="email">

</span>

</div>

<div class="col-xs-12 col-md-12">
<!-- .form-group -->
<div class="form-group">
<label>Your Message</label>
<br>
<span class="wpcf7-form-control-wrap your-message">
<textarea aria-invalid="false" class="wpcf7-form-control wpcf7-textarea" rows="5" cols="40" name="message"></textarea>
</span>
</div>
<!-- .form-group-->

</div>
</div>


    <div class="form-group clearfix">
        <p>
            <input type="submit" value="Send Message" class="wpcf7-form-control wpcf7-submit btn btn-dark" />
        </p>
    </div>
    <!-- .form-group-->
    <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
    <!-- .wpcf7-form -->
    </div>
    <!-- .wpcf7 -->
    </div>
    <!-- .contact-form7 -->
    </div>
    <!-- .col -->
    <div class="col-md-3 store-info">
    <div class="text-block">
    <h2 class="contact-page-title"><i class="fa fa-map-marked"></i> Our Store</h2>
    <hr>
    <address>
    {{ $admin_data->admin_address }} {{ $admin_data->admin_city }}, {{ $admin_data->admin_state }} - {{ $admin_data->admin_zip_code }}, {{ $admin_data->admin_country }}
    </address>
    <h3><i class="fa fa-phone-alt"></i> Info</h3>
    <ul class="list-unstyled operation-hours inner-right-md">
      
      <li class="clearfix">
      <span class="day">Email:</span>
      <span class="pull-right flip hours">{{$admin_data->email}} 
        @if(!empty($admin_data->admin_alternate_email)),{{$admin_data->admin_alternate_email}}@endif
      </span>
      </li>

      <li class="clearfix">
      <span class="day">Mobile:</span>
      <span class="pull-right flip hours">{{$admin_data->admin_mobile}}
        @if(!empty($admin_data->admin_phone)),{{$admin_data->admin_phone}} @endif
      </span>
      </li>
    
    </ul>
    <h3><i class="fa fa-handshake"></i> Careers</h3>
    <p class="inner-right-md">If you’re interested in employment opportunities at Techmarket, please email us: contact@yourstore.com</p>
    </div>
    <!-- .text-block -->
    </div>
    <!-- .col -->
    </div>
    <!-- .contact-info -->
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
    </div>

 @endsection
