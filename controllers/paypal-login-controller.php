<?php

class PaypalLoginController {

    function __construct() {
        /*  parent::__construct(); */
        // $this->modelObj = new PaypalLoginModel();
        $this->host = 'localhost';
        $this->user = 'mentalli';
        $this->passwd = 'hJzjHSrTpf';
        $this->database = 'mentalli_db';
        //connect with the database
        $this->condb = new mysqli($this->host, $this->user, $this->passwd, $this->database);
        if ($this->condb->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->condb->connect_errno . ") " . $this->condb->connect_error;
        }
    }

    function _paypalprocessing($token) {

        $json = json_decode($token, true);
        
        $_uservalidationres = $this->_uservalidation($json);
    }

    function _payapcheckuser($email) {
        $sql = "select * from tbl_users WHERE emailid = '$email'";
        $result = $this->condb->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response = $row;
            }
        } else {
            return false;
        }
        return $response;
    }

    function _uservalidation($data) {
       
        $name = explode(" ", $data['name']);
        $email = $data['email'];

        $firstname = $name[0];
        $lastname = '';
        if (count($name) > 1) {
            $lastname = end($name);
        }
        $umane = explode("@", $data['email']);
        $password = $umane[0] . '_xyz';
        $usrtyp = 1;
    
        $sql = "select * from tbl_users WHERE emailid = '$email' and status='1'";
        $result = $this->condb->query($sql);
         
        /* $country = 1; */
        $ar = array(
            'country'=>$data['address']['country'],
            'region'=>$data['address']['region'],
            'city'=>$data['address']['locality'],
            'postal_code' => $data['address']['postal_code'],
            'address'=>$data['address']['street_address'],
        );

        $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
        $FRNT_DOMAIN_NAME = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/projectone/";
        echo("<script>location.href = '".$FRNT_DOMAIN_NAME."paypallogin.php?email=$email&found=1&&str_var=".base64_encode(serialize($ar))."';</script>");
        exit;
        /*if ($result->num_rows > 0) {
            echo("<script>location.href = '".$FRNT_DOMAIN_NAME."paypallogin.php?email=$email&found=1';</script>");
            exit;
        } else {
            echo("<script>location.href = '".$FRNT_DOMAIN_NAME."paypallogin.php?email=$email&found=0';</script>");
            exit;
        }*/
    }

    function _regbypaypal($firstname, $lastname, $username, $emailid, $password, $country, $state, $city, $gender, $address, $usrtyp) {
        /*
        $qrylatilong = "SELECT * FROM cities WHERE id=" . $city;
        $result = $this->condb->query($qrylatilong); */
        $resultlatilongi['latitude'] = '';
        $resultlatilongi['longitude'] = '';
        /* if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          $resultlatilongi['latitude'] = $row['latitude'];
          $resultlatilongi['longitude'] = $row['longitude'];
          }
          } */
        $l['latitude'] = '';
        $l['longitude'] = '';
        $locations = $this->_getlocation($country, $state, $city);
        if(empty($locations)){
            $locations['countryId'] = 0;
            $locations['stateId'] = 0;
            $locations['Id'] = 0;
        }
        $sql1 = "select * from tbl_plans WHERE id = '1' or plan_name='Basic'";
        $result1 = $this->condb->query($sql1);
       $dd =  $result1->fetch_assoc();
      
        $ref_code = "ART" . date("mdyHis") . rand(10, 99);
        $qry = "INSERT INTO tbl_users (ref_id,is_paypal_user, first_name, last_name, username, emailid, password, country, state, city,latitude,longitude, gender, address, usertype, cr_date, status,plan_id,paypal_email_id,paypal_email_show,image_limit) values('" . $this->clear_input($ref_code) . "','yes' ,'" . $this->clear_input($firstname) . "', '" . $this->clear_input($lastname) . "', '" . $this->clear_input($username) . "', '" . $this->clear_input($emailid) . "', '" . $this->clear_input(md5($password)) . "', '" . $locations['countryId'] . "', '" .  $locations['stateId'] . "', '" . $locations['Id']. "','" . $l['latitude'] . "', '" . $l['longitude'] . "', '" . $this->clear_input($gender) . "', '" . $this->clear_input($address) . "', '" . $this->clear_input($usrtyp) . "', NOW(), 1,1,'" . $this->clear_input($emailid) . "','1','".$dd['image_limit']."')";
        /*  $result = $this->modelObj->runQuery($qry);  */
        
        $result = $this->condb->query($qry);


        /* exit; */
        //$_SESSION['po_userses']['p_register_user'] = mysql_insert_id();



        /* if ($usrtyp == 1) {
          $qry = "UPDATE tbl_users SET plan_id = '" . clear_input($freeplndtl['id']) . "', image_limit = '" . clear_input($freeplndtl['image_limit']) . "' WHERE id = '" . clear_input($newuserid) . "' ";
          $result = $this->modelObj->runQuery($qry);
          } */
        //echo "-1-";
        //$getreguserdetail = $this -> getreguserdetail($newuserid);
        /*  $activationlink = $_SESSION['FRNT_DOMAIN_NAME'] . 'index.php?pid=login&acticod=' . base64_encode($ref_code); */
        $to = $emailid;

        // subject
        $subject = 'Congratulations from Mentallica';
        //echo "-2-".$to;
        if ($usrtyp == 1):
            // message
            $message = '<p>Hello</p>
		<p>Click or copy paste below link in you browser to activate your account:</p>
		
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
		<p></p>It comes with 500 uloads in any category and with a special zoom feature for displaying your Art work So you don?t have to make numerous detail pictures.  </p>
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
        $headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";

        // Mail it
        @mail($to, $subject, $message, $headers);
        //echo "-4-";
        //exit;
        return $result;
    }

    function clear_input($data) {
        return $data;
    }
    function _getlocation($country, $state, $city) {
        $locationfinal = array();
        $sql = "select Id from tbl_country WHERE countryCode = '$country'";
        $result = $this->condb->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $countryID = $row['Id'];
            }
            $sql2 = "select Id from tbl_state WHERE countryId = '" . $countryID . "' AND stateName = '" . $state . "'";
            $result2 = $this->condb->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $stateID = $row2['Id'];
                }
                $sql3 = "select * from tbl_city WHERE countryId = '" . $countryID . "' AND stateId = '" . $stateID . "' AND cityName = '" . $city . "'";
                $result3 = $this->condb->query($sql3);
                if ($result3->num_rows > 0) {
                    while ($row3 = $result3->fetch_assoc()) {
                        $locationfinal = $row3;
                    }
                }

            }
            return $locationfinal;
        }
    }

}