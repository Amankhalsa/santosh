@extends('user.layouts.app')

@section('user-content')

<style type="text/css">

.panel-heading {
background-color: #d3d3d326;
padding: 10px;
border-radius: 5px;
}

.panel-group{
cursor: pointer;
}
</style> 

<h4>Order History</h4>
<br>
<div class="container">
@php
$i=1;
@endphp
@foreach($orders as $order)

<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading MyAccount-content">
<h4 class="panel-title">
<a data-toggle="collapse" data-toggle="collapse" href="#collapse{{$i}}">
        View Order Detail</a>
</h4>
<table class="m-0 table-bordered table-responsive" style="width:100%;">
<thead>
<tr>
<th class=""><span class="nobr">Order</span></th>
<th class=""><span class="nobr">Net Amount</span></th>
<th class=""><span class="nobr">Date</span></th>
<th class=""><span class="nobr">Order Status</span></th>
@if(!empty($order->tracking_no))
<th class=""><span class="nobr">Tracking No</span></th>
@endif
</tr>
</thead>

<tbody>
<tr class="">
<td class="" data-title="Order">
<a>#EYEWEAR{{ $order->id }}</a>

</td>
<td class="" data-title="Net Amount"><a><i class="fas fa-inr"></i> {{$order->order_net_amount}}</a>
</td>
<td class="" data-title="Date">
<a><i class="fas fa-calendar"></i> {{$order->order_date}}</a>
</td>
<td class="" data-title="Order Status">
<a><span class="badge @if($order->order_delivery_status == "Delivered") badge-success @else badge-warning @endif"> {{$order->order_delivery_status}}</a>
</td>
@if(!empty($order->tracking_no))
<td class="" data-title="Order Tracking">
<a> {{$order->tracking_no}} </a>
</td>
@endif
</tr>

</tbody>
</table>
</div>
<div id="collapse{{$i}}" class="panel-collapse collapse">
<div class="panel-body">

<div class="row">
@php
$order_detail = DB::table('order_details')->where('order_id',$order->id)->where('order_parent_id',0)->get();
@endphp    
@foreach($order_detail as $order_data)
@php
$coat_price=0.00;
$coatings = DB::table('order_coating')->where('order_id',$order_data->id)->get();
 $order_coating_count = DB::table('order_coating')->where('order_id',$order_data->id)->count();
if($order_coating_count>0){
$coat = DB::table('order_coating')->where('order_id',$order_data->id)->get();
foreach($coat as $data){
$coat_price += $data->coating_price;
}}
 
$item_name="";
$product_name=DB::table('categories')->where('id',$order_data->product_id)->first();
$item_name = $product_name->category_name; 
@endphp 
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="card">
<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" href="#frame{{$order_data->id}}" role="tab" aria-controls="frame" aria-selected="true">Frame Detail</a>
    </li>
@if(!empty($order_data->lens_id))    
<li class="nav-item">
<a class="nav-link"  href="#lens{{$order_data->id}}" role="tab" aria-controls="lens" aria-selected="false">Lens Detail</a></li>
   
<li class="nav-item">
<a class="nav-link" href="#prescription{{$order_data->id}}" role="tab" aria-controls="prescription" aria-selected="false">Prescription</a></li>
@if($order_coating_count>0)
<li class="nav-item">
<a class="nav-link" href="#coating{{$order_data->id}}" role="tab" aria-controls="coating" aria-selected="false">Coating</a></li>
@endif
@endif 
  </ul>
</div>
<div class="card-body">
  <h4 class="card-title">{{ $item_name }} ({{$order_data->product_color}})
  
  <span style="float:right;font-weight:normal">Item Id: {{$order_data->id}}</span>
  </h4>
  
   <div class="tab-content mt-3">
    <div class="tab-pane active" id="frame{{$order_data->id}}" role="tabpanel">
      <p class="card-text">
<img src="{{asset('uploaded_files/product/'.$product_name->category_image_name)}}" width="200"/>
      X
      {{ $order_data->product_qty }}
      <br>
      <span>Price: {{$order->order_currency_symbol.$order_data->product_unit_price }}</span>
      
      </p>
      <a target="_blank" href="{{url('/frame/'.$product_name->category_slug_name.'.html')}}" class="card-link text-danger">Read more</a>
    </div>

   @if(!empty($order_data->lens_id))     
    <div class="tab-pane" id="lens{{$order_data->id}}" role="tabpanel" aria-labelledby="history-tab">  
      <p class="card-text">
        @php
        $get_lens=DB::table('lenses')->where('id',$order_data->lens_id)->first();
        $lens_color_type = DB::table('lens_color_types')->where('id',$order_data->lens_color_id)->first();    
        @endphp
        {{$get_lens->name}} ({{$order->order_currency_symbol.$order_data->lens_price}}) * {{$order_data->lens_qty}}<br>
        
        @php
        $get_vision=DB::table('visions')->where('id',$order_data->vision_id)->first();
        @endphp
        <b>Vision: </b> {{$get_vision->vision_name}}
        @if($get_vision->vision_price==0.00)
        (Free)
        @else
        ({{$order->order_currency_symbol.$order_data->vision_price}})
        @endif
        <br>
        <b>Color Type: </b> {{$lens_color_type->category_name}}
        @if($lens_color_type->category_price==0.00)
        - Free
        @else
        - {{$order->order_currency_symbol.$order_data->lens_color_price}}
        @endif
        <br>
        
        <b>Prism: </b> {{$order->order_currency_symbol.$order_data->prism_price}}
        <br>
      @if($order_coating_count>0)    
        <b>Coating: </b> {{$order->order_currency_symbol.$coat_price}}
        <br>
      @endif    
        <b>subtotal: </b> {{ $order->order_currency_symbol}}{{$order_data->product_net_price}}
        
      </p>
    </div>
   @endif
     
<div class="tab-pane" id="prescription{{$order_data->id}}" role="tabpanel" aria-labelledby="deals-tab">
@if($order_data->is_prescription_uploaded=="No" && $order_data->is_power!="No")  
   <div class="tbl-content">
    <h4>Prescription</h4>   
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <tr style="background-color:#efefef;">
          <th>   </th>
          <th>SPH</th>
        <th>CYL</th>
        <th>AXIS</th>
        <th>ADD</th>
        <th>PD</th>
        </tr>
        <tr>
         <td>Right</td>
        <td >{{$order_data->sph_right}}</td>
        <td >{{$order_data->cyl_right}}</td>
        <td >{{$order_data->axis_right}}</td>
        <td >{{$order_data->add_right}}</td>
        @if($order_data->is_pd2=="Yes")
        <td >{{$order_data->pupillary_distance_right}}</td>
        @else
        <td >{{$order_data->pupillary_distance}}</td>
        @endif
        </tr>
        <tr>
          <td>Left</td>
        <td class="os_sph">{{$order_data->sph_left}}</td>
        <td class="os_cyl">{{$order_data->cyl_left}}</td>
        <td class="os_axis">{{$order_data->axis_left}}</td>
        <td class="os_add">{{$order_data->add_left}}</td>
        @if($order_data->is_pd2=="Yes")
        <td class="os_pd" >{{$order_data->pupillary_distance_left}}</td>
        @endif
        </tr>
      </tbody>
    </table>
    
    <p><strong>Description:</strong> {{$order_data->prescription_comment}}</p>
  </div> 
  
@if($order_data->is_prism=="Yes")  
    <div class="tbl-content">
    <h4>Prism</h4>   
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <tr style="background-color:#efefef;">
          <th>   </th>
          <th>Vertical (Δ)</th>
        <th>Base Direction</th>
        <th>Horizontal (Δ)</th>
        <th>Base Direction</th>
        </tr>
        <tr>
         <td>Right</td>
        <td >{{$order_data->prism_right_vertical}}</td>
        <td >{{$order_data->prism_right_vertical_direction}}</td>
        <td >{{$order_data->prism_right_horizontal}}</td>
        <td >{{$order_data->prism_right_horizontal_direction}}</td>
        </tr>
        <tr>
          <td>Left</td>
        <td class="os_sph">{{$order_data->prism_left_vertical}}</td>
        <td class="os_cyl">{{$order_data->prism_left_vertical_direction}}</td>
        <td class="os_axis">{{$order_data->prism_left_horizontal}}</td>
        <td class="os_add">{{$order_data->prism_left_horizontal_direction}}</td>
        </tr>
        
      </tbody>
    </table>
  </div>
@endif 
@else
@if($order_data->is_prescription_uploaded=="Yes")
<div class="tbl-content">
 <h4>Prescription</h4> 
  <a target="_blank" href="{{url('/uploaded_files/prescription/'.$order_data->uploaded_prescription)}}">View Prescription</a>
</div>
 @endif
@endif
  
</div>
    
<div class="tab-pane" id="coating{{$order_data->id}}" role="tabpanel" aria-labelledby="deals-tab">
<div class="container">
              
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Coating Name</th>
        <th>Coating Price</th>
      </tr>
    </thead>
    <tbody>
        
@foreach($coatings as $coating)        
@php
 $coat = DB::table('lens_coatings')->where('coating_id',$coating->coating_id)->first();
 $name = DB::table('lens_brands')->where('id',$coat->coating_id)->first();
@endphp 
  <tr>
    <td>{{$name->category_name}}</td>
    <td>{{$order->order_currency_symbol.$coating->coating_price}}</td>
  </tr>
@endforeach      
    </tbody>
  </table>
</div>
</div>
    
  </div>
</div>
</div>
</div>
@endforeach
  </div>

</div>

</div>
</div>
</div>
<br>
@php
$i++;
@endphp
@endforeach


</div>

@endsection