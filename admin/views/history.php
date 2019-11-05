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
            if($cnt > 0){
                echo "$".$row['total_amount'];
            }
            ?></span></h1>
         <div class="tabDiv">
            <a class="tabLink active" href="<?php echo 'index.php?pid=history'; ?>">Transaction History</a>
            <a class="tabLink" href="<?php echo 'index.php?pid=payout_request'; ?>">Payout Requests </a>
        </div>
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
            <tr>
                <th class="table-header-repeat line-left minwidth-1"><a href="javascript:void(0)" class="cursorpointer">#</a></th>
                <th class="table-header-repeat line-left minwidth-1"><a href="javascript:void(0)" class="cursorpointer">Buyer</a></th>
                <th class="table-header-repeat line-left minwidth-1"><a href="javascript:void(0)" class="cursorpointer">To</a></th>
                <th class="table-header-repeat line-left minwidth-1"><a href="javascript:void(0)" class="cursorpointer">Amount</a></th>
                <th class="table-header-repeat line-left minwidth-1"><a href="javascript:void(0)" class="cursorpointer">Transaction ID</a></th>
            </tr>
            <?php
                $qry1 = "SELECT * FROM tbl_trans_history";
                $rs1=mysql_query($qry1);
                $cnt1 = mysql_num_rows($rs1);
                if($cnt1 > 0){
                    $i = 1;
                    while($row1=mysql_fetch_array($rs1)){
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row1['from_amt']; ?></td>
                            <td><?php echo $row1['to_amt'] ?></td>
                            <td><?php echo $row1['amount'] ?></td>
                            <td><?php echo $row1['transaction_id'] ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }else{
                    ?>
                    <tr>
                        <td align='center' colspan="5">No data found!</td>
                    </tr>
                    <?php
                }
            ?>
            <?php
           ?>
        </table>
    </div>
</div>
