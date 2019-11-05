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
            <div class="header">Enter card details</div>
            <form action="" method="post">
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
                        <select name="pay_card_type" class="form-control" required>
                            <option value="visa">Visa</option>
                            <option value="mastercard">MasterCard</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="pay_card_number" class="form-control" placeholder="Card Number" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="pay_nm_on_card" class="form-control" placeholder="Name on Card" required />
                    </div>
                    <div class="form-group">
                        <select name="pay_month" class="form-control" required>
                            <option value="">Expiry Month</option>
                            <?php for($ic = 1; $ic <= 12; $ic++):?>
                                <option value="<?php echo sprintf('%02d', $ic);?>"><?php echo sprintf('%02d', $ic);?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="pay_year" class="form-control" required>
                            <option value="">Expiry Year</option>
                            <?php for($ic = date("Y"); $ic <= date("Y")+20; $ic++):?>
                                <option value="<?php echo $ic;?>"><?php echo $ic;?></option>
                            <?php endfor; ?>
                        </select>
                    </div> 
                    <div class="form-group">
                        <input type="text" name="pay_cvv" class="form-control" placeholder="CVV Number" required />
                    </div>     
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="text" class="form-control" value="<?php echo $controller_class -> validplan['plan_price'];?>" disabled="" />
                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    </div>
                </div>
                <div class="footer">                    

                    <button type="submit" class="btn bg-olive btn-block">Pay &nbsp;<i class="fa fa-arrow-circle-right"></i></button>
                    <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>plans/" class="btn bg-olive btn-block"><i class="fa fa-arrow-circle-left"></i> Change Package</a>

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

        <?php include('footernew.php'); ?>
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/bootstrap.min.js" type="text/javascript"></script>
		
    </body>
</html>