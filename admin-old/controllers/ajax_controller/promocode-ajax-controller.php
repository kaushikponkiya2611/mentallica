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

function randomstring($len) {
    $randomletter = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, $len);    
    return $randomletter;
}

if (isset($_POST['view']) && $_POST['view'] != '') {
    $id = $_POST['id'];
    $qry = "SELECT * FROM tbl_promocode where id = '" . mysql_real_escape_string($id) . "'";
    $result = $modelObj->fetchRow($qry);
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
        <tr class="white_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Promo Code:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['promocode']) ?></td>
        </tr>
        <tr class="white_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>Email Address:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border"><?php echo stripslashes($result['email_address']) ?></td>
        </tr>
        <tr class="light_bg">
            <td width="120" align="right" class="popup_listing_border"><strong>User Type:</strong></td>
            <td width="11" height="37" align="left" class="popup_listing_border">&nbsp;</td>
            <td width="469" align="left" class="popup_listing_border">
                <?php echo stripslashes($result['cur_text']) ?>
                <?php
                if ($result['user_type'] == 1) {
                    echo "Artist";
                } else if ($result['user_type'] == 2) {
                    echo "Client";
                } else if ($result['user_type'] == 3) {
                    echo "Company";
                }
                ?>
            </td>
        </tr></table>
    <?php
}
?>			
<?php
if (isset($_POST['statusactive']) && $_POST['statusactive'] != '') {
    $id = explode(",", $_POST['active']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_promocode SET status = 1 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['statusinactive']) && $_POST['statusinactive'] != '') {
    $id = explode(",", $_POST['inactive']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_promocode SET status = 0 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['deleselected']) && $_POST['deleselected'] != '') {
    $id = explode(",", $_POST['delete']);
    foreach ($id as $k => $val) {
        $qry = "UPDATE  tbl_promocode SET status = 2 WHERE id = " . mysql_real_escape_string($val);
        $result = $modelObj->runQuery($qry);
    }
}
?>
<?php
if (isset($_POST['hid_add']) && $_POST['hid_add'] != '') {
    $qry = "SELECT * FROM tbl_promocode WHERE email_address = '" . mysql_real_escape_string(trim($_POST['txt_addemail_address'])) . "' and status!=2 ";
    $result = $modelObj->fetchRow($qry);

    if (strtolower(trim($result['email_address'])) == strtolower(trim($_POST['txt_addemail_address']))) {
        $flag = 0;
    } else {
        $flag = 1;
    }

    if ($flag == 1) {
        $qry = "INSERT INTO tbl_promocode (promocode,email_address,user_type,cr_date,status) 
            VALUES ('" . clear_input($_POST['txt_addpromo_code']) . "','" . clear_input($_POST['txt_addemail_address']) . "','" . clear_input($_POST['txt_adduser_type']) . "',NOW(),1)";
        $result = $modelObj->runQuery($qry);
        
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html>
                    <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <style type="text/css">
                                    .ExternalClass {
                                            display: block !important;
                                    }
                                    body {
                                            font-family: "Open Sans";
                                            color: #333333;
                                            font-size: 14px;
                                    }
                            </style>
                    </head>
                    <body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff" style="font-family:Open Sans">
                    <table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                    <td>
                                            <table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                            <tr>
                                                                    <td width="600" style="border:1px solid #336699;">
                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                            <td colspan="2" height="73" style="background:#FFF; padding-left:20px;"> 
                                                                                                <a target="_blank" href=' . $_SESSION['FRNT_DOMAIN_NAME'] . '>
                                                                                                    <img src="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'img/mentallica-logo.png">
                                                                                                </a>
                                                                                            </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="21" style="background:#336699;font-size:20px; font-weight:bold; color:#ffffff; font-family:Open Sans; padding:0px 20px;"><strong>Promo Code Email</strong></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="10"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="30" style="font-size:16px; color:#4d4d4d; font-family:Open Sans; padding:10px 20px;font-weight:bold">Hi,</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="10"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;">Please use below url to signup with mentallica and get benefit of promo code.</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2" height="10"></td>
                                                                                    </tr>                                                                                    
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;">Please <a href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'home/'.$_POST['txt_addpromo_code'].'">click here</a> to signup.</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" style="font-size:14px; color:#000000; font-family:Open Sans; padding:0px 20px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" style="font-size:14px; color:#000000; font-family:Open Sans; padding:0px 20px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;">Thanks,</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;"><a href="' . $_SESSION['FRNT_DOMAIN_NAME'] . '">Mentallica</a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" style="font-size:14px; color:#000000; font-family:Open Sans; padding:0px 20px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20"></td>
                                                                                    </tr>
                                                                            </table>
                                                                    </td>
                                                            </tr>
                                                    </tbody>
                                            </table>
                                    </td>
                            </tr>
                    </body>
                    </html>';
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: <'.$_POST['txt_addemail_address'].'>' . "\r\n";
        $headers .= 'From: Mentallica <no-reply@mentallica.com>' . "\r\n";
        
        $to = $_POST['txt_addemail_address'];
        $subject = "Promo Code Email";
        // Mail it
        mail($to, $subject, $message, $headers);
        
        echo "1";
    } else {
        echo "0";
    }
}
?>
<?php
if (isset($_POST['statusid']) && $_POST['statusid'] != '') {
    $qry = "UPDATE  tbl_promocode SET status = " . mysql_real_escape_string($_POST['status']) . " WHERE id = " . mysql_real_escape_string($_POST['statusid']);
    $result = $modelObj->runQuery($qry);
}
?>
<?php
if (isset($_POST['hid_update']) && $_POST['hid_update'] != '') {
    $qry = "SELECT * FROM tbl_promocode WHERE promocode = '" . mysql_real_escape_string(trim($_POST['txt_addpromo_code'])) . "' and status!=2 and id != '" . $_POST['hid_userid'] . "'";
    $result = $modelObj->fetchRow($qry);

    if (strtolower(trim($result['promocode'])) == strtolower(trim($_POST['txt_addpromo_code']))) {
        echo $errmsg = "0";
        $flag = 0;
    } else {
        $flag = 1;
    }
    $flag = 1;

    if ($flag == 1) {
        $qry = "UPDATE tbl_promocode SET promocode = '" . clear_input($_POST['txt_addpromo_code']) . "',email_address = '" . clear_input($_POST['txt_addemail_address']) . "',
            user_type = '" . clear_input($_POST['txt_adduser_type']) . "'WHERE id = '" . mysql_real_escape_string($_POST['hid_userid']) . "'";
        $result = $modelObj->runQuery($qry);
        
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html>
                    <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <style type="text/css">
                                    .ExternalClass {
                                            display: block !important;
                                    }
                                    body {
                                            font-family: "Open Sans";
                                            color: #333333;
                                            font-size: 14px;
                                    }
                            </style>
                    </head>
                    <body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#ffffff" style="font-family:Open Sans">
                    <table style="width: 100%;" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                    <td>
                                            <table style="width: 600px;" align="center" border="0"cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                            <tr>
                                                                    <td width="600" style="border:1px solid #336699;">
                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                            <td colspan="2" height="73" style="background:#FFF; padding-left:20px;"> 
                                                                                                <a target="_blank" href=' . $_SESSION['FRNT_DOMAIN_NAME'] . '>
                                                                                                    <img src="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'img/mentallica-logo.png">
                                                                                                </a>
                                                                                            </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="21" style="background:#336699;font-size:20px; font-weight:bold; color:#ffffff; font-family:Open Sans; padding:0px 20px;"><strong>Promo Code Email</strong></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="10"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="30" style="font-size:16px; color:#4d4d4d; font-family:Open Sans; padding:10px 20px;font-weight:bold">Hi,</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="10"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;">Please use below url to signup with mentallica and get benefit of promo code.</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2" height="10"></td>
                                                                                    </tr>                                                                                    
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;">Please <a href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'home/'.$_POST['txt_addpromo_code'].'">click here</a> to signup.</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" style="font-size:14px; color:#000000; font-family:Open Sans; padding:0px 20px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" style="font-size:14px; color:#000000; font-family:Open Sans; padding:0px 20px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;">Thanks,</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20" style="padding:0px 20px;"><a href="' . $_SESSION['FRNT_DOMAIN_NAME'] . '">Mentallica</a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" style="font-size:14px; color:#000000; font-family:Open Sans; padding:0px 20px;">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td colspan="2" height="20"></td>
                                                                                    </tr>
                                                                            </table>
                                                                    </td>
                                                            </tr>
                                                    </tbody>
                                            </table>
                                    </td>
                            </tr>
                    </body>
                    </html>';
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: <'.$_POST['txt_addemail_address'].'>' . "\r\n";
        $headers .= 'From: Mentallica <no-reply@mentallica.com>' . "\r\n";
        
        $to = $_POST['txt_addemail_address'];
        $subject = "Promo Code Email";
        // Mail it
        mail($to, $subject, $message, $headers);
        
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
        if (trim($_POST['txt_srcpromo_code']) != '') {
            $searchqry .= "and promocode LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srcpromo_code'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }
        if (trim($_POST['txt_srcemail_address']) != '') {
            $searchqry .= "and email_address LIKE '%" . mysql_real_escape_string(trim($_POST['txt_srcemail_address'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }
        if (trim($_POST['combo_srcuser_type']) != '') {
            $searchqry .= "and user_type LIKE '%" . mysql_real_escape_string(trim($_POST['combo_srcuser_type'])) . "%'";
            $_SESSION['srchqry'] = $searchqry;
        }
        $_SESSION['srchqry'] = $_SESSION['srchqry'];

        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_promocode where status!=2 " . $_SESSION['srchqry'] . " order by cr_date desc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_promocode where status!=2 " . $_SESSION['srchqry'] . " ORDER BY " . $_POST['fieldname'] . " " . $orderby . " LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_promocode where status!=2 " . $_SESSION['srchqry'] . "") or die(mysql_error());
    } else {
        if ($_POST['fieldname'] == '0') {
            $qry = "SELECT * FROM tbl_promocode where status!=2 order by cr_date desc LIMIT $start,$end ";
        } else {
            $qry = "SELECT * FROM tbl_promocode where status!=2 ORDER BY " . $_POST['fieldname'] . " " . $orderby . " LIMIT $start,$end";
        }
        $qry11 = mysql_query("SELECT * FROM tbl_promocode where status!=2 ")or die(mysql_error());
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
    </script> 
    <form id="form_promocodeview" action="" name="form_promocodeview" method="post" enctype="multipart/form-data" onsubmit="return false">
        <div class="searchdiv">
            <table class="searchdiv" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="13%" align="left">&nbsp;</td>
                    <td width="16%">&nbsp;</td>
                    <td width="64%">&nbsp;</td>
                    <td width="7%" align="right" valign="bottom"><input class="button_bg" type="button" value="Search" name="btn_search" onclick="show_search()"></td>
                </tr>
            </table>
        </div>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
            <tr>
                <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('promocode', '<?php
                    if ($orderby == 'asc') {
                        echo "desc";
                    } else {
                        echo "asc";
                    }
                    ?>')" id="cur_code" class="cursorpointer">Promo Code</a></th>
                <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('email_address', '<?php
                    if ($orderby == 'asc') {
                        echo "desc";
                    } else {
                        echo "asc";
                    }
                    ?>')" id="cur_code" class="cursorpointer">Email Address</a></th>
                <th class="table-header-repeat line-left minwidth-1"> <a onclick="sortingbyfield('user_type', '<?php
                    if ($orderby == 'asc') {
                        echo "desc";
                    } else {
                        echo "asc";
                    }
                    ?>')" id="cur_text" class="cursorpointer">User Type</a></th>
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
                        <td class="cursorpointer" onclick="edit('<?php echo $data['id'] ?>', '<?php echo $_SESSION['pid'] ?>')"><?php echo stripslashes($data['promocode']); ?></td>
                        <td><?php echo $data['email_address']; ?></td>
                        <td>
                            <?php
                            if ($data['user_type'] == 1) {
                                echo "Artist";
                            } else if ($data['user_type'] == 2) {
                                echo "Client";
                            } else if ($data['user_type'] == 3) {
                                echo "Company";
                            }
                            ?>
                        </td>
                        <td class="options-width" >
                            <table>
                                <tr>                                    
                                    <td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['id'] ?>', '<?php echo $_SESSION['pid'] ?>')"></a></td>
                                    <td><a style="cursor:pointer" title="Delete" class="icon-delete info-tooltip" onclick="deleteuser('<?php echo $data['id'] ?>')" ></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr height="30">
                    <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No promo code found."; ?></strong></td>
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
    $qry = "UPDATE tbl_promocode SET status = 2 WHERE id = '" . $_POST['id'] . "'";
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
    $qry = "SELECT * FROM tbl_promocode WHERE id = '" . $_POST['id'] . "'";
    $data = $modelObj->fetchRow($qry);
    
    $promocode = randomstring("8");
    if($data['promocode']!=''){
        $promocode = $data['promocode'];
    }
    ?>
    <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.form.js"></script><form name="form_promocodeadd" id="form_promocodeadd" method="post" enctype="multipart/form-data" action="#" >
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
            <tr class="white_bg">
                <th>Promo Code : </th>
                <td width="23%">
                    <input class="input_box" type="text" name="txt_addpromo_code" id="txt_addpromo_code" value="<?php echo $promocode; ?>" onblur="checkfield(this)" readonly="readonly"><font class="required"> *</font>
                </td>
                <td id="errortxt_addpromo_code" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addpromo_code"></label>
                </td>
            </tr>
            <tr class="white_bg">
                <th>Email Address : </th>
                <td width="23%">
                    <input class="input_box" type="text" name="txt_addemail_address" id="txt_addemail_address" value="<?php echo stripslashes($data['email_address']) ?>" onblur="checkfield(this)"><font class="required"> *</font>
                </td>
                <td id="errortxt_addemail_address" width="57%">
                    <label class="removerror error_new" id="error-innertxt_addemail_address"></label>
                </td>
            </tr>
            <tr class="light_bg">
                <th>User Type : </th>
                <td width="23%">
                    <select name="txt_adduser_type" id="txt_adduser_type" class="select_box" onblur="checkfield(this)">
                        <option value="">Select User Type</option>
                        <option value="1" <?php if ($data['user_type'] == 1) {
                            echo "selected='selected'";
                        } ?>>Artist</option>
                                            <option value="2" <?php if ($data['user_type'] == 2) {
                            echo "selected='selected'";
                        } ?>>Client</option>
                                            <option value="3" <?php if ($data['user_type'] == 3) {
                            echo "selected='selected'";
                        } ?>>Company</option>
                    </select><font class="required"> *</font>
                </td>
                <td id="errortxt_adduser_type" width="57%">
                    <label class="removerror error_new" id="error-innertxt_adduser_type"></label>
                </td>
            </tr>
            <tr class="white_bg">
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