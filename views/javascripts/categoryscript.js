function getAddPaging(cat,start,end,type)
{
	$("body").css("cursor", "wait");
	$("#add_perPage").val();
	$("#thumblink").removeClass("select");
	$("#listlink").removeClass("select");
	$.ajax( {
		url : site_url+'controllers/ajax_controller/category-ajax-controller.php',
		type : 'post',
		data: 'addPagingCode=1&cat='+cat+'&start='+start+'&end='+$("#add_perPage").val()+'&type='+type,
		success : function(result)
		{
			$("#add_ajax").html(result);
			$("html, body").animate({ scrollTop: 450 }, "slow");
			if(type=='list'){$("#listlink").addClass("select");}else{$("#thumblink").addClass("select");}
			$("body").css("cursor", "default");
		}
	});
}
function getSliderData(addid)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/category-ajax-controller.php',
		type : 'post',
		data: 'getSliderDataChk=1&addid='+addid,
		success : function(result)
		{
			$("#bluebox_slider").html(result);
		}
	});
}