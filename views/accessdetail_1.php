<?php 
	$accessdata = $controller_class->_allacess;
    $accessdata = $accessdata[0];
    //echo "<pre>";
    // print_r($accessdata);
    //echo "</pre>";
?>
<style>
    .label.label-success:hover,.label.label-danger:hover{
        cursor: pointer;
    }
    .accessCheck{
        display:none !important;
    }
    .btn-default.btn-on.active{background-color: #5BB75B;color: white;}
    .btn-default.btn-off.active{background-color: #DA4F49;color: white;}

    .btn-default.btn-on-1.active{background-color: #006FFC;color: white;}
    .btn-default.btn-off-1.active{background-color: #DA4F49;color: white;}

    .btn-default.btn-on-2.active{background-color: #00D590;color: white;}
    .btn-default.btn-off-2.active{background-color: #A7A7A7;color: white;}

    .btn-default.btn-on-3.active{color: #5BB75B;font-weight:bolder;}
    .btn-default.btn-off-3.active{color: #DA4F49;font-weight:bolder;}

    .btn-default.btn-on-4.active{background-color: #006FFC;color: #5BB75B;}
    .btn-default.btn-off-4.active{background-color: #DA4F49;color: #DA4F49;}
</style>
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
                        <div class="mainbox-boder">
                            <h2><?php echo "Profile Access Request From <strong>".ucfirst($accessdata['first_name'])." ".ucfirst($accessdata['last_name'])."</strong>"; ?></h2>
                            <div class="row">
                                <input type="hidden" id="cmp_assign_id" value="<?php echo $accessdata['cmp_assign_id']?>"/>
                                <div class="col-md-12">
                                    <?php
                                    
                                    if($accessdata['access_approved']!='No'){
                                        $access_approved = array();
                                        $access_approved = explode(",", $accessdata['access_approved']);
                                    }else{
                                        $access_approved = 'No';
                                    }
                                    ?>
                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>Requests</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        if($accessdata['full_profile_access']=='on'){
                                            ?>
                                        
                                            <tr>
                                                <td>Full Profile Access</td>
                                                <td>
                                                    <?php
                                                        if(in_array("1",$access_approved) and $access_approved!='No'){
                                                            $check = "checked";
                                                            $lbl = "label-success";
                                                            $lbl2 = "label-secondary";
                                                            $lbltxt = "Approved";
                                                        }else{
                                                            $check = "";
                                                            $lbl = "label-secondary";
                                                            $lbl2 = "label-success";
                                                            $lbltxt = "Click to approve";
                                                        }
                                                        $lbltxt2 = 'Do not approve'
                                                    ?>
                                                    
                                                    <div class="btn-group" id="status" data-toggle="buttons">
                                                        <label class="btn btn-default btn-on btn-xs active">
                                                            <input <?php echo $check ?> id="accessCheck1" type="radio" name="aceess_check" class="accessCheck" value="1"/>
                                                        Approve
                                                        </label>
                                                        <label class="btn btn-default btn-off btn-xs ">
                                                            <input <?php echo $check ?> id="accessCheck1" type="radio" name="aceess_check" class="accessCheck" value=""/>Do not approve</label>
                                                    </div>
                                                    
                                                    
                                                    <input <?php echo $check ?> id="accessCheck1" type="radio" name="aceess_check" class="accessCheck" value="1"/>
                                                    
                                                    <label for="accessCheck1" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                    <input <?php echo $check ?> id="accessCheckDis1" type="radio" name="aceess_check" class="accessCheck" value="1"/>
                                                    <label for="accessCheckDis1" class="label2 active label <?php echo $lbl2 ?>"><?php echo $lbltxt2 ?></label>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if($accessdata['sidebar_access']=='on'){
                                            ?>
                                            <tr>
                                                <td>Sidebar Access</td>
                                                <td>
                                                    <?php
                                                        if(in_array("2",$access_approved) and $access_approved!='No'){
                                                            $check = "checked";
                                                            $lbl = "label-danger";
                                                            $lbltxt = "Approved";
                                                        }else{
                                                            $check = "";
                                                            $lbl = "label-success";
                                                            $lbltxt = "Click to approve";
                                                        }
                                                    ?>
                                                    <input <?php echo $check ?> id="accessCheck2" type="checkbox" name="aceess_check" class="accessCheck" value="2"/>
                                                    <label for="accessCheck2" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                </td>
                                            </tr>    
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if($accessdata['categories_access']!=''){
                                            ?>
                                            <tr>
                                                <td>Categories Access</td>
                                                <td>
                                                    <?php
                                                        if(in_array("3",$access_approved) and $access_approved!='No'){
                                                            $check = "checked";
                                                            $lbl = "label-danger";
                                                            $lbltxt = "Approved";
                                                        }else{
                                                            $check = "";
                                                            $lbl = "label-success";
                                                            $lbltxt = "Click to approve";
                                                        }
                                                    ?>
                                                    <input <?php echo $check ?> id="accessCheck3" type="checkbox" name="aceess_check" class="accessCheck" value="3"/>
                                                    <label for="accessCheck3" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                </td>
                                            </tr>    
                                            <?php
                                        }
                                        if($accessdata['sub_category_access']!=''){
                                            ?>
                                            <tr>
                                                <td>Sub Categories Access</td>
                                                <td>
                                                    <?php
                                                        if(in_array("4",$access_approved) and $access_approved!='No'){
                                                            $check = "checked";
                                                            $lbl = "label-danger";
                                                            $lbltxt = "Approved";
                                                        }else{
                                                            $check = "";
                                                            $lbl = "label-success";
                                                            $lbltxt = "Click to approve";
                                                        }
                                                    ?>
                                                    <input <?php echo $check ?> id="accessCheck4" type="checkbox" name="aceess_check" class="accessCheck" value="4"/>
                                                    <label for="accessCheck4" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                </td>
                                            </tr>    
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	<?php include('footernew.php'); ?>
 </div>
</div>	
<script>
$(document).ready(function(){
    var accessCheck = GetCheckboxValue('accessCheck');
    var cmp_assign_id = $("#cmp_assign_id").val();
    $.ajax({
        url: site_url + 'controllers/ajax_controller/accessdetail-ajax-controller.php',
        type: 'post',
        data: {
            action: 'approve_access',
            cmp_assign_id:cmp_assign_id,
            accessCheck: accessCheck
        },
        success: function (result) {
        }
    });
    $('.accessCheck').click(function(){
        var accessCheck = GetCheckboxValue('accessCheck');
        if($(this).is(":checked")){
            $(this).next('label').removeClass("label-success");
            $(this).next('label').addClass("label-danger");
            $(this).next('label').text("Approve");
        }else{
            $(this).next('label').removeClass("label-danger");
            $(this).next('label').addClass("label-success");
            $(this).next('label').text("Click to Approve");
        }
        var cmp_assign_id = $("#cmp_assign_id").val();
        $.ajax({
            url: site_url + 'controllers/ajax_controller/accessdetail-ajax-controller.php',
            type: 'post',
            data: {
                    action: 'approve_access',
                    cmp_assign_id:cmp_assign_id,
                    accessCheck: accessCheck
                },
            success: function (result) {
                
            }
        });
        //return false;
    });
});
function GetCheckboxValue(par) {
    var values = $('.' + par + ':checked').map(function () {
        return this.value;
    }).get().join(',');
    return values;
}
</script>
</body> 