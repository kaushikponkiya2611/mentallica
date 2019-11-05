function submit_postaddform_final()
{
	return false;
}
function edit_postAdd()
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
		type : 'post',
		data: 'editPostAdd=1&postadd_category='+$("#postadd_category").val()+'&postadd_brand='+$("#postadd_brand").val()+'&postadd_model='+$("#postadd_model").val()+'&postadd_year='+$("#postadd_year").val()+'&postadd_trans_type='+$("#postadd_trans_type").val()+'&postadd_mileage='+$("#postadd_mileage").val()+'&postadd_price='+$("#postadd_price").val()+'&postadd_color='+$("#postadd_color").val()+'&postadd_description='+$("#postadd_description").val()+'&hid_imgcount='+$("#hid_imgcount").val()+'&postadd_country='+$("#postadd_country").val(),
		success : function(result)
		{
			$("#midle_part_ajax").html(result);	
		}
	});
}
function remove_imgarray(key)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
		type : 'post',
		data: 'removeImgarray=1&key='+key,
		success : function(result)
		{
			$("#count_"+key).hide("slow");	
			$("#hid_imgcount").val(result);
		}
	});
}
function listUploadedImages(sess)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
		type : 'post',
		data: 'product_listimg=1&sess='+sess,
		success : function(result)
		{
			$("#proceedbox_ajax").html(result);		
		}
	});
}
function storeImageName(imgnm,total)
{
	var limitpht=parseInt(total);
	$.ajax( {
		url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
		type : 'post',
		data: 'product_imgSession=1&imagedata='+imgnm,
		success : function(result)
		{
			if(result>=limitpht){
				$('#file_upload').uploadify('cancel', '*');
			}	
			$("#hid_imgcount").val(result);
		}
	});
}
function getBrandByCategory(catid){
	$.ajax( {
		url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
		type : 'post',
		data: 'getBrandFromCategory=1&catid='+catid,
		success : function(result)
		{
			$("#brand_ajax").html(result);
			$("#postadd_model").html("<option value=''>Select Model</option>");
		}
	});	
}	
function getModelByBrand(brndid)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
		type : 'post',
		data: 'getModelFromBrand=1&brndid='+brndid,
		success : function(result)
		{
			//alert(result);
			$("#model_ajax").html(result);
		}
	});	
}
function submit_postaddform()
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
	if($("#postadd_category").val() == ''){
		$("#postadd_category").focus();
		$("#action_line").html('Please select category.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_brand").val() == ''){
		$("#postadd_brand").focus();
		$("#action_line").html('Please select brand.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_model").val() == ''){
		$("#postadd_model").focus();
		$("#action_line").html('Please select model.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_year").val() == ''){
		$("#postadd_year").focus();
		$("#action_line").html('Please select year.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_trans_type").val() == ''){
		$("#postadd_trans_type").focus();
		$("#action_line").html('Please enter transmission type.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_mileage").val() == ''){
		$("#postadd_mileage").focus();
		$("#action_line").html("Please enter mileage.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_price").val() == ''){
		$("#postadd_price").focus();
		$("#action_line").html("Please enter price range.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_color").val() == ''){
		$("#postadd_color").focus();
		$("#action_line").html("Please enter color.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#postadd_description").val() == ''){
		$("#postadd_description").focus();
		$("#action_line").html("Please enter description.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}
	else if($("#postadd_country").val() == ''){
		$("#postadd_country").focus();
		$("#action_line").html("Please select item country.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}
	else if($("#hid_imgcount").val() == 0){
		$("#action_line").html("Please select image.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else
	{
		var options = {
			beforeSubmit:  showRequest_postadd,
			success:       showResponse_postadd,
			url:       site_url+'controllers/ajax_controller/postadd-ajax-controller.php', 
			type: "POST"
		};
		$('#form_postadd').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
}
function showRequest_postadd(formData, jqForm, options) {
	return true;
}
function showResponse_postadd(data, statusText)  {
	if(statusText == 'success')
	{
		if(data!='')
		{
			$("#midle_part_ajax").html(data);	
		}
	}
	$('#form_postadd').unbind();$('#form_postadd').bind();
	return false;
}
function lastPostAdd()
{
	var options = {
		beforeSubmit:  showRequest_postadd_last,
		success:       showResponse_postadd_last,
		url:       site_url+'controllers/ajax_controller/postadd-ajax-controller.php', 
		type: "POST"
	};
	$('#form_postadd').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}
function showRequest_postadd_last(formData, jqForm, options) {
	return true;
}
function showResponse_postadd_last(data, statusText)  {
	if(statusText == 'success')
	{
		if(data==1)
		{
			$("#action_line").html("Your post added successfully, you will be redirected shortly.");
			$("#action_headerline").html('Validate');
			$("#various_33").fancybox().trigger('click');
			window.setTimeout(function() {
				window.location.href = site_url+'profile';
			}, 5000);
		}
		else
		{
			$("#action_line").html("Some error occured while posting your add.");
			$("#action_headerline").html('Validate');
			$("#various_33").fancybox().trigger('click');
		}
	}
	$('#form_postadd').unbind();$('#form_postadd').bind();
	return false;
}

function addBrandModelSugg()
{
	$("#postadd_sugg_category").css("border-color","#BDC0C1");
	$("#postadd_sugg_brand").css("border-color","#BDC0C1");
	$("#postadd_sugg_model").css("border-color","#BDC0C1");
	
	if($("#postadd_sugg_category").val() == ''){
		$("#postadd_sugg_category").focus();
		$("#postadd_sugg_category").css("border-color","red");
		return false;
	}else if($("#postadd_sugg_brand").val() == ''){
		$("#postadd_sugg_brand").focus();
		$("#postadd_sugg_brand").css("border-color","red");
		return false;
	}else if($("#postadd_sugg_model").val() == ''){
		$("#postadd_sugg_model").focus();
		$("#postadd_sugg_model").css("border-color","red");
		return false;
	}else{
		$.ajax( {
			url : site_url+'controllers/ajax_controller/postadd-ajax-controller.php',
			type : 'post',
			data: 'addBrandModelSuggChk=1&catid='+$("#postadd_sugg_category").val()+'&brdid='+$("#postadd_sugg_brand").val()+'&modid='+$("#postadd_sugg_model").val(),
			success : function(result)
			{
				if(result==1)
				{
					$("#action_line").html("Your suggestion added successfully, your page will refresh shortly.");
					$("#action_headerline").html('Validate');
					$("#various_33").fancybox().trigger('click');
					window.setTimeout(function() {
						window.location.href = site_url+'postadd';
					}, 5000);
				}
				else
				{
					$("#action_line").html("Some error occured while adding your suggestion, please try again.");
					$("#action_headerline").html('Validate');
					$("#various_33").fancybox().trigger('click');
				}
			}
		});	
	}
}
