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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
<!--            <div class="header">Sign In <?php echo $_GET['workid'] == 'artist' ? "- Artist" : ($_GET['workid'] == 'client' ? "- Client" : ($_GET['workid'] == 'company' ? "- Company" : ""));?></div>-->
            <form action="#" method="post">
                <div class="body <?php echo $_GET['workid'] == 'artist' ? "bg-yellow" : ($_GET['workid'] == 'client' ? "bg-red" : ($_GET['workid'] == 'company' ? "bg-blue" : "bg-grey"));?>">
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
                    <?php if(!isset($_GET['workid']) || $_GET['workid'] == '' || ($_GET['workid'] != 'artist' && $_GET['workid'] != 'client' && $_GET['workid'] != 'company')):?>
<!--                    <a class="btn btn-block btn-social btn-foursquare bg-yellow" href="<?php echo $_SESSION['SITE_NAME']."login/artist"?>">
                        <i class="fa fa-foursquare"></i> Sign in as Artist
                    </a>
                    <a class="btn btn-block btn-social btn-tumblr bg-red" href="<?php echo $_SESSION['SITE_NAME']."login/client"?>">
                        <i class="fa fa-foursquare"></i> Sign in as Client
                    </a>
                    <a class="btn btn-block btn-social btn-github bg-blue" href="<?php echo $_SESSION['SITE_NAME']."login/company"?>">
                        <i class="fa fa-foursquare"></i> Sign in as Company
                    </a>
                    <?php else: ?>
                    <div class="form-group">
                        <input type="text" name="u_email_id" class="form-control" placeholder="Email ID" value="<?php if(isset($_COOKIE['rem_emailid']) && $_COOKIE['rem_emailid'] != '') echo $_COOKIE['rem_emailid'] ?>" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="u_password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo $_COOKIE['rem_pwd'] ?>" required/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" value="1" <?php if(isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo "checked='checked'" ?> /> Remember me
                    </div>-->
                    <?php endif; ?>
                </div>
                <?php if(isset($_GET['workid']) && $_GET['workid'] != '' && ($_GET['workid'] == 'artist' || $_GET['workid'] == 'client' || $_GET['workid'] == 'company')):?>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>    
                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>login" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>
                    
                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>fbresponse/<?php echo $_GET['workid'];?>" class="btn btn-block btn-social btn-facebook">
                                        <i class="fa fa-facebook"></i> Sign in with Facebook
                                    </a>

                    <p><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>forgotpassword/<?php echo $_GET['workid'];?>">I forgot my password</a></p>
                    
                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>register/<?php echo $_GET['workid'];?>" class="text-center">Register a new membership (<?php echo ucfirst($_GET['workid']);?>)</a>
                </div>
                <?php endif; ?>
            </form>

            <!--<div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>