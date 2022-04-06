@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Index Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Index Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Index Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}



@section('content')

@include('new-slider')

@include('frontend.new_index')

@include('footer_what_about')


  
 @endsection
