<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta name="x-apple-disable-message-reformatting">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="telephone=no" name="format-detection">
<title>{{$admin_data->admin_company_name}}</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<!--[if (mso 16)]>
<style type="text/css">
a {text-decoration: none;}
</style>
<![endif]-->
<!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
<!--[if gte mso 9]>
<xml>
<o:OfficeDocumentSettings>
<o:AllowPNG></o:AllowPNG>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>

<body>
<div class="es-wrapper-color">
<!--[if gte mso 9]>
<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
<v:fill type="tile" color="#efefef"></v:fill>
</v:background>
<![endif]-->
<table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-email-paddings" valign="top">
<table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
<tbody>
<tr>
<td class="es-adaptive esd-stripe" esd-custom-block-id="1733" align="center">
<table class="es-content-body" style="background-color: #efefef;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure es-p15t es-p15b es-p20r es-p20l" align="left">
<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->

<!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->

<!--[if mso]></td></tr></table><![endif]-->
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" class="es-header" align="center">
<tbody>
<tr>
<td align="center" bgcolor="#c44d39" style="background-color: #ff9933;">
<!--[if mso]><table dir="rtl" width="560" cellpadding="0" cellspacing="0"><tr><td dir="ltr" width="270" valign="top"><![endif]-->
<table class="es-header-body" style="background-color: #ff9933;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ff9933" align="center">
<tbody>
<tr>
<td width="270" align="left" class="esd-container-frame es-m-p20b">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="right" esd-links-color="#ffffff" class="esd-block-text es-m-txt-c">
<p style="color: #ffffff;margin-right:10px;"><a target="_blank" style="color: #ffffff;" class="view"><i class="fa fa-phone"></i> {{$admin_data->admin_mobile}}</a></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td><td dir="ltr" width="20"></td><td dir="ltr" width="270" valign="top"><![endif]-->
<table cellpadding="0" cellspacing="0" align="left" class="es-left">
<tbody>
<tr>
<td width="270" class="esd-container-frame" align="left">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td class="esd-block-text es-m-txt-c">
<p style="margin-left:20px;">
<img src="{{asset('uploaded_files/logo/'.$admin_data->admin_logo)}}">
</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td></tr></table><![endif]-->
</td>
</tr>
<!--##@@@@-->
</tbody>
</table>
@php
$order = DB::table('orders')->where('id',$order_id)->first();
@endphp
<table class="es-content" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="esd-stripe" esd-custom-block-id="1754" align="center">
<table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure es-p10t es-p10b es-p20r es-p20l" esd-general-paddings-checked="false" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-container-frame" width="560" valign="top" align="center">
<table style="border-radius: 0px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text es-p10t es-p15b" align="center">
<h1>Your order is out for delivery<br></h1>
</td>
</tr>
<tr>
<td class="esd-block-text es-p5t es-p5b es-p40r es-p40l" align="center">
<p style="color: #333333;">You'll receive an email when your items are shipped. If you have any questions, Call us {{$admin_data->admin_mobile}}.
@if($order->tracking_no)
<h3>Your Order Tracking No is: <b>{{$order->tracking_no}}</b></h3>
@endif
</p>
</td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table class="es-content" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="esd-stripe" esd-custom-block-id="1755" align="center">
<table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure es-p20t es-p30b es-p20r es-p20l" align="left">
<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="280" valign="top"><![endif]-->
<table class="es-left" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td class="es-m-p20b esd-container-frame" width="280" align="left">
<table style="background-color: #fef9ef; border-color: #efefef; border-collapse: separate; border-width: 1px 0px 1px 1px; border-style: solid;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
<tbody>
<tr>
<td class="esd-block-text es-p20t es-p10b es-p20r es-p20l" align="left">
<h4>SUMMARY:</h4>
</td>
</tr>


<tr>
<td class="esd-block-text es-p20b es-p20r es-p20l" align="left">
<table style="width: 100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left">
<tbody>
<tr>
<td><span style="font-size: 14px; line-height: 150%;">Order #:</span></td>
<td><span style="font-size: 14px; line-height: 150%;">{{$order_id}}</span></td>
</tr>
<tr>
<td><span style="font-size: 14px; line-height: 150%;">Order Date:</span></td>
<td><span style="font-size: 14px; line-height: 150%;">
{{date('d-M-Y',strtotime($order->order_date))}}</span></td>
</tr>
<tr>
<td><span style="font-size: 14px; line-height: 150%;">Order Total:</span></td>
<td><span style="font-size: 14px; line-height: 150%;">{{$order->order_currency_symbol.$order->order_net_amount}}</span></td>
</tr>
</tbody>
</table>
<p style="line-height: 150%;"><br></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td><td width="0"></td><td width="280" valign="top"><![endif]-->
<table class="es-right" cellspacing="0" cellpadding="0" align="right">
<tbody>
<tr>
<td class="esd-container-frame" width="280" align="left">
<table style="background-color: #fef9ef; border-collapse: separate; border-width: 1px; border-style: solid; border-color: #efefef;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
<tbody>
<tr>
<td class="esd-block-text es-p20t es-p10b es-p20r es-p20l" align="left">
<h4>SHIPPING ADDRESS:<br></h4>
</td>
</tr>
<tr>
<td class="esd-block-text es-p20b es-p20r es-p20l" align="left">
<p>{{$order->ship_name}}</p>
<p>{{$order->ship_address}}, {{$order->ship_city}}</p>
<p>{{$order->ship_state}} {{$order->ship_country}} - {{$order->ship_pincode}}</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td></tr></table><![endif]-->
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table class="es-content" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="esd-stripe" esd-custom-block-id="1758" align="center">
<table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure es-p10t es-p10b es-p20r es-p20l" esd-general-paddings-checked="false" align="left">
<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
<table class="es-left" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td class="es-m-p0r es-m-p20b esd-container-frame" width="270" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text es-p20l" align="left">
<h4>ITEMS ORDERED</h4>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
<table cellspacing="0" cellpadding="0" align="right">
<tbody>
<tr>
<td class="esd-container-frame" width="270" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text" align="left">
<table style="width: 100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
    <td><span style="font-size:13px;">NAME</span></td>
    <td style="text-align: center;" width="60"><span style="font-size:13px;"><span style="line-height: 100%;">QTY</span></span></td>
    <td style="text-align: center;" width="100"><span style="font-size:13px;"><span style="line-height: 100%;">PRICE</span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td></tr></table><![endif]-->
</td>
</tr>
<tr>
<td class="esd-structure es-p20r es-p20l" esd-general-paddings-checked="false" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-container-frame" width="560" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-spacer es-p10b" align="center" style="font-size:0">
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
    <td style="border-bottom: 1px solid #efefef; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>

@php
 $ord_count = DB::table('order_details')->where('order_id',$order_id)->count(); 
 $order_detail = DB::table('order_details')->where('order_id',$order_id)->get();
@endphp
@foreach($order_detail as $detail)
@php
 $product = DB::table('categories')->where('id',$detail->product_id)->first();
@endphp
<tr>
<td class="esd-structure es-p5t es-p10b es-p20r es-p20l" esd-general-paddings-checked="false" align="left">
<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="178" valign="top"><![endif]-->
<table class="es-left" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td class="es-m-p0r es-m-p20b esd-container-frame" width="178" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-image" align="center" style="font-size:0"><a href="#" target="_blank"><img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" class="adapt-img" title="{{$product->category_name}}" width="95"></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td><td width="20"></td><td width="362" valign="top"><![endif]-->
<table cellspacing="0" cellpadding="0" align="right">
<tbody>
<tr>
<td class="esd-container-frame" width="362" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text" align="left">
<p><br></p>
<table style="width: 100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0">
<tbody>
<tr>
    <td>{{$product->category_name}}
     @if(!empty($detail->lens_id)) 
        <h5>Lens Detail</h5>
        @php
        $vision_detail = DB::table('visions')->where('id',$detail->vision_id)->first();
        $lens_detail = DB::table('lenses')->where('id',$detail->lens_id)->first();
        $lens_color_type = DB::table('lens_color_types')->where('id',$detail->lens_color_id)->first();
        $lens_index = DB::table('lens_index')->where('id',$lens_detail->lens_index)->first();
        @endphp
        <p>Vision: {{$vision_detail->vision_name}}
        @if($detail->vision_price==0.00)
        (Free)
        @else
        ({{$order->order_currency_symbol}}{{$detail->vision_price}})
        @endif
        </p>

        @php
        $lens_color_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
        @endphp
        @if($detail->is_tint=="tint")

        <p>Color Type: {{$lens_color_parent->category_name}} - {{$lens_color_type->category_name}}
        @if($detail->lens_color_price==0.00)
        - Free
        @else
        - {{$order->order_currency_symbol}}{{$detail->lens_color_price}}
        @endif
        </p>

        @else

        <p>Color Type: {{$lens_color_type->category_name}}
        @if($detail->lens_color_price==0.00)
        - Free
        @else
        - {{$order->order_currency_symbol}}{{$detail->lens_color_price}}
        @endif
        </p>
        @endif

        <p>Lens: {{$lens_detail->name}} ({{$lens_index->lens_index}}) + {{$detail->lens_price}}</p>

        @if($detail->is_prism=="Yes")
        <p>Prism: {{$order->order_currency_symbol.$detail->prism_price}}</p>
        @endif

        @php
        $coat_price="0.00";
        $check_coating = DB::table('order_coating')->where('order_id',$detail->id)->count();
        @endphp
        @if($check_coating>0)
        @php
        $coatings = DB::table('order_coating')->where('order_id',$detail->id)->get();
        foreach($coatings as $coat){
        $coat_price += $coat->coating_price;
        } 
        @endphp
        <p>Lens Coating: {{$order->order_currency_symbol.$coat_price}}</p>
        @endif

        @endif
    
    </td>
    <td style="text-align: center;" width="60">{{$detail->product_qty}}</td>
    <td style="text-align: center;" width="100">{{$detail->product_unit_price}}</td>
</tr>
</tbody>
</table>
<p><br></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td></tr></table><![endif]-->
</td>
</tr>

@endforeach

<tr>
<td class="esd-structure es-p20r es-p20l" esd-general-paddings-checked="false" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-container-frame" width="560" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-spacer es-p10b" align="center" style="font-size:0">
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
    <td style="border-bottom: 1px solid #efefef; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="esd-structure es-p5t es-p30b es-p40r es-p20l" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-container-frame" width="540" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text" align="right">
<table style="width: 500px;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="right">
<tbody>
<tr>
    <td style="text-align: right; font-size: 18px; line-height: 150%;">Subtotal ({{$ord_count}} items):</td>
    <td style="text-align: right; font-size: 18px; line-height: 150%;">{{$order->order_currency_symbol.$order->order_amount}}</td>
</tr>
<tr>
    <td style="text-align: right; font-size: 18px; line-height: 150%;">Discount:</td>
    <td style="text-align: right; font-size: 18px; line-height: 150%;">{{$order->order_currency_symbol.$order->order_discount}}</td>
</tr>
<tr>
    <td style="text-align: right; font-size: 18px; line-height: 150%;"><strong>Order Total:</strong></td>
    <td style="text-align: right; font-size: 18px; line-height: 150%; color: #d48344;"><strong>{{$order->order_currency_symbol.$order->order_net_amount}}</strong></td>
</tr>
</tbody>
</table>
<p style="line-height: 150%;"><br></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" class="es-footer" align="center">
<tbody>
<tr>
<td class="esd-stripe" esd-custom-block-id="1748" align="center">
<table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="esd-structure es-p20" esd-general-paddings-checked="false" align="left">
<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="178" valign="top"><![endif]-->
<table class="es-left" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td class="es-m-p0r es-m-p20b esd-container-frame" width="178" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-image es-m-p0l es-m-txt-c" align="left" style="font-size:0"><a href="{{url('/')}}" target="_blank"><img src="{{asset('uploaded_files/logo/'.$admin_data->admin_logo)}}" alt="{{$admin_data->admin_company_name}}" title="{{$admin_data->admin_company_name}}" width="108"></a></td>
</tr>
<tr>
<td class="esd-block-text es-p10t es-p5b es-m-txt-c" align="left">
<p>{{ $admin_data->admin_address }} <br> {{ $admin_data->admin_city }}, {{ $admin_data->admin_state }} <br> {{ $admin_data->admin_zip_code }}, {{ $admin_data->admin_country }}</p>
</td>
</tr>
<tr>
<td class="esd-block-text es-p5t es-m-txt-c" align="left">
<p><a target="_blank" href="tel:{{$admin_data->admin_mobile}}">{{$admin_data->admin_mobile}}</a><br><a target="_blank" href="mailto:{{$admin_data->email}}">{{$admin_data->email}}</a></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td><td width="20"></td><td width="362" valign="top"><![endif]-->
<table cellspacing="0" cellpadding="0" align="right">
<tbody>
<tr>
<td class="esd-container-frame" width="362" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text es-p15t es-p20b es-m-txt-c" align="left">
<p style="line-height: 150%;"><span style="font-size: 20px; line-height: 150%;">Information</span></p>
</td>
</tr>
<tr>
<td class="esd-block-text es-m-txt-c" align="left">
<p><a target="_blank" href="{{url('/')}}">{{$admin_data->admin_company_name}} </a><br></p>
<p>© Copyright © 2020. All Rights Reserved | Designed By<br></p>
</td>
</tr>
<tr>
<td align="left" class="esd-block-text es-p10t es-m-txt-c">
<p style="line-height: 150%; font-size: 12px;">
<a target="_blank" href="{{url('/terms-and-conditions.html')}}" style="line-height: 150%; font-size: 12px;" class="unsubscribe">Terms & Conditions</a> ♦ <a target="_blank" href="{{url('/privacy-policy.html')}}" style="font-size: 12px;">Privacy Policy</a></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td></tr></table><![endif]-->
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</body>

</html>
