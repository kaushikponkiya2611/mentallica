<?php

class EditimageController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new EditimageModel();

        if (!isset($_GET['workid']) || $_GET['workid'] == ''):
            $this->redirecttohomepage();
        endif;

        if (isset($_POST) && isset($_POST['btn_editimage_info']) && $_POST['txt_img_title'] != ''):
            $downloadprice = null;
            if(isset($_POST['txt_dwn_price'])){
                $downloadprice = $_POST['txt_dwn_price'];
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
            
            $usr_insert_img = $this->updateuserimage($_POST['txt_img_title'], $_POST['txt_img_text'],$image_rules ,$_POST['sel_currency'], $_POST['txt_img_price'], $_POST['sel_category'], $_POST['sel_subcategory'], $downloadprice,$_POST['txt_artist_id'],$_POST['txt_artist_link']);
            header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "preview");
        endif;

        $this->getartistimgdetails = $this->getuserimagedetailbyid($_GET['workid']);
        $this->getartistimgsubcatdetails = $this->getuserimagesubcatdetails($_GET['workid']);



        $this->gtcategory = $this->getcategorylist($this->gtplans['category']);

        $this->gtsubcategory = $this->getsubcategorylist($this->getartistimgdetails['category_id']);
    }

    function updateuserimage($imgtitle, $imgtext,$image_rules, $currency, $imgprice, $catid, $subcatid, $downloadprice,$txt_artist_id,$txt_artist_link) {
        
        if($downloadprice=='' or $downloadprice==null){
            $downloadprice='';
        }else{
            $downloadprice = ', `dowanload_price` = "' . clear_input($downloadprice) .' "';
            
        }
        
        $qry = "UPDATE `tbl_user_images` SET `img_title` = '" . clear_input($imgtitle) . "', `image_text` = '" . clear_input($imgtext) . "',`image_rules`='".clear_input($image_rules)."' ,`price_currency` = '" . clear_input($currency) . "', `img_price` = '" . clear_input($imgprice) . "',`music_artist`='". implode(",", $txt_artist_id)."',`music_link`='".$txt_artist_link."' , `category_id` = '" . clear_input($catid) . "' $downloadprice WHERE id = '" . $_GET['workid'] . "' ";
        $result = $this->modelObj->runQuery($qry);

        $qry = "UPDATE `tbl_users_sub_category_images` SET `cat_id` = '" . clear_input($catid) . "', `subcat_id` = '" . clear_input($subcatid) . "' WHERE userimage_id = '" . $_GET['workid'] . "' ";
        $result = $this->modelObj->runQuery($qry);
        
        $select1 = "SELECT * from `tbl_users_sub_category_images` WHERE userimage_id='" . $_GET['workid'] . "'";
        $row1 = $this->modelObj->numRows($select1);
        if($row1==0){
            $select2 = "SELECT * from `tbl_user_images` WHERE id='" . $_GET['workid'] . "'";
            $row2 = $this->modelObj->fetchRow($select2);
            
            $insert = "INSERT INTO `tbl_users_sub_category_images` (user_id, cat_id, subcat_id, userimage_id, cr_date, status) 
                VALUES ('".$row2['user_id']."', '".clear_input($catid)."', '".clear_input($subcatid)."', '".$_GET['workid']."', NOW(), 1)";
            $this->modelObj->runQuery($insert);
        }

        return $result;
    }

}

?>