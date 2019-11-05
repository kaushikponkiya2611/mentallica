<?php
ob_start();
session_start();
/* $reff =  $_SERVER['HTTP_REFERER'];
  $domain =  get_domain($reff); */

if (isset($_GET['found']) && $_GET['found'] == 0) {
    $arr = "Email address is invalid!";
} else {
    require('controllers/paypal-login-controller.php');
    if(isset($_SESSION['verifyEmail']) && $_SESSION['verifyEmail']!=''){
        $email = $_SESSION['verifyEmail'];
        //echo "select * from tbl_users WHERE emailid = '$email' and status='1'";die;
        if(isset($_GET['str_var']) && $_GET['str_var']!=''){
            $arr = unserialize(base64_decode($_GET['str_var']));
        }
       
        include('models/db.php');
        include('models/common-model.php');
        include('controllers/common-controller.php');
        $database = new Connection();
        include('models/ajax-model.php');
        $modelObj = new AjaxModel();
        $commoncont = new CommonController();
        $qry="SELECT * FROM tbl_users WHERE emailid = '$email' and status='1'";
        $result = $modelObj->fetchRow($qry); 
        if($result['address']=='' || $result['address']==NULL){
            $country = $arr['country'];
            $region = $arr['region'];
            $city = $arr['city'];
            $postal_code = $arr['postal_code'];
            $street_address = $arr['address'];
            $address = $street_address.", ".$city.",".$region.",".$country.",".$postal_code;
            $qry1 = "UPDATE  tbl_users  SET address='".$address."' WHERE emailid = '".$email."' ";
            $result = $modelObj->runQuery($qry1);
        }
    }else{
        $email = $_GET['email'];
    }
    $obj = new PaypalLoginController();
    $result = $obj->_payapcheckuser($email);

    $_SESSION['po_userses']['flc_usrlogin_id'] = $result['id'];
    $_SESSION['po_userses']['flc_usrlogin_ref_id'] = $result['ref_id'];
    $_SESSION['po_userses']['flc_usrlogin_first_nm'] = $result['first_name'];
    $_SESSION['po_userses']['flc_usrlogin_last_nm'] = $result['last_name'];
    $_SESSION['po_userses']['flc_usrlogin_email'] = $result['emailid'];
    $userthumb = $_SESSION['SITE_IMG_PATH'] . "artist/thumb/" . $result['image'];


    if ($result['image'] != '' && is_file($userthumb)):
        $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/thumb/" . $result['image'];
    else:
        $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/default_profile_pic.jpg";
    endif;
    $_SESSION['po_userses']['flc_usrlogin_type'] = $result['usertype'];
    $_SESSION['po_userses']['flc_usrlogin_type_word'] = $result['usertype'] == 1 ? "Artist" : ( $result['usertype'] == 2 ? "Client" : ($result['usertype'] == 3 ? "Company" : ""));
    $_SESSION['po_userses']['flc_usrlogin_plan'] = $result['plan_id'];
    setcookie("rem_emailid", $_GET["email"], time() + 60 * 60 * 24 * 30, "/");
    $vl = "yes";
    setcookie('userlogin', $vl, time()+ 60 * 60 * 24 * 365, '/');
    setcookie("rem_pwd", '1', time() + 60 * 60 * 24 * 30, "/");
    ?>
    <script>
        top.window.opener.location = '<?php echo "https://mentallica.com/projectone/profile/"; ?>';
        close();
    </script>
    <?php
}
?>
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <style>
            .container.register-paypal {
                padding-top: 50px;

            }
            body {
                background: #212529;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div class="container register-paypal">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!--                        <div class="card-header card text-white bg-warning mb-3"> 
                                                    <h5>REGISTER</h5>
                                                </div>-->
                        <div class="card-body">
                            <?php echo "Email address is invalid!" ?>

                            <script src='https://www.paypalobjects.com/js/external/api.js'></script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                            <span id='lippButton'></span>
                            <script>
                                paypal.use(['login'], function (login) {
                                    login.render({
                                        "appid": "AZ0nso7i6EVXLMwGxurnK0M_ZJDN2W4zAPIN6Y2yVmp9NKqkkuOrgHBpKTyN4AzjI3EDcBfjbycxCjWm",
                                        "scopes": "openid profile address email",
                                        "containerid": "lippButton",
                                        "locale": "en-us",
                                        "returnurl": "https://www.mentallica.com/projectone/login-paypal.php"
                                    });
                                });
                            </script>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <!-- Material unchecked -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script>
    $('document').ready(function () {
        $("retry_to_connect").click(function () {
            $("#lippButton").trigger("click");
        });
        $(".register_form").submit(function () {
            // alert();return false;
            $.ajax({
                url: "<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>controllers/ajax_controller/paypallogin-ajax-controller.php",
                type: 'post',
                dataType: "json",
                data: {
                    action: "register_with_paypal",
                    register: $(".register_form").serialize(),
                },
                success: function (result)
                {

                    if (result.msg == 'success') {
                        top.window.opener.location = '<?php echo "https://mentallica.com/projectone/profile/"; ?>';
                        close();

                    } else {
                        alert(result.msg);
                        return false;

                    }
                }
            });
            return false;
            /* $.ajax({
             method: "POST",
             url: "<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>controllers/ajax_controller/paypallogin-ajax-controller.php",
             data: {
             action: "register_with_paypal", 
             register: $(".register_form").serialize(),
             }
             }).done(function (data) {
             
             
             
             //$(".img-to-zoom").zoom({on: 'click'});
             });
             return false;*/
        });
    });
        </script>
    </body>
</html>



<?php
die;
/*
  require('controllers/paypal-login-controller.php');
  $obj = new PaypalLoginController();
  $result = $obj->_payapcheckuser($_GET["email"]);

  $_SESSION['po_userses']['flc_usrlogin_id'] = $result['id'];
  $_SESSION['po_userses']['flc_usrlogin_ref_id'] = $result['ref_id'];
  $_SESSION['po_userses']['flc_usrlogin_first_nm'] = $result['first_name'];
  $_SESSION['po_userses']['flc_usrlogin_last_nm'] = $result['last_name'];
  $_SESSION['po_userses']['flc_usrlogin_email'] = $result['emailid'];
  $userthumb = $_SESSION['SITE_IMG_PATH'] . "artist/thumb/" . $result['image'];
  if ($result['image'] != '' && is_file($userthumb)):
  $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/thumb/" . $result['image'];
  else:
  $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/default_profile_pic.jpg";
  endif;
  $_SESSION['po_userses']['flc_usrlogin_type'] = $result['usertype'];
  $_SESSION['po_userses']['flc_usrlogin_type_word'] = $result['usertype'] == 1 ? "Artist" : ( $result['usertype'] == 2 ? "Client" : ($result['usertype'] == 3 ? "Company" : ""));
  $_SESSION['po_userses']['flc_usrlogin_plan'] = $result['plan_id'];
  setcookie("rem_emailid", $_GET["email"], time() + 60 * 60 * 24 * 30 ,"/");
  setcookie("rem_pwd", '1', time() + 60 * 60 * 24 * 30,"/");

 */
?>
<script>

    //top.window.opener.location = '<?php echo "https://mentallica.com/projectone/profile/"; ?>';
    // close();
</script>
<?php
/* if($domain == 'paypal.com'){ 


  require('controllers/paypal-login-controller.php');
  $obj = new PaypalLoginController();
  $result = $obj->_payapcheckuser($_GET["email"]);

  $_SESSION['po_userses']['flc_usrlogin_id'] = $result['id'];
  $_SESSION['po_userses']['flc_usrlogin_ref_id'] = $result['ref_id'];
  $_SESSION['po_userses']['flc_usrlogin_first_nm'] = $result['first_name'];
  $_SESSION['po_userses']['flc_usrlogin_last_nm'] = $result['last_name'];
  $_SESSION['po_userses']['flc_usrlogin_email'] = $result['emailid'];
  $userthumb = $_SESSION['SITE_IMG_PATH'] . "artist/thumb/" . $result['image'];
  if ($result['image'] != '' && is_file($userthumb)):
  $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/thumb/" . $result['image'];
  else:
  $_SESSION['po_userses']['flc_usrlogin_image'] = $_SESSION['SITE_NAME'] . "upload/artist/default_profile_pic.jpg";
  endif;
  $_SESSION['po_userses']['flc_usrlogin_type'] = $result['usertype'];
  $_SESSION['po_userses']['flc_usrlogin_type_word'] = $result['usertype'] == 1 ? "Artist" : ( $result['usertype'] == 2 ? "Client" : ($result['usertype'] == 3 ? "Company" : ""));
  $_SESSION['po_userses']['flc_usrlogin_plan'] = $result['plan_id'];
  setcookie("rem_emailid", $_GET["email"], time() + 60 * 60 * 24 * 30 ,"/");
  setcookie("rem_pwd", '1', time() + 60 * 60 * 24 * 30,"/");

  ?>
  <script>

  top.window.opener.location = '<?php echo "https://mentallica.com/projectone/profile/"; ?>';
  close();
  </script>
  <?php
  }else{
  echo 'Login failed!! Please try again';
  } */

function get_domain($url) {
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}
?>
