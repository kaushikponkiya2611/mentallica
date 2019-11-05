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
if(isset($_POST['loadsubcatimageschk']) && $_POST['loadsubcatimageschk'] != ''):
    $subcat = $_POST['subcat'];
    $cat = $_POST['cat'];
    
    $modcnt = 0; 
    $itemhtml = '';
    $imglist = $commoncont -> getimagesbySubcatCatUserid($_SESSION['po_artistid'], $cat, $subcat);
    if(!empty($imglist)):
        foreach ($imglist as $k => $imgsdata):

          $itemhtml .= '<div class="col-lg-3 col-md-3 col-xs-6 preview-item ui-state-default" style="min-height: 225px; background-image: url(\''.$_SESSION['SITE_NAME'].'upload/images/300/'.$imgsdata['image'].'\'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-tabval="'.$imgsdata['id'].'">
		  
                    <a href="javascript:void(0)" onclick="openuserimageinpopup(\''.$imgsdata['id'].'\')" class="openpop-link">&nbsp;</a>
                                                    &nbsp; 

                                                </div>';
        endforeach;
    else: 
        $itemhtml .= '<div class="callout callout-info">
            <h4>No Image Found</h4>
            <p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p>            
        </div>';
    endif; 
    
    echo $itemhtml;
    exit;
endif;
?>