<?php
	class Artist_suggestedController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new Artist_suggestedModel();
			$this->getartist_suggested = $this->getArtist_suggested();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getArtist_suggested(){
		  $qry="SELECT * FROM tbl_suggested_artist where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_suggested_artist where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>