<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('America/New_York');
$siteurl = 'http://www.intelleral.com/';

// LL API Login Details
$limelight_api_username = 'verticaopsapi';
$limelight_api_password = 'RhnQ2nrq8YB2nx';
$limelight_crm_instance = 'crmprazahealth.limelightcrm.com/';

// shaving range
$whatpercentage = 10;

//Straight Sale Bottle Pricing
// SS single bottle price
$bottle1 = '$59.95';
// Per bottle price
$perbottle1 ='59.95';
// SS three bottle price
$bottle3 = '$119.90';
// Per bottle price
$perbottle3 ='39.95';
// SS five bottle price
$bottle5 = '$179.85';
// Per bottle price
$perbottle5 = '35.97'; 


$campaign_path = 'http://www.intelleral.com/';
$folder_name = '';
$campaign_id = 56;
$prepaid_campaign_id = 56;

$bottle1_product_id = 95;
$bottle1_shipping_id = 3; 
$bottle3_product_id = 96;
$bottle3_shipping_id = 1; 

$bottle5_product_id = 97;
$bottle5_shipping_id = 1; 

$country = 'US';
$currency_text = 'AUD';
$currency_symbol = 'A$';

// block , none //
$calculator = 'block';
$cdn_image_path = '';
$cnd_img_path = '';

$ssl_url = 'http://www.intelleral.com/';
$cloudfont_path = '';

// your site meta title
$sitetitle = 'Intelleral';
// limelight product name
$LLproductName = 'Intelleral';
// for the terms and conditions and footer
$companyname = 'Intelleral';
// for customer service
$companyemail = 'support@intelleral.com'; 
$companyphone = '888-577-6712';
//call center hours
$hours = '9am-5pm MST'; 
// restocking fee
$restockingFee = '$19.95';

// CONTACT ADDRESS
$contact = 'P.O. BOX 6646 Scottsdale, AZ 85261-6646';

// MAILING ADDRESS
$companyaddress = 'P.O. BOX 6646';
$companycity = 'Scottsdale';
$companystate = 'Arizona';
$stateabv = 'AZ';
$companyzip = '85261';

// RETURN ADDRESS (the address below is for merchants using TEN fulfillment)
$returnaddress = 'P.O. BOX 6646';
$returncity = 'Scottsdale';
$returnstate = 'Arizona';
$returnstateabv = 'AZ';
$returnzip = '85261';