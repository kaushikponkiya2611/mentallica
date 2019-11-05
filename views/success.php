<?php
@session_start();
error_reporting(1);
?>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
    <?php
  
    if((isset($_SESSION) && $_SESSION['itemDetailSession']!='') && (isset($_POST['txn_id']) && $_POST['txn_id']!='')){
        include('../models/db.php');
        include('../models/common-model.php');
        include('../controllers/common-controller.php');
        $database = new Connection();
        //include('../models/ajax-model.php');
        $modelObj =  new CommonModel();
       
        
        $commoncont = new CommonController();
        $userimgdetail = $commoncont->getuserimagedetailbyid($_SESSION['itemDetailSession']);
        $ud = $commoncont->getuserdetailfromuserid($userimgdetail['user_id']);
        
        $qry1 = "SELECT * FROM tbl_user_wallet WHERE user_id='" . $userimgdetail['user_id'] . "'";
        $result1 = $modelObj->fetchRows($qry1);
        if (!empty($result1)) {
            $amount = $result1[0]['amount'];
            $amount = $_SESSION['itemPriceSession'] + $amount;
            $qry = "UPDATE tbl_user_wallet SET amount = '" . $amount . "' WHERE user_id='" . $userimgdetail['user_id'] . "' ";
            $result = $modelObj->runQuery($qry);
        }else{
            $amount = $_SESSION['itemPriceSession'];
            $qry = "insert into tbl_user_wallet SET amount = '" . $amount . "',user_id='" . $userimgdetail['user_id'] . "' ";
            $result = $modelObj->runQuery($qry);
        }
        $buyer = '';
        if(isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id']!=0 && $_SESSION['po_userses']['flc_usrlogin_id']!=''){
            $buyer = $_SESSION['po_userses']['flc_usrlogin_id'];
        }
        $qry = "insert into tbl_user_purchase_history SET transaction_id  = '" . $_POST['payer_email'] . "', buyer_id = '" . $buyer."',seller_id='".$userimgdetail['user_id']."' , item_id = '" . $_POST['item_number'] . "',payment_date='" . $_POST['payment_date']. "' ";
        $result = $modelObj->runQuery($qry);
        
        
        $qry1 = "insert into tbl_trans_history SET from_amt  = '" . $_POST['payer_email'] . "', to_amt  = '" . $ud['first_name'].' '.$ud['last_name']."',amount = '" . $_POST['mc_gross'] . "',transaction_id='" . $_POST['txn_id']. "' ";
        $result1 = $modelObj->runQuery($qry1);
        
        //unset($_SESSION['itemDetailSession']);
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <br/><br/><h2 class="text-center">Payment Successful</h2><br/><br/>
        </div>
        <?php
    }else{
        ?>
    <div style="text-align: center;margin: 25px;padding: 25px;" class="wrapper row-offcanvas row-offcanvas-left">
            <a href="<?php echo $FRNT_DOMAIN_NAME ?>">Go to home</a>
        </div>    
            
        <?php
    }
    ?>
	<!-- ./wrapper -->
	<?php include('footernew.php'); ?>
</body>