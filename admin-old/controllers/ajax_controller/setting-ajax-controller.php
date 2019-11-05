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

$upload_dir = $_SESSION['SITE_IMG_PATH'] . "default/";
$upload_dirthumb = $_SESSION['SITE_IMG_PATH'] . "default/thumb/";
?>
<?php
if (isset($_POST['view']) && $_POST['view'] != '') {
    $id = $_POST['id'];
    $qry = "SELECT * FROM tbl_settings WHERE Id = '" . mysql_real_escape_string($id) . "'";
    $result = $modelObj->fetchRow($qry);
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
        <tr class="light_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Email Address :</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['email']) ?></td>
        </tr>

        <tr class="white_bg"> 
            <td align="right" class="popup_listing_border"><strong>Theme :</strong></td>
            <td height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td align="left" class="popup_listing_border">
                <?php
                if ($result['theme'] == "screen_black.css") {
                    echo "Black Theme";
                } else if ($result['theme'] == "screen_orange.css") {
                    echo "Orange Theme";
                } else if ($result['theme'] == "screen_blue.css") {
                    echo "Blue Theme";
                }
                ?>
            </td>
        </tr>
        <tr class="light_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>1 Coin = </strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['mb_to_coin']) ?>kb</td>
        </tr>

    </table>
<?php } ?>

<?php
if (isset($_POST['hid_update']) && $_POST['hid_update'] != '') {
    $flag = 1;

    if ($flag == 1) {
        $qry = "UPDATE tbl_settings SET 
		email = '" . mysql_real_escape_string(trim($_POST['txt_email'])) . "',
		theme = '" . mysql_real_escape_string(trim($_POST['txt_theme'])) . "',
                mb_to_coin = '" . mysql_real_escape_string(trim($_POST['txt_mbtocoin'])) . "'
		WHERE Id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
        $result = $modelObj->runQuery($qry);
        
        if (!dir($upload_dir)) {
            mkdir($upload_dir);
        }
        if (!dir($upload_dirthumb)) {
            mkdir($upload_dirthumb);
        }
        
        if (isset($_FILES["txt_defaultcategoryartist1"]["tmp_name"])) {
            $tmpfile = $_FILES["txt_defaultcategoryartist1"]["tmp_name"];
            $newname = $_FILES["txt_defaultcategoryartist1"]["name"];
            $insertimage = "";
            if ($_FILES["txt_defaultcategoryartist1"]["tmp_name"] != '') {
                $abc = date("dmyHis");
                $insertimage = $abc . $newname;
                if (move_uploaded_file($tmpfile, $upload_dir . $insertimage)) {
                    $resizeObj_20 = new resize($upload_dir . $insertimage);
                    $resizeObj_20->resizeImage(50, 50, 'exact');
                    $resizeObj_20->saveImage($upload_dirthumb . $insertimage, $upload_dir . $insertimage, 100);
                    
                    $qry_update1 = "UPDATE tbl_settings SET `default_category_1`='" . $insertimage . "' WHERE Id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
                    $modelObj->runQuery($qry_update1);
                }
            }
        }
        
        if (isset($_FILES["txt_defaultcategoryartist2"]["tmp_name"])) {
            $tmpfile = $_FILES["txt_defaultcategoryartist2"]["tmp_name"];
            $newname = $_FILES["txt_defaultcategoryartist2"]["name"];
            $insertimage = "";
            if ($_FILES["txt_defaultcategoryartist2"]["tmp_name"] != '') {
                $abc = date("dmyHis");
                $insertimage = $abc . $newname;
                if (move_uploaded_file($tmpfile, $upload_dir . $insertimage)) {
                    $resizeObj_20 = new resize($upload_dir . $insertimage);
                    $resizeObj_20->resizeImage(50, 50, 'exact');
                    $resizeObj_20->saveImage($upload_dirthumb . $insertimage, $upload_dir . $insertimage, 100);
                    
                    $qry_update2 = "UPDATE tbl_settings SET `default_category_2`='" . $insertimage . "' WHERE Id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
                    $modelObj->runQuery($qry_update2);
                }
            }
        }
        
        if (isset($_FILES["txt_defaultcategoryartist3"]["tmp_name"])) {
            $tmpfile = $_FILES["txt_defaultcategoryartist3"]["tmp_name"];
            $newname = $_FILES["txt_defaultcategoryartist3"]["name"];
            $insertimage = "";
            if ($_FILES["txt_defaultcategoryartist3"]["tmp_name"] != '') {
                $abc = date("dmyHis");
                $insertimage = $abc . $newname;
                if (move_uploaded_file($tmpfile, $upload_dir . $insertimage)) {
                    $resizeObj_20 = new resize($upload_dir . $insertimage);
                    $resizeObj_20->resizeImage(50, 50, 'exact');
                    $resizeObj_20->saveImage($upload_dirthumb . $insertimage, $upload_dir . $insertimage, 100);
                    
                    $qry_update3 = "UPDATE tbl_settings SET `default_category_3`='" . $insertimage . "' WHERE Id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
                    $modelObj->runQuery($qry_update3);
                }
            }
        }
        
        if (isset($_FILES["txt_defaultcategoryartist4"]["tmp_name"])) {
            $tmpfile = $_FILES["txt_defaultcategoryartist4"]["tmp_name"];
            $newname = $_FILES["txt_defaultcategoryartist4"]["name"];
            $insertimage = "";
            if ($_FILES["txt_defaultcategoryartist4"]["tmp_name"] != '') {
                $abc = date("dmyHis");
                $insertimage = $abc . $newname;
                if (move_uploaded_file($tmpfile, $upload_dir . $insertimage)) {
                    $resizeObj_20 = new resize($upload_dir . $insertimage);
                    $resizeObj_20->resizeImage(50, 50, 'exact');
                    $resizeObj_20->saveImage($upload_dirthumb . $insertimage, $upload_dir . $insertimage, 100);
                    
                    $qry_update4 = "UPDATE tbl_settings SET `default_category_4`='" . $insertimage . "' WHERE Id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
                    $modelObj->runQuery($qry_update4);
                }
            }
        }
        
        if (isset($_FILES["txt_defaultcategoryartist5"]["tmp_name"])) {
            $tmpfile = $_FILES["txt_defaultcategoryartist5"]["tmp_name"];
            $newname = $_FILES["txt_defaultcategoryartist5"]["name"];
            $insertimage = "";
            if ($_FILES["txt_defaultcategoryartist5"]["tmp_name"] != '') {
                $abc = date("dmyHis");
                $insertimage = $abc . $newname;
                if (move_uploaded_file($tmpfile, $upload_dir . $insertimage)) {
                    $resizeObj_20 = new resize($upload_dir . $insertimage);
                    $resizeObj_20->resizeImage(50, 50, 'exact');
                    $resizeObj_20->saveImage($upload_dirthumb . $insertimage, $upload_dir . $insertimage, 100);
                    
                    $qry_update5 = "UPDATE tbl_settings SET `default_category_5`='" . $insertimage . "' WHERE Id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
                    $modelObj->runQuery($qry_update5);
                }
            }
        }
        
        if ($result) {
            echo "1";
        } else {
            echo "2";
        }
    } else {
        echo "0";
    }
}
?>
<?php
if (isset($_POST['viewdiv']) && $_POST['viewdiv'] != '') {
    $start = $_POST['prevnext'];
    $end = $_POST['row'];

    if ($_POST['search'] != '0') {
        if (trim($_POST['txt_srchfname']) != '') {
            $searchqry .= " email LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srchfname'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }
        $_SESSION['srchqry'] = $_SESSION['srchqry'];

        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_settings WHERE " . $_SESSION['srchqry'] . "  order by Id  asc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_settings WHERE " . $_SESSION['srchqry'] . " ORDER BY " . $_POST['fieldname'] . " asc LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_settings WHERE " . $_SESSION['srchqry'] . "")or die(mysql_error());
    } else {
        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_settings order by Id desc LIMIT 0,$end "; /* $start, */
        } else {
            $qry = "SELECT * FROM tbl_settings ORDER BY " . $_POST['fieldname'] . " asc LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_settings ")or die(mysql_error());
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
                $('#form_userview input[type=checkbox]').checkBox('toggle');
                return false;
            });
        });
    </script> 
    <form id="form_userview" action="" name="form_userview" method="post" enctype="multipart/form-data" onsubmit="return false">
        <div class="searchdiv">
            <table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="13%" align="left">&nbsp;</td>
                    <td width="16%">&nbsp;</td>
                    <td width="64%">&nbsp;</td>
                    <td width="7%" align="right" valign="bottom">&nbsp;</td>
                </tr>
            </table>
        </div>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
            <tr>
                <th class="table-header-repeat line-left minwidth-1"> <a class="cursorpointer">Email Address </a></th>
                <th class="table-header-repeat line-left minwidth-1"> <a class="cursorpointer">Theme</a></th>
                <th class="table-header-repeat line-left minwidth-1"> <a class="cursorpointer">1 Coin Equals to</a></th>
                <th class="table-header-options line-left"><a>Options</a></th>
            </tr>
            <?php
            $i = 0;
            if ($result != '') {
                foreach ($result as $k => $data) {
                    $i++;
                    ?>
                    <tr id="<?php echo $data['Id'] ?>" class="<?php
                    if ($i % 2 == 0) {
                        echo "light_bg";
                    } else {
                        echo "white_bg";
                    }
                    ?>" height="30">
                        <td class="cursorpointer" onclick="edit('<?php echo $data['Id'] ?>', '<?php echo $_SESSION['pid'] ?>')"><?php echo stripslashes($data['email']); ?></td>

                        <td>
                            <?php
                            if ($data['theme'] == "screen_black.css") {
                                echo "Black Theme";
                            } else if ($data['theme'] == "screen_orange.css") {
                                echo "Orange Theme";
                            } else if ($data['theme'] == "screen_blue.css") {
                                echo "Blue Theme";
                            }
                            ?></td>
                        <td><?php echo $data['mb_to_coin']; ?>kb</td>
                        <td class="options-width" >
                            <table id="tables_options">
                                <tr>
                                    <td><a style="cursor:pointer" title="View" class="icon-view info-tooltip" onclick="view('<?php echo $data['Id'] ?>')"></a></td>
                                    <td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['Id'] ?>', '<?php echo $_SESSION['pid'] ?>')"></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr height="30"><td colspan="6" align="center" style="color:#FF0000"><strong><?php echo "No settings found."; ?></strong></td></tr>
                <?php
            }
            ?>
        </table>

        <?php
        if ($result != '') {
            //echo $modelObj->ajaxpaging_advancesearch($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end);
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
if (isset($_POST['edit']) && $_POST['edit'] != '') {
    $qry = "SELECT * FROM tbl_settings WHERE Id = '" . $_POST['id'] . "'";
    $data = $modelObj->fetchRow($qry);
    ?>
    <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.form.js"></script>
    <form name="form_useradd" id="form_useradd" method="post" enctype="multipart/form-data" action="#" >
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
            <tr class="light_bg">
                <th>Email Address :</th>
                <td width="25%"><input type="text" class="input_box"  name="txt_email" id="txt_email" value="<?php echo stripslashes($data['email']) ?>" onblur="checkmail(this)" /><font class="required"> *</font></td>
                <td id="errortxt_email" width="55%">
                    <label class="removerror error_new" id="error-innertxt_email"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>Theme :</th>
                <td>
                    <select class="select_box"  name="txt_theme" id="txt_theme" onblur="checkfield(this)">
                        <option value="">Select Theme</option>
                        <option value="screen_black.css" <?php
                        if ($data['theme'] == 'screen_black.css') {
                            echo "selected='selected'";
                        }
                        ?>>Black Theme</option>
                        <option value="screen_blue.css" <?php
                        if ($data['theme'] == 'screen_blue.css') {
                            echo "selected='selected'";
                        }
                        ?>>Blue Theme</option>
                        <option value="screen_orange.css" <?php
                        if ($data['theme'] == 'screen_orange.css') {
                            echo "selected='selected'";
                        }
                        ?>>Orange Theme</option>
                    </select><font class="required"> *</font>
                </td>
                <td id="errortxt_theme">
                    <label class="removerror error_new" id="error-innertxt_theme"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>1 Coin = </th>
                <td width="25%"><input type="text" class="input_box"  name="txt_mbtocoin" id="txt_mbtocoin" value="<?php echo stripslashes($data['mb_to_coin']) ?>" />kb<font class="required"> *</font></td>
                <td id="errortxt_mbtocoin" width="55%">
                    <label class="removerror error_new" id="error-innertxt_mbtocoin"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>Default Category Artist-1 : </th>
                <td width="23%">
                    <input type="file" class="input_box" name="txt_defaultcategoryartist1" id="txt_defaultcategoryartist1" size="16" />
                </td>
                <td id="errortxt_defaultcategoryartist1" width="57%">
                    <a target="_blank" href="<?= $_SESSION['SITE_NAME'] ?>upload/default/<?php echo $data['default_category_1'] ?>">
                        <img src="<?= $_SESSION['SITE_NAME'] ?>upload/default/thumb/<?php echo $data['default_category_1'] ?>" width="50" height="50">
                    </a>
                    <label class="removerror error_new" id="error-innertxt_defaultcategoryartist1"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>Default Category Artist-2 : </th>
                <td width="23%">
                    <input type="file" class="input_box" name="txt_defaultcategoryartist2" id="txt_defaultcategoryartist2" size="16" />
                </td>
                <td id="errortxt_defaultcategoryartist2" width="57%">
                    <a target="_blank" href="<?= $_SESSION['SITE_NAME'] ?>upload/default/<?php echo $data['default_category_2'] ?>">
                        <img src="<?= $_SESSION['SITE_NAME'] ?>upload/default/thumb/<?php echo $data['default_category_2'] ?>" width="50" height="50">
                    </a>
                    <label class="removerror error_new" id="error-innertxt_defaultcategoryartist2"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>Default Category Artist-3 : </th>
                <td width="23%">
                    <input type="file" class="input_box" name="txt_defaultcategoryartist3" id="txt_defaultcategoryartist3" size="16" />
                </td>
                <td id="errortxt_defaultcategoryartist3" width="57%">
                    <a target="_blank" href="<?= $_SESSION['SITE_NAME'] ?>upload/default/<?php echo $data['default_category_3'] ?>">
                        <img src="<?= $_SESSION['SITE_NAME'] ?>upload/default/thumb/<?php echo $data['default_category_3'] ?>" width="50" height="50">
                    </a>
                    <label class="removerror error_new" id="error-innertxt_defaultcategoryartist3"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>Default Category Artist-4 : </th>
                <td width="23%">
                    <input type="file" class="input_box" name="txt_defaultcategoryartist4" id="txt_defaultcategoryartist4" size="16" />
                </td>
                <td id="errortxt_defaultcategoryartist4" width="57%">
                    <a target="_blank" href="<?= $_SESSION['SITE_NAME'] ?>upload/default/<?php echo $data['default_category_4'] ?>">
                        <img src="<?= $_SESSION['SITE_NAME'] ?>upload/default/thumb/<?php echo $data['default_category_4'] ?>" width="50" height="50">
                    </a>
                    <label class="removerror error_new" id="error-innertxt_defaultcategoryartist4"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>Default Category Artist-5 : </th>
                <td width="23%">
                    <input type="file" class="input_box" name="txt_defaultcategoryartist5" id="txt_defaultcategoryartist5" size="16" />
                </td>
                <td id="errortxt_defaultcategoryartist5" width="57%">
                    <a target="_blank" href="<?= $_SESSION['SITE_NAME'] ?>upload/default/<?php echo $data['default_category_5'] ?>">
                        <img src="<?= $_SESSION['SITE_NAME'] ?>upload/default/thumb/<?php echo $data['default_category_5'] ?>" width="50" height="50">
                    </a>
                    <label class="removerror error_new" id="error-innertxt_defaultcategoryartist5"></label>
                </td>
            </tr>
            <tr class="white_bg">
                <th>&nbsp;</th>
                <td valign="top">
                    <?php
                    if ($_POST['id'] != 0) {
                        ?>
                        <input type="hidden" name="hid_userid" id="hid_userid" value="<?php echo $data['Id'] ?>" />
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