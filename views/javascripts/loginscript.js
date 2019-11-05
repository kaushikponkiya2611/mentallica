jQuery(document).ready(function(){
  jQuery('.default-value').each(function() {
		var default_value = this.value;
		jQuery(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
			}
		});
		jQuery(this).blur(function() {
			if(this.value == '') {
				this.value = default_value;
			}
		});
	});
});
function gologin(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]+$/;
	var decnum=/^[0-9.]+$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	//alert("In gologin");
	if($("#txt_loginusername").val() == '' || $("#txt_loginusername").val() == 'Username or email'){
		$("#txt_loginusername").focus();
		$("#action_line").html('Please enter your username or email id.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#txt_loginpassword").val() == '' || $("#txt_loginpassword").val() == 'Password'){
		$("#txt_loginpassword").focus();
		$("#action_line").html('Please enter your password.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/login-ajax-controller.php', 
			type: "POST"
		};
		$('#form_login').submit(function() {
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
		
		if(data==0){
			$("#action_line").html('Please enter correct username or emailid and password.');
			$("#action_headerline").html('Not Login');
			$("#various_33").fancybox().trigger('click');	
		}else if(data==1){
			window.location=site_url+'profile';	
		}
	}
}

function gosignup(){
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
	if($("#very_email").val() == ''){
		$("#very_email").focus();
		$("#action_line").html('Please enter your email id to verify.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if(emailchk.test($("#very_email").val())==false){
		$("#very_email").focus();
		$("#action_line").html('Please enter your valid email id to verify.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#very_email").val() != $("#txt_signupemailid").val()){
		$("#very_email").focus();
		$("#action_line").html('Your email id dose not match with first one.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($('#cap_val').val()!=$('#type_code').val()){
		$("#type_code").focus();
		$("#action_line").html("Code verified by you is incorrect, please try again.");
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse_signup,
			url:       site_url+'controllers/ajax_controller/login-ajax-controller.php', 
			type: "POST"
		};
		$('#form_signup').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
}
function showResponse_signup(data, statusText)  {
	if(statusText == 'success')
	{
		//alert(data);
		if(data==0){
			$("#action_line").html('Error occured in sign up process');
			$("#action_headerline").html('Error');
			$("#various_33").fancybox().trigger('click');	
		}else if(data==1){
			$("#action_line").html('Your registration successful in Yala, you can now login to yala, you will be rediredted to home page shortly');
			$("#action_headerline").html('Successful');
			$("#various_33").fancybox().trigger('click');
			$("#hide_aftReg").hide();
			window.setTimeout(function() {
				window.location.href = site_url;
			}, 5000);
		}else if(data==2){
			$("#action_line").html('This username already exist.Please enter other username.');
			$("#action_headerline").html('Exist');
			$("#various_33").fancybox().trigger('click');
		}else if(data==3){
			$("#action_line").html('This emailid already exist.Please enter other emailid.');
			$("#action_headerline").html('Successful');
			$("#various_33").fancybox().trigger('click');
		}else if(data==4){
			$("#txt_signupchap").focus();
			$("#action_line").html("Code verified by you is incorrect, please try again.");
			$("#action_headerline").html('Validate');
			$("#various_33").fancybox().trigger('click');
		}
	}
	$('#form_signup').unbind();$('#form_signup').bind();
	return false;
}

function find_region(countryid){
	$.ajax( {
		url : site_url+'controllers/ajax_controller/login-ajax-controller.php',
		type : 'post',
		data: 'findregion=1&countryid='+countryid,
		success : function(result)
		{
			$("#reg_region").html(result);
		}
	});	
}
function find_city(regionid){
	var countryid=$("#txt_signupcountry").val();
	$.ajax( {
		url : site_url+'controllers/ajax_controller/login-ajax-controller.php',
		type : 'post',
		data: 'findcity=1&countryid='+countryid+'&regionid='+regionid,
		success : function(result)
		{
			$("#reg_city").html(result);
		}
	});	
}	

function gosignupplannext(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]+$/;
	var decnum=/^[0-9.]+$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	
	var userid=$("#txt_signupusername").val();
	var emailid=$("#txt_signupemailid").val();
	
	var us_em=0;
	
	$.ajax( {
		url : site_url+'controllers/ajax_controller/login-ajax-controller.php',
		type : 'post',
		data: 'verifyeu=1&userid='+userid+'&emailid='+emailid,
		success : function(result)
		{
			$("#hid_very").val(result);
			
			if($("#txt_signupusername").val() == '' || $("#txt_signupusername").val() == 'Full Name'){
				$("#txt_signupusername").focus();
				$("#action_line").html('Please enter your username.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signupfullname").val() == '' || $("#txt_signupfullname").val() == 'Full Name'){
				$("#txt_signupfullname").focus();
				$("#action_line").html('Please enter your ful name.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signupemailid").val() == '' || $("#txt_signupemailid").val() == 'Email'){
				$("#txt_signupemailid").focus();
				$("#action_line").html('Please enter your email id.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if(emailchk.test($("#txt_signupemailid").val())==false){
				$("#txt_signupemailid").focus();
				$("#action_line").html('Please enter your valid email id.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signuppassword").val() == '' || $("#txt_signuppassword").val() == 'Password'){
				$("#txt_signuppassword").focus();
				$("#action_line").html('Please enter your password.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signupcpassword").val() == '' || $("#txt_signupcpassword").val() == 'Confirm Password'){
				$("#txt_signupcpassword").focus();
				$("#action_line").html('Please confirm your given password.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signuppassword").val()!=$("#txt_signupcpassword").val()){
				$("#txt_signupcpassword").focus();
				$("#action_line").html("Given password and confirm password dosen't match.");
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signupcnumb").val() == '' || $("#txt_signupcnumb").val() == 'Contact Number'){
				$("#txt_signupcnumb").focus();
				$("#action_line").html("Please enter your contact number.");
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if(phonum.test($("#txt_signupcnumb").val())==false){
				$("#txt_signupcnumb").focus();
				$("#action_line").html('Please enter your valid contact number.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#txt_signupaddress").val() == '' || $("#txt_signupaddress").val() == 'Region'){
				$("#txt_signupaddress").focus();
				$("#action_line").html("Please enter your address.");
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($('#txt_signupsub_agree').is(":checked")==false){
				$("#txt_signupsub_agree").focus();
				$("#action_line").html("Please accept terms and conditions.");
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}
			else if($('#cap_val').val()!=$('#txt_signupchap').val()){
				$("#txt_signupchap").focus();
				$("#action_line").html("Code verified by you is incorrect, please try again.");
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#hid_very").val()==2){
				$("#action_line").html('This username already exist.Please enter other username.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}else if($("#hid_very").val()==3){
				$("#action_line").html('This emailid already exist.Please enter other emailid.');
				$("#action_headerline").html('Validate');
				$("#various_33").fancybox().trigger('click');
				return false;
			}
			else
			{
				us_em=1;
				$("#form_signup").submit();
				
			}
		}
	});
	if(us_em==1)
	{
		return true;
	}
	else
	{
		return false;
	}
	//alert($('#txt_signupsub_agree').is(":checked"));
	
}

function gosignuppaymentnext(){
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
		return true;
	}
}

function getPlan(id,pr)
{
	$("#txt_signupplanid").val(id);
	$("#txt_signupplanpr").val(pr);
	if(parseInt(id)!=1){
		$('#form_signup2').unbind('submit');
			$("#form_signup2").submit();
	}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse_signupplan,
			url:       site_url+'controllers/ajax_controller/login-ajax-controller.php', 
			type: "POST"
		};
		$('#form_signup2').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
		$("#form_signup2").submit();
	}
}
function showResponse_signupplan(data, statusText)  {
	if(statusText == 'success')
	{
		//alert(data);
		if(data==0){
			$("#action_line").html('Error occured in sign up process');
			$("#action_headerline").html('Error');
			$("#various_33").fancybox().trigger('click');	
		}else if(data==1){
			$("#action_line").html('Your registration successful in Yala, you have selected free membership, you will be redirected to home page shortly.');
			$("#action_headerline").html('Successful');
			$("#various_33").fancybox().trigger('click');
			window.setTimeout(function() {
				window.location.href = site_url;
			}, 5000);
		}else if(data==2){
			$("#action_line").html('This username already exist.Please enter other username.');
			$("#action_headerline").html('Exist');
			$("#various_33").fancybox().trigger('click');
		}else if(data==3){
			$("#action_line").html('This emailid already exist.Please enter other emailid.');
			$("#action_headerline").html('Successful');
			$("#various_33").fancybox().trigger('click');
		}else if(data==4){
			$("#txt_signupchap").focus();
			$("#action_line").html("Code verified by you is incorrect, please try again.");
			$("#action_headerline").html('Validate');
			$("#various_33").fancybox().trigger('click');
		}
	}
	$('#form_signup').unbind();$('#form_signup').bind();
	return false;
}

function gologin2(){
	var alpha = /^[a-zA-Z]+$/;
	var alphanum = /^[a-zA-Z0-9]+$/;
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	var mobnum=/^[0-9]{10,12}$/;
	var phonum=/^[0-9]{10,14}$/;
	var num=/^[0-9]+$/;
	var decnum=/^[0-9.]+$/;
	var domain=/[^,\s]+\.{1,}[^,\s]{2,}/;
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
	//alert("In gologin");
	if($("#txt_loginusername").val() == '' || $("#txt_loginusername").val() == 'Username or email'){
		$("#txt_loginusername").focus();
		$("#action_line").html('Please enter your username or email id.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else if($("#txt_loginpassword").val() == '' || $("#txt_loginpassword").val() == 'Password'){
		$("#txt_loginpassword").focus();
		$("#action_line").html('Please enter your password.');
		$("#action_headerline").html('Validate');
		$("#various_33").fancybox().trigger('click');
		return false;
	}else
	{
		var options = {
			beforeSubmit:  showRequest2,
			success:       showResponse2,
			url:       site_url+'controllers/ajax_controller/login-ajax-controller.php', 
			type: "POST"
		};
		$('#form_login2').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	}
}
function showRequest2(formData, jqForm, options) {
	return true;
}
function showResponse2(data, statusText)  {
	if(statusText == 'success')
	{
		//alert(data);
		if(data==0){
			$("#action_line").html('Please enter correct username or emailid and password.');
			$("#action_headerline").html('Not Login');
			$("#various_33").fancybox().trigger('click');	
		}else if(data==1){
			window.location.href=site_url+'home';	
		}
	}
}
function forgotPasswordEmail()
{
	var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	//alert("In gologin");
	if($("#forg_email").val() == ''){
		$("#forg_email").focus();
		$("#forg_email").css("border-color","red");
		return false;
	}else if(emailchk.test($("#forg_email").val())==false){
		$("#forg_email").focus();
		$("#forg_email").css("border-color","red");
		return false;
	}else{
		$.ajax( {
			url : site_url+'controllers/ajax_controller/login-ajax-controller.php',
			type : 'post',
			data: 'forgotPasswordEmailChk=1&emailid='+$("#forg_email").val(),
			success : function(result)
			{
				//alert(result);
				if(result==1)
				{
					$("#action_line").html("Check your mail to reset your password.");
					$("#action_headerline").html('Error');
					$("#various_33").fancybox().trigger('click');
				}
				else if(result==3)
				{
					$("#action_line").html("Email id dose not exist.");
					$("#action_headerline").html('Error');
					$("#various_33").fancybox().trigger('click');
				}else if(result==0)
				{
					$("#action_line").html("Some error occured on reseting password, please try again.");
					$("#action_headerline").html('Error');
					$("#various_33").fancybox().trigger('click');
				}
			}
		});	
	}
}
function resetPasswordEmail()
{
	$("#rest_password").removeClass("borderRed");
	$("#rest_c_password").removeClass("borderRed");
	$("#rest_error").html("")
	
	if($("#rest_password").val() == '' || $("#rest_password").val() == 'Password'){
		$("#rest_password").focus();
		$("#rest_password").addClass("borderRed");
		$("#rest_error").html("Enter new password.");
		return false;
	}else if($("#rest_c_password").val() == '' || $("#rest_c_password").val() == 'Confirm Password'){
		$("#rest_c_password").focus();
		$("#rest_c_password").addClass("borderRed");
		$("#rest_error").html("Enter confirm password.");
		return false;
	}else if($("#rest_password").val()!=$("#rest_c_password").val()){
		$("#rest_c_password").focus();
		$("#rest_c_password").addClass("borderRed");
		$("#rest_error").html("Password dose not match, please try again.");
		return false;
	}else{
		$.ajax( {
			url : site_url+'controllers/ajax_controller/login-ajax-controller.php',
			type : 'post',
			data: 'resetPasswordEmailChk=1&useriid='+$("#hid_userIId").val()+'&rpassword='+$("#rest_password").val(),
			success : function(result)
			{
				//alert(result);
				if(result==1)
				{
					$("#action_line").html("Your password reseted successfully, now you can login with new password.");
					$("#action_headerline").html('Error');
					$("#various_33").fancybox().trigger('click');
				}else if(result==0)
				{
					$("#action_line").html("Some error occured on reseting password.");
					$("#action_headerline").html('Error');
					$("#various_33").fancybox().trigger('click');
				}
			}
		});	
	}
}