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
if(isset($_POST['getBrandFromCategory']) && $_POST['getBrandFromCategory']!='')
{
?>

<select class="brand_combo w140 mgl10" onchange="getModelByBrandDefault(this.value)" name="brdId" id="brdId">
  <option value="">Select Brand</option>
  <?php
	foreach($commoncont->getBrand($_POST['catid']) as $k => $branddata)
	{
	?>
  <option value="<?php echo $branddata['id']?>"><?php echo $branddata['brandName']?></option>
  <?php
	}
	?>
</select>
<?php
}
?>
<?php
if(isset($_POST['getModelFromBrand']) && $_POST['getModelFromBrand']!='')
{
?>
<select class="brand_combo w140 mgl10" name="modId" id="modId">
  <option value="">Select Model</option>
  <?php
	foreach($commoncont->getModel($_POST['brndid']) as $k => $modeldata)
	{
	?>
  <option value="<?php echo $modeldata['id']?>"><?php echo $modeldata['modelName']?></option>
  <?php
	}
	?>
</select>
<?php
}
?>
<?php 
if(isset($_POST['getchangeclt_country']) && $_POST['getchangeclt_country']!='')
{
	$_SESSION['client_ipaddress']=$_POST['ctyid'];
}
?>
<?php
if(isset($_POST['getislamicprayertime']) && $_POST['getislamicprayertime']!='')
{
$file = file_get_contents('http://www.islamicfinder.org/prayer_service.php?country=kuwait&city=kuwait_international&state=00&zipcode=&latitude=29.2356&longitude=47.9750&timezone=3&HanfiShafi=1&pmethod=4&fajrTwilight1=10&fajrTwilight2=10&ishaTwilight=10&ishaInterval=30&dhuhrInterval=1&maghribInterval=1&dayLight=0&simpleFormat=xml');
$xml = simplexml_load_string($file);
?>
<table width="138" cellspacing="1" cellpadding="1" bordercolor="D6D6D6" border="0" bgcolor="D6D6D6" dir="ltr">
  <tbody>
    <tr>
      <td bgcolor="FFFFFF" align="center" colspan="2" class="IslamicData"><font color="43494B"><?php echo $xml->{'city'}?>, <?php echo $xml->{'country'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" align="center" colspan="2" class="IslamicDataSmall"><font color="43494B"><?php echo $xml->{'hijri'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" align="center" colspan="2" class="IslamicData"><font color="43494B"><?php echo $xml->{'date'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Day</font></td>
      <td bgcolor="FFFFFF" align="CENTER" class="IslamicData"><font color="43494B"><?php echo date("l",strtotime($xml->{'date'}))?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Fajr</font></td>
      <td bgcolor="FFFFFF" align="center" class="IslamicData"><font color="43494B"> <?php echo $xml->{'fajr'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Sunrise</font></td>
      <td bgcolor="FFFFFF" align="center" class="IslamicData"><font color="43494B"> <?php echo $xml->{'sunrise'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Dhuhr</font></td>
      <td bgcolor="FFFFFF" align="center" class="IslamicData"><font color="43494B"> <?php echo $xml->{'dhuhr'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Asr</font></td>
      <td bgcolor="FFFFFF" align="center" class="IslamicData"><font color="43494B"> <?php echo $xml->{'asr'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Maghrib</font></td>
      <td bgcolor="FFFFFF" align="center" class="IslamicData"><font color="43494B"> <?php echo $xml->{'maghrib'}?></font></td>
    </tr>
    <tr>
      <td bgcolor="FFFFFF" class="IslamicData"><font color="43494B">Isha</font></td>
      <td bgcolor="FFFFFF" align="center" class="IslamicData"><font color="43494B"> <?php echo $xml->{'isha'}?></font></td>
    </tr>
  </tbody>
</table>
<?php
}
?>
<?php
if(isset($_POST['getweatherbackhtml']) && $_POST['getweatherbackhtml']!='')
{
function dubaiWth()
	{
		$location = "http://free.worldweatheronline.com/feed/weather.ashx?q=dubai,uae&format=json&num_of_days=2&key=d20124d1bb132437132401";
		//print_r( file_get_contents($location));
		$newvar='['.file_get_contents($location).']';
		$arrCnt=json_decode($newvar);
		
		$placeone=$arrCnt[0]->{'data'}->{'request'}[0]->{'query'};
		$WhtOne='';
		$WhtOne[]=explode(",",$placeone);
		
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'tempMaxC'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'tempMinC'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'weatherIconUrl'}[0]->{'value'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'current_condition'}[0]->{'temp_C'};
		return $WhtOne;
	}
	function kuwaitWth()
	{
		$location = "http://free.worldweatheronline.com/feed/weather.ashx?q=kuwait,kuwait&format=json&num_of_days=2&key=d20124d1bb132437132401";
		//print_r( file_get_contents($location));
		$newvar='['.file_get_contents($location).']';
		$arrCnt=json_decode($newvar);
		
		$placeone=$arrCnt[0]->{'data'}->{'request'}[0]->{'query'};
		$WhtOne='';
		$WhtOne[]=explode(",",$placeone);
		
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'tempMaxC'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'tempMinC'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'weatherIconUrl'}[0]->{'value'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'current_condition'}[0]->{'temp_C'};
		return $WhtOne;
	}
	function jordanWth()
	{
		$location = "http://free.worldweatheronline.com/feed/weather.ashx?q=amman,jordan&format=json&num_of_days=2&key=d20124d1bb132437132401";
		//print_r( file_get_contents($location));
		$newvar='['.file_get_contents($location).']';
		$arrCnt=json_decode($newvar);
		
		$placeone=$arrCnt[0]->{'data'}->{'request'}[0]->{'query'};
		$WhtOne='';
		$WhtOne[]=explode(",",$placeone);
		
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'tempMaxC'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'tempMinC'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'weather'}[0]->{'weatherIconUrl'}[0]->{'value'};
		$WhtOne[]=$arrCnt[0]->{'data'}->{'current_condition'}[0]->{'temp_C'};
		return $WhtOne;
	}
	
	$placeoneObj=dubaiWth();
	$placetwoObj=kuwaitWth();
	$placethreeObj=jordanWth();
?>
<div class="fl" style="border-bottom:#d6d6d6 1px solid; padding-bottom:7px; width:138px;">
  <div class="s_txt" style="width:70px;"><?php echo $placeoneObj[0][0];?><br/>
    H:<?php echo $placeoneObj[1];?>&deg; - L:<?php echo $placeoneObj[2];?>&deg;</div>
  <div class="fl" style="padding-top:12px; "><img src="<?php echo $placeoneObj[3];?>" alt="" border="0" height="24px" width="25px"/> <span style="font-size:23px; font-weight:bold; font-family:Calibri;"><?php echo $placeoneObj[4];?>&deg;</span></div>
</div>
<div class="fl" style="border-bottom:#d6d6d6 1px solid; padding-bottom:7px; width:138px;">
  <div class="s_txt" style="width:70px;"><?php echo $placetwoObj[0][0]?><br />
    H:<?php echo $placetwoObj[1]?>&deg; - L:<?php echo $placetwoObj[2]?>&deg;</div>
  <div class="fl" style="padding-top:12px;"><img src="<?php echo $placetwoObj[3]?>" alt="" border="0" height="24px" width="25px" /> <span style="font-size:23px; font-weight:bold; font-family:Calibri;"><?php echo $placetwoObj[4]?>&deg;</span></div>
</div>
<div class="fl" style="border-bottom:#d6d6d6 1px solid; padding-bottom:7px; width:138px;">
  <div class="s_txt" style="width:70px;"><?php echo $placethreeObj[0][0]?><br />
    H:<?php echo $placethreeObj[1]?>&deg;- L:<?php echo $placethreeObj[2]?>&deg;</div>
  <div class="fl" style="padding-top:12px;"><img src="<?php echo $placethreeObj[3]?>" alt="" border="0" height="24px" width="25px"/> <span style="font-size:23px; font-weight:bold; font-family:Calibri;"><?php echo $placethreeObj[4]?>&deg;</span></div>
</div>
<?php
}
?>
<?php
if(isset($_POST['getBannerClick']) && $_POST['getBannerClick']!='')
{
	$cclick=$_POST['cclick']+1;
	$tclick=$_POST['tclick'];
	if($cclick>$tclick)
	{
		$qry="UPDATE tbl_banner SET sticky=0 WHERE id='".$_POST['id']."'";
		$result = $modelObj -> runQuery($qry);
	}
	else
	{
		$qry="UPDATE tbl_banner SET click=click+1 WHERE id='".$_POST['id']."' AND trackClick=1";
		$result = $modelObj -> runQuery($qry);
	}
}
?>
