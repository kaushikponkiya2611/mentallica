<?php
ob_start();
session_start();
session_destroy();
unset($_SESSION['po_userses']);
header("location: ".$_SESSION['FRNT_DOMAIN_NAME']."home/");
exit;
?>