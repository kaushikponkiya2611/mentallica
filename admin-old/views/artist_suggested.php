<script type="text/javascript">
	$(function(){
		$("input").checkBox();
		$("#toggle-all").click(function(){
		$("#toggle-all").toggleClass("toggle-checked");
		$("#form_artist_suggestedview input[type=checkbox]").checkBox("toggle");
		return false;
		});
	});
	</script>
	<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/artist_suggestedscripts.js"></script>
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
				  <td colspan="2" >Upload Artist_suggested CSV</td>
				</tr>
			  </table></td>
		  </tr>
		  <tr>
			<td height="20" align="right" class="popup_listing_border"><a href="<?=$LOCATION['SITE_ADMIN']?>csv-examples/artist_suggested.csv">Example of CSV Format</a></td>
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
						<td width="130" align="right" class="popup_listing_border" valign="middle"><strong>Aid:</strong></td>
						<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
						<td width="459" align="left" class="popup_listing_border" valign="middle">
						<input type="text" class="input_box"  name="txt_srcaid" id="txt_srcaid" />	  
						</td>
					  </tr><tr class="light_bg">
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
		
		<form id="form_artist_suggestedview" action="" name="form_artist_suggestedview" method="post" enctype="multipart/form-data" >
		  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
			  <th class="table-header-repeat line-left minwidth-1">Category</th> 
			  <th class="table-header-repeat line-left minwidth-1">Suggested Artist</th> 
			</tr>
			<?php
	   $i = 0;
		if($controller_class -> getartist_suggested != ''){
			foreach($controller_class -> getartist_suggested  as $k => $data){
				$i++;
				$qryac = mysql_query("SELECT * FROM tbl_category where id=".$data['cid']);
				$result_cat = mysql_fetch_array($qryac);
				$qrya = mysql_query("SELECT * FROM tbl_users where id=".$data['aid']);
				$result_user = mysql_fetch_array($qrya);
	  ?>
			<tr id="<?php echo $data['id']?>" class="<?php if($i%2==0){ echo "light_bg"; }else{ echo "white_bg"; } ?>" height="30">
			 <td><?php echo $result_cat['categoryName']; ?></td>
			 <td><?php echo $result_user['first_name']." ".$result_user['last_name']."(".$result_user['username'].")"; ?></td>
			</tr>
			<?php } 
		 }else{ ?>
			<tr height="30">
			  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No artist_suggested found."; ?></strong></td>
			</tr>
			<?php } ?>
		  </table>
		  <?php 
		if($controller_class -> getartist_suggested != ''){
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