<?php
@session_start();
error_reporting(0);
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
$modelObj = new AjaxModel();
$commoncont = new CommonController();

if (isset($_POST['save_company_access']) && $_POST['save_company_access'] != '') {
    extract($_POST);
    if (isset($_POST['sel_category_list']) && $_POST['sel_category_list'] != '') {
        $_POST['sel_category_list'] = implode(",", $_POST['sel_category_list']);
    }
    if (isset($_POST['sel_sub_category_list']) && $_POST['sel_sub_category_list'] != '') {
        $_POST['sel_sub_category_list'] = implode(",", $_POST['sel_sub_category_list']);
    }
    
    
    
    $up = "update tbl_company_artists_assign set full_profile_access='" . $full_profile_access . "',categories_access='" . $_POST['sel_category_list'] . "',sidebar_access='" . $sidebar_access . "',sub_category_access='".$_POST['sel_sub_category_list']."' where artist_id='" . $artist_id . "' and company_id='" . $company_id . "' and status='1'";
    $modelObj->runQuery($up);

    $qry1="SELECT * from tbl_notification WHERE requesteduser='".$company_id."' and userid='" . $artist_id . "' and type='access'";
    $result1 = $modelObj->fetchRows($qry1);
    if(!empty($result1[0])){
        $qryUpdate = "UPDATE tbl_notification SET status='1' WHERE id = '".$result1[0]['id']."' and requesteduser='".$company_id."' and userid='".$artist_id."'";
        $modelObj->runQuery($qryUpdate);
    }else{
        $qryw="SELECT * from tbl_company_artists_assign WHERE company_id='".$company_id."' and artist_id='" . $artist_id . "' and status='1'";
        $result1w = $modelObj->fetchRows($qryw);
        $name = $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'];
        $qry1="insert into tbl_notification set name='".$name."',objectid='".$result1w[0]['id']."',requesteduser='".$company_id."' ,userid='" . $artist_id . "',subject='Company Requested For Your Profile Accss',message='Requested for your profile access. See more',status='1',type='access',cr_date='".date("Y-m-d h:i:s")."'";
        $modelObj->runQuery($qry1);
    }
    echo "Successfully updated!";
    die;
}
if (isset($_POST['action']) && $_POST['action'] == 'approve_access') {
    extract($_POST);
    $arr = "";
    if($accessCheck!=''){
       $accessCheck = $accessCheck; 
       $arr = explode(",", $accessCheck);
    }else{
        $accessCheck = "No";
    }
    $qryw="SELECT * from tbl_company_artists_assign WHERE company_id='".$company_id."' and artist_id='" . $artist_id . "' and status='1'";
    $result1w = $modelObj->fetchRows($qryw);
    
    //For Approve
    //echo "SELECT * from tbl_notification WHERE requesteduser='".$artist_id."' and userid='" .$company_id. "' and type='company_noti'";
    $qry1="SELECT * from tbl_notification WHERE requesteduser='".$artist_id."' and userid='" .$company_id. "' and type='company_noti'";
    $result1 = $modelObj->fetchRows($qry1);
    $name = $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'];
    if(!empty($result1[0])){
        $qryUpdate = "UPDATE tbl_notification SET status='1' WHERE id = '".$result1[0]['id']."' and requesteduser='".$artist_id."' and userid='".$company_id."'";
        $modelObj->runQuery($qryUpdate);   
    }else{
        $qry1="insert into tbl_notification set name='".$name."',objectid='".$result1w[0]['id']."',requesteduser='".$artist_id."' ,userid='" . $company_id . "',subject='Your requests status from artist',message='Your request status from artists. See more',status='1',type='company_noti',cr_date='".date("Y-m-d h:i:s")."'";
        $modelObj->runQuery($qry1);
    }
        
    $qrya = "UPDATE tbl_company_artists_assign SET access_approved='".$accessCheck."' where id='" . $cmp_assign_id . "'";
    $result = $modelObj->runQuery($qrya);
    echo "success";
    die;
}
?>