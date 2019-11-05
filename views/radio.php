<body class="skin-blue">

    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side strech">
            

            <!-- Main content -->
            <section class="content container">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Radio Host</li>
                    </ol>
                </section>

                <div class="row">
                   <?php 
					if($_REQUEST['workid'] != "" && $_REQUEST['pid'] == 'radio'){
				   ?>
					<div class="col-sm-12">
					<link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>themes/maccaco/projekktor.style.css" type="text/css" media="screen" />
                         <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/projekktor-1.3.09.min.js"></script>
						 <style>
						 .ppscrubber{display:none;} 
						 </style>
						 <div id="player_a" class="projekktor"></div>
						   <script type="text/javascript">
    $(document).ready(function() {
	
        projekktor('#player_a', {
        poster: 'media/logo.png',
        title: 'Radio',
        playerFlashMP3: 'swf/StrobeMediaPlayback/StrobeMediaPlayback.swf',
        width: 640,
		height: 385,
		controls: true,
		continuous: true,
		//disallowSkip:true,
		disablePause: true,
		autoplay: true,
        playlist: [
		 <?php
				date_default_timezone_set('Asia/Calcutta');
				$t_time = date('h:i:s',time()); 
				$qrytime = mysql_query("SELECT * FROM tbl_music where status=1 and uid = '".$_REQUEST['workid']."' and '$t_time' <= end_time limit 1");
				$rowtime = mysql_fetch_row($qrytime);
				 $endtimes=$rowtime[6];
				$nowtimes=$t_time;
				$skiptime = strtotime($nowtimes)-strtotime($endtimes); 
				$qry = mysql_query("SELECT * FROM tbl_music where status=1 and uid = '".$_REQUEST['workid']."' and '$t_time' <= end_time");
				while ($row = mysql_fetch_assoc($qry)) {
			 ?> 
            {
            0: {src: "http://www.mentallica.com/projectone/upload/music/<?php echo $row['image']; ?>", type: "audio/mp3"}
            },
			<?php 
				}
			?>
        ]    
        }, function(player) {	
					diff = Number(<?php echo $skiptime; ?>);		
					player.setPlayhead(diff);
                } // on ready 
        );
    });
    </script>
	Asia/Calcutta Cureent Time :- <?php echo $t_time; ?>
                    </div>
					<?php }else if($_SESSION['po_userses']['flc_usrlogin_id']!=""){ ?>
					<div class="col-sm-12">
                        <button class="btn btn-primary btn-sm pull-right add-new-artist-songs" id="add-new-artist-song">Add New Song</button>
                    </div>
					
					 <!--  column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Music  List</h3>
                            </div><!-- /.box-header -->
                           <div class="table-responsive">          
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Title</th>
										<th>Time</th>
										<th>Start Time</th>
										<th>End Time</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
								<?php
							$i = 1;
							if($controller_class -> getradio != ''){
							foreach($controller_class -> getradio  as $k => $data){

							?>
								<tr>
									<td><?php echo 	$i; ?></td>
									<td><?php echo $data['title']; ?></td>
									<td><?php echo $data['time']; ?></td>
									<td><?php echo $data['start_time']; ?></td>
									<td><?php echo $data['end_time']; ?></td>
									<td>Delete</td>
								</tr>
									<?php
							$i++;
									} 
							}else{ ?>
								<tr height="30">
								  <td colspan="7" align="center" style="color:#FF0000"><strong><?php echo "No radio found."; ?></strong></td>
								</tr>
								<?php } ?>
						</tbody>
					</table>
					</div>
                        </div><!-- /.box -->

                    </div><!--/.col (left) -->
                    <?php } ?>
                </div>   <!-- /.row -->
					
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

	<?php include('footernew.php'); ?>
    <!-- AdminLTE App -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/AdminLTE/app.js" type="text/javascript"></script>

</body>