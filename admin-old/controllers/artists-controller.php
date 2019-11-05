<?php
	class ArtistsController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new ArtistsModel();
			$this->getartists = $this->getArtists();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getArtists(){
		  $qry="SELECT * FROM tbl_users where status!=2 and usertype=1 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_users where status!=2 and usertype=1";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>