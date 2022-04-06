<div class="row mt-5 mb-5">
 <div class="col-md-12 text-center">
     <h4 class="divyanshu">Review Cart</h4>
 </div>
 </div>
@php
if($func_type=="add"){
$product_data = DB::table('categories')->where('id',$product_id)->first();
$color_data = DB::table('product_colors')->where('id',$product_data->category_color)->first();
$color_name = $color_data->color_name;
}else{
$cart = DB::table('carts')->where('id',$product_id)->first();
$product_data = DB::table('categories')->where('id',$cart->product_id)->first();
}

$prescription_array=Session::get('prescription_array');
$vision_data = DB::table('visions')->where('id',Session::get('vision_id'))->first();

$lens_color_type = DB::table('lens_color_types')->where('id',$lens_color_id)->first();

$lens_data = DB::table('lenses')->where('id',$lens_id)->first();
$lens_brand = DB::table('lens_brands')->where('id',$lens_data->brand)->first();
$lens_index = DB::table('lens_index')->where('id',$lens_data->lens_index)->first();
@endphp 

<h4 class="fbrand">{{$product_data->category_name}} | @if($func_type=="add"){{$product_data->category_uan_code}} @else {{$cart->color}} | @endif - ({{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_discount_price)}})</h4>


@if($vision_data->is_power!="No" && Session::get('is_prescription_upload')=="No") 
<div class="row prescr">
<div class="col-6 col-lg-12 col-md-12 col-sm-6" style="margin-bottom: 10px">
<div class="row">

<div class="col-lg-12 col-md-12 col-12">
<div class="row">
    <div class="col-lg-2 col-md-12 col-12" style="line-height: 0; text-align: center">
<h4><strong>OD</strong></h4>
<p>(R eye)</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Sphere</h5>
    <p id="sphere-r">{{$prescription_array['sph_right']}}</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Cylinder</h5>
    <p id="cylinder-r">{{$prescription_array['cyl_right']}}</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Axis</h5>
    <p id="axis-r">{{$prescription_array['axis_right']}}</p>
</div>
@if(!empty($prescription_array['add_right']))
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Add</h5>
    <p id="add-r">{{$prescription_array['add_right']}}</p>
</div>
@endif
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">PD</h5>
@if($prescription_array['is_pd2']=="Yes")    
  <p id="add-r">{{$prescription_array['pupillary_distance_right']}}</p>
@else
  <p id="add-r">{{$prescription_array['pupillary_distance']}}</p>
@endif
</div>

</div>
</div>
</div>
</div>
<div class="col-6 col-lg-12 col-md-12 col-sm-6">
<div class="row">

<div class="col-lg-12 col-md-10 col-12">
<div class="row">
    <div class="col-lg-2 col-md-12 col-12" style="line-height: 0; text-align: center">
<h4><strong>OS</strong></h4>
<p>(L eye)</p>
</div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Sphere</h5>
        <p id="sphere-l">{{$prescription_array['sph_left']}}</p>
    </div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Cylinder</h5>
        <p id="cylinder-l">{{$prescription_array['cyl_left']}}</p>
    </div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Axis</h5>
        <p id="axis-l">{{$prescription_array['axis_left']}}</p>
    </div>
@if(!empty($prescription_array['add_left']))    
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Add</h5>
        <p id="add-l">{{$prescription_array['add_left']}}</p>
    </div>
@endif    
@if($prescription_array['is_pd2']=="Yes")    
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">PD</h5>
    <p id="add-l">{{$prescription_array['pupillary_distance_left']}}</p>
</div>
@endif    
</div>
</div>
</div>
</div>
</div>

@if($prescription_array['is_prism']=="Yes")
<u><h4>Prism Prescription</h4></u>
<div class="row prescr">
<div class="col-6 col-lg-12 col-md-12 col-sm-6" style="margin-bottom: 10px">
<div class="row">

<div class="col-lg-12 col-md-10 col-12">
<div class="row">
    <div class="col-lg-2 col-md-12 col-12" style="line-height: 0; text-align: center">
<h4><strong>OD</strong></h4>
<p>(R eye)</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Vertical (Δ)</h5>
    <p id="sphere-r">{{$prescription_array['prism_right_vertical']}}</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Base Direction</h5>
    <p id="cylinder-r">{{$prescription_array['prism_right_vertical_direction']}}</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Horizontal (Δ)</h5>
    <p id="axis-r">{{$prescription_array['prism_right_horizontal']}}</p>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <h5 style="font-size: 15px">Base Direction</h5>
    <p id="add-r">{{$prescription_array['prism_right_horizontal_direction']}}</p>
</div>
</div>
</div>
</div>
</div>
<div class="col-6 col-lg-12 col-md-12 col-sm-6">
<div class="row">
<div class="col-lg-12 col-md-10 col-12">
<div class="row">
    
<div class="col-lg-2 col-md-12 col-12" style="line-height: 0; text-align: center">
<h4><strong>OS</strong></h4>
<p>(L eye)</p>
</div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Vertical (Δ)</h5>
        <p id="sphere-l">{{$prescription_array['prism_left_vertical']}}</p>
    </div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Base Direction</h5>
        <p id="cylinder-l">{{$prescription_array['prism_left_vertical_direction']}}</p>
    </div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Horizontal (Δ)</h5>
        <p id="axis-l">{{$prescription_array['prism_left_horizontal']}}</p>
    </div>
    <div class="col-lg-2 col-md-6 col-12">
        <h5 style="font-size: 15px">Base Direction</h5>
        <p id="add-l">{{$prescription_array['prism_left_horizontal_direction']}}</p>
    </div>
    <div class="col-lg-2 col-md-6 col-12"></div>
</div>
</div>
</div>
</div>
</div>

@endif
@endif

<p><strong>Vision :</strong> ({{$vision_data->vision_name}}) 
@if($vision_data->vision_price==0.00)

@else
- {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$vision_data->vision_price)}}
@endif
</p>

@if($is_tint=="tint")
@php
 $tint_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
@endphp
<p><strong>Lens Type :</strong> ({{$tint_parent->category_name}} - {{$lens_color_type->category_name}}) 
@if($lens_color_type->category_price==0.00)

@else
- {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens_color_type->category_price)}}
@endif
</p>

@else

<p><strong>Lens Type :</strong> ({{$lens_color_type->category_name}}) 
@if($lens_color_type->category_price==0.00)

@else
- {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens_color_type->category_price)}}
@endif
</p>

@endif

<p>{{$lens_brand->category_name}} - {{$lens_index->lens_index}} index ({{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens_data->price)}})</p>

@php
$lens_coating = DB::table('lens_coatings')->where('coating_id',$coating_ids)->first();
@endphp
@if(!empty($lens_coating))
@php
$brand_coating = DB::table('lens_brands')->where('id',$lens_coating->coating_id)->first();
@endphp
<p><strong>Coating : </strong>@if(!empty($brand_coating)) {{$brand_coating->category_name}} {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens_coating->coating_price)}} @endif  </p>
@endif
@if($prescription_array['is_prism']=="Yes")
<p><strong>Prism : </strong> {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$admin_data->prism_price)}}</p>

<p><strong>Subtotal :</strong> {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens_data->price+$vision_data->vision_price+$lens_color_type->category_price+$admin_data->prism_price)}}</p>

@else
<p><strong>Subtotal :</strong> {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens_data->price+$vision_data->vision_price+$lens_color_type->category_price+$product_data->category_discount_price)}}</p>
@endif

<form method="post" action="{{url('/add-lens-cart')}}">
 @csrf
 @method('POST')
  <input type="hidden" name="func_type" class="func_type" value="{{$func_type}}">
  <input type="hidden" name="lens_id" class="lens_id" value="{{$lens_id}}">
  <input type="hidden" name="product_id" class="product_id" value="{{$product_id}}">
  <input type="hidden" name="qty" class="qty" value="{{$qty}}">
  <input type="hidden" name="is_tint" class="is_tint" value="{{$is_tint}}">
  <input type="hidden" name="lens_color_id" class="lens_color_id" value="{{$lens_color_id}}">
  <input type="hidden" name="coating_ids" class="coating_ids" value="{{$coating_ids}}">
 <button type="submit" class="button-sun-02">Add To cart</button>
 </form>
