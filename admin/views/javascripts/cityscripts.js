function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;
	if($("#txt_srccountry").val() == '' && $("#txt_srcregion").val() == '' && $("#txt_srccity").val() == '')
	{
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
				url:       site_url+'controllers/ajax_controller/city-ajax-controller.php', 
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
			$("#city").html(data);
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
				if($("#txt_addcountry").val() == ''){
				  $("#error-innertxt_addcountry").show().fadeOut(5000);
				  $("#error-innertxt_addcountry").html('This field is required');
				  $("#txt_addcountry").focus();
				  return false;
				}else if($("#txt_addcity").val() == ''){
				  $("#error-innertxt_addcity").show().fadeOut(5000);
				  $("#error-innertxt_addcity").html('This field is required');
				  $("#txt_addcity").focus();
				  return false;
				}else if($("#txt_addpostalCode").val() == ''){
					  $("#error-innertxt_addpostalCode").show().fadeOut(5000);
					  $("#error-innertxt_addpostalCode").html('This field is required');
					  $("#txt_addpostalCode").focus();
					  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/city-ajax-controller.php', 
			type: "POST"
		};
		$('#form_cityadd').submit(function() {
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
			document.getElementById('err').innerHTML = 'City already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'City added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding city.';
		}
		$('#form_cityadd').unbind('submit').bind('submit',function() {
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
				if($("#txt_addcountry").val() == ''){
				  $("#error-innertxt_addcountry").show().fadeOut(5000);
				  $("#error-innertxt_addcountry").html('This field is required');
				  $("#txt_addcountry").focus();
				  return false;
				}else if($("#txt_addregion").val() == ''){
					  $("#error-innertxt_addregion").show().fadeOut(5000);
					  $("#error-innertxt_addregion").html('This field is required');
					  $("#txt_addregion").focus();
					  return false;
					}else if($("#txt_addcity").val() == ''){
				  $("#error-innertxt_addcity").show().fadeOut(5000);
				  $("#error-innertxt_addcity").html('This field is required');
				  $("#txt_addcity").focus();
				  return false;
				}else if($("#txt_addpostalCode").val() == ''){
					  $("#error-innertxt_addpostalCode").show().fadeOut(5000);
					  $("#error-innertxt_addpostalCode").html('This field is required');
					  $("#txt_addpostalCode").focus();
					  return false;
					}
					else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/city-ajax-controller.php', 
			type: "POST"
		};
		$('#form_cityadd').submit(function() {
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
				document.getElementById('err').innerHTML = 'City already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'City updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating city.';
			}
		}
		$('#form_cityadd').unbind('submit').bind('submit',function() {
		});
	}
	function getStates(){ 
	
			$("#message-red").hide();	
			$("#message-green").hide(); 
			$("#txt_addcity").html("<option value=''>Select City</option>");
			$("#").html("<option value=''>Select Zipcode</option>");
			var abc=$("#txt_addcountry").val();
			$.ajax( {
				url : site_url+'controllers/ajax_controller/city-ajax-controller.php', 
				type : 'post',
				data: 'getstateid='+abc,				
				success : function( resp ) {
					
					$("#stateajax1").html(resp);
				}
			});
		}

		
		
function getStatesview(){ 
	
			$("#message-red").hide();	
			$("#message-green").hide(); 
			var abc=$("#txt_srccountry").val();
			$.ajax( {
				url : site_url+'controllers/ajax_controller/city-ajax-controller.php', 
				type : 'post',
				data: 'getstateidview='+abc,				
				success : function( resp ) {
					
					$("#stateajax").html(resp);
				}
			});
		}
		/*function getCities(){ 
			$("#message-red").hide();	
			$("#message-green").hide();      
			$("#").html("<option value=''>Select Zipcode</option>");
			var abc=$("#txt_addstate").val();
			$.ajax( {
				url : site_url+'controllers/ajax_controller/city-ajax-controller.php', 
				type : 'post',
				data: 'getcityid='+abc,				
				success : function( resp ) {
					$("#cityajax").html(resp);
				}
			});
		}*/