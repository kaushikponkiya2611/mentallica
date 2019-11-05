<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
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
                                <?php
                                if (is_file($_SESSION['SITE_IMG_PATH'] . "artist/" . $controller_class->userdetail['image'])) {
                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "upload/artist/thumb/" . $controller_class->userdetail['image'];
                                } else {
                                    $userimage = $_SESSION['FRNT_DOMAIN_NAME'] . "img/no-profile-picture-icon-620x389.jpg";
                                }
                                ?>
                                <div>
                                    <div class="clearfix"  style="height: 50px; width:50px; background-image: url('<?php echo $userimage; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;border-radius:  50%;">&nbsp;</div>
                                </div>
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
<!--                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Country</label>
                                                <select name="u_r_country" id="u_r_country" class="form-control" required>
                                                    <option value="">Select Country</option>
                                                    <?php
                                                    $allcountry = $controller_class->getAllCountryList();
                                                    foreach ($allcountry as $key => $countrylist) :
                                                        ?>
                                                        <option <?php
                                                        if ($controller_class->userdetail['country'] == $countrylist['id']) {
                                                            echo "selected = 'selected'";
                                                        }
                                                        ?> value="<?php echo $countrylist['id']; ?>"><?php echo $countrylist['name']; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>-->
<!--                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State</label>
                                                <select name="u_r_state" id="u_r_state" class="form-control" >
                                                    <option value="">Select State</option>
                                                    <?php
                                                    $allstate = $controller_class->getStateListByCountry($controller_class->userdetail['country']);
                                                    foreach ($allstate as $key => $stlist) :
                                                        ?>
                                                        <option <?php
                                                        if ($controller_class->userdetail['state'] == $stlist['id']) {
                                                            echo "selected = 'selected'";
                                                        }
                                                        ?> value="<?php echo $stlist['id']; ?>"><?php echo $stlist['name']; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>-->
<!--                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City</label><label class="text-red">*</label>
                                                <select name="u_r_city" id="u_r_city" class="u_r_city form-control" required>
                                                    <option value="">Select City</option>
                                                    <?php
                                                    $allcity = $controller_class->getCityListByState($controller_class->userdetail['state']);
                                                    foreach ($allcity as $key => $ctlist) :
                                                        ?>
                                                        <option <?php
                                                        if ($controller_class->userdetail['city'] == $ctlist['id']) {
                                                            echo "selected = 'selected'";
                                                        }
                                                        ?> value="<?php echo $ctlist['id']; ?>"><?php echo $ctlist['name']; ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>-->
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

                                            <!-- Assign Artist to company -->
                                            <?php if ($_SESSION['po_userses']['flc_usrlogin_type'] == 3): ?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Assign Artist</label>
                                                    <select multiple="multiple" id="txt_addcategory" name="txt_assign_artist[]" class="form-control">
                                                        <option value=""></option>
                                                        <?php
                                                        $art = $controller_class->getArtists();
                                                        $company_arr = array();
                                                        if ($controller_class->userdetail['cmpny_assigned_artists'] != '') {
                                                            $company_arr = explode(",", $controller_class->userdetail['cmpny_assigned_artists']);
                                                        }
                                                        foreach ($art as $key => $val) {
                                                            $sel = "";
                                                            if (in_array($val['id'], $company_arr)) {
                                                                $sel = "selected";
                                                            }
                                                            ?>
                                                            <option <?php echo $sel ?> value="<?php echo $val['id'] ?>"><?php echo $val['first_name'] . " " . $val['last_name']; ?></option>    
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            <?php endif; ?>

                                            <!-- End -->





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
                                                    <label for="ProfileInputFile">Remaining Coins</label>
                                                    <div class="input-group">
                                                        <?php
                                                        $remaincoins = "Unlimited";
                                                        if ($plan_dtls['image_limit'] > 0) {
                                                            $remaincoins = $controller_class->userdetail['image_limit'];
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control" value="<?php echo $remaincoins; ?>" disabled="" />
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
                                                    //$restriction = "disabled";
                                                    $restriction = "";
                                                    ?>
                                                    <div class="callout callout-danger">
                                                        <h4>Update your plan</h4>
                                                        <p><i class="fa fa-info-circle"></i> Your account type is 'Basic', you can only select one category for preview page. </p>
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
                                                        foreach ($controller_class->getcategorybyplan($_SESSION['po_userses']['flc_usrlogin_plan']) as $key => $cats) {
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
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Paypal Payment Settings </h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form" action="" method="post" name="frm_paypal_settings" id="frm_paypal_settings" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Paypal Email address Show (Yes/No)</label>
                                                <input type="checkbox" class="form-control" <?php echo ($controller_class->userdetail['paypal_email_show'] == 1 ? 'checked' : ''); ?> name="txt_paypalemailshow" id="txt_paypalemailshow" value="1"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Paypal Email address</label>
                                                <input type="text" class="form-control" name="txt_paypalemailid" id="txt_paypalemailid" value="<?php echo $controller_class->userdetail['paypal_email_id']; ?>"/>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary" id="btn_payment_setting" name="btn_payment_setting">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->



                                <!-- Access User Wallet Using Email Otp -->

                                <?php
                                if (isset($_SESSION['wallet_otp']) && $_SESSION['wallet_otp'] != '') {
                                    ?>
                                    <div class="box box-primary">
                                        <div class="box-footer otpGenerateBlock">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bsModal3">
                                                Wallet
                                            </button>    
                                        </div>
                                    </div><!-- /.box -->    
                                    <?php
                                } else {
                                    ?>
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Access Wallet </h3>
                                        </div><!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-footer otpGenerateBlock">
                                            <a href="javascript:void(0)" class="btn btn-primary" id="btn_user_wallet" name="btn_payment_setting">Generate OTP</a>
                                        </div>
                                        <div class="box-footer otpTextBlock" style="display:none;">
                                            <label>OTP sent in registered email!</label>
                                            <input type="text" name="txt_otp" id="txt_otp" class="form-control"/>
                                            <a href="javascript:void(0)" class="btn btn-primary" id="check_otp" name="check_otp">Enter</a>
                                            <!-- <button type="submit" class="btn btn-primary" id="btn_payment_setting" name="btn_payment_setting">Submit</button>-->
                                        </div>
                                    </div><!-- /.box -->    
                                    <?php
                                }
                                ?>

                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">History </h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-footer">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#bsModal4"  class="btn btn-primary" id="btn_user_wallet" name="btn_payment_setting">See History</a>
                                    </div>
                                </div><!-- /.box -->        

                            </div><!--/.col (right) -->
                        </div>   <!-- /.row -->
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->


            <div class="modal fade" id="bsModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <aside class="right-side strech">
                                <?php
                                //$data = $controller_class->getWalletDetail();
                                //clear_input($_SESSION['po_userses']['flc_usrlogin_id'])
                                $data1 = $controller_class->getUserPurchaseHistory($_SESSION['po_userses']['flc_usrlogin_id']);
                                ?>
                                <!-- Main c/9865
                                ontent -->
                                <section class="">
                                    <!-- MAILBOX BEGIN -->
                                    <div class="mailbox row">
                                        <div class="col-xs-12">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Buy </a>
                                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Sell</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <div class="table-responsive" style="margin-top:25px;">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Item</th>
                                                                    <th>Artist</th>
                                                                    <th>Transaction</th>
                                                                    <th>Total</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($data1 as $key => $val) {
                                                                    $data1 = $controller_class->getHistoryArtistDetail($val['item_id']);
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $i; ?></td>
                                                                        <td><?php echo $data1[0]['img_title']; ?></td>
                                                                        <td><?php echo $data1[0]['first_name'] . " " . $data1[0]['last_name']; ?></td>
                                                                        <td><?php echo $val['transaction_id']; ?></td>
                                                                        <td><?php echo $data1[0]['img_price'] ?></td>
                                                                        <td><?php echo $val['payment_date']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <div class="table-responsive" style="margin-top:25px;">
                                                        <?php
                                                        $data1 = $controller_class->getSellerDetail($_SESSION['po_userses']['flc_usrlogin_id']);
                                                        ?>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Item</th>
                                                                    <th>Artist</th>
                                                                    <th>Transaction</th>
                                                                    <th>Total</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($data1 as $key => $val) {
                                                                    $data1 = $controller_class->getHistoryArtistDetail($val['item_id']);
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $i; ?></td>
                                                                        <td><?php echo $data1[0]['img_title']; ?></td>
                                                                        <td><?php echo $data1[0]['first_name'] . " " . $data1[0]['last_name']; ?></td>
                                                                        <td><?php echo $val['transaction_id']; ?></td>
                                                                        <td><?php echo $data1[0]['img_price'] ?></td>
                                                                        <td><?php echo $val['payment_date']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                            </div>                                        
                                        </div><!-- /.col (MAIN) -->
                                    </div>
                                    <!-- MAILBOX END -->

                                </section><!-- /.content -->
                            </aside><!-- /.right-side -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <aside class="right-side strech">
                                <?php
                                $data = $controller_class->getWalletDetail();
                                $wal_bal = 0;
                                if (isset($data['amount']) && !empty($data)) {
                                    $wal_bal = $data['amount'];
                                }
                                ?>
                                <!-- Main content -->
                                <section class="">
                                    <!-- MAILBOX BEGIN -->
                                    <div class="mailbox row">
                                        <div class="col-xs-12">
                                            <div class="box box-solid">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!-- Chat box -->
                                                            <div class="box box-success">
                                                                <div class="box-header">
                                                                    <h3 class="box-title"><i class="fa fa-money"></i> Wallet</h3>
                                                                </div>
                                                            </div><!-- /.box (chat box) -->
                                                            <div class="col-md-6">
                                                                <div class="small-box bg-blue">
                                                                    <div class="inner">
                                                                        <h5>Current Balance</h5>
                                                                        <?php
                                                                        if ($wal_bal == '') {
                                                                            $wal_bal = 0;
                                                                        }
                                                                        ?>
                                                                        <p>$<?php echo $wal_bal ?></p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="ion ion-ios7-cart-outFline"></i>
                                                                    </div>
                                                                </div>
                                                            </div><!-- /.col (RIGHT) -->
                                                            <?php
                                                            if ($wal_bal > 0) {
                                                                ?>
                                                                <div class="col-xs-12 col-sm-4">

                                                                    <div class="small-box1">

                                                                        <div class="inner">
                                                                            <?php
                                                                            $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
                                                                            $qry = "SELECT * FROM tbl_wallet_payout_request WHERE user_id='" . $uid . "'";
                                                                            $rs = mysql_query($qry);
                                                                            $cnt = mysql_num_rows($rs);
                                                                            $row = mysql_fetch_array($rs);
                                                                            if ($cnt > 0) {
                                                                                echo "<h4 style='color:red'>Payout request sent!</h4>";
                                                                            } else {
                                                                                ?>
                                                                                <form name="withdraw" method="post">
                                                                                    <input type="hidden" id="actual_amount" value="<?php echo $wal_bal ?>" name="actual_amount" class="form-control"/>
                                                                                    <!--                                                                    <div class="form-group">
                                                                                    <input required="" type="text" id="with_amount" name="with_amount" class="form-control"/>
                                                                                    </div>-->
                                                                                    <div class="form-group">
                                                                                        <input type="button" id="withdraw-btn" value="Withdraw" name="submit" class="btn btn-success"/>
                                                                                    </div>
                                                                                </form>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="icon">
                                                                            <i class="ion ion-ios7-cart-outFline"></i>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- /.col (RIGHT) -->    
                                                                <?php
                                                            }
                                                            ?>
                                                        </div><!-- /.col (RIGHT) -->
                                                    </div><!-- /.row -->
                                                </div><!-- /.box-body -->
                                            </div><!-- /.box -->
                                        </div><!-- /.col (MAIN) -->
                                    </div>
                                    <!-- MAILBOX END -->

                                </section><!-- /.content -->
                            </aside><!-- /.right-side -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footernew.php'); ?>
        </div>
    </div>

    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>views/javascripts/profilescript.js" type="text/javascript"></script>

    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/chosen/chosen.jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        var config = {
            '.chosen-select': {}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

        $(document).ready(function () {
            $("#btn_user_wallet").click(function () {
                $.ajax({
                    method: "POST",
                    url: site_url + "controllers/ajax_controller/profile-ajax-controller.php",
                    data: {
                        action: "generateOTP",
                    }
                }).done(function (data) {
                    $(".otpGenerateBlock").fadeOut("slow");
                    $(".otpTextBlock").fadeIn("slow");
                    //$("#bsModal3").modal('show');
                });
            });
            $("#check_otp").click(function () {
                var txt_otp = $("#txt_otp").val();
                $.ajax({
                    method: "POST",
                    url: site_url + "controllers/ajax_controller/profile-ajax-controller.php",
                    data: {
                        action: "checkOTP",
                        otp: txt_otp
                    }
                }).done(function (data) {
                    alert(data);

                    $("#bsModal3").modal('show');
                });
            });
        });
        $(document).ready(function () {
            $('#withdraw-btn').click(function () {
                var actual_amount = $("#actual_amount").val();
                var with_amount = $("#with_amount").val();
                if (with_amount != '' && with_amount != '0') {
                    $.ajax({
                        url: site_url + 'controllers/ajax_controller/preview-ajax-controller.php',
                        type: 'post',
                        data: 'userWallet=1&amount=' + actual_amount,
                        //data: 'userWallet=1',
                        success: function (result)
                        {
                            window.location = window.location.href;
                            return false;
                        }
                    });
                }

            });
        });
    </script>
</body>