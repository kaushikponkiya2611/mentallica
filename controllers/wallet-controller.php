<?php

class WalletController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new WalletModel();
        
    }

    function getallplans() {
        $qry = "SELECT * FROM tbl_wallet WHERE status = 1 ORDER BY price ASC";
        return $result = $this->modelObj->fetchRows($qry);
    }

}

?>