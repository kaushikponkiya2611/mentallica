<script type="text/javascript">
	$(function(){
		$("input").checkBox();
		$("#toggle-all").click(function(){
		$("#toggle-all").toggleClass("toggle-checked");
		$("#form_videoview input[type=checkbox]").checkBox("toggle");
		return false;
		});
	});
	</script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/videoscripts.js"></script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/date.js"></script>
	<style type="text/css">
	.showerror{display:block;}
	.removerror{display:none;}
	</style>
	<div style="display:none;">
	  <div id="inline_5" style="width:650px;min-height:200px;">
	  <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="635" height="35" class="popup_bg" ><table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
				  <td colspan="2" >Upload Video CSV</td>
				</tr>
			  </table></td>
		  </tr>
		  <tr>
			<td height="20" align="right" class="popup_listing_border"><a href="<?=$LOCATION['SITE_ADMIN']?>csv-examples/video.csv">Example of CSV Format</a></td>
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
	  <div id="inline_2" style="width:550px;min-height:250px;">
	  <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="535" height="35" class="popup_bg" ><table width="520" border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
				  <td colspan="2" >Search</td>
				</tr>
			  </table></td>
		  </tr>
		  <tr>
			<td height="20"></td>
		  </tr>
		  <tr>
			<td height="100" align="center" valign="top" style="padding-left:12px;">
				<form id="form_search" action="" name="form_search" method="post" enctype="multipart/form-data" >
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td height="5" align="center" class="popup_listing_border_search" colspan="3" id="searchmsg">
						 </td>                   
					  </tr><tr class="white_bg">
						<td width="130" align="right" class="popup_listing_border" valign="middle"><strong>Title:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="459" align="left" class="popup_listing_border" valign="middle">
						<input type="text" class="input_box"  name="txt_srctitle" id="txt_srctitle" />	  
						</td>
					  </tr><tr class="white_bg">
						<td align="right">&nbsp;</td>
						<td height="37" align="left">&nbsp;</td>
						<td align="left">
							<input type="hidden" name="fieldname" id="fieldname" value="0" />
							<input type="hidden" name="curr_page" id="curr_page" value="0" />
							<input type="hidden" name="prevnext" id="prevnext" value="0" />
							<input type="hidden" name="row" id="row" value="20" />
							<input type="hidden" name="viewdiv" id="viewdiv" value="1" />
							<input type="hidden" name="search" id="search" value="1" />
							<input class="button_bg" type="submit" value="Submit" name="btn_search" onclick="return searching()">
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
			if($controller_class -> getvideo != ''){
			?>
				<div id="actions-box"> <a href="" class="action-slider"></a>
				  <div id="actions-box-slider"> <a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a> <a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a> <a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a> </div>
				  <div class="clear"></div>
				</div>
				<?php } ?>
			  </td>
			  <td width="16%">&nbsp;</td>
			  <td width="64%">&nbsp;</td>
			  <td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
			</tr>
		  </table>
		</div>
		<form id="form_videoview" action="" name="form_videoview" method="post" enctype="multipart/form-data" >
		  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
			  <th class="table-header-check"><a id="toggle-all" ></a> </th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('title','asc')" id="title" class="cursorpointer">Title</a></th><th class="table-header-options line-left"><a>Options</a></th>
			</tr>
			<?php
	   $i = 0;
		if($controller_class -> getvideo != ''){
			foreach($controller_class -> getvideo  as $k => $data){
				$i++;
	  ?>
			<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
			  <td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id'];  ?>"/></td><td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_GET['pid']?>')"><?php echo $data['title']; ?></td><td class="options-width" ><table>
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
					<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['id'] ?>')"></a></td>
					<td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['id'] ?>','<?php echo $_GET['pid']?>')"></a></td>
					<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['id'] ?>')" ></a></td>
				  </tr>
				</table></td>
			</tr>
			<?php } 
		 }else{ ?>
			<tr height="30">
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No video found."; ?></strong></td>
			</tr>
			<?php } ?>
		  </table>
		  <?php 
		if($controller_class -> getvideo != ''){
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
	</div>