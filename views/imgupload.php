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
                                                if($controller_class->userdetail['available_size']!=''){
                                                    $available_size = $controller_class->userdetail['available_size'] / 1024;
                                                }else{
                                                    $available_size = $controller_class->userdetail['image_limit'] * $controller_class->getSettings['mb_to_coin'];
                                                    $available_size = $available_size / 1024;
                                                }
                                                
                                               // $_SESSION['po_userses']['login_error'] = '<h4>Upload limit</h4><p>You can upload ' . $controller_class->userdetail['image_limit'] . ' more images or you have remail limit '.number_format((float)$available_size, 2, '.', '').' MB.</p>';
                                                
                                                $_SESSION['po_userses']['login_error'] = '<h4>You have remain upload limit <strong>'.number_format((float)$available_size, 2, '.', '').' MB <i>('. $controller_class->userdetail['image_limit'].' Coins)</i> </strong> </p>';
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
                                            <!-- Button trigger modal -->
                                            <div class="form-group">
                                                <button type="button" id="btn-apply-rules" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">Apply Rules</button>
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
                                                                        <div class="tab-pane active" id="1">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleInputEmail1">Age</label>
                                                                                        <input type="text"  id="txt_age_rule" name="txt_age_rule" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="2">
                                                                            <div id="mainDiv">
                                                                                <div class="one">
                                                                                    <div class="row">
                                                                                        <?php
                                                                                          $qrya = mysql_query("SELECT * FROM tbl_users where status!='2' and usertype='1' order by cr_date desc");
                                                                                          $result = array();
                                                                                          while($ar = mysql_fetch_assoc($qrya)){
                                                                                              array_push($result,$ar);
                                                                                          }

                                                                                       ?>
                                                                                      <div class="col-lg-6 col-md-6">
                                                                                          <div class="form-group">
                                                                                              <select class="form-control sel-artist" name="artist[]">
                                                                                                  <option value="">Select Artist</option>
                                                                                                  <?php
                                                                                                  foreach($result as $key=>$val){
                                                                                                      ?>
                                                                                                      <option value="<?php echo $val['id'] ?>"><?php echo $val['first_name']." ".$val['last_name']?></option>
                                                                                                      <?php
                                                                                                  }
                                                                                                  ?>
                                                                                              </select>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col-lg-4 col-md-4">
                                                                                          <div class="form-group sel-price">
                                                                                              <input type="text" name="txt_payment[]" placeholder="payment" class="form-control txt_payment">
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
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
<!--                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<button type="button" id="btn-rules-save"  class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!--K- Modal end -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category</label>
                                                <select onChange="getsubcat(this.value)" class="form-control" name="sel_category" required >
                                                    <option value="">Select Category</option>
                                                    <?php 
                                                    //foreach ($controller_class->gtimgcategory as $key => $cats) {
                                                    if (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='') {
                                                        $cat = explode(",", $controller_class->getcompanypageCatAccess());
                                                        foreach ($controller_class->gtcategory as $key => $cats) {
                                                            if(in_array($cats['id'], $cat)){
                                                                ?>
                                                                <option value="<?php echo $cats['id']; ?>"><?php echo $cats['categoryName']; ?></option>
                                                                <?php 
                                                            }

                                                        }
                                                    }else{
                                                        foreach ($controller_class->gtcategory as $key => $cats) {
                                                            ?>
                                                            <option value="<?php echo $cats['id']; ?>"><?php echo $cats['categoryName']; ?></option>
                                                            <?php 
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <?php
                                            $sidebar = 0;
                                            if((isset($_SESSION['po_userses']['flc_usrlogin_type']) && $_SESSION['po_userses']['flc_usrlogin_type'] == 3) && (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='')){
                                                 $sidebar = $controller_class->checkcompanypageAccess('sub_category_access');
                                            }else{
                                                $sidebar = 1;
                                            }
                                            
                                            if($sidebar==1){
                                                ?>
                                                <div class="form-group" id="div_ajaxcall">
                                                    <label for="exampleInputEmail1">Sub Category</label>
                                                    <select class="form-control" name="sel_subcategory" required  >
                                                        <option value="">Select Sub Category</option>

                                                    </select>
                                                </div>
                                                <?php
                                            }
                                            ?>
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
                                            <div class="form-group">
                                                <?php
                                                    $qrya = mysql_query("SELECT * FROM tbl_users where status!='2' and usertype='1' order by cr_date desc");
                                                    $result = array();
                                                    while($ar = mysql_fetch_assoc($qrya)){
                                                        array_push($result,$ar);
                                                    }

                                                 ?>
                                                <label>Assign Artist</label>
                                                <select class="form-control" multiple="" name="txt_artist_id[]">
                                                    <option value="">Select Artist</option>
                                                    <?php
                                                    foreach($result as $key=>$val){
                                                        ?>
                                                        <option value="<?php echo $val['id'] ?>"><?php echo $val['first_name']." ".$val['last_name']?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <p>Or</p>
                                            <div class="form-group">
                                                 <label>Artist Link</label>
                                                <input type="text" class="form-control" placeholder="Artist Link.." name="txt_artist_link" id="txt_dwn_price" />
                                            </div>
                                            <div class="form-group" >
                                                
                                                <label for="exampleInputEmail1">Category</label>
                                                  <?php
                                                   
                                                    //foreach ($controller_class->gtimgcategory as $key => $cats) {
                                                    
                                                     if (isset($_SESSION['current_artist']) && $_SESSION['current_artist']!='') {
                                                       $cat = explode(",", $controller_class->getcompanypageCatAccess());
                                                       ?>
                                                        <select class="form-control" name="sel_category"  onchange="getsubcatmusic(this.value)" required >
                                                            <option value="">Select Category</option>
                                                            <?php
                                                            if(in_array('13', $cat)){
                                                            ?><option value="13">DJ</option><?php
                                                            }
                                                            if(in_array('14', $cat)){
                                                            ?><option value="14">Producer</option><?php
                                                            }
                                                            if(in_array('15', $cat)){
                                                            ?><option value="15">Performer Artist</option><?php
                                                            }
                                                            ?>
                                                        </select>   
                                                        <?php
                                                    }else{
                                                       
                                                        
                                                        ?>
                                                        <select class="form-control" name="sel_category"  onchange="getsubcatmusic(this.value)" required >
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        
                                                        foreach ($controller_class->gtcategory as $key => $cats) {
                                                           
                                                            if('13'== $cats['id']){
                                                            ?><option value="13">DJ</option><?php
                                                            }
                                                            if('14' == $cats['id']){
                                                            ?><option value="14">Producer</option><?php
                                                            }
                                                            if('15' == $cats['id']){
                                                            ?><option value="15">Performer Artist</option><?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                        <?php
                                                    }
                                                   
                                                    ?>
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
        
        //K - Split the price
            $(document).ready(function () {
                //Rules validation start
                $("#btn-apply-rules").click(function(){
                    var img_price = $("#txt_img_price").val();
                    if(img_price=='' || img_price=='0'){
                        alert("Please enter valid image price!");
                        return false;
                    }else{
                        return true;
                    }
                })
                $(".txt_payment").on('input',function(){
                    var img_price = $("#txt_img_price").val();
                    var sum = 0;
                    $(".txt_payment").each(function(){
                        //alert("every value : "+$(this).val());
                        if($(this).val()!=''){
                            sum += parseFloat($(this).val());
                        }
                        
                    });
                    //alert(sum);
                    if(100 >= sum){

                    }else{
                        alert("You can not split more then main price!");
                        $(this).val("");
                        $(this).focus();
                    }
                });
                $("#btn-rules-save").click(function(){
                    var length = $('.txt_payment').length;
                    var artist = $('select[name*="artist[]"]').length;
                    //alert(artist);
                    var artist_price = $('input[name*="txt_payment[]"]').length;
                    var arr = [];
                    $(".sel-artist").each(function(i){
                        //alert(value);
                        var price = $('input[name="txt_payment[]"]')[i].value;
                       
                         if($(this).val()=='' && price!=''){
                            arr.push('0');
                         }else{
                             arr.push('1'); 
                         }
                    });
                    var checker = {};
                    var ch = '0';
                    $(".sel-artist").each(function() {
                        var selection = $(this).val();
                        if ( checker[selection] ) {
                            ch ='1';
                            //alert("Artist already selectd!");
                            return false;
                        } else {
                            ch = 0;
                            checker[selection] = true;
                        }
                    });
                    if($.inArray('0',arr) == -1){
                    }else{
                        alert("Please select artists!");
                        return false;
                    }
                    if(ch==0){
                         $('.close').trigger('click');
                    }else{
                        alert("Duplicate Artist Found!");
                        return false;
                    }
                });
                //rules validation end
                
                $(".add").click(function () {
                    var checker = {};
                    var ch = '0';
                    $(".sel-artist").each(function() {
                        var selection = $(this).val();
                        if ( checker[selection] ) {
                            ch ='1';
                            alert("Artist already selectd!");
                            return false;
                        } else {
                            ch = 0;
                            checker[selection] = true;
                        }
                    });
                    
                    var img_price = $("#txt_img_price").val();
                    var sum = 0;
                    $(".txt_payment").each(function(){
                        sum += parseFloat($(this).val());
                    });
                    img_price = img_price - 1;
                    if(100 > sum){
                        if(ch == 0){
                            var length = $('.one').length;
                            var cloned = $(this).closest('.one').clone(true);        
                            cloned.appendTo("#mainDiv");
                            cloned.find('.txt_payment').val(" ");
                            var parent = $(this).closest('.one');
                        }
                        
                    }else{
                        alert("You can not add more split!");
                        return false;
                    }
                    
                    
                   // calculate(parent);
                });
                $('.remove').click(function () {
                    if($('.one').length==1){
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


            function calculate(e){
                var q = +$(e).find('.sel-artist').val();
                var n = +$(e).find('.sel-price').val();
                var sum = 0;

            };
        
    </script>
</body>