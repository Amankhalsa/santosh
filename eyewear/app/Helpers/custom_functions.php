<?php
 
 function getCurrencyPrice($country,$inr_price){
    if(!empty($country)){	
 	$currency = \DB::table('currencies')->where('country_name',$country)->first();
   if(!empty($currency)){
     $price = number_format($inr_price/$currency->exchange_rate,2); 
 	 return $price;    
   }else{
 	 return $inr_price;
 	}
    }else{
       return $inr_price; 
    }	
 }
 
 function getCurrencySymbol($country){
    if(!empty($country)){	
 	$currency = \DB::table('currencies')->where('country_name',$country)->first();
   if(!empty($currency)){
     $symbol = $currency->currency_symbol; 
 	 return $symbol;    
   }else{
 	 return '₹';
 	}
    }else{
       return '₹'; 
    }	
 }
 
 function getCurrencyCode($country){
    if(!empty($country)){	
 	$currency = \DB::table('currencies')->where('country_name',$country)->first();
   if(!empty($currency)){
     $currency_code = \DB::table('countries')->where('name',$country)->first();  
     $code = $currency_code->currency_code; 
 	 return $code;    
   }else{
 	 return 'INR';
 	}
    }else{
       return 'INR'; 
    }	
 }
 
// GET NEXT GENERATED ID 
 function getNextID($table){
 $statement = DB::select("show table status like '$table' ");
 return $statement[0]->Auto_increment;
}

 function generate_invoice_no(){
   $get_inv_no = \DB::table('invoices')->orderBy('id','desc')->first();
   $invoice_no = "EYEWEAR/".date('Y')."/".getNextID('invoices');
   return $invoice_no;
}

function gst($price,$gst){
    return ($price*$gst)/100;
}

 ?>