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
        <?php
        $qry = "SELECT SUM(amount) as total_amount FROM tbl_user_wallet";
        $rs=mysql_query($qry);
        $cnt = mysql_num_rows($rs);
        $row=mysql_fetch_array($rs);
        if($row['total_amount'] > 0 && $row['total_amount']!=''){
            $row['total_amount'] = $row['total_amount'];
        }else{
          
            $row['total_amount'] = 0;
        }
        ?>
        <h1>Wallet Balance: <span style="color:green;font-weight:bold"><?php
            
                echo "$".$row['total_amount'];
           
            ?></span></h1>
        <div class="tabDiv">
            <a class="tabLink" href="<?php echo 'index.php?pid=history'; ?>">Transaction History</a>
            <a class="tabLink" href="<?php echo 'index.php?pid=payout_request'; ?>">Payout Requests </a>
        </div>
    </div>
</div>