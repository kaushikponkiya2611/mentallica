<body class="skin-blue">
	<div class="container">
    	<div class="row blue-border-main">
    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");?>

        <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                

                <!-- Main content -->
                <section class="content">
                    <?php /* ?>
                    <!-- row -->
                    <div class="row">
                        <?php foreach ($controller_class -> getuserimages as $key => $imgsdata):?>
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <?php if($_SESSION['po_userses']['flc_usrlogin_plan'] == 3):?>
                            <a href="<?php echo $_SESSION['SITE_NAME']."upload/images/".$imgsdata['image']; ?>" class="example-image-link thumb" data-lightbox="example-set" data-title="<?php echo $imgsdata['image_text'];?>">
                                <img src="<?php echo $_SESSION['SITE_NAME']."upload/images/300/".$imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                            </a>
                            <?php else: ?>
                                <img src="<?php echo $_SESSION['SITE_NAME']."upload/images/300/".$imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                            <?php endif;?>
                        </div>    
                        <?php endforeach; ?>   
                    </div><!-- /.row -->
                    <?php */ ?>
                    <div class="container">

                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                <li class="active">Preview</li>
                            </ol>
                        </section>
                        <!-- Page Header -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">NewsLetters
                                    <small>You can manage your newsletter form here.</small>
                                </h1>
                            </div>
                        </div>
                        
                        <div class="row">
                            testing
                        </div>

                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    <?php include('footernew.php'); ?>
    </div>
    </div>
    
    <!-- Popup -->
    <div id="inline-pop-add-newsletter" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Newsletter</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form enctype="multipart/form-data" id="frm_add_newsletter" name="frm_add_newsletter" method="post" action="" role="form" onSubmit="return addnewnewsletter()">
                        <div class="box-body">
                                                                    
                            <div class="form-group">
                                <label for="txt_newsletter_title">Newsletter Title</label>
                                <input type="text" required="" id="txt_newsletter_title" name="txt_newsletter_title" class="form-control">
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button name="btn_newsletter" class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="inline-pop-dlt-newsletter" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    
                        <div class="box-body">
                                                                    
                            <div class="form-group">
                                <label>Are you sure you want to delete this newsletter?</label>
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="dltnewsletter" id="dltnewsletter" />
                        <div class="box-footer">
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="dltnewnewsletter()">Delete</button>
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div id="inline-pop-add-subcategory" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Sub Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form enctype="multipart/form-data" id="frm_add_subcategory" name="frm_add_subcategory" method="post" action="" role="form" onSubmit="return addnewsubcategory()">
                        <div class="box-body">
                                                                    
                            <div class="form-group">
                                <label for="txt_subcat_title">Submenu Title</label>
                                <input type="text" required="" id="txt_subcat_title" name="txt_subcat_title" class="form-control">
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="stbcatcat" id="stbcatcat" />
                        <div class="box-footer">
                            <button name="btn_subcat" class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="inline-pop-dlt-subcat" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    
                        <div class="box-body">
                                                                    
                            <div class="form-group">
                                <label for="txt_subcat_title">Are you sure you want to delete this sub category?</label>
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="dltstbcatcat" id="dltstbcatcat" />
                        <input type="hidden" name="prtcategory" id="prtcategory" />
                        <div class="box-footer">
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="dltnewsubcategory()">Delete</button>
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#inline-pop-bulkaction-cnf" class="fancybox" id="bulkactcnfatag" style="display:none;">&nbsp;</a>
    <div id="inline-pop-bulkaction-cnf" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <form enctype="multipart/form-data" id="frm_bulkaction_cnf" name="frm_bulkaction_cnf" method="post" action="" role="form" onSubmit="return proccatbulkaction()">
                        <div class="box-body">
                                                                    
                            <div class="form-group">
                                <label for="txt_subcat_title" id="bulkactcnfatag_lab"></label>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="bulkactcnfatag_sel" required >
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="bulkactcnfatag_chklist" id="bulkactcnfatag_chklist" />
                        <input type="hidden" name="bulkactcnfatag_catdata" id="bulkactcnfatag_catdata" />
                        <input type="hidden" name="bulkactcnfatag_bulkact" id="bulkactcnfatag_bulkact" />
                        <div class="box-footer">
                            <button name="btn_subcat" id="bulkactcnfatag_btn" class="btn btn-primary" type="submit">Yes</button>
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="#inline-pop-actremove-cnf" class="fancybox" id="removesubcatimgcnfatag" style="display:none;">&nbsp;</a>
    <div id="inline-pop-actremove-cnf" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 portfolio-item">
                <div class="box box-primary">
                    <form enctype="multipart/form-data" id="frm_bulkaction_cnf" name="frm_bulkaction_cnf" method="post" action="" role="form" onSubmit="return procrmvimgfrmsubcat()">
                        <div class="box-body">
                                                                    
                            <div class="form-group">
                                <label for="txt_subcat_title" id="removesubcatimgcnfatag_lab">Are you sure you want to remove selected image(s) from subcategory?</label>
                            </div>

                        </div><!-- /.box-body -->
                        <input type="hidden" name="removesubcatimgcnfatag_chklist" id="removesubcatimgcnfatag_chklist" />
                        <input type="hidden" name="removesubcatimgcnfatag_catdata" id="removesubcatimgcnfatag_catdata" />
                        <input type="hidden" name="removesubcatimgcnfatag_subcati" id="removesubcatimgcnfatag_subcati" />
                        <input type="hidden" name="removesubcatimgcnfatag_bulkact" id="removesubcatimgcnfatag_bulkact" />
                        <div class="box-footer">
                            <button name="btn_subcat" id="removesubcatimgcnfatag_btn" class="btn btn-primary" type="submit">Remove</button>
                            <button name="btn_subcat" class="btn btn-primary" type="button" onClick="$.fancybox.close();">Cancle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="inline-pop-usr-img" style="max-width:900px;display: none;" class="col-lg-12 col-md-12 col-xs-12">
        <div class="row" id="usrimgpopcntrow"></div>
    </div>
    <!-- End Popup -->

    <!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>views/javascripts/homescript.js" type="text/javascript"></script>-->

    <!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/bootstrap.min.js"></script>-->

    <link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/jquery-ui/jquery-ui.css">
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
    
    <style>
        div.preview-container { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
        /*div.preview-item { margin: 5px; padding: 5px; width: 150px }*/
    </style>
    <script>
	$(document).ready(function(){
    $('.snwlt_sendto').on('change', function() {
      if ( this.value == 'mentallicafollower')
      {
        $(".showhidefilter").show();
      }
      else
      {
        $(".showhidefilter").hide();
      }
    });
	});
    </script>
    <script>
	

        $(function() {
        <?php if(!empty($artistnewsletters)):
            foreach ($artistnewsletters as $key => $newsletterscripts):?>
                $("#newslettereditor-<?php echo $newsletterscripts['id'];?>").gridmanager({
                    remoteURL:site_url+'controllers/ajax_controller/save-newsletter-ajax-controller.php?newsletter=<?php echo $newsletterscripts["id"];?>',
                     debug: 1,
                    controlButtons: []}
                );
            <?php endforeach; ?>
        <?php endif; ?>
        //$( "div.preview-container, div.preview-item" ).disableSelection();
        });

        function addnewnewsletter(){
            var newslettertitle = $("#txt_newsletter_title").val();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/newsletter-ajax-controller.php",
                data: { addnewnewsletterchk: "addnewnewsletterchk", newslettertitle: newslettertitle }
            })
            .done(function( data ) {
                //alert("back to tab");
                $('#frm_add_newsletter').trigger('reset');
                $.fancybox.close();
                location.reload();
            });

            return false;
        }

        function opendltnewsletterpopup(newsletter){
            $("#dltnewsletter").val(newsletter);
        }

        function dltnewnewsletter(){
            var dltnewsletter = $("#dltnewsletter").val();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/newsletter-ajax-controller.php",
                data: { dltnewnewsletterchk: "dltnewnewsletterchk", dltnewsletter: dltnewsletter }
            })
            .done(function( data ) {
                //alert("back to tab");
                $.fancybox.close();
                location.reload();
            });

            return false;
        }

        $(document).ready(function(){
            initbasicevents();
        });

        function initbasicevents(){
            $(".remove-cross").unbind("click");
            $(".undo-cross").unbind("click");
            $(".remove-cross").click(function(){
                moveitemtohiddentab(this);
            });
            $(".undo-cross").click(function(){
                moveitembacktocategorytab(this);
            });
        }
        
        function setnewimageoreder(imggrup){
            
            var eleary = [];
            var allitems = $("#"+imggrup).children().toArray();
            for ( var i = 0; i < allitems.length; i++ ) {
                if($(allitems[ i ]).data("tabval") != undefined){
                eleary.push( $(allitems[ i ]).data("tabval") + "|" + $("#"+imggrup+" div.preview-item").index(allitems[ i ]) );
                }
            }
            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { setnewimageorederchk: "setnewimageorederchk", eleary: eleary }
            })
            .done(function( data ) {
                //alert("change order ajax")
                //alert(data);
            });
        }
        function moveitemtohiddentab(curele){
            
            var itmtorem = curele;
            var parentitm = $(itmtorem).parent();
            var tabval = $(parentitm).data("tabval");
            var gettab = $(parentitm).parent().attr("id");
            
            $(itmtorem).parent().remove();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { makeuserimagehiddenchk: "makeuserimagehiddenchk", tabval: tabval }
            })
            .done(function( data ) {
                //alert("tab to hidden");
                if($("div#" + gettab + " > div.preview-item").length <= 0){  
                  $("div#" + gettab).html('<div class="callout callout-info"><h4>No Image Found</h4><p><i class="fa fa-info-circle"></i> There is no image under this category to show.</p></div>');
                }
                if($("div#sortable-hid > div.callout-info").length){  
                  $("div#sortable-hid > div.callout-info").remove();
                }
                $("div#sortable-hid").append(data);
                $( "#sortable-hid" ).sortable( "refresh" );
                $( "#" + gettab ).sortable( "refresh" );
                initbasicevents();
                setnewimageoreder(gettab);
                //alert(data);
            });
        }
        function moveitembacktocategorytab(curele){
            
            var itmtores = curele;
            var parentitm = $(itmtores).parent();
            var tabval = $(parentitm).data("tabval");
            var backto = $(parentitm).data("backto");
            
            $(itmtores).parent().remove();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { moveitembacktocategorytabchk: "moveitembacktocategorytabchk", tabval: tabval }
            })
            .done(function( data ) {
                //alert("back to tab");
                if($("div#" + backto + " > div.callout-info").length){  
                  $("div#" + backto + " > div.callout-info").remove();
                }
                if($("div#sortable-hid > div.preview-item").length <= 0){  
                  $("div#sortable-hid").html('<div class="callout callout-info"><h4>No Image Found</h4><p><i class="fa fa-info-circle"></i> There is no hidden image to show.</p></div>');
                }
                $( "#" + backto ).append(data);
                $( "#sortable-hid" ).sortable( "refresh" );
                $( "#" + backto ).sortable( "refresh" );

                $('input').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });

                initbasicevents();
                setnewimageoreder(backto);
                //alert(data);
            });
        }
        function openaddsubcatpopup(asgcat){
            $("#stbcatcat").val(asgcat);
        }
        function addnewsubcategory(){
            var subcattitle = $("#txt_subcat_title").val();
            var subcatcatid = $("#stbcatcat").val();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { addnewsubcatchk: "addnewsubcatchk", subcattitle: subcattitle, subcatcatid: subcatcatid }
            })
            .done(function( data ) {
                //alert("back to tab");
                $('#frm_add_subcategory').trigger('reset');
                $.fancybox.close();
                var sdata = $.trim(data)
                var licnt = '<li id = "subtabli'+sdata+'"><a data-toggle="tab" href="#prvsubtab" onclick="loadsubcatimages(\''+sdata+'\', \''+subcatcatid+'\')">'+subcattitle+' &nbsp;&nbsp;&nbsp; <i class="fa fa-times curs-pointer fancybox" href="#inline-pop-dlt-subcat" aria-hidden="true" onclick="opendltsubcatpopup(\''+sdata+'\', \''+subcatcatid+'\')"></i> </a>  </li>';
                
                $("#subtabli-all-"+subcatcatid).before(licnt);
                
                $("ul.subtabul"+subcatcatid+" li:first-child > a").click();
                
            });

            return false;
        }
        function opendltsubcatpopup(asgcat,prtcat){
            $("#dltstbcatcat").val(asgcat);
            $("#prtcategory").val(prtcat);
        }
        function dltnewsubcategory(){
            var dltstbcatcat = $("#dltstbcatcat").val();
            var prtcategory = $("#prtcategory").val();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controll 

                $("#subtabli"+dltstbcatcat).remove();
                $("ul.subtabul"+prtcategory+" li:first-child > a").click();
            });

            return false;
        }
        function loadsubcatimages(subcat, cat){

            $("#removesubcatimgcnfatag_subcati").val(subcat);

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { loadsubcatimageschk: "loadsubcatimageschk", subcat: subcat, cat: cat }
            })
            .done(function( data ) {
                //alert("back to tab");
                $("#sortable"+cat).html(data);
                $("#sortable"+cat).sortable( "refresh" );

                $("#sortable input:checked").prop('checked', false);
                $('input').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });

                initbasicevents();
            });

            return false;
        }

        function getallvisiblechkbox(selbox){
            
            var chklist = '';
            $('#sortable input:checked').each(function() {

                if(chklist != ''){
                    chklist += ',';
                }

                // If input is visible and checked...
                if ( $(this).is(':visible') && $(this).prop('checked') && $(this).val() != 'on' ) {

                    chklist += $(this).val();

                }

            });
            var selaction = $(selbox).val();
            if(chklist != '' && selaction != ''){

                var selcatid = $(selbox).data("selcatdata");

                if(selaction == 'remove'){
                    //alert('removesubcatimgcnfatag');

                    $("#removesubcatimgcnfatag_chklist").val(chklist);
                    $("#removesubcatimgcnfatag_catdata").val(selcatid);
                    $("#removesubcatimgcnfatag_bulkact").val(selaction);

                    $("#removesubcatimgcnfatag").click();

                }else{
                    $.ajax({
                        method: "POST",
                        url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                        data: { getsubcatoptionlistchk: "getsubcatoptionlistchk", selcatid: selcatid }
                    })
                    .done(function( data ) {
                        //alert(data);
                        //alert("back to tab");
                        $("#bulkactcnfatag_lab").html("Select sub category to "+selaction);
                        $("#bulkactcnfatag_btn").html(selaction);
                        $("#bulkactcnfatag_sel").html(data);

                        $("#bulkactcnfatag_chklist").val(chklist);
                        $("#bulkactcnfatag_catdata").val(selcatid);
                        $("#bulkactcnfatag_bulkact").val(selaction);

                        $("#bulkactcnfatag").click();
                    });
                }
            }

            $("#sortable input:checked").prop('checked', false);
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });
            $(selbox).val("");
        }
        function proccatbulkaction(){
            var chklist = $("#bulkactcnfatag_chklist").val();
            var catdata = $("#bulkactcnfatag_catdata").val();
            var subcati = $("#bulkactcnfatag_sel").val();
            var bulkact = $("#bulkactcnfatag_bulkact").val();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { proccatbulkactionchk: "proccatbulkactionchk", chklist: chklist, catdata: catdata, subcati: subcati, bulkact: bulkact }
            })
            .done(function( data ) {
                //alert(data);
                $.fancybox.close();
                $("ul.subtabul"+catdata+" li:first-child > a").click();
            });

            return false;
        }

        function procrmvimgfrmsubcat(){
            var chklist = $("#removesubcatimgcnfatag_chklist").val();
            var catdata = $("#removesubcatimgcnfatag_catdata").val();
            var subcati = $("#removesubcatimgcnfatag_subcati").val();
            var bulkact = $("#removesubcatimgcnfatag_bulkact").val();

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { procrmvimgfrmsubcatchk: "procrmvimgfrmsubcatchk", chklist: chklist, catdata: catdata, subcati: subcati, bulkact: bulkact }
            })
            .done(function( data ) {
                //alert(data);
                $.fancybox.close();
                $("ul.subtabul"+catdata+" li:first-child > a").click();
            });
            return false;
        }

        function openuserimageinpopup(imgid){
            var usrimgid = imgid;

            $.ajax({
                method: "POST",
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { getuserimagedatachk: "getuserimagedatachk", usrimgid: usrimgid }
            })
            .done(function( data ) {
                //alert(data);
                $("#usrimgpopcntrow").html(data);
                $.fancybox({
                    href: '#inline-pop-usr-img'
                });

                $(".img-to-zoom").zoom({ on:'click' }); 
            });
            return false;
            
        }
    </script>
</body>