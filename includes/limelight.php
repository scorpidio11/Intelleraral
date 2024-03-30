<?php

function safeRequestLimelight($strGet) {
      $strGet = preg_replace("/[^\-a-zA-Z0-9\_]*/m","",$strGet);
      //$strGet = preg_replace("/[^a-zA-Z0-9(\040)\(\)']*/m","",$strGet); //<--to allow space \040
      $strGet = str_ireplace("javascript","",$strGet);
      $strGet = str_ireplace("encode","",$strGet);
      $strGet = str_ireplace("decode","",$strGet);
      return trim($strGet);
}

function NewProspectLimelight($campaign_id,$fields_fname,$fields_lname,$fields_address1,$fields_address2,$fields_city,$fields_state,$fields_zip,$country_2_digit,$fields_phone,$fields_email,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$click_id,$notes='') {
	global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	$fields = array(
		'username' => $limelight_api_username,
		'password' => $limelight_api_password,
		'method' => 'NewProspect',
		'campaignId'=> $campaign_id,
		'firstName'=>trim($fields_fname),
		'lastName'=>trim($fields_lname),
		'address1'=>trim($fields_address1),
		'address2'=>trim($fields_address2),
		'city'=>trim($fields_city),
		'state'=>trim($fields_state),
		'zip'=>trim($fields_zip),
		'country'=>$country_2_digit, 
		'phone'=>trim($fields_phone),
		'email'=>trim($fields_email),
		'AFID'=>trim($AFID),
		'SID'=>trim($SID),
		'AFFID'=>trim($AFFID),
		'C1'=>trim($C1),
		'C2'=>trim($C2),
		'C3'=>trim($C3),
		'AID'=>trim($AID),
		'OPT'=>trim($OPT),
		'click_id'=>trim($click_id),
		'notes'=>$notes,
		'ipAddress'=>$_SERVER['REMOTE_ADDR']
	);
	
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
    return $content = curl_exec($Curl_Session);
    $header = curl_getinfo($Curl_Session);
}

function NewOrderWithProspectLimelight($campaign_id,$prospectId,$creditCardType,$creditCardNumber,$expirationDate,$cvv,$productId,$shippingId,$upsellCount,$billingSameAsShipping,$product_qty,$custom_product_price,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$click_id,$notes='',$billingaddress='',$billingcity='',$billingstate='',$billingzip='',$billingcountry='',$billingfanme='',$billinglanme=''){
	  global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  
	  $_SESSION['cvv']=$cvv;
	  $_SESSION['creditCardNumber']=$creditCardNumber;
	  $_SESSION['expirationDate']=$expirationDate;
	  $_SESSION['creditCardType']=$creditCardType;
	  $billing_fields = array();
	  if(!empty($billingSameAsShipping) && $billingSameAsShipping=='NO') {
		  $billing_fields = array('billingFirstName' => $billingfanme,
		  						  'billingLastName' => $billinglanme,
								  'billingAddress1' => $billingaddress,
								  'billingCity' => $billingcity,
								  'billingState' => $billingstate,
								  'billingZip' => $billingzip,
								  'billingCountry' => $billingcountry
		  						 );
	  }
	  
	  $fields1 = array('username'=>$limelight_api_username,
					  'password'=>$limelight_api_password,
					  'method'=>'NewOrderWithProspect',
					  'prospectId'=> $prospectId,
					  'creditCardType'=>$creditCardType,
					  'creditCardNumber'=>$creditCardNumber,
					  'expirationDate'=>$expirationDate, //mmyy
					  'CVV'=>$cvv,
					  'tranType'=>'Sale',
					  'productId'=>$productId,
					  'campaignId'=>$campaign_id,
					  'shippingId'=>$shippingId,
					  'upsellCount'=>$upsellCount,
					  'billingSameAsShipping'=>$billingSameAsShipping,
					  'product_qty_'.$productId=>$product_qty,
					  'dynamic_product_price_'.$productId=>$custom_product_price,
					  'AFID'=>trim($AFID),
					  'SID'=>trim($SID),
					  'AFFID'=>trim($AFFID),
					  'C1'=>trim($C1),
					  'C2'=>trim($C2),
					  'C3'=>trim($C3),
					  'AID'=>trim($AID),
					  'OPT'=>trim($OPT),
					  'click_id'=>trim($click_id),
					  'notes'=>$notes,
					  'ipAddress'=>$_SERVER['REMOTE_ADDR']);
					  
					  //echo "<pre>".print_r($fields1,true)."</pre>";
					  
		if(!empty($billing_fields)) {
			$fields = array_merge($fields1, $billing_fields);
		} else {
			$fields = $fields1;
		}
	  //echo "<pre>".print_r($fields)."</pre>";die();
		$Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        return $content = curl_exec($Curl_Session);
        $header = curl_getinfo($Curl_Session);
}
function NewOrderLimelight($campaign_id,$fields_fname,$fields_lname,$fields_address1,$fields_city,$fields_state,$fields_zip,$country_2_digit,$fields_phone,$fields_email,$creditCardType,$creditCardNumber,$expirationDate,$cvv,$productId,$product_qty,$custom_product_price,$shippingId,$upsellCount,$billingSameAsShipping,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$click_id,$notes='',$billingaddress='',$billingcity='',$billingstate='',$billingzip='',$billingcountry='',$billingfanme='',$billinglanme=''){

   global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
   
   $billing_fields = array();
   if(!empty($billingSameAsShipping) && $billingSameAsShipping=='NO') {
    $billing_fields = array('billingFirstName' => $billingfanme,
           'billingLastName' => $billinglanme,
          'billingAddress1' => $billingaddress,
          'billingCity' => $billingcity,
          'billingState' => $billingstate,
          'billingZip' => $billingzip,
          'billingCountry' => $billingcountry
           );
   }
   
   $fields1 = array(
		'sessionId' => $_SESSION['order']['kount_session'],
		'username'=>$limelight_api_username,
       'password'=>$limelight_api_password,
       'method'=>'NewOrder',
       'campaignId'=>$campaign_id,
       'firstName'=>trim($fields_fname),
       'lastName'=>trim($fields_lname),
       'shippingAddress1'=>trim($fields_address1),
       'shippingCity'=>trim($fields_city),
       'shippingState'=>trim($fields_state),
       'shippingZip'=>trim($fields_zip),
       'shippingCountry'=>$country_2_digit, 
       'phone'=>trim($fields_phone),
       'email'=>trim($fields_email),
       'creditCardType'=>$creditCardType,
       'creditCardNumber'=>$creditCardNumber,
       'expirationDate'=>$expirationDate, //mmyy
       'CVV'=>$cvv,
       'tranType'=>'Sale',
       'productId'=>$productId,
       'campaignId'=>$campaign_id,
       'shippingId'=>$shippingId,
       'upsellCount'=>$upsellCount,
       'billingSameAsShipping'=>'YES',
       'product_qty_'.$productId=>$product_qty,
       'dynamic_product_price_'.$productId=>$custom_product_price,
       'AFID'=>trim($AFID),
       'SID'=>trim($SID),
       'AFFID'=>trim($AFFID),
       'C1'=>trim($C1),
       'C2'=>trim($C2),
       'C3'=>trim($C3),
       'AID'=>trim($AID),
       'OPT'=>trim($OPT),
	   'click_id'=>trim($click_id),
       'notes'=>$notes,
       'ipAddress'=>$_SERVER['REMOTE_ADDR']);
       
       //echo "<pre>".print_r($fields1,true)."</pre>";
       
  if(!empty($billing_fields)) {
   $fields = array_merge($fields1, $billing_fields);
  } else {
   $fields = $fields1;
  }
   
    $Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	return $content = curl_exec($Curl_Session);
	$header = curl_getinfo($Curl_Session);
}
function NewOrderViewWithOrderIdLimelight($orderid) {
	global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	$fields =   array('username'=>$limelight_api_username,
					  'password'=>$limelight_api_password,
					  'method'=>'order_view',
					  'order_id'=>$orderid
					  );
	$data = array();			  
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/membership.php');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($Curl_Session);
	$header = curl_getinfo($Curl_Session);
	if(!empty($content)) {
		$ret=explode('&',$content);
		foreach($ret AS $key => $value){
 			$newValues = @explode('=',$value);
 			$data[$newValues[0]] = $newValues[1];
		}
	}
	
	return $data;
}

function order_update_recurring($order_id,$status){
	  global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  $fields = array('username'=>$limelight_api_username,
					  'password'=>$limelight_api_password,
					  'method'=>'order_update_recurring',
					  'order_id'=> $order_id,
					  'status'=> $status);
		$Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/membership.php');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        return $content = curl_exec($Curl_Session);
        $header = curl_getinfo($Curl_Session);
}
function NewOrderCardOnFile($previousOrderId, $campaign_id, $productId, $shippingId, $product_qty, $custom_product_price, $upsellArray=array() ) {
     
	  global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  
	  $upsell_array_price = array();
	  $upsell_array_quantity = array(); 
	  $upsell_product_Ids  = array();
	  
	  $fields = array('username'=>$limelight_api_username,
		   'password'=>$limelight_api_password,
		   'method'=>'NewOrderCardOnFile',
		   'previousOrderId'=> $previousOrderId,
		   'productId'=>$productId,
		   'campaignId'=>$campaign_id,
		   'shippingId'=>$shippingId,
		   'product_qty_'.$productId=>$product_qty,
		   'dynamic_product_price_'.$productId=>$custom_product_price,
		   'upsellCount'=>count($upsellArray),
		   ); 
       
  	if(!empty($upsellArray)) {
  
    foreach($upsellArray as $key=>$value) {
    $upsell_price      = $value['upsell_price'];
    $upsell_product_Ids[] = $value['upsell_product_id'];
    $upsell_array_price['dynamic_product_price_'.$value['upsell_product_id']] = $upsell_price;
    $upsell_array_quantity['product_qty_'.$value['upsell_product_id']] = $upsell_quantity;
     
    }
    
    $upsellProductIds = implode(',',$upsell_product_Ids);
    if(!empty($upsellProductIds) && !empty($upsell_array_price) && !empty($upsell_array_quantity)) {
    
       array_push($fields, $upsellProductIds);
       $fields = array_merge($upsell_array_price, $upsell_array_quantity);
      
    }
 }
   
	 $Curl_Session = curl_init();
	 curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
	 curl_setopt($Curl_Session, CURLOPT_POST, 1);
	 curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	 curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	 curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	 return $content = curl_exec($Curl_Session);
	 $header = curl_getinfo($Curl_Session);
}
function Prospect_view($prospect_id) {
	global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	$fields =   array('username'=>$limelight_api_username,
					  'password'=>$limelight_api_password,
					  'method'=>'prospect_view',
					  'prospect_id'=>$prospect_id
					  );
	$data = array();			  
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/membership.php');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($Curl_Session);
	$header = curl_getinfo($Curl_Session);
	if(!empty($content)) {
		$ret=explode('&',$content);
		foreach($ret AS $key => $value){
 			$newValues = @explode('=',$value);
 			$data[$newValues[0]] = $newValues[1];
		}
	}
	
	return $data;
}

function NewOrderCardOnFileLimelight($order_id,$product_id,$product_price='',$campaign_id,$shipping_id,$quantity,$forceGatewayId='',$C1,$C2,$C3,$SID,$AFFID,$AFID,$click_id){
        global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
        
        $fields = array('username'=>$limelight_api_username,
                        'password'=>$limelight_api_password,
                        'method'=>'NewOrderCardOnFile',
                        'master_order_id' => $order_id,
                        'previousOrderId' => $order_id,
                        'productId' => $product_id, /// CPP - 2 Bottles
                        'dynamic_product_price_'.$product_id => $product_price,
                        'campaignId' => $campaign_id,
                        'shippingId' => $shipping_id,
                        'product_qty_'.$product_id => $quantity,
                        'C1' => $C1,
                        'C2' => $C2,
                        'C3' => $C3,
                        'SID' => $SID,
                        'AFFID' => $AFFID,
                        'AFID' => $AFID,
                        'click_id' => $click_id);
        if($forceGatewayId != ''){
            $fields = array_merge($fields,array('forceGatewayId'=> $forceGatewayId));
        }
        //echo "<pre>"; print_r($fields); echo "<pre>"; die();
        $Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
        curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        return $content = curl_exec($Curl_Session);
        $header = curl_getinfo($Curl_Session);
}

function NewOrderCardOnFileLimelight2($campaign_id, $orderId, $shipping_id, $product_id, $click_id){
	global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	$fields = array('username'=>$limelight_api_username,
					'password'=>$limelight_api_password,
					'method'=>'NewOrderCardOnFile',
					'previousOrderId'=>$orderId,
					'productId'=>$product_id,
					'campaignId'=>$campaign_id,
					'shippingId'=>$shipping_id,
					'dynamic_product_price_'.$product_id=>0.00,
					'product_qty_'.$product_id=>'1',
					'click_id'=>trim($click_id));
					//echo "<pre>".print_r($fields,true)."</pre>";die();
	if ( $campaign_id == 126 ) {
		$fields['forceGatewayId'] = 1; 
	}
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://'.$limelight_crm_instance.'/admin/transact.php');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	return $content = curl_exec($Curl_Session);
	$header = curl_getinfo($Curl_Session);
}
