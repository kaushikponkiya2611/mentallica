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
?>
<?php

if (isset($_POST['save_company_access']) && $_POST['save_company_access'] != '') {
    extract($_POST);
    if (isset($_POST['sel_category_list']) && $_POST['sel_category_list'] != '') {
        $_POST['sel_category_list'] = implode(",", $_POST['sel_category_list']);
    }
    if (isset($_POST['sel_sub_category_list']) && $_POST['sel_sub_category_list'] != '') {
        $_POST['sel_sub_category_list'] = implode(",", $_POST['sel_sub_category_list']);
    }
    
    $qryw="SELECT * from tbl_company_artists_assign WHERE company_id='".$company_id."' and artist_id='" . $artist_id . "' and status='1'";
    $result1w = $modelObj->fetchRows($qryw);
    $arra = array();
    $apr='';
    if($result1w[0]['full_profile_access']!=$_POST['full_profile_access'] ){
        array_push($arra, $apr);
    }else{
        if(($result1w[0]['full_profile_access']!='') && strstr($result1w[0]['access_approved'],"1")){
            $apr='1';
        }
        array_push($arra, $apr);
    }
     $apr='';
    if($result1w[0]['sidebar_access']!=$_POST['sidebar_access']){
        array_push($arra, $apr);
    }else{
        if(($result1w[0]['sidebar_access']!='') && strstr($result1w[0]['access_approved'],"2")){
            $apr='2';
        }
        array_push($arra, $apr);
    }
    $apr='';
    if($result1w[0]['categories_access']!=$_POST['sel_category_list']){
        array_push($arra, $apr);
    }else{
         if(($result1w[0]['categories_access']!='') && strstr($result1w[0]['access_approved'],"3")){
            $apr='3';
        }
        array_push($arra, $apr);
    }
     $apr='';
    if($result1w[0]['sub_category_access']!=$_POST['sel_sub_category_list']){
        array_push($arra, $apr);
    }else{
         if(($result1w[0]['sub_category_access']!='') && strstr($result1w[0]['access_approved'],"4")){
            $apr='4';
        }
        array_push($arra, $apr);
    }
    
    if(!empty($arra)){
        $arra = implode(",", array_filter($arra));
    }else{
        $arra = $result1w[0]['access_approved'];
    }
    
    $up = "update tbl_company_artists_assign set full_profile_access='" . $full_profile_access . "',categories_access='" . $_POST['sel_category_list'] . "',sidebar_access='" . $sidebar_access . "',sub_category_access='".$_POST['sel_sub_category_list']."',access_approved='".$arra."' where artist_id='" . $artist_id . "' and company_id='" . $company_id . "' and status='1'";
    $modelObj->runQuery($up);
    
    $qry1="SELECT * from tbl_notification WHERE requesteduser='".$company_id."' and userid='" . $artist_id . "' and type='access'";
    $result1 = $modelObj->fetchRows($qry1);
    /*if(!empty($result1[0])){
        //$qryUpdate = "UPDATE tbl_notification SET status='1' WHERE id = '".$result1[0]['id']."' and requesteduser='".$company_id."' and userid='".$artist_id."'";
        $qryUpdate = "DELETE TABLE tbl_notification WHERE id = '".$result1[0]['id']."' and requesteduser='".$company_id."' and userid='".$artist_id."'";
        $modelObj->runQuery($qryUpdate);
    }else{
        $qryw="SELECT * from tbl_company_artists_assign WHERE company_id='".$company_id."' and artist_id='" . $artist_id . "' and status='1'";
        $result1w = $modelObj->fetchRows($qryw);
        $name = $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'];
        $qry1="insert into tbl_notification set name='".$name."',objectid='".$result1w[0]['id']."',requesteduser='".$company_id."' ,userid='" . $artist_id . "',subject='Company Requested For Your Profile Accss',message='Requested for your profile access. See more',status='1',type='access',cr_date='".date("Y-m-d h:i:s")."'";
        $modelObj->runQuery($qry1);
    }*/
   
    if(!empty($result1[0])){
        $qryUpdate = "UPDATE tbl_notification SET status='1' WHERE id = '".$result1[0]['id']."' and requesteduser='".$company_id."' and userid='".$artist_id."'";
        //$qryUpdate = "DELETE FROM tbl_notification WHERE id = '".$result1[0]['id']."' and requesteduser='".$company_id."' and userid='".$artist_id."'";
        $modelObj->runQuery($qryUpdate);
    }else{
    
        $name = $_SESSION['po_userses']['flc_usrlogin_first_nm'] . ' ' . $_SESSION['po_userses']['flc_usrlogin_last_nm'];
        $qry1="insert into tbl_notification set name='".$name."',objectid='".$result1w[0]['id']."',requesteduser='".$company_id."' ,userid='" . $artist_id . "',subject='Company Requested For Your Profile Accss',message='Requested for your profile access. See more',status='1',type='access',cr_date='".date("Y-m-d h:i:s")."'";
        $modelObj->runQuery($qry1);
       
    }
     echo "Successfully updated!";
    die;
}
if (isset($_POST['action']) && $_POST['action'] == 'deleteRow') {
   // $qrya = "UPDATE tbl_company_artists_assign SET status='2' where id='" . $_POST['aid'] . "'";
    $qrya = "DELETE FROM tbl_company_artists_assign where id='" . $_POST['aid'] . "'";
    $result = $modelObj->runQuery($qrya);
    $qrya = "DELETE FROM tbl_notification where objectid='" . $_POST['aid'] . "'";
    $result = $modelObj->runQuery($qrya);
    unset($_SESSION['current_artist']);
    echo "Successfully Deleted!";
    die;
}
if (isset($_POST['action']) && $_POST['action'] == 'get_sub_cat') {
    $artist_id = $_POST['sel_artist_id'];
    $cat_id = implode(",",$_POST['cat_id']);
    
    $company_id = $_POST['company_id'];
    $qryw="SELECT * from tbl_company_artists_assign WHERE company_id='".$company_id."' and artist_id='" . $artist_id . "' and status='1'";
    $result1w = $modelObj->fetchRows($qryw);
    $rr = array();
    if($result1w[0]['sub_category_access']!='' ){
        $rr = explode(",", $result1w[0]['sub_category_access']);
    }
    
    ?>
    <select name="sel_sub_category_list[]" data-placeholder="Choose categories for sub category access" class="chosen-select form-control" id="sel_sub_category_list" required multiple="">
        <option value="">Select Sub Categories</option>
        <?php foreach ($commoncont->getsubcategorylistbyartist($cat_id,$artist_id) as $key => $subcats) {
                $sel ='';
                if(in_array($subcats['id'], $rr)){
                    $sel = "selected";
                }
            ?>
            <option <?php echo $sel ?> value="<?php echo $subcats['id'];?>" ><?php echo $subcats['sub_category_title'];?></option>
        <?php 
        }?>
    </select>    
        
    <?php
}

?>