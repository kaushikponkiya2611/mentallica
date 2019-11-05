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
   jQuery("#txt_mainsearch").bind('keypress', function(e) {
		 if(e.keyCode==13){
			show_search();
		 }
	});
});


function changetype()
{
	var passval = jQuery("#txt_loginpassword").val();
	if(passval=='Password')
	{
     jQuery("#txt_loginpassword").attr("id","pass2");
      jQuery("#pass2").after( jQuery("<input id='txt_loginpassword' type='password' name='txt_loginpassword' class='inputbox'>") );
      jQuery("#pass2").remove();
	  jQuery("#txt_loginpassword").focus();
		  jQuery("#txt_loginpassword").bind('blur',function(){
				if(jQuery("#txt_loginpassword").val()=='')
				{
				  jQuery("#txt_loginpassword").attr("id","pass2");
				  jQuery("#pass2").after( jQuery("<input id='txt_loginpassword' type='text' name='txt_loginpassword' class='inputbox'>") );
				  jQuery("#pass2").remove();
				  jQuery("#txt_loginpassword").val( 'Password' );
						jQuery("#txt_loginpassword").bind('focus',function(){
							   changetype();
						})
				}
		  });
	}
	jQuery("#txt_loginpassword").bind('keypress', function(e) {
		 if(e.keyCode==13){
			gologin();		   
		 }
	});
}

function changetype2()
{
	var passval = jQuery("#txt_signuppassword").val();
	if(passval=='Password')
	{
     jQuery("#txt_signuppassword").attr("id","pass2");
      jQuery("#pass2").after( jQuery("<input id='txt_signuppassword' type='password' name='txt_signuppassword' class='email_inp mgl10' style='width:299px; height:26px;'>") );
      jQuery("#pass2").remove();
	  jQuery("#txt_signuppassword").focus();
		  jQuery("#txt_signuppassword").bind('blur',function(){
				if(jQuery("#txt_signuppassword").val()=='')
				{
				  jQuery("#txt_signuppassword").attr("id","pass2");
				  jQuery("#pass2").after( jQuery("<input id='txt_signuppassword' type='text' name='txt_signuppassword' class='email_inp mgl10' style='width:299px; height:26px;'>") );
				  jQuery("#pass2").remove();
				  jQuery("#txt_signuppassword").val( 'Password' );
						jQuery("#txt_signuppassword").bind('focus',function(){
							   changetype2();
						})
				}
		  });
	}
}

function changetype3()
{
	var passval = jQuery("#txt_signupcpassword").val();
	if(passval=='Confirm Password')
	{
     jQuery("#txt_signupcpassword").attr("id","pass2");
      jQuery("#pass2").after( jQuery("<input id='txt_signupcpassword' type='password' name='txt_signupcpassword' class='email_inp mgl10' style='width:299px; height:26px;'>") );
      jQuery("#pass2").remove();
	  jQuery("#txt_signupcpassword").focus();
		  jQuery("#txt_signupcpassword").bind('blur',function(){
				if(jQuery("#txt_signupcpassword").val()=='')
				{
				  jQuery("#txt_signupcpassword").attr("id","pass2");
				  jQuery("#pass2").after( jQuery("<input id='txt_signupcpassword' type='text' name='txt_signupcpassword' class='email_inp mgl10' style='width:299px; height:26px;'>") );
				  jQuery("#pass2").remove();
				  jQuery("#txt_signupcpassword").val( 'Confirm Password' );
						jQuery("#txt_signupcpassword").bind('focus',function(){
							   changetype3();
						})
				}
		  });
	}
}

function limitText(limitField, limitCount, limitNum) {	
	
	//$("#countdown").val(limitNum - limitField.value.length);
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;		
	}	
}

function close_popup(){
	parent.$.fancybox.close();	
}

/*For home end*/

function getBrandByCategoryDefault(catid){
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'getBrandFromCategory=1&catid='+catid,
		success : function(result)
		{
			$("#brand_ajax_df").html(result);
			//alert(result);
			$("#modId").html("<option value=''>Select Model</option>");
		}
	});	
}	
function getModelByBrandDefault(brndid)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'getModelFromBrand=1&brndid='+brndid,
		success : function(result)
		{
			//alert(result);
			$("#model_ajax_df").html(result);
		}
	});	
}
function noMoreAdd()
{
	$("#action_line").html("You don't have permission to post more adds, please renew or upgrade your plan.");
	$("#action_headerline").html('Error');
	$("#various_33").fancybox().trigger('click');
}
function changeclt_country(id)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'getchangeclt_country=1&ctyid='+id,
		success : function(result)
		{
			window.location=site_url+'home';
		}
	});
}
function getprayertime()
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'getislamicprayertime=1',
		success : function(result)
		{
			$("#weather_box_id").html(result);
		}
	});
}
function getweatherback()
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'getweatherbackhtml=1',
		success : function(result)
		{
			$("#weather_box_id").html(result);
		}
	});
}
function getClick(id,cclick,tclick,url)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/comman-ajax-controller.php',
		type : 'post',
		data: 'getBannerClick=1&id='+id+'&cclick='+cclick+'&tclick='+tclick,
		success : function(result)
		{
			window.location=url;
		}
	});
}