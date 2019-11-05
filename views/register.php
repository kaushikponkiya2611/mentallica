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
            <div class="header">Register <?php echo $_GET['workid'] == 'artist' ? "- Artist" : ($_GET['workid'] == 'client' ? "- Client" : ($_GET['workid'] == 'company' ? "- Company" : ""));?></div>
            <form action="" method="post">
                <div class="body <?php echo $_GET['workid'] == 'artist' ? "bg-yellow" : ($_GET['workid'] == 'client' ? "bg-red" : ($_GET['workid'] == 'company' ? "bg-blue" : "bg-grey"));?>">
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
                    <!--<div class="form-group">
                        <input type="text" name="u_r_first_name" class="form-control" placeholder="First name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="u_r_last_name" class="form-control" placeholder="Last name" required />
                    </div>-->
                    <div class="form-group">
                        <div class="col-xs-6 pd-right-5">
                            <input type="text" name="u_r_first_name" class="form-control" placeholder="First name" required />
                        </div>
                        <div class="col-xs-6 pd-left-5">
                            <input type="text" name="u_r_last_name" class="form-control" placeholder="Last name" required />
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="u_r_username" class="form-control" placeholder="Username" pattern="\S+" required />
                    </div>
                    <div class="form-group">
                        <input type="email" name="u_r_emailid" class="form-control" placeholder="Email ID" required />
                    </div>
                    <!--<div class="form-group">
                        <input type="password" name="u_r_password" class="form-control" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="u_r_password2" class="form-control" placeholder="Retype password" required />
                    </div>-->
                    <div class="form-group">
                        <div class="col-xs-6 pd-right-5">
                            <input type="password" name="u_r_password" class="form-control" placeholder="Password" required />
                        </div>
                        <div class="col-xs-6 pd-left-5">
                            <input type="password" name="u_r_password2" class="form-control" placeholder="Retype password" required />
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <!--<div class="form-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="u_r_gender" id="u_r_gender_male" value="male" checked />
                                Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="u_r_gender" id="u_r_gender_female" value="female" />
                                Female
                            </label>
                        </div>
                    </div>-->
                    <!--<div class="form-group">
                        <textarea name="u_r_address" class="form-control" placeholder="Address" required ></textarea>
                    </div>-->
<!--                    <div class="form-group">
                        <select name="u_r_country" id="u_r_country" class="form-control" required>
                            <option value="">Select Country</option>
                            <?php 
                            $allcountry = $controller_class -> getAllCountryList();
                            foreach ($allcountry as $key => $countrylist) :?>
                                <option value="<?php echo $countrylist['id'];?>"><?php echo $countrylist['name'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group statelistwrap" style="display: none;">
                        <select name="u_r_state" id="u_r_state" class="form-control" required>
                            <option value="">Select State</option>
                        </select>
                    </div>-->
<div class="form-group">
                        <textarea name="u_r_address" class="form-control" placeholder="Address" ></textarea>
                    </div>
                    <!--<div class="form-group">
                       <select name="u_r_city" id="u_r_city" class="form-control" required>
                            <option value="">Select City</option>
                        </select>
                    </div>-->      
                    <div class="form-group">
                        <input type="checkbox" name="confirm_details" value="1" required/> YOU MUST COMPLETE YOUR PERSONAL INFORMATION IN YOUR PERSONAL PAGE TO BE FULLY REACHABLE ONCE YOU SIGN-IN, PLEASE DO NOT FORGET TO UPDATE THIS INFORMATION.
                    </div>
                </div>
                <div class="footer">                    

                    <!--<button type="submit" class="btn bg-olive btn-block">Select package <i class="fa fa-arrow-circle-right"></i></button>-->
                    <button type="submit" class="btn bg-olive btn-block">Sign up <i class="fa fa-arrow-circle-right"></i></button>
                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>login" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>login/" class="text-center">I already have a membership</a>
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
		<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>views/javascripts/commonscript.js" type="text/javascript"></script>

    </body>
</html>