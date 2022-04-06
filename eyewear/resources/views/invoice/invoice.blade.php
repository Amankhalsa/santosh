<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{{$admin_data->admin_company_name}}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
*{ font-family: DejaVu Sans !important;}
.invoice-box {
    max-width: 900px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }
    
    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

/** RTL **/
.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
</head>

<body>
<div class="invoice-box">
<table cellpadding="0" cellspacing="0">
<tr class="top">
<td colspan="4">
<table>
    <tr>
        <td>
            <img src="{{asset('uploaded_files/logo/'.$admin_data->admin_logo)}}" style="width:100%; max-width:300px;">
        </td>
        
        <td>
            Invoice #: {{$invoice_no}}<br>
            Created: {{date('d-M-y')}}
        </td>
    </tr>
</table>
</td>
</tr>
 @php
 $order = DB::table('orders')->where('id',$order_id)->first();
 $order_detail = DB::table('order_details')->where('order_id',$order_id)->get();
@endphp       
<tr class="information">
<td colspan="4">
<table>
<tr>
    <td><b>Customer Detail :</b><hr>
        {{$order->ship_name}}<br>
        {{$order->ship_email}}<br>
        {{$order->ship_address}}<br>
        {{$order->ship_city}}, 
        {{$order->ship_state}} - {{$order->ship_pincode}}
        {{$order->ship_country}}
      
    </td>
    
    <td><b>Company Detail :</b><hr>
        {{$admin_data->admin_company_name}}<br>
        {{$admin_data->admin_name}}<br>
        {{$admin_data->email}}
    </td>
</tr>
</table>
</td>
</tr>

        <tr >
            <td>
                Payment Method
            </td>
            
            <td>
                {{$order->order_payment_method}}
            </td>
        </tr>
        
        
        <tr class="heading">
            <td>
                Item
            </td>

            <td>
            	price
            </td>
            
            <td>
            	Qty
            </td>

            <td>
               Net Price
            </td>
        </tr>
        
        
 @foreach($order_detail as $ord)
  @php
   $prd = DB::table('categories')->where('id',$ord->product_id)->first();
   $parent = DB::table('categories')->where('id',$prd->category_parent_id)->first();
  @endphp
        <tr class="item">
            <td>
           Brand :  {{$parent->category_name}}<br>    
      {{$prd->category_name}}
       <br>
        {{$prd->category_uan_code}}
       <br>
       EAN : {{$prd->category_sku_code}}
              
             @if(!empty($ord->lens_id)) 
        <h5>Lens Detail</h5>
        @php
        $vision_detail = DB::table('visions')->where('id',$ord->vision_id)->first();
        $lens_detail = DB::table('lenses')->where('id',$ord->lens_id)->first();
        $lens_color_type = DB::table('lens_color_types')->where('id',$ord->lens_color_id)->first();
        $lens_index = DB::table('lens_index')->where('id',$lens_detail->lens_index)->first();
        @endphp
        <p>Vision: {{$vision_detail->vision_name}}
        @if($ord->vision_price==0.00)
        (Free)
        @else
        ({{$order->order_currency_symbol}}{{$ord->vision_price}})
        @endif
        </p>

        @php
        $lens_color_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
        @endphp
        @if($ord->is_tint=="tint")

        <p>Color Type: {{$lens_color_parent->category_name}} - {{$lens_color_type->category_name}}
        @if($ord->lens_color_price==0.00)
        - Free
        @else
        - {{$order->order_currency_symbol}}{{$ord->lens_color_price}}
        @endif
        </p>

        @else

        <p>Color Type: {{$lens_color_type->category_name}}
        @if($ord->lens_color_price==0.00)
        - Free
        @else
        - {{$order->order_currency_symbol}}{{$ord->lens_color_price}}
        @endif
        </p>
        @endif

        <p>Lens: {{$lens_detail->name}} ({{$lens_index->lens_index}}) + {{$lens_detail->price}}+{{$ord->lens_gst}}[GST]</p>

        @if($ord->is_prism=="Yes")
        <p>Prism: {{$order->order_currency_symbol.$ord->prism_price}}</p>
        @endif

        @php
        $coat_price="0.00";
        $check_coating = DB::table('order_coating')->where('order_id',$ord->id)->count();
        @endphp
        @if($check_coating>0)
        @php
        $coatings = DB::table('order_coating')->where('order_id',$ord->id)->get();
        foreach($coatings as $coat){
        $coat_price += $coat->coating_price;
        } 
        @endphp
        <p>Lens Coating: {{$order->order_currency_symbol.$coat_price}}</p>
        @endif

        @endif

            </td>
            <td>
              
              {{$prd->category_price}}+{{$ord->frame_gst}}[GST]
            	
            </td>
            <td>
            	x {{$ord->product_qty}}
            </td>
            <td>
            	{{$ord->product_net_price}}
            </td>
        </tr>
  @endforeach      
        
        <tr class="total">
            <td></td>
            
            <td>
               Total: {{$order->order_amount}}
            </td>
        </tr>
    </table>
    <div class="card-body">

        
<div class="tab-pane active show" id="prescription130" role="tabpanel" aria-labelledby="deals-tab">
@if($ord->is_prescription_uploaded=="No" && $ord->is_power!="No")     
 <div class="tbl-content">
    <h4>Prescription</h4>   
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <tr class="page_speed_946135508">
          <th>   </th>
          <th>SPH</th>
        <th>CYL</th>
        <th>AXIS</th>
        <th>ADD</th>
        <th>PD</th>
        </tr>
        <tr>
         <td>Right</td>
        <td>{{$ord->sph_right}}</td>
        <td>{{$ord->cyl_right}}</td>
        <td>{{$ord->axis_right}}</td>
        <td>{{$ord->add_right}}</td>
         @if($ord->is_pd2=="Yes")
        <td >{{$ord->pupillary_distance_right}}</td>
        @else
        <td >{{$ord->pupillary_distance}}</td>
        @endif
        </tr>
        <tr>
          <td>Left</td>
        <td class="os_sph">{{$ord->sph_left}}</td>
        <td class="os_cyl">{{$ord->cyl_left}}</td>
        <td class="os_axis">{{$ord->axis_left}}</td>
        <td class="os_add">{{$ord->add_left}}</td>
        @if($ord->is_pd2=="Yes")
        <td class="os_pd" >{{$ord->pupillary_distance_left}}</td>
        @endif       
        </tr>
      </tbody>
    </table>
    @if(!empty($ord->prescription_comment))
    <p><strong>Description:</strong> {{$ord->prescription_comment}}</p>
    @endif
  </div> 
@endif  
  
 @if($ord->is_prism=="Yes") 
    <div class="tbl-content">
    <h4>Prism</h4>   
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <tr class="page_speed_946135508">
          <th>   </th>
          <th>Vertical (Δ)</th>
        <th>Base Direction</th>
        <th>Horizontal (Δ)</th>
        <th>Base Direction</th>
        </tr>
        <tr>
         <td>Right</td>
        <td>{{$ord->prism_right_vertical}}</td>
        <td>{{$ord->prism_right_vertical_direction}}</td>
        <td>{{$ord->prism_right_horizontal}}</td>
        <td>{{$ord->prism_right_horizontal_direction}}</td>
        </tr>
        <tr>
          <td>Left</td>
        <td class="os_sph">{{$ord->prism_left_vertical}}</td>
        <td class="os_cyl">{{$ord->prism_left_vertical_direction}}</td>
        <td class="os_axis">{{$ord->prism_left_horizontal}}</td>
        <td class="os_add">{{$ord->prism_left_horizontal_direction}}</td>
        </tr>
        
      </tbody>
    </table>
  </div>
  @endif
</div>
    

    
  </div>
</div>
</body>
</html>