<?php
$accessdata = $controller_class->_allacess;
$accessdata = $accessdata[0];
/* echo "<pre>";
  print_r($accessdata);
  echo "</pre>"; */
?>
<style>
    .label.label-success:hover,.label.label-danger:hover,.deactive:hover{
        cursor: pointer;
    }
    .accessCheck{
        display:none !important;
    }
    .deactive{
        background-color: #545b62;
        border-color: #4e555b;
        color: #fff;
    }

</style>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <div class="container">
        <div class="row blue-border-main">
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <!-- Main content -->
            <div class="norification">
                <div class="app">
                    <div class="main">
                        <div class="container-fluid">
                            <div class="mainbox-boder">
                                <?php
                                if (isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) {
                                    ?><h2><?php echo "Request's status from artist <strong>" . ucfirst($accessdata['first_name']) . " " . ucfirst($accessdata['last_name']) . "</strong>"; ?></h2>
                                    <?php
                                    $access_approved = explode(",", $accessdata['access_approved']);
                                    ?>
                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>Requests</th>
                                            <th>Status</th>
                                        </tr>
                                        <tr>
                                            <td>Full Profile Access</td>
                                            <td>
                                            <?php
                                                $apr = '';
                                                if (($accessdata['full_profile_access'] != '') && in_array("1", $access_approved)) {
                                                    $apr = '<label class="label label-success">Approved</label>';
                                                } else if (($accessdata['full_profile_access'] != '') && in_array("-1", $access_approved)) {
                                                    $apr = '<label class="label label-danger">Disapproved</label>';
                                                } else if (($accessdata['full_profile_access'] == 'on') && (!in_array("1", $access_approved) || !in_array("-1", $access_approved) )) {
                                                    $apr = '<label class="label label-primary">Pending</label>';
                                                }
                                                echo $apr;
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sidebar Access</td>
                                            <td>
                                                <?php
                                                    $apr = '';
                                                    if (($accessdata['sidebar_access'] != '') && in_array("2", $access_approved)) {
                                                        $apr = '<label class="label label-success">Approved</label>';
                                                    } else if (($accessdata['sidebar_access'] != '') && in_array("-2", $access_approved)) {
                                                        $apr = '<label class="label label-danger">Disapproved</label>';
                                                    } else if (($accessdata['sidebar_access'] == 'on') && (!in_array("2", $access_approved) || !in_array("-2", $access_approved) )) {
                                                        $apr = '<label class="label label-primary">Pending</label>';
                                                    }
                                                    echo $apr;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Categories Access</td>
                                            <td>
                                                <?php
                                                $apr = '';
                                                if (($accessdata['categories_access'] != '') && in_array("3", $access_approved)) {
                                                    $apr = '<label class="label label-success">Approved</label>';
                                                } else if (($accessdata['categories_access'] != '') && in_array("-3", $access_approved)) {
                                                    $apr = '<label class="label label-danger">Disapproved</label>';
                                                } else if (($accessdata['categories_access'] == 'on') && (!in_array("3", $access_approved) || !in_array("-3", $access_approved) )) {
                                                    $apr = '<label class="label label-primary">Pending</label>';
                                                }
                                                echo $apr;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sub Categories Access</td>
                                            <td>
                                                <?php
                                                $apr = '';
                                                if (($accessdata['sub_category_access'] != '') && in_array("4", $access_approved)) {
                                                    $apr = '<label class="label label-success">Approved</label>';
                                                } else if (($accessdata['sub_category_access'] != '') && in_array("-4", $access_approved)) {
                                                    $apr = '<label class="label label-danger">Disapproved</label>';
                                                } else if (($accessdata['sub_category_access'] == 'on') && (!in_array("4", $access_approved) || !in_array("-3", $access_approved) )) {
                                                    $apr = '<label class="label label-primary">Pending</label>';
                                                }
                                                echo $apr;
                                            ?>
                                            </td>
                                        </tr>

                                    </table>    
    <?php
} else {
    ?>
                                    <h2><?php echo "Profile Access Request From <strong>" . ucfirst($accessdata['first_name']) . " " . ucfirst($accessdata['last_name']) . "</strong>"; ?></h2>
                                    <div class="row">
                                        <input type="hidden" name="company_id" id="company_id" value="<?php echo $accessdata['company_id'] ?>"/>
                                        <input type="hidden" name="artist_id" id="artist_id" value="<?php echo $accessdata['artist_id'] ?>"/>
                                        <input type="hidden" id="cmp_assign_id" value="<?php echo $accessdata['cmp_assign_id'] ?>"/>
                                        <div class="col-md-12">
                                            <?php
                                            if ($accessdata['access_approved'] != 'No') {
                                                $access_approved = array();
                                                $access_approved = explode(",", $accessdata['access_approved']);
                                            } else {
                                                $access_approved = 'No';
                                            }
                                            ?>
                                            <table class="table table-responsive table-bordered">
                                                <tr>
                                                    <th>Requests</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                if ($accessdata['full_profile_access'] == 'on') {
                                                    ?>
                                                    <tr>
                                                        <td>Full Profile Access</td>
                                                        <td>
                                                    <?php
                                                    $lbl = "deactive";
                                                    $lbl1 = "deactive";
                                                    $lbltxt = "Approve";
                                                    $lbltxt1 = "Do not approve";
                                                    $check = '';
                                                    $check1 = '';
                                                    if (in_array("1", $access_approved) and $access_approved != 'No') {
                                                        $check = "checked";
                                                        $lbl = "label-success";
                                                    } elseif (in_array("-1", $access_approved) and $access_approved != 'No') {
                                                        $check1 = "checked";
                                                        $lbl1 = "label-success";
                                                    }
                                                    ?>
                                                    <input <?php echo $check ?> id="accessCheck1" type="radio" name="aceess_check" class="accessCheck" value="1"/>
                                                    <label for="accessCheck1" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                    <input <?php echo $check1 ?> id="accessCheck_1" type="radio" name="aceess_check" class="accessCheck" value="-1"/>
                                                    <label for="accessCheck_1" class="label-1 label <?php echo $lbl1 ?>"><?php echo $lbltxt1 ?></label>
                                                    </td>
                                                </tr>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($accessdata['sidebar_access'] == 'on') {
                                                    ?>
                                                    <tr>
                                                        <td>Sidebar Access</td>
                                                        <td>
                                                            <?php
                                                            $lbl = "deactive";
                                                            $lbl1 = "deactive";
                                                            $lbltxt = "Approve";
                                                            $lbltxt1 = "Do not approve";
                                                            $check = '';
                                                            $check1 = '';
                                                            if (in_array("2", $access_approved) and $access_approved != 'No') {
                                                                $check = "checked";
                                                                $lbl = "label-success";
                                                            } elseif (in_array("-2", $access_approved) and $access_approved != 'No') {
                                                                $check1 = "checked";
                                                                $lbl1 = "label-success";
                                                            }
                                                            ?>
                                                            <input <?php echo $check ?> id="accessCheck2" type="radio" name="aceess_check2" class="accessCheck" value="2"/>
                                                            <label for="accessCheck2" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                            <input <?php echo $check1 ?> id="accessCheck_2" type="radio" name="aceess_check2" class="accessCheck" value="-2"/>
                                                            <label for="accessCheck_2" class="label-2 label <?php echo $lbl1 ?>"><?php echo $lbltxt1 ?></label>
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                }
                                                if ($accessdata['categories_access'] != '') {
                                                    ?>
                                                    <tr>
                                                        <td>Categories Access</td>
                                                        <td>
                                                            <?php
                                                            $lbl = "deactive";
                                                            $lbl1 = "deactive";
                                                            $lbltxt = "Approve";
                                                            $lbltxt1 = "Do not approve";
                                                            $check = '';
                                                            $check1 = '';
                                                            if (in_array("3", $access_approved) and $access_approved != 'No') {
                                                                $check = "checked";
                                                                $lbl = "label-success";
                                                            } elseif (in_array("-3", $access_approved) and $access_approved != 'No') {
                                                                $check1 = "checked";
                                                                $lbl1 = "label-success";
                                                            }
                                                            ?>
                                                            <input <?php echo $check ?> id="accessCheck3" type="radio" name="aceess_check3" class="accessCheck" value="3"/>
                                                            <label for="accessCheck3" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                            <input <?php echo $check1 ?> id="accessCheck_3" type="radio" name="aceess_check3" class="accessCheck" value="-3"/>
                                                            <label for="accessCheck_3" class="label-3 label <?php echo $lbl1 ?>"><?php echo $lbltxt1 ?></label>
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                }
                                                if ($accessdata['sub_category_access'] != '') {?>
                                                    <tr>
                                                        <td>Sub Categories Access</td>
                                                        <td>
                                                            <?php
                                                            $lbl = "deactive";
                                                            $lbl1 = "deactive";
                                                            $lbltxt = "Approve";
                                                            $lbltxt1 = "Do not approve";
                                                            $check = '';
                                                            $check1 = '';
                                                            if (in_array("4", $access_approved) and $access_approved != 'No') {
                                                                $check = "checked";
                                                                $lbl = "label-success";
                                                            } elseif (in_array("-4", $access_approved) and $access_approved != 'No') {
                                                                $check1 = "checked";
                                                                $lbl1 = "label-success";
                                                            }
                                                            ?>
                                                            <input <?php echo $check ?> id="accessCheck4" type="radio" name="aceess_check4" class="accessCheck" value="4"/>
                                                            <label for="accessCheck4" class="label <?php echo $lbl ?>"><?php echo $lbltxt ?></label>
                                                            <input <?php echo $check1 ?> id="accessCheck_4" type="radio" name="aceess_check4" class="accessCheck" value="-4"/>
                                                            <label for="accessCheck_4" class="label-4 label <?php echo $lbl1 ?>"><?php echo $lbltxt1 ?></label>
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <center><button type="button" name="btnsave" id="btnsave" class="btn btn-primary" >Save</button></center>
                                            <br/>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footernew.php'); ?>
        </div>
    </div>	
    <script>
        $(document).ready(function () {
            var accessCheck = GetCheckboxValue('accessCheck');
            var cmp_assign_id = $("#cmp_assign_id").val();
            $.ajax({
                url: site_url + 'controllers/ajax_controller/accessdetail-ajax-controller.php',
                type: 'post',
                data: {
                    action: 'approve_access',
                    cmp_assign_id: cmp_assign_id,
                    accessCheck: accessCheck
                },
                success: function (result) {
                }
            });
            $('.accessCheck').click(function () {
                var str1 = $(this).val();
                var str2 = "-";
                if (str1.indexOf(str2) != -1) {
                    $(this).prev('label').removeClass("label-success");
                    $(this).prev('label').addClass("deactive");
                    $(this).next('label').removeClass("deactive");
                    $(this).next('label').addClass("label-success");
                } else {

                    $(this).next('label').removeClass("deactive");
                    $(this).next('label').addClass("label-success");
                    $('.label-' + str1).removeClass("label-success");
                    $('.label-' + str1).addClass("deactive");
                }
            });

            $('#btnsave').click(function () {
                var accessCheck = GetCheckboxValue('accessCheck');
                var cmp_assign_id = $("#cmp_assign_id").val();
                $.ajax({
                    url: site_url + 'controllers/ajax_controller/accessdetail-ajax-controller.php',
                    type: 'post',
                    data: {
                        action: 'approve_access',
                        cmp_assign_id: cmp_assign_id,
                        accessCheck: accessCheck,
                        company_id: $("#company_id").val(),
                        artist_id: $("#artist_id").val()
                    },
                    success: function (result) {
                        window.location.reload();
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