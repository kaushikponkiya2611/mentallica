<script type="text/javascript">
	$(function(){
			$('#fancybox-close').click(function() {
			location.reload();
			});
		$("input").checkBox();
		$("#toggle-all").click(function(){
		$("#toggle-all").toggleClass("toggle-checked");
		$("#form_radioview input[type=checkbox]").checkBox("toggle");
		return false;
		});
	});
	</script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/radioscripts.js"></script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/date.js"></script>
	 <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>Timeline/dragdrop_visjs/vis.js.download"></script>
	 
	<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>Timeline/dragdrop_visjs/vis.css" rel="stylesheet" type="text/css">  
	<style type="text/css">
	.showerror{display:block;}
	.removerror{display:none;}
	 li.item {
      list-style: none;
      width: 300px;
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
	<div style="display:none;">
	  <div id="inline_5" style="width:650px;min-height:200px;">
	  <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="635" height="35" class="popup_bg" ><table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
				  <td colspan="2" >Upload Radio CSV</td>
				</tr>
			  </table></td>
		  </tr>
		  <tr>
			<td height="20" align="right" class="popup_listing_border"><a href="<?=$LOCATION['SITE_ADMIN']?>csv-examples/radio.csv">Example of CSV Format</a></td>
		  </tr>
		  <tr>
			<td height="100" align="center" valign="top" style="padding-left:12px;">
				<form id="form_uploadcsv" action="" name="form_uploadcsv" method="post" enctype="multipart/form-data" >
				  <table width="600" border="0" cellspacing="0" cellpadding="0">
					 <tr height="45">
						<td width="150" align="right" class="popup_listing_border" valign="middle"><strong>Upload CSV:</strong>&nbsp;</td>
						<td width="250" align="left" class="popup_listing_border" valign="middle">
						 <input type="file" name="file_uploadcsv" id="file_uploadcsv"  />
						</td>
						<td class="popup_listing_border">
							<table>
								<tr>
									<td class="removerror" id="errorfile_uploadcsv">
									<div class="error-left"></div>
									<div class="error-inner" id="error-innerfile_uploadcsv"></div>
									</td>
								</tr>
							</table>
						</td>
					  </tr>				  
					  <tr>
						<td align="right" class="popup_listing_border">&nbsp;</td>
						<td align="left" class="popup_listing_border" colspan="2">
						<input type="hidden" name="hid_uploadcsv" id="hid_uploadcsv" value="upload" />
						 <input type="submit" value="" class="form-submit"  onclick="return uploadcsv()"/>
						</td>
					  </tr>
					</table>
				</form>
			</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>
		  </tr>
		</table>
	</div>
	</div>
	<a id="various_5" href="#inline_5"></a><div style="display:none;">
	  <div id="inline_2" style="width:550px;">
	  <link rel="stylesheet" type="text/css" href="css/dropzone.css" />
<script type="text/javascript" src="js/dropzone.js"></script>
<div class="image_upload_div">
	<form action="upload.php" class="dropzone">
    </form>
</div>
		<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
		<input type="hidden" name="search" id="search" value="1" />

	</div>
	</div>
	<a id="various_2" href="#inline_2"></a><div id="table-content">
	  <div id="message-red">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		  <tr>
			<td class="red-left" id="err"></td>
			<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
		  </tr>
		</table>
	  </div>
	  <div id="message-green">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		  <tr>
			<td class="green-left" id="succ"></td>
			<td class="green-right"><a class="close-green"> <img src="images/table/icon_close_green.gif" alt="" /></a> </td>
		  </tr>
		</table>
	  </div>
	  <div id="<?php echo $_GET['pid'] ?>" >
		<div class="searchdiv">
		  <table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="13%" align="left"><?php
			if($controller_class -> getradio != ''){
			?>
				<div id="actions-box"> <a href="" class="action-slider"></a>
				  <div id="actions-box-slider"> <a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a> <a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a> <a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a> </div>
				  <div class="clear"></div>
				</div>
				<?php } ?>
			  </td>
			  <td width="16%">&nbsp;</td>
			  <td width="64%">&nbsp;</td>
			  <td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Add File" name="btn_search" onclick="show_search()"></td>
			</tr>
		  </table>
		</div>
		<form id="form_radioview" action="" name="form_radioview" method="post" enctype="multipart/form-data" >
		  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
			  <th class="table-header-check"><a id="toggle-all" ></a> </th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('title','asc')" id="title" class="cursorpointer">Title</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('time','asc')" id="time" class="cursorpointer">Time</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('start_time','asc')" id="start_time" class="cursorpointer">Start Time</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('end_time','asc')" id="end_time" class="cursorpointer">End Time</a></th><th class="table-header-options line-left"><a>Options</a></th>
			</tr>
			<?php
	   $i = 0;
		if($controller_class -> getradio != ''){
			foreach($controller_class -> getradio  as $k => $data){
				$i++;
	  ?>
			<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
			  <td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id'];  ?>"/></td><td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_GET['pid']?>')"><?php echo $data['title']; ?></td><td><?php echo $data['time']; ?></td><td><?php echo $data['start_time']; ?></td><td><?php echo $data['end_time']; ?></td><td class="options-width" ><table>
				  <tr>
					<td><?php
							if($data['status'] == '1')
							{
							?>
						  <div id="d_<?=$data['id']?>"> <a id="s_<?=$data['id']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?=$data['id']?>');"></a> </div>
						  <input type="hidden" id="status_<?=$data['id']?>" name="status_<?=$data['id']?>" value="Active" />
						  <?php
							}
							else
							{
							?>
						  <div id="d_<?=$data['id']?>"> <a id="s_<?=$data['id']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?=$data['id']?>');"></a> </div>
						  <input type="hidden" id="status_<?=$data['id']?>" name="status_<?=$data['id']?>" value="Inactive" />
						  <?php
							}
							?>
					</td>
					<!--<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['id'] ?>')"></a></td>
					<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_GET['pid']?>')"></a></td>-->
					<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['id'] ?>')" ></a></td>
				  </tr>
				</table></td>
			</tr>
			<?php } 
		 }else{ ?>
			<tr height="30">
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No radio found."; ?></strong></td>
			</tr>
			<?php } ?>
		  </table>
		  <?php 
		if($controller_class -> getradio != ''){
			echo $model_class->paging_advancesearch($controller_class -> gettotalpageno,20,ceil($controller_class -> gettotalpageno/20));
	  ?>
		  <?php }else{ ?>
		  <input type="hidden" name="sel_noofrow" id="sel_noofrow" value="20" />
		  <?php }?>
		  <input type="hidden" name="hid_fieldname" id="hid_fieldname"    value=""  />
		  <input type="hidden" name="hidsearch" id="hidsearch" value="0" />
		  <input type="hidden" name="viewdiv" id="viewdiv" value="1" />
		</form>
	  </div>
	  
	  <div id="visualization"></div>
	  <button type="button" class="savetimeline">Save In timeline</button>
	
	<?php 
			$prvDate = date('Y,m,d', strtotime(' -1 day'));
			$nextDate = date('Y,m,d', strtotime(' +5 day'));
			
			$prvDate1 = date('Y-m-d', strtotime(' -2 day'));
			$qry ="SELECT * FROM radio_timeline WHERE start > '$prvDate1'";
			$gettimeline = mysql_query($qry);
			while($mscT=mysql_fetch_array($gettimeline)){
				$content = "/home10/mentalli/public_html/projectone/upload/images/".$mscT[2];
				$contentArg = explode('/',$content);
				 $timearg[] = array('id' => $mscT[0], 'content' => end($contentArg) , 'start' => $mscT[3], 'end' => $mscT[4]);
			}
			$timeargjson = json_encode($timearg);
		
	?>
	<script type="text/javascript">
		var container = document.getElementById('visualization');
		var items = new vis.DataSet(<?php echo $timeargjson ?>); 
		var options = {
			 min: new Date('<?php echo $prvDate; ?>'),            
			max: new Date('<?php echo $nextDate; ?>'),  
			stack: true,
			start: new Date(),
			end: new Date(1000*60*60 + (new Date()).valueOf()),
			editable: true,
            autoResize: true,
			orientation: 'top',
			onAdd: function (item, callback) {	
				var content = item.content;
				var urlArg = content.split("/");
				var last_element = urlArg[urlArg.length - 1];
				var filenameArg = last_element.split(".");
				var filename = filenameArg[0];
				var songduration = content.replace(' ', '');
				var songduration = songduration.replace('.', '');
				var totalseconds = $("#h_"+filename).val();
				item.end = new Date(1000*totalseconds + (item.start).valueOf());
				item.content = last_element;
				callback(item); 
			},
			onMove: function (item, callback) {
				callback(item); 
			}
		};


		  // Create a Timeline
		  var timeline = new vis.Timeline(container, items, options);
		  
		  
			function handleDragStart(event) {
			dragSrcEl = event.target;

			event.dataTransfer.effectAllowed = 'move';
			
			var item = {
                            type: 'range',
                            content: event.target.innerHTML.trim()
			};

			/*var isFixedTimes = (event.target.innerHTML.split('-')[2] && event.target.innerHTML.split('-')[2].trim() == 'fixed times')
			if (isFixedTimes) {
			  item.start = new Date();
			  item.end = new Date(1000*60*10 + (new Date()).valueOf());
			}*/
	console.log(timeline.itemsData._data);
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
		 
		  $('.savetimeline').click(function(){
			var timelinedata = [];
			var timelineselection  = timeline.itemsData._data;
			console.log(timelineselection);
			
			$.ajax( {
				url : '<?php echo $_SESSION['ADMIN_DOMAIN_NAME']; ?>'+'/controllers/ajax_controller/save-radio-admin.php', 
				type : 'post',
				data: 'timeline='+JSON.stringify(timelineselection),				
				success : function( resp ) {
					$('.savetimeline').after('<p class="s-noti">Timeline saved!!<p>');
					
					 setTimeout(function(){  window.location.reload();}, 2000);


				},
				error: function( resp ) {
					
					 $('.savetimeline').after('<p class="f-noti">Action counld not complete at this moment!!!<p>')
				}
			});
			 
			 /* timelineselection.forEach(function(element) {
				console.log(element);
			}); */

			  
		  })
			$( document ).ready(function() {
				console.log( "ready!" );
			});
		</script>
		<p>Final timeline</p>
		 <div id="visualization1"></div>
	
	
	<?php 
			$timearg = array();
			$gettimelineFinal = mysql_query("SELECT * FROM radio_timeline_final ORDER BY timelineid DESC LIMIT 1");
			while($mscTF=mysql_fetch_array($gettimelineFinal)){
				
				$data = json_decode($mscTF['timeline'], true);
				if(!empty($data)){
					foreach($data as $dataval){
						
						$timearg[] = array('id' => $dataval['id'], 'content' => $dataval['content'] , 'start' => $dataval['start'], 'end' => $dataval['end']);
					}
				}
				
				
			}
			$timeargjson = json_encode($timearg);
		
	?>
	<script type="text/javascript">
	
		var container1 = document.getElementById('visualization1');
		var items1 = new vis.DataSet(<?php echo $timeargjson ?>); 
		var options1 = {
			stack: true,
			start: new Date(),
			end: new Date(1000*60*60 + (new Date()).valueOf()),
			editable: true,
            autoResize: true,
			orientation: 'top',
			onAdd: function (item, callback) {	
				var content = item.content;
				var urlArg = content.split("/");
				var last_element = urlArg[urlArg.length - 1];
				var filenameArg = last_element.split(".");
				var filename = filenameArg[0];
				var songduration = content.replace(' ', '');
				var songduration = songduration.replace('.', '');
				var totalseconds = $("#h_"+filename).val();
				item.end = new Date(1000*totalseconds + (item.start).valueOf());
				item.content = last_element;
				callback(item); 
			},
			onMove: function (item, callback) {
				callback(item); 
			}
		};
		var timeline1 = new vis.Timeline(container1, items1, options1);
		
		</script>

</div>