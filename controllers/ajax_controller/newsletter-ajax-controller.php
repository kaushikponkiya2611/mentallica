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
/*if(isset($_POST['setnewimageorederchk']) && $_POST['setnewimageorederchk'] != ''):
    $imgpos = $_POST['eleary'];
    foreach ($imgpos as $key => $impo) {
      $impodata = explode("|", $impo);
      $qry="UPDATE tbl_user_images SET image_rank = '".clear_input($impodata[1])."' WHERE id='".clear_input($impodata[0])."' ";
      $result = $modelObj->runQuery($qry); 
    }
    echo 1;
    exit;
endif;*/
if(isset($_POST['addnewnewsletterchk']) && $_POST['addnewnewsletterchk'] != ''):
    $newslettertitle = $_POST['newslettertitle'];
    /*$newslettercontent = "<div class='row'>
                              <div class='column col-md-12'>
                                  No Content Added.
                              </div>
                          </div>";*/
    $nlFilePath = $_SESSION['APP_PATH'];
    $defaultFile = $_SESSION['FRNT_DOMAIN_NAME']."newsletter-builder/tmp/1474029959.html";
    $tplname = basename($defaultFile);
    $nlFilePath .= "newsletter-builder/tmp/".$tplname;
    $contenuto = file_get_contents($nlFilePath);
    
    $qry="INSERT INTO tbl_newsletter (`artist_id`, `newsletter_title`, `newsletter_content`, `newsletter_html_file`, `cr_date`, `status`) VALUES('".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."', '".clear_input($newslettertitle)."', '".clear_input($contenuto)."', '".clear_input($defaultFile)."', NOW(), 1) ";
    $result = $modelObj->runQuery($qry); 
    $lastinsertedid = mysql_insert_id();
    echo $lastinsertedid;
    exit;
endif;
if(isset($_POST['dltnewnewsletterchk']) && $_POST['dltnewnewsletterchk'] != ''):
    $dltnewsletter = $_POST['dltnewsletter'];
    
    $qry="DELETE FROM tbl_newsletter WHERE id = '".clear_input($dltnewsletter)."' ";
    $result = $modelObj->runQuery($qry); 

    echo 1;
    exit;
endif;
?>