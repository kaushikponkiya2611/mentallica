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
if(isset($_POST['content']) && $_POST['content'] != ''):
  
    $contentheader = "";
    $contentfooter = "";
    $contentnewsletter = $_POST['content'];
    $newsletter = $_REQUEST['newsletter'];

    if($contentnewsletter != '' && $newsletter != ''){
        $qry="UPDATE tbl_newsletter SET newsletter_content = '".clear_input($contentnewsletter)."' WHERE id='".clear_input($newsletter)."' ";
        $result = $modelObj->runQuery($qry);
    }

    /*if($contentsidebar != '' && $usrdata != ''){
        $chkifexist = $commoncont -> checkifpreviewheaderexist($usrdata);
        if($chkifexist == 0){
          $commoncont -> addpreviewpageheaderfootersidebar($usrdata, $contentheader, $contentfooter, $contentsidebar);
        }elseif($chkifexist > 0){
          $commoncont -> updatepreviewpagesidebar($usrdata, $contentsidebar);
        }
    }*/

    echo 1;
    exit;
endif;
?>