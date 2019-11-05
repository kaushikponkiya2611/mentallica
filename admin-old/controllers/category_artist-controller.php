<?php
	class Category_artistController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new Category_artistModel();
			$this->getcategory_artist = $this->getCategory_artist();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getCategory_artist(){
		  $qry="SELECT * FROM tbl_category where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_category where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>