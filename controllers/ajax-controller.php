	<?php 
	include('../models/db.php');
	include('../models/common-model.php');
	include('common-controller.php');
	$database = new Connection();
	include('../models/ajax-model.php');
	$modelObj = new AjaxModel();
	?>
      <?php
	if(isset($_POST['rate']) && $_POST['rate'] != ''){
	   $qry = "UPDATE ratphoto  SET ratingvalue = '".mysql_real_escape_string($_POST['rate'])."'
	  							WHERE id = '".mysql_real_escape_string($_POST['id'])."'";
	  $result =  mysql_query($qry);							
	?>
    
    <?php } ?>
    <?php
	if (isset($_GET['categoryID']) && $_GET['categoryID'] != '')
	{
		$qry = "UPDATE  category  SET status = ".mysql_real_escape_string($_GET['status'])." WHERE id = ".mysql_real_escape_string($_GET['categoryID']);
		$result =  mysql_query($qry);
		if ($result)
		{
			if ($_GET['status'] == 1)
			{
				$status = "Active";
			}
			else
			{
				$status = "Inactive";
			}
			echo "document.getElementById('row_message').className = 'row-message display';\n";
			echo "document.getElementById('status_".$_GET['categoryID']."').innerHTML = '".$status."';\n";
			echo "document.getElementById('message').innerHTML = 'Status updated successfully.';\n";
		}
		else
		{
			echo "document.getElementById('row_message').className = 'row-message display';\n";
			echo "document.getElementById('message').innerHTML = 'Error occurred while updating status. Please try again.';\n";
		}
	} 
	
?>
<?php
	if (isset($_GET['userID']) && $_GET['userID'] != '')
	{
		$qry = "UPDATE  user  SET status = ".mysql_real_escape_string($_GET['status'])." WHERE id = ".mysql_real_escape_string($_GET['userID']);
		$result =  mysql_query($qry);
		if ($result)
		{
			if ($_GET['status'] == 1)
			{
				$status = "Active";
			}
			else
			{
				$status = "Inactive";
			}
			echo "document.getElementById('row_message').className = 'row-message display';\n";
			echo "document.getElementById('status_".$_GET['userID']."').innerHTML = '".$status."';\n";
			echo "document.getElementById('message').innerHTML = 'Status updated successfully.';\n";
		}
		else
		{
			echo "document.getElementById('row_message').className = 'row-message display';\n";
			echo "document.getElementById('message').innerHTML = 'Error occurred while updating status. Please try again.';\n";
		}
	} 
	
?>