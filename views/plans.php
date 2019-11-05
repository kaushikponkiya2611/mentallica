<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $controller_class -> pageTitle?> | ProjectName</title>
        <link rel="icon" type="image/png" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']?>img/siteicon/1430042965_131514.ico">
        
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/ionicons.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Select Package</div>
            <form action="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>payment/" name="planSelect" id="planSelect" method="post">
                <div class="body bg-gray">
                    <?php
                        //$_SESSION['login_error']= 123;
                        if(isset($_SESSION['po_userses']['login_error']) && $_SESSION['po_userses']['login_error'] != ''){
                            ?>
                            <div class="callout <?php echo $_SESSION['po_userses']['login_error_cls'];?>">
                                <?php echo $_SESSION['po_userses']['login_error'];?>
                            </div>
                            <?php
                            unset($_SESSION['po_userses']['login_error']);
                            unset($_SESSION['po_userses']['login_error_cls']);
                        }
                    ?>
                    <div class="form-group">
                    <?php $plan_cls = array('purple', 'teal', 'yellow'); 
                    foreach ($controller_class -> allplans as $k => $planlist):?>
                        <div class="col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-<?php echo $plan_cls[$k];?>">
                                <div class="inner">
                                    <h3>
                                        <?php echo $planlist['plan_name'];?>
                                    </h3>
                                    <p>
                                        You can upload upto <?php echo $planlist['image_limit'];?> images
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-cart-outline"></i>
                                </div>
                                <a class="small-box-footer">
                                    <input type="radio" value="<?php echo $planlist['id'];?>" name="selected_package" required /> <?php echo $planlist['plan_price'] == '0.00' ? "Free" : "$".$planlist['plan_price'];?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <div class="footer">                    

                    <button type="submit" class="btn bg-olive btn-block">Payment <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>
        </div>
        
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/bootstrap.min.js" type="text/javascript"></script>
		
        <script type="text/javascript">
            jQuery('#planSelect').submit(function(){
                var actionval = jQuery(this).attr("action");
                actionval = actionval + jQuery("input[name='selected_package']:checked").val();
                jQuery(this).attr("action", actionval);
                return true;
            })
        </script>
    </body>
</html>