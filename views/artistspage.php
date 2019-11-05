<body class="skin-blue">
    <div class="container">
        <div class="row blue-border-main">
            <!-- header logo: style can be found in header.less -->
            <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <style>
            .chosen-container{
                min-width: 50% !important;
            }
            </style>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <aside class="right-side strech">
                    


                    <!-- Main content -->
                    <section class="company-artist-assign">
                        <div class="container">
                            <div class="mainbox-boder">
                                <div class="row">
                        
                        <div class="col-md-4 align-self-end addMargin pull-right" style="float:right">
                            <form name="set_artist" id="set_artist" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-5 text-right" for="colFormLabelSm" style="line-height:2.5">Current Artist:</label>
                                <div class="col-sm-6">
                                    <?php
                                        $aproved_artist = $controller_class->get_approve_artists();
                                    ?>
                                    <select class="form-control" name="current-artist" id="current-artist">
                                        <option value=""> -select artist- </option>
                                        <?php
                                        foreach ($aproved_artist as $key => $val) {
                                            $sel='';
                                            if($_SESSION['current_artist']==$val['artist_id']){
                                                $sel = "selected";
                                            }
                                            ?><option <?php echo $sel; ?> value="<?php echo $val['artist_id'] ?>"><?php echo $val['first_name'] . ' ' . $val['last_name'] ?></option><?php
                                        }
                                        ?>
                                    </select>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                                <!-- Content Header (Page header) -->
                                    <!--<section class="content-header">
                                        <ol class="breadcrumb">
                                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                        </ol>
                                    </section>-->
                                <!-- Page Header -->
                                <h2><?php echo "Assign Artists" ?></h2>
                                <?php
                                $artistlist = $controller_class->artistslist;
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
                                <form name="assign-artist-form" method="post">
                                    <div class="row">
                                        <div class="col-md-4 addMargin">
                                            <select class="form-control" name="assign-artist">
                                                <option value=""> -- Select Artist --</option>
                                                <?php
                                                foreach ($artistlist as $key => $val) {
                                                    ?><option value="<?php echo $val['id'] ?>"><?php echo $val['first_name'] . ' ' . $val['last_name'] ?></option><?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-md-2 addMargin">
                                            <button type="submit" class="btn btn-primary" name="assign-artist-btn">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-responsive table-bordered">
                                            <tr>
                                                <th>Artist</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php
                                            $result = $controller_class->getCompanyAssignedArtists();
                                            if (!empty($result)) {
                                                $full_profile_access = '';
                                                $sidebar_access = '';
                                                $categories_access = '';
                                                $sub_categories_access = '';
                                                foreach ($result as $key => $val) {
                                                    $full_profile_access = $val['full_profile_access'];
                                                    $sidebar_access = $val['sidebar_access'];
                                                    $categories_access = $val['categories_access'];
                                                    $sub_category_access = $val['sub_category_access'];
                                                    ?>
                                                    <tr class="row<?php echo $val['tbl_id']; ?>">
                                                        <td><?php echo $val['first_name'] . " " . $val['last_name'] ?></td>
                                                        <td><button title="Edit" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal<?php echo $val['artist_id'] ?>"><i class="fa fa-edit"></i></button>
                                                            <button title="Delete" type="button" class="btn btn-danger btn-xs btnDelete" data-id="<?php echo $val['tbl_id']; ?>"><i class="fa fa-trash-o"></i></button>

                                                            <div class="modal fade" id="exampleModal<?php echo $val['artist_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="alert alert-success myAlert" style="display:none"></div>
                                                                            <form method="post" class="save-access-form<?php echo $val['artist_id'] ?>" name="save-access-form">
                                                                                <input id="sel_artist_id" type="hidden" name="artist_id" value="<?php echo $val['artist_id'] ?>"/>
                                                                                <input type="hidden" id="company_id" name="company_id" value="<?php echo $val['company_id'] ?>"/>
                                                                                <input type="hidden" name="save_company_access" value="<?php echo "save_company_access" ?>"/>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-4">Full Profile Access</div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="form-check">
                                                                                            <input <?php echo $full_profile_access == '' ? '' : 'checked' ?> class="form-check-input" type="checkbox" id="full-profile-access" name="full_profile_access" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-4">Sidebar Access</div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="form-check">
                                                                                            <input <?php echo $sidebar_access == '' ? '' : 'checked' ?> class="form-check-input" type="checkbox" id="sidebar-access" name="sidebar_access" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-4">Categories Access</div>
                                                                                    <?php
                                                                                    $rr = $controller_class->getArtistCategories($val['artist_id']);
                                                                                    if ($categories_access != '') {
                                                                                        $categories_access = explode(",", $categories_access);
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="sel_category_list[]" data-placeholder="Chose category" class="chosen-select form-control" id="sel_category_list" required multiple="">
                                                                                            <option value=""></option>
                                                                                            <?php
                                                                                            foreach ($rr as $key => $val2) {
                                                                                                $sel = '';
                                                                                                if ($categories_access != '') {
                                                                                                    if (in_array($val2['id'], $categories_access)) {
                                                                                                        $sel = 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                                <option <?php echo $sel; ?> value="<?php echo $val2['id'] ?>"><?php echo $val2['categoryName'] ?></option>
                                                                                                <?php
                                                                                            }
                                                                                            ?>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-4">Sub Categories Access For</div>
                                                                                    <?php
                                                                                    $sql4 = mysql_query("SELECT *,id as subc FROM tbl_users_sub_categories WHERE status = 1 and cat_id in (" . $val['categories_access'] . ") AND user_id=" . $val['artist_id']);
                                                                                    $rows = array();
                                                                                    while ($row = mysql_fetch_assoc($sql4)) {
                                                                                        array_push($rows, $row);
                                                                                    }
                                                                                    //echo $sub_category_access;
                                                                                    ?>
                                                                                    <div class="col-sm-8" id="div_ajaxcall">
                                                                                        <select name="sel_sub_category_list[]" data-placeholder="Choose categories for sub category access" class="form-control" id="sel_sub_category_list" required multiple="">
                                                                                            <option value="">Select Sub Categories</option>
                                                                                            <?php
                                                                                            $sb = explode(",", $sub_category_access);
                                                                                            foreach ($rows as $key22 => $val22) {
                                                                                                $sele = '';
                                                                                                if ($sb != '') {

                                                                                                    if (in_array($val22['id'], $sb)) {
                                                                                                        $sele = 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                                <option <?php echo $sele; ?> value="<?php echo $val22['id']; ?>" ><?php echo $val22['sub_category_title']; ?></option>    
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <!--                                                                                <div class="form-group row">
                                                                                                                                                                    <div class="col-sm-4">Sub Category Access</div>
                                                                                                                                                                    <div class="col-sm-8">
                                                                                                                                                                        <div class="form-check">
                                                                                
                                                                                                                                                                            <input <?php echo $sub_category_access == '' ? '' : 'checked' ?> class="form-check-input" type="checkbox" id="sub-category-access" name="sub_category_access" />
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>-->
                                                                            </form>   
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" data-aid="<?php echo $val['artist_id'] ?>" class="btn btn-primary btn-access-save">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr class="text-center">
                                                    <td colspan="2">No data found!</td>
                                                </tr>    
                                                <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->
            <?php include('footernew.php'); ?>
        </div>
    </div>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
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
            $('.btn-access-save').click(function () {
                var data_id = $(this).attr("data-aid");
                $.ajax({
                    url: site_url + 'controllers/ajax_controller/artistspage-ajax-controller.php',
                    type: 'post',
                    data: $(".save-access-form" + data_id).serialize(),
                    success: function (result) {
                        $(".myAlert").show();
                        $(".myAlert").html(result);
                        setTimeout(function () {
                            $(".myAlert").empty();
                            $(".myAlert").hide();
                        }, 5000);
                    }
                });
                return false;
            });
            $('.btnDelete').click(function () {
                var data_id = $(this).attr("data-id");
                if (!confirm("Are you sure you want to delete artist?")) {
                    return false;
                } else {
                    $.ajax({
                        url: site_url + 'controllers/ajax_controller/artistspage-ajax-controller.php',
                        type: 'post',
                        data: {
                            action: 'deleteRow',
                            aid: data_id
                        },
                        success: function (result)
                        {
                            $(".row" + data_id).fadeOut('slow');
                        }
                    });
                    return false;
                }
            });
        });
        $(document).ready(function () {
            $("#current-artist").change(function(){
                $("#set_artist").submit();
            })
            $('#sel_category_list').change(function () {
                var sel_artist_id = $("#sel_artist_id").val();
                $.ajax({
                    url: site_url + 'controllers/ajax_controller/artistspage-ajax-controller.php',
                    type: 'post',
                    data: {
                        action: 'get_sub_cat',
                        sel_artist_id: sel_artist_id,
                        cat_id: $(this).val(),
                        company_id:$("#company_id").val()
                    },
                    success: function (result)
                    {
                        $("#div_ajaxcall").html(result);
                    }
                });
                return false;
            });


            /* $("#sel_sub_category_list").on('change', function (evt, params) {
             var main_cat = $('#sel_category_list').val();
             if (main_cat.indexOf(params.selected) > -1) {
             alert('found');
             } else {
             alert('Not Found' + $(this).index());
             //$(this).prop("selected",false);
             //$("#sel_sub_category_list > option").attr("selected",false);
             }
             //alert(params.selected);
             });*/
            /* $('#sel_sub_category_list').change(function(){
             var main_cat = $('#sel_category_list').val();
             var sub_cat = $(this).val();
             alert("Sub cat = "+sub_cat);
             if(main_cat!=''){
             }else{
             alert("Please select category!");
             return false;
             }
             });*/
        });
    </script>
</body>