function searching(){
	var alpha = /^[a-zA-Z]+$/;
	var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
	$("#searchmsg").html('');
	var flag = 0;
	var regflag = 0;if($("#txt_srcuser_id").val() == '' && $("#txt_srcplan_id").val() == '' && $("#txt_srctransaction_id").val() == '' && $("#txt_srcamount").val() == ''){
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
				url:       site_url+'controllers/ajax_controller/payment-ajax-controller.php', 
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
			$("#payment").html(data);
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_adduser_id").val() == ''){
					  $("#error-innertxt_adduser_id").show().fadeOut(5000);
					  $("#error-innertxt_adduser_id").html('This field is required');
					  $("#txt_adduser_id").focus();
					  return false;
					}else if(mobnum.test($("#txt_adduser_id").val()) == false){
					  $("#error-innertxt_adduser_id").show().fadeOut(5000);
					  $("#error-innertxt_adduser_id").html('Enter correct number');
					  $("#txt_adduser_id").focus();
					  return false;
					}else if($("#txt_addplan_id").val() == ''){
					  $("#error-innertxt_addplan_id").show().fadeOut(5000);
					  $("#error-innertxt_addplan_id").html('This field is required');
					  $("#txt_addplan_id").focus();
					  return false;
					}else if(mobnum.test($("#txt_addplan_id").val()) == false){
					  $("#error-innertxt_addplan_id").show().fadeOut(5000);
					  $("#error-innertxt_addplan_id").html('Enter correct number');
					  $("#txt_addplan_id").focus();
					  return false;
					}else if($("#txt_addtransaction_id").val() == ''){
				  $("#error-innertxt_addtransaction_id").show().fadeOut(5000);
				  $("#error-innertxt_addtransaction_id").html('This field is required');
				  $("#txt_addtransaction_id").focus();
				  return false;
				}else if($("#txt_addamount").val() == ''){
				  $("#error-innertxt_addamount").show().fadeOut(5000);
				  $("#error-innertxt_addamount").html('This field is required');
				  $("#txt_addamount").focus();
				  return false;
				}else if(decnum.test($("#txt_addamount").val()) == false){
				  $("#error-innertxt_addamount").show().fadeOut(5000);
				  $("#error-innertxt_addamount").html('Enter correct number');
				  $("#txt_addamount").focus();
				  return false;
				}else
	{
		var options = {
			beforeSubmit:  showRequest,
			success:       showResponse,
			url:       site_url+'controllers/ajax_controller/payment-ajax-controller.php', 
			type: "POST"
		};
		$('#form_paymentadd').submit(function() {
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
			document.getElementById('err').innerHTML = 'Payment already exist. Please try another.';
		}else if(data == 1){
			$("#message-red").hide();
			$("#message-green").show().fadeOut(5000);		   
			document.getElementById('succ').innerHTML = 'Payment added successfully.';
			newdata();				 
		}else if(data == 2){
			$.scrollTo(0,500);
			$("#message-red").show().fadeOut(7000);
			$("#message-green").hide();
			document.getElementById('err').innerHTML = 'Some error occurred while adding payment.';
		}
		$('#form_paymentadd').unbind('submit').bind('submit',function() {
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
	var url=/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;if($("#txt_adduser_id").val() == ''){
					  $("#error-innertxt_adduser_id").show().fadeOut(5000);
					  $("#error-innertxt_adduser_id").html('This field is required');
					  $("#txt_adduser_id").focus();
					  return false;
					}else if(mobnum.test($("#txt_adduser_id").val()) == false){
					  $("#error-innertxt_adduser_id").show().fadeOut(5000);
					  $("#error-innertxt_adduser_id").html('Enter correct number');
					  $("#txt_adduser_id").focus();
					  return false;
					}else if($("#txt_addplan_id").val() == ''){
					  $("#error-innertxt_addplan_id").show().fadeOut(5000);
					  $("#error-innertxt_addplan_id").html('This field is required');
					  $("#txt_addplan_id").focus();
					  return false;
					}else if(mobnum.test($("#txt_addplan_id").val()) == false){
					  $("#error-innertxt_addplan_id").show().fadeOut(5000);
					  $("#error-innertxt_addplan_id").html('Enter correct number');
					  $("#txt_addplan_id").focus();
					  return false;
					}else if($("#txt_addtransaction_id").val() == ''){
				  $("#error-innertxt_addtransaction_id").show().fadeOut(5000);
				  $("#error-innertxt_addtransaction_id").html('This field is required');
				  $("#txt_addtransaction_id").focus();
				  return false;
				}else if($("#txt_addamount").val() == ''){
				  $("#error-innertxt_addamount").show().fadeOut(5000);
				  $("#error-innertxt_addamount").html('This field is required');
				  $("#txt_addamount").focus();
				  return false;
				}else if(decnum.test($("#txt_addamount").val()) == false){
				  $("#error-innertxt_addamount").show().fadeOut(5000);
				  $("#error-innertxt_addamount").html('Enter correct number');
				  $("#txt_addamount").focus();
				  return false;
				}else
	{
	   var options = {
			beforeSubmit:  showRequest_update,
			success:       showResponse_update,
			url:       site_url+'controllers/ajax_controller/payment-ajax-controller.php', 
			type: "POST"
		};
		$('#form_paymentadd').submit(function() {
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
				document.getElementById('err').innerHTML = 'Payment already exist. Please try another.';
			}else if(data == 1){
				$("#message-red").hide();
				$("#message-green").show().fadeOut(5000);				
				document.getElementById('succ').innerHTML = 'Payment updated successfully.';
				newdata();
			}else if(data == 2){
				$.scrollTo(0,500);
				$("#message-red").show().fadeOut(7000);
				$("#message-green").hide();
				document.getElementById('err').innerHTML = 'Some error occurred while updating payment.';
			}
		}
		$('#form_paymentadd').unbind('submit').bind('submit',function() {
		});
	}