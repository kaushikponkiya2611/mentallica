<div id="table-content">
  <?php
	$DateInfo=$controller_class -> getCurtYear;
	
?>
<div class="deshbord_banner">
    <!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
    <script type="text/javascript">
		$(function () {
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'line',
						marginRight: 130,
						marginBottom: 25
					},
					title: {
						text: "ProjectName Average Chart",
						x: -20 //center
					},
					subtitle: {
						text: '<?php echo $DateInfo['curtYear'] ?>',
						x: -20
					},
					xAxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
							'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
					},
					yAxis: {
						title: {
							text: 'Total Counts'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						formatter: function() {
								return '<b>'+ this.series.name +'</b><br/>'+
								this.x +': '+ this.y +'';
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					series: [{
						name: 'Artist',
						data: [
								<?php 
								$b=0;
								for($i=1;$i<=$DateInfo['curtMonth'];$i++)
								{
									if($b==0){
										echo $controller_class -> getArtistPerMonth($DateInfo['curtYear'],$i);
									}else{
										echo ",".$controller_class -> getArtistPerMonth($DateInfo['curtYear'],$i);
									}
									$b++;
								}
								?>
							  ]
					},{
						name: 'Client',
						data: [
								<?php 
								$b=0;
								for($i=1;$i<=$DateInfo['curtMonth'];$i++)
								{
									if($b==0){
										echo $controller_class -> getClientPerMonth($DateInfo['curtYear'],$i);
									}else{
										echo ",".$controller_class -> getClientPerMonth($DateInfo['curtYear'],$i);
									}
									$b++;
								}
								?>
							  ]
					},{
						name: 'Company',
						data: [
								<?php 
								$b=0;
								for($i=1;$i<=$DateInfo['curtMonth'];$i++)
								{
									if($b==0){
										echo $controller_class -> getCompanyPerMonth($DateInfo['curtYear'],$i);
									}else{
										echo ",".$controller_class -> getCompanyPerMonth($DateInfo['curtYear'],$i);
									}
									$b++;
								}
								?>
							  ]
					}]
				});
			});
			
		});
		</script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
  </div>
  
