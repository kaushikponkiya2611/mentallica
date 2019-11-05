$(function() {
        <?php if(!empty($previewcategories) && $previewcategories[0] !=''):
            foreach ($previewcategories as $key => $prvcat):
                $catdetail = $controller_class -> getcategorydetailbyid($prvcat);?>
                $( "#sortable<?php echo $catdetail['id'];?>" ).sortable({
                  update: function( event, ui ) { setnewimageoreder("sortable<?php echo $catdetail['id'];?>");}
                });
            <?php endforeach; ?>
            $( "#sortable-hid" ).sortable({
              disabled: true
            });
        <?php endif; ?>
        //$( "div.preview-container, div.preview-item" ).disableSelection();
        });

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
                url: site_url+"controllers/ajax_controller/preview-ajax-controller.php",
                data: { dltnewsubcatchk: "dltnewsubcatchk", dltstbcatcat: dltstbcatcat }
            })
            .done(function( data ) {
                //alert("back to tab");
                $.fancybox.close();

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