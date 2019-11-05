<?php
ob_start();
session_destroy();
header('location: ../admin');
exit;
?>