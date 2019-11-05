<?php 
	@session_start();
	error_reporting(0);
	include('../../models/db.php');
	include('../../models/common-model.php');
	include('../../includes/thumb_new.php');
	include('../../includes/resize-class.php');
	include('../common-controller.php');
	$database = new Connection();
	include('../../models/ajax-model.php');
	$modelObj = new AjaxModel();
	$commoncont = new CommonController();
?>
<?php 
if(isset($_POST['content']) && $_POST['content'] != ''):
    $contentheader = "";
    $contentfooter = $_POST['content'];
	$categoryid = $_POST['catid'];
    $contentsidebar = "";
    $usrdata = $_SESSION['po_userses']['flc_usrlogin_id'];

    if($contentfooter != '' && $usrdata != ''){
        
        $chkifexist = $commoncont->checkifpreviewheaderexist($usrdata,$categoryid);
        if($chkifexist == 0){
            $commoncont->addpreviewpageheaderfootersidebar($usrdata, $contentheader, $contentfooter, $contentsidebar,$categoryid);
        }elseif($chkifexist > 0){
            $commoncont -> updatepreviewpagefooter($usrdata, $contentfooter,$categoryid);
        }
        echo "Check - ".$chkifexist;die;
        
    }

    echo 1;
    exit;
endif;
if(isset($_POST['setcattahbfooter']) && $_POST['setcattahbfooter'] != ''):
  
    $artistpagedata = $commoncont -> getartistpreivepagedatacategory($_SESSION['po_userses']['flc_usrlogin_id'],$_POST['catid']);?>
    <div class='column col-md-12' id="introduction_ft">
        <?php
        if ($artistpagedata['preview_footer'] != ''):
            echo $artistpagedata['preview_footer'];
        else:
            ?>
            <h2>My Preview Page Footer<br></h2>
            <p>You can see my work here in this page.<br></p>
        <?php endif; ?>
    </div>        
	<script>
        $(document).ready(function () {
            // Sample: Inline Editing Enabled by Code
            (function () {
                var isEditingEnabled_FT,
                        toggle_ft = document.getElementById('toggle_ft'),
                        reset_ft = document.getElementById('reset_ft'),
                        introduction_ft = document.getElementById('introduction_ft'),
                        introduction_ftHTML = introduction_ft.innerHTML;

                function enable_ftEditing() {
                    if (!CKEDITOR.instances.introduction_ft) {
                        CKEDITOR.inline('introduction_ft', {
                            extraPlugins: 'uploadimage,image2',
                            height: 300,
                            uploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                            filebrowserBrowseUrl: '/projectone/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl: '/projectone/ckfinder/ckfinder.html?type=Images',
                            filebrowserUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            stylesSet: [
                                {name: 'Narrow image', type: 'widget', widget: 'image', attributes: {'class': 'image-narrow'}},
                                {name: 'Wide image', type: 'widget', widget: 'image', attributes: {'class': 'image-wide'}}
                            ],
                            // Load the default contents.css file plus customizations for this sample.
                            contentsCss: [CKEDITOR.basePath + 'contents.css', 'https://sdk.ckeditor.com/samples/assets/css/widgetstyles.css'],
                            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
                            // resizer (because image size is controlled by widget styles or the image takes maximum
                            // 100% of the editor width).
                            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
                            image2_disableResizer: true
                        });
                    }
                }

                function disable_ftEditing() {
                    if (CKEDITOR.instances.introduction_ft)
                        CKEDITOR.instances.introduction_ft.destroy();
                }

                function toggle_ftEditor() {
                    if (isEditingEnabled_FT) {
                        if (CKEDITOR.instances.introduction_ft && CKEDITOR.instances.introduction_ft.checkDirty()) {
                            //reset_ft.style.display = 'inline';
                        }
                        disable_ftEditing();
                        introduction_ft.setAttribute('contenteditable', false);
                        this.innerHTML = 'Start editing';
                        isEditingEnabled_FT = false;
                        save_ftContent(introduction_ft.innerHTML);
                    } else {
                        introduction_ft.setAttribute('contenteditable', true);
                        enable_ftEditing();
                        this.innerHTML = 'Finish editing';
                        isEditingEnabled_FT = true;
                    }
                }

                function reset_ftContent() {
                    reset_ft.style.display = 'none';
                    introduction_ft.innerHTML = introduction_ftHTML;
                    save_ftContent(introduction_ft.innerHTML);
                }

                function onClick_ft(element, callback) {
                    if (window.addEventListener) {
                        element.addEventListener('click', callback, false);
                    } else if (window.attachEvent) {
                        element.attachEvent('onclick', callback);
                    }
                }

                function save_ftContent(htmlcontent) {
                    var cat = $("#hid_catidsidebar").val();

                    $.post(site_url + 'controllers/ajax_controller/preview-save-footer-ajax-controller.php',
                            {content: htmlcontent, catid: cat}).done(function (data) {
                        console.log("Saved Successfully.");
                    });
                }

                onClick_ft(toggle_ft, toggle_ftEditor);
                onClick_ft(reset_ft, reset_ftContent);

            })();
        });

    </script> 	
    <?php exit;
endif;
?>