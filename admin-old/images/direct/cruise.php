<?php include("top.php"); ?>
<?php include("my_seo_plugin.php"); ?>
</head>

<body>
<!--main start-->
<div id="main">
<?php include("top_header.php"); ?>
    <div class="clear"></div>
<?php include("menu.php"); ?>
<?php include("banner.php"); ?>

<div class="clear"></div>
<div class="clear"><img src="/images/strip.png" width="1000" height="23" /></div>

<div id="content" style="height:auto">

<div class="space">
<h2>Egypt Cruises</h2>
<div class="clear"></div>

<?php
$res=select_all_table("cruises");
while($data = mysql_fetch_array($res))
{
$name = $data['name']; 
$t_image= $data['image'];
$id= $data['id']; 
?>
<div class="block">
<p style="border:1px #ccc solid;padding:5px;">
<a href="/img/cruise_images/<?php echo $t_image; ?>" class="lightbox"><img src="/img/cruise_images/<?php echo $t_image; ?>" class="dest_img" width="240" height="166" title="<?php echo $name; ?>" /></a>
</p>
<p style="margin-top:5px;"><a href="cruise_details.php?cat_id=<?php echo $id; ?>" class="text-blue"><?php echo $name; ?></a></p></div>
<?php
}
?>



<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>


<div id="content_mid">


<div class="clear"></div>

</div>

<div class="clear"><img src="/images/strip.png" width="1000" height="23" /></div>



<?php include("footer.php"); ?>
