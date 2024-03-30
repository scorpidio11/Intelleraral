<?php

include 'config.php';
include 'limelight.php';

$shippingId = ($_REQUEST['shipping']) ? $_REQUEST['shipping'] : '';
$order_campain_id = ($_REQUEST['campaign_id']) ? $_REQUEST['campaign_id'] : '';
$productId = ($_REQUEST['custom_product']) ? $_REQUEST['custom_product'] : '';
$cc_type = ($_REQUEST['cc_type']) ? $_REQUEST['cc_type'] : '';
$cc_number = ($_REQUEST['cc_number']) ? $_REQUEST['cc_number'] : '';

if ($shippingId && $order_campain_id && $productId && $cc_type && $cc_number) {
		
    $fields_fname = ($_POST['fields_fname']) ? $_POST['fields_fname'] : '';
    $fields_lname = ($_POST['fields_lname']) ? $_POST['fields_lname'] : '';
    $fields_address1 = ($_POST['fields_address1']) ? $_POST['fields_address1'] : '';
    $fields_city = ($_POST['fields_city']) ? $_POST['fields_city'] : '';
    $fields_state = ($_POST['fields_state']) ? $_POST['fields_state'] : '';
    $fields_zip = ($_POST['fields_zip']) ? $_POST['fields_zip'] : '';
    $country = 'US'; 
	$fields_phone = ($_POST['fields_phone']) ?  $_POST['fields_phone'] : '';
	$fields_email = ($_POST['fields_email']) ?  $_POST['fields_email'] : '';
  
	$AFID = ($_REQUEST['AFID']) ? $_REQUEST['AFID'] : '';
    $SID = ($_REQUEST['SID']) ? $_REQUEST['SID'] : '';
	$AFFID = ($_REQUEST['AFFID']) ? $_REQUEST['AFFID'] : '';
	$C1 = ($_REQUEST['C1']) ? $_REQUEST['C1'] : '';
	$C2 = ($_REQUEST['C2']) ? $_REQUEST['C2'] : '';
	$C3 = ($_REQUEST['C3']) ? $_REQUEST['C3'] : '';
	$AID = ($_REQUEST['AID']) ? $_REQUEST['AID'] : '';
	$OPT = ($_REQUEST['OPT']) ? $_REQUEST['OPT'] : '';
	$click_id = ($_REQUEST['CLICK_ID']) ? $_REQUEST['CLICK_ID'] : '';
	$CID = ($_REQUEST['CID']) ? $_REQUEST['CID'] : '';
	$notes = ($_REQUEST['notes']) ? $_REQUEST['notes'] : '';
	$custom_product_price_ll = $_REQUEST['custom_product_price'];
	
	$fields_expmonth = $_REQUEST['fields_expmonth'];
	$fields_expyear = $_REQUEST['fields_expyear'];
	$cc_cvv = $_REQUEST['cc_cvv'];
	
	$expirationDate = $fields_expmonth.$fields_expyear;
	$upsellCount = 0;
	$product_qty = 1;
	$amount = $_REQUEST['custom_product_price'];


	//generate a random number out of whatpercentage specified.
    $random_number = mt_rand(1, $whatpercentage);
    // shave based on specified $whatepercentage
    if ($random_number == 1) {
        $AFID = 3;
    }

// why is this goes to session?
	// $_SESSION['cc_type'] = $cc_type;
	// $_SESSION['cc_number'] = base64_encode($cc_number);
	// $_SESSION['cc_cvv'] = $cc_cvv;
	// $_SESSION['expirationDate'] = $expirationDate;

	// billing info not provided
	$billingaddress = '';
	$billingcity = '';
	$billingstate = ''; 
	$billingzip = '';
	$billingcountry = '';
	$billingfanme = '';
	$billinglanme = '';

	// call limelight to create a new order
	$content = NewOrderLimelight(
		$order_campain_id, $fields_fname, $fields_lname,
		$fields_address1, $fields_city, $fields_state,
		$fields_zip, $country, $fields_phone, $fields_email,
		$cc_type, $cc_number, $expirationDate, $cc_cvv,
		$productId, $product_qty, $custom_product_price_ll,
		$shippingId, $upsellCount, $billing_same_as_shipping,
		$AFID, $SID, $AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id,
		$notes, $billingaddress, $billingcity, $billingstate,
		$billingzip, $billingcountry, $billingfanme,$billinglanme
	);
	
	$response = explode('&', $content);

	
	// echo "<pre>";
	// var_dump($response);
	// echo "</pre>";
	// exit;

	//get decline reason
    $decline = explode('=', $response[2]);
	// check if prepaid decline
    $pppos = strpos($decline[1], 'Prepaid');
                
	
	if (!empty($response[1]) && $response[1] == 'responseCode=100') {
		$exp = explode('=', $response[5]);
		$limelight_order_id = $exp[1];
		$data = array();

		foreach ($response AS $key => $value){
			$newValues = @explode('=', $value);
			$data[$newValues[0]] = $newValues[1];
		}
		
		echo 'ok|?step1_orderId='.urldecode($data['orderId']).'&AFID='.$AFID.'&AFFID='.$AFFID.'&SID='.$SID.'&SOID='.$AffiliateReferenceID.'&click_id='.$click_id.'&C1='.$C1.'&C2='.$C2.'&C3='.$C3;
	} elseif ($pppos !== false) {
	    //populate order info from session variables
	    $content = NewOrderLimelight(
			$_REQUEST['prepaid_campaign_id'], $fields_fname, $fields_lname,
			$fields_address1, $fields_city, $fields_state, $fields_zip,
			$country, $fields_phone, $fields_email, $cc_type, $cc_number,
			$expirationDate, $cc_cvv, $productId, $product_qty, $custom_product_price_ll,
			$shippingId, $upsellCount, $billing_same_as_shipping, $AFID, $SID,
			$AFFID, $C1, $C2, $C3, $AID, $OPT, $click_id, $notes, $billingaddress,
			$billingcity, $billingstate, $billingzip, $billingcountry,
			$billingfanme, $billinglanme
		);
	    
	    $response2 = explode('&', $content);

	    if( !empty($response2[1]) && $response2[1] == 'responseCode=100' ) {
	        $exp = explode("=",$response2[5]);
	        $limelight_order_id = $exp[1];
	        $data = array();
	        foreach($response2 AS $key => $value){
	            $newValues = @explode('=',$value);
	            $data[$newValues[0]] = $newValues[1];
	        }
			echo 'okprepaid|?step1_orderId='.urldecode($data['orderId']).'&AFID='.$AFID.'&AFFID='.$AFFID.'&SID='.$SID.'&SOID='.$AffiliateReferenceID.'&click_id='.$click_id.'&C1='.$C1.'&C2='.$C2.'&C3='.$C3.'&prepaid=1';
	    } else {
            $data = array();
            foreach($response2 AS $key => $value){
                $newValues = @explode('=',$value);
                $data[$newValues[0]] = $newValues[1];
            }
            $errorMessage = urldecode($data['errorMessage']);
            $limelight_order_id = urldecode($data['orderId']); 
            echo urldecode($errorMessage.'|');
        }        
    } else {
		$data = array();
		foreach($response AS $key => $value){
			$newValues = @explode('=',$value);
			$data[$newValues[0]] = $newValues[1];
		}
		$errorMessage = urldecode($data['errorMessage']);
		$limelight_order_id = urldecode($data['orderId']); 
		echo urldecode($errorMessage);
	}
	exit();
} else {
	$errorMessage1 = urldecode('Blank Fields');
	echo urldecode($errorMessage1);
}