@extends('admin.layouts.app')

@section('title','Manage Order')

@section('content')

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
</style>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Order &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">

<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $orders->total() }}</span>


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

@if($orders->isNotEmpty())

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-orders') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('POST')
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Order ID</th>
        <th class="text-center">User</th>
        <th class="text-center">Net Amount</th>
        <th class="text-center">Delivery</th>
        <th class="text-center">Payment</th>
        <th class="text-center">Date</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $order_delivery_status="";
     @endphp
     @foreach($orders as $order_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="order_ids[]" id="ids[]" class="order_ids" value="{{ $order_data->id }}"/> {{ $i++ }}
        
        <a href="{{route('print-order',$order_data->id)}}"><i class="fas fa-print"></i></a>
        </td>
        
        <td class="text-center v-align">
          <a href="{{ route('order-detail',$order_data->id) }}">#luxury{{ $order_data->id }} <i class="fas fa-arrow-right"></i></a>
        @if($order_data->order_coupon_id>0)  
          <br>
          <a href="{{ route('edit-coupon',$order_data->order_coupon_id) }}" style="color: #f87272">coupon used <i class="fas fa-arrow-right"></i></a>
        @endif 
        @php
    $checkInvoice = DB::table('invoices')->where('order_id',$order_data->id)->count();
    @endphp    
      @if($checkInvoice==0)  
        <br>
        <a href="{{route('generate-invoice',$order_data->id)}}" class="btn btn-dark">Generate Invoice</a>
      @endif 
      
     <a href="javascript:void(0)" class="btn btn-info" onclick="tracking('{{$order_data->id}}','{{$order_data->tracking_no}}')">Tracking No</a> 
      
        </td>
        <td class="text-center v-align" >
        @php
         $user_email=DB::table('users')->where('id',$order_data->order_user_id)->select('email')->first();
        @endphp
          {{ $user_email->email }}
        <br>
        <a href="javascript:void()" class="btn btn-primary btn-sm" onclick="popupWindow('{{route('view-address',$order_data->id)}}', 'Luxury Eye Wear', window, 600, 400);">Address</a>
        </td>
       
        <td class="text-center v-align" >{{$order_data->order_currency_symbol.$order_data->order_net_amount }}</td>

        <td class="text-center v-align">
        @if($order_data->order_delivery_status=="Pending")
        <span class="badge badge-warning">{{ $order_data->order_delivery_status }}</span>
        @elseif($order_data->order_delivery_status=="Delivered")
        <span class="badge badge-success">{{ $order_data->order_delivery_status }}</span>
        @else
        <span class="badge badge-danger">{{ $order_data->order_delivery_status }}</span>
        @endif
        </td>
        
        <td class="text-center v-align">
        @if($order_data->order_payment_status=="Paid")
        <span class="badge badge-dark">{{ $order_data->order_payment_status }}</span>
        @else($order_data->order_payment_status=="Unpaid")
        <span class="badge badge-light">{{ $order_data->order_payment_status }}</span>
        @endif
        </td>

        <td class="text-center v-align">{{date('d-m-y',strtotime($order_data->order_date))}}</td>
       
        </tr>
    @endforeach

        </tbody>
        </table>
        </div>
        </div>

        {{ $orders->links() }}
  </div>

<!-- BOTTOM BUTTONS -->

<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->
   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Pending">
   <input type="submit" class="btn btn-info req_for" name="req_for" value="Dispatch" style="margin-left:10px;">
   <input type="submit" class="btn btn-primary req_for" name="req_for" value="Shipped" style="margin-left:10px;">
   <input type="submit" class="btn btn-light req_for" name="req_for" value="Out For Delivery" style="margin-left:10px;">
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Delivered" style="margin-left:10px;">
   
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Cancel" style="margin-left:10px;">
   <input type="submit" class="btn btn-dark req_for" name="req_for" value="Hold" style="margin-left:10px;">
   <input type="submit" class="btn btn-info req_for" name="req_for" value="Refund" style="margin-left:10px;">
   
   <input type="submit" class="btn btn-dark req_for" name="req_for" value="Paid" style="margin-left:10px;">
   <input type="submit" class="btn btn-light req_for" name="req_for" value="Unpaid" style="margin-left:10px;">
   
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</form>
 </div>

 @else
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 @endif

</div>

<!-- Modal -->
<div id="tracking" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tracking No</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container">
  <h4>Update Tracking No</h4>
  
  <form action="{{route('update-tracking')}}" method="post">
@csrf
@method('POST')
    <div class="input-group">
     <input type="hidden" name="order_id" class="order_id">    
      <input type="text" class="form-control tracking_no" placeholder="Enter Tracking No" name="tracking_no">
      <div class="input-group-btn">
        <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>
</div>
      </div>
      
    </div>

  </div>
</div>

@endsection('content')
<script>
    function tracking(order_id,tracking_no){
       $('.order_id').val(order_id);
       $('.tracking_no').val(tracking_no);
       $('#tracking').modal();
    }
</script>