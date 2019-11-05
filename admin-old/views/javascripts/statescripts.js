function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srcr_code").val() == '' && $("#txt_srcr_name").val() == ''){
		flag = 1;
	}
	if(flag == 1){
		parent.$.fancybox.close();
		$("#search").val('0');
		newdata();
		return false;
	}
	else
	{
		if(regflag == 0)
		{
			$("#searchmsg").html('');
			var options = {
				beforeSubmit:  showRequest,
				success:       showResponse_search,
				url:       site_url+'controllers/ajax_controller/state-ajax-controller.php', 
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
			$("#state").html(data);
			return false;
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addcountry").val() == ''){
				  $("#error-innertxt_addcountry").show().fadeOut(5000);
				  $("#error-innertxt_addcountry").html('This field is required');
				  $("#txt_addcountry").focus();
				  return false;
				}else if($("#txt_addr_code").val() == ''){
					  $("#error-innertxt_addr_code").show().fadeOut(5000);
					  $("#error-innertxt_addr_code").html('This field is required');
					  $("#txt_addr_code").focus();
					  return false;
					}else if($("#txt_addr_name").val() == ''){
				  $("#error-innertxt_addr_name").show().fadeOut(5000);
				  $("#error-innertxt_addr_name").html('This field is required');
				  $("#txt_addr_name").focus();
				  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/state-ajax-controller.php', 
			type: "POST"
		};
		$('#form_stateadd').submit(function() {
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
			document.getElementById('err').innerHTML = 'State already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'State added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding state.';
		}
		$('#form_stateadd').unbind('submit').bind('submit',function() {
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addcountry").val() == ''){
				  $("#error-innertxt_addcountry").show().fadeOut(5000);
				  $("#error-innertxt_addcountry").html('This field is required');
				  $("#txt_addcountry").focus();
				  return false;
				}else if($("#txt_addr_code").val() == ''){
					  $("#error-innertxt_addr_code").show().fadeOut(5000);
					  $("#error-innertxt_addr_code").html('This field is required');
					  $("#txt_addr_code").focus();
					  return false;
					}/*else if(mobnum.test($("#txt_addr_code").val()) == false){
					  $("#error-innertxt_addr_code").show().fadeOut(5000);
					  $("#error-innertxt_addr_code").html('Enter correct number');
					  $("#txt_addr_code").focus();
					  return false;
					}*/else if($("#txt_addr_name").val() == ''){
				  $("#error-innertxt_addr_name").show().fadeOut(5000);
				  $("#error-innertxt_addr_name").html('This field is required');
				  $("#txt_addr_name").focus();
				  return false;
				}else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/state-ajax-controller.php', 
			type: "POST"
		};
		$('#form_stateadd').submit(function() {
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
				document.getElementById('err').innerHTML = 'State already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'State updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating state.';
			}
		}
		$('#form_stateadd').unbind('submit').bind('submit',function() {
		});
	}