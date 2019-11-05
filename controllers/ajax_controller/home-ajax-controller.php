<?php 
	@session_start();
	error_reporting(1);
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../../includes/resize-class.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$commoncont = new CommonController();
?>
<?php 

if(isset($_POST['followmentallicachk']) && $_POST['followmentallicachk'] != ''):
    
    if (isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != '') {
      $ifFollowerExist = $commoncont -> checkiffolloweremailexist($_SESSION['po_userses']['flc_usrlogin_email']);
      if(isset($ifFollowerExist['id']) && $ifFollowerExist['id'] != ''){
        if($ifFollowerExist['follower_type'] == 0){
          $qry="UPDATE `tbl_followers` SET `follower_type` = '".clear_input($_SESSION['po_userses']['flc_usrlogin_type'])."', `follower_id` = '".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."' WHERE id = ".$ifFollowerExist['id'];
          $result = $modelObj->runQuery($qry);
        }
        echo 4;
      }else{
		  
		  $userinfo = $commoncont -> getuserdetailfromuserid($_SESSION['po_userses']['flc_usrlogin_id']);
		  
        $qry="INSERT INTO `tbl_followers` (`following_site_or_artist`, `artist_id`, `follower_type`, `follower_id`, `follower_emailid`,  `follower_name`,  `follower_gender`,  `follower_age`, `cr_date`, `status`) VALUES ('0', '0', '".clear_input($_SESSION['po_userses']['flc_usrlogin_type'])."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_email'])."', '".clear_input($userinfo['first_name'])."', '".clear_input($userinfo['gender'])."', '".clear_input($userinfo['age'])."', NOW(), '1')";
        $result = $modelObj->runQuery($qry);
      }
    }else{
      if (isset($_POST['followmentallicaguestemail']) && $_POST['followmentallicaguestemail'] != '') {
        $ifFollowerExist = $commoncont -> checkiffolloweremailexist($_POST['followmentallicaguestemail']);
        //print_r($ifFollowerExist);
        if(isset($ifFollowerExist['id']) && $ifFollowerExist['id'] != ''){
          echo 4;
        }else{
          $qry="INSERT INTO `tbl_followers` (`following_site_or_artist`, `artist_id`, `follower_type`, `follower_id`, `follower_emailid`,  `follower_name`,  `follower_gender`,  `follower_age`, `cr_date`, `status`) VALUES ('0', '0', '0', '0', '".clear_input($_POST['followmentallicaguestemail'])."', '".clear_input($_POST['followmentallicaguestname'])."', '".clear_input($_POST['followmentallicaguestgender'])."', '".clear_input($_POST['followmentallicaguestage'])."', NOW(), '1')";
          $result = $modelObj->runQuery($qry);
        }
      }else{
        echo 3; // Email not found.
      }
    }
    exit;
endif;

if(isset($_POST['followmentallicaartistchk']) && $_POST['followmentallicaartistchk'] != ''):
    $getArtistDetail = $commoncont -> getuserdetailfromusername($_POST['artistname']);
    if (isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != '') {
      $ifFollowerExist = $commoncont -> checkiffollowingartsit($_SESSION['po_userses']['flc_usrlogin_email'], $getArtistDetail['id']);
      if(isset($ifFollowerExist['id']) && $ifFollowerExist['id'] != ''){
        if($ifFollowerExist['follower_type'] == 0){
          //$qry="UPDATE `tbl_followers` SET `follower_type` = '".clear_input($_SESSION['po_userses']['flc_usrlogin_type'])."', `follower_id` = '".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."' WHERE id = ".$ifFollowerExist['id'];
            $qry="DELETE FROM `tbl_followers` WHERE id = ".$ifFollowerExist['id'];
            $result = $modelObj->runQuery($qry);
        }
        $qry="DELETE FROM `tbl_followers` WHERE id = ".$ifFollowerExist['id'];
        $result = $modelObj->runQuery($qry);

        echo 4;
      }else{
        $qry="INSERT INTO `tbl_followers` (`following_site_or_artist`, `artist_id`, `follower_type`, `follower_id`, `follower_emailid`, `cr_date`, `status`) VALUES ('1', '".clear_input($getArtistDetail['id'])."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_type'])."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_email'])."', NOW(), '1')";
        $result = $modelObj->runQuery($qry);
      }
    }else{
      if (isset($_POST['followmentallicaguestemail']) && $_POST['followmentallicaguestemail'] != '') {
        $ifFollowerExist = $commoncont -> checkiffollowingartsit($_POST['followmentallicaguestemail'], $getArtistDetail['id']);
        //print_r($ifFollowerExist);
        if(isset($ifFollowerExist['id']) && $ifFollowerExist['id'] != ''){
            $qry="DELETE FROM `tbl_followers` WHERE artist_id = ".$getArtistDetail['id'];
            $result = $modelObj->runQuery($qry);
            echo 4;
        }else{
          $qry="INSERT INTO `tbl_followers` (`following_site_or_artist`, `artist_id`, `follower_type`, `follower_id`, `follower_emailid`, `cr_date`, `status`) VALUES ('1', '".clear_input($getArtistDetail['id'])."', '0', '0', '".clear_input($_POST['followmentallicaguestemail'])."', NOW(), '1')";
          $result = $modelObj->runQuery($qry);
        }
      }else{
        echo 3; // Email not found.
      }
    }
    exit;
endif;

if(isset($_POST['chatinvitechk']) && $_POST['chatinvitechk'] != ''):
    $getArtistDetail = $commoncont -> getuserdetailfromusername($_POST['artistname']);
    $inviteCode = rand(1, 999)."invite".rand(1, 999);
    $isInvited = $commoncont -> checkIfAlreadyInvitedToChat($getArtistDetail['id']);

    if (isset($_SESSION['po_userses']['flc_usrlogin_id']) && $_SESSION['po_userses']['flc_usrlogin_id'] != '' && $getArtistDetail['id'] && $getArtistDetail['id'] != '' && !$isInvited) {
      $qry="INSERT INTO `tbl_chat` (`senderid`, `receiverid`, `invite_code`, `chat_invite`, `cr_date`, `status`) VALUES ('".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."', '".clear_input($getArtistDetail['id'])."','".clear_input($inviteCode)."','0', NOW(), '1')";
      $result = $modelObj->runQuery($qry);

      $senderName = $_SESSION['po_userses']['flc_usrlogin_first_nm']." ".$_SESSION['po_userses']['flc_usrlogin_last_nm'];
      $reciverName = $getArtistDetail['first_name']." ".$getArtistDetail['last_name'];

      $senderEmail = $_SESSION['po_userses']['flc_usrlogin_email'];
      $receiverEmail = $getArtistDetail['emailid'];

      $subject_to_receiver = "Chat invitaion form Mentallica";
      $subject_to_sender = "Chat invitaion has been sent successfully.";

      $message_to_receiver = '<p>Hello</p>
      <p>'.$senderName.' a user form Mentallica.com invited to chat:</p>
      <p>Activation Code: '.$inviteCode.'</a></p>
      <p>To chat with this user use above activation code on chat page.</p>';
      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\n";
      // Additional headers
      $headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";
      // Mail it
      @mail($receiverEmail, $subject_to_receiver, $message_to_receiver, $headers);

      $message_to_sender = '<p>Hello</p>
      <p>Your chat invitaion has been send to artist '.$reciverName.'</p>
      <p>You will receive an email when artist will accept your invitation.</p>';
      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\n";
      // Additional headers
      $headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";
      // Mail it
      @mail($senderEmail, $subject_to_sender, $message_to_sender, $headers);

      echo 1;
    }else{
      echo 3;
    }
    exit;
endif;

if(isset($_POST['changeuerimgsoldstatus']) && $_POST['changeuerimgsoldstatus'] != ''):
    
    if($_POST['soldsts'] == 1){ $soldsts = 0; }else{ $soldsts = 1; }

    $qry="UPDATE tbl_user_images SET is_sold = '".clear_input($soldsts)."' WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    echo $soldsts;
    exit;
endif;

if(isset($_POST['acceptchatinvitationchk']) && $_POST['acceptchatinvitationchk'] != ''):
    
    $chatInviteCode = $_POST['chatInviteCode'];
    $chatdata = $_POST['chatdata'];

    $checkInviteCode = $commoncont -> checkIfInviteCodeisValidOrNot($chatInviteCode, $chatdata);
    if($checkInviteCode):
      $qry="UPDATE tbl_chat SET chat_invite = '1' WHERE id='".clear_input($chatdata)."' ";
      $result = $modelObj->runQuery($qry); 

      $getArtistDetail = $commoncont -> getuserdetailfromuserid($checkInviteCode['senderid']);
      
      $reciverName = $_SESSION['po_userses']['flc_usrlogin_first_nm']." ".$_SESSION['po_userses']['flc_usrlogin_last_nm'];
      $senderName = $getArtistDetail['first_name']." ".$getArtistDetail['last_name'];

      $senderEmail = $getArtistDetail['emailid'];
      $subject_to_sender = "Your chat invitaion accepted by artist.";

      $message_to_sender = '<p>Hello</p>
      <p>Artist '.$reciverName.' has accepted your chat invitation.</p>
      <p>Login to Mentallica and navigate to chat page to chat with this artist.</p>';
      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\n";
      // Additional headers
      $headers .= 'From: ProjectOne <ajshnr@gmail.com>' . "\r\n";
      // Mail it
      @mail($senderEmail, $subject_to_sender, $message_to_sender, $headers);

      echo 1;
    else:
      echo 4;
    endif;
    //echo $soldsts;
    exit;
endif;

if(isset($_POST['addnewchatchk']) && $_POST['addnewchatchk'] != ''):
    
    $chatmessage = $_POST['chatmessage'];
    $chatdata = $_POST['chatdata'];

    if(trim($chatmessage) != ''):
      $qry="INSERT INTO tbl_chat_message (chatid, userid, message, cr_date, status) values('".clear_input($chatdata)."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."', '".clear_input($chatmessage)."', NOW(), 1) ";
      $result = $modelObj->runQuery($qry); 
      echo 1;
    endif;
    //echo $soldsts;
    exit;
endif;

if(isset($_POST['getChatDetialScreenchk']) && $_POST['getChatDetialScreenchk'] != ''):
    
    $chatdataid = $_POST['chatdata'];

    $chatDetail = $commoncont -> getChatDetailList($chatdataid);?>
    <div class="box-body chat" id="chat-box" style="overflow-y: auto; width: auto; height: 350px;">
    <?php if($chatDetail):
        foreach ($chatDetail as $key => $chatdata):?>
          <!-- chat item -->
          <div class="item">
              <img src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>img/avatar2.png" alt="user image" class="offline"/>
              <p class="message">
                  <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo date("d M, Y H:i", strtotime($chatdata['cr_date']))?></small>
                      <?php if($_SESSION['po_userses']['flc_usrlogin_id'] == $chatdata['userid']):?>
                      You
                      <?php else: 
                        echo $commoncont -> getUserNameFromId($chatdata['userid']);
                      endif; ?>
                  </a>
                  <?php echo $chatdata['message'];?>
              </p>
              <?php if($chatdata['is_file'] == 1): ?>
                <div class="attachment">
                    <h4>Attachments:</h4>
                    <p class="filename">
                        <?php echo $chatdata['chatAttachment'];?>
                    </p>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm btn-flat" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']."upload/chat/".$chatdata['chatid']."/".$chatdata['chatAttachment']; ?>" download >Download</a>
                    </div>
                </div><!-- /.attachment -->
              <?php endif; ?>
          </div><!-- /.item -->
        <?php endforeach;
    endif;?>
    </div><!-- /.chat -->
    <div class="box-footer">
      <form method="post" action="" id="txt-add-chat" onsubmit="return addNewChat()" enctype="multipart/form-data">
        <div class="input-group">
            <input class="form-control" type="text" name="newtextmessage" id="newtextmessage" placeholder="Type message..."/>
            <div class="input-group-btn">
                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
            </div>
            <div class="input-group-btn">
                <button class="btn btn-success chatAttachment" type="button" title="Add file"><i class="fa fa-paperclip"></i></button>
                <input type="file" id="chat_attachment" name="chat_attachment" style="display: none;" />
                <input type="hidden" id="hid_file_attachment" name="hid_file_attachment" value="addFileForChatChk" />
            </div>
            <input type="hidden" name="cur_chatdata" id="cur_chatdata" value="<?php echo $chatdataid;?>">
        </div>
      </form>
    </div>
    <?php
    //echo $soldsts;
    exit;
endif;

if(isset($_POST['hid_file_attachment']) && $_POST['hid_file_attachment'] != '' && $_POST['hid_file_attachment'] == 'addFileForChatChk'):
    $chatdata = $_POST['cur_chatdata'];
    $chatmessage = trim($_POST['newtextmessage']) == '' ? NULL : trim($_POST['newtextmessage']);
    $upload_dir = $_SESSION['SITE_IMG_PATH']."chat/";
    $uploadDirById = $_SESSION['SITE_IMG_PATH']."chat/".$chatdata."/";
    if(!dir($upload_dir))
    {
      mkdir($upload_dir);
    }
    if(!dir($uploadDirById))
    {
      mkdir($uploadDirById);
    }
    if(isset($_FILES["chat_attachment"]["tmp_name"]))
    {
      $tmpfile = $_FILES["chat_attachment"]["tmp_name"];
      $newname = $_FILES["chat_attachment"]["name"];       
      $insertimage="";
      if($_FILES["chat_attachment"]["tmp_name"] != '')
      {
        $abc=date("dmyHis").rand(1, 9999999999);
        $namecut = explode(".", $newname);
        $insertimage=$abc.".".$namecut[sizeof($namecut) - 1];
        if(move_uploaded_file($tmpfile, $uploadDirById.$insertimage))
        {
          // on Success

          $qry="INSERT INTO tbl_chat_message (chatid, userid, message, is_file, chatAttachment, cr_date, status) values('".clear_input($chatdata)."', '".clear_input($_SESSION['po_userses']['flc_usrlogin_id'])."','".clear_input($chatmessage)."', '1','".clear_input($insertimage)."', NOW(), 1) ";
          $result = $modelObj->runQuery($qry); 
          echo 1;

        }
      }
    }
    exit;
endif;

if(isset($_POST['getChatDetialIntervalchk']) && $_POST['getChatDetialIntervalchk'] != ''):
    
    $chatdataid = $_POST['chatdata'];

    $chatDetail = $commoncont -> getChatDetailList($chatdataid);?>
    <?php if($chatDetail):
        foreach ($chatDetail as $key => $chatdata):?>
          <!-- chat item -->
          <div class="item">
              <img src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>img/avatar2.png" alt="user image" class="offline"/>
              <p class="message">
                  <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo date("d M, Y H:i", strtotime($chatdata['cr_date']))?></small>
                      <?php if($_SESSION['po_userses']['flc_usrlogin_id'] == $chatdata['userid']):?>
                      You
                      <?php else: 
                        echo $commoncont -> getUserNameFromId($chatdata['userid']);
                      endif; ?>
                  </a>
                  <?php echo $chatdata['message'];?>
              </p>
              <?php if($chatdata['is_file'] == 1): ?>
                <div class="attachment">
                    <h4>Attachments:</h4>
                    <p class="filename">
                        <?php echo $chatdata['chatAttachment'];?>
                    </p>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm btn-flat" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']."upload/chat/".$chatdata['chatid']."/".$chatdata['chatAttachment']; ?>" download >Download</a>
                    </div>
                </div><!-- /.attachment -->
              <?php endif; ?>
          </div><!-- /.item -->
        <?php endforeach;
    endif;?>
    <?php
    //echo $soldsts;
    exit;
endif;

if(isset($_POST['deleteuserimagebyid']) && $_POST['deleteuserimagebyid'] != ''):
    
    if($_POST['soldsts'] == 1){ $soldsts = 0; }else{ $soldsts = 1; }

    $qry="SELECT * FROM tbl_user_images WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->fetchRow($qry); 

    $userimg = $_SESSION['SITE_IMG_PATH']."images/".$result['image'];
    $userimg_thumb = $_SESSION['SITE_IMG_PATH']."images/thumb/".$result['image'];
    $userimg_150 = $_SESSION['SITE_IMG_PATH']."images/150/".$result['image'];
    $userimg_300 = $_SESSION['SITE_IMG_PATH']."images/300/".$result['image'];

    if(is_file($userimg)){
      unlink($userimg);
    }
    if(is_file($userimg_thumb)){
      unlink($userimg_thumb);
    }
    if(is_file($userimg_150)){
      unlink($userimg_150);
    }
    if(is_file($userimg_300)){
      unlink($userimg_300);
    }

    $qry="DELETE FROM tbl_user_images WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    exit;
endif;

if(isset($_POST['addPagingCode']) && $_POST['addPagingCode']!='')
{
if($_POST['type']=="list")
{
?>
<div class="spacer15"></div>
<div class='home_carbox'>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="745px">
  <tbody>
    <tr bgcolor="d0d3d5" style="float: left; width: 716px;">
      <td height="32" width="140" class="modeltxt">&nbsp;</td>
      <td height="32" width="78" class="modeltxt">model</td>
      <td height="32" width="112" class="modeltxt">year</td>
      <td height="32" width="122" class="modeltxt">milege</td>
      <td height="32" width="118" class="modeltxt">price</td>
      <td height="32" width="60" class="modeltxt">color</td>
    </tr>
    <?php
	$feCnt=0;
	if($commoncont->getAdd($_POST['start'],$_POST['end'])!=''){
	foreach($commoncont->getAdd($_POST['start'],$_POST['end']) as $k => $adddata)
	{
	$modlnm=$commoncont->getModelById($adddata['modelId']);
		$brndnm=$commoncont->getBrandById($adddata['brandId']);
		$addImg=explode(",",$adddata['images']);
		$addPrice=preg_split('#(?<=\d)(?=[a-zA-Z\s])#i', $adddata['priceRange']);
	?>
    <tr bgcolor="dddfe0" style="float:left; width:716px;">
      <td height="89" align="center" width="140" style="padding-left:5px !important; padding-top:8px;" class="modeltxt"><span style="float:left;"><img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/product/<?php echo $addImg[0];?>" alt="" border="0" width="121px" height="80px" style="cursor:pointer;" onclick="window.location='<?=$_SESSION['FRNT_DOMAIN_NAME']?>adddetail/<?php echo $adddata['id'];?>'"/></span> </td>
      <td height="32" width="73" style="line-height:89px;padding-left:20px;" class="modeltxt"><?php echo $modlnm['modelName']?></td>
      <td height="32" width="105" style="line-height:89px;" class="modeltxt"><?php echo $adddata['year'];?></td>
      <td height="32" width="118" style="line-height:89px;" class="modeltxt"><?php echo $adddata['mileage'];?> mpg</td>
      <td height="32" width="130" style="line-height:89px;" class="modeltxt"><?php echo $addPrice[0];?> AED</td>
      <td height="32" width="69" style="line-height:89px;" class="modeltxt"><?php echo $adddata['color'];?></td>
    </tr>
    <tr>
      <td height="12"></td>
    </tr>
    <?php }
	}else{
			?>
      <tr>
        <td><div class="spacer15"></div>
          <div style="float:left; width:720px; padding:8px; color:#FF0000; text-align:center">No data found.</div></td>
      </tr>
      <?php
		}?>
  </tbody>
</table>
</div>
<?php
}
else
{
?>
<!--fl end-->
<div class="spacer15"></div>
<div class='home_carbox'>
  <?php
	$feCnt=0;
	if($commoncont->getAdd($_POST['start'],$_POST['end'])!=''){
	foreach($commoncont->getAdd($_POST['start'],$_POST['end']) as $k => $adddata)
	{
	$modlnm=$commoncont->getModelById($adddata['modelId']);
		$brndnm=$commoncont->getBrandById($adddata['brandId']);
		$addImg=explode(",",$adddata['images']);
		$addPrice=preg_split('#(?<=\d)(?=[a-zA-Z\s])#i', $adddata['priceRange']);
	?>
  <div class="car_box1">
      <div class="txt1 fl"><b><?php echo $modlnm['modelName'];?></b></div>
      <div class="txt1 fr" style="font-size:14px; margin-top:8px;"><?php echo $addPrice[0]?> AED</div>
      <div class="cl"></div>
      <div class="fl" style="padding:5px; padding-bottom:0px;"><img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/product/<?php echo $addImg[0];?>" alt="" border="0" width="129px" height="105px" style="cursor:pointer;" onclick="window.location='<?=$_SESSION['FRNT_DOMAIN_NAME']?>adddetail/<?php echo $adddata['id'];?>'"/></div>
      <div class="txt1 fl" style="margin-top:0px;"><i><?php echo $brndnm['brandName'];?></i></div>
      <div class="txt1 fr" style="margin-top:8px;"><img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>images/heart_img_07.png" alt="" border="0" /></div>
      <div class="cl"></div>
      <div class="txt1 fl" style="margin-top:0px;font-size:14px;">Views 100 </div>
      <div class="txt1 fr" style="font-size:14px; margin-top:1px;"><?php echo $adddata['year'];?></div>
    </div>
  <?php
	$feCnt++;
	if($feCnt%5==0){echo "</div><div class='spacer15'></div><div class='home_carbox'>";}
	}
	}else{
			?>
  <div class="spacer15"></div>
  <div style="float:left; width:720px; padding:8px; color:#FF0000; text-align:center">No data found.</div>
  <div class="spacer15"></div>
  <?php
		}
	?>
</div>
<?php 
if($feCnt%5!=0){?>
<div class="spacer15"></div>
<?php }?>
<?php }?>
<!--fl end-->
<?php 
	$totalAddCount=$commoncont->getTotalAdd();
	$totalLimit=$_POST['end'];
	$totalAddPages=ceil($totalAddCount['totalrecord']/$totalLimit);
	
	?>
<input type="hidden" name="hid_totalcount" id="hid_totalcount" value="<?php echo $totalAddCount['totalrecord']?>" />
<input type="hidden" name="hid_curtlimit" id="hid_curtlimit" value="<?php // echo $totalLimit;?>" />
<div class="top_panel" style="height:35px; margin-top:8px;">
  <?php 
  if($totalAddCount['totalrecord']>$totalLimit){
  ?>
  <div class="leftarw"><img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>images/arw_11.png" alt="" border="0" style="cursor:pointer;" onclick="getAddPaging(<?php if($_POST['start']!=0){echo $_POST['start']-$totalLimit;}else{echo 0;}?>,<?php echo $totalLimit;?>,'<?php echo $_POST['type']?>')"/></div>
  <div class="page">
    <?php
	$diver=1;
	  for($addpage=1;$addpage<=$totalAddPages;$addpage++){
	  
	  if(($addpage-1)*$totalLimit==$_POST['start'] || ($addpage-1)*$totalLimit==$_POST['start']-$totalLimit || ($addpage-1)*$totalLimit==$_POST['start']+$totalLimit){
		if($diver!=1){echo "&nbsp;|&nbsp;";}
		$diver++;
	  ?>
    <a style="cursor:pointer;" onclick="getAddPaging(<?php echo ($addpage-1)*$totalLimit;?>,<?php echo $totalLimit;?>,'<?php echo $_POST['type']?>')"><?php echo $addpage;?></a>
    <?php 
		}
	  }?>
  </div>
  <div class="rightarw" ><img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>images/arw_09.png" alt="" border="0" style="cursor:pointer;" onclick="getAddPaging(<?php if($_POST['start']+$totalLimit>$totalAddCount['totalrecord']){echo ($totalAddPages-1)*$totalLimit;}else{echo $_POST['start']+$totalLimit;}?>,<?php echo $totalLimit;?>,'<?php echo $_POST['type']?>')"/></div>
  <?php 
	  }?>
</div>
<?php

}
?>
<?php 
if(isset($_POST['getSliderDataChk']) && $_POST['getSliderDataChk']!='')
{
  $sliderData=$commoncont->getRandAddForSlider();
  $sCnt=count($sliderData);
  $brdModNm=$commoncont->getBrandModelNmOfAdd($_POST['addid']);
  $addPrice=preg_split('#(?<=\d)(?=[a-zA-Z\s])#i', $brdModNm['priceRange']);
  $addImg=explode(",",$brdModNm['images']);
  ?>
  <script type="text/javascript">
Cufon.replace('.Swis721', { fontFamily: 'Swis721 Cn BT', hover: true});
</script>
  <div class="cartxt Swis721" id="categorynm_ajx"><?php echo $brdModNm['categoryName'];?> DEALER<br />
      <span style="font-size:14px; font-family:Calibri; font-weight:normal;">&nbsp;</span></div>
    <div class="cl"></div>
    <div class="car_shade Swis721" id="brdmodnm_ajx"><div><?php echo $brdModNm['brandName']." ".$brdModNm['modelName'];?></div>
      <div class="fl dollartxt Swis721" style="margin-top:10px;font-size:40px; color:#009900;" id="addPrc_ajx"><?php echo $addPrice[0];?> AED</div>
    </div>
    <div class="carimg" id="addimg_ajx"><img src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/product/<?php echo $addImg[0]?>" alt="" border="0" width="503px" height="193px"/></div>
    <div class="greenbor">
      <div class="pageination">
        <ul>
          <?php
		  $sidCnt=1;
		  foreach($sliderData as $k=> $siddata)
		  {
		  ?><li><a style="cursor:pointer;" onclick="getSliderData(<?php echo  $siddata['id'];?>)" <?php if($siddata['id']==$_POST['addid']){echo "class='select'";} ?>><?php echo $sidCnt;?></a></li><?php 
		  $sidCnt++;
		  }
		  ?>
        </ul>
      </div>
    </div>
<?php
}
?>