function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srctitle").val() == '' && $("#txt_srctime").val() == '' && $("#txt_srcstart_time").val() == '' && $("#txt_srcend_time").val() == '' && $("#txt_srcweight").val() == ''){
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
				url:       site_url+'controllers/ajax_controller/radio_advertisement-ajax-controller.php', 
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
			$("#radio_advertisement").html(data);
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addtitle").val() == ''){
				  $("#error-innertxt_addtitle").show().fadeOut(5000);
				  $("#error-innertxt_addtitle").html('This field is required');
				  $("#txt_addtitle").focus();
				  return false;
				}else if($("#txt_addimage").val() == ''){
				  $("#error-innertxt_addimage").show().fadeOut(5000);
				  $("#error-innertxt_addimage").html('This field is required');
				  $("#txt_addimage").focus();
				  return false;
				}else if($("#txt_addtime").val() == ''){
				  $("#error-innertxt_addtime").show().fadeOut(5000);
				  $("#error-innertxt_addtime").html('This field is required');
				  $("#txt_addtime").focus();
				  return false;
				}else if($("#txt_addstart_time").val() == ''){
				  $("#error-innertxt_addstart_time").show().fadeOut(5000);
				  $("#error-innertxt_addstart_time").html('This field is required');
				  $("#txt_addstart_time").focus();
				  return false;
				}else if($("#txt_addend_time").val() == ''){
				  $("#error-innertxt_addend_time").show().fadeOut(5000);
				  $("#error-innertxt_addend_time").html('This field is required');
				  $("#txt_addend_time").focus();
				  return false;
				}else if($("#txt_addweight").val() == ''){
				  $("#error-innertxt_addweight").show().fadeOut(5000);
				  $("#error-innertxt_addweight").html('This field is required');
				  $("#txt_addweight").focus();
				  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/radio_advertisement-ajax-controller.php', 
			type: "POST"
		};
		$('#form_radio_advertisementadd').submit(function() {
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
			document.getElementById('err').innerHTML = 'Radio_advertisement already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Radio_advertisement added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding radio_advertisement.';
		}
		$('#form_radio_advertisementadd').unbind('submit').bind('submit',function() {
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addtitle").val() == ''){
				  $("#error-innertxt_addtitle").show().fadeOut(5000);
				  $("#error-innertxt_addtitle").html('This field is required');
				  $("#txt_addtitle").focus();
				  return false;
				}else if($("#txt_addimage").val() == ''){
				  $("#error-innertxt_addimage").show().fadeOut(5000);
				  $("#error-innertxt_addimage").html('This field is required');
				  $("#txt_addimage").focus();
				  return false;
				}else if($("#txt_addtime").val() == ''){
				  $("#error-innertxt_addtime").show().fadeOut(5000);
				  $("#error-innertxt_addtime").html('This field is required');
				  $("#txt_addtime").focus();
				  return false;
				}else if($("#txt_addstart_time").val() == ''){
				  $("#error-innertxt_addstart_time").show().fadeOut(5000);
				  $("#error-innertxt_addstart_time").html('This field is required');
				  $("#txt_addstart_time").focus();
				  return false;
				}else if($("#txt_addend_time").val() == ''){
				  $("#error-innertxt_addend_time").show().fadeOut(5000);
				  $("#error-innertxt_addend_time").html('This field is required');
				  $("#txt_addend_time").focus();
				  return false;
				}else if($("#txt_addweight").val() == ''){
				  $("#error-innertxt_addweight").show().fadeOut(5000);
				  $("#error-innertxt_addweight").html('This field is required');
				  $("#txt_addweight").focus();
				  return false;
				}else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/radio_advertisement-ajax-controller.php', 
			type: "POST"
		};
		$('#form_radio_advertisementadd').submit(function() {
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
				document.getElementById('err').innerHTML = 'Radio_advertisement already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'Radio_advertisement updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating radio_advertisement.';
			}
		}
		$('#form_radio_advertisementadd').unbind('submit').bind('submit',function() {
		});
	}