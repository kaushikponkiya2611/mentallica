<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/projectone/fblogin/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '955054594566304','7c28f1dcab07a874e6943e0f5cc78012' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://www.mentallica.com/projectone/index.php?pid=fbresponse&workid='.$_GET['workid'] );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?locale=en_US&fields=first_name,last_name,gender,birthday,email' );    
  $response = $request->execute();    
  // get response    
  $graphObject = $response->getGraphObject();    
  $fbid = $graphObject->getProperty('id');                  // To Get Facebook ID    
  $first_name = $graphObject->getProperty('first_name');    
  $last_name = $graphObject->getProperty('last_name');    
  $gender = $graphObject->getProperty('gender');    
  $birthday = $graphObject->getProperty('birthday');    

  $femail = $graphObject->getProperty('email');    
  // To Get Facebook email ID    
  /* ---- Session Variables -----*/    
  $_SESSION['fb_data']['FBID'] = $fbid;               
  $_SESSION['fb_data']['first_name'] = $first_name;    
  $_SESSION['fb_data']['last_name'] = $last_name;    
  $_SESSION['fb_data']['EMAIL'] =  $femail;    
  $_SESSION['fb_data']['gender'] =  $gender;    
  $_SESSION['fb_data']['birthday'] =  $birthday;

  if(isset($femail) && $femail != '' && isset($_SESSION['fb_data']['EMAIL']) && $_SESSION['fb_data']['EMAIL'] != ''):
      

      $usrtyp = $_GET['workid'] == 'artist' ? 1 : ($_GET['workid'] == 'client' ? 2 : ($_GET['workid'] == 'company' ? 3 : 1));
    
      $diduserfbidexist = $controller_class -> checkifuserfbidexist($_SESSION['fb_data']['FBID']);
      $diduserfbidexistbytype = $controller_class -> checkifuserfbidexistbytype($_SESSION['fb_data']['FBID'], $usrtyp);
      $didemailidexist = $controller_class -> checkifuseremailexistbytype($_SESSION['fb_data']['EMAIL'], $usrtyp);

      /*if($diduserfbidexist > 0):
        if($diduserfbidexistbytype > 0):
          $_SESSION['po_userses']['login_error'] = '<h4>Successfully logedin</h4><p>You are successfully loged in.</p>';
          $_SESSION['po_userses']['login_error_cls'] = "callout-info";
        else:
          $_SESSION['po_userses']['login_error'] = '<h4>Select valid account type</h4><p>Your facebook loign in not registed for \''.ucfirst($_GET['workid']).'\' account type</p>';
          $_SESSION['po_userses']['login_error_cls'] = "callout-info";
        endif;*/
      if($diduserfbidexistbytype > 0):
        $controller_class -> checkFBLoginDetails($_SESSION['fb_data']['EMAIL'], $_SESSION['fb_data']['FBID'], $usrtyp);
      elseif($didemailidexist > 0):
        $_SESSION['po_userses']['login_error'] = '<h4>Account already exists</h4><p>Email address(FB Email Id) already exists, please try another one.</p>';
        $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
      else:
        $freeplndtl = $controller_class -> getfreeplandetail();
        $randno = rand(100000, 999999);
        $newusername = $_SESSION['fb_data']['first_name'].$_SESSION['fb_data']['last_name'].$randno;
        $getmsg = $controller_class -> userRegistrationFun(1, $_SESSION['fb_data']['FBID'], $_SESSION['fb_data']['first_name'], $_SESSION['fb_data']['last_name'], $newusername, $_SESSION['fb_data']['EMAIL'], $_SESSION['fb_data']['gender'], $usrtyp, $freeplndtl);

        $controller_class -> checkFBLoginDetails($_SESSION['fb_data']['EMAIL'], $_SESSION['fb_data']['FBID'], $usrtyp);
      endif;
      unset($_SESSION['fb_data']);
      header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."login/");
      exit;
      
    endif;
  /* ---- header location after session ----*/
  //header("Location: index.php");
} else {
  $loginUrl = $helper->getLoginUrl(array(
   'scope' => 'email'
  ));
 header("Location: ".$loginUrl);
}
//print_r($_SESSION);?>
<!--<body class="skin-blue">
    <?php echo "<pre>"; print_r($_REQUEST); exit; ?>
</body>-->