jQuery(document).ready(function () {
    /* When click on change profile pic */
    jQuery('.change-profile-pic').on('click', function (e) {
        //jQuery('#profile_pic_modal').modal({show:true});      
        var id = jQuery(this).attr("data-cat");
        jQuery(".bannerModal_" + id).modal({show: true});
    });
    jQuery('.profile-pic').change(function () {
        var catid = jQuery(this).attr("data-id");
        jQuery("#preview-profile-pic" + catid).html('');
        jQuery("#preview-profile-pic" + catid).html('Uploading....');
        jQuery("#cropimage" + catid).ajaxForm(
        {
            target: '#preview-profile-pic' + catid,
            success: function () {
                jQuery('img#photo'+catid).imgAreaSelect({
                    aspectRatio: '4:3',
                    onSelectEnd: getSizes,
                });
                jQuery('#image_name'+catid).val(jQuery('#photo'+catid).attr('file-name'));
            }
        }).submit();
        return false;

    });
    jQuery("#profile_pic_modal").keyup(function(event){
        if (event.keyCode == 27){
            jQuery(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").hide();
        }
    });
    jQuery(".btnCancle").click(function(){
        jQuery(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").hide();
    });
    /* handle functionality when click crop button  */
    jQuery('.save_crop').on('click', function (e) {
        var catid = jQuery(this).attr("data-catid");
        var ajaxurl = jQuery("#ajaxurl"+catid).val();
        e.preventDefault();
        params = {
            targetUrl: ajaxurl,
            action: 'save',
            catid:catid,
            x_axis: jQuery('#hdn-x1-axis'+catid).val(),
            y_axis: jQuery('#hdn-y1-axis'+catid).val(),
            x2_axis: jQuery('#hdn-x2-axis'+catid).val(),
            y2_axis: jQuery('#hdn-y2-axis'+catid).val(),
            thumb_width: jQuery('#hdn-thumb-width'+catid).val(),
            thumb_height: jQuery('#hdn-thumb-height'+catid).val()
        };
        saveCropImage(params);
    });
    /* Function to get images size */
    function getSizes(img, obj) {
        var x_axis = obj.x1;
        var x2_axis = obj.x2;
        var y_axis = obj.y1;
        var y2_axis = obj.y2;
        var thumb_width = obj.width;
        var thumb_height = obj.height;
        if (thumb_width > 0) {
            jQuery('#hdn-x1-axis').val(x_axis);
            jQuery('#hdn-y1-axis').val(y_axis);
            jQuery('#hdn-x2-axis').val(x2_axis);
            jQuery('#hdn-y2-axis').val(y2_axis);
            jQuery('#hdn-thumb-width').val(thumb_width);
            jQuery('#hdn-thumb-height').val(thumb_height);
        } else {
            alert("Please select portion..!");
        }
    }
    /* Function to save crop images */
    function saveCropImage(params) {
       
        jQuery.ajax({
            url: params['targetUrl'],
            cache: false,
            dataType: "html",
            data: {
                action: params['action'],
                id: jQuery('#hdn-profile-id'+params['catid']).val(),
                t: 'ajax',
                catid:params['catid'],
                w1: params['thumb_width'],
                x1: params['x_axis'],
                h1: params['thumb_height'],
                y1: params['y_axis'],
                x2: params['x2_axis'],
                y2: params['y2_axis'],
                catid:params['catid'],
                image_name: jQuery('#image_name'+params['catid']).val()
                
            },
            type: 'Post',
            success: function (response) {
               // alert(response);
                jQuery('.bannerModal_'+params['catid']).modal('hide');
                jQuery(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
                jQuery(".timelineBackground"+params['catid']).html(response);
                jQuery("#preview-profile-pic"+params['catid']).html('');
                jQuery("#profile-pic-"+params['catid']).val();
                $("#timelineShade"+params['catid']).hide();
                $("#bgimageform").hide();

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
            }
        });
    }
});