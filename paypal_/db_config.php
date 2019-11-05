<?php

define("DB_HOST", "io.your-site.com");
define("DB_USERNAME", "scampi");
define("DB_PASSWORD", "laurence2");
define("DB_DATABASE", "scampi_db_mentallica");



$connect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Database Connection Error");
mysql_select_db(DB_DATABASE) or ("Database Selection Error");
?>
