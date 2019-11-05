<!DOCTYPE html>
<!-- saved from url=(0055)http://visjs.org/examples/timeline/other/drag&drop.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <title>Timeline | Drag and Drop</title>
  
  <script src="jquery-1.12.4.js"></script>
  <script src="./dragdrop_visjs/vis.js.download"></script>
  <link href="./dragdrop_visjs/vis.css" rel="stylesheet" type="text/css">  

  <style type="text/css">
    li.item {
      list-style: none;
      width: 150px;
      color: #1A1A1A;
      background-color: #D5DDF6;
      border: 1px solid #97B0F8;
      border-radius: 2px;
      margin-bottom: 5px;
      padding: 5px 12px;
    }
    li.item:before {
      content: "≣";
      font-family: Arial, sans-serif;
      display: inline-block;
      font-size: inherit;
      cursor: move;
    }
	.vis-point{
		border:1px solid !important;
	}
  </style>
</head>
<body>
<div id="visualization"></div>

<div>
  <h3>Items:</h3>
  <ul class="items">
    <?php
	error_reporting(0);
	require_once('getid3/getid3.php');
	
	$directory = 'mp3';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));	
	$i=0;
	foreach($scanned_directory as $k=>$val){
		$i++;
		$getID3 = new getID3;

		$path = 'mp3/'.$val;
		$mixinfo = $getID3->analyze($path);

		getid3_lib::CopyTagsToComments($mixinfo);

		$bit_rate = $mixinfo['audio']['bitrate'];
		$play_time = $mixinfo['playtime_string'];

		list($mins, $secs) = explode(':', $play_time);

		if ($mins > 60) {
			$hours = intval($mins / 60);
			$mins = $mins - $hours * 60;
		}

		$play_time = sprintf("%02d:%02d:%02d", $hours, $mins, $secs);
		
		sscanf($play_time, "%d:%d:%d", $hours, $minutes, $seconds);

		$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

		//echo $play_time;
		$hname = str_replace(" ","",$val);
		$hname = str_replace(".","",$hname);
		?>	
		<li draggable="true" class="item">
		  <?php echo $val; ?>
		</li>
		<input type="hidden" name="h_<?php echo $hname; ?>" id="h_<?php echo $hname; ?>" value="<?php echo $time_seconds; ?>">
		<audio id="audio_<?php echo $hname; ?>">
		  <source src="<?php echo $FRNT_DOMAIN_NAME;?>Timeline/mp3/<?php echo $val; ?>" type="audio/mpeg">		  
		</audio>
		<?php
	}
	?>
    
  </ul>
</div>

<script type="text/javascript">
  // DOM element where the Timeline will be attached
  var container = document.getElementById('visualization');

  // Create a DataSet (allows two way data-binding)
  var items = new vis.DataSet([
   
  ]);

  // Configuration for the Timeline
    var options = {
    stack: true,
    start: new Date(),
    end: new Date(1000*60*60 + (new Date()).valueOf()),
    editable: true,
    orientation: 'top',
    onAdd: function (item, callback) {		
		var content = item.content;
		var songduration = content.replace(' ', '');
		var songduration = songduration.replace('.', '');
		
		var totalseconds = $("#h_"+songduration).val();
		
		item.end = new Date(1000*totalseconds + (item.start).valueOf());
		item.content=item.content+'<br><a id="a_'+songduration+'" href="javascript:;" onclick="playsong(\''+songduration+'\')">Play</a>';
		//alert(item.start);
		//alert(item.end);
		console.log(item);		
		callback(item); 
    },

    onMove: function (item, callback) {
     console.log(item);
	  callback(item); 
    }
  };


  // Create a Timeline
  var timeline = new vis.Timeline(container, items, options);
  
  
    function handleDragStart(event) {
    dragSrcEl = event.target;

    event.dataTransfer.effectAllowed = 'move';
    
    var item = {
	type: 'point',
      content: event.target.innerHTML.trim()
    };

    /*var isFixedTimes = (event.target.innerHTML.split('-')[2] && event.target.innerHTML.split('-')[2].trim() == 'fixed times')
    if (isFixedTimes) {
      item.start = new Date();
      item.end = new Date(1000*60*10 + (new Date()).valueOf());
    }*/

    event.dataTransfer.setData("text", JSON.stringify(item));	
  }  

  var items = document.querySelectorAll('.items .item');

  for (var i = items.length - 1; i >= 0; i--) {
    var item = items[i];
    item.addEventListener('dragstart', handleDragStart.bind(this), false);
  }  
  function playsong(songid){	  
	  $('#audio_'+songid)[0].play();
	  document.getElementById('a_'+songid).innerHTML = 'Pause';
	  document.getElementById('a_'+songid).onclick = function () { pausesong(songid) }; 
  }
  function pausesong(songid){
	  $('#audio_'+songid)[0].pause();
	  document.getElementById('a_'+songid).innerHTML = 'Play';
	  document.getElementById('a_'+songid).onclick = function () { playsong(songid) }; 
  }
</script>
</body>
</html>
