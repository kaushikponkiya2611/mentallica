<?php
require('mp3file.class.php');
if(!empty($_FILES)){
	
	//database configuration
	$dbHost = 'io.your-site.com';
	$dbUsername = 'scampi';
	$dbPassword = 'laurence2';
	$dbName = 'scampi_db_mentallica';
	//connect with the database
	$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	if($mysqli->connect_errno){
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$targetDir = "uploads/";
	$fileName = $_FILES['file']['name'];
	$targetFile = $targetDir.$fileName;

	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			$mp3file = new MP3File($targetFile);
			$duration1 = $mp3file->getDurationEstimate();
			$duration2 = $mp3file->getDuration();
			$time=MP3File::formatTime($duration2);
				
			
			$sql = "select * from tbl_radio order by id desc limit 1";
			$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$stime = $row['end_time'];
						$etime = $time;
						$endtime = addTwoTimes($stime,$etime);	
					}
				} else {
						$stime = "00:00:00";
						$etime = $time;
						$endtime = addTwoTimes($stime,$etime);	
				}
				
 			
			$conn->query("INSERT INTO tbl_radio (title,image,time,start_time,end_time,cr_date,status) VALUES('".$fileName."','".$fileName."','".$time."','".$stime."','".$endtime."','".date("Y-m-d H:i:s")."','1')");
			
			$conn->close();
	}
	
}

function addTwoTimes($time1 = "00:00:00", $time2 = "00:00:00"){
        $time2_arr = [];
        $time1 = $time1;
        $time2_arr = explode(":", $time2);
        //Hour
        if(isset($time2_arr[0]) && $time2_arr[0] != ""){
            $time1 = $time1." +".$time2_arr[0]." hours";
            $time1 = date("H:i:s", strtotime($time1));
        }
        //Minutes
        if(isset($time2_arr[1]) && $time2_arr[1] != ""){
            $time1 = $time1." +".$time2_arr[1]." minutes";
            $time1 = date("H:i:s", strtotime($time1));
        }
        //Seconds
        if(isset($time2_arr[2]) && $time2_arr[2] != ""){
            $time1 = $time1." +".$time2_arr[2]." seconds";
            $time1 = date("H:i:s", strtotime($time1));
        }

        return date("H:i:s", strtotime($time1));
    }
?>