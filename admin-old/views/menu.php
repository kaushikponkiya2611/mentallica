<div class="nav-outer">

<div class="menu">
<?php
if($controller_class -> section != ''){
	foreach($controller_class -> section  as $k => $mainsection){
	 $qry = "SELECT Section_Id FROM tbl_sectionlink WHERE Link = '".$_GET['pid']."'";
	 $rs=mysql_query($qry);
	 $cnt = mysql_num_rows($rs);
	 $row=mysql_fetch_assoc($rs);
	 if($cnt != 0){
		if($mainsection['Section_Id']==$row['Section_Id']){
			$class="avtive_menu";
		}
		else
		{
			$class="";
		}
	}else if($cnt == 0){
		if($mainsection['Link'] == $_GET['pid']){
		  $class="avtive_menu";
		}else if($_GET['pid']=="donor" && $mainsection['Link']=="donation"){
		  $class="avtive_menu";
		}else{
		  $class="";
		}
	}
?>
  <ul>
    <li>
		<?php
        if($_SESSION['USER_TYPE'] == 1 && $_GET['pid']!='logout')
        {
            $qry_subId="SELECT Subsection_Id FROM tbl_sectionlink WHERE Section_Id='".$mainsection['Section_Id']."' and LInk='".$mainsection['Link']."'";
		    //$res_subId = $model_class-> fetchRow($qry_subId);
			$res_subId =mysql_fetch_assoc(mysql_query($qry_subId));

            if($res_subId!='')
            {
                $qry_roll="SELECT subsection FROM rollmanagement WHERE  mainsection='".$mainsection['Section_Id']."' and Emp_Id='".$_SESSION['ADMIN_ID'] ."' ";
                //$res_roll = $model_class-> fetchRow($qry_roll);
				$res_roll =mysql_fetch_assoc(mysql_query($qry_roll));
				
				$qry_forcheck=mysql_query("SELECT * FROM rollmanagement WHERE Emp_Id='".$_SESSION['ADMIN_ID'] ."'");
				while($res_forcheck=mysql_fetch_array($qry_forcheck))
				{
					echo $res_forcheck['Link'];
				}
				/*print_r($res_forcheck['Link']);
                if(!in_array($_GET['pid'],$res_forcheck['Link']))
				{
					//echo "test";
				}*/
                $subid=explode(",",$res_roll['subsection']);
                $z=0;
                for($i=0;$i<count($subid);$i++)
                {
                    if($res_subId['Subsection_Id']==$subid[$i])
                    {
                        $z++;
                    }
                }
                if($z==0)
                {
                    $qryfor_Link="SELECT Link FROM tbl_sectionlink WHERE Subsection_Id='".$subid[0]."'";
                    //$resfor_Link =$model_class-> fetchRow($qryfor_Link);
					$resfor_Link =mysql_fetch_assoc(mysql_query($qryfor_Link));
                    $file=$resfor_Link['Link'];
					
                    ?>
                    <a href="<?php echo 'index.php?pid='.strtolower($file); ?>" class="main <?=$class?>"><?php echo $mainsection['Name'] ?></a>
                    <?php
                }
                else
                {
                //$z=0;
                ?>
                    <a href="<?php echo 'index.php?pid='.strtolower($mainsection['Link']); ?>" class="main <?=$class?>"><?php echo $mainsection['Name'] ?></a>
                <?php
                }
            }
            else
            {
            //$z=0;
            ?>
                <a href="<?php echo 'index.php?pid='.strtolower($mainsection['Link']); ?>" class="main <?=$class?>"><?php echo $mainsection['Name'] ?></a>
            <?php
            }
        }
        else
        {
        ?>
            <a href="<?php echo 'index.php?pid='.strtolower($mainsection['Link']); ?>" class="main <?=$class?>"><?php echo $mainsection['Name'] ?></a>
        <?php
        }
        ?>
        
			<?php 
			 $subsection = $controller_class -> sectionlink($mainsection['Section_Id']);
				if($subsection != ''){ 
			?>	
        	<ul>
				<?php 
                    foreach($subsection as $sub => $subsectionname){
                    $expl = explode('&',$subsectionname['Link']);
                ?>
                		<li><a href="<?php echo 'index.php?pid='.strtolower($subsectionname['Link']);?>"><?php echo $subsectionname['Title']; ?></a></li>

                <?php 
					}
				?>
            </ul>
            <?php 
				}
			?>
    
    </li>
  </ul>
<?php }
	}?>
  <div class="clear"></div>
</div>

</div>
