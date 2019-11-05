function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srcplan_name").val() == '' && $("#txt_srcplan_price").val() == '' && $("#txt_srcmonth").val() == '' && $("#txt_srccategory").val() == ''){
		flag = 1;
	}
	if(flag == 1){
		parent.$.fancybox.close();
		$("#search").val('0');
		newdata();
	}
	else
	{
		if(regflag == 0)
		{
			$("#searchmsg").html('');
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse_search,
				url:       site_url+'controllers/ajax_controller/plans-ajax-controller.php', 
				type: "POST"
			};
			$('#form_search').submit(function()
			{
				$(this).ajaxSubmit(options);				
				return false;
			});
		}
	 }
	}
	function showResponse_search(data, statusText)  {
		if (statusText == 'success') {
			parent.$.fancybox.close();
			$("#plans").html(data);
		} 
	}
	function adddata(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]$/;
	var decnum=/^[0-9.]$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	if($("#txt_addplan_name").val() == ''){
				  $("#error-innertxt_addplan_name").show().fadeOut(5000);
				  $("#error-innertxt_addplan_name").html('This field is required');
				  $("#txt_addplan_name").focus();
				  return false;
				}else if($("#txt_addplan_price").val() == ''){
				  $("#error-innertxt_addplan_price").show().fadeOut(5000);
				  $("#error-innertxt_addplan_price").html('This field is required');
				  $("#txt_addplan_price").focus();
				  return false;
				}else if($("#txt_addimage_limit").val() == ''){
					  $("#error-innertxt_addimage_limit").show().fadeOut(5000);
					  $("#error-innertxt_addimage_limit").html('This field is required');
					  $("#txt_addimage_limit").focus();
					  return false;
					}else if($("#txt_addmonth").val() == ''){
					  $("#error-innertxt_addmonth").show().fadeOut(5000);
					  $("#error-innertxt_addmonth").html('This field is required');
					  $("#txt_addmonth").focus();
					  return false;
					}else if($("#txt_addcategory").val() == ''){
				  $("#error-innertxt_addcategory").show().fadeOut(5000);
				  $("#error-innertxt_addcategory").html('This field is required');
				  $("#txt_addcategory").focus();
				  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/plans-ajax-controller.php', 
			type: "POST"
		};
		$('#form_plansadd').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
	}
	function showRequest(formData, jqForm, options) {
		return true;
	}
	function showResponse(data, statusText)  {
	if(statusText == 'success')
	{
		if(data == 0)
		{
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Plans already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Plans added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding plans.';
		}
		$('#form_plansadd').unbind('submit').bind('submit',function() {
		});
	}
	}
	function updatedata(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]$/;
	var decnum=/^[0-9.]$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addplan_name").val() == ''){
				  $("#error-innertxt_addplan_name").show().fadeOut(5000);
				  $("#error-innertxt_addplan_name").html('This field is required');
				  $("#txt_addplan_name").focus();
				  return false;
				}else if($("#txt_addplan_price").val() == ''){
				  $("#error-innertxt_addplan_price").show().fadeOut(5000);
				  $("#error-innertxt_addplan_price").html('This field is required');
				  $("#txt_addplan_price").focus();
				  return false;
				}else if($("#txt_addimage_limit").val() == ''){
					  $("#error-innertxt_addimage_limit").show().fadeOut(5000);
					  $("#error-innertxt_addimage_limit").html('This field is required');
					  $("#txt_addimage_limit").focus();
					  return false;
					}else if($("#txt_addmonth").val() == ''){
					  $("#error-innertxt_addmonth").show().fadeOut(5000);
					  $("#error-innertxt_addmonth").html('This field is required');
					  $("#txt_addmonth").focus();
					  return false;
					}else if($("#txt_addcategory").val() == ''){
				  $("#error-innertxt_addcategory").show().fadeOut(5000);
				  $("#error-innertxt_addcategory").html('This field is required');
				  $("#txt_addcategory").focus();
				  return false;
				}else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/plans-ajax-controller.php', 
			type: "POST"
		};
		$('#form_plansadd').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
	}
	function showRequest_update(formData, jqForm, options) {
		return true;
	}
	function showResponse_update(data, statusText)  
	{
		if (statusText == 'success') 
		{
			if(data == 0){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Plans already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'Plans updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating plans.';
			}
		}
		$('#form_plansadd').unbind('submit').bind('submit',function() {
		});
	}