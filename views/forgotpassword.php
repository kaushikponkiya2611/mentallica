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
        <!-- Ionicons -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Forgot Password</div>
            <form action="" method="post">
                <div class="body bg-gray">
                	<?php
                        unset($_SESSION['po_userses']['p_register_user']);
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
                    <div class="callout callout-info">
                        <p>Enter your email id, we will send you temporary password through your email id.</p>
                    </div>
                    <div class="form-group">
                        <input type="email" name="f_p_emailid" class="form-control" placeholder="Email ID" required />
                    </div>
                </div>
                <div class="footer">           
                    <button type="submit" class="btn bg-olive btn-block">Submit <i class="fa fa-arrow-circle-right"></i></button>
                </div>
            </form>

            <!--<div class="margin text-center">
                <span>Register using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
        </div>

        <script type="text/javascript">
            var site_url = "<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>";
        </script>
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>views/javascripts/register.js" type="text/javascript"></script>
		
    </body>
</html>