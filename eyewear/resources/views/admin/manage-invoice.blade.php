@extends('admin.layouts.app')

@section('title','Manage Invoice')

@section('content')

<style>
.swal-wide{
width:750px !important;
font-size:16px !important;
}
</style>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Invoice &nbsp; <i style="font-size:20px;" class="fas fa-envelope"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $invoices->total() }}</span>

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

@if($invoices->isNotEmpty())

{{-- Search Form Start --}}

<div class="container" >
 <div class="row">
  <div class="col-12 offset-md-3 offset-sm-2">

  <form class="cat-search-form" method="post" action="{{ route('invoice-search-form') }}">
  @csrf
  @method('POST')

 <div class="input-group mb-3">
@isset($search_keyword)
 <span class="badge badge-pill badge-light" id="cat-filter-span" data-toggle="tooltip" title="Remove Filter">
 <a href="{{ route('manage-invoice') }}">
  <i class="fas fa-filter" id="remove-filter-parent">
   <i class="fas fa-times" id="remove-filter-child"></i></i>
</a>
 </span> &nbsp;
@endisset

  <input class="au-input au-input--xl" type="text" name="search_keyword" placeholder="Search invoice by invoice no & order no ..." @isset($search_keyword) value="{{ $search_keyword }}" @endisset required/>
   <div class="input-group-append">
    <span class="input-group-text" id="input-group-span-search-form" >
    <button class="btn btn-primary" type="submit" id="cat-search-btn" >
    <i class="zmdi zmdi-search" id="cat-search-icon"></i>
   </button></span>
  </div>
 </div>
</form>

  </div>
 </div>
</div>

{{-- Search Form End --}}

 <div class="container-fluid">
 
  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center">S.No</th>
        <th class="text-center">Invoice No</th>
        <th class="text-center">Order No</th>
        <th class="text-center">User Name</th>
        <th class="text-center">Date</th>
        <th class="text-center">Action</th>
        <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($invoices as $invoices_data)
      @php
       $order_data=DB::table('orders')->where('id',$invoices_data->order_id)->first();
       $user_data=DB::table('users')->where('id',$order_data->order_user_id)->first();
      @endphp
        <tr>
        <td class="text-center v-align">{{ $i++ }}</td>
        <td class="text-center v-align" ><a target="_blank" href="{{asset('invoice/'.$invoices_data->invoice_pdf)}}">{{ $invoices_data->invoice_no }}</a> <i class="fas fa-arrow-right"></i></td>
        <td class="text-center v-align" >{{ $invoices_data->order_id }}</td>
        <td class="text-center v-align" >{{$user_data->name}}</td>
        <td class="text-center v-align">{{ date("d-m-Y",strtotime($invoices_data->invoice_date)) }}</td>
        
        <td>
         <form action="{{route('send-invoice-email')}}" method="post">
          @csrf
          @method('POST')
         <input type="hidden" name="invoice_pdf" value="{{$invoices_data->invoice_pdf}}"> 
        <div class="input-group">
        <input type="text" name="invoice_email" id="invoice_email" class="form-control" placeholder="Enter email. " required>
        <div class="input-group-btn">
        <button class="btn btn-dark" type="submit">
        <i class="fas fa-envelope"></i>
        </button>
        </div>
        </div>
        </form> 
        </td>

        <td class="text-center v-align">
         <a href="{{route('delete-invoice',$invoices_data->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a> 
        </td>
        
        </tr>
    @endforeach

        </tbody>
        </table>
        </div>
        </div>

      {{ $invoices->links() }}

  </div>


 </div>

 @else
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 @endif

</div>

@endsection('content')
