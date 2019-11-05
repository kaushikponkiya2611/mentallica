<?php
	class OffersController extends CommonController
	{
		function __construct()
		{
			parent::__construct();
			$this -> modelObj = new OffersModel();
			$this->getoffers = $this->getOffers();
			$this->gettotalpageno = $this->gettotalpageno();
		}
		
		function getOffers(){
		  $qry="SELECT o.*, c.categoryName FROM tbl_offers o, tbl_category c where o.status!=2 and c.status!=2 and o.offerCategory=c.id order by o.cr_date desc LIMIT 0 , 20";
		  return $result = $this->modelObj->fetchRows($qry);
		}
		
		function gettotalpageno(){
		  $qry = "SELECT o.*, c.categoryName FROM tbl_offers o, tbl_category c where o.status!=2 and c.status!=2 and o.offerCategory=c.id";
		  return $result = $this->modelObj->numRows($qry);
		}
	}
	?>