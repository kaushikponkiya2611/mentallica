<?php

class ArtistlistController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new ArtistlistModel();

        //$this -> homecategorylist = $this -> getcategorylist();

        if (!isset($_GET['workid']) || $_GET['workid'] == ''):
            $this->redirecttohomepage();
        endif;

        $this->artistlistbycategory = $this->getartistbypreviewcategory($_GET['workid']);
    }

    function getartistbypreviewcategory($catid) {
        $src_str = '';
        if (isset($_POST['src_first_name']) && $_POST['src_first_name'] != ''):
            $src_str .= " AND first_name LIKE '%" . $_POST['src_first_name'] . "%' ";
        endif;
        if (isset($_POST['src_last_name']) && $_POST['src_last_name'] != ''):
            $src_str .= " AND last_name LIKE '%" . $_POST['src_last_name'] . "%' ";
        endif;
        if (isset($_POST['src_gender']) && $_POST['src_gender'] != ''):
            $src_str .= " AND gender = '" . $_POST['src_gender'] . "' ";
        endif;
        if (isset($_POST['src_email']) && $_POST['src_email'] != ''):
            $src_str .= " AND emailid LIKE '%" . $_POST['src_email'] . "%' ";
        endif;
        if (isset($_POST['src_country']) && $_POST['src_country'] != ''):
            $src_str .= " AND country = '" . $_POST['src_country'] . "' ";
        endif;
        if (isset($_POST['src_state']) && $_POST['src_state'] != ''):
            $src_str .= " AND state = '" . $_POST['src_state'] . "' ";
        endif;

        //b4134054070b3fe8ed44aa5653167852
        //echo 'https://api.ipstack.com/'.$_SERVER["REMOTE_ADDR"].'?access_key=b4134054070b3fe8ed44aa5653167852';
        //$location = file_get_contents('https://api.ipstack.com/'.$_SERVER["REMOTE_ADDR"].'?access_key=b4134054070b3fe8ed44aa5653167852');
        //echo "<pre>";
        //print_r($location);
        //echo "</pre>";die;
        $location = file_get_contents('http://freegeoip.net/json/' . $_SERVER['REMOTE_ADDR']);
        $latilongi = json_decode($location);
        $src_str .= " ORDER BY distance ASC";
        $latitude = $latilongi->latitude;
        $longitude = $latilongi->longitude;
        //$qry="SELECT id, image, first_name, last_name, username FROM tbl_users WHERE FIND_IN_SET('".$catid."', preview_category) and usertype = 1 and status = 1 ".$src_str;
        if ($longitude == '') {
            $longitude = 'null';
        }
        if ($latitude == '') {
            $latitude = 'null';
        }
        $qry = "SELECT (ATAN(SQRT(POW(COS(RADIANS(users.latitude)) * SIN(RADIANS(users.longitude) - RADIANS(" . $longitude . ")), 2) +
        POW(COS(RADIANS(" . $latitude . ")) * SIN(RADIANS(users.latitude)) - SIN(RADIANS(" . $latitude . ")) * cos(RADIANS(users.latitude)) * cos(RADIANS(users.longitude) - RADIANS(" . $longitude . ")), 2)),SIN(RADIANS(" . $latitude . ")) * SIN(RADIANS(users.latitude)) + COS(RADIANS(" . $latitude . ")) * COS(RADIANS(users.latitude)) * COS(RADIANS(users.longitude) - RADIANS(" . $longitude . "))) * 6371000) as distance,id, image, first_name, last_name, username FROM tbl_users users WHERE FIND_IN_SET('" . $catid . "', preview_category) and usertype = 1 and status = 1 " . $src_str;
        $result = $this->modelObj->fetchRows($qry);
        return $result = $this->modelObj->fetchRows($qry);
    }
    
     function userDetails($user_id) {
        $query = "SELECT plan_id FROM tbl_users WHERE id='$user_id' ";
        //$data = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $result = $this->modelObj->fetchRow($query);
    }
}?>