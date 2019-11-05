<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>Timeline/dragdrop_visjs/vis.js.download"></script>
<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>Timeline/dragdrop_visjs/vis.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .wrapper {
        overflow-x: hidden;
    }
    
    ul.items {
        padding: 26px 0;
        background: #f0f7fd;
        display: inline-block;
        width: 100%;
        margin-top: 25px;
        position: relative;
    }
    
    ul.items:before {
        content: "";
        position: absolute;
        background: #f0f7fd;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
    }
    
    ul.items:after {
        content: "";
        position: absolute;
        background: #f0f7fd;
        right: -100%;
        top: 0;
        width: 100%;
        height: 100%;
    }
    
    li.item {
        list-style: none;
        width: 32.666%;
        color: #1A1A1A;
        background-color: #9bd3e9;
        border: 1px solid #2c87ab;
        border-radius: 3px;
        transition: all 0.3s ease 0s;
        -webkit-transition: all 0.3s ease 0s;
        margin-bottom: 10px;
        padding: 10px 15px 10px 40px;
        position: relative;
        float: left;
        min-height: 90px;
        cursor: move;
        margin-right: 1%;
    }
    
    li.item:hover {
        background: #2c87ab;
        color: #fff;
    }
    
    li.item:nth-child(3n) {
        margin-right: 0;
    }
    
    li.item:before {
        content: "≣";
        display: inline-block;
        font-size: inherit;
        cursor: move;
        font-size: 20px;
        position: absolute;
        left: 15px;
        top: 3px;
    }
    
    .vis-point {
        border: 1px solid !important;
    }
    
    h2 {
        margin-bottom: 30px;
        margin-top: 30px;
    }
    
    .savetimeline {
        margin-top: 25px;
    }
    
    .vis-panel.vis-center {
        background: #f0f0f0;
    }
    
    div#visualization {
        margin-top: 20px;
    }
    
    @media only screen and (max-width:991px) {
        li.item {
            font-size: 12px;
        }
    }
    
    @media only screen and (max-width:767px) {
        li.item {
            height: auto !important;
            min-height: inherit;
        }
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var maxHeight = 0;
        jQuery("li.item").each(function () {
            if ($(this).height() > maxHeight) {
                maxHeight = jQuery(this).height();
            }
        });
        jQuery("li.item").height(maxHeight);
    })
</script>

<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <div class="container">
                        <h2>Music:</h2>
                        <div id="visualization"></div>
                        <button type="button" class="savetimeline btn btn-primary">Save In timeline</button>
                        <div>
                            <ul class="items">
                                <?php
			error_reporting(0);
			require_once($_SESSION['APP_PATH'].'Timeline/getid3/getid3.php');
			
			$directory = $_SESSION['APP_PATH'].'Timeline/mp3';
			
			/* $gettimeline = mysql_query("SELECT * FROM radio_timeline");
			while($mscT=mysql_fetch_array($gettimeline)){
				$content = "/home10/mentalli/public_html/projectone/upload/images/".$mscT[2];
				$timearg[] = array('id' => $mscT[0], 'content' => $content , 'start' => $mscT[3], 'end' => $mscT[4]);
			}
			$timeargjson = json_encode($timearg);  */
			
			$gettimelineFinal = mysql_query("SELECT * FROM radio_timeline_final ORDER BY timelineid DESC LIMIT 1");
			while($mscTF=mysql_fetch_array($gettimelineFinal)){
				
				$data = json_decode($mscTF['timeline'], true);
				if(!empty($data)){
					foreach($data as $dataval){
						
						$timearg[] = array('id' => $dataval['id'], 'content' => $dataval['content'] , 'editable'=> false, 'start' => $dataval['start'], 'end' => $dataval['end'],'avoidOverlap' => true);
					}
				}
				
				
			}
			$timeargjson = json_encode($timearg);
			
			$scanned_directory = array_diff(scandir($directory), array('..', '.'));	
			$i=0;
			$allmusic = array();
			$musics=mysql_query("SELECT * FROM tbl_user_images WHERE status=1 AND user_id = '" . $_SESSION['po_userses']['flc_usrlogin_id'] . "' and music!='' ORDER BY cr_date DESC");
			while($msc=mysql_fetch_array($musics)){
				$allmusic[] = $msc['music'];
			}
			$musics2=mysql_query("SELECT * FROM tbl_music WHERE status=1 AND uid = '" . $_SESSION['po_userses']['flc_usrlogin_id'] . "' and title!='' ORDER BY cr_date DESC");
			while($msc2=mysql_fetch_array($musics2)){
				$allmusic[] = $msc2['title'];
			}
			$allmusic = array_unique($allmusic);
			
			foreach($allmusic as $val){
				$valArg = explode("/",$val);
				
				$filenameStr = str_replace('.', '', end($valArg));
				/* $filenameStr = preg_replace('/\\.[^.\\s]{3,4}$/', '', end($valArg)); */
				
				$i++;
				$getID3 = new getID3;

				$path = $_SESSION['APP_PATH'].'upload/music/'.$val;
				$path = $val;
				$mixinfo = $getID3->analyze($path);
			
				getid3_lib::CopyTagsToComments($mixinfo);

				/* print_r($mixinfo); */
				
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
                                        <?php echo $filenameStr; ?>
                                            <input type="hidden" class="mymusic" name="h_<?php echo $hname; ?>" id="<?php echo $filenameStr; ?>" value="<?php echo $time_seconds; ?>">
                                            <audio id="audio_<?php echo $hname; ?>">
                                                <source src="http://mentallica.com/projectone/upload/music/<?php echo $val; ?>" type="audio/mpeg"> </audio>
                                    </li>
                                    <?php
			}
			?>
                            </ul>
                        </div>
                        <?php 
	$prvDate = date('Y,m,d', strtotime(' -1 day'));
	$nextDate = date('Y,m,d', strtotime(' +5 day'));
	?>
                            <script type="text/javascript">
                                String.prototype.replaceAll = function (str1, str2, ignore) {
                                    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (ignore ? "gi" : "g")), (typeof (str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
                                }
                                var container = document.getElementById('visualization');
                                // Create a DataSet (allows two way data-binding)
                                var items = new vis.DataSet(<?php echo $timeargjson ?>);
                                /* var items = new vis.DataSet(<?php echo $test; ?>); */
                                /* var items = new vis.DataSet([
                                	{id: 4, content: 'item 4', start: '2018-04-07 14:00:00', end: '15:00:00'},
                                	]); */
                                // Configuration for the Timeline
                                var options = {
                                    stack: true
                                    , min: new Date('<?php echo $prvDate; ?>')
                                    , max: new Date('<?php echo $nextDate; ?>')
                                    , start: new Date()
                                    , end: new Date(1000 * 60 * 60 + (new Date()).valueOf())
                                    , editable: true
                                    , autoResize: true
                                    , orientation: 'top'
                                    , overrideItems: false
                                    , avoidOverlap: true
                                    , onAdd: function (item, callback) {
                                        var content = item.content;
                                        var urlArg = content.split("/");
                                        var last_element = urlArg[urlArg.length - 1];
                                        var filename = last_element.replaceAll('.', '');
                                        var songduration = content.replace(' ', '');
                                        var songduration = songduration.replace('.', '');
                                        var totalseconds = $("#" + filename).val();
                                        item.end = new Date(1000 * totalseconds + (item.start).valueOf());
                                        item.content = filename;
                                        callback(item);
                                    }
                                    , onMove: function (item, callback) {
                                        //console.log(item);
                                        callback(item);
                                    }
                                };
                                // Create a Timeline
                                var timeline = new vis.Timeline(container, items, options);

                                function handleDragStart(event) {
                                    dragSrcEl = event.target;
                                    event.dataTransfer.effectAllowed = 'move';
                                    var content1 = event.target.innerHTML.trim()
                                    var urlArg = content1.split("/");
                                    var last_element = urlArg[urlArg.length - 1];
                                    var item = {
                                        type: 'range'
                                        , content: last_element
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

                                function playsong(songid) {
                                    $('#audio_' + songid)[0].play();
                                    document.getElementById('a_' + songid).innerHTML = 'Pause';
                                    document.getElementById('a_' + songid).onclick = function () {
                                        pausesong(songid)
                                    };
                                }

                                function pausesong(songid) {
                                    $('#audio_' + songid)[0].pause();
                                    document.getElementById('a_' + songid).innerHTML = 'Play';
                                    document.getElementById('a_' + songid).onclick = function () {
                                        playsong(songid)
                                    };
                                }
                                jQuery('.savetimeline').on('click', function () {
                                    $(this).html('Saving...');
                                    var timelinedata = [];
                                    var timelineselection = timeline.itemsData._data;
                                    var myfilearg = [];
                                    jQuery('.mymusic').each(function () {
                                        var fileid = jQuery(this).attr('id');
                                        var fileidClean = fileid.replace('.', "");
                                        myfilearg.push(fileidClean);
                                    })
                                    $.ajax({
                                        url: '<?php echo $_SESSION['
                                        ADMIN_DOMAIN_NAME ']; ?>' + '/controllers/ajax_controller/save-radio.php'
                                        , type: 'post'
                                        , context: this
                                        , data: 'timeline=' + JSON.stringify(timelineselection) + '&myfiles=' + JSON.stringify(myfilearg)
                                        , success: function (resp) {
                                            $(this).html('Save');
                                            alert('Timeline save!!');
                                        }
                                        , error: function (resp) {
                                            alert('Action counld not complete at this moment!!!');
                                        }
                                    });
                                    /* timelineselection.forEach(function(element) {
				console.log(element);
			}); */
                                })
                            </script>
                    </div>
                </div>
                <!-- ./wrapper -->
                <?php include('footernew.php'); ?>
        </div>
    </div>
</body>