<script type="text/javascript">
    $(function () {
        $('input').checkBox();
        $('#toggle-all').click(function () {
            $('#toggle-all').toggleClass('toggle-checked');
            $('#form_userview input[type=checkbox]').checkBox('toggle');
            return false;
        });
    });
</script> 
<script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/settingscript.js"></script>
<script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.form.js"></script>
<!-- /TinyMCE -->
<style type="text/css">
    .showerror{
        display:block;
    }
    .removerror{
        display:none;
    }
</style>
<div id="table-content">
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
                <td class="green-right"><a class="close-green">
                        <img src="images/table/icon_close_green.gif" alt="" /></a>
                </td>
            </tr>
        </table>
    </div>
    <div id="<?php echo $_GET['pid'] ?>" >
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
        <form id="form_userview" action="" name="form_cmsview" method="post" enctype="multipart/form-data" >
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"> <a class="cursorpointer">Email Address </a></th>
                    <th class="table-header-repeat line-left minwidth-1"> <a class="cursorpointer">Theme</a></th>
                    <th class="table-header-repeat line-left minwidth-1"> <a class="cursorpointer">1 Coin Equals to</a></th>
                    <th class="table-header-options line-left"><a>Options</a></th>
                </tr>
                <?php
                $i = 0;
                if ($controller_class->getsetting != '') {
                    foreach ($controller_class->getsetting as $k => $data) {
                        $i++;
                        ?>
                        <tr id="<?php echo $data['Id'] ?>" class="<?php
                        if ($i % 2 == 0) {
                            echo "light_bg";
                        } else {
                            echo "white_bg";
                        }
                        ?>" height="30">
                                <?php /* ?><td><input type="checkbox" name="chk_id" id="chk_id" value="<?php echo $data['Id'];  ?>"/></td><?php */ ?>
                            <td class="cursorpointer" onclick="edit('<?php echo $data['Id'] ?>', '<?php echo $_GET['pid'] ?>')"><?php echo stripslashes($data['email']); ?></td>
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
                                        <td><a style="cursor:pointer" title="Edit" class="icon-edit info-tooltip" onclick="edit('<?php echo $data['Id'] ?>', '<?php echo $_GET['pid'] ?>')"></a></td>
                                    </tr>
                                </table>
                            </td>					
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr height="30"><td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No settings found."; ?></strong></td></tr>
                <?php } ?>
            </table>
            <?php
            if ($controller_class->getsetting != '') {
                //echo $model_class->paging_advancesearch($controller_class -> gettotalpageno,20,ceil($controller_class -> gettotalpageno/20));
                ?>
            <?php } else { ?>
                <input type="hidden" name="sel_noofrow" id="sel_noofrow" value="20" />
            <?php } ?>
            <input type="hidden" name="hid_fieldname" id="hid_fieldname"    value=""  />
            <input type="hidden" name="hidsearch" id="hidsearch" value="0" />
            <input type="hidden" name="viewdiv" id="viewdiv" value="1" />
        </form>
    </div>
</div>