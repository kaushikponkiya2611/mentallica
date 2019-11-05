<?php
	class VideoController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new VideoModel();
			$this->getvideo = $this->getVideo();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getVideo(){
		  $qry="SELECT * FROM tbl_video where status!=2 order by cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT * FROM tbl_video where status!=2";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>