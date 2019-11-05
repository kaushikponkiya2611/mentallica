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
//echo "HERE";
/* Get post details */
$post = isset($_POST) ? $_POST: array();
//print($_POST);

switch($post['action']) {
	case 'save' :
	saveProfilePic();
	saveProfilePicTmp();
	break;
	default:
	changeProfilePic();
}
/* Function to change profile picture */
function changeProfilePic() {
   $post = isset($_POST) ? $_POST: array();
   $catid = $post['catid'];
	$max_width = "500"; 
	//$userId = isset($post['hdn-profile-id']) ? intval($post['hdn-profile-id']) : 0;
        $userId =time();
	//$path = '../../crop/images/tmp';
        $path = $_SERVER['DOCUMENT_ROOT'] . "/projectone/upload/art/";
	$valid_formats = array("jpg", "png", "gif", "jpeg");
	$name = $_FILES['profile-pic']['name'];
	$size = $_FILES['profile-pic']['size'];
	if(strlen($name)) {
		list($txt, $ext) = explode(".", $name);
		if(in_array($ext,$valid_formats)) {
			if($size < 5000000) {
				$actual_image_name = 'avatar' .'_'.$userId .'.'.$ext;
				$filePath = $path .'/'.$actual_image_name;
                                $filePathshow = $_SESSION['FRNT_DOMAIN_NAME'] .'upload/art/'.$actual_image_name;
				$tmp = $_FILES['profile-pic']['tmp_name'];
				if(move_uploaded_file($tmp, $filePath)) {
					$width = getWidth($filePath);
					$height = getHeight($filePath);
					//Scale the image if it is greater than the width set above
					if ($width > $max_width){
						$scale = $max_width/$width;
						$uploaded = resizeImage($filePath,$width,$height,$scale, $ext);
					} else {
						$scale = 1;
						$uploaded = resizeImage($filePath,$width,$height,$scale, $ext);
					}					
					echo "<img id='photo".$catid."' file-name='".$actual_image_name."' class='' src='".$filePathshow.'?'.time()."' class='preview'/>";
				}
				else
				echo "failed";
			}
			else
			echo "Image file size max 1 MB"; 
		}
		else
		echo "Invalid file format.."; 
	}
	else
	echo "Please select image..!";
	exit;
}
/* Function to handle save profile pic */
function saveProfilePic(){
   
	//include_once("db_connect.php");
	$post = isset($_POST) ? $_POST: array();	
	//Handle profile picture update with MySQL update Query using $options array	
	if($post['id']){
		/*$sql_query = "SELECT * FROM users WHERE uid = '".mysqli_escape_string($conn, $post['id'])."'";		
		$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));		
		if(mysqli_num_rows($resultset)) {                     
			$sql_update = "UPDATE users set profile_photo='".mysqli_escape_string($conn,$post['image_name'])."' WHERE uid = '".mysqli_escape_string($conn, $post['id'])."'";			
			mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));
		}*/
            //echo "UPDATE tbl_userpreview_data_category SET profile_background='".$post['image_name']."'  WHERE user_id='".$_SESSION['po_userses']['flc_usrlogin_id']."' and category_id='". $post['hidecat']."'";
			
            $sql_update = mysql_query("UPDATE tbl_userpreview_data_category SET profile_background='".$post['image_name']."'  WHERE user_id='".$_SESSION['po_userses']['flc_usrlogin_id']."' and category_id='". $post['catid']."'");			
            //$data = $commoncont->userBackgroundUpdate($_SESSION['po_userses']['flc_usrlogin_id'], $post['image_name'], $post['hidecat']);
            //if ($data)
                //echo $bgSave . '<img  src="' . $_SESSION['SITE_NAME'] . 'upload/art/' . $actual_image_name . '"  id="timelineBGload" class="headerimage ui-corner-all" style="top:0px"/>';
	}
}
	
/* Function to update image */
 function saveProfilePicTmp() {
 
	$post = isset($_POST) ? $_POST: array();
	$userId = isset($post['id']) ? intval($post['id']) : 0;
	//$path ='\\images\tmp';
        $path = $_SERVER['DOCUMENT_ROOT'] . "/projectone/upload/art/";
	$t_width = 300; // Maximum thumbnail width
	$t_height = 300;    // Maximum thumbnail height	
	if(isset($_POST['t']) and $_POST['t'] == "ajax") {
		extract($_POST);		
		//$imagePath = 'images/tmp/'.$_POST['image_name'];
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/projectone/upload/art/".$_POST['image_name'];
		$ratio = ($t_width/$w1); 
		$nw = ceil($w1 * $ratio);
		$nh = ceil($h1 * $ratio);
		$nimg = imagecreatetruecolor($nw,$nh);
		$im_src = imagecreatefromjpeg($imagePath);
		imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
		imagejpeg($nimg,$imagePath,90);		
	}
	//echo $imagePath.'?'.time();
        $bgSave = '<div id="uX' . $_SESSION['po_userses']['flc_usrlogin_id'].' " data-catid="'.$_POST['catid'].'" class="bgSave bgSave'.$_POST['catid'].' wallbutton blackButton">Save Cover</div>';
        echo $bgSave .'<img  src="' . $_SESSION['FRNT_DOMAIN_NAME'] .'upload/art/'.$_POST['image_name'].'?'.time() . '"  id="timelineBGload'.$_POST['catid'].'" class="bgImage headerimage timelineBGload ui-corner-all" style="top:0px"/>';
        echo 
	exit(0);    
}    
/* Function  to resize image */
function resizeImage($image,$width,$height,$scale, $ext) {
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $source = imagecreatefromjpeg($image);
            break;
        case 'gif':
            $source = imagecreatefromgif($image);
            break;
        case 'png':
            $source = imagecreatefrompng($image);
            break;
        default:
            $source = false;
            break;
    }	
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$image,90);
	chmod($image, 0777);
	return $image;
}
/*  Function to get image height. */
function getHeight($image) {
    $sizes = getimagesize($image);
    $height = $sizes[1];
    return $height;
}
/* Function to get image width */
function getWidth($image) {
    $sizes = getimagesize($image);
    $width = $sizes[0];
    return $width;
}
?>
