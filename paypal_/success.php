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

$sql=mysql_query("select * from tbl_user_images where id='$item_no'");
$row=mysql_fetch_array($sql);
$img_price=$row['img_price'];
 
 

	 if($item_price==$img_price){

	$type = '1';
	$price = $row['img_price'];
}else{ 
	$type = '2';
	$price = $row['dowanload_price'];
}
  if($payment_type == '1'){
	 $type = '1';
	$price = '0.00';
 } 
 if($payment_type == '2'){
	 $type = '2';
	$price = '0.00';
 }

/*  echo $item_price; 
echo '<br/>';
echo $price; 
die; */ 
if($item_price==$price)
{
 
 $rpage = $rowuser['username'];
 $rpageid = $row['category_id'];
 
$result = mysql_query("INSERT INTO tbl_sales(pid, uid,type,amount,cr_date,transactionid) VALUES('$item_no', '$uid','$type','$price', NOW(),'$item_transaction')");
if($result){
	$_SESSION['item_no']=$item_no;
	 if($type==2 && $item_transaction==""){
		//print_r($row); die;
			if (isset($row['music'])) { 
				$file_url = $FRNT_DOMAIN_NAME.'upload/images/'.$row['music'];
				$file_name = $row['music']; 
				header('Content-Type: application/octet-stream');
				header("Content-Transfer-Encoding: Binary"); 
				header("Content-disposition: attachment; filename=\"".$file_name."\""); 
				readfile($file_url); 
				exit();
			} 
	} 
	header("Location: ".$FRNT_DOMAIN_NAME."artistpreview/$rpage/$rpageid"); 
	exit();
	
	
}else{
    echo "Payment Error";
}
}
else
{
echo "Payment Failed";
}
?>
