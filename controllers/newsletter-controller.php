<?php
class NewsletterController extends CommonController
{
	function __construct()
	{
		parent::__construct();
		$this -> modelObj = new NewsletterModel();
		
		if(isset($_POST['savenewsletter']) && $_POST['savenewsletter'] != '' && $_POST['savenewsletter'] == "savenewsletter"):
			echo "<pre>";
			print_r($_POST);
			$contenuto = "";
			$nlFilePath = $_SESSION['APP_PATH'];
			$newsletterid = base64_decode($_POST['newsletter']);
			$tplpath = $_POST['templatepath'];
			$tplname = basename($tplpath);
			$nlFilePath .= "newsletter-builder/tmp/".$tplname;
			if (file_exists($nlFilePath)) {
              	$contenuto = file_get_contents($nlFilePath);
          	}else{
          		$nlFilePath = $_SESSION['APP_PATH'];
          		$tplpath = $_SESSION['FRNT_DOMAIN_NAME']."newsletter-builder/tmp/1474029959.html";
          		$defaultFile = $tplpath;
          		$tplname = basename($defaultFile);
				$nlFilePath .= "newsletter-builder/tmp/".$tplname;
				$contenuto = file_get_contents($nlFilePath);
          	}

          	$qry="UPDATE tbl_newsletter SET newsletter_content = '".clear_input($contenuto)."', newsletter_html_file = '".clear_input($tplpath)."' WHERE id='".clear_input($newsletterid)."' ";
        	$result = $this->modelObj->runQuery($qry);

        	$_SESSION['po_userses']['newsletter_error'] = '<h4>Successfully updated</h4><p>Newsletter updated successfully.</p>';
			$_SESSION['po_userses']['newsletter_error_cls'] = "callout-info";

			header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."newsletter/");
			exit;
		endif;
		
		
		if(isset($_POST['btn_send_newsletter_csv'])){			
					
					$followers = implode(",", $_POST['chckemail']);
					
					if(isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != ''):
				

				$newsletterid = $_POST['hid_newsletterdetail'];
				$getNewsletterDetail = $this -> getnewsletterdetailbyid($newsletterid);

				
				$to = $followers;

				$message = stripslashes($getNewsletterDetail['newsletter_content']);

				// subject
				$subject = 'Newsletter form Mentallica - '.$getNewsletterDetail['newsletter_title'];
				//echo "-3-";
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";

				//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\n";

				// Additional headers
				$headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";

				// Mail it
				@mail($to, $subject, $message, $headers);

				$_SESSION['po_userses']['newsletter_error'] = '<h4>Successfully sent</h4><p>Newsletter sent to all your followers.</p>';
				$_SESSION['po_userses']['newsletter_error_cls'] = "callout-info";

				header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."newsletter/");
				exit;
			else:
				$_SESSION['po_userses']['newsletter_error'] = '<h4>Error</h4><p>Unable to send newsletter to your followers.</p>';
				$_SESSION['po_userses']['newsletter_error_cls'] = "callout-danger";
			endif;
			
		}
		
		if(isset($_POST['snwlt_sendto']) && $_POST['snwlt_sendto'] != ''):
			if(isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != ''):
				

				$newsletterid = $_POST['hid_newsletterdetail'];
				$getNewsletterDetail = $this -> getnewsletterdetailbyid($newsletterid);

				//$_SESSION['APP_PATH'].'cssin-master/src/CSSIN.php';
				/*require $_SESSION['APP_PATH'].'cssin-master/src/CSSIN.php';
				$cssin = new FM\CSSIN();

				$messagehtml = '<!DOCTYPE html>
				<html>
				<head>
				<!-- Latest compiled and minified CSS -->
				<link href="'.$_SESSION['FRNT_DOMAIN_NAME'].'css/bootstrap.min.css" rel="stylesheet" type="text/css" />
				</head>
				<body>'.$getNewsletterDetail['newsletter_content'].'</body>
				</html>';

				$html_with_inlined_css = $cssin->inlineCSS(null, $messagehtml);*/


				if($_POST['snwlt_sendto'] == 'onlyme'){
					$email = $this -> getuserdetailfromuserid($_SESSION['po_userses']['flc_usrlogin_id']);
					$to = $email['emailid'];
				}else if($_POST['snwlt_sendto'] == 'mentallicafollower'){
					//echo "<pre/>"; print_r($_REQUEST); die;
					$getFollowerList = $this -> getArtistFollowerSiteList($_REQUEST['serach_ngender'],$_REQUEST['serach_nage']);
					$followerarraysite = array();
					foreach ($getFollowerList as $key => $followersite) {
						$followerarraysite[] = $followersite['follower_emailid'];
					}
					$followerssite = implode(",", $followerarraysite);	
					$to = $followerssite;
				}else{
					$getFollowerList = $this -> getArtistFollowerList($_SESSION['po_userses']['flc_usrlogin_id']);
					$followerarray = array();
					foreach ($getFollowerList as $key => $follower) {
						$followerarray[] = $follower['follower_emailid'];
					}
					$followers = implode(",", $followerarray);				
					$to = $followers;
				}

				$message = stripslashes($getNewsletterDetail['newsletter_content']);

				// subject
				$subject = 'Newsletter form Mentallica - '.$getNewsletterDetail['newsletter_title'];
				//echo "-3-";
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";

				//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\n";

				// Additional headers
				$headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";
				// Mail it
				@mail($to, $subject, $message, $headers);

				$_SESSION['po_userses']['newsletter_error'] = '<h4>Successfully sent</h4><p>Newsletter sent to all your followers.</p>';
				$_SESSION['po_userses']['newsletter_error_cls'] = "callout-info";

				header("Location: ".$_SESSION['FRNT_DOMAIN_NAME']."newsletter/");
				exit;
			else:
				$_SESSION['po_userses']['newsletter_error'] = '<h4>Error</h4><p>Unable to send newsletter to your followers.</p>';
				$_SESSION['po_userses']['newsletter_error_cls'] = "callout-danger";
			endif;
		endif;

	}
	
	function getpreviewcategories(){
	  $qry="SELECT preview_category FROM tbl_users WHERE status = 1 AND id = ".$_SESSION['po_userses']['flc_usrlogin_id'];
      return $result = $this->modelObj->fetchRow($qry);
	}
}
?>