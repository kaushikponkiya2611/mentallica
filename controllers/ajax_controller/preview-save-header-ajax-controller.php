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
if(isset($_POST['setcattahb']) && $_POST['setcattahb'] != ''):
  
    $artistpagedata = $commoncont -> getartistpreivepagedatacategory($_SESSION['po_userses']['flc_usrlogin_id'],$_POST['catid']);?>
		<link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>jQuery-gridmanager-master/dist/css/jquery.gridmanager.css" rel="stylesheet">  
 		<script src="//cdn.ckeditor.com/4.5.9/standard-all/ckeditor.js"></script> 
        <script src="//cdn.ckeditor.com/4.4.3/standard/adapters/jquery.js"></script> 
        <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>jQuery-gridmanager-master/dist/js/jquery.gridmanager.js"></script>								
	<div id="section_cat<?=$previewcategories[$key]?>">
	<div class='column col-md-12' id="introduction">
		<?php if($artistpagedata['preview_header'] != ''):
			echo $artistpagedata['preview_header'];
			
		else: ?>
		<img alt="" src="/ckfinder/userfiles/images/bannerdesign2.jpg" height="230" width="874">
			<h2>My Preview Page<br></h2>
			<p>You can see my work here in this page.<br></p>
		<?php endif; ?>
	</div>
	<div class='col-md-12'>
			<button id="toggle" style="display:none" class="btn btn-primary">Start editing</button>
			<button id="reset" style="display:none" class="btn btn-primary">Reset content</button>
			
			<input type="hidden" id="hid_catid" name="hid_catid" value="<?=$_POST['catid']?>">
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
				
				var isEditingEnabled,
						toggle = document.getElementById( 'toggle' ),
						reset = document.getElementById( 'reset' ),
						introduction = document.getElementById( 'introduction' ),
						introductionHTML = introduction.innerHTML;

				function enableEditing() {
					if ( !CKEDITOR.instances.introduction ) {
						CKEDITOR.inline( 'introduction', {
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

				function disableEditing() {
					if ( CKEDITOR.instances.introduction )
						CKEDITOR.instances.introduction.destroy();
				}

				function toggleEditor() {
					/*$("#introduction").prepend('<img alt="" src="/ckfinder/userfiles/images/bannerdesign2.jpg" height="230" width="874">');*/
					if ( isEditingEnabled ) {
						if ( CKEDITOR.instances.introduction && CKEDITOR.instances.introduction.checkDirty() ) {
							reset.style.display = 'inline';
						}
						disableEditing();
						introduction.setAttribute( 'contenteditable', false );
						this.innerHTML = 'Start editing';
						isEditingEnabled = false;
						saveContent(introduction.innerHTML);
					}
					else {
						introduction.setAttribute( 'contenteditable', true );
						enableEditing();
						this.innerHTML = 'Finish editing';
						isEditingEnabled = true;
					}
				}

				function resetContent() {
					reset.style.display = 'none';
					introduction.innerHTML = introductionHTML;
					saveContent(introduction.innerHTML);
				}

				function onClick( element, callback ) {
					if ( window.addEventListener ) {
						element.addEventListener( 'click', callback, false );
					}
					else if ( window.attachEvent ) {
						element.attachEvent( 'onclick', callback );
					}
				}

				function saveContent(htmlcontent){
					var cat=$("#hid_catid").val();
					$.post( site_url+'controllers/ajax_controller/preview-save-header-ajax-controller.php', 
					{ content: htmlcontent, catid: cat }).done(function( data ) {
							console.log("Saved Successfully.");
					});
				}

				onClick( toggle, toggleEditor );
				onClick( reset, resetContent );

			})();

		});
		</script><?php
	//}
	?>
	</div>	
    <?php exit;
endif;

if(isset($_POST['content']) && $_POST['content'] != ''):
  
    $contentheader = $_POST['content'];
	$categoryid = $_POST['catid'];
	
	
    $contentfooter = "";
    $contentsidebar = "";
    $usrdata = $_SESSION['po_userses']['flc_usrlogin_id'];

    if($contentheader != '' && $usrdata != ''){
        $chkifexist = $commoncont -> checkifpreviewheaderexist($usrdata,$categoryid);
		
		
        if($chkifexist == 0){
          $commoncont -> addpreviewpageheaderfootersidebar($usrdata, $contentheader, $contentfooter, $contentsidebar,$categoryid);
        }elseif($chkifexist > 0){
          $commoncont -> updatepreviewpageheader($usrdata, $contentheader,$categoryid);
        }
    }

    echo 1;
    exit;
endif;
?>