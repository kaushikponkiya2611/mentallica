<?php

class ImguploadController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new ImguploadModel();

        $this->userdetail = $this->profileinfo();
        $this->getSettings = $this->getsettings();
        $this->gtplans = $this->getplandetails($this->userdetail['plan_id']);
        $this -> gtcategory = $this -> getcategorylistbyids($this -> gtplans['category']);
        //$this->gtimgcategory = $this->getimgcategorylist($this->gtplans['category']);

        if (isset($_FILES["file_img_upload"]["tmp_name"]) && $_POST['sel_category'] != '' && count($_POST) > 0):
            //$usr_update = $this -> updateuserdetails($_POST['txt_firstname'], $_POST['txt_lastname'], $_POST['txt_mobileno']);
            $upload_dir = $_SESSION['SITE_IMG_PATH'] . "images/";
            $upload_dirthumb = $_SESSION['SITE_IMG_PATH'] . "images/thumb/";
            $upload_dir150 = $_SESSION['SITE_IMG_PATH'] . "images/150/";
            $upload_dir300 = $_SESSION['SITE_IMG_PATH'] . "images/300/";
            if (!dir($upload_dir)) {
                mkdir($upload_dir);
            }
            if (!dir($upload_dirthumb)) {
                mkdir($upload_dirthumb);
            }
            if (!dir($upload_dir150)) {
                mkdir($upload_dir150);
            }
            if (!dir($upload_dir300)) {
                mkdir($upload_dir300);
            }
            if (isset($_FILES["file_img_upload"]["tmp_name"])) {
               
                $tmpfile = $_FILES["file_img_upload"]["tmp_name"];
                $newname = $_FILES["file_img_upload"]["name"];
                $insertimage = "";
                if ($_FILES["file_img_upload"]["tmp_name"] != '') {
                    $abc = date("dmyHis");
                    $insertimage = $abc . $newname;
                    if (move_uploaded_file($tmpfile, $upload_dir . $insertimage)) {
                        $resizeObj_20 = new resize($upload_dir . $insertimage);
                        $resizeObj_20->resizeImage(50, 50, 'exact');
                        $resizeObj_20->saveImage($upload_dirthumb . $insertimage, $upload_dir . $insertimage, 100);

                        $resizeObj_150 = new resize($upload_dir . $insertimage);
                        $resizeObj_150->resizeImage(150, 100, 'landscape');
                        $resizeObj_150->saveImage($upload_dir150 . $insertimage, $upload_dir . $insertimage, 100);

                        $resizeObj_300 = new resize($upload_dir . $insertimage);
                        $resizeObj_300->resizeImage(300, 225, 'portrait');
                        $resizeObj_300->saveImage($upload_dir300 . $insertimage, $upload_dir . $insertimage, 100);
						
						if(!empty($_FILES['file_music_upload']['name'])){
							$fileName = $_FILES['file_music_upload']['name'];
							$targetFile = $upload_dir . str_replace(" ", "-", $fileName);
							move_uploaded_file($_FILES['file_music_upload']['tmp_name'], $targetFile);

						}else{
							$targetFile = '';
						}
                        $file_size1 = filesize($upload_dir . $insertimage); // Get file size in bytes
                        $file_size1 = $file_size1 / 1024; // Get file size in KB
                        
                        $file_size2 = filesize($targetFile); // Get file size in bytes
                        $file_size2 = ceil($file_size2 / 1024); // Get file size in KB

                        $file_size = $file_size1 + $file_size2;
                        $qry_plan = "SELECT * FROM tbl_plans WHERE id = '" . clear_input($this->userdetail['plan_id']) . "' AND status = 1 LIMIT 1";
                        $result_plan = $this->modelObj->fetchRow($qry_plan);

                        $cutcoins = 0;
                        if ($result_plan['image_limit'] > 0) {
                            $qry_settings = "SELECT * FROM tbl_settings WHERE id = 1";
                            $result_settings = $this->modelObj->fetchRow($qry_settings);
                            $kbtocoins = $result_settings['mb_to_coin'];
                            $cutcoins = $file_size1 / $kbtocoins;
                        }
                        
                        
                        //K- Image Rules
                        $arr = array();
                        if(isset($_POST['artist']) or isset($_POST['txt_payment'])){
                            foreach($_POST['artist'] as $key=>$val){
                                if(!empty(trim($_POST['txt_payment'][$key]))){
                                    $image_rules = array("artist_id"=>$val,"price"=>$_POST['txt_payment'][$key]);
                                    array_push($arr, $image_rules);
                                }
                                
                            }
                        }
                        $age_rules = array();
                        if(isset($_POST['txt_age_rule']) && $_POST['txt_age_rule']!=''){
                            $age_rules = array("age"=>$_POST['txt_age_rule']);
                        }
                        $new_arr = array_merge($age_rules,$arr);
                        $image_rules = json_encode($new_arr);
                        
                        $usr_insert_img = $this->insertuserimage($insertimage, $_POST['txt_img_title'],$_POST['txt_img_text'] ,$image_rules, $_POST['sel_currency'], $_POST['txt_img_price'], $_POST['txt_dwn_price'], $_POST['sel_category'], $this->userdetail['image_limit'], $targetFile, $_POST['sel_subcategory'], $cutcoins,$file_size1,$_POST['txt_artist_id'],$_POST['txt_artist_link']);
                    }
                }
            }
            header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "imgupload/");
            exit;
        endif;
    }

    function profileinfo() {
        $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
        if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
            $uid = $_SESSION['current_artist'];
        }
        //$qry = "SELECT * FROM tbl_users WHERE status = 1 AND id = " . $_SESSION['po_userses']['flc_usrlogin_id'];
        $qry = "SELECT * FROM tbl_users WHERE status = 1 AND id = " . $uid; 
        return $result = $this->modelObj->fetchRow($qry);
    }

    function getSettings() {
        $qry_settings = "SELECT * FROM tbl_settings WHERE id = 1";
        return $result_settings = $this->modelObj->fetchRow($qry_settings);
    }
    function getplandetails($planid) {
        $qry = "SELECT * FROM tbl_plans WHERE id = '" . clear_input($planid) . "' AND status = 1 LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function insertuserimage($insertimage, $imgtitle, $imgtext,$image_rules, $currency, $imgprice, $imgdwnprice, $catid, $imglimit, $musicnewname, $subcatid, $cutcoins,$file_size1,$txt_artist_id,$txt_artist_link) {
		if(empty($imgdwnprice)){
			$imgdwnprice = 00.00;
		}
        $_SESSION['po_userses']['flc_usrlogin_id'];
        $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
        if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
            $uid = $_SESSION['current_artist'];
        }
        
        
        
        $qry = "INSERT INTO `tbl_user_images`(`user_id`, `image`,`music` ,`img_title`, `image_text`,`image_rules`, `price_currency`, `img_price`,`dowanload_price`, `category_id`, `cr_date`, `status`,`music_artist`,`music_link`) VALUES ('" . $uid . "','" . clear_input($insertimage) . "','" . $musicnewname . "','" . clear_input($imgtitle) . "','" . clear_input($imgtext) . "','".$image_rules."','" . clear_input($currency) . "','" . clear_input($imgprice) . "','" . clear_input($imgdwnprice) . "','" . clear_input($catid) . "',NOW(),1,'".implode(",", $txt_artist_id)."','".$txt_artist_link."')";
        $result = $this->modelObj->runQuery($qry);
        $lastid = mysql_insert_id();
        if ($lastid && $lastid > 0):
            $imglimit = $imglimit - 1;
            $qry2 = "UPDATE tbl_users SET image_limit = image_limit-" . clear_input($cutcoins) . ",available_size = available_size-".$file_size1." WHERE status = 1 AND id = " . $uid;
            $result2 = $this->modelObj->runQuery($qry2);
        endif;

        $qry1 = "INSERT INTO `tbl_users_sub_category_images`(`user_id`, `cat_id`,`subcat_id` ,`userimage_id`, `cr_date`, `status`) VALUES ('" . $uid . "','" . clear_input($catid) . "','" . clear_input($subcatid) . "','" . $lastid . "',NOW(),1)";
        $result1 = $this->modelObj->runQuery($qry1);

        return $result;
    }
//    function getcompanypageCatAccess(){
//        $qry = "SELECT categories_access FROM tbl_company_artists_assign WHERE company_id = '" . clear_input($_SESSION['po_userses']['flc_usrlogin_id']) . "' and artist_id = '". clear_input($_SESSION['current_artist'])."' and status = 1 LIMIT 1";
//        $result = $this->modelObj->fetchRow($qry);
//        return $result['categories_access'];
//    }
}

?>