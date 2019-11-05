<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <aside class="right-side strech">
                    <?php
                    $data = $controller_class->getWalletDetail();
                    $wal_bal = 0;
                    if(isset($data['amount']) && !empty($data)){
                        $wal_bal = $data['amount'];
                    }
                    ?>
                    <!-- Main content -->
                    <section class="content container">
                        <!-- MAILBOX BEGIN -->
                        <div class="mailbox row">
                            <div class="col-xs-12">
                                <div class="box box-solid">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <!-- Chat box -->
                                                <div class="box box-success">
                                                    <div class="box-header">
                                                        <h3 class="box-title"><i class="fa fa-money"></i> Wallet</h3>
                                                    </div>
                                                </div><!-- /.box (chat box) -->
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="small-box bg-blue">
                                                        <div class="inner">
                                                            <h5>Current Balance</h5>
                                                            <?php
                                                            if($wal_bal==''){
                                                                $wal_bal = 0;
                                                            }
                                                            ?>
                                                            <p>$<?php echo $wal_bal ?></p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-ios7-cart-outFline"></i>
                                                        </div>
                                                    </div>
                                                </div><!-- /.col (RIGHT) -->
                                                <?php
                                                if($wal_bal > 0){
                                                    ?>
                                                    <div class="col-xs-12 col-sm-4">
                                                       
                                                        <div class="small-box1">
                                                             
                                                            <div class="inner">
                                                                <?php
                                                                $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
                                                                $qry = "SELECT * FROM tbl_wallet_payout_request WHERE user_id='".$uid."'";
                                                                $rs=mysql_query($qry);
                                                                $cnt = mysql_num_rows($rs);
                                                                $row=mysql_fetch_array($rs);
                                                                if($cnt > 0){
                                                                    echo "<h4 style='color:red'>Payout request sent!</h4>";
                                                                }else{
                                                                    ?>
                                                                    <form name="withdraw" method="post">
                                                                        <input type="hidden" id="actual_amount" value="<?php echo $wal_bal ?>" name="actual_amount" class="form-control"/>
                                                                        <!--                                                                    <div class="form-group">
                                                                        <input required="" type="text" id="with_amount" name="with_amount" class="form-control"/>
                                                                        </div>-->
                                                                        <div class="form-group">
                                                                            <input type="button" id="withdraw-btn" value="Withdraw" name="submit" class="btn btn-success"/>
                                                                        </div>
                                                                    </form>
                                                                    <?php
                                                                }
                                                               ?>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-ios7-cart-outFline"></i>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.col (RIGHT) -->    
                                                    <?php
                                                }
                                                ?>
                                            </div><!-- /.col (RIGHT) -->
                                        </div><!-- /.row -->
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!-- /.col (MAIN) -->
                        </div>
                        <!-- MAILBOX END -->

                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->

            <?php include('footernew.php'); ?>
        </div>
    </div>


    <!-- AdminLTE App -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/AdminLTE/app.js" type="text/javascript"></script>
    <script>
        $('document').ready(function(){
            $('#withdraw-btn').click(function(){
                var actual_amount = $("#actual_amount").val();
                var with_amount = $("#with_amount").val();
                if(with_amount!='' && with_amount!='0'){
                    $.ajax({
                        url: site_url + 'controllers/ajax_controller/preview-ajax-controller.php',
                        type: 'post',
                        data: 'userWallet=1&amount=' + actual_amount,
                        //data: 'userWallet=1',
                        success: function (result)
                        {
                           window.location = window.location.href;
                            return false;
                        }
                    });
                }
                
            });
        });
    </script>
</body>