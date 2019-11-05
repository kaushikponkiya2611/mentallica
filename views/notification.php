<?php 
	$noti = $controller_class->getnotifications1;
	
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
					<div class="container">
						<div class="messages">
							<h1>Inbox <span class="icon icon-arrow-down"></span></h1>
							<ul class="message-list mCustomScrollbar">
							
								<?php 
									foreach ($noti as $key => $imgsdata){ 
									
								?>
									<li class="<?php if($key != 0 && ($imgsdata['status'] == '1')) echo 'new'; ?> <?php if($key == 0 ) echo 'active'; ?> noti-list" data-id="<?php echo $imgsdata['id']; ?>">
									<input type="checkbox" />
									<div class="preview">
										<h3><?php echo $imgsdata['name']; ?><small><?php echo date('M d', strtotime( $imgsdata['cr_date'] ));?></small></h3>
										<?php 
                                        if($imgsdata['type'] == 'bid'){ 
                                            ?><p><strong>You got new bid</strong></p><?php 
                                        }
                                        else if($imgsdata['type'] == 'access'){ 
                                            ?><p><strong>You got request for Profile Access </strong></p><?php 
                                        }
                                        else if($imgsdata['type'] == 'company_noti'){ 
                                            ?><p><strong>Your request's status from artist </strong></p><?php 
                                        }
                                        else{ 
                                            ?><p><strong>You got request for rent</strong></p><?php 
                                        } ?>
									</div>
									</li>
									<?php } ?>
							</ul>
							
							
							</div>
						<section class="message">
							<h2>
								<span class="icon icon-star-large"></span> <?php echo $noti[0]['subject']; ?> <span class="icon icon-reply-large"></span><span class="icon icon-delete-large"></span></h2>
							<div class="meta-data">
								<p>
									<img src="http://placehold.it/40x40" class="avatar" alt="" />
									<?php echo $noti[0]['name']; ?> to <span class="user">me</span>
									<span class="date"><?php echo date('M d, Y', strtotime( $imgsdata['cr_date'] ));?></span>
								</p>
							</div>
							<div class="body">
								<p><a  target="_blank" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>artistpreview/<?php echo $noti[0]['username']; ?>"><?php echo $noti[0]['name']; ?></a>,</p>
								<p><?php echo $noti[0]['message']; ?></p>
								<p><?php echo $noti[0]['categoryname']; ?></p>
								<?php if($noti[0]['type'] == 'bid'){ ?>
									<p>View All : <a target="_blank" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>biddetail/?imageid=<?php echo $imgsdata['objectid']; ?>">Click Here</a></p>
								<?php } 
                                
                                if($noti[0]['type'] == 'access'){ ?>
									<p>See All Requests : <a target="_blank" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>accessdetail/?aid=<?php echo $noti[0]['objectid']; ?>">Click Here</a></p>
								<?php }
                                if($noti[0]['type'] == 'company_noti'){ ?>
									<p>See All Requests : <a target="_blank" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>accessdetail/?compnoti=<?php echo $noti[0]['objectid']; ?>">Click Here</a></p>
								<?php }
                                ?>
								
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function (){
				$('message-list').mCustomScrollbar({
					scrollInertia:5000
				})
				$('.noti-list').on('click',function(){
					var dataid = $(this).attr('data-id');
					var Ele = $(this);
					$.ajax({
						method: "POST",
						url: site_url + "controllers/ajax_controller/get-notifications.php",
						data: {id: dataid },
						success :  function(response){
							var returnedData = JSON.parse(response);
							if(returnedData.status){
								$('.message').html(returnedData.nothtml);
								Ele.removeClass('new');
								$('.active').removeClass('active');
								Ele.addClass('active');
							}
						}
					})
				})
			})
		</script>
	<?php include('footernew.php'); ?>
 </div>
</div>	
</body> 