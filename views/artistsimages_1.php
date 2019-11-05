<?php ?>
<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <!-- Right side column. Contains the navbar and content of the page -->
                <aside class="right-side strech">
                    <!-- Main content -->
                    <section class="content container">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                <li class="active">Upload Image</li>
                            </ol>
                        </section>
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Upload Images </h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form" action="" method="post" name="frm_personal_info" id="frm_personal_info" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <?php
                                            if ($controller_class->userdetail['image_limit'] > 0):
                                                $canupload = true;
                                                $_SESSION['po_userses']['login_error'] = '<h4>Upload limit</h4><p>You can upload ' . $controller_class->userdetail['image_limit'] . ' more images.</p>';
                                                $_SESSION['po_userses']['login_error_cls'] = "callout-info";
                                            else:
                                                $canupload = false;
                                                $_SESSION['po_userses']['login_error'] = '<h4>Upgrade Package</h4><p>Upgrade your package to upload more images.</p>';
                                                $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                                            endif;
                                            if (isset($_SESSION['po_userses']['login_error']) && $_SESSION['po_userses']['login_error'] != '') {
                                                ?>
                                                <div class="callout <?php echo $_SESSION['po_userses']['login_error_cls']; ?>">
                                                    <?php echo $_SESSION['po_userses']['login_error']; ?>
                                                </div>
                                                <?php
                                                unset($_SESSION['po_userses']['login_error']);
                                                unset($_SESSION['po_userses']['login_error_cls']);
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="ProfileInputFile">Select image</label>
                                                <input type="file" id="ProfileInputFile" name="file_img_upload" accept="image/*" required />
                                            </div>


                                            <a class="btn btn-success fancybox" href="#inline-pop-rules">Apply Rules</a>

                                            <div id="inline-pop-rules" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-sm-12">
                                                <div id="exTab2" class="row">
                                                    <div class="col-lg-12">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active">
                                                                <a  href="#1" data-toggle="tab">Age</a>
                                                            </li>
                                                            <li><a href="#2" data-toggle="tab">Split the price</a>
                                                            </li>
                                                        </ul>

                                                        <div id="sortable" class="col-lg-12 col-md-12 sol-sm-12 preview-container tab-content">
                                                            <div class="tab-pane active" id="1">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Age</label>
                                                                            <input type="text" required="" id="txt_age_rule" name="txt_age_rule" class="form-control">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="tab-pane" id="2">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title</label>
                                                <input type="text" class="form-control" name="txt_img_title" id="txt_img_title" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Text</label>
                                                <!--<input type="text" class="form-control" name="txt_mobileno"value="" required />-->
                                                <textarea class="form-control" name="txt_img_text"></textarea>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="exampleInputEmail1">Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                    <input type="text" class="form-control" name="txt_img_price" id="txt_img_price" required />
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Price</label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <select class="form-control" name="sel_currency" required >
                                                            <?php foreach ($controller_class->getcurrencylist() as $k => $currency): ?>
                                                                <option value="<?php echo $currency['id']; ?>"><?php echo $currency['cur_text']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="txt_img_price" id="txt_img_price" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category</label>
                                                <select onChange="getsubcat(this.value)" class="form-control" name="sel_category" required >
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($controller_class->gtimgcategory as $key => $cats) {
                                                        ?>
                                                        <option value="<?php echo $cats['id']; ?>"><?php echo $cats['categoryName']; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group" id="div_ajaxcall">
                                                <label for="exampleInputEmail1">Sub Category</label>
                                                <select class="form-control" name="sel_subcategory" required  >
                                                    <option value="">Select Sub Category</option>

                                                </select>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" <?php echo $canupload ? "" : "disabled"; ?> class="btn btn-primary" name="btn_presonal_info">Upload</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </div><!--/.col (left) -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Upload Music </h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form" action="" method="post" name="frm_personal_info" id="frm_personal_info" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <?php
                                            if ($controller_class->userdetail['image_limit'] > 0):
                                                $canupload = true;
                                                $_SESSION['po_userses']['login_error'] = '<h4>Upload limit</h4><p>You can upload ' . $controller_class->userdetail['image_limit'] . ' more images.</p>';
                                                $_SESSION['po_userses']['login_error_cls'] = "callout-info";
                                            else:
                                                $canupload = false;
                                                $_SESSION['po_userses']['login_error'] = '<h4>Upgrade Package</h4><p>Upgrade your package to upload more images.</p>';
                                                $_SESSION['po_userses']['login_error_cls'] = "callout-danger";
                                            endif;
                                            if (isset($_SESSION['po_userses']['login_error']) && $_SESSION['po_userses']['login_error'] != '') {
                                                ?>
                                                <div class="callout <?php echo $_SESSION['po_userses']['login_error_cls']; ?>">
                                                    <?php echo $_SESSION['po_userses']['login_error']; ?>
                                                </div>
                                                <?php
                                                unset($_SESSION['po_userses']['login_error']);
                                                unset($_SESSION['po_userses']['login_error_cls']);
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="ProfileInputFile">Select image</label>
                                                <input type="file" id="ProfileInputFile" name="file_img_upload" accept="image/*" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="ProfileInputFile">Select music</label>
                                                <input type="file" id="ProfileInputMusic" name="file_music_upload" accept="audio/mp3" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title</label>
                                                <input type="text" class="form-control" name="txt_img_title" id="txt_img_title" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Text</label>
                                                <!--<input type="text" class="form-control" name="txt_mobileno"value="" required />-->
                                                <textarea class="form-control" name="txt_img_text"></textarea>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="exampleInputEmail1">Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                    <input type="text" class="form-control" name="txt_img_price" id="txt_img_price" required />
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Price</label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <select class="form-control" name="sel_currency" required >
                                                            <?php foreach ($controller_class->getcurrencylist() as $k => $currency): ?>
                                                                <option value="<?php echo $currency['id']; ?>"><?php echo $currency['cur_text']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" placeholder="Price" name="txt_img_price" id="txt_img_price" required />
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="Dowanload Price" name="txt_dwn_price" id="txt_dwn_price" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" >
                                                <label for="exampleInputEmail1">Category</label>
                                                <select class="form-control" name="sel_category"  onchange="getsubcatmusic(this.value)" required >
                                                    <option value="">Select Category</option>
                                                    <option value="13">DJ</option>
                                                    <option value="14">Producer</option>
                                                    <option value="15">Performer Artist</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="div_ajaxcallmusic">
                                                <label for="exampleInputEmail1">Sub Category</label>
                                                <select class="form-control" name="sel_subcategory" required  >
                                                    <option value="">Select Sub Category</option>

                                                </select>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" <?php echo $canupload ? "" : "disabled"; ?> class="btn btn-primary"name="btn_presonal_info">Upload</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->

                            </div><!--/.col (left) -->

                        </div>   <!-- /.row -->
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->

            <?php include('footernew.php'); ?>
        </div>
    </div>
    <!-- AdminLTE App -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/AdminLTE/app.js" type="text/javascript"></script>
    <script>
                                                    function getsubcat(cat) {
                                                        $.ajax({
                                                            url: site_url + 'controllers/ajax_controller/editimage-ajax-controller.php',
                                                            type: 'post',
                                                            data: 'subcategoryDropdown=1&catid=' + cat,
                                                            success: function (result)
                                                            {
                                                                $("#div_ajaxcall").html(result);
                                                            }
                                                        });
                                                    }

                                                    function getsubcatmusic(cat) {
                                                        $.ajax({
                                                            url: site_url + 'controllers/ajax_controller/editimage-ajax-controller.php',
                                                            type: 'post',
                                                            data: 'subcategoryDropdown=1&catid=' + cat,
                                                            success: function (result)
                                                            {
                                                                $("#div_ajaxcallmusic").html(result);
                                                            }
                                                        });
                                                    }
    </script>
</body>