function getAddPaging(catId,brdId,modId,year,prcRng,sortdata,start,end,type)
{
	//alert(start);
	$("body").css("cursor", "wait");
	//$("#add_perPage").val();
	//$("#thumblink").removeClass("select");
	//$("#listlink").removeClass("select");
	$.ajax( {
		url : site_url+'controllers/ajax_controller/search-ajax-controller.php',
		type : 'post',
		data: 'addPagingCode=1&catId='+catId+'&brdId='+brdId+'&modId='+modId+'&year='+year+'&prcRng='+prcRng+'&sortdata='+$("#sortby_fld").val()+'&start='+start+'&end='+$("#add_perPage").val()+'&type='+type,
		success : function(result)
		{
			$("#add_ajax").html(result);
			$("html, body").animate({ scrollTop: 150 }, "slow");
			//if(type=='list'){$("#listlink").addClass("select");}else{$("#thumblink").addClass("select");}
			$("body").css("cursor", "default");
		}
	});
}
function getBrandByCategorySer(catid){
	$.ajax( {
		url : site_url+'controllers/ajax_controller/search-ajax-controller.php',
		type : 'post',
		data: 'getBrandFromCategory=1&catid='+catid,
		success : function(result)
		{
			$("#ser_brnd_aj").html(result);
			//alert(result);
			$("#ser_model").html("<option value=''>Select Model</option>");
		}
	});	
}	
function getModelByBrandSer(brndid)
{
	$.ajax( {
		url : site_url+'controllers/ajax_controller/search-ajax-controller.php',
		type : 'post',
		data: 'getModelFromBrand=1&brndid='+brndid,
		success : function(result)
		{
			//alert(result);
			$("#ser_model_aj").html(result);
		}
	});	
}
function addSearchPopup()
{
	$("body").css("cursor", "wait");
	$.ajax( {
		url : site_url+'controllers/ajax_controller/search-ajax-controller.php',
		type : 'post',
		data: 'addPagingCode=1&catId='+$("#ser_category").val()+'&brdId='+$("#ser_brand").val()+'&modId='+$("#ser_model").val()+'&year='+$("#ser_year").val()+'&prcRng='+$("#ser_color").val()+'&sortdata='+$("#sortby_fld").val()+'&start='+0+'&end='+$("#add_perPage").val()+'&type=thumb',
		success : function(result)
		{
			$("#add_ajax").html(result);
			$("html, body").animate({ scrollTop: 150 }, "slow");
			//if(type=='list'){$("#listlink").addClass("select");}else{$("#thumblink").addClass("select");}
			
			$("#ser_thumb").click(function(){ getAddPaging($("#ser_category").val(),$("#ser_brand").val(),$("#ser_model").val(),$("#ser_year").val(),$("#ser_color").val(),$("#sortby_fld").val(),0,$("#add_perPage").val(),'thumb'); });
			
			$("#ser_list").click(function(){ getAddPaging($("#ser_category").val(),$("#ser_brand").val(),$("#ser_model").val(),$("#ser_year").val(),$("#ser_color").val(),$("#sortby_fld").val(),0,$("#add_perPage").val(),'list'); });
			
			$("#sortby_fld").change(function(){ getAddPaging($("#ser_category").val(),$("#ser_brand").val(),$("#ser_model").val(),$("#ser_year").val(),$("#ser_color").val(),$("#sortby_fld").val(),0,$("#add_perPage").val(),'thumb'); });
			
			$("#add_perPage").change(function(){ getAddPaging($("#ser_category").val(),$("#ser_brand").val(),$("#ser_model").val(),$("#ser_year").val(),$("#ser_color").val(),$("#sortby_fld").val(),0,$("#add_perPage").val(),'thumb'); });
			 
			 $("#ser_thumb").attr('onclick', '');
			 $("#ser_list").attr('onclick', '');
			 $("#sortby_fld").attr('onchange', '');
			 $("#add_perPage").attr('onchange', '');
			 
			$("body").css("cursor", "default");
			
			close_popup();
		}
	});
}