<?php 
	@session_start();
	error_reporting(0);
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
if(isset($_POST['changeuerimgsoldstatus']) && $_POST['changeuerimgsoldstatus'] != ''):
    
    if($_POST['soldsts'] == 1){ $soldsts = 0; }else{ $soldsts = 1; }

    $qry="UPDATE tbl_user_images SET is_sold = '".clear_input($soldsts)."' WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    echo $soldsts;
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

if(isset($_POST['changeshowstatus']) && $_POST['changeshowstatus']!='')
{
  $qry="UPDATE tbl_user_images SET show_front = '".$_POST['values']."' WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    
	?>
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_frontend<?=$_POST['key']?>" id="chk_showonfront<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="1" <?php if($_POST['values']==1){ echo 'checked=""'; } ?> />
			<span>Yes</span> 
		</label>
		</div>
		
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_frontend<?=$_POST['key']?>" id="chk_hideonfront<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="0"  <?php if($_POST['values']==0){ echo 'checked=""'; } ?> />
			<span>No</span> 
		</label>
		</div>
		
	
	<!-- AdminLTE App -->
	
		
		<script>
		$(document).ready(function () {
			$('input[name="show_frontend<?=$_POST['key']?>"]').on('click', function (event) {
				var userimg = jQuery(this).data("userimg");
				var seleval	= this.value;
				jQuery.ajax({
					method: "POST",
					url: site_url+"controllers/ajax_controller/artistsimages-ajax-controller.php",
					data: { changeshowstatus: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?=$_POST['key']?> }
				})
				.done(function( data ) {
					
					$("#div_radioajax"+<?=$_POST['key']?>).html(data);
					
					
				});
				
			});
			
		});
		</script>
		
		<?php
	
}

/////////Bid////start///////////////
if(isset($_POST['changeshowstatusbid']) && $_POST['changeshowstatusbid']!='')
{
  $qry="UPDATE tbl_user_images SET is_bid = '".$_POST['values']."' WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    
	?>
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_isbid<?=$_POST['key']?>" id="chk_showisbid<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="1" <?php if($_POST['values']==1){ echo 'checked=""'; } ?> />
			<span>Yes</span> 
		</label>
		</div>
		
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_isbid<?=$_POST['key']?>" id="chk_hideisbid<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="0"  <?php if($_POST['values']==0){ echo 'checked=""'; } ?> />
			<span>No</span> 
		</label>
		</div>
		
	
	<!-- AdminLTE App -->
	
		
		<script>
		$(document).ready(function () {
			$('input[name="show_isbid<?=$_POST['key']?>"]').on('click', function (event) {
				var userimg = jQuery(this).data("userimg");
				var seleval	= this.value;
				jQuery.ajax({
					method: "POST",
					url: site_url+"controllers/ajax_controller/artistsimages-ajax-controller.php",
					data: { changeshowstatusbid: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?=$_POST['key']?> }
				})
				.done(function( data ) {
					
					$("#div_radioajaxbid"+<?=$_POST['key']?>).html(data);
					
					
				});
				
			});
			
		});
		</script>
		
		<?php
	
}
////////Bid///end////////////////

/////////Rent////start//////rent/////////
if(isset($_POST['changeshowstatusrent']) && $_POST['changeshowstatusrent']!='')
{
  $qry="UPDATE tbl_user_images SET is_rent = '".$_POST['values']."' WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    
	?>
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_isrent<?=$_POST['key']?>" id="chk_showisrent<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="1" <?php if($_POST['values']==1){ echo 'checked=""'; } ?> />
			<span>Yes</span> 
		</label>
		</div>
		
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_isrent<?=$_POST['key']?>" id="chk_hideisrent<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="0"  <?php if($_POST['values']==0){ echo 'checked=""'; } ?> />
			<span>No</span> 
		</label>
		</div>
		
	
	<!-- AdminLTE App -->
	
		
		<script>
		$(document).ready(function () {
			$('input[name="show_isrent<?=$_POST['key']?>"]').on('click', function (event) {
				var userimg = jQuery(this).data("userimg");
				var seleval	= this.value;
				jQuery.ajax({
					method: "POST",
					url: site_url+"controllers/ajax_controller/artistsimages-ajax-controller.php",
					data: { changeshowstatusrent: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?=$_POST['key']?> }
				})
				.done(function( data ) {
					
					$("#div_radioajaxrent"+<?=$_POST['key']?>).html(data);
					
					
				});
				
			});
			
		});
		</script>
		
		<?php
	
}
////////Rent///end////////////////

if(isset($_POST['changeshowstatusp']) && $_POST['changeshowstatusp']!='')
{
  $qry="UPDATE tbl_user_images SET showprice_front = '".$_POST['values']."' WHERE id='".clear_input($_POST['userimg'])."' ";
    $result = $modelObj->runQuery($qry); 
    
	?>
	<div class="price_radio_btn">
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_frontendp<?=$_POST['key']?>" id="chk_showonfrontp<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="1" <?php if($_POST['values']==1){ echo 'checked=""'; } ?> />
			<span>Yes</span> 
		</label>
		</div>
		
		<div class="radio-inline">
		<label>
			<input type="radio" name="show_frontendp<?=$_POST['key']?>" id="chk_hideonfrontp<?=$_POST['key']?>" data-userimg="<?php echo $_POST['userimg'];?>" value="0"  <?php if($_POST['values']==0){ echo 'checked=""'; } ?> />
			<span>No</span> 
		</label>
		</div>
	</div>
		
	
	<!-- AdminLTE App -->
	
		
		<script>
		$(document).ready(function () {
			$('input[name="show_frontendp<?=$_POST['key']?>"]').on('click', function (event) {
				var userimg = jQuery(this).data("userimg");
				var seleval	= this.value;
				jQuery.ajax({
					method: "POST",
					url: site_url+"controllers/ajax_controller/artistsimages-ajax-controller.php",
					data: { changeshowstatusp: "changeshowstatusChk", values: this.value, userimg: userimg, key: <?=$_POST['key']?> }
				})
				.done(function( data ) {
					
					$("#div_radioajaxp"+<?=$_POST['key']?>).html(data);
					
					
				});
				
			});
			
		});
		</script>
		
		<?php
	
}
?>