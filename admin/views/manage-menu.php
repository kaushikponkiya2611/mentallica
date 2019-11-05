<script type="text/javascript">

$(function(){

	$('input').checkBox();

	$('#toggle-all').click(function(){

	$('#toggle-all').toggleClass('toggle-checked');

	$('#form_userview input[type=checkbox]').checkBox('toggle');

	return false;

	});

});

</script> 

<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/managemenuscripts.js"></script>

<script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>views/javascripts/js/jquery.form.js"></script>

<!-- /TinyMCE -->

<style type="text/css">

.showerror{

	display:block;

}

.removerror{

	display:none;

}

</style>



<div style="display:none;">

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

                  </tr>			

				  <tr class="light_bg">

					<td width="130" align="right" class="popup_listing_border" valign="middle"><strong>User Id:</strong></td>

					<td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td width="459" align="left" class="popup_listing_border" valign="middle">

					<input type="text" class="input_box"  name="txt_uniqId" id="txt_uniqId"  />	  

					</td>

				  </tr>

				  <tr class="white_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>First Name:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					<input type="text" class="input_box"  name="txt_srchfname" id="txt_srchfname"  />

					</td>

				  </tr>

				  <tr class="light_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>Last Name:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					 <input type="text" class="input_box"  name="txt_srchlname" id="txt_srchlname"  />

					</td>

				  </tr>

				  <tr class="white_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>Email Id:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					 <input type="text" class="input_box"  name="txt_srchemailid" id="txt_srchemailid"  />

					</td>

				  </tr>

				  <tr class="light_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>Country:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					 <input type="text" class="input_box"  name="txt_usercountry" id="txt_usercountry"  />

					</td>

				  </tr>

				  <tr class="white_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>State:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					 <input type="text" class="input_box"  name="txt_userstate" id="txt_userstate"  />

					</td>

				  </tr>

				  <tr class="light_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>City:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					 <input type="text" class="input_box"  name="txt_usercity" id="txt_usercity"  />

					</td>

				  </tr>

				  <tr class="white_bg">

					<td align="right" class="popup_listing_border" valign="middle"><strong>Phone Number 1:</strong></td>

					<td height="37" align="left" class="popup_listing_border">&nbsp;</td>

					<td align="left" class="popup_listing_border" valign="middle">

					 <input type="text" class="input_box"  name="txt_mobilenum" id="txt_mobilenum"  />

					</td>

				  </tr>

				  <tr class="light_bg">

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

<a id="various_2" href="#inline_2"></a>



<div style="display:none;">

  <div id="inline_1" style="width:750px;min-height:50px;">

  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="735" height="35" class="popup_bg" ><table width="720" border="0" cellspacing="0" cellpadding="0" align="left">

            <tr>

              <td colspan="2" ><div id="common" ></div></td>

            </tr>

          </table></td>

      </tr>

      <tr>

        <td height="20"></td>

      </tr>

      <tr>

        <td height="100" align="center" valign="top" style="padding-left:12px;"><div id="view_detail" ></div></td>

      </tr>
 
      <tr>

        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>

      </tr>

    </table>

</div>

</div>

<a id="various_1" href="#inline_1"></a>



<div style="display:none;">

  <div id="inline_6" style="width:750px;min-height:50px;">

  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="735" height="35" class="popup_bg" ><table width="720" border="0" cellspacing="0" cellpadding="0" align="left">

            <tr>

              <td colspan="2" ><div id="common6" ></div></td>

            </tr>

          </table></td>

      </tr>

      <tr>

        <td height="20"></td>

      </tr>

      <tr>

        <td height="100" align="center" valign="top" style="padding-left:12px;"><div id="view_detail6" ></div></td>

      </tr>

      <tr>

        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>

      </tr>

    </table>

</div>

</div>

<a id="various_6" href="#inline_6"></a>



<div style="display:none;">

  <div id="inline_7" style="width:750px;min-height:50px;">

  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="735" height="35" class="popup_bg" ><table width="720" border="0" cellspacing="0" cellpadding="0" align="left">

            <tr>

              <td colspan="2" ><div id="common7" ></div></td>

            </tr>

          </table></td>

      </tr>

      <tr>

        <td height="20"></td>

      </tr>

      <tr>

        <td height="100" align="center" valign="top" style="padding-left:12px;"><div id="view_detail7" ></div></td>

      </tr>

      <tr>

        <td align="left" valign="top" style="padding-left:12px;">&nbsp;</td>

      </tr>

    </table>

</div>

</div>

<a id="various_7" href="#inline_7"></a>



<div style="display:none;">

  <div id="inline_3" style="width:400px;height:120px;">

  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="385" height="35" class="popup_bg" ><table width="370" border="0" cellspacing="0" cellpadding="0" align="left">

            <tr>

              <td colspan="2" >Change Status</td>

            </tr>

          </table></td>

      </tr>

      <tr>

        <td height="10"></td>

      </tr>

      <tr>

        <td height="40" align="center" valign="middle" style="padding-left:12px;"><div id="status_line" style="font-size:12px;font-weight:bold;" ></div></td>

      </tr>

      <tr>

        <td height="20" align="center" valign="bottom">

		<!--<a style="cursor:pointer;font-weight:bold;text-decoration:none;" onclick="status_ok()"><img src="images/popup_ok.png" /></a>&nbsp;&nbsp;<a style="cursor:pointer;font-weight:bold;text-decoration:none;" onclick="status_cancel()"><img src="images/popup_cancel.png" /></a>-->

		<input class="button_bg" type="button" value="Ok" name="btn_ok" onclick="status_ok()">

		<input class="button_bg" type="button" value="Cancel" name="btn_ok" onclick="status_cancel()">

		</td>

      </tr>

      <tr>

        <td align="left" valign="top" style="padding-left:12px;"><input type="hidden" id="h_status" name="h_status" /><input type="hidden" id="h_statustype" name="h_statustype" /></td>

      </tr>

    </table>

</div>

</div>

<a id="various_3" href="#inline_3"></a>



<div style="display:none;">

  <div id="inline_4" style="width:400px;height:120px;">

  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="385" height="35" class="popup_bg" ><table width="370" border="0" cellspacing="0" cellpadding="0" align="left">

            <tr>

              <td colspan="2" >Delete Section</td>

            </tr>

          </table></td>

      </tr>

      <tr>

        <td height="10"></td>

      </tr>

      <tr>

        <td height="40" align="center" valign="middle" style="padding-left:12px;"><div id="delete_line" style="font-size:12px;font-weight:bold;" ></div></td>

      </tr>

      <tr>

        <td height="20" align="center" valign="bottom">

		<!--<a style="cursor:pointer;font-weight:bold;text-decoration:none;" onclick="delete_ok()"><img src="images/popup_ok.png" /></a>&nbsp;&nbsp;<a style="cursor:pointer;font-weight:bold;text-decoration:none;" onclick="status_cancel()"><img src="images/popup_cancel.png" /></a>-->

		<input class="button_bg" type="button" value="Yes" name="btn_yes" onclick="delete_ok()">

		<input class="button_bg" type="button" value="No" name="btn_no" onclick="status_cancel()">

		</td>

      </tr>

      <tr>

        <td align="left" valign="top" style="padding-left:12px;"><input type="hidden" id="h_delete" name="h_delete" /></td>

      </tr>

    </table>

</div>

</div>

<a id="various_4" href="#inline_4"></a>

<div id="table-content">

  <!--  start message-red -->

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

          <td width="15%" align="left"><?php

		if($controller_class -> getmenu != ''){

		?>

            <div id="actions-box"> <a href="" class="action-slider"></a>

              <div id="actions-box-slider"> <a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a> <a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a> <a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a> </div>

              <div class="clear"></div>

            </div>

            <?php } ?>

          </td>

          <td width="14%"><?php /*?><input class="button_bg" type="button" value="Add New" name="button" onclick="showadd1('<?php echo $_REQUEST['pid'] ?>')"><?php */?>

          </td>

          <td width="64%">&nbsp;</td>

          <td width="7%" align="left" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>

        </tr>

      </table>

    </div>

    <form id="form_menuview" action="" name="form_menuview" method="post" enctype="multipart/form-data" >

      <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">

        <tr>

          <th class="table-header-check"><a id="toggle-all" ></a> </th>

          <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('Name')" class="cursorpointer">Section</a></th>

		  <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('Order_no')" class="cursorpointer">Order</a></th>

          <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('Name')" class="cursorpointer">Sub Section</a></th>

          <th class="table-header-options line-left"><a>Options</a></th>

        </tr>

        <?php

   $i = 0;

	if($controller_class -> getmenu != ''){

		foreach($controller_class -> getmenu as $k => $data){

		$submenu=$controller_class -> getsubmenu($data['Section_Id']);

			$i++;

			if($i%2==0){

				$class="light_bg";

			}else{

				$class="white_bg";

			}

  ?>

        <tr id="<?php echo $data['Section_Id']?>" class="<?=$class?>" height="30">

          <td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['Section_Id'];  ?>"/></td>

          <td class="cursorpointer" onclick="edit('<?php echo $data['Section_Id'] ?>','<?php echo $_GET['pid']?>')"><?php echo $data['Name']; ?></td>

          <td><?php echo $data['Order_no']; ?></td>

		  <td><?php 

		  foreach($submenu as $k => $data){

		  	//echo $data['Title']." => ".$data['Order_no']."<br />";

			?>

			<div style="width:100%">

				<div style="float:left;width:60%;text-align:right"><?=$data['Title']?> --> </div>

				<div style="float:left;width:40%"><?=$data['Order_no']?></div>

			</div>

			<?php

		  }

		   ?></td>

          <td class="options-width" ><table>

              <tr>

                <td><?php

						if($data['status'] == '1')

						{

						?>

					  <div id="d_<?=$data['Id']?>"> <a id="s_<?=$data['Section_Id']?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?=$data['Section_Id']?>');"></a> </div>

					  <input type="hidden" id="status_<?=$data['Section_Id']?>" name="status_<?=$data['Section_Id']?>" value="Active" />

					  <?php

						}

						else

						{

						?>

					  <div id="d_<?=$data['Section_Id']?>"> <a id="s_<?=$data['Section_Id']?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?=$data['Section_Id']?>');"></a> </div>

					  <input type="hidden" id="status_<?=$data['Section_Id']?>" name="status_<?=$data['Section_Id']?>" value="Inactive" />

					  <?php

						}

						?>

                </td>

                <td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['Section_Id'] ?>')"></a></td>

                <?php /*?><td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['Section_Id'] ?>','<?php echo $_GET['pid']?>')"></a></td><?php */?>

                <td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['Section_Id'] ?>')" ></a></td>

              </tr>

            </table></td>

        </tr>

        <?php } 

	 }else{ ?>

        <tr height="30">

          <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No menu found."; ?></strong></td>

        </tr>

        <?php } ?>

      </table>

      <?php 

	if($controller_class -> getmenu != ''){

		$totalrecords = $controller_class -> gettotalpageno;

		$noofrows_k = 20;

		$noofpages = ceil($totalrecords/$noofrows_k);

		$paging = $model_class->paging_advancesearch($totalrecords,$noofrows_k,$noofpages);

		echo $paging;

		//echo $_GET['pid'];

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

