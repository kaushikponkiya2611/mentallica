<?php
@session_start();
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
$modelObj = new AjaxModel();
$upload_dir = $_SERVER['SITE_IMG_PATH'] . "upload/image/";
$upload_dirthumb = $_SERVER['SITE_IMG_PATH'] . "upload/image/thumb/";

if (isset($_POST['view']) && $_POST['view'] != '') {
    $id = $_POST['id'];
    $qry = "SELECT * FROM tbl_category where id = '" . mysql_real_escape_string($id) . "'";
    $result = $modelObj->fetchRow($qry);
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
        <tr class="white_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>CategoryName:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['categoryName']) ?></td>
            
            
        </tr>
        <tr class="white_bg">
        <td width="120" align="right" class="popup_listing_border"><strong>Artist:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php 
            $arr=explode(",", $result['artist_ids']);
            $i=1;
            foreach ($arr as $kk=>$artist){
                $qry_art = "SELECT * FROM tbl_users WHERE id='".$artist."'";
                $result_art = $modelObj->fetchRow($qry_art);
                $comma=" ";
                if($kk!=0){
                    $comma=", ";
                }
                echo  $comma.$i.". ".$result_art['username']; 
                $i++;
            }
            ?></td>
        </tr>
    </table>
    <?php
}
?>			
<?php
if (isset($_POST['statusactive']) && $_POST['statusactive'] != '') {
    $id = explode(",", $_POST['active']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_category SET status = 1 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['statusinactive']) && $_POST['statusinactive'] != '') {
    $id = explode(",", $_POST['inactive']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_category SET status = 0 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['deleselected']) && $_POST['deleselected'] != '') {
    $id = explode(",", $_POST['delete']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_category SET status = 2 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['hid_add']) && $_POST['hid_add'] != '') {
    $qry = "SELECT * FROM tbl_category WHERE categoryName = '" . mysql_real_escape_string(trim($_POST['txt_addcategoryName'])) . "' and status!=2 ";
    $result = $modelObj->fetchRow($qry);

    if (strtolower(trim($result['categoryName'])) == strtolower(trim($_POST['txt_addcategoryName']))) {
        $flag = 0;
    } else {
        $flag = 1;
    }

    if ($flag == 1) {
        if (!dir($upload_dir)) {
            mkdir($upload_dir);
        }
        if (!dir($upload_dirthumb)) {
            mkdir($upload_dirthumb);
        }$qry = "INSERT INTO tbl_category (categoryName,cr_date,status) VALUES ('" . clear_input($_POST['txt_addcategoryName']) . "',NOW(),1)";
        $result = $modelObj->runQuery($qry);
        echo "1";
    } else {
        echo "0";
    }
}
?>
<?php
if (isset($_POST['statusid']) && $_POST['statusid'] != '') {
    $qry = "UPDATE  tbl_category SET status = " . mysql_real_escape_string($_POST['status']) . " WHERE id = " . mysql_real_escape_string($_POST['statusid']);
    $result = $modelObj->runQuery($qry);
}
?>
<?php
if (isset($_POST['hid_update']) && $_POST['hid_update'] != '') {
    
    $flag = 1;

    if ($flag == 1) {
        
        $qry = "UPDATE tbl_category SET artist_ids = '" . implode(",", $_POST['check_list']) . "'WHERE id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
        $result = $modelObj->runQuery($qry);
        echo "1";
    } else {
        echo "0";
    }
}
?>
<?php
if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];
    $orderby = $_POST['orderby'];

    if ($_POST['search'] != '0') {
        if (trim($_POST['txt_srccategoryName']) != '') {
            $searchqry .="and categoryName LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srccategoryName'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }$_SESSION['srchqry'] = $_SESSION['srchqry'];

        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_category where status!=2 " . $_SESSION['srchqry'] . " order by cr_date desc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_category where status!=2 " . $_SESSION['srchqry'] . " ORDER BY " . $_POST['fieldname'] . " " . $orderby . " LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_category where status!=2 " . $_SESSION['srchqry'] . "")or die(mysql_error());
    } else {
        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_category where status!=2 order by cr_date desc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_category where status!=2 ORDER BY " . $_POST['fieldname'] . " " . $orderby . " LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_category where status!=2 ")or die(mysql_error());
    }
    $result = $modelObj->fetchRows($qry);
    $totalrecords = mysql_num_rows($qry11);
    $noofrows_k = $end;
    $noofpages = ceil($totalrecords / $noofrows_k);
    if ($_POST['first'] != 0) {
        $curr_page = ceil($start / $noofrows_k);
    } else if ($_POST['last'] != 0) {
        $curr_page = 0;
    } else {
        $curr_page = $_POST['curr_page'];
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".showhide-account").click(function () {
                $(".account-content").slideToggle("fast");
                $(this).toggleClass("active");
                return false;
            });
        });

        $(document).ready(function () {
            $(".action-slider").click(function () {
                $("#actions-box-slider").slideToggle("fast");
                $(this).toggleClass("activated");
                return false;
            });
        });
        $(function () {
            $('input').checkBox();
            $('#toggle-all').click(function () {
                $('#toggle-all').toggleClass('toggle-checked');
                $('#form_category_artistview input[type=checkbox]').checkBox('toggle');
                return false;
            });
        });
    </script> 
    <form id="form_category_artistview" action="" name="form_category_artistview" method="post" enctype="multipart/form-data" onsubmit="return false">
        <div class="searchdiv">
            <table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="13%" align="left">
                        <?php
                        /*if ($result != '') {
                            ?>
                            <div id="actions-box">
                                <a href="" class="action-slider"></a>
                                <div id="actions-box-slider">
                                    <a style="cursor:pointer" class="action-delete" onclick="deleteselected()" id="testCheck">Delete</a>
                                    <a style="cursor:pointer" class="action-delete" onclick="statusactive()" id="testCheck">Active</a>
                                    <a style="cursor:pointer" class="action-delete" onclick="statusinactive()" id="testCheck">Inactive</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } */?>
                    </td>
                    <td width="16%">&nbsp;</td>
                    <td width="64%">&nbsp;</td>
                    <td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
                </tr>
            </table>
        </div>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
            <tr>
                <th class="table-header-check"><a id="toggle-all" ></a> </th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('categoryName', '<?php
                    if ($orderby == 'asc') {
                        echo "desc";
                    } else {
                        echo "asc";
                    }
                    ?>')" id="categoryName" class="cursorpointer">CategoryName</a></th><th class="table-header-options line-left"><a>Options</a></th>
            </tr>
            <?php
            $i = 0;
            if ($result != '') {
                foreach ($result as $k => $data) {
                    $i++;
                    ?>
                    <tr id="<?php echo $data['id'] ?>" class="<?php
                    if ($i % 2 == 0) {
                        echo "light_bg";
                    } else {
                        echo "white_bg";
                    }
                    ?>" height="30">
                        <td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id']; ?>"/></td><td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>', '<?php echo $_SESSION['pid'] ?>')"><?php echo stripslashes($data['categoryName']); ?></td><td class="options-width" >
                            <table>
                                <tr>
                                    <!--<td>
                                        <?php
                                        if ($data['status'] == '1') {
                                            ?>
                                            <div id="d_<?= $data['id'] ?>">
                                                <a id="s_<?= $data['id'] ?>" style="cursor:pointer;" title="Active" class="icon-active info-tooltip" onclick="changeStatus('<?= $data['id'] ?>');"></a>
                                            </div>
                                            <input type="hidden" id="status_<?= $data['id'] ?>" name="status_<?= $data['id'] ?>" value="Active" />						
                                            <?php
                                        } else {
                                            ?>
                                            <div id="d_<?= $data['id'] ?>">
                                                <a id="s_<?= $data['id'] ?>" style="cursor:pointer;" title="Inactive" class="icon-inactive info-tooltip" onclick="changeStatus('<?= $data['id'] ?>');"></a>
                                            </div>
                                            <input type="hidden" id="status_<?= $data['id'] ?>" name="status_<?= $data['id'] ?>" value="Inactive" />						
                                            <?php
                                        }
                                        ?>
                                    </td>-->
                                    <!--<td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['id'] ?>')"></a></td>-->
                                    <td><a style="cursor:pointer" title="Assign Artist" onclick="edit('<?php echo $data['id'] ?>', 'category_artist')">Assign Artist</a></td>
                                    <!--<td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['id'] ?>')" ></a></td>-->
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr height="30">
                    <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No category_artist found."; ?></strong></td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
        if ($result != '') {
            echo $modelObj->ajaxpaging_advancesearch($start, $result_numrec, $curr_page, $noofpages, $noofrows_k, $end);
            ?>
        <?php } else { ?>
            <input type="hidden" name="sel_noofrow" id="sel_noofrow" value="5" />
        <?php } ?>
        <input type="hidden" name="hid_fieldname" id="hid_fieldname"    value="<?= $_POST['fieldname'] ?>"  />
        <input type="hidden" name="hidsearch" id="hidsearch" 
               value="<?php
               if ($_POST['search'] != '0')
                   echo '1';
               else
                   echo '0'
                   ?>" />
        <input type="hidden" name="viewdiv" id="viewdiv" value="1" />
    </form>
<?php }
?>
<?php
if (isset($_POST['delete']) && $_POST['delete'] != '') {
    $qry = "UPDATE tbl_category SET status = 2 WHERE id = '" . $_POST['id'] . "'";
    $result = $modelObj->runQuery($qry);
    if ($result) {
        echo $successmsg = '1';
    } else {
        echo $errmsg = '0';
    }
}
?>

<?php
if (isset($_POST['edit']) && $_POST['edit'] != '') {
    $qry = "SELECT * FROM tbl_category WHERE id = '" . $_POST['id'] . "'";
    $data = $modelObj->fetchRow($qry);
    $arr=explode(",", $data['artist_ids']);
    
    $qry_art = "SELECT * FROM tbl_users WHERE status=1 and FIND_IN_SET('{$_POST['id']}',preview_category) and usertype=1 order by username asc";
    $result_art = $modelObj->fetchRows($qry_art);
    $q =  mysql_query($qry_art);
    $artCNT = mysql_num_rows($q);
    ?>
    <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.form.js"></script><form name="form_category_artistadd" id="form_category_artistadd" method="post" enctype="multipart/form-data" action="#" >
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
            <tr class="white_bg">
                <th>Category Name : </th>
                <td width="23%">
                    <input class="input_box" type="text" readonly="" name="txt_addcategoryName" id="txt_addcategoryName" value="<?php echo stripslashes($data['categoryName']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
                </td>
                <td id="errortxt_addcategoryName" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addcategoryName"></label>
                </td>
            </tr>
            <tr class="white_bg">
                <th>Select Artist : </th>
                    <br/>
                    <td colspan="2"><table width="100%">
                            <tr>
                    <?php 
                    if($artCNT>0){
                        $i=0;
                       foreach ($result_art as $kk=>$artist){
                            $i++;
                            ?><td width="25%">
                                <div style="width:100%">
                                <div style="width:10%; float: left; margin-top: 20px;"><input type="checkbox" name="check_list[]" alt="<?=$artist['username']; ?>" value="<?=$artist['id']; ?>" <?php if(in_array($artist['id'], $arr)){ echo "checked='checked'"; } ?>> </div>
                                <div style="width:20%; float: left;margin-top: 5px;">
                                    <?php 
                                    $qrydd = "SELECT * FROM tbl_userpreview_data_category WHERE user_id = '" . $artist['id'] . "' AND category_id = '" . $_POST['id'] . "'";
                                    $datadd = $modelObj->fetchRow($qrydd);
                                    if($datadd['profile_pic']!=""){
                                       ?><img src="<?=$_SESSION['SITE_NAME']?>upload/art/<?php echo stripslashes($datadd['profile_pic']) ?>" height="50" width="50" /> <?php
                                    }else if($artist['image']!="" && $datadd['profile_pic']==""){
                                    ?>
                                        <img src="<?=$_SESSION['SITE_NAME']?>upload/artist/thumb/<?php echo stripslashes($artist['image']) ?>" height="50" width="50" />
                                    <?php } else { ?>
                                        <img src="<?=$_SESSION['SITE_NAME']?>upload/art/default.jpg" height="50" width="50" />
                                    <?php } ?>
                                </div>
                                <div style="width:65%; float: left; margin-top: 20px; margin-left: 5px"><?=$artist['username']; ?></div>
                                </div>
                              </td>
                            <?php
                            if($i == 4) {
                              $i=0;
                              echo '</tr><tr>';
                            }
                           
                        } 
                    }else{
                       echo '<td>Artist not found.</td>'; 
                    }
                 
                    ?>
                
                </tr></table></td>
            </tr>
            <tr class="light_bg">
                <th>&nbsp;</th>
                <td valign="top">
                    <?php
                    if ($_POST['id'] != 0) {
                        ?>
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['id'] ?>" />
                        <input type="hidden" name="hid_update" id="hid_update" value="update" />
                        <input class="button_bg" type="submit" value="Submit" name="btn_update" onclick="return updatedata()">
                        <input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
                        <?php
                    } else {
                        ?>
                        <input type="hidden" name="hid_add" id="hid_add" value="add" />
                        <input class="button_bg" type="submit" value="Submit" name="btn_save" onclick="return adddata()">
                        <input class="button_bg" type="button" value="Cancel" name="btn_cancel" onclick="newdata()">
                        <?php
                    }
                    ?>
                </td>
                <td></td>
            </tr>
        </table>
    </form>
    <?php
}
?>
<?php
if (isset($_POST['getstateid'])) {
    $qry_s = "SELECT * FROM tbl_state WHERE status =1 and countryId='" . $_POST['getstateid'] . "' order by stateName asc";
    $result_s = $modelObj->fetchRows($qry_s);
    ?>
    <select class="select_box"  name="" id="" onblur="checkfield(this)" onchange="getCities()">
        <option value="">Select State</option>
        <?php
        if ($result_s != '') {
            foreach ($result_s as $k => $data1) {
                echo "<option value=" . $data1['id'] . ">" . ucwords(stripslashes($data1['stateName'])) . "</option>";
            }
        }
        ?>
    </select><font class="required"> *</font>
    <?php
}
?>
<?php
if (isset($_POST['getcityid'])) {
    $qry_s = "SELECT * FROM tbl_city WHERE status =1 and stateId='" . $_POST['getcityid'] . "' order by cityName asc";
    $result_s = $modelObj->fetchRows($qry_s);
    ?>
    <select class="select_box"  name="" id="" onblur="checkfield(this)" onchange="getZipCode()">
        <option value="">Select City</option>
        <?php
        if ($result_s != '') {
            foreach ($result_s as $k => $data1) {
                echo "<option value=" . $data1['id'] . ">" . ucwords(stripslashes($data1['cityName'])) . "</option>";
            }
        }
        ?>
    </select><font class="required"> *</font>
    <?php
}
?>
<?php
if (isset($_POST['getzcodeid'])) {
    $qry_s = "SELECT * FROM tbl_zipcode WHERE status =1 and cityId='" . $_POST['getzcodeid'] . "' order by zipCode asc";
    $result_s = $modelObj->fetchRows($qry_s);
    ?>
    <select class="select_box"  name="" id="" onblur="checkfield(this)">
        <option value="">Select Zipcode</option>
        <?php
        if ($result_s != '') {
            foreach ($result_s as $k => $data1) {
                echo "<option value=" . $data1['id'] . ">" . ucwords(stripslashes($data1['zipCode'])) . "</option>";
            }
        }
        ?>
    </select><font class="required"> *</font>
    <?php
}
?>