function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srcref_id").val() == '' && $("#txt_srcfirst_name").val() == '' && $("#txt_srclast_name").val() == '' && $("#txt_srcemailid").val() == '' && $("#txt_srcmobileno").val() == '' && $("#txt_srcplan_id").val() == ''){
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
				url:       site_url+'controllers/ajax_controller/artists-ajax-controller.php', 
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
			$("#artists").html(data);
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addfirst_name").val() == ''){
				  $("#error-innertxt_addfirst_name").show().fadeOut(5000);
				  $("#error-innertxt_addfirst_name").html('This field is required');
				  $("#txt_addfirst_name").focus();
				  return false;
				}else if($("#txt_addlast_name").val() == ''){
				  $("#error-innertxt_addlast_name").show().fadeOut(5000);
				  $("#error-innertxt_addlast_name").html('This field is required');
				  $("#txt_addlast_name").focus();
				  return false;
				}else if($("#txt_addemailid").val() == ''){
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
				}else if($("#txt_addmobileno").val() == ''){
				  $("#error-innertxt_addmobileno").show().fadeOut(5000);
				  $("#error-innertxt_addmobileno").html('This field is required');
				  $("#txt_addmobileno").focus();
				  return false;
				}else if($("#txt_addimage").val() == ''){
				  $("#error-innertxt_addimage").show().fadeOut(5000);
				  $("#error-innertxt_addimage").html('This field is required');
				  $("#txt_addimage").focus();
				  return false;
				}else if($("#txt_addplan_id").val() == ''){
					  $("#error-innertxt_addplan_id").show().fadeOut(5000);
					  $("#error-innertxt_addplan_id").html('This field is required');
					  $("#txt_addplan_id").focus();
					  return false;
					}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/artists-ajax-controller.php', 
			type: "POST"
		};
		$('#form_artistsadd').submit(function() {
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
			document.getElementById('err').innerHTML = 'Artists already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Artists added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding artists.';
		}
		$('#form_artistsadd').unbind('submit').bind('submit',function() {
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_addfirst_name").val() == ''){
				  $("#error-innertxt_addfirst_name").show().fadeOut(5000);
				  $("#error-innertxt_addfirst_name").html('This field is required');
				  $("#txt_addfirst_name").focus();
				  return false;
				}else if($("#txt_addlast_name").val() == ''){
				  $("#error-innertxt_addlast_name").show().fadeOut(5000);
				  $("#error-innertxt_addlast_name").html('This field is required');
				  $("#txt_addlast_name").focus();
				  return false;
				}else if($("#txt_addemailid").val() == ''){
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
				}else if($("#txt_addmobileno").val() == ''){
				  $("#error-innertxt_addmobileno").show().fadeOut(5000);
				  $("#error-innertxt_addmobileno").html('This field is required');
				  $("#txt_addmobileno").focus();
				  return false;
				}else if($("#txt_addplan_id").val() == ''){
					  $("#error-innertxt_addplan_id").show().fadeOut(5000);
					  $("#error-innertxt_addplan_id").html('This field is required');
					  $("#txt_addplan_id").focus();
					  return false;
					}else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/artists-ajax-controller.php', 
			type: "POST"
		};
		$('#form_artistsadd').submit(function() {
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
				document.getElementById('err').innerHTML = 'Artists already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'Artists updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating artists.';
			}
		}
		$('#form_artistsadd').unbind('submit').bind('submit',function() {
		});
	}