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

if(isset($_POST['setcattahbsidebar']) && $_POST['setcattahbsidebar'] != ''):
  
    $artistpagedata = $commoncont -> getartistpreivepagedatacategory($_SESSION['po_userses']['flc_usrlogin_id'],$_POST['catid']);?>
		<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>jQuery-gridmanager-master/dist/css/jquery.gridmanager.css" rel="stylesheet">  
 		     <script src="https://cdn.ckeditor.com/4.4.3/standard/adapters/jquery.js"></script> 
        <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script> 
   
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>jQuery-gridmanager-master/dist/js/jquery.gridmanager.js"></script>								
	<div id="section_sidebarpart">
	<input type="hidden" id="hid_catidsidebar" name="hid_catidsidebar" value="<?=$_POST['catid']?>">	
	<div class='column col-md-12' id="introduction_sb">
								
	<?php if($artistpagedata['preview_sidebar'] != ''):
		echo $artistpagedata['preview_sidebar'];
	else: ?>
		<h2>My Preview Page Sidebar<br></h2>
			<p>You can see my work here in this page.<br></p>
	<?php endif; ?>
			
		<?php //endif; ?>
	</div>
	<div class='col-md-12'>
		<button id="toggle_sb" style="display:none" class="btn btn-primary">Start editing</button>
		<button id="reset_sb" style="display:none" class="btn btn-primary">Reset content</button>
		<br/><br/>
	</div>
	<style>
        div.preview-container { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
  
    </style>
	<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
	<?php 
	//if($key==0){
		?>
		<script> 
		$(document).ready(function(){  
        // Sample: Inline Editing Enabled by Code
        (function () {
            var isEditingEnabled_SB,
                    toggle_sb = document.getElementById( 'toggle_sb' ),
                    reset_sb = document.getElementById( 'reset_sb' ),
                    introduction_sb = document.getElementById( 'introduction_sb' ),
                    introduction_sbHTML = introduction_sb.innerHTML;

            function enable_sbEditing() {
                if ( !CKEDITOR.instances.introduction_sb ) {
                    CKEDITOR.inline( 'introduction_sb',{
			extraPlugins: 'uploadimage,image2',
			height: 300,
			uploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
			filebrowserBrowseUrl: '/projectone/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '/projectone/ckfinder/ckfinder.html?type=Images',
			filebrowserUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl: '/projectone/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			stylesSet: [
				{ name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
				{ name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
			],

			// Load the default contents.css file plus customizations for this sample.
			contentsCss: [ CKEDITOR.basePath + 'contents.css', 'http://sdk.ckeditor.com/samples/assets/css/widgetstyles.css' ],

			// Configure the Enhanced Image plugin to use classes instead of styles and to disable the
			// resizer (because image size is controlled by widget styles or the image takes maximum
			// 100% of the editor width).
			image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
			image2_disableResizer: true
		} );
                }
            }

            function disable_sbEditing() {
                if ( CKEDITOR.instances.introduction_sb )
                    CKEDITOR.instances.introduction_sb.destroy();
            }

            function toggle_sbEditor() {
                if ( isEditingEnabled_SB ) {
                    if ( CKEDITOR.instances.introduction_sb && CKEDITOR.instances.introduction_sb.checkDirty() ) {
                        reset_sb.style.display = 'inline';
                    }
                    disable_sbEditing();
                    introduction_sb.setAttribute( 'contenteditable', false );
                    this.innerHTML = 'Start editing';
                    isEditingEnabled_SB = false;
                    save_sbContent(introduction_sb.innerHTML);
                }
                else {
                    introduction_sb.setAttribute( 'contenteditable', true );
                    enable_sbEditing();
                    this.innerHTML = 'Finish editing';
                    isEditingEnabled_SB = true;
                }
            }

            function reset_sbContent() {
                reset_sb.style.display = 'none';
                introduction_sb.innerHTML = introduction_sbHTML;
                save_sbContent(introduction_sb.innerHTML);
            }

            function onClick_sb( element, callback ) {
                if ( window.addEventListener ) {
                    element.addEventListener( 'click', callback, false );
                }
                else if ( window.attachEvent ) {
                    element.attachEvent( 'onclick', callback );
                }
            }

            function save_sbContent(htmlcontent){
				var cat=$("#hid_catidsidebar").val();
				
                $.post( site_url+'controllers/ajax_controller/preview-save-sidebar-ajax-controller.php', 
				{ content: htmlcontent, catid: cat  }).done(function( data ) {
                        console.log("Saved Successfully.");
                });
            }

            onClick_sb( toggle_sb, toggle_sbEditor );
            onClick_sb( reset_sb, reset_sbContent );

        })();


    });
		</script><?php
	//}
	?>
	</div>	
    <?php exit;
endif;

if(isset($_POST['content']) && $_POST['content'] != ''):
  
    $contentheader = "";
    $contentfooter = "";
    $contentsidebar = $_POST['content'];
	$categoryid = $_POST['catid'];
	
	
    $usrdata = $_SESSION['po_userses']['flc_usrlogin_id'];

    if($contentsidebar != '' && $usrdata != ''){
        $chkifexist = $commoncont -> checkifpreviewheaderexist($usrdata,$categoryid);
        if($chkifexist == 0){
          $commoncont -> addpreviewpageheaderfootersidebar($usrdata, $contentheader, $contentfooter, $contentsidebar,$categoryid);
        }elseif($chkifexist > 0){
          $commoncont -> updatepreviewpagesidebar($usrdata, $contentsidebar,$categoryid);
        }
    }

    echo 1;
    exit;
endif;
?>