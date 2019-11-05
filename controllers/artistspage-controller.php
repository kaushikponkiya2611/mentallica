<?php
class ArtistspageController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new ArtistspageModel();
		$this->artistslist = $this->getArtistList();
        
        if(isset($_POST['assign-artist']) && $_POST['assign-artist'] != '' && count($_POST) > 0){
            if($_POST['assign-artist']!=''){
               // echo "ss - ".$_POST['assign-artist'];die;
                $msg = $this->assignArtist($_POST['assign-artist'],$_SESSION['po_userses']['flc_usrlogin_id']);
                if($msg=='1'){
                   $msg_info = "Artist successfully assigned!";
                }else if($msg=='2'){
                   $msg_info = "Artist assigned failed!";
                }else{
                   $msg_info = "Artist already exists!";
                }   
            }else{
                $msg_info = "Please select artist!";
            }
            $_SESSION['po_userses']['login_error'] = '<h4>'.$msg_info.'</h4>';
            $_SESSION['po_userses']['login_error_cls'] = "callout-info";
            header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."artistspage/");
            exit;
        }
        if(isset($_POST['current-artist']) && $_POST['current-artist']!=''){
            $_SESSION['current_artist'] = $_POST['current-artist'];
        }
        
	}
    function getArtistList(){
        $qrya = "SELECT * FROM tbl_users where status!='2' and usertype='1' order by cr_date desc";
        return $this->modelObj->fetchRows($qrya);
    }
    function assignArtist($artist_id,$cpmny_id){
        
        $qry = "SELECT * FROM tbl_company_artists_assign where company_id = '".$cpmny_id."' and artist_id = '".$artist_id."' and status='1'";
        $result = $this->modelObj->numRows($qry);
        if($result == 0){
            $qry = "INSERT INTO `tbl_company_artists_assign`(`company_id`, `artist_id`,`status`) VALUES ('" .$cpmny_id. "','" .$artist_id. "','1')";
            $result = $this->modelObj->runQuery($qry);
            $lastid = mysql_insert_id();
            if ($lastid && $lastid > 0){
                $result = "1";
            }else{
                $result = "2";
            }
        }else{
            $result = "3";
        }
        return $result;
    }
    function getCompanyAssignedArtists(){
        
        $qrya = "SELECT tcaa.id as tbl_id,tcaa.*,tus.* FROM tbl_company_artists_assign tcaa inner join  tbl_users tus on tus.id = tcaa.artist_id where tcaa.status='1' and tus.usertype='1' and tcaa.company_id='".$_SESSION['po_userses']['flc_usrlogin_id']."' order by tbl_id DESC";
        return $this->modelObj->fetchRows($qrya);
    }
    function getArtistCategories($artist_id){
        $qry1 = "SELECT plan_id FROM tbl_users WHERE id='" . $artist_id . "'";
        $row1 = $this->modelObj->fetchRows($qry1);
        $plan = $row1[0]['plan_id'];
        
        $qry1 = "SELECT id,category FROM tbl_plans WHERE id='" . $plan . "'";
        $row1 = $this->modelObj->fetchRows($qry1);
        $category = $row1[0]['category'];
        
        $qry = "SELECT * FROM tbl_category WHERE status = 1 and find_in_set(id,'" . $category . "')";
        $result = $this->modelObj->fetchRows($qry);
        return $result = $this->modelObj->fetchRows($qry);
    }
    function get_approve_artists(){
        $qrya = "SELECT tcaa.id as tbl_id,tcaa.*,tus.* FROM tbl_company_artists_assign tcaa inner join  tbl_users tus on tus.id = tcaa.artist_id where tcaa.status='1' and tus.usertype='1' and tcaa.company_id='".$_SESSION['po_userses']['flc_usrlogin_id']."' and tcaa.access_approved !='No' order by tbl_id DESC";
        return $this->modelObj->fetchRows($qrya);
    }
}
?>