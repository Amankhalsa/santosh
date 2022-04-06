@extends('admin.layouts.app')

@section('title','Order Detail')

@section('content')

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
.card-body{
    padding:30px !important;
}
</style>
<style>
ul.order li{
  border-bottom: 1px solid grey;   
  list-style:none;
}
.ord-address{
 line-height:2.3;    
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  background-color: #f3f3f3;
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: black;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: black;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}

#example2 {
    border: 1px solid;
    padding: 10px;
    box-shadow: 1px 1px 14px 2px #356ed5;
    margin: 31px;
    border: 1px solid;
    border-color: #dbdadac2;
    padding: 20px;
    border-radius: 20px;
}
/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

section{
  margin: 50px;
}




/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}</style>

<script>
    // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Order Detail &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $order_detail->total() }}</span>
&nbsp;
<span style="float:right;"><a href="{{ route('manage-order') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>

</div>

</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Errors Occured!</strong>
<ul style="margin-left:25px;">
  @foreach($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

@if($order_detail->isNotEmpty())

@php
if(!empty($order_parent_data->order_coupon_id)){ 
 $coupon = DB::table('coupons')->where('id',$order_parent_data->order_coupon_id)->first();
 
} 
 
@endphp

 <div class="container-fluid">
 <form action="#" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('POST')
 

<div class="card-deck">
<div class="card bg-light">
<div class="card-body">
<ul class="order">
<li><h4> <i class="fas fa-user"></i> &nbsp; {{$order_parent_data->ship_name}}</h4> </li>   
  
<li><p class="ord-address"><i class="fas fa-map-marker"></i>
&nbsp;{{$order_parent_data->ship_address}} {{$order_parent_data->ship_city}},  {{$order_parent_data->ship_state}} - {{$order_parent_data->ship_pincode}}, {{$order_parent_data->ship_country}}.</p></li>
   
<li><p class="ord-address"><i class="fas fa-phone"></i> 
&nbsp;{{$order_parent_data->ship_mobile}}.</p></li>
   
<li><p class="ord-address"><i class="fas fa-envelope"></i>      
&nbsp;{{$order_parent_data->ship_email}}.</p></li>
   
<li><p class="ord-address"><i class="fas fa-server"></i>      
&nbsp;{{$order_parent_data->order_ip}} [ {{$order_parent_data->order_country}} ]</p></li>
 </ul>  
</div>
</div>

<div class="card bg-light">
<div class="card-body">
<p class="card-text">    
 <ul class="order">
  <li><b>Order Date: </b>&nbsp; {{date('d-F-Y',strtotime($order_parent_data->order_date))}}</li><br>
  <li><b>Order Delivery Status: </b>&nbsp; 
  <span class="badge @if($order_parent_data->order_delivery_status=='Pending') badge-warning @elseif($order_parent_data->order_delivery_status=='Dispatch') badge-info @elseif($order_parent_data->order_delivery_status=='Shipped') badge-primary @elseif($order_parent_data->order_delivery_status=='Out For Delivery') badge-light @elseif($order_parent_data->order_delivery_status=='Delivered') badge-success @elseif($order_parent_data->order_delivery_status=='Cancel') badge-danger @elseif($order_parent_data->order_delivery_status=='Hold') badge-dark @elseif($order_parent_data->order_delivery_status=='Refund') badge-info @endif">{{$order_parent_data->order_delivery_status}}</span></li><br>
  
  <li><b>Order Payment Status: </b>&nbsp; 
  <span class="badge @if($order_parent_data->order_payment_status=='Paid') badge-success @else badge-danger @endif">{{$order_parent_data->order_payment_status}}</span></li><br>
  
  <li><b>Order Payment Method: </b>&nbsp; 
  <span class="badge @if($order_parent_data->order_payment_method=='Online') badge-info @else badge-dark @endif">{{$order_parent_data->order_payment_method}}</span></li>
  
 </ul>
 </p>
</div>
</div>

<div class="card bg-light">
<div class="card-body text-center">
 <h3 style="font-weight:normal">Total: {{$order_parent_data->order_currency_symbol.$order_parent_data->order_net_amount}}</h3> 
  <br>
 <ul class="order">
    <li><b>Subtotal: </b>&nbsp; {{$order_parent_data->order_currency_symbol.$order_parent_data->order_amount}}</li><br>
    <li><b>Shipping: </b>&nbsp; {{$order_parent_data->order_currency_symbol.$order_parent_data->shipping_charges}}</li><br>
    <li><b>Discount: </b>&nbsp; {{$order_parent_data->order_currency_symbol.$order_parent_data->order_discount}}</li><br>
@if(!empty($order_parent_data->order_coupon_id))    
    <li><b>Coupon: </b>&nbsp; {{$coupon->coupon_code}}</li>
@endif    
 </ul> 
  
</div>
</div>
</div>

<br>
<div class="row">
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
$product=DB::table('categories')->where('id',$order_data->product_id)->first();
$item_name = $product->category_name; 
@endphp 
<div class="col-12 col-sm-8 col-md-6 col-lg-6">
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
<img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" width="200"/>
      X
      {{ $order_data->product_qty }}
      <br>
      <span>Price: {{$order_parent_data->order_currency_symbol.$product->category_price }}</span>
      <br>
      <span>GST: {{$order_parent_data->order_currency_symbol.$order_data->frame_gst }}</span>
      </p>
      <a target="_blank" href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="card-link text-danger">Read more</a>
    </div>

   @if(!empty($order_data->lens_id))     
    <div class="tab-pane" id="lens{{$order_data->id}}" role="tabpanel" aria-labelledby="history-tab">  
      <p class="card-text">
        @php
        $get_lens=DB::table('lenses')->where('id',$order_data->lens_id)->first();
        $lens_color_type = DB::table('lens_color_types')->where('id',$order_data->lens_color_id)->first();    
        @endphp
        {{$get_lens->name}} ({{$order_parent_data->order_currency_symbol.$get_lens->price}}) * {{$order_data->lens_qty}} + {{$order_parent_data->order_currency_symbol.$order_data->lens_gst}}[GST]<br>
        
        @php
        $get_vision=DB::table('visions')->where('id',$order_data->vision_id)->first();
        @endphp
        <b>Vision: </b> {{$get_vision->vision_name}}
        @if($get_vision->vision_price==0.00)
        (Free)
        @else
        ({{$order_parent_data->order_currency_symbol.$order_data->vision_price}})
        @endif
        <br>
        <b>Color Type: </b> {{$lens_color_type->category_name}}
        @if($lens_color_type->category_price==0.00)
        - Free
        @else
        - {{$order_parent_data->order_currency_symbol.$order_data->lens_color_price}}
        @endif
        <br>
        
        <b>Prism: </b> {{$order_parent_data->order_currency_symbol.$order_data->prism_price}}
        <br>
      @if($order_coating_count>0)    
        <b>Coating: </b> {{$order_parent_data->order_currency_symbol.$coat_price}}
        <br>
      @endif    
        <b>subtotal: </b> {{ $order_parent_data->order_currency_symbol}}{{$order_data->product_net_price}}
        
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
    <td>{{$order_parent_data->order_currency_symbol.$coating->coating_price}}</td>
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


 {{ $order_detail->links() }}
  


</form>
 </div>

 @else
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 @endif

</div>

@endsection('content')

