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
    $qry = "SELECT * FROM tbl_plans where id = '" . mysql_real_escape_string($id) . "'";
    $result = $modelObj->fetchRow($qry);
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px"><tr class="white_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Plan Name:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['plan_name']) ?></td>
        </tr><tr class="light_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Plan Price:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['plan_price']) ?></td>
        </tr><tr class="white_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Coins Limit:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border">
                <?php
                if($result['image_limit']==0){
                    echo "Unlimited";
                }else{
                    echo stripslashes($result['image_limit']);
                }                
                ?></td>
        </tr><tr class="light_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Month:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['month']) ?></td>
        </tr><tr class="white_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Category:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['category']) ?></td>
        </tr></table>
    <?php
}
?>			
<?php
if (isset($_POST['statusactive']) && $_POST['statusactive'] != '') {
    $id = explode(",", $_POST['active']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_plans SET status = 1 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['statusinactive']) && $_POST['statusinactive'] != '') {
    $id = explode(",", $_POST['inactive']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_plans SET status = 0 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['deleselected']) && $_POST['deleselected'] != '') {
    $id = explode(",", $_POST['delete']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_plans SET status = 2 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['hid_add']) && $_POST['hid_add'] != '') {
    $qry = "SELECT * FROM tbl_plans WHERE plan_name = '" . mysql_real_escape_string(trim($_POST['txt_addplan_name'])) . "' and status!=2 ";
    $result = $modelObj->fetchRow($qry);

    if (strtolower(trim($result['plan_name'])) == strtolower(trim($_POST['txt_addplan_name']))) {
        $flag = 0;
    } else {
        $flag = 1;
    }

    if ($flag == 1) {
        if($_POST['txt_addimage_limit']=="$"){
            $imagelimit = "0";
        }else{
            $imagelimit = $_POST['txt_addimage_limit'];
        }
        $qry = "INSERT INTO tbl_plans (plan_name,plan_price,image_limit,month,category,cr_date,status) VALUES ('" . clear_input($_POST['txt_addplan_name']) . "','" . clear_input($_POST['txt_addplan_price']) . "','" . clear_input($imagelimit) . "','" . clear_input($_POST['txt_addmonth']) . "','" . clear_input($_POST['txt_addcategory']) . "',NOW(),1)";
        $result = $modelObj->runQuery($qry);
        echo "1";
    } else {
        echo "0";
    }
}
?>
<?php
if (isset($_POST['statusid']) && $_POST['statusid'] != '') {
    $qry = "UPDATE  tbl_plans SET status = " . mysql_real_escape_string($_POST['status']) . " WHERE id = " . mysql_real_escape_string($_POST['statusid']);
    $result = $modelObj->runQuery($qry);
}
?>
<?php
if (isset($_POST['hid_update']) && $_POST['hid_update'] != '') {
    $qry = "SELECT * FROM tbl_plans WHERE plan_name = '" . mysql_real_escape_string(trim($_POST['txt_addplan_name'])) . "' and status!=2 and id != '" . $_POST['hid_userid'] . "'";
    $result = $modelObj->fetchRow($qry);

    if (strtolower(trim($result['plan_name'])) == strtolower(trim($_POST['txt_addplan_name']))) {
        echo $errmsg = "0";
        $flag = 0;
    } else {
        $flag = 1;
    }
    $flag = 1;

    if ($flag == 1) {
        if($_POST['txt_addimage_limit']=="$"){
            $imagelimit = "0";
        }else{
            $imagelimit = $_POST['txt_addimage_limit'];
        }
        $qry = "UPDATE tbl_plans SET plan_name = '" . clear_input($_POST['txt_addplan_name']) . "',plan_price = '" . clear_input($_POST['txt_addplan_price']) . "',image_limit = '" . clear_input($imagelimit) . "',month = '" . clear_input($_POST['txt_addmonth']) . "',category = '" . clear_input(implode(",", $_POST['txt_addcategory'])) . "'WHERE id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
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
        if (trim($_POST['txt_srcplan_name']) != '') {
            $searchqry .= "and plan_name LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srcplan_name'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }if (trim($_POST['txt_srcplan_price']) != '') {
            $searchqry .= "and plan_price LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srcplan_price'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }if (trim($_POST['txt_srcmonth']) != '') {
            $searchqry .= "and month LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srcmonth'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }if (trim($_POST['txt_srccategory']) != '') {
            $searchqry .= "and category LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srccategory'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }$_SESSION['srchqry'] = $_SESSION['srchqry'];

        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_plans where status!=2 " . $_SESSION['srchqry'] . " order by cr_date desc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_plans where status!=2 " . $_SESSION['srchqry'] . " ORDER BY " . $_POST['fieldname'] . " " . $orderby . " LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_plans where status!=2 " . $_SESSION['srchqry'] . "")or die(mysql_error());
    } else {
        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_plans where status!=2 order by cr_date desc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_plans where status!=2 ORDER BY " . $_POST['fieldname'] . " " . $orderby . " LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_plans where status!=2 ")or die(mysql_error());
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
                $('#form_plansview input[type=checkbox]').checkBox('toggle');
                return false;
            });
        });
    </script> 
    <form id="form_plansview" action="" name="form_plansview" method="post" enctype="multipart/form-data" onsubmit="return false">
        <div class="searchdiv">
            <table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="13%" align="left">
                        <?php /* if($result != ''){
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
                          <?php } */ ?>
                    </td>
                    <td width="16%">&nbsp;</td>
                    <td width="64%">&nbsp;</td>
                    <td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
                </tr>
            </table>
        </div>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
            <tr>
                <th class="table-header-check"><a id="toggle-all" ></a> </th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('plan_name', '<?php
                    if ($orderby == 'asc') {
                        echo "desc";
                    } else {
                        echo "asc";
                    }
                    ?>')" id="plan_name" class="cursorpointer">Plan Name</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('plan_price', '<?php
                if ($orderby == 'asc') {
                    echo "desc";
                } else {
                    echo "asc";
                }
                ?>')" id="plan_price" class="cursorpointer">Plan Price</a></th><th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('month', '<?php
                if ($orderby == 'asc') {
                    echo "desc";
                } else {
                    echo "asc";
                }
                ?>')" id="month" class="cursorpointer">Month</a></th>
                <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('category', '<?php
                if ($orderby == 'asc') {
                    echo "desc";
                } else {
                    echo "asc";
                }
                ?>')" id="category" class="cursorpointer">Category</a></th>
                <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('image_limit', '<?php
                if ($orderby == 'asc') {
                    echo "desc";
                } else {
                    echo "asc";
                }
                ?>')" id="image_limit" class="cursorpointer">Coins Limit</a></th>
                <th class="table-header-options line-left"><a>Options</a></th>
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
                        <td><input  type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['id']; ?>"/></td>
                        <td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>', '<?php echo $_SESSION['pid'] ?>')"><?php echo stripslashes($data['plan_name']); ?></td>
                        <td><?php echo stripslashes($data['plan_price']); ?></td>
                        <td><?php echo stripslashes($data['month']); ?></td>
                        <td><?php echo stripslashes($data['category']); ?></td>
                        <td>
                            <?php
                            if($data['image_limit']=="0"){
                                echo "Unlimited";
                            }else{
                                echo $data['image_limit'];
                            }
                            ?>
                        </td>
                        <td class="options-width" >
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
                                    <td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['id'] ?>')"></a></td>
                                    <td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['id'] ?>', '<?php echo $_SESSION['pid'] ?>')"></a></td>
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
                    <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No plans found."; ?></strong></td>
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
    $qry = "UPDATE tbl_plans SET status = 2 WHERE id = '" . $_POST['id'] . "'";
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
    $qry = "SELECT * FROM tbl_plans WHERE id = '" . $_POST['id'] . "'";
    $data = $modelObj->fetchRow($qry);
    
    $qry_cats = "SELECT * FROM tbl_category WHERE status=1 order by categoryName asc";
    $result_cats = $modelObj->fetchRows($qry_cats);
    ?>
    <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.form.js"></script><form name="form_plansadd" id="form_plansadd" method="post" enctype="multipart/form-data" action="#" >
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%"><tr class="white_bg">
                <th>Plan Name : </th>
                <td width="23%">
                    <input class="input_box" type="text" name="txt_addplan_name" id="txt_addplan_name" value="<?php echo stripslashes($data['plan_name']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
                </td>
                <td id="errortxt_addplan_name" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addplan_name"></label>
                </td>
            </tr><tr class="light_bg">
                <th>Plan Price : </th>
                <td width="23%">
                    <input class="input_box" type="text" name="txt_addplan_price" id="txt_addplan_price" value="<?php echo stripslashes($data['plan_price']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
                </td>
                <td id="errortxt_addplan_price" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addplan_price"></label>
                </td>
            </tr><tr class="white_bg">
                <th>Coins Limit : </th>
                <td width="23%">
                    <input class="input_box" type="text" name="txt_addimage_limit" id="txt_addimage_limit" value="<?php if(stripslashes($data['image_limit'])==0){echo "$";}else{echo stripslashes($data['image_limit']);} ?>" onblur="checkfield(this)"><font class="required"> *</font>
                </td>
                <td id="errortxt_addimage_limit" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addimage_limit"></label>
                </td>
            </tr><tr class="light_bg">
                <th>Month : </th>
                <td width="23%">
                    <input class="input_box" type="text" name="txt_addmonth" id="txt_addmonth" value="<?php echo stripslashes($data['month']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
                </td>
                <td id="errortxt_addmonth" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addmonth"></label>
                </td>
            </tr><tr class="white_bg">
                <th>Category : </th>
                <td width="23%">
                    <?php $catlist = explode(",", $data['category']); ?>
                    <select class="select_box" style="height: 100px;" name="txt_addcategory[]" id="txt_addcategory" multiple="multiple">
                        <?php foreach ($result_cats as $k => $catdata): ?>
                            <option <?php echo in_array($catdata['id'], $catlist) ? "selected='selected'" : ""; ?> value="<?php echo $catdata['id']; ?>"><?php echo $catdata['categoryName']; ?></option>
                        <?php endforeach; ?>
                    </select><font class="required"> *</font>
                </td>
                <td id="errortxt_addcategory" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addcategory"></label>
                </td>
            </tr><tr class="light_bg">
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