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
if(isset($_POST['subcategoryDropdown']) && $_POST['subcategoryDropdown'] != ''):
    ?>
    <label for="exampleInputEmail1">Sub Category</label>
    <select class="form-control" name="sel_subcategory"  >
        <option value="">Select Sub-Category</option>

        <?php
        if (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='') {
            $d = $commoncont->getcompanypageSubCatAccess();
            if($d!='empty'){
                $cat = explode(",", $d);
                foreach ($commoncont -> getsubcategorylist($_POST['catid']) as $key => $subcats) {
                    if(in_array($subcats['id'], $cat)){
                        ?><option value="<?php echo $subcats['id'];?>" ><?php echo $subcats['sub_category_title'];?></option><?php
                    }
                }
            }
        }else{
            foreach ($commoncont -> getsubcategorylist($_POST['catid']) as $key => $subcats) {
            ?><option value="<?php echo $subcats['id'];?>" ><?php echo $subcats['sub_category_title'];?></option><?php
            }
        }
        ?>
    </select>
    <?php
endif;
if(isset($_POST['imagerotatechk']) && $_POST['imagerotatechk'] != ''):
    $postimg = $_POST['imgtorot'];
    $filename_org = $_SESSION['SITE_IMG_PATH']."images/".$postimg;
    $filename_thu = $_SESSION['SITE_IMG_PATH']."images/thumb/".$postimg;
    $filename_150 = $_SESSION['SITE_IMG_PATH']."images/150/".$postimg;
    $filename_300 = $_SESSION['SITE_IMG_PATH']."images/300/".$postimg;

    //$savefile = $filename_org;

    $degrees = 360-$_POST['rotatedegree'];
    // Load the image
    //$type = exif_imagetype($filename_org); // [] if you don't have exif you could use getImageSize() 
    $type = exif_imagetype($filename_org);
    $allowedTypes = array( 
        1,  // [] gif 
        2,  // [] jpg 
        3,  // [] png 
        //6   // [] bmp 
    ); 
    if (!in_array($type, $allowedTypes)) { 
        return false; 
    } 
    switch ($type) { 
        case 1 : 
            $source_org = imageCreateFromGif($filename_org);
            $source_thu = imageCreateFromGif($filename_thu);
            $source_150 = imageCreateFromGif($filename_150);
            $source_300 = imageCreateFromGif($filename_300); 
            // Rotate
            $rotated_org    =   imagerotate($source_org, $degrees, 0);
            $rotated_thu    =   imagerotate($source_thu, $degrees, 0);
            $rotated_150    =   imagerotate($source_150, $degrees, 0);
            $rotated_300    =   imagerotate($source_300, $degrees, 0);
            //and save it on your server...
            imagejpeg($rotated_org,$filename_org);
            imagejpeg($rotated_thu,$filename_thu);
            imagejpeg($rotated_150,$filename_150);
            imagejpeg($rotated_300,$filename_300);
        break; 
        case 2 : 
            $source_org = imageCreateFromJpeg($filename_org);
            $source_thu = imageCreateFromJpeg($filename_thu);
            $source_150 = imageCreateFromJpeg($filename_150);
            $source_300 = imageCreateFromJpeg($filename_300); 
            // Rotate
            $rotated_org    =   imagerotate($source_org, $degrees, 0);
            $rotated_thu    =   imagerotate($source_thu, $degrees, 0);
            $rotated_150    =   imagerotate($source_150, $degrees, 0);
            $rotated_300    =   imagerotate($source_300, $degrees, 0);
            //and save it on your server...
            imagejpeg($rotated_org,$filename_org);
            imagejpeg($rotated_thu,$filename_thu);
            imagejpeg($rotated_150,$filename_150);
            imagejpeg($rotated_300,$filename_300);
        break; 
        case 3 :  
            $source_org = imageCreateFromPng($filename_org);
            $source_thu = imageCreateFromPng($filename_thu);
            $source_150 = imageCreateFromPng($filename_150);
            $source_300 = imageCreateFromPng($filename_300); 
            // Rotate
            $rotated_org    =   imagerotate($source_org, $degrees, 0);
            $rotated_thu    =   imagerotate($source_thu, $degrees, 0);
            $rotated_150    =   imagerotate($source_150, $degrees, 0);
            $rotated_300    =   imagerotate($source_300, $degrees, 0);
            //and save it on your server...
            imagejpeg($rotated_org,$filename_org);
            imagejpeg($rotated_thu,$filename_thu);
            imagejpeg($rotated_150,$filename_150);
            imagejpeg($rotated_300,$filename_300);
        break; 
        /*case 6 : 
            $source = imageCreateFromGif($filename_org); 
            // Rotate
            $rotated    =   imagerotate($source, $degrees, 0);
            //and save it on your server...
            imagegif($rotated,$filename_org);
        break; */
    }   
    echo $_POST['rotatedegree']." --- ".$degrees;
    exit;
endif;
?>