<div class="row mt-5 mb-5">
 <div class="col-md-12 text-center">
     <h4 class="divyanshu">Lens Bundle</h4>
 </div>
 </div>
@if($lens_data->isNotEmpty())
@foreach($lens_data as $lens)
@php
$prd = DB::table('categories')->where('id',$product_id)->first();
 $lens_index = DB::table('lens_index')->where('id',$lens->lens_index)->first();
 $lens_toggles = explode(',',$lens->lens_toggles);
@endphp
@if(($prd->type=="Rimless" || $prd->type=="Semi Rim")  && ($lens_index->lens_index=="1.50" || $lens_index->lens_index=="1.56"))
@else
<div class="row desc-card" id="putdown{{$lens->id}}" onclick="dropdownToggle('{{$lens->id}}')">
<div class="col-10">
<h4>{{$lens_index->lens_index}} index lens - {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$lens->price)}}</h4>
</div>
@if(!empty($lens_index->description))
<div class="col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup">{!!$lens_index->description!!}</span>
</div>
</div>
@endif
<div class="col-10">
<p>{{$lens->description}}</p>
</div>
</div>
<!-- sub nav  -->
<div class="inactive puttingdown{{$lens->id}} drpdown" style="display: none">
@php
$lens_coatings = DB::table('lens_coatings')->where('lens_id',$lens->id)->get();
$included_coating = DB::table('lens_toggles')->whereIn('id',$lens_toggles)->get();
@endphp
@if(!empty($included_coating))
@foreach($included_coating as $included)
<div id="crdsub" class="row desc-card">
<div class="col-10">
<input type="checkbox" style="width:20px;height:20px" checked disabled>-
<span class="text-gray">{{$included->toggle_name}} - Included</span>
</div>
@if(!empty($included->toggle_desc))
<div class="col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup">{!!$included->toggle_desc!!}</span>
</div>
</div>
@endif
</div>
@endforeach  
@endif


@if(!empty($lens_coatings))
@foreach($lens_coatings as $coating)
 @php
$coating_name = DB::table('lens_brands')->where('id',$coating->coating_id)->first(); 
 @endphp
<div id="crdsub" class="row desc-card">
<div class="col-10">
<input type="radio" id="test{{$coating->id}}" name="coatings[]" class="coatings[]" value="{{$coating->coating_id}}" style="width:20px;height:20px">-
<label for="test{{$coating->id}}"><strong>{{$coating_name->category_name}} - </strong>{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$coating->coating_price)}}</label>
</div>

@if(!empty($coating_name->category_tag_line)) 
<div class="col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup">{!!$coating_name->category_tag_line!!}</span>
</div>
</div>
@endif
</div>
@endforeach
@endif

<div class="lensbtn">
<button type="submit" onclick="reviewCart('{{$func_type}}','{{$lens->id}}','{{$product_id}}','{{$qty}}','{{$lens_color_id}}','{{$is_tint}}'),tokkenset('fifth-card')"> Select </button>
</div>
</div>

@endif
@endforeach

@else

<h4>No Lens Available in this prescription</h4>

@endif

<script>
 $(document).ready(function(){
     $('.drpdown').slideUp();
     dropdownToggle = (lens_id) => {
         $("[name='coatings[]']").prop('checked', false);
        $('.drpdown').addClass('inactive'); 
        $('.puttingdown'+lens_id).removeClass('inactive');
        $('.puttingdown'+lens_id).slideToggle();
        $(".inactive").slideUp();
        
     }
 });    
</script>