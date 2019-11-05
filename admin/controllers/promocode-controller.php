<?php

class PromocodeController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new PromocodeModel();
        $this->getpromocode = $this->getPromocode();
        $this->gettotalpageno = $this->gettotalpageno();
    }

    function getPromocode() {
        $qry = "SELECT * FROM tbl_promocode where status!=2 order by cr_date desc LIMIT 0 , 20";
        return $result = $this->modelObj->fetchRows($qry);
    }

    function gettotalpageno() {
        $qry = "SELECT * FROM tbl_promocode where status!=2";
        return $result = $this->modelObj->numRows($qry);
    }

}

?>