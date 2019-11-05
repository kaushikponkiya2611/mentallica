<body class="skin-blue">

    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side strech">

            <!-- Main content -->
            <section class="content container">


                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Your profile
                        <!--<small>Preview</small>-->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">My Profile</li>
                    </ol>
                </section>
                <div class="row">

                    <?php
                    unset($_SESSION['po_userses']['p_register_user']);
                    if (isset($_SESSION['po_userses']['login_error']) && $_SESSION['po_userses']['login_error'] != '') {
                        ?>
                        <div class="col-md-12">
                            <div class="callout <?php echo $_SESSION['po_userses']['login_error_cls']; ?>">
                                <?php echo $_SESSION['po_userses']['login_error']; ?>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['po_userses']['login_error']);
                        unset($_SESSION['po_userses']['login_error_cls']);
                    }
                    ?>

                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <!--<h3 class="box-title">Personal Information </h3>-->
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="" method="post" name="frm_personal_info" id="frm_personal_info" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First name</label><label class="text-red">*</label>
                                        <input type="text" class="form-control" name="txt_firstname" id="txt_firstname" value="<?php echo $controller_class->userdetail['first_name']; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last name</label><label class="text-red">*</label>
                                        <input type="text" class="form-control" name="txt_lastname" id="txt_lastname" value="<?php echo $controller_class->userdetail['last_name']; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label><label class="text-red">*</label>
                                        <input type="text" class="form-control" name="txt_emailid" id="txt_emailid" value="<?php echo $controller_class->userdetail['emailid']; ?>" disabled="" required />
                                    </div>
<<<<<<< HEAD
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gender</label><label class="text-red">*</label>
                                        <div class="radio" style="padding-left:0px;">
                                            <label>
                                                <input type="radio" name="u_r_gender" id="u_r_gender_male" value="male" <?php
                                                if ($controller_class->userdetail['gender'] == 'male') {
                                                    echo "checked";
                                                }
                                                ?> />
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio"  style="padding-left:0px;">
                                            <label>
                                                <input type="radio" name="u_r_gender" id="u_r_gender_female" value="female" <?php
                                                if ($controller_class->userdetail['gender'] == 'female') {
                                                    echo "checked";
                                                }
                                                ?> />
                                                Female
                                            </label>
                                        </div>

                                        <div class="radio"  style="padding-left:0px;">
                                            <label>
                                                <input type="radio" name="u_r_gender" id="u_r_gender_thirdsex" value="thirdsex" <?php
                                                if ($controller_class->userdetail['gender'] == 'thirdsex') {
                                                    echo "checked";
                                                }
                                                ?> />
                                                Third Sex
                                            </label>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country</label>
                                        <select name="u_r_country" id="u_r_country" class="form-control" required>
                                            <option value="">Select Country</option>
                                            <?php
                                            $allcountry = $controller_class->getAllCountryList();
                                            foreach ($allcountry as $key => $countrylist) :
                                                ?>
                                                <option <?php
                                                if ($controller_class->userdetail['country'] == $countrylist['Id']) {
                                                    echo "selected = 'selected'";
                                                }
                                                ?> value="<?php echo $countrylist['Id']; ?>"><?php echo $countrylist['countryName']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
=======
									
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <select name="u_r_country" id="u_r_country_profile" class="form-control" required>
                                        <option value="">Select Country</option>
                                        <?php
                                        $allcountry = $controller_class -> getAllCountryList();
                                        foreach ($allcountry as $key => $countrylist) :?>
                                            <option <?php if($controller_class -> userdetail['country'] == $countrylist['id']){ echo "selected = 'selected'"; }?> value="<?php echo $countrylist['id'];?>"><?php echo $countrylist['name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">State</label>
                                    <select name="u_r_state" id="u_r_state_profile" class="form-control" >
                                        <option value="">Select State</option>
                                        <?php
                                        $allstate = $controller_class -> getStateListByCountry($controller_class -> userdetail['country']);
                                        foreach ($allstate as $key => $stlist) :?>
                                            <option <?php if($controller_class -> userdetail['state'] == $stlist['id']){ echo "selected = 'selected'"; }?> value="<?php echo $stlist['id'];?>"><?php echo $stlist['name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">City</label><label class="text-red">*</label>
                                       <select name="u_r_city" id="u_r_city_profile" class="form-control" required>
                                            <option value="">Select City</option>
                                            <?php
                                $allcity = $controller_class -> getCityListByState($controller_class -> userdetail['state']);
                                foreach ($allcity as $key => $ctlist) :?>
                                                <option <?php if($controller_class -> userdetail['city'] == $ctlist['id']){ echo "selected = 'selected'"; }?> value="<?php echo $ctlist['id'];?>"><?php echo $ctlist['name'];?></option>
                                            <?php endforeach; ?>
                                        </select>  
                                    </div> 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <textarea name="u_r_address" class="form-control" placeholder="Address" required ><?php echo $controller_class -> userdetail['address'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile number</label>
                                    <input type="text" class="form-control" name="txt_mobileno" id="txt_mobileno" value="<?php echo $controller_class -> userdetail['mobileno'];?>" />
                                </div>
                                <div class="form-group">
								<div class="row">
									<div class="col-xs-12">
									<div class="col-xs-4" style="margin-left:-15px">
                                    <label for="ProfileInputFile">Profile Pic</label>
                                    <input type="file" id="ProfileInputFile" name="file_profile_pic" accept="image/*" />
									</div>
									
									<?php 
									if (is_file($_SESSION['SITE_IMG_PATH']."artist/".$controller_class -> userdetail['image'])) {
										$userimage = $_SESSION['FRNT_DOMAIN_NAME']."upload/artist/thumb/".$controller_class -> userdetail['image'];
									}else{
										$userimage = $_SESSION['FRNT_DOMAIN_NAME']."img/no-profile-picture-icon-620x389.jpg";
									}?>
									<div class="col-xs-8">
									<div class="clearfix"  style="height: 50px; width:50px; background-image: url('<?php echo $userimage; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">&nbsp;</div>
>>>>>>> 8c531e7b533f682f25553cd96685f1f22c7f481d
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">State</label>
                                        <select name="u_r_state" id="u_r_state" class="form-control" >
                                            <option value="">Select State</option>
                                            <?php
                                            $allstate = $controller_class->getStateListByCountry($controller_class->userdetail['country']);
                                            foreach ($allstate as $key => $stlist) :
                                                ?>
                                                <option <?php
                                                if ($controller_class->userdetail['state'] == $stlist['Id']) {
                                                    echo "selected = 'selected'";
                                                }
                                                ?> value="<?php echo $stlist['Id']; ?>"><?php echo $stlist['stateName']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!--<div class="form-group">
                                            <label for="exampleInputEmail1">City</label><label class="text-red">*</label>
                                           <select name="u_r_city" id="u_r_city" class="form-control" required>
                                                <option value="">Select City</option>
                                    <?php
                                    $allcity = $controller_class->getCityListByState($controller_class->userdetail['state']);
                                    foreach ($allcity as $key => $ctlist) :
                                        ?>
                                                                    <option <?php
                                        if ($controller_class->userdetail['city'] == $ctlist['Id']) {
                                            echo "selected = 'selected'";
                                        }
                                        ?> value="<?php echo $ctlist['Id']; ?>"><?php echo $ctlist['cityName']; ?></option>
                                    <?php endforeach; ?>
                                            </select>
                                        </div> -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <textarea name="u_r_address" class="form-control" placeholder="Address" required ><?php echo $controller_class->userdetail['address']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile number</label>
                                        <input type="text" class="form-control" name="txt_mobileno" id="txt_mobileno" value="<?php echo $controller_class->userdetail['mobileno']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="col-xs-4" style="margin-left:-15px">
                                                    <label for="ProfileInputFile">Profile Pic</label>
                                                    <input type="file" id="ProfileInputFile" name="file_profile_pic" accept="image/*" />
                                                </div>

                                                <?php
                                                if (is_file($_SESSION['SITE_IMG_PATH'] . "artist/" . $controller_class->userdetail['image'])) {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/thumb/" . $controller_class->userdetail['image'];
                                                } else {
                                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "img/no-profile-picture-icon-620x389.jpg";
                                                }
                                                ?>
                                                <div class="col-xs-8">
                                                    <div class="clearfix"  style="height: 50px; width:50px; background-image: url('<?php echo $userimage; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;">&nbsp;</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($_SESSION['po_userses']['flc_usrlogin_type'] == 1): ?>
                                        <?php $plan_dtls = $controller_class->getplandetails($controller_class->userdetail['plan_id']); ?>
                                        <div class="form-group">
                                            <label for="ProfileInputFile">Active Plan</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="<?php echo $plan_dtls['plan_name']; ?>" disabled="" />
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ProfileInputFile">Remaining Uploads</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="<?php echo $controller_class->userdetail['image_limit']; ?>" disabled="" />
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_presonal_info" name="btn_presonal_info">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                        <?php if ($_SESSION['po_userses']['flc_usrlogin_type'] == 1): ?>
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Preview Page Settings </h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="" method="post" name="frm_preview_settings" id="frm_preview_settings" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <!--<div class="callout callout-info">
                                            <p><i class="fa fa-info-circle"></i> Selected category will be shown in your preview page in tabular format.</p>
                                        </div>-->
                                        <?php
                                        if ($_SESSION['po_userses']['flc_usrlogin_plan'] == 1):
                                            $restriction = "disabled";
                                            ?>
                                            <div class="callout callout-danger">
                                                <h4>Update your plan</h4>
                                                <p><i class="fa fa-info-circle"></i> Your account type is 'Basic', you cannot select category for preview page. </p>
                                            </div>
                                            <?php
                                        elseif ($_SESSION['po_userses']['flc_usrlogin_plan'] == 2):
                                            $restriction = "";
                                            ?>
                                            <div class="callout callout-danger">
                                                <h4>Update your plan</h4>
                                                <p><i class="fa fa-info-circle"></i> Your account type is 'Silver', you can only select one category for preview page. </p>
                                            </div>
                                            <?php
                                        elseif ($_SESSION['po_userses']['flc_usrlogin_plan'] == 3):
                                            $restriction = "multiple";
                                        endif;
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select category to display on my preview page</label><label class="text-red">*</label>
                                            <select name="sel_category_list[]" data-placeholder="Chose category" class="chosen-select form-control" <?php echo $restriction; ?> required >
                                                <option value=""></option>
                                                <?php
                                                $selected_prv_cat = explode(",", $controller_class->userdetail['preview_category']);
                                                foreach ($controller_class->gtcategory as $key => $cats) {
                                                    ?>
                                                    <option value="<?php echo $cats['id']; ?>" <?php
                                                    if (in_array($cats['id'], $selected_prv_cat)) {
                                                        echo "selected";
                                                    }
                                                    ?> ><?php echo $cats['categoryName']; ?></option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" id="btn_preview_setting" name="btn_preview_setting">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        <?php endif; ?>
                    </div><!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Change Password</h3>
                            </div><!-- /.box-header -->
                            <form role="form" action="" method="post" name="frm_change_password" id="frm_change_password">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Current Password</label><label class="text-red">*</label>
                                        <input type="password" class="form-control" name="txt_current_password" id="txt_current_password" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">New Password</label><label class="text-red">*</label>
                                        <input type="password" class="form-control" name="txt_new_password" id="txt_new_password" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password</label><label class="text-red">*</label>
                                        <input type="password" class="form-control" name="txt_conf_password" id="txt_conf_password" required />
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" id="btn_professional_info" name="btn_professional_info">Update Password</button>
                                </div>
                            </form>
                        </div>
                        <?php if ($_SESSION['po_userses']['flc_usrlogin_type'] == 1): ?>
                            <!-- general form elements disabled -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Upgrade Package</h3>
                                </div><!-- /.box-header -->
                                <form role="form" action="" method="post" name="frm_professional_info" id="frm_professional_info" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <?php
                                        $plan_cls = array('purple', 'teal', 'yellow');
                                        foreach ($controller_class->paidplans as $k => $planlist):
                                            ?>
                                            <div class="col-xs-12">
                                                <!-- small box -->
                                                <div class="small-box bg-<?php echo $plan_cls[$k]; ?>">
                                                    <div class="inner">
                                                        <h3>
                                                            <?php echo $planlist['plan_name']; ?>
                                                        </h3>
                                                        <p>
                                                            You can upload upto <?php echo $planlist['image_limit']; ?> images
                                                        </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-ios7-cart-outline"></i>
                                                    </div>
                                                    <a class="small-box-footer">
                                                        <input type="radio" value="<?php echo $planlist['id']; ?>" name="selected_package" required /> <?php echo $planlist['plan_price'] == '0.00' ? "Free" : "$" . $planlist['plan_price']; ?>
                                                        <!--<p data-toggle="tooltip" data-html="true" title="Demo" class="red-tooltip"><i class="fa fa-arrow-circle-right"></i></p>-->
                                                        <p data-toggle="tooltip" data-html="true" title="Lorem ipsum dolor sit amet, Default Tooltip
                                                           consectetur adipiscing elit" class="red-tooltip"><i class="fa fa-arrow-circle-right"></i></p>

                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div style="clear:both;"></div>
                                        <div class="form-group">
                                            <select name="pay_card_type" class="form-control" required>
                                                <option value="Visa">Visa</option>
                                                <option value="MasterCard">MasterCard</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="pay_card_number" class="form-control" placeholder="Card Number" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="pay_nm_on_card" class="form-control" placeholder="Name on Card" required />
                                        </div>
                                        <div class="form-group">
                                            <select name="pay_month" class="form-control" required>
                                                <option value="">Expiry Month</option>
                                                <?php for ($ic = 1; $ic <= 12; $ic++): ?>
                                                    <option value="<?php echo $ic; ?>"><?php echo $ic; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="pay_year" class="form-control" required>
                                                <option value="">Expiry Year</option>
                                                <?php for ($ic = date("Y"); $ic <= date("Y") + 20; $ic++): ?>
                                                    <option value="<?php echo $ic; ?>"><?php echo $ic; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="pay_cvv" class="form-control" placeholder="CVV Number" required />
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" id="btn_professional_info" name="btn_professional_info">Upgrade Package</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        <?php endif; ?>
                    </div><!--/.col (right) -->
                </div>   <!-- /.row -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>views/javascripts/profilescript.js" type="text/javascript"></script>

    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/chosen/chosen.jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        var config = {
            '.chosen-select': {}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>

</body>