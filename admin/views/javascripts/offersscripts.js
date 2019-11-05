function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srcofferName").val() == '' && $("#txt_srcofferCode").val() == '' && $("#txt_srcprice").val() == '' && $("#txt_srcneededPoints").val() == ''){
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
				url:       site_url+'controllers/ajax_controller/offers-ajax-controller.php', 
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
			$("#offers").html(data);
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addofferCategory").val() == ''){
				  $("#error-innertxt_addofferCategory").show().fadeOut(5000);
				  $("#error-innertxt_addofferCategory").html('This field is required');
				  $("#txt_addofferCategory").focus();
				  return false;
				}else if($("#txt_addofferName").val() == ''){
				  $("#error-innertxt_addofferName").show().fadeOut(5000);
				  $("#error-innertxt_addofferName").html('This field is required');
				  $("#txt_addofferName").focus();
				  return false;
				}else if($("#txt_addofferCode").val() == ''){
				  $("#error-innertxt_addofferCode").show().fadeOut(5000);
				  $("#error-innertxt_addofferCode").html('This field is required');
				  $("#txt_addofferCode").focus();
				  return false;
				}else if($("#txt_addprice").val() == ''){
				  $("#error-innertxt_addprice").show().fadeOut(5000);
				  $("#error-innertxt_addprice").html('This field is required');
				  $("#txt_addprice").focus();
				  return false;
				}else if($("#txt_addneededPoints").val() == ''){
					  $("#error-innertxt_addneededPoints").show().fadeOut(5000);
					  $("#error-innertxt_addneededPoints").html('This field is required');
					  $("#txt_addneededPoints").focus();
					  return false;
					}else if($("#txt_addcountry").val() == ''){
					  $("#error-innertxt_addcountry").show().fadeOut(5000);
					  $("#error-innertxt_addcountry").html('This field is required');
					  $("#txt_addcountry").focus();
					  return false;
					}else if($("#txt_addimage").val() == ''){
				  $("#error-innertxt_addimage").show().fadeOut(5000);
				  $("#error-innertxt_addimage").html('This field is required');
				  $("#txt_addimage").focus();
				  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/offers-ajax-controller.php', 
			type: "POST"
		};
		$('#form_offersadd').submit(function() {
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
			document.getElementById('err').innerHTML = 'Offers already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Offers added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding offers.';
		}
		$('#form_offersadd').unbind('submit').bind('submit',function() {
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addofferCategory").val() == ''){
				  $("#error-innertxt_addofferCategory").show().fadeOut(5000);
				  $("#error-innertxt_addofferCategory").html('This field is required');
				  $("#txt_addofferCategory").focus();
				  return false;
				}else if($("#txt_addofferName").val() == ''){
				  $("#error-innertxt_addofferName").show().fadeOut(5000);
				  $("#error-innertxt_addofferName").html('This field is required');
				  $("#txt_addofferName").focus();
				  return false;
				}else if($("#txt_addofferCode").val() == ''){
				  $("#error-innertxt_addofferCode").show().fadeOut(5000);
				  $("#error-innertxt_addofferCode").html('This field is required');
				  $("#txt_addofferCode").focus();
				  return false;
				}else if($("#txt_addprice").val() == ''){
				  $("#error-innertxt_addprice").show().fadeOut(5000);
				  $("#error-innertxt_addprice").html('This field is required');
				  $("#txt_addprice").focus();
				  return false;
				}else if($("#txt_addneededPoints").val() == ''){
					  $("#error-innertxt_addneededPoints").show().fadeOut(5000);
					  $("#error-innertxt_addneededPoints").html('This field is required');
					  $("#txt_addneededPoints").focus();
					  return false;
					}else if($("#txt_addcountry").val() == ''){
					  $("#error-innertxt_addcountry").show().fadeOut(5000);
					  $("#error-innertxt_addcountry").html('This field is required');
					  $("#txt_addcountry").focus();
					  return false;
					}/*else if($("#txt_addimage").val() == ''){
				  $("#error-innertxt_addimage").show().fadeOut(5000);
				  $("#error-innertxt_addimage").html('This field is required');
				  $("#txt_addimage").focus();
				  return false;
				}*/else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/offers-ajax-controller.php', 
			type: "POST"
		};
		$('#form_offersadd').submit(function() {
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
				document.getElementById('err').innerHTML = 'Offers already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'Offers updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating offers.';
			}
		}
		$('#form_offersadd').unbind('submit').bind('submit',function() {
		});
	}