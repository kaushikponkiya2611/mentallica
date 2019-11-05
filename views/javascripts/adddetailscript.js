function showGivenImage(img)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/adddetail-ajax-controller.php',
		type : 'post',
		data: 'showGivenImageChk=1&img='+img,
		success : function(result)
		{
			$("#main_image_ajax").html(result);
		}
	});
}
function getSliderData(addid)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/adddetail-ajax-controller.php',
		type : 'post',
		data: 'getSliderDataChk=1&addid='+addid,
		success : function(result)
		{
			$("#bluebox_slider").html(result);
		}
	});
}
function addToFav(proId)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/adddetail-ajax-controller.php',
		type : 'post',
		data: 'getAddToFav=1&proId='+proId,
		success : function(result)
		{
			$("#middel_part_ajaxid").html(result);
			$("html, body").animate({ scrollTop: 450 }, "slow");
		}
	});
}
function getProductBack(porId)
{
	//alert(porId);
	$.ajax( {
		url : site_url+'controllers/ajax_controller/adddetail-ajax-controller.php',
		type : 'post',
		data: 'getProDetailBack=1&proId='+porId,
		success : function(result)
		{
			$("#middel_part_ajaxid").html(result);
			$("html, body").animate({ scrollTop: 450 }, "slow");
		}
	});
}
function productPayment()
{
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]+$/;
	var decnum=/^[0-9.]+$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;

	//alert($('#txt_signupsub_agree').is(":checked"));
	if($("#bnk_name").val() == ''){
		$("#bnk_name").focus();
		$("#action_line").html('Please enter your bank name.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#bnk_acc_no").val() == ''){
		$("#bnk_acc_no").focus();
		$("#action_line").html('Please enter your account number.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#bnk_crd_no").val() == ''){
		$("#bnk_crd_no").focus();
		$("#action_line").html('Please enter your card number.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#expiry_date").val() == ''){
		$("#expiry_date").focus();
		$("#action_line").html('Please enter expiry date.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#cvv_cvc").val() == ''){
		$("#cvv_cvc").focus();
		$("#action_line").html('Please enter CVV2 / CVC2 No.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($('#cap_val').val()!=$('#type_code').val()){
		$("#type_code").focus();
		$("#action_line").html("Code verified by you is incorrect, please try again.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}
	else
	{
		var options = {
			beforeSubmit:  showRequestProPay,
			success:       showResponseProPay,
			url:       site_url+'controllers/ajax_controller/adddetail-ajax-controller.php', 
			type: "POST"
		};
		$('#form_productPay').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
}
function showRequestProPay(formData, jqForm, options) {
	return true;
}
function showResponseProPay(data, statusText)  {
	if(statusText == 'success')
	{
		alert(data);
		if(data==0){
			$("#action_line").html('Error occured in payment process.');
			$("#action_headerline").html('Error');
			$("#various_33").fancybox().trigger('click');	
		}else if(data==1){
			$("#action_line").html('Your successfully purchased this product.');
			$("#action_headerline").html('Successful');
			$("#various_33").fancybox().trigger('click');
			
			getProductBack($("#txt_productsId").val());
			$("html, body").animate({ scrollTop: 450 }, "slow");
		}
	}
	$('#form_productPay').unbind();$('#form_productPay').bind();
	return false;
}