<?php

class RegisterController extends CommonController {

    function __construct() {
        parent::__construct();
        $this->modelObj = new RegisterModel();

        if (isset($_POST['u_r_emailid']) && $_POST['u_r_emailid'] != ''):
            if ($_POST['u_r_password'] != $_POST['u_r_password2']):
                $_SESSION['po_userses']['login_error'] = '<h4>Unmatched password</h4><p>Please re-enter password and confirm password.</p>';
                $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
            else:
                $this->usrtyp = $_GET['workid'] == 'artist' ? 1 : ($_GET['workid'] == 'client' ? 2 : ($_GET['workid'] == 'company' ? 3 : 1));
                $this->didusernameexist = $this->checkifusernameexist($_POST['u_r_username']);
                $this->didemailidexist = $this->checkifuseremailexistbytype($_POST['u_r_emailid'], $this->usrtyp);
                $promocode="";
                if(isset($_POST['u_r_promocode']) && $_POST['u_r_promocode'] != ''){
                    $workid = $_GET['workid'];
                    if($workid=='artist'){
                        $workid=1;
                    }else if($workid=='client'){
                        $workid=2;
                    }else if($workid=='company'){
                        $workid=3;
                    }
                    
                   $promocodedetail = $this->checkpromocodere($_POST['u_r_promocode'], $_POST['u_r_emailid'], $workid);
                    if($promocodedetail==0){                        
                        $promocode ="0";
                    }else if($promocodedetail==2){
                        $promocode="2";
                    }else if($promocodedetail==3){
                        $promocode="2";
                    }
                }
                if ($this->didusernameexist > 0):
                    $_SESSION['po_userses']['login_error'] = '<h4>Invalid Username</h4><p>Username you entered already exists, please try another one.</p>';
                    $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                elseif ($this->didemailidexist > 0):
                    $_SESSION['po_userses']['login_error'] = '<h4>Invalid Email ID</h4><p>Email ID you entered already exists, please try another one.</p>';
                    $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                elseif(isset($_POST['u_r_promocode']) && $_POST['u_r_promocode'] != '' && $promocode!=''):
                    if($promocodedetail==0):
                        $_SESSION['po_userses']['login_error'] = '<h4>Invalid Promo Code</h4><p>This promo code not exist.</p>';
                        $_SESSION['po_userses']['login_error_cls'] = "callout-danger";                        
                    elseif($promocodedetail==2):
                        $_SESSION['po_userses']['login_error'] = '<h4>Promo Code Expired</h4><p>This promo code already used.</p>';
                        $_SESSION['po_userses']['login_error_cls'] = "callout-danger";                        
                    elseif($promocodedetail==3):
                        $_SESSION['po_userses']['login_error'] = '<h4>Invalid Promo Code</h4><p>This promo code not exist for this user type.</p>';
                        $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                    else:
                        $this->freeplndtl=3;
                    endif;
                else:
                    $this->freeplndtl = $this->getfreeplandetail();
                    
                    if(!isset($_POST['u_r_state']) or   $_POST['u_r_state'] == ''){
                        $_POST['u_r_state']= 0;
                    }
                    if(!isset($_POST['u_r_city']) or $_POST['u_r_city']==''){
                        $_POST['u_r_city'] = 0;
                    }
                        
                       
                    $vl = "yes";
                    setcookie('userlogin', $vl, time()+ 60 * 60 * 24 * 365, '/');
                    $this->getmsg = $this->userRegistrationFun($_POST['u_r_first_name'], $_POST['u_r_last_name'], $_POST['u_r_username'], $_POST['u_r_emailid'], $_POST['u_r_password'],  $_POST['u_r_gender'], $_POST['u_r_address'], $this->usrtyp, $this->freeplndtl);
                    $_SESSION['po_userses']['login_error'] = '<h4>Successfully registered</h4><p>Please check your email to activate and login into your account.</p>';
                    $_SESSION['po_userses']['login_error_cls'] = "callout-info";

                    header("Location: " . $_SESSION['FRNT_DOMAIN_NAME'] . "login/");
                    exit;
                endif;
            endif;
        endif;
    }

	
    function getreguserdetail($userid) {
        $qry = "SELECT * FROM tbl_users WHERE id = '" . clear_input($userid) . "' AND status = 0 LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }
    
    function checkpromocodere($promocode, $emailid, $usertype) {
        $qry = "SELECT * FROM tbl_promocode WHERE status=1 and promocode='".$promocode."' and email_address='".$emailid."'";
        $result = $this->modelObj->fetchRow($qry);
       
        if($result['id']!=''){
            if($result['is_used']==1){
                return 2;
            }else if($result['user_type']!=$usertype){
                return 3;
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }
    
    function getfreeplandetail() {
        $qry = "SELECT * FROM tbl_plans WHERE id = 1 AND status = 1 LIMIT 1";
        return $result = $this->modelObj->fetchRow($qry);
    }

    function userRegistrationFun($firstname, $lastname, $username, $emailid, $password, $gender, $address, $usrtyp, $freeplndtl) {
		
        /*
        $qrylatilong = "SELECT * FROM cities WHERE id=" . $city;
        $resultlatilongi = $this->modelObj->fetchRow($qrylatilong);
        */
        
        
        
        //print_r($resultlatilongi); die;  
        $ref_code = "ART" . date("mdyHis") . rand(10, 99);
        
        //$qry = "INSERT INTO tbl_users (ref_id, first_name, last_name, username, emailid, password, country, state, city,latitude,longitude, gender, address, usertype, cr_date, status) values('" . clear_input($ref_code) . "', '" . clear_input($firstname) . "', '" . clear_input($lastname) . "', '" . clear_input($username) . "', '" . clear_input($emailid) . "', '" . clear_input(md5($password)) . "', '" . $resultlatilongi['latitude'] . "', '" . $resultlatilongi['longitude'] . "', '" . clear_input($gender) . "', '" . clear_input($address) . "', '" . clear_input($usrtyp) . "', NOW(), 0)";
       
        $qry = "INSERT INTO tbl_users (ref_id, first_name, last_name, username, emailid, password, country, state, city,latitude,longitude, gender, address, usertype, cr_date, status) values('" . clear_input($ref_code) . "', '" . clear_input($firstname) . "', '" . clear_input($lastname) . "', '" . clear_input($username) . "', '" . clear_input($emailid) . "', '" . clear_input(md5($password)) . "', '','','','', '', '" . clear_input($gender) . "', '" . clear_input($address) . "', '" . clear_input($usrtyp) . "', NOW(), 0)";
        $result = $this->modelObj->runQuery($qry);
		/* echo $qry;
		exit; */
        //$_SESSION['po_userses']['p_register_user'] = mysql_insert_id();

        $newuserid = mysql_insert_id();

        if ($usrtyp == 1) {
            $qry = "UPDATE tbl_users SET plan_id = '" . clear_input($freeplndtl['id']) . "', image_limit = '" . clear_input($freeplndtl['image_limit']) . "' WHERE id = '" . clear_input($newuserid) . "' ";
            $result = $this->modelObj->runQuery($qry);
        }
        //echo "-1-";
        //$getreguserdetail = $this -> getreguserdetail($newuserid);
        $activationlink = $_SESSION['FRNT_DOMAIN_NAME'] . 'index.php?pid=login&acticod=' . base64_encode($ref_code);
        $to = $emailid;

        // subject
        $subject = 'Congratulations from Mentallica';
        //echo "-2-".$to;
        if ($usrtyp == 1):
            // message
            $message = '<p>Hello</p>
		<p>Click or copy paste below link in you browser to activate your account:</p>
		<p><a href="' . $activationlink . '">' . $activationlink . '</a></p>
		<p>Congratulation you have been accepted to the Metallica Art Community . Mentallica is a platform for Marriage of the Arts as it links different art forms like Art as an timeless expression of our views and feelings.</p>
		<p>So it links Artists , is a window to the world ( shopping window or just display window ) as well as a portable Portfolio for the Artist. And therefore can be seen as an Artistic interim as well responding  to job postings by logged in clientele as  well as cooperation demands by fellow Artists.</p>
		<p>So enjoy your new Membership by signing in/logging in with your used email in and received temporary password  in this message.  </p>
		<p>Do not forget to change your password to your own choice once you log in. Or afterwards.</p>
		<p>On this Personal  Profile Page you also find all the info back you have given us while sign in please keep this updated so that the Administrator and interested parties can locate you.</p>
		<p>Once you login to your page you will find 3 different payment plans.</p>
		<p>The first is a test payment plan and works with a token of ten credits.  </p>
		<p>The purpose of this one is mainly extra needed credits if the chosen subscription is not sufficient during  a certain period or can be granted as bonus credits by the administrator to any subscription plan.</p>
		<p>The second is a Silver membership of Mentallica our Basic subscription.</p>
		<p>This  6$ monthly subscription /paid yearly  contains  50 uploads monthly  in one given category and can be upgraded with extra uploads by the use of Tokens.</p>
		<p>The third is a Gold subscription for 10$ monthly /paid yearly  really unleashes the power of your Mentallica Membership with more features to come as we grow our community.</p>
		<p></p>It comes with 500 uloads in any category and with a special zoom feature for displaying your Art work So you don’t have to make numerous detail pictures.  </p>
		<p>For sales Mentallica is like your own Agent without the fees.</p>
		<p>The interested client needs to be log in to contact you but price discussions are solely between you and the client for the price or price range you set.</p>
		<p>SO BE YOUR OWN AGENT ( OR ASK ASSISTANCE FROM THE MENTALLICA TEAM )</p>
		<p>Enjoy!</p>';
        elseif ($usrtyp == 2):
            $message = '<p>Hello, </p>
			<p>Click or copy paste below link in you browser to activate your account:</p>
			<p><a href="' . $activationlink . '">' . $activationlink . '</a></p>
			<p>Bidding on the site is regulated.  Since it`s a site managed by the Artist himself he probably wans to spend more time creating his Art work then selling it.
			The status of logged in client gives you the opportunity to chat with the Artist himself in the specially designed chat window. Even if the status light shows he is not logged in himself it remains a preferred way to contact him or her.  That`s why credits are sold to  contact your preferred artist to show him it`s  serious chat or email ( when the Artist is offline ) just type in your question as you would while sending him an email. </p>

			<p>If you logged in without credits on your token card that are used to initialize a chat  you will nevertheless get to see the chat window as a registered client but won`t be able to send messages. We as Mentallica community will ask the Artist to give updated information to prevent that a piece of displayed Art is already sold while you make your bid.</p>

			<p>Hope you will get to be able to purchase your favorite piece and thank you for being supportive of the Mentallica community.</p>';
        elseif ($usrtyp == 3):
            $message = '<p>Hello, </p>
			<p>Click or copy paste below link in you browser to activate your account:</p>
			<p><a href="' . $activationlink . '">' . $activationlink . '</a></p>
			<p>As a necessary or preferred link to the creation of Art pieces we are glad to have you so close to us. Producers can shop here for an Artist to represent as well as promote their company n one or more categories. This sign-up sign-in is solely provided so that sponsors/Producers/Gallery holders can upload their imagery directly to our servers to be edited later by Mentallica to be displayed. Several different subscription types are available depending on the amount and durance of displayed commercials contact us for a very interesting offer. Tokens are used to upload to the mentallica server only and start editing work. Here also a chat window will be available to give instructions to or buy space n time on the mentallica server. </p>

				<p>Thank you for being a help for our Artists</p>';
        endif;
        //echo "-3-";
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";

        //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";

        // Additional headers
        $headers .= 'From: ProjectOne <meetvora2006@gmail.com>' . "\r\n";

        // Mail it
        @mail($to, $subject, $message, $headers);
        //echo "-4-";
        //exit;
        return $result;
    }

}

?>