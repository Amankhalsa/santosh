@extends('layouts.app')
<style>
    a{
        text-decoration:none !important;
    }
    div[disabled]
{
  opacity: 0.6;
  background: rgba(200, 54, 54, 0.5);  
  background-color: #f4f4f4;
  filter: alpha(opacity=50);
  zoom: 1;  
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";  
  -moz-opacity: 0.5; 
  -khtml-opacity: 0.5;  
}

 div[disabled] a
 {
     pointer-events: none;
 }
 
 li.disabled {
  pointer-events: none;
  cursor: default;
}
.headertopright {
    margin-top: 15px;
    
}
</style>
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
<div class="container-fluid">
    <form id="multistep">
      <div class="row">
        <!-- multistep -->
        
      <!--Note  : ms-card is a class for card now remove for finishing if you can use this any time for border shadow-->
<div class="col-lg-4 col-12 img-sec" style="background-color:#fff;">
			<div class="sun-back">
			<a href="{{url('/frame/'.$product_data->category_slug_name.'.html')}}"> <i class="fas fa-chevron-left"></i> Back to Frame Description</a>
			</div>
			
			<div class="sun-back-img">
			<img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" style="width:100%">
			</div>
		<div class="sun-pro-box" style="text-align:center;">
		    <style>
		    .sun-pro-box h1 a {color: #007bff}
		    
		    .form-control, .input-group-addon, .bootstrap-select .btn {
    background-color: rgba(0, 0, 0, 0);
    border-color: #e7e8ec;
    border-radius: 0;
    box-shadow: none;
    color: #999;
    font-size: 13px;
    height: 54px;
    line-height: 50px;
    padding: 0px 0px; 
    margin-bottom: 10px;
}
		    </style>
		<h1><a href="{{url('/frame/'.$product_data->category_slug_name.'.html')}}" style="color:#007bff;">{{$product_data->category_name}}</a></h1>
		<p>{{$color_name}} {{$product_data->category_frame}}</p>
		<h3>Subtotal:
		{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_price)}}
		</h3>
		</div>
		
		</div>
		
<div class="col-lg-8 col-12">
 

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 
    <style>.process-step .btn:focus{outline:none}
.process{display:table;width:100%;position:relative}
.process-row{display:table-row}
.process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
.process-row:before{top:40px;bottom:0;position:absolute;content:" ";width:100%;height:1px;background-color:#ccc;z-order:0}
.process-step{display:table-cell;text-align:center;position:relative}
.process-step p{margin-top:4px}
.btn-circle{width:80px;height:80px;text-align:center;font-size:12px;border-radius:50%}
</style>
    
 
<div class="container">
 <div class="row">
  <div class="process">
   <div class="process-row nav nav-tabs">
    
    <div class="process-step">
     <button type="button" id="vision_tab" class="btn btn-info btn-circle" data-toggle="tab" href="#vision"><i class="far fa-binoculars fa-3x"></i></button>
     <p><small>Vision</small></p>
    </div>
    
    <div class="process-step">
     <button type="button" id="prescription_tab" class="disabled btn btn-default btn-circle" data-toggle="tab" href="#prescription"><i class="far fa-file fa-3x"></i></button>
     <p><small>Prescription</small></p>
    </div>
    <div class="process-step">
     <button type="button" id="lens_color_type_tab" class="disabled btn btn-default btn-circle" data-toggle="tab" href="#lens_color_type"><i class="far fa-image fa-3x"></i></button>
     <p><small>Lens Color Type</small></p>
    </div>
    <div class="process-step">
     <button type="button" id="lens_brands_tab" class="disabled btn btn-default btn-circle" data-toggle="tab" href="#lens_brands"><i class="far fa-building fa-3x"></i></button>
     <p><small>Lens Brands</small></p>
    </div>
    <div class="process-step">
     <button type="button" id="lens_tab" class="disabled btn btn-default btn-circle" data-toggle="tab" href="#lens"><i class="far fa-eye fa-3x"></i></button>
     <p><small>Lenses</small></p>
    </div>
    <div class="process-step">
     <button type="button" id="review_cart_tab" class="disabled btn btn-default btn-circle" data-toggle="tab" href="#review_cart"><i class="far fa-shopping-basket fa-3x"></i></button>
     <p><small>Review Cart</small></p>
    </div>
   </div>
  </div>
  <div class="tab-content">
   <div id="vision" class="tab-pane fade active in">
   
   
   
   
<!-- personal information -->
<div class="row">
<div class="col-lg-12">
 <input type="hidden" name="product_id" class="product_id" value="{{$product_id}}">
   <input type="hidden" name="qty" class="qty" value="{{$prd_qty}}">
   <input type="hidden" name="vision_id" class="vision_id">    

@php
$i=0;
$product_visions = explode(',',$product_data->visions);
 $visions = DB::table('visions')->where('vision_parent_id','0')->get();
@endphp  
 @foreach($visions as $vision)
@php 
$check_subvision = DB::table('visions')->where('vision_parent_id',$vision->id)->count();
@endphp
@if($check_subvision>0)

<div style="border: 1px solid;
    margin: 10px;
    border-style: ridge;
    padding: 10px;" @if(!in_array($vision->id,$product_visions)) disabled @endif>
 <a data-toggle="collapse" href="#collapseExample{{$vision->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
     
<img src="{{asset('uploaded_files/vision/'.$vision->vision_image_name)}}" style="width:50px; height:auto; float:left"/>
<h4 style="font-size: 1.3rem;">{{$vision->vision_name}}</h4></a>

@if(!empty($vision->vision_description))
<div class="popover__wrapper" style="float:right">
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  <div class="popover__content">
   <p style="text-align: justify;
    padding: 10px;
    color: grey;"> {!!$vision->vision_description!!}</p>
  </div>
</div>
@endif

<p> {{$vision->vision_tag_line}}</p>

</div>





<div class="collapse" id="collapseExample{{$vision->id}}">
 @php
   $subvisions = DB::table('visions')->where('vision_parent_id',$vision->id)->get();
  @endphp 
  @foreach($subvisions as $subvision)
  <div class="card card-body" onclick="getPrescription('{{$subvision->id}}')">
<li>
<img src="{{asset('uploaded_files/vision/'.$subvision->vision_image_name)}}" style="width:50px; height:auto; float:left"/>

   &nbsp; &nbsp; <a href="javascript:void(0)" >{{$subvision->vision_name}} ₹ {{$subvision->vision_price}}</a></li>
@if(!empty($subvision->vision_description))
<div class="popover__wrapper" style="float:right">
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  <div class="popover__content" style="margin-left: 250px;">
   <p style="text-align: justify;
    padding: 10px;
    color: grey;"> {!!$subvision->vision_description!!}</p>
  </div>
</div>    
@endif
    
  </div>
  @endforeach
  
</div>

@else

<div style="border: 1px solid; margin: 10px;
    border-style: ridge;
    padding: 10px;" @if(!in_array($vision->id,$product_visions)) disabled @else  onclick="getPrescription('{{$vision->id}}')" style="cursor:pointer;" @endif>
<img src="{{asset('uploaded_files/vision/'.$vision->vision_image_name)}}" style="width:50px; height:auto; float:left">
<h4 style="font-size: 1.3rem; " ><a href="javascript:void(0)" >{{$vision->vision_name}}</a></h4>

@if(!in_array($vision->id,$product_visions))
 <div class="popover__wrapper" style="float:right">
  
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  <div class="popover__content">
   <p > {!!$vision->vision_disable_description!!}</p>
  </div>
</div>
@else

 @if(!empty($vision->vision_description))
<div class="popover__wrapper" style="float:right">
  <a href="#">
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  </a>
  <div class="popover__content">
   <p > {!!$vision->vision_description!!}</p>
  </div>
</div>
 @endif
@endif
<p> {{$vision->vision_tag_line}}</p>
</div>

@endif

  @php
   $i++;
  @endphp
 @endforeach

<style>.h3, h3 {
    text-align: center;
    font-size: 18px;
    </style>
<div class=""></div>

</div>


</div>


   </div>
   <div id="prescription" class="tab-pane fade">
   
  <!-- content -->
<div class="row">
<div class="col-lg-12">
  
    <!-- account -->
    
    <div class="row"> 
      <div class="col-lg-12"> 
        <h5 class="ms-subtitle">Prescription</h5>
           <div class="container">
               
      <div class="row">
      <div class="col-lg-3 col-2 hide-prescription-fields">    
    
        </div>  
        
        <div class="col-lg-2 col-3 hide-prescription-fields">    
         Sphere (SPH)
        </div>  
        
        <div class="col-lg-2 col-3 hide-prescription-fields">    
           Cylinder (CYL)
        </div>  
        
        <div class="col-lg-2 col-3 hide-prescription-fields">    
           Axis
        </div>  
        
        <div class="col-lg-2 col-1 hide-prescription-fields">    
           ADD
        </div>  
          
      </div>         
                
      <div class="row">
      <div class="col-lg-3 col-2 hide-prescription-fields">    
  <center>   <h6><b> OD </b></h6>
       <p style="
    color: grey;
    font-size: 10px;">(R Eye)</p>
       
       
        <h6><b>OS </b></h6>
            <p style="
    color: grey;
    font-size: 10px;">(L Eye)</p></center>
        </div>  
   
        <div class="col-lg-2 col-3 hide-prescription-fields">    
         <select name="sph_right" class="form-control sph_right">
@php
$prescription_data = DB::table('prescription_data')->where('sph_right','!=','')->whereRaw("sph_right Between $product_data->min_sph AND '$product_data->max_sph' ")->get();
@endphp      
        
            @foreach($prescription_data as $data)
             <option value="{{$data->sph_right}}" @if($data->sph_right=="0.00") selected @endif>{{$data->sph_right}}</option>
            @endforeach
         </select>
       
         
     <select name="sph_left" class="form-control sph_left">
@php
$prescription_data = DB::table('prescription_data')->where('sph_left','!=','')->whereRaw("sph_left Between $product_data->min_sph AND '$product_data->max_sph' ")->get();
@endphp      
            @foreach($prescription_data as $data)
             <option value="{{$data->sph_left}}" @if($data->sph_left=="0.00") selected @endif>{{$data->sph_left}}</option>
            @endforeach
         </select>
         
        </div>  
        
        <div class="col-lg-2 col-3 hide-prescription-fields">    
            <select name="cyl_right" class="form-control cyl_right">
@php
$prescription_data = DB::table('prescription_data')->where('cyl_right','!=','')->whereRaw("cyl_right Between $product_data->min_cyl AND '$product_data->max_cyl' ")->get();
@endphp      
            
    @foreach($prescription_data as $data)
     <option value="{{$data->cyl_right}}" @if($data->cyl_right=="0.00") selected @endif>{{$data->cyl_right}}</option>
    @endforeach
 </select>
 
 
 <select name="cyl_left" class="form-control cyl_left">
@php
$prescription_data = DB::table('prescription_data')->where('cyl_left','!=','')->whereRaw("cyl_left Between $product_data->min_cyl AND '$product_data->max_cyl' ")->get();
@endphp      
            
            @foreach($prescription_data as $data)
             <option value="{{$data->cyl_left}}" @if($data->cyl_left=="0.00") selected @endif>{{$data->cyl_left}}</option>
            @endforeach
         </select>
 
        </div>  
        
        <div class="col-lg-2 col-3 hide-prescription-fields">    
          <select name="axis_right" class="form-control axis_right">
@php
$prescription_data = DB::table('prescription_data')->where('axis_right','!=','')->get();
@endphp      
            <option value="">-- Select AXIS (R) --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->axis_right}}">{{$data->axis_right}}</option>
            @endforeach
         </select>
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
        
        <div class="col-lg-2 col-1 hide-prescription-fields">    
          <select name="add_right" class="form-control add_right">
@php
$prescription_data = DB::table('prescription_data')->where('add_right','!=','')->get();
@endphp      
            <option value="">n/a</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->add_right}}">{{$data->add_right}}</option>
            @endforeach
         </select>
         
    <select name="add_left" class="form-control add_left">
@php
$prescription_data = DB::table('prescription_data')->where('add_left','!=','')->get();
@endphp      
            <option value="">n/a</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->add_left}}">{{$data->add_left}}</option>
            @endforeach
         </select>     
         
         
         
         
        </div>  
          
      </div>         
      
              
               
     <div class="row">
   <div class="col-lg-3 hide-prescription-fields">    
     <h5 class="ms-subtitle">    Pupillary Distance</h5>
        </div> 

<div class="col-lg-8 hide-prescription-fields">
    <div class="one_pd">

<select name="pupillary_distance" class="form-control pupillary_distance">
@php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance','!=','')->get();
@endphp      
<option value="">-- Select Pupillary Distance --</option>
@foreach($prescription_data as $data)
 <option value="{{$data->pupillary_distance}}">{{$data->pupillary_distance}}</option>
@endforeach
</select>
</div>
</div>  </div> 

  <div class="row">  
<div class="two_pd" style="display:none; width:100%">
    
<div class="col-lg-12 hide-prescription-fields">
    <div class="row">
        <div class="col-lg-2 hide-prescription-fields" ></div>
        <div class="col-lg-4 hide-prescription-fields" >
         <p>Pupillary Distance (R)</p></div>
         <div class="col-lg-6 hide-prescription-fields">
         <select name="pupillary_distance_right" class="form-control pupillary_distance_right">
@php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_right','!=','')->get();
@endphp      
<option value="">-- Select Pupillary Distance --</option>
@foreach($prescription_data as $data)
 <option value="{{$data->pupillary_distance_right}}">{{$data->pupillary_distance_right}}</option>
@endforeach
</select></div>
       
<!-- <style>.form-control, .input-group-addon, .bootstrap-select .btn {-->
<!--    background-color: rgba(0, 0, 0, 0);-->
<!--    border-color: #e7e8ec00;-->
<!--    border-radius: 0;-->
<!--    box-shadow: none;-->
<!--    color: #999;-->
<!--    font-size: 13px;-->
<!--    height: 54px;-->
<!--    line-height: 50px;-->
<!--    padding: 10px 20px;-->
<!--    border-bottom: 2px solid #dad6d4;-->
<!--}</style>      -->
       
<div class="col-lg-2 hide-prescription-fields" ></div>
        <div class="col-lg-4 hide-prescription-fields" >   
 <p>Pupillary Distance (L)</p></div>
 <div class="col-lg-6 hide-prescription-fields">
 <select name="pupillary_distance_left" class="form-control pupillary_distance_left">
@php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_left','!=','')->get();
@endphp      
            <option value="">-- Select Pupillary Distance --</option>
            @foreach($prescription_data as $data)
             <option value="{{$data->pupillary_distance_left}}">{{$data->pupillary_distance_left}}</option>
            @endforeach
         </select></div>
       </div>
</div> </div>
       
<span><input type="checkbox" name="check-pd" id="check-pd" class="check-pd" onclick="check_two_pd()"> Two PD ?</span>
       
<input type="hidden" name="is_pd2" id="is_pd2" class="is_pd2" value="No"/>       
       <div class="row">
        <div class="col-lg-12 nerr">
         <div class="nerr"><br><br>
<p style="margin-bottom: 1rem;
    color: #ccc4c4;">Or Upload Prescription</p>
           </div>    
       
       

<div class="upload-pres">
<form method="post" class="upload_prescription_form" enctype="multipart/form-data"> 
@csrf
<input type="file" name="upload_prescription" class="form-control upload_prescription">
<input type="hidden" name="is_prescription_upload" class="is_prescription_upload" value="no">
<input type="text" name="mobile_no" placeholder="Enter mobile number" class="mobile_no" style="display:none">
</form> </div>
</div>
       </div>

@if($admin_data->is_prism=="Yes")
<input type="hidden" name="is_prism" class="is_prism" value="No" />
<div class="col-lg-12">        
<div class="row">
 
   <input type="checkbox" name="prism_checkbox" class="prism_checkbox" onclick="isPrism()" />&nbsp; Add Prism &nbsp;&nbsp;<b> {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$admin_data->prism_price)}}</b>
   
   <div class="prism-prescription" style="display:none; width:100%">
       <div class="row">
         <div class="col-lg-3 hide-prescription-fields"> 
         
         </div> 
         <div class="col-lg-2 hide-prescription-fields">
           Vertical (Δ)
            
                </div> 
         <div class="col-lg-2 hide-prescription-fields"> 
         Base Direction
         </div> 
         <div class="col-lg-2 hide-prescription-fields">  
         Horizontal (Δ)
         </div> 
         <div class="col-lg-2 hide-prescription-fields">  
         Base Direction
         </div> 
    
         
         <div class="col-lg-3 hide-prescription-fields"> 
       
     
       <h6><b>&nbsp; &nbsp;   OD</b> </h6>
       <p  style="font-weight: 600;
    color: grey;
    font-size: 12px;">(Right eye)</p>

         </div> 
    <div class="col-lg-2 hide-prescription-fields">
    <select name="prism_right_vertical" class="form-control prism_right_vertical">
            
            <option value="">n/a</option>
            <option value="0.50">0.50</option>
            <option value="1.00">1.00</option>
            <option value="1.50">1.50</option>
            <option value="2.00">2.00</option>
            <option value="2.50">2.50</option>
            <option value="3.00">3.00</option>
            <option value="3.50">3.50</option>
            <option value="4.00">4.00</option>
            <option value="4.50">4.50</option>
            <option value="5.00">5.00</option>
            
            </select>
            
            </div> 
            <div class="col-lg-2 hide-prescription-fields"> 
            <select name="prism_right_vertical_direction" class="form-control prism_right_vertical_direction">
            
            <option value="">n/a</option>
            <option value="Up">Up</option>
            <option value="Down">Down</option>
            
            </select>
            </div> 
            <div class="col-lg-2 hide-prescription-fields">  
            <select name="prism_right_horizontal" class="form-control prism_right_horizontal">
            <option value="">n/a</option>
            <option value="0.50">0.50</option>
            <option value="1.00">1.00</option>
            <option value="1.50">1.50</option>
            <option value="2.00">2.00</option>
            <option value="2.50">2.50</option>
            <option value="3.00">3.00</option>
            <option value="3.50">3.50</option>
            <option value="4.00">4.00</option>
            <option value="4.50">4.50</option>
            <option value="5.00">5.00</option>
            
            </select>
            </div> 
        
            <div class="col-lg-2 hide-prescription-fields">  
            <select name="prism_right_horizontal_direction" class="form-control prism_right_horizontal_direction">
            
            <option value="">n/a</option>
            <option value="Up">Up</option>
            <option value="Down">Down</option>
            </select>
            </div> 
       </div>      
       
        <div class="row">
        <div class="col-lg-3 hide-prescription-fields"> 
        
        
        <h6><b>&nbsp; &nbsp;   OS </b>
        </h6><p  style="font-weight: 600;
        color: grey;
        font-size: 12px;">(Left eye)</p>
        
        </div> 
        
        <div class="col-lg-2 hide-prescription-fields">
        <select name="prism_left_vertical" class="form-control prism_left_vertical">
        <option value="">n/a</option>
        <option value="0.50">0.50</option>
        <option value="1.00">1.00</option>
        <option value="1.50">1.50</option>
        <option value="2.00">2.00</option>
        <option value="2.50">2.50</option>
        <option value="3.00">3.00</option>
        <option value="3.50">3.50</option>
        <option value="4.00">4.00</option>
        <option value="4.50">4.50</option>
        <option value="5.00">5.00</option>
        
        </select>
        
        </div> 
        
    <div class="col-lg-2 hide-prescription-fields"> 
    <select name="prism_left_vertical_direction" class="form-control prism_left_vertical_direction">
    
    <option value="">n/a</option>
    <option value="Up">Up</option>
    <option value="Down">Down</option>
    
    </select>
    </div> 
    <div class="col-lg-2 hide-prescription-fields">  
    <select name="prism_left_horizontal" class="form-control prism_left_horizontal">
    <option value="">n/a</option>
    <option value="0.50">0.50</option>
    <option value="1.00">1.00</option>
    <option value="1.50">1.50</option>
    <option value="2.00">2.00</option>
    <option value="2.50">2.50</option>
    <option value="3.00">3.00</option>
    <option value="3.50">3.50</option>
    <option value="4.00">4.00</option>
    <option value="4.50">4.50</option>
    <option value="5.00">5.00</option>
    
    </select>
    </div> 
    <div class="col-lg-2 hide-prescription-fields">  
    <select name="prism_left_horizontal_direction" class="form-control prism_left_horizontal_direction">
    
    <option value="">n/a</option>
    <option value="Up">Up</option>
    <option value="Down">Down</option>
    
    </select>
    </div> 
    
    </div>      
    
    </div>
    
    </div>    
    </div> 
 @endif  
 <br>
    <div class="row">
     <div class="col-lg-12">
<textarea class="form-control prescription_comment" name="prescription_comment" placeholder="Comment"></textarea>
     </div>    
    </div>
    
    
       
       <div class="col-lg-12" style="padding-left: 0px;padding-top:10px;">
         <button type="button" class="btn btn-primary" onclick="prescription('add')">Submit</button><br><br>
       </div>

     </div>
   </div> 
      </div>
    </div>
   
  
    <!-- security questions end-->

</div>
</div>
<!-- content end -->
 
  
   </div>
   <div id="lens_color_type" class="tab-pane fade">
    
    <!-- title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="ms-title ">Lens Color Type

@php
$i=0;
 $color_types = DB::table('lens_color_types')->where('category_parent_id','0')->where('category_status','Active')->orderBy('category_order_by')->get();
@endphp  
 @foreach($color_types as $type)
@php 
$check_subcolor = DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$type->id)->count();
@endphp
@if($check_subcolor>0)

<div style="border: 1px solid;
    margin: 10px;
    border-style: ridge;
    padding: 10px;">
 <a data-toggle="collapse" href="#collapse{{$type->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
<img src="{{asset('uploaded_files/lens/'.$type->category_image_name)}}" style="width:50px; height:auto; float:left">
<h4 style="font-size: 1.3rem;
    margin-left: 60px;
    margin-top: 5px;" > {{$type->category_name}} </h4></a>

@if(!empty($type->category_description))    
<div class="popover__wrapper" style="float:right">
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  <div class="popover__content">
   <p > {!!$type->category_description!!}</p>
  </div>
</div>
@endif    
    
<p style="font-size:15px; margin-left: 60px;">{{$type->category_tag_line}}</p>

</div>
<div class="collapse" id="collapse{{$type->id}}">
@php
   $subcolor_types = DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$type->id)->get();
  @endphp    

  @foreach($subcolor_types as $subcolor)
  <div class="card card-body" style="cursor:pointer">
    <a href="javascript:void(0)" >{{$subcolor->category_name}}</a> (₹ {{$subcolor->category_price}})

@if(!empty($subcolor->category_description))    
<div class="popover__wrapper" style="float:right">
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  <div class="popover__content" style="margin-left: 250px;">
   <p style="text-align: justify;
    padding: 10px;
    color: grey;"> {!!$subcolor->category_description!!}</p>
  </div>
</div>
@endif    
    
@php
$color_tints_count=DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$subcolor->id)->count();
@endphp    
@if($color_tints_count>0)
@php
$color_tints_first=DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$subcolor->id)->first();
$color_tints=DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$subcolor->id)->get();
@endphp
<div class="row">
@foreach($color_tints as $tint)

<div class="col-md-1" style="" class="pro-ibtn btn-tool" id="tint{{$tint->id}}" onclick="setTint('{{$tint->id}}')" title="{{$tint->category_name}}">

<img class="pro-i" src="{{asset('uploaded_files/finalcat/'.$tint->category_image_name)}}" style="padding: 5px;
border-radius: 50%;
width: 40px;
height: auto;">
</div>
    
@endforeach 
</div>
<input type="hidden" class="tint_color" value="{{$color_tints_first->id}}">
<button type="button" class="btn btn-primary" onclick="getLensBrands('{{$color_tints_first->id}}','tint')" style="
    width: 150px;
    margin-top: 10px;">Confirm</button>
@endif
    
  </div>
  @endforeach
  
</div>

@else

<div class="" style="border: 1px solid;
    margin: 10px;
    border-style: ridge;
    padding: 10px;" onclick="getLensBrands('{{$type->id}}','notint')" style="cursor:pointer">
<img src="{{asset('uploaded_files/lens/'.$type->category_image_name)}}" style="width:50px; height:auto; float:left">
<h4 style="font-size: 1.3rem;
    margin-left: 60px;
    margin-top: 5px; "> <a href="javascript:void(0)" > {{$type->category_name}}</a></h4>
@if(!empty($type->category_description))    
<div class="popover__wrapper" style="float:right">
    <h5 class="popover__title"><i class="fa fa-info-circle"></i></h5>
  <div class="popover__content">
   <p > {!!$type->category_description!!}</p>
  </div>
</div>
@endif
<p  style="font-size:15px;margin-left: 60px;">{{$type->category_tag_line}}</p>
</div>

@endif

  @php
   $i++;
  @endphp
 @endforeach      
      
      </div>
    </div>
  </div>
  <!-- title end -->
   
 
   </div>
   
   <div id="lens_brands" class="tab-pane fade view-lens-brands">
    <!-- title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="ms-title ">Lens Brands</div>
    </div>
  </div>
  
   </div>
   
   <div id="lens" class="tab-pane fade view-lenses">
   
   </div>
   
   <div id="review_cart" class="tab-pane fade">
    <div class="row">
    <div class="col-sm-12 review-cart">
      <div class="ms-title ">Review Cart</div>
    </div>
  </div>
  
   </div>
  </div>
 </div>
</div>   
    
    
    
    
    
</div>	
<script>
$(function(){
/* $('.btn-circle').on('click',function(){
   $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
   $(this).addClass('btn-info').removeClass('btn-default').blur();
 });*/

/* $('.next-step, .prev-step').on('click', function (e){
   var $activeTab = $('.tab-pane.active');

   $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

   if ( $(e.target).hasClass('next-step') )
   {
      var nextTab = $activeTab.next('.tab-pane').attr('id');
      $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
      $('[href="#'+ nextTab +'"]').tab('show');
   }
   else
   {
      var prevTab = $activeTab.prev('.tab-pane').attr('id');
      $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
      $('[href="#'+ prevTab +'"]').tab('show');
   }
 });*/
});    
    
</script>


</form>
<!-- multistep end -->

</div>
</div>
</div>

 @endsection
