<?php
ob_start();
session_start(); 
require 'db_config.php'; 
 
//echo '<pre/>'; print_r($_REQUEST); die;
$item_no = $_REQUEST['item_number'];
$item_transaction = $_REQUEST['tx'];
$item_price = $_REQUEST['amt'];
$item_currency = $_REQUEST['cc'];   
$uid = $_SESSION['po_artistid'];
$payment_type = $_REQUEST['payment_type'];

$sqluser=mysql_query("select * from tbl_users where id='$uid'");
$rowuser=mysql_fetch_array($sqluser);


 
 

 
 
 
 $rpage = $rowuser['username'];
 $rpageid = $row['category_id'];
 
$result = mysql_query("INSERT INTO tbl_donate_artist(aid, uid,type,amount,cr_date,transactionid) VALUES('$uid', '$uid','$type','$item_price', NOW(),'$item_transaction')");
if($result){
	header("Location:".$FRNT_DOMAIN_NAME."artistpreview/$rpage"); 
	exit();
	
	
}else{
    echo "Payment Error";
}

?>
