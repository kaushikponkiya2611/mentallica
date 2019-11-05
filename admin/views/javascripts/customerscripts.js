function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srcusername").val() == '' && $("#txt_srcemailid").val() == '' && $("#txt_srcpassword").val() == '' && $("#txt_srcmobileno").val() == ''){
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
				url:       site_url+'controllers/ajax_controller/customer-ajax-controller.php', 
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
			$("#customer").html(data);
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addemailid").val() == ''){
				  $("#error-innertxt_addemailid").show().fadeOut(5000);
				  $("#error-innertxt_addemailid").html('This field is required');
				  $("#txt_addemailid").focus();
				  return false;
				}else if(emailchk.test($("#txt_addemailid").val()) == false){
				  $("#error-innertxt_addemailid").show().fadeOut(5000);
				  $("#error-innertxt_addemailid").html('Invalid email id');
				  $("#txt_addemailid").focus();
				  return false;
				}else if($("#txt_addpassword").val() == ''){
				  $("#error-innertxt_addpassword").show().fadeOut(5000);
				  $("#error-innertxt_addpassword").html('This field is required');
				  $("#txt_addpassword").focus();
				  return false;
				}else if(alphanum.test($("#txt_addpassword").val()) == false){
				  $("#error-innertxt_addpassword").show().fadeOut(5000);
				  $("#error-innertxt_addpassword").html('Invalid password');
				  $("#txt_addpassword").focus();
				  return false;
				}else if($("#txt_addpassword").val().length < 6){
				  $("#error-innertxt_addpassword").show().fadeOut(5000);
				  $("#error-innertxt_addpassword").html('Minimum 6 character required');
				  $("#txt_addpassword").focus();
				  return false;
				}else if($("#txt_addcpassword").val() == ''){
				  $("#error-innertxt_addcpassword").show().fadeOut(5000);
				  $("#error-innertxt_addcpassword").html('This field is required');
				  $("#txt_addcpassword").focus();
				  return false;
				}else if($("#txt_addcpassword").val() != $("#txt_addpassword").val()){
				  $("#error-innertxt_addcpassword").show().fadeOut(5000);
				  $("#error-innertxt_addcpassword").html('Confirm password not match');
				  $("#txt_addcpassword").focus();
				  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/customer-ajax-controller.php', 
			type: "POST"
		};
		$('#form_customeradd').submit(function() {
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
			document.getElementById('err').innerHTML = 'Customer already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Customer added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding customer.';
		}
		$('#form_customeradd').unbind('submit').bind('submit',function() {
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	if($("#txt_addemailid").val() == ''){
				  $("#error-innertxt_addemailid").show().fadeOut(5000);
				  $("#error-innertxt_addemailid").html('This field is required');
				  $("#txt_addemailid").focus();
				  return false;
				}else if(emailchk.test($("#txt_addemailid").val()) == false){
				  $("#error-innertxt_addemailid").show().fadeOut(5000);
				  $("#error-innertxt_addemailid").html('Invalid email id');
				  $("#txt_addemailid").focus();
				  return false;
				}else if($("#txt_addpassword").val() == ''){
				  $("#error-innertxt_addpassword").show().fadeOut(5000);
				  $("#error-innertxt_addpassword").html('This field is required');
				  $("#txt_addpassword").focus();
				  return false;
				}else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/customer-ajax-controller.php', 
			type: "POST"
		};
		$('#form_customeradd').submit(function() {
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
				document.getElementById('err').innerHTML = 'Customer already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'Customer updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating customer.';
			}
		}
		$('#form_customeradd').unbind('submit').bind('submit',function() {
		});
	}function getStates(){ 
			$("#message-red").hide();	
			$("#message-green").hide(); 
			$("#txt_addcity").html("<option value=''>Select City</option>");
			
			var abc=$("#txt_addcountry").val();
			$.ajax( {
				url : site_url+'controllers/ajax_controller/customer-ajax-controller.php', 
				type : 'post',
				data: 'getstateid='+abc,				
				success : function( resp ) {
					$("#stateajax").html(resp);
				}
			});
		}function getCities(){ 
			$("#message-red").hide();	
			$("#message-green").hide();      
			
			var abc=$("#txt_addstate").val();
			$.ajax( {
				url : site_url+'controllers/ajax_controller/customer-ajax-controller.php', 
				type : 'post',
				data: 'getcityid='+abc,				
				success : function( resp ) {
					$("#cityajax").html(resp);
				}
			});
		}