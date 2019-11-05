<?php
	class Connection{
        function __construct(){
            switch($_SERVER['DOCUMENT_ROOT']){
                case '/home10/mentalli/public_html':
                    $this->host = 'localhost';
                    $this->user = 'mentalli';
                    $this->passwd = 'YceCEvxrJq';
                    $this->database = 'mentalli_db';
                    break;
                default	:
                    $this->host = 'localhost';
                    $this->user = 'root';
                    $this->passwd = '';
                    $this->database = 'projectone';
                    break;
            }
            $this->clink = @mysql_connect($this->host,$this->user,$this->passwd);
            @mysql_select_db($this->database,$this->clink);			
        }
	}
	function clear_input($data){
        return str_replace("<script","&lt;script",mysql_real_escape_string(trim($data)));
	}
?>