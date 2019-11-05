<?php
class ArtistsimagesController extends CommonController
{
	function __construct(){
		parent::__construct();
		$this -> modelObj = new ArtistsimagesModel();

		$this -> getuserimages = $this -> getuserimages();
	}
}
?>