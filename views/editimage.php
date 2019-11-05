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
                                <?php
                                if ($controller_class->getartistimgdetails['music'] != '') {
                                    ?><h3 class="box-title">Edit Music </h3><?php
                                } else {
                                    ?><h3 class="box-title">Edit Image </h3><?php
                                }
                                ?>

                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="" method="post" name="frm_editimage_info" id="frm_editimage_info" enctype="multipart/form-data">
                                <div class="box-body">
                                    <?php if (isset($_SESSION['po_userses']['login_error']) && $_SESSION['po_userses']['login_error'] != '') {
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
                                        <!--<label for="ProfileInputFile">Select image</label>-->

                                        <div id="imgwrapper">
                                            <img src="<?php echo $_SESSION['SITE_NAME'] . "upload/images/300/" . $controller_class->getartistimgdetails['image']; ?>" title="Image" alt="Image" id="testimg" />
                                        </div>
                                        <br/>
                                        <br/>
                                        <button type="button" class="btn btn-primary" id="rotate-img-right" data-imgtorotate="<?php echo $controller_class->getartistimgdetails['image']; ?>"><i class="fa fa-repeat"></i> Rotate </button>
                                    </div>
                                    <?php
                                    if ($controller_class->getartistimgdetails['music'] != '') {
                                        ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Music</label><br />
                                            <?php //$controller_class->getartistimgdetails['music'] 
                                            
                                                $mArg = explode('/', $controller_class->getartistimgdetails['music']);
                                                echo end($mArg);
                                                echo "<br/>";
                                            ?>
                                            <audio controls src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'].'upload/images/'. end($mArg); ?>">
                                                    Your browser does not support the
                                                    <code>audio</code> element.
                                            </audio>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <!-- Button trigger modal -->
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">Apply Rules</button>
                                    </div>
                                    <!--K- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div id="exTab2" class="row">
                                                        <div class="col-lg-12">
                                                            <ul class="nav nav-tabs">
                                                                <li class="active">
                                                                    <a  href="#1" data-toggle="tab">Age</a>
                                                                </li>
                                                                <li><a href="#2" data-toggle="tab">Split the price</a>
                                                                </li>
                                                            </ul>

                                                            <div id="sortable" style="padding-top:15px" class="col-lg-12 col-md-12 sol-sm-12 preview-container tab-content">
                                                                <?php
                                                                $image_rules = $controller_class->getartistimgdetails['image_rules'];

                                                                $age = '';
                                                                $rules_data = '';
                                                                if ($image_rules != '') {
                                                                    $image_rules = json_decode($image_rules, true);

                                                                    if (isset($image_rules['age']) && $image_rules['age'] != '') {
                                                                        $age = $image_rules['age'];
                                                                        unset($image_rules['age']);
                                                                    }

                                                                    //$image_rules->[0]->artist_id;
                                                                    if (isset($image_rules)) {
                                                                        $rules_data = $image_rules;
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="tab-pane active" id="1">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Age</label>
                                                                            <input type="text" value="<?php echo $age ?>" id="txt_age_rule" name="txt_age_rule" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="2">
                                                                    <div id="mainDiv">
                                                                        <?php
                                                                        $qrya = mysql_query("SELECT * FROM tbl_users where status!='2' and usertype='1' order by cr_date desc");
                                                                        $result = array();
                                                                        while ($ar = mysql_fetch_assoc($qrya)) {
                                                                            array_push($result, $ar);
                                                                        }



                                                                        if (!empty($rules_data)) {
                                                                            foreach ($rules_data as $key1 => $val1) {
                                                                                ?>
                                                                                <div class="one">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="col-lg-6 col-md-6">
                                                                                            <div class="form-group">
                                                                                                <select class="form-control sel-artist" name="artist[]">
                                                                                                    <option value="">Select Artist</option>
                                                                                                    <?php
                                                                                                    foreach ($result as $key => $val) {
                                                                                                        $sel = '';
                                                                                                        if ($val['id'] == $val1['artist_id']) {
                                                                                                            $sel = "selected";
                                                                                                        }
                                                                                                        ?>
                                                                                                        <option <?php echo $sel ?> value="<?php echo $val['id'] ?>"><?php echo $val['first_name'] . " " . $val['last_name'] ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-4 col-md-4">
                                                                                            <div class="form-group sel-price">
                                                                                                <input type="text" name="txt_payment[]" placeholder="payment" value="<?php echo $val1['price'] ?>" class="form-control txt_payment">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-2 col-md-2">
                                                                                            <div class="form-group">
                                                                                                <a href="javascript:void(0)" class="btn btn-success btn-xs add"><i class="fa fa-plus"></i></a>
                                                                                                <a href="javascript:void(0)" class="btn btn-danger btn-xs remove"><i class="fa fa-minus"></i></a>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <div class="one">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="col-lg-6 col-md-6">
                                                                                        <div class="form-group">
                                                                                            <select class="form-control sel-artist" name="artist[]">
                                                                                                <option value="">Select Artist</option>
                                                                                                <?php
                                                                                                foreach ($result as $key => $val) {
                                                                                                    ?>
                                                                                                    <option value="<?php echo $val['id'] ?>"><?php echo $val['first_name'] . " " . $val['last_name'] ?></option>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 col-md-4">
                                                                                        <div class="form-group sel-price">
                                                                                            <input type="text" name="txt_payment[]" placeholder="payment" value="<?php echo $val1->price ?>" class="form-control txt_payment">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-2 col-md-2">
                                                                                        <div class="form-group">
                                                                                            <a href="javascript:void(0)" class="btn btn-success btn-xs add"><i class="fa fa-plus"></i></a>
                                                                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs remove"><i class="fa fa-minus"></i></a>

                                                                                        </div>
                                                                                    </div>
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
                                                </div>
                                                <div class="modal-footer">
                                                    <!--                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                                    <button type="button" id="btn-rules-save" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--K- Modal end -->






                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="txt_img_title" id="txt_img_title" value="<?php echo $controller_class->getartistimgdetails['img_title']; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Text</label>
                                        <!--<input type="text" class="form-control" name="txt_mobileno"value="" required />-->
                                        <textarea class="form-control" name="txt_img_text"><?php echo $controller_class->getartistimgdetails['image_text']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <?php
                                        if ($controller_class->getartistimgdetails['music'] != '') {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select class="form-control" name="sel_currency" required="">
                                                        <?php foreach ($controller_class->getcurrencylist() as $k => $currency): ?>
                                                            <option value="<?php echo $currency['id']; ?>" <?php echo $controller_class->getartistimgdetails['price_currency'] == $currency['id'] ? "selected='selected'" : ""; ?>><?php echo $currency['cur_text']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" placeholder="Price" name="txt_img_price" id="txt_img_price" value="<?php echo $controller_class->getartistimgdetails['img_price']; ?>" required="" type="text">
                                                </div>
                                                <div class="col-md-5">
                                                    <input class="form-control" placeholder="Dowanload Price" name="txt_dwn_price" id="txt_dwn_price" value="<?php echo $controller_class->getartistimgdetails['dowanload_price']; ?>" required="" type="text">
                                                </div>
                                            </div>
                                            <?php
                                        }else {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select class="form-control" name="sel_currency" required >
                                                        <?php foreach ($controller_class->getcurrencylist() as $k => $currency): ?>
                                                            <option value="<?php echo $currency['id']; ?>" <?php echo $controller_class->getartistimgdetails['price_currency'] == $currency['id'] ? "selected='selected'" : ""; ?>><?php echo $currency['cur_text']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="txt_img_price" id="txt_img_price" value="<?php echo $controller_class->getartistimgdetails['img_price']; ?>" required />
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                       
                                    if ($controller_class->getartistimgdetails['music'] != '') {
                                        ?>
                                        <div class="form-group">
                                            <?php
                                            $qrya = mysql_query("SELECT * FROM tbl_users where status!='2' and usertype='1' order by cr_date desc");
                                            $result = array();
                                            while ($ar = mysql_fetch_assoc($qrya)) {
                                                array_push($result, $ar);
                                            }
                                            $music_artist = array();
                                            if($controller_class->getartistimgdetails['music_artist']!=''){
                                                $music_artist = explode(',',$controller_class->getartistimgdetails['music_artist']);
                                            }
                                            
                                            
                                            ?>
                                            <label>Assign Artist</label>
                                            <select class="form-control" multiple="" name="txt_artist_id[]">
                                                <option value="">Select Artist</option>
                                                <?php
                                                foreach ($result as $key => $val) {
                                                    $sel = '';
                                                    if(in_array($val['id'],$music_artist)){
                                                        $sel = "selected";
                                                    }
                                                    ?>
                                                    <option <?php echo $sel ?> value="<?php echo $val['id'] ?>"><?php echo $val['first_name'] . " " . $val['last_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <p>Or</p>
                                        <div class="form-group">
                                            <label>Artist Link</label>
                                            <input type="text" value="<?php echo $controller_class->getartistimgdetails['music_link'] ?>" class="form-control" placeholder="Artist Link.." name="txt_artist_link" id="txt_dwn_price" />
                                        </div>
                                        <?php
                                    }
                                    ?>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <?php
                                        if ($controller_class->getartistimgdetails['music'] != '') {
                                            ?>
                                            <select onchange="getsubcat(this.value)" class="form-control" id="sel_category" name="sel_category" required >
                                                <option value="">Select Category</option>
                                                <option value="13" <?php if ($controller_class->getartistimgdetails['category_id'] == 13): ?> selected="selected"<?php endif; ?>>DJ</option>
                                                <option value="14" <?php if ($controller_class->getartistimgdetails['category_id'] == 14): ?> selected="selected"<?php endif; ?>>Producer</option>
                                                <option value="15" <?php if ($controller_class->getartistimgdetails['category_id'] == 15): ?> selected="selected"<?php endif; ?>>Performer Artist</option>
                                            </select>
                                            <?php
                                        }else {
                                            ?>
                                            <select onchange="getsubcat(this.value)" class="form-control" id="sel_category" name="sel_category" required="" >

                                                <option value="">Select Category</option>
                                                <?php
                                                if (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '') {
                                                    $cat = explode(",", $controller_class->getcompanypageCatAccess());
                                                    foreach ($controller_class->gtcategory as $key => $cats) {
                                                        if (in_array($cats['id'], $cat)) {
                                                            ?>
                                                            <option value="<?php echo $cats['id']; ?>" <?php if ($cats['id'] == $controller_class->getartistimgdetails['category_id']): ?> selected="selected"<?php endif; ?>><?php echo $cats['categoryName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }else {
                                                    foreach ($controller_class->gtcategory as $key => $cats) {
                                                        ?>
                                                        <option value="<?php echo $cats['id']; ?>" <?php if ($cats['id'] == $controller_class->getartistimgdetails['category_id']): ?> selected="selected"<?php endif; ?>><?php echo $cats['categoryName']; ?></option>                                                        <?php
                                        }
                                    }
                                                ?>
                                            </select>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    $subcatacc = 0;
                                    if ((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '')) {
                                        $subcatacc = $controller_class->checkcompanypageAccess('sub_category_access');
                                    } else {
                                        $subcatacc = 1;
                                    }

                                    if ($subcatacc == 1) {
                                        ?>
                                        <div class="form-group" id="div_ajaxcall">
                                            <label for="exampleInputEmail1">Sub Category <?= $subcats['id'] ?></label>
                                            <select class="form-control" name="sel_subcategory" >
                                                <option value="">Select Sub-Category</option>
                                                <?php
                                                if (isset($_SESSION['current_artist']) && $_SESSION['current_artist'] != '') {
                                                    $d = $controller_class->getcompanypageSubCatAccess();
                                                    if ($d != 'empty') {
                                                        $cat = explode(",", $d);
                                                        foreach ($controller_class->gtsubcategory as $key => $subcats) {
                                                            if (in_array($subcats['id'], $cat)) {
                                                                ?><option value="<?php echo $subcats['id']; ?>" <?php if ($subcats['id'] == $controller_class->getartistimgsubcatdetails['subcat_id']): ?> selected="selected"<?php endif; ?>><?php echo $subcats['sub_category_title']; ?></option><?php
                                                            }
                                                        }
                                                    }
                                                }else {
                                                    foreach ($controller_class->gtsubcategory as $key => $subcats) {
                                                        ?>
                                                        <option value="<?php echo $subcats['id']; ?>" <?php if ($subcats['id'] == $controller_class->getartistimgsubcatdetails['subcat_id']): ?> selected="selected"<?php endif; ?>><?php echo $subcats['sub_category_title']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>       
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="btn_editimage_info">Edit Image</button>
                        </div>
                        </form>
                    </div><!-- /.box -->

                </div><!--/.col (left) -->

                </div>   <!-- /.row -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <?php include('footernew.php'); ?>
    <!-- AdminLTE App -->
    <style type="text/css">
        #imgwrapper {
            position: relative;
            /*border:1px solid #000;*/
            width:252px;
            height:294px;
        }
        #imgwrapper img {
            position: absolute;
            /*border: 1px solid red;*/
            left: 50%;
            top: 50%;
            margin-left: -126px;
            margin-top: -147px;
        }
    </style>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/plugins/jQueryRotate/jQueryRotate.js"></script>
    <script type="text/javascript">
                                                var angle = 0;
                                                $(function () {
                                                    $("button#rotate-img-right").click(function () {

                                                        var imgtorot = $(this).data("imgtorotate");

                                                        angle = (angle + 90) % 360;

                                                        var bounds = $("img#testimg").css({
                                                            "transform-origin": "50% 50%",
                                                            "transform": "rotate(" + angle + "deg)",
                                                        })[0].getBoundingClientRect();
                                                        $("#imgwrapper").css({
                                                            width: bounds.width,
                                                            height: bounds.height
                                                        });
                                                        saverotatedimg(90, imgtorot);
                                                    });
                                                });


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

                                                $(document).ready(function () {

                                                    var img = document.getElementById('testimg');
                                                    //or however you get a handle to the IMG
                                                    var imgwidth = img.clientWidth;
                                                    var imgheight = img.clientHeight;

                                                    $("#imgwrapper").css({
                                                        width: imgwidth,
                                                        height: imgheight
                                                    });
                                                    $("img#testimg").css({
                                                        marginLeft: -imgwidth / 2,
                                                        marginTop: -imgheight / 2
                                                    });
                                                    /*$("img#testimg").load(function(){
                                                     var bounds = $(this)[0].getBoundingClientRect();
                                                     $("#imgwrapper").css({
                                                     width: bounds.width,
                                                     height: bounds.height
                                                     });
                                                     $(this).css({
                                                     marginLeft: -bounds.width / 2,
                                                     marginTop: -bounds.height / 2
                                                     });
                                                     }); */
                                                });
                                                function saverotatedimg(degree, imgtorot) {
                                                    $.post(site_url + "controllers/ajax_controller/editimage-ajax-controller.php", {imagerotatechk: "imagerotatechk", rotatedegree: degree, imgtorot: imgtorot}).done(function (data) {
                                                        //alert( "Data Loaded: " + data );
                                                    });
                                                }
                                                $(document).ready(function () {
                                                    //Rules validation start
                                                    $("#btn-apply-rules").click(function () {
                                                        var img_price = $("#txt_img_price").val();
                                                        if (img_price == '' || img_price == '0') {
                                                            alert("Please enter valid image price!");
                                                            return false;
                                                        } else {
                                                            return true;
                                                        }
                                                    })
                                                    $(".txt_payment").on('input', function () {
                                                        var img_price = $("#txt_img_price").val();
                                                        var sum = 0;
                                                        $(".txt_payment").each(function () {
                                                            //alert("every value : "+$(this).val());
                                                            if ($(this).val() != '') {
                                                                sum += parseFloat($(this).val());
                                                            }

                                                        });
                                                        //alert(sum);
                                                        if (100 >= sum) {

                                                        } else {
                                                            alert("You can not split more then main price!");
                                                            $(this).val("");
                                                            $(this).focus();
                                                        }
                                                    });
                                                    $("#btn-rules-save").click(function () {
                                                        var length = $('.txt_payment').length;
                                                        var artist = $('select[name*="artist[]"]').length;
                                                        //alert(artist);
                                                        var artist_price = $('input[name*="txt_payment[]"]').length;
                                                        var arr = [];
                                                        $(".sel-artist").each(function (i) {
                                                            //alert(value);
                                                            var price = $('input[name="txt_payment[]"]')[i].value;

                                                            if ($(this).val() == '' && price != '') {
                                                                arr.push('0');
                                                            } else {
                                                                arr.push('1');
                                                            }
                                                        });
                                                        var checker = {};
                                                        var ch = '0';
                                                        $(".sel-artist").each(function () {
                                                            var selection = $(this).val();
                                                            if (checker[selection]) {
                                                                ch = '1';
                                                                //alert("Artist already selectd!");
                                                                return false;
                                                            } else {
                                                                ch = 0;
                                                                checker[selection] = true;
                                                            }
                                                        });
                                                        if ($.inArray('0', arr) == -1) {
                                                        } else {
                                                            alert("Please select artists!");
                                                            return false;
                                                        }
                                                        if (ch == 0) {
                                                            $('.close').trigger('click');
                                                        } else {
                                                            alert("Duplicate Artist Found!");
                                                            return false;
                                                        }
                                                    });
                                                    //rules validation end

                                                    $(".add").click(function () {
                                                        var checker = {};
                                                        var ch = '0';
                                                        $(".sel-artist").each(function () {
                                                            var selection = $(this).val();
                                                            if (checker[selection]) {
                                                                ch = '1';
                                                                alert("Artist already selectd!");
                                                                return false;
                                                            } else {
                                                                ch = 0;
                                                                checker[selection] = true;
                                                            }
                                                        });

                                                        var img_price = $("#txt_img_price").val();
                                                        var sum = 0;
                                                        $(".txt_payment").each(function () {
                                                            sum += parseFloat($(this).val());
                                                        });
                                                        img_price = img_price - 1;
                                                        if (100 > sum) {
                                                            if (ch == 0) {
                                                                var length = $('.one').length;
                                                                var cloned = $(this).closest('.one').clone(true);
                                                                cloned.appendTo("#mainDiv");
                                                                cloned.find('.txt_payment').val(" ");
                                                                var parent = $(this).closest('.one');
                                                            }

                                                        } else {
                                                            alert("You can not add more split!");
                                                            return false;
                                                        }


                                                        // calculate(parent);
                                                    });
                                                    $('.remove').click(function () {
                                                        if ($('.one').length == 1) {
                                                            alert("This is default row and can't deleted");
                                                            return false;
                                                        }
                                                        var parent = $(this).closest('.one');
                                                        $(this).parents(".one").remove();
                                                        //calculate(parent);
                                                        // reset serial numbers again

                                                    });
                                                });

                                                $(document).on('keyup', '.quantity, .net_rate', function () {
                                                    var parent = $(this).closest('.one');
                                                    //calculate(parent);
                                                })


                                                function calculate(e) {
                                                    var q = +$(e).find('.sel-artist').val();
                                                    var n = +$(e).find('.sel-price').val();
                                                    var sum = 0;

                                                }
                                                ;
    </script>
</body>