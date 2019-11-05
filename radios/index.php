<?php 
	include('../models/db.php');
	$database = new Connection();
	date_default_timezone_set('Asia/Calcutta');
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Mentallica Radio</title>
        
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" /><!-- scroll in playlist -->
        <link rel="stylesheet" type="text/css" href="css/html5audio_default.css" />
		<link rel="stylesheet" type="text/css" href="css/html5audio_classic_popup.css" />
        
        <script type="text/javascript" src="js/swfobject.js"></script><!-- flash backup --> 
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script><!-- jquery ui sortable/draggable -->
        <script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script><!-- mobile drag/sort -->
        <script type="text/javascript" src="js/jquery.XDomainRequest.js"></script><!-- ofm ie9 and below fix -->
        <script type="text/javascript" src="js/jquery.mousewheel.min.js"></script><!-- scroll in playlist -->
        <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script><!-- scroll in playlist -->
        <script type="text/javascript" src="js/id3-minimized.js"></script><!-- id3 tags -->
        <script type="text/javascript" src="js/jquery.html5audio.min.js"></script>
        <script type="text/javascript" src="js/jquery.html5audio.func.js"></script>
        <script type="text/javascript" src="js/jquery.html5audio.settings_classic_popup.js"></script>
        
	</head>
	<body>
        
        <div id="componentWrapper">
        
        	<!-- <div class="controls_prev"><img src='media/data/icons/set2/prev.png' alt='controls_prev'/></div>
        
        	 <div class="controls_toggle"><img src='media/data/icons/set2/play.png' alt='controls_toggle'/></div>
             
             <div class="player_mediaTime_current">00:00</div>
             
             <div class="controls_next"><img src='media/data/icons/set2/next.png' alt='controls_next'/></div>
        
             <div class="player_progress">
                  <div class="progress_bg"></div>
                  <div class="load_progress"></div>
                  <div class="play_progress"></div>
                  <div class="player_progress_tooltip"><p></p></div>
             </div>
             
             <div class="player_mediaTime_total">00:00</div>-->
             
             <div class="player_volume_wrapper">
                 <div class="player_volume"><img src='media/data/icons/set2/volume.png' alt='player_volume'/></div>
                 <div class="volume_seekbar" data-autoHide="3000">
                     <div class="volume_bg"></div>
                     <div class="volume_level"></div>
                     <div class="player_volume_tooltip"><p></p></div>
                  </div>
             </div>          

        </div>
        
        <!-- List of playlists -->
        <div id="playlist_list">
                     
             <!-- local playlist -->
             <ul id='playlist1'>
			 <?php
				$t_time = date('h:i:s',time()); 
				$qry = mysql_query("SELECT * FROM tbl_radio where status=1 and '$t_time' <= end_time");
				while ($row = mysql_fetch_assoc($qry)) {
			 ?> 
			 
                <li class= 'playlistItem' data-type='local' data-mp3='http://www.mentallica.com/projectone/admin/uploads/<?php echo $row['image']; ?>'><a class='playlistNonSelected' href='#'><?php echo $row['title']; ?></a></li>
			<?php } ?>	 
             </ul>

         </div>
	
	</body>
</html>
