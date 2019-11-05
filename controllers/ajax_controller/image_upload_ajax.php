<?php

//include 'db.php';
@session_start();
error_reporting(0);
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
//include_once '../../background_drag/getExtension.php';
$modelObj = new AjaxModel();
$commoncont = new CommonController();
//C:/xampp/htdocs
$path= $_SERVER['DOCUMENT_ROOT']."/projectone/upload/artist/";
session_start();
$session_uid = '1'; // $_SESSION['user_id'];
//include 'userUpdates.php';
//$userUpdates = new userUpdates($db);

if(isset($_POST['uploadImage']) && $_POST['uploadImage']!=""){
    
$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($session_uid)) {
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];


    if (strlen($name)) {
        $ext = $commoncont->getExtension($name);
        if (in_array($ext, $valid_formats)) {
            if ($size < (1024 * 1024)) {
                $actual_image_name = time() . $session_uid . "." . $ext;
                $tmp = $_FILES['photoimg']['tmp_name'];
                $bgSave = '<div id="uX' . $session_uid . '" class="bgSave wallbutton blackButton">Save Cover</div>';
                if (move_uploaded_file($tmp, $path . $actual_image_name)) {

                    $data = $commoncont->userBackgroundUpdate($session_uid, $actual_image_name);
                    if ($data)
                        echo $bgSave . '<img src="' . $path . $actual_image_name . '"  id="timelineBGload" class="headerimage ui-corner-all" style="top:0px"/>';
                }
                else {
                    echo "Fail upload folder with read access.";
                }
            } else
                echo "Image file size max 1 MB";
        } else
            echo "Invalid file format.";
    } else
        echo "Please select image..!";

    exit;
}

}
?>
