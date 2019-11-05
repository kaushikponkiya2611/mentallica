<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $controller_class->pageTitle ?> | Mentallica</title>
        <link rel="icon" type="image/png" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] ?>img/siteicon/1430042965_131514.ico">

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <?php
            //echo "<pre>";
            //print_r($_REQUEST);
            //echo $_REQUEST['code'];

            $strGetValue = $_REQUEST['code'];
            $strGetCodePaypalLoginDetails = $strGetValue;

            if ($strGetCodePaypalLoginDetails != '') {
                // Change this curl_init url according to your environment.
                $ch = curl_init("https://api.sandbox.paypal.com/v1/identity/openidconnect/tokenservice");
                $flag_result = 1;
                curl_setopt_array($ch, array(
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => 'client_id=AZcLHoXoSPV6C78ZJ7pAPy1Il635Fp2Qe1JTanmM7H6LAHFGKFxQv_SOA4xYmraHI3A7AwEiylXvzMDt&client_secret=EG-22-0tQUu_nqsPDUVb4ROVzgz97gohZq6stuNbjyLadYtQSA14NAvohx6FZxsIPNcO6aJVOzwh9WRU&grant_type=authorization_code&code=' . $strGetCodePaypalLoginDetails,
                    CURLOPT_RETURNTRANSFER => 1
                        )
                );

                $arrResponse = curl_exec($ch);

                if ($arrResponse === false) {
                    $arrResponseToken = 'Curl error: ' . curl_error($ch);
                    $flag_result = 0;
                } else {

                    //Operation completed without any errors
                    $arrResponse = json_decode($arrResponse);
                    $strAccess_Token = $arrResponse->{'access_token'};

                    // Change this curl_init url according to your environment.
                    $chToken = curl_init("https://api.sandbox.paypal.com/v1/identity/openidconnect/userinfo/?schema=openid&access_token=" . $strAccess_Token);

                    curl_setopt_array($chToken, array(
                        CURLOPT_RETURNTRANSFER => 1
                            )
                    );

                    $arrResponseToken = curl_exec($chToken);

                    if ($arrResponseToken === false) {
                        $arrResponseToken = 'Curl error: ' . curl_error($chToken);
                        $flag_result = 0;
                    }
                    
                    print_r($arrResponseToken);
                }
            }
            ?>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>