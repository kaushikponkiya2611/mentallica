<!DOCTYPE HTML>
<html>
<head>
    <title>Radio</title>
    <style type="text/css">
    body { background-color: #fdfdfd; padding: 0 20px; color:#000; font: 13px/18px monospace; width: 800px;}
    a { color: #360; }
    h3 { padding-top: 20px; }
	.ppscrubber{display:none;}
    </style>

    <!-- Load player theme -->
    <link rel="stylesheet" href="themes/maccaco/projekktor.style.css" type="text/css" media="screen" />

    <!-- Load jquery -->
    <script type="text/javascript" src="jquery-1.9.1.min.js"></script>

    <!-- load projekktor -->
    <script type="text/javascript" src="projekktor-1.3.09.min.js"></script>

</head>
<body>
<?php 
	include('../../models/db.php');
	$database = new Connection();
	date_default_timezone_set('Asia/Calcutta');
	
?>
    

    <div id="player_a" class="projekktor"></div>

    <script type="text/javascript">
    $(document).ready(function() {
	
        projekktor('#player_a', {
        poster: 'media/logo.png',
        title: 'Radio',
        playerFlashMP3: 'swf/StrobeMediaPlayback/StrobeMediaPlayback.swf',
        width: 640,
		height: 385,
		controls: true,
		continuous: true,
		//disallowSkip:true,
		disablePause: true,
		autoplay: true,
        playlist: [
		 <?php
				$t_time = date('h:i:s',time()); 
				$qrytime = mysql_query("SELECT * FROM tbl_radio where status=1 and '$t_time' <= end_time limit 1");
				$rowtime = mysql_fetch_row($qrytime);
				 $endtimes=$rowtime[4];
				$nowtimes=$t_time;
				$skiptime = strtotime($nowtimes)-strtotime($endtimes); 
				$qry = mysql_query("SELECT * FROM tbl_radio where status=1 and '$t_time' <= end_time");
				while ($row = mysql_fetch_assoc($qry)) {
			 ?> 
            {
            0: {src: "http://www.mentallica.com/projectone/admin/uploads/<?php echo $row['image']; ?>", type: "audio/mp3"}
            },
			<?php 
				}
			?>
        ]    
        }, function(player) {	
					diff = Number(<?php echo $skiptime; ?>);		
					player.setPlayhead(diff);
                } // on ready 
        );
    });
    </script>
Asia/Calcutta Cureent Time :- <?php echo $t_time; ?>
</body>
</html>