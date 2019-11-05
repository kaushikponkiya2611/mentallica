<?php 
	$biddata = $controller_class->_allbibs1;
	
?>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <div class="container">
    <div class="row blue-border-main">
     
    <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
     
                <!-- Main content -->
    	<div class="norification">
			<div class="app">
				<div class="main">
					<div class="container-fluid">
						<?php if(!empty($biddata)){ ?>
							<h2><?php echo $biddata[0]['name']; ?></h2>	
							<table class="table">
								<thead>
								  <tr>
									<th>Name</th>
									<th>Amount</th>
									<th>Date</th>
								  </tr>
								</thead>
								<tbody>
									<?php foreach($biddata as $data){ ?>
										  <tr>
											<td><a  target="_blank" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>artistpreview/<?php echo $data['username']; ?>"><?php echo $data['name']; ?></a></td>
											<td><?php echo $data['price']; ?></td>
											<td><?php echo $data['cr_date']; ?></td>
										  </tr>
									<?php } ?>
										 
								</tbody>
  </table>
						<?php }else{ ?>
							<h2>No result found!!</h2>	
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		
	<?php include('footernew.php'); ?>
 </div>
            
</div>	
	
   
</body> 