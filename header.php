<?php /* ?><header class="header">
  <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>home/" class="logo">
  <!-- Add the class icon to your logo image or logo icon to add the margining -->
  ProjectName
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </a>
  <div class="navbar-right">
  <ul class="nav navbar-nav">
  <!-- Messages: style can be found in dropdown.less-->

  <!-- User Account: style can be found in dropdown.less -->
  <li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="glyphicon glyphicon-user"></i>
  <span><?php echo $_SESSION['po_userses']['flc_usrlogin_first_nm']." ".$_SESSION['po_userses']['flc_usrlogin_last_nm'];?> <i class="caret"></i></span>
  </a>
  <ul class="dropdown-menu">
  <!-- User image -->
  <li class="user-header bg-light-blue">
  <img src="<?php echo $_SESSION['po_userses']['flc_usrlogin_image'];?>" class="img-circle" alt="User Image" />
  <p>
  <?php echo $_SESSION['po_userses']['flc_usrlogin_first_nm']." ".$_SESSION['po_userses']['flc_usrlogin_last_nm'];?> - <?php echo $_SESSION['po_userses']['flc_usrlogin_type_word']; ?>
  <small>Member since Nov. 2012</small>
  </p>
  </li>
  <!-- Menu Body -->
  <!--<li class="user-body">
  <div class="col-xs-4 text-center">
  <a href="#">Followers</a>
  </div>
  <div class="col-xs-4 text-center">
  <a href="#">Sales</a>
  </div>
  <div class="col-xs-4 text-center">
  <a href="#">Friends</a>
  </div>
  </li>-->
  <!-- Menu Footer-->
  <li class="user-footer">
  <div class="pull-left">
  <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>profile/" class="btn btn-default btn-flat">Profile</a>
  </div>
  <div class="pull-right">
  <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>logout/" class="btn btn-default btn-flat">Sign out</a>
  </div>
  </li>
  </ul>
  </li>
  </ul>
  </div>
  </nav>
  </header><?php */ ?>
<?php
$promocodedetail = array();
if (isset($_REQUEST['workid'])) {
    $promocodedetail = $controller_class->checkPromocode($_REQUEST['workid']);
    if ($promocodedetail['user_type'] == 1) {
        ?>
        <script>
            $(document).ready(function () {
                $('a[href="#inline-pop-register-artist"]').click();
            });
        </script>
        <?php
    }
}
if ($forembed == "") {
    ?>
    <script src='https://www.paypalobjects.com/js/external/api.js'></script>
    <div class="header-main header-main-sub">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-main">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 logo_top">
                                <div class="navbar-brand-main">
                                    <a class="navbar-brand" href="#"><img src="<?php echo $_SESSION['SITE_NAME']; ?>img/mentallica-logo.png" alt="logo" /></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>


                        </div>

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse navbar-menubuilder data_left_menu">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>">Home</a></li>
                                <?php if ($_SESSION['po_userses']['flc_usrlogin_type'] != 1): ?>
                                                <!--<li class=""><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>">About Us</a></li>-->
                                    <li class=""><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>">Artist</a></li>
                                    <li class=""><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>">Companies</a></li>
                                <?php endif; ?>



                                <?php if (isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != ''): ?>
                                <li class="user user-menu">
                                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>profile/">
                                        <i class="glyphicon glyphicon-user"></i>
                                        <span><?php echo $_SESSION['po_userses']['flc_usrlogin_first_nm'] . " " . $_SESSION['po_userses']['flc_usrlogin_last_nm'] . " - " . $_SESSION['po_userses']['flc_usrlogin_type_word']; ?> </span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if ($_SESSION['po_userses']['flc_usrlogin_type'] == 1): ?>
                                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>artistsimages">My Content</a></li>
                                    <?php
                                    //$prevss=$controller_class->getpreviewcategoriesfromother();

                                    $previewcategorylist = $controller_class->getcategorylistbyids($prevss['preview_category']);


                                    $previewcategories = array();
                                    foreach ($previewcategorylist as $k => $catlist) {
                                        $previewcategories[] = $catlist['id'];
                                    }
                                    ?>
                                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>preview/<?= $previewcategories[0] ?>">My Page</a></li>
                                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>imgupload">Upload</a></li>
                                  <!--  <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>radio">Make Radio Host</a></li>-->
                                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>newsletter">Newsletter</a></li>
                                    <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>chat">Chat</a></li>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != ''): ?>                                
                                    <li>
                                        <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>internetradio/">Internet Radio</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>logout/">Sign out</a>
                                    </li>
                                <?php else: ?>
                                    <li class="user-header">
                                        <a href="#inline-pop-select-user" class="fancybox">
                                            <span><b>SignIn</b></span>
                                        </a>
                                    </li>
                                    <li class="user-header">
                                        <a href="#inline-pop-select-user-register" class="fancybox">
                                            <span><b>Signup</b></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <button class="btn btn-primary btn-sm  follow-mentallica">Follow Mentallica</button>
                                </li>
                                <li>
                                    <span id='lippButton'></span>
                                    <script>
                                        paypal.use(['login'], function (login) {
                                            login.render({
                                                "appid": "AZ3Ox4HKvtXGfVmEmmV6H2cUiPVPXvDx0aGaYfsnWu1IvGRrK3cDWiMPlKc8JWKxeyH6h-0pC41eYWuO",
                                                "authend": "sandbox",
                                                "scopes": "openid email",
                                                "containerid": "lippButton",
                                                "locale": "en-us",
                                                "returnurl": "<?php echo $FRNT_DOMAIN_NAME; ?>paypal-login"
                                            });
                                        });
                                    </script>
                                </li>
                            </ul>
                            <div class="navbar-right">
                                <ul class="nav navbar-nav">


                                </ul>

                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="row">
                            <div class="col-sm-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div id="inline-pop-select-user" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Sign In</div>
        <form method="post" action="#">
            <div class="body bg-gray">
                <a href="#inline-pop-login-artist" class="btn btn-block btn-social btn-foursquare bg-yellow fancybox">
                    <i class="fa fa-foursquare"></i> Sign in as Artist
                </a>
                <a href="#inline-pop-login-client" class="btn btn-block btn-social btn-tumblr bg-red fancybox">
                    <i class="fa fa-foursquare"></i> Sign in as Client
                </a>
                <a href="#inline-pop-login-company" class="btn btn-block btn-social btn-github bg-blue fancybox">
                    <i class="fa fa-foursquare"></i> Sign in as Company
                </a>
            </div>
        </form>

        <!--<div class="margin text-center">
            <span>Sign in using social networks</span>
            <br/>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

        </div>-->
    </div>
</div>
<div id="inline-pop-radio-user" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Radio</div>
        Comming Soon !!!
    </div>
</div>
<div id="inline-pop-select-user-register" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Register</div>
        <form method="post" action="#">
            <div class="body bg-gray">
                <a href="#inline-pop-register-artist" class="btn btn-block btn-social btn-foursquare bg-yellow fancybox">
                    <i class="fa fa-foursquare"></i> Register as Artist
                </a>
                <a href="#inline-pop-register-client" class="btn btn-block btn-social btn-tumblr bg-red fancybox">
                    <i class="fa fa-foursquare"></i> Register as Client
                </a>
                <a href="#inline-pop-register-company" class="btn btn-block btn-social btn-github bg-blue fancybox">
                    <i class="fa fa-foursquare"></i> Register as Company
                </a>
            </div>
        </form>

        <!--<div class="margin text-center">
            <span>Sign in using social networks</span>
            <br/>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

        </div>-->
    </div>
</div>

<div id="inline-pop-login-artist" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Sign In - Artist</div>
        <script>
            $(function () {
                $('.hide-show').show();
                $('.hide-show span').addClass('show')

                $('.hide-show span').click(function () {
                    if ($(this).hasClass('show')) {
                        $(this).text('Hide');
                        $('input[name="u_password"]').attr('type', 'text');
                        $(this).removeClass('show');
                        $(this).addClass('hidecls');
                    } else {
                        $(this).text('Show');
                        $('input[name="u_password"]').attr('type', 'password');
                        $(this).addClass('show');
                    }
                });

                $('form button[type="submit"]').on('click', function () {
                    $('.hide-show span').text('Show').addClass('show');
                    $('.hide-show').parent().find('input[name="u_password"]').attr('type', 'password');
                });
            });
        </script>
        <style>
            .show {
                background: #000 none repeat scroll 0 0;
                left: 270px;
                padding: 8px;
                position: relative;
                top: -34px;
                width: 50px;
            }.hidecls {
                background: #000 none repeat scroll 0 0;
                left: 277px;
                padding: 8px;
                position: relative;
                top: -27px;
                width: 50px;
            }
        </style>
        <form method="post" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>login/artsit">
            <div class="body bg-yellow">
                <div class="form-group">
                    <input type="text" name="u_email_id" class="form-control" placeholder="Email ID" value="<?php if (isset($_COOKIE['rem_emailid']) && $_COOKIE['rem_emailid'] != '') echo $_COOKIE['rem_emailid'] ?>" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="u_password" class="form-control" placeholder="Password" value="<?php if (isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo $_COOKIE['rem_pwd'] ?>" required/><div class="hide-show">
                        <span>Show</span>
                    </div>
                </div>          
                <div class="form-group">
                    <input type="checkbox" name="remember_me" value="1" <?php if (isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo "checked='checked'" ?> /> Remember me
                </div>
            </div>
            <div class="footer">                                                               
                <button class="btn bg-olive btn-block" type="submit">Sign me in</button>  
                <a href="#inline-pop-select-user" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fbresponse/artist" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>

                <p><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>forgotpassword/artist">I forgot my password</a></p>

                <a class="text-center fancybox" href="#inline-pop-register-artist">Register a new membership (Artist)</a>
            </div>
        </form>

        <!--<div class="margin text-center">
            <span>Sign in using social networks</span>
            <br/>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

        </div>-->
    </div>
</div>

<div id="inline-pop-login-client" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Sign In - Client</div>
        <script>
            $(function () {
                $('.hide-show').show();
                $('.hide-show span').addClass('show')

                $('.hide-show span').click(function () {
                    if ($(this).hasClass('show')) {
                        $(this).text('Hide');
                        $('input[name="u_password"]').attr('type', 'text');
                        $(this).removeClass('show');
                        $(this).addClass('hidecls');
                    } else {
                        $(this).text('Show');
                        $('input[name="u_password"]').attr('type', 'password');
                        $(this).addClass('show');
                    }
                });

                $('form button[type="submit"]').on('click', function () {
                    $('.hide-show span').text('Show').addClass('show');
                    $('.hide-show').parent().find('input[name="u_password"]').attr('type', 'password');
                });
            });
        </script>
        <style>
            .show {
                background: #000 none repeat scroll 0 0;
                left: 270px;
                padding: 8px;
                position: relative;
                top: -34px;
                width: 50px;
            }.hidecls {
                background: #000 none repeat scroll 0 0;
                left: 277px;
                padding: 8px;
                position: relative;
                top: -27px;
                width: 50px;
            }
        </style>
        <form method="post" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>login/client">
            <div class="body bg-red">
                <div class="form-group">
                    <input type="text" name="u_email_id" class="form-control" placeholder="Email ID" value="<?php if (isset($_COOKIE['rem_emailid']) && $_COOKIE['rem_emailid'] != '') echo $_COOKIE['rem_emailid'] ?>" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="u_password" class="form-control" placeholder="Password" value="<?php if (isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo $_COOKIE['rem_pwd'] ?>" required/><div class="hide-show">
                        <span>Show</span>
                    </div>

                </div>          
                <div class="form-group">
                    <input type="checkbox" name="remember_me" value="1" <?php if (isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo "checked='checked'" ?> /> Remember me
                </div>
            </div>
            <div class="footer">                                                               
                <button class="btn bg-olive btn-block" type="submit">Sign me in</button>    
                <a href="#inline-pop-select-user" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fbresponse/client" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>

                <p><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>forgotpassword/client">I forgot my password</a></p>

                <a class="text-center fancybox" href="#inline-pop-register-client">Register a new membership (Client)</a>
            </div>
        </form>

        <!--<div class="margin text-center">
            <span>Sign in using social networks</span>
            <br/>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

        </div>-->
    </div>
</div>

<div id="inline-pop-login-company" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Sign In - Company</div>
        <script>
            $(function () {
                $('.hide-show').show();
                $('.hide-show span').addClass('show')

                $('.hide-show span').click(function () {
                    if ($(this).hasClass('show')) {
                        $(this).text('Hide');
                        $('input[name="u_password"]').attr('type', 'text');
                        $(this).removeClass('show');
                        $(this).addClass('hidecls');
                    } else {
                        $(this).text('Show');
                        $('input[name="u_password"]').attr('type', 'password');
                        $(this).addClass('show');
                    }
                });

                $('form button[type="submit"]').on('click', function () {
                    $('.hide-show span').text('Show').addClass('show');
                    $('.hide-show').parent().find('input[name="u_password"]').attr('type', 'password');
                });
            });
        </script>
        <style>
            .show {
                background: #000 none repeat scroll 0 0;
                left: 270px;
                padding: 8px;
                position: relative;
                top: -34px;
                width: 50px;
            }.hidecls {
                background: #000 none repeat scroll 0 0;
                left: 277px;
                padding: 8px;
                position: relative;
                top: -27px;
                width: 50px;
            }
        </style>
        <form method="post" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>login/company">
            <div class="body bg-blue">
                <div class="form-group">
                    <input type="text" name="u_email_id" class="form-control" placeholder="Email ID" value="<?php if (isset($_COOKIE['rem_emailid']) && $_COOKIE['rem_emailid'] != '') echo $_COOKIE['rem_emailid'] ?>" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="u_password" class="form-control" placeholder="Password" value="<?php if (isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo $_COOKIE['rem_pwd'] ?>" required/>
                    <div class="hide-show">
                        <span>Show</span>
                    </div>
                </div>       
                <div class="form-group">
                    <input type="checkbox" name="remember_me" value="1" <?php if (isset($_COOKIE['rem_pwd']) && $_COOKIE['rem_pwd'] != '') echo "checked='checked'" ?> /> Remember me
                </div>
            </div>
            <div class="footer">                                                               
                <button class="btn bg-olive btn-block" type="submit">Sign me in</button>    
                <a href="#inline-pop-select-user" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fbresponse/company" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>

                <p><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>forgotpassword/company">I forgot my password</a></p>

                <a class="text-center fancybox" href="#inline-pop-register-company">Register a new membership (Company)</a>
            </div>
        </form>

        <!--<div class="margin text-center">
            <span>Sign in using social networks</span>
            <br/>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

        </div>-->
    </div>
</div>

<div id="inline-pop-register-artist" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Register - Artist</div>
        <form method="post" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>register/artist">
            <div class="body bg-yellow">
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
                <?php
                if ($promocodedetail['promocode'] != '') {
                    ?>
                    <div class="form-group">
                        <input type="email" name="u_r_emailid" class="form-control" placeholder="Email ID" required value="<?php echo $promocodedetail['email_address']; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <input type="text" name="u_r_promocode" id="u_r_promocode" class="form-control" placeholder="Promo Code" value="<?php echo $promocodedetail['promocode']; ?>" readonly />
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="form-group">
                        <input type="email" name="u_r_emailid" class="form-control" placeholder="Email ID" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="u_r_promocode" id="u_r_promocode" class="form-control" placeholder="Promo Code" />
                    </div>
                    <?php
                }
                ?>
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
                    <textarea required="" placeholder="Address" class="form-control" name="u_r_address"></textarea>
                </div>-->
                <div class="form-group">
                    <select name="u_r_country" id="u_r_country_artist" class="form-control" required>
                        <option value="">Select Country</option>
                        <?php
                        $allcountry = $controller_class->getAllCountryList();
                        foreach ($allcountry as $key => $countrylist) :
                            ?>
                            <option value="<?php echo $countrylist['id']; ?>"><?php echo $countrylist['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="u_r_state" id="u_r_state_artist" class="form-control" required>
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="u_r_city" id="u_r_city" class="form-control" required>
                        <option value="">Select City</option>
                    </select>
                </div>     
                <div class="form-group">
                    <input type="checkbox" name="confirm_details" value="1" /> YOU MUST COMPLETE YOUR PERSONAL INFORMATION IN YOUR PERSONAL PAGE TO BE FULLY REACHABLE ONCE YOU SIGN-IN, PLEASE DO NOT FORGET TO UPDATE THIS INFORMATION.
                </div>
            </div>
            <div class="footer">                    

                <!--<button type="submit" class="btn bg-olive btn-block">Select package <i class="fa fa-arrow-circle-right"></i></button>-->
                <button class="btn bg-olive btn-block" type="submit">Sign up <i class="fa fa-arrow-circle-right"></i></button> 
                <a href="#inline-pop-select-user-register" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fbresponse/artist" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>

                <a class="text-center fancybox" href="#inline-pop-login-artist">I already have a membership</a>
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
</div>

<div id="inline-pop-register-client" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Register - Client</div>
        <form method="post" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>register/client">
            <div class="body bg-red">
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
                    <textarea required="" placeholder="Address" class="form-control" name="u_r_address"></textarea>
                </div>-->
                <div class="form-group">
                    <select name="u_r_country" id="u_r_country_client" class="form-control" required>
                        <option value="">Select Country</option>
                        <?php
                        $allcountry = $controller_class->getAllCountryList();
                        foreach ($allcountry as $key => $countrylist) :
                            ?>
                            <option value="<?php echo $countrylist['id']; ?>"><?php echo $countrylist['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group statelistclientwrap" style="display: none;">
                    <select name="u_r_state" id="u_r_state_client" class="form-control" required>
                        <option value="">Select State</option>
                    </select>
                </div>
                <!--<div class="form-group">
                   <select name="u_r_city" id="u_r_city" class="form-control" required>
                        <option value="">Select City</option>
                    </select>
                </div>-->      
                <div class="form-group">
                    <input type="checkbox" name="confirm_details" value="1" /> YOU MUST COMPLETE YOUR PERSONAL INFORMATION IN YOUR PERSONAL PAGE TO BE FULLY REACHABLE ONCE YOU SIGN-IN, PLEASE DO NOT FORGET TO UPDATE THIS INFORMATION.
                </div>
            </div>
            <div class="footer">                    

                <!--<button type="submit" class="btn bg-olive btn-block">Select package <i class="fa fa-arrow-circle-right"></i></button>-->
                <button class="btn bg-olive btn-block" type="submit">Sign up <i class="fa fa-arrow-circle-right"></i></button>
                <a href="#inline-pop-select-user-register" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fbresponse/client" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>

                <a class="text-center fancybox" href="#inline-pop-login-client">I already have a membership</a>
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
</div>

<div id="inline-pop-register-company" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Register - Company</div>
        <form method="post" action="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>register/company">
            <div class="body bg-blue">
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
                    <textarea required="" placeholder="Address" class="form-control" name="u_r_address"></textarea>
                </div>-->
                <div class="form-group">
                    <select name="u_r_country" id="u_r_country_company" class="form-control" required>
                        <option value="">Select Country</option>
                        <?php
                        $allcountry = $controller_class->getAllCountryList();
                        foreach ($allcountry as $key => $countrylist) :
                            ?>
                            <option value="<?php echo $countrylist['id']; ?>"><?php echo $countrylist['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group statelistcompanywrap" style="display: none;">
                    <select name="u_r_state" id="u_r_state_company" class="form-control" required>
                        <option value="">Select State</option>
                    </select>
                </div>
                <!--<div class="form-group">
                    <select name="u_r_state" id="u_r_state" class="form-control" required>
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="form-group">
                   <select name="u_r_city" id="u_r_city" class="form-control" required>
                        <option value="">Select City</option>
                    </select>
                </div>-->      
                <div class="form-group">
                    <input type="checkbox" name="confirm_details" value="1" /> YOU MUST COMPLETE YOUR PERSONAL INFORMATION IN YOUR PERSONAL PAGE TO BE FULLY REACHABLE ONCE YOU SIGN-IN, PLEASE DO NOT FORGET TO UPDATE THIS INFORMATION.
                </div>
            </div>
            <div class="footer">                    

                <!--<button type="submit" class="btn bg-olive btn-block">Select package <i class="fa fa-arrow-circle-right"></i></button>-->
                <button class="btn bg-olive btn-block" type="submit">Sign up <i class="fa fa-arrow-circle-right"></i></button>
                <a href="#inline-pop-select-user-register" class="btn bg-olive btn-block fancybox">
                    <i class="fa fa-arrow-circle-left"></i> Change User Type</a>

                <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fbresponse/company" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>

                <a class="text-center fancybox" href="#inline-pop-login-company">I already have a membership</a>
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
</div>
<a href="#inline-pop-follow-mentallica" class="fancybox" id="follow-mentallica-popup"></a>
<div id="inline-pop-follow-mentallica" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Follow Mentallica</div>
        <form method="post" action="" id="form-follow-mentallica" onsubmit="return submitFollowerForm()">
            <div class="body bg-yellow">
                <div class="form-group">
                    <input type="email" name="gst_email_id" id="gst_email_id" class="form-control" placeholder="Enter your Email Id" required/>
                </div>
            </div>
            <div class="footer">                                                               
                <button class="btn bg-olive btn-block" type="submit">Follow Mentallica</button>  
            </div>
        </form>
    </div>
</div>
<a href="#inline-pop-follow-mentallica-artist" class="fancybox" id="follow-mentallica-artist-popup"></a>
<div id="inline-pop-follow-mentallica-artist" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Follow Mentallica</div>
        <form method="post" action="" id="form-follow-mentallica-artist" onsubmit="return submitArtistFollowerForm()">
            <div class="body bg-yellow">
                <div class="form-group">
                    <input type="email" name="gst_fa_email_id" id="gst_fa_email_id" class="form-control" placeholder="Enter your Email Id" required/>
                </div>
            </div>
            <div class="footer">                                                               
                <button class="btn bg-olive btn-block" type="submit">Follow Mentallica</button>  
            </div>
        </form>
    </div>
</div>



<a href="#inline-pop-payment-mentallica-artist" class="fancybox" id="payment-mentallica-artist-popup"></a>
<div id="inline-pop-payment-mentallica-artist" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Sponsor Artist</div>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <?php
            $userdetails = $controller_class->getuserdetailfromusername($_REQUEST['workid']);
            ?>
            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="<?php echo $userdetails['paypal_email_id']; ?>">

            <!-- Specify a Buy Now button. -->
            <input type="hidden" name="cmd" value="_xclick">

            <!-- Specify details about the item that buyers will purchase. -->
            <input type="hidden" name="item_name" value="Artist Donate">

            <div class="body bg-yellow">
                <div class="form-group">
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter your Amount" required/>
                </div>
            </div>
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="item_number" value="<?php echo $_REQUEST['workid']; ?>">

            <!-- Provide a drop-down menu option field. -->
            <input type="hidden" name="on0" value="Type">
            <input type='hidden' name='cancel_return' value='<?php echo $FRNT_DOMAIN_NAME; ?>cancel'>
            <input type='hidden' name='return' value='<?php echo $FRNT_DOMAIN_NAME; ?>paypal/paypal_success.php'>

            <!-- Display the payment button. -->
            <input type="image" name="submit" border="0" class="btn bg-olive btn-block" alt="Buy Now">

            <img alt="" border="0" width="1" height="1"
                 src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

        </form> 
    </div>
</div>

<div id="inline-pop-chat-invitation-pending" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Pending</div>
        <div class="body">
            <div class="form-group">
                <p>Still artist has not accepted your chat invtation.</p>
            </div>
        </div>
    </div>
</div>

<a href="#inline-pop-activate-chat" class="fancybox" id="activate-chat-popup"></a>
<div id="inline-pop-activate-chat" style="max-width:900px;display: none;">
    <div id="login-box" class="form-box">
        <div class="header">Enter code to activate</div>
        <form method="post" action="" id="form-chat-accept-form" onsubmit="return acceptChatInvitationForm()">
            <div class="body bg-yellow">
                <div class="form-group">
                    <input type="text" name="gst_fa_invite_code" id="gst_fa_invite_code" class="form-control" placeholder="Enter code" required/>
                </div>
            </div>
            <input type="hidden" name="hid_chatdata" id="hid_chatdata" />
            <div class="footer">                                                               
                <button class="btn bg-olive btn-block" type="submit">Start Chat</button>  
            </div>
        </form>
    </div>
</div>


<a href="#add-new-artist-song" class="fancybox" id="add-artist-song"></a>
<div id="add-new-artist-song" style="width:500px;display: none;">


    <link rel="stylesheet" type="text/css" href="../admin/css/dropzone.css" />
                                            <!--<script type="text/javascript" src="../admin/js/dropzone.js"></script>-->
    <div class="image_upload_div">
        <form action="../upload.php" class="dropzone">
            <input type="hidden" name="userid" value="<?php echo $_SESSION['po_userses']['flc_usrlogin_id']; ?>">
        </form>

    </div>
</div>

<style type="text/css">
    .form-box{
        margin: 0;
    }
    .navbar-header {
        float: left;
        padding: 15px;
        text-align: center;
        width: 100%;
    }
    .navbar-brand {float:none;}
</style>
<style type="text/css">
    .navbar-collapse.in {
        overflow-y: inherit;
    }
    #custom-bootstrap-menu.navbar-default .navbar-brand {
        color: rgba(119, 119, 119, 1);
    }
    #custom-bootstrap-menu.navbar-default {
        font-size: 14px;
        background-color: rgba(248, 248, 248, 1);
        border-width: 1px;
        border-radius: 4px;
    }
    #custom-bootstrap-menu.navbar-default .navbar-nav>li>a {
        color: rgba(119, 119, 119, 1);
        background-color: rgba(248, 248, 248, 0);
    }
    #custom-bootstrap-menu.navbar-default .navbar-nav>li>a.active {
        color: rgba(85, 85, 85, 1);
        background-color: rgba(231, 231, 231, 1);
    }
    #custom-bootstrap-menu.navbar-default .navbar-nav>li>a:hover,
    #custom-bootstrap-menu.navbar-default .navbar-nav>li>a:focus {
        color: rgba(51, 51, 51, 1);
        background-color: rgba(248, 248, 248, 0);
    }
    #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a,
    #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:hover,
    #custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:focus {
        color: rgba(85, 85, 85, 1);
        background-color: rgba(231, 231, 231, 1);
    }
    #custom-bootstrap-menu.navbar-default .navbar-toggle {
        border-color: #ddd;
    }
    #custom-bootstrap-menu.navbar-default .navbar-toggle:hover,
    #custom-bootstrap-menu.navbar-default .navbar-toggle:focus {
        background-color: #ddd;
    }
    #custom-bootstrap-menu.navbar-default .navbar-toggle .icon-bar {
        background-color: #888;
    }
    #custom-bootstrap-menu.navbar-default .navbar-toggle:hover .icon-bar,
    #custom-bootstrap-menu.navbar-default .navbar-toggle:focus .icon-bar {
        background-color: #888;
    }
</style>
<script type="text/javascript">
    var refreshIntervalId = '';
    jQuery(document).ready(function () {

        var workid = '<?php echo isset($_GET["workid"]) ? $_GET["workid"] : ""; ?>';
        // Follow mentallica button event
        jQuery(".follow-mentallica").click(function () {
            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
                data: {followmentallicachk: "followmentallicachk"}
            })
                    .done(function (data) {
                        if (data.trim() == 4) {
                            alert("You are already following our Mentallica.")
                        } else if (data.trim() == 3) {
                            jQuery("#follow-mentallica-popup").click();
                        } else {
                            alert("Congratulations, now you are successfully following Mentallica.");
                        }
                    });
        });

        // Follow mentallica button event
        jQuery(".add-new-artist-songs").click(function () {
            jQuery("#add-artist-song").click();
        });

        // Follow mentallica artist button event
        jQuery(".follow-artist").click(function () {
            //alert(workid);
            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
                data: {followmentallicaartistchk: "followmentallicaartistchk", artistname: workid}
            })
                    .done(function (data) {
                        //alert(data);
                        if (data.trim() == 4) {
                            alert("You are already following this artist.")
                        } else if (data.trim() == 3) {
                            jQuery("#follow-mentallica-artist-popup").click();
                        } else {
                            alert("Congratulations, now you are successfully following this artist.");
                        }
                    });
        });



        // Follow mentallica artist button event
        jQuery(".payment-artist").click(function () {
            //alert(workid);
            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
                data: {paymentcheckartist: "paymentcheckartist", artistname: workid}
            })
                    .done(function (data) {
                        //alert(data);
                        jQuery("#payment-mentallica-artist-popup").click();

                    });
        });

        // Follow mentallica artist button event
        jQuery(".chat-invite").click(function () {
            //alert(workid);
            jQuery(".chat-invite").hide();
            $.ajax({
                method: "POST",
                url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
                data: {chatinvitechk: "chatinvitechk", artistname: workid}
            })
                    .done(function (data) {
                        //console.log(data);
                        if (data.trim() == 3) {
                            jQuery(".chat-invite").show();
                            alert("Some error occured while inviting this artist to chat, please try again later.");
                        } else {
                            location.reload();
                        }
                    });
        });

    });

    // Follow mentallica form submit event
    function submitFollowerForm() {
        var values = {};
        $.each($('#form-follow-mentallica').serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        //alert(123);
        var gstEmailId = values['gst_email_id'];
        $.ajax({
            method: "POST",
            url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
            data: {followmentallicachk: "followmentallicachk", followmentallicaguestemail: gstEmailId}
        })
                .done(function (data) {
                    //alert(data);
                    if (data.trim() == 4) {
                        alert("You are already following Mentallica.")
                    } else if (data.trim() == 3) {
                        jQuery("#follow-mentallica-popup").click();
                    } else {
                        alert("Congratulations, now you are successfully following Mentallica.");
                    }
                    $("#gst_email_id").val("");
                    $.fancybox.close();
                });

        return false;
    }

    // Follow mentallica artist form submit event
    function submitArtistFollowerForm() {
        var workid = '<?php echo isset($_GET["workid"]) ? $_GET["workid"] : ""; ?>';
        var values = {};
        $.each($('#form-follow-mentallica-artist').serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        //alert(123);
        var gstEmailId = values['gst_fa_email_id'];
        $.ajax({
            method: "POST",
            url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
            data: {followmentallicaartistchk: "followmentallicaartistchk", followmentallicaguestemail: gstEmailId, artistname: workid}
        })
                .done(function (data) {
                    //alert(data);
                    if (data.trim() == 4) {
                        alert("You are already following this artist.")
                    } else if (data.trim() == 3) {
                        jQuery("#follow-mentallica-popup").click();
                    } else {
                        alert("Congratulations, now you are successfully following this artist.");
                    }
                    $("#gst_fa_email_id").val("");
                    $.fancybox.close();
                });

        return false;
    }

    function acceptChatInvitationPopup(chatdata) {
        jQuery("#hid_chatdata").val(chatdata);
        jQuery("#activate-chat-popup").click();
    }

    // Follow mentallica artist form submit event
    function acceptChatInvitationForm() {

        var values = {};
        $.each($('#form-chat-accept-form').serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });

        var gstInviteCode = values['gst_fa_invite_code'];
        var chatdata = values['hid_chatdata'];
        $.ajax({
            method: "POST",
            url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
            data: {acceptchatinvitationchk: "acceptchatinvitationchk", chatInviteCode: gstInviteCode, chatdata: chatdata}
        }).done(function (data) {
            //alert(data);
            if (data.trim() == 4) {
                alert("You have entered invalid code, please try again with correct code.");
            } else if (data.trim() == 1) {
                location.reload();
            } else {
                alert("Some error occured, please try again later.");
            }
            $("#gst_fa_invite_code").val("");
            $.fancybox.close();
        });

        return false;
    }

    function openChatDetailInterval(chatdata) {
        var chatdata = chatdata;
        $.ajax({
            method: "POST",
            url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
            data: {getChatDetialIntervalchk: "getChatDetialIntervalchk", chatdata: chatdata}
        }).done(function (data) {
            if (data.trim() != '') {
                jQuery("#noChatMsg").hide();
                jQuery("#chat-box").html(data);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }

    function openChatDetail(chatdata) {
        var chatdata = chatdata;
        $.ajax({
            method: "POST",
            url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
            data: {getChatDetialScreenchk: "getChatDetialScreenchk", chatdata: chatdata}
        }).done(function (data) {
            if (data.trim() != '') {
                jQuery("#noChatMsg").hide();
                jQuery("#chatBoxContent").html(data);
                jQuery(".chatlicls").removeClass("active");
                jQuery("#chatli" + chatdata).addClass("active");
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

                jQuery("#newtextmessage").focus();

                // Open chat file browser
                jQuery(".chatAttachment").on("click", function () {
                    jQuery("#chat_attachment").click();
                });
                // Submit Chat File Form
                jQuery('#txt-add-chat').on('submit', (function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    jQuery.ajax({
                        type: 'POST',
                        url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log("success");
                            console.log(data);
                            openChatDetail(chatdata);
                        },
                        error: function (data) {
                            console.log("error");
                            console.log(data);
                            openChatDetail(chatdata);
                        }
                    });
                }));
                jQuery("#chat_attachment").on("change", function () {
                    jQuery("#txt-add-chat").submit();
                });
            }
            clearInterval(refreshIntervalId);
            refreshIntervalId = setInterval(function () {
                openChatDetailInterval(chatdata);
            }, 3000);
        });
    }

    // Adding new chat message
    function addNewChat() {

        var values = {};
        $.each($('#txt-add-chat').serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });

        var chatmessage = values['newtextmessage'];
        var chatdata = values['cur_chatdata'];
        $("#newtextmessage").val("");
        $.ajax({
            method: "POST",
            url: site_url + "controllers/ajax_controller/home-ajax-controller.php",
            data: {addnewchatchk: "addnewchatchk", chatmessage: chatmessage, chatdata: chatdata}
        }).done(function (data) {
            $("#newtextmessage").val("");
        });

        return false;
    }
</script>