<?php

class CommonController
{
	function __construct()
	{		
		$this -> modelObj = new CommonModel();		
		
		if(isset($_POST['totalrecord']) && $_POST['totalrecord'] != ''){
			$this -> commonpaging="limit 0,".$_POST['totalrecord'];
			$this -> mypages = $_POST['totalrecord'];
		}else{
		$this -> commonpaging="limit 0,10";
			$this -> mypages="10";
		}
		//echo $_POST['totalrecord'];
		unset($_SESSION['srchqry']);
		unset($_SESSION['srcval']); 
		unset($_SESSION['id']); 
		unset($_SESSION['did']); 
		unset($_SESSION['mpid']); 
		unset($_SESSION['cuid']); 
		if($_GET['pid'] != ''){
			$_SESSION['pid'] = $_GET['pid'];
		}
		$this->section = $this->getSection();
		if($this->section != ''){
		  $this->sectionlink($id);
		}
		if (isset($_POST['txt_username']) && $_POST['txt_username'] != '' && isset($_POST['txt_password']) && $_POST['txt_password'] != '')
		{			
			$this -> adminLogin();
		}
		$this -> seodata = $this -> getPagetTitleAndHeading();
		$array = explode('@',$this -> seodata);
		$this -> pageTitle = $array[0];
		$this -> h1 = $array[1];
		$this -> mainimage = $array[2];
		$this -> addpageArray = array('add-content', 'add-article', 'add-category', 'add-storyboard','add-storyboard-category','add-tabs','add-tab2details');
		
		
		
		$this->getCurtYear = $this->getCurtYear();
		
		
		
		$this->getsetting = $this->getSettings();
		$thetheme=$this->getsetting;
		$this->mytheme=$thetheme;
		
	}
	
	function getCountry()
	{
		$qry="SELECT * FROM tbl_country WHERE status=1 ORDER BY cr_date DESC";
		return $result = $this -> modelObj -> fetchRows($qry);
	}
	function getState()
	{
		$qry="SELECT * FROM tbl_state WHERE status=1 ORDER BY stateName ASC";
		return $result = $this -> modelObj -> fetchRows($qry);
	}
	function getCity()
	{
		$qry="SELECT * FROM tbl_city WHERE status=1 ORDER BY cityName ASC";
		return $result = $this -> modelObj -> fetchRows($qry);
	}
	function hrName($hrId)
	{
		$qry="SELECT h.first_name,h.last_name,c.company_title FROM tbl_hr h,tbl_company c WHERE h.company_id=c.Id and h.Id='".$hrId."'";
		return $result = $this -> modelObj -> fetchRow($qry);
	}
	
	
	
	function getCurtYear()
	{
		$qry="SELECT YEAR(CURDATE()) AS curtYear, MONTH(CURDATE()) AS curtMonth";
		return $result = $this->modelObj->fetchRow($qry);	
	}
	
	function getSection(){
	 if($_SESSION['USER_TYPE'] == 1){
	    $qrysection = "select * from rollmanagement WHERE Emp_Id = '".mysql_real_escape_string($_SESSION['ADMIN_ID'])."'";
	    $resultsection = $this -> modelObj -> fetchRows($qrysection);
		foreach($resultsection as $k => $val){
		    $id = $val['mainsection'].",".$id;
		}
		$finalid = substr($id,0,(strlen($id)-1));
		$qry = "select * from tbl_section  where Status='1'  and Section_Id IN  (".$finalid.") order by Order_no";
		
	 }else{
	     $qry = "select * from tbl_section  where Status='1' order by Order_no";
	 }
	  return $result = $this -> modelObj -> fetchRows($qry);
	  
	}
	
	function sectionlink($id){
	  if($_SESSION['USER_TYPE'] == 1){
	     $qrysubsection = "select * from rollmanagement WHERE Emp_Id = '".mysql_real_escape_string($_SESSION['ADMIN_ID'])."'
		                        and mainsection = '".mysql_real_escape_string($id)."'";
	    $resultsubsection = $this -> modelObj -> fetchRow($qrysubsection);
		  $subid = substr($resultsubsection['subsection'],0,(strlen($resultsubsection['subsection'])-1));
	    $qry = "SELECT * FROM tbl_sectionlink   WHERE status = '1' and Subsection_Id  IN (".$subid.") order by Order_no";
	  }else{
	    $qry = "SELECT * FROM tbl_sectionlink   WHERE status = '1' and Section_Id  ='".$id."' order by Order_no";
	  }
	  
	  return $result = $this -> modelObj -> fetchRows($qry);
	}
	function setMessage($msg)
	{
		$_SESSION['Msg'] = $msg;
	}
	function setSuccessMessage($msg) 
	{
		$_SESSION['Success_Msg'] = $msg;
	}
	function getMessage()
	{
		if(isset($_SESSION['Msg']) && $_SESSION['Msg']!='') 
		{
		echo $_SESSION['Msg'];
		unset($_SESSION['Msg']);
		}
		elseif(isset($_SESSION['Success_Msg']) && $_SESSION['Success_Msg']!='') 
		{
		echo $_SESSION['Success_Msg'];
		unset($_SESSION['Success_Msg']);
		}
	}
	function getPaginationString()
	{
		return $this -> modelObj -> renderFullNav();
	}
	function getPaginationString1()
	{
		return $this -> modelObj -> renderFullNav1();
	}
	
	function adminLogin()
	{
			$qry = "SELECT * FROM admin WHERE username = '".$_POST['txt_username']."' AND
			         password = '"./*$_POST['txt_password']*/md5($_POST['txt_password'])."' and status=1";
			$admin = $this -> modelObj -> fetchRow($qry);
			if ($admin != '')
			{
				if ($admin['status'] == 1)
				{
						$_SESSION['ADMIN_ID'] = $admin['adminid']; 
						$_SESSION['ADMIN_FIRSTNAME'] = $admin['firstname'];
						$_SESSION['ADMIN_LASTNAME'] = $admin['lastname'];
						$_SESSION['ADMIN_USERNAME'] = $admin['username'];
						$_SESSION['USER_TYPE'] = $admin['user_type'];
						$_SESSION['LAST_LOGIN'] = date('Y-m-d H:i',strtotime($admin['logindate']));
						
						$qryupdate = "UPDATE admin SET logindate = '".mysql_real_escape_string(trim(date('Y-m-d H:i')))."'
						              WHERE adminid = '".mysql_real_escape_string(trim($_SESSION['ADMIN_ID']))."'";
						$resultupdate = $this->modelObj->runQuery($qryupdate);
						
						if(isset($_POST['login-check']) && $_POST['login-check']==1)
						{
							$name=$_POST['txt_username'];
							setcookie("adminfausername", $name,time()+60*60*24*30);
							$pswd=$_POST['txt_password'];
							setcookie("adminfapswd",$pswd,time()+60*60*24*30);
						}
						elseif(!isset($_POST['login-check']) && $_POST['login-check']!=1)
						{
							setcookie("adminfausername", "", time()-3600);
							setcookie("adminfapswd", "", time()-3600);
						}
						if($_SESSION['USER_TYPE'] == 1){
						$qrysection = "select * from rollmanagement WHERE 
						               Emp_Id = '".mysql_real_escape_string($_SESSION['ADMIN_ID'])."'
						               limit 0,1";
						$resultsection = $this -> modelObj -> fetchRow($qrysection);
						 $id = explode(",",$resultsection['subsection']);
						$qry = "select Link from tbl_sectionlink 
						        where Status='1'  and Subsection_Id =  ".$id[0]." order by Order_no limit 0,1";
						$qrylink = $this -> modelObj -> fetchRow($qry);
					       header('location: index.php?pid='.$qrylink['Link']);
						}else{
						   header('location: index.php?pid=dashboard');
						}
				}
				else
				{
					$this -> setMessage('Your account is suspended temporarily. Please contact super admin.');
				}
			}
			else
			{
				$this -> setMessage('Invalid username or password.');
			}
	}
	function getPagetTitleAndHeading()
	{
		if($_GET['pid']=='employeemanagement')
		{
			$pageTitle = "Manage Employee";
			$h1 = "Manage Employee";
			$image = "default.png";
		}
		else if($_GET['pid']=='manage-menu')
		{
			$pageTitle = "Manage Menu";
			$h1 = "Manage Menu";
			$image = "menu.png";
		}
		else if($_GET['pid']=='changepassword')
		{
			$pageTitle = "Change Password";
			$h1 = "Change Password";
			$image = "default.png";
		}
		else
		{
			if($_GET['pid']=='')
			{
				$mypid="dashboard";
			}
			else
			{
				$mypid=$_GET['pid'];
			}
			$qry = "select * from tbl_section where Link='".$mypid."'";
			$result = $this -> modelObj -> fetchRow($qry);
			if($result != '')
			{
				$pageTitle = $result['page_name'];
				if($mypid=="song"){
					$qry_album = "select * from tbl_album where Id='".$_GET['id']."'";
					$result_album = $this -> modelObj -> fetchRow($qry_album);
					
					$qry_band = "select * from tbl_band where Id='".$_GET['bandid']."'";
					$result_band = $this -> modelObj -> fetchRow($qry_band);
					
					
					$h1 = $result['section_name'];
				}else if($mypid=="donor"){
					$qry_donation = "select * from tbl_donation where Id='".$_GET['id']."'";
					$result_donation = $this -> modelObj -> fetchRow($qry_donation);
					
					$h1 = $result['section_name']." for ".strtoupper($result_donation['title']);
				}else{
					$h1 = $result['section_name'];
				}				
				$image = $result['Image'];
			}
			else
			{
				$qry = "select * from tbl_sectionlink where Link='".$mypid."'";
				$result = $this -> modelObj -> fetchRow($qry);
				if($result != '')
				{
					$pageTitle = $result['page_name'];
					$h1 = $result['section_name'];
					$image = $result['Image'];
				}
			}
		}
		return $pageTitle."@".$h1."@".$image;
	}
	function getFormatedDate($input)
	{
		$array = explode(' ',$input);
		$date = $array[0];
		$time = $array[1];
		$date_array = explode('-',$date);
		$time_array = explode(':',$time);
		$year = substr($date_array[0],2,2);
		return $output = $time_array[0].":".$time_array[1]." ".$date_array[1]."/".$date_array[2]."/".$year;
	}
	
	function getGenre($genrepack){
		$explodegenre=explode(",",$genrepack);
		$listing="";
		foreach($explodegenre as $k => $val)
		{
			$qry_genre = "select * from tbl_genre where Id='".$val."'";
			$result_genre = $this -> modelObj -> fetchRow($qry_genre);
			
			if($listing==""){
				$listing=$result_genre['categoryName'];
			}else{
				$listing=$listing.",".$result_genre['categoryName'];
			}
		}
		return $listing;
	}
	function getSettings()
	{
		$qry="SELECT * FROM tbl_settings";
		$result = $this -> modelObj -> fetchRow($qry);
		return $result['theme'];
	}
	function getSiteCurrency()
	{
		$qry="SELECT currency FROM tbl_settings";
		$result = $this -> modelObj -> fetchRow($qry);
		return $result['currency'];
	}
	function getPlanDetail($id){
		$qry="SELECT * FROM tbl_plan WHERE status=1 AND id='".$id."'";
		return $result = $this->modelObj->fetchRow($qry);
	}
	function getPlanList(){
		$qry="SELECT * FROM tbl_plan WHERE status=1 ORDER BY cr_date DESC";
		return $result = $this->modelObj->fetchRows($qry);
	}
	function totalpage($totalrecord,$recordperpage)
	{
		$page=$totalrecord/$recordperpage;
		
		$ex_page=explode(".",$page);
		
		if($ex_page[1]>0)
		{
			$totalpage=$ex_page[0]+1;
		}
		else
		{
			$totalpage=$ex_page[0];
		}
		return $totalpage;
	}
	function getCompanyByIds()
	{
		$qry="SELECT * FROM  user WHERE id >0 and user_type like 'employer' and status like '1' and date(exp_date) >= date(now()) ";
      	return $result = $this->modelObj->fetchRows($qry);
	}
	function getCustomerPerMonth($year,$month)
	{
	 	$qry="SELECT * FROM tbl_users WHERE MONTH(cr_date) = '".$month."' AND YEAR(cr_date) = '".$year."' AND status!=2";
		//SELECT * FROM  user WHERE id >0 and user_type like 'employer' and status like '1' and date(exp_date) >= date(now())
		return $result = $this->modelObj->numRows($qry);	
	}
	function getArtistPerMonth($year,$month)
	{
	 	$qry="SELECT * FROM tbl_users WHERE MONTH(cr_date) = '".$month."' AND YEAR(cr_date) = '".$year."' AND status!=2 and usertype = 1";
		//SELECT * FROM  user WHERE id >0 and user_type like 'employer' and status like '1' and date(exp_date) >= date(now())
		return $result = $this->modelObj->numRows($qry);	
	}
	function getClientPerMonth($year,$month)
	{
	 	$qry="SELECT * FROM tbl_users WHERE MONTH(cr_date) = '".$month."' AND YEAR(cr_date) = '".$year."' AND status!=2 and usertype = 2";
		//SELECT * FROM  user WHERE id >0 and user_type like 'employer' and status like '1' and date(exp_date) >= date(now())
		return $result = $this->modelObj->numRows($qry);	
	}
	function getCompanyPerMonth($year,$month)
	{
	 	$qry="SELECT * FROM tbl_users WHERE MONTH(cr_date) = '".$month."' AND YEAR(cr_date) = '".$year."' AND status!=2 and usertype = 3";
		//SELECT * FROM  user WHERE id >0 and user_type like 'employer' and status like '1' and date(exp_date) >= date(now())
		return $result = $this->modelObj->numRows($qry);	
	}
	function getOffersCategoryList(){
		$qry="SELECT * FROM tbl_category WHERE status=1 ORDER BY categoryName ASC";
		return $result = $this->modelObj->fetchRows($qry);
	}
	function getOffersCategoryName($cid){
		$qry="SELECT * FROM tbl_category WHERE status=1 and id='".clear_input($cid)."' ORDER BY categoryName ASC";
		$result = $this->modelObj->fetchRow($qry);
		return $result['categoryName'];
	}
	
}	
?>