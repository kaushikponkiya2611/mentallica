jQuery(document).ready(function(){
	
	jQuery('#u_r_country_artist').change(function(){
		//Code
		var countryid = this.value;
		if(countryid != 233){
			jQuery(".statelistwrap").hide();
			jQuery("#u_r_state_artist").prop('required',false);
		}
		jQuery("#u_r_state_artist").html( "<option value=''>Select State</option>" );
		jQuery("#u_r_city").html( "<option value=''>Select City</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value }
		})
		.done(function( data ) {
			if(countryid == 233){
				jQuery(".statelistwrap").show();
				jQuery("#u_r_state_artist").prop('required',true);
			}
			jQuery("#u_r_state_artist").html( data );
		});
	});
	jQuery('#u_r_state_artist').change(function(){
		//Code
		jQuery("#u_r_city").html( "<option value=''>Select City</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getCityListByCountry: "getCityListByCountryChk", st_id: this.value }
		})
		.done(function( data ) {
			jQuery("#u_r_city").html( data );
		});
	});
	
	
	jQuery('#u_r_country').change(function(){
		//Code
                //alert(site_url);
		var countryid = this.value;
		if(countryid != 233){
			jQuery(".statelistwrap").hide();
			jQuery("#u_r_state").prop('required',false);
		}
		jQuery("#u_r_state").html( "<option value=''>Select State</option>" );
		jQuery("#u_r_city").html( "<option value=''>Select City</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value }
		})
		.done(function( data ) {
                    
			if(countryid == 233){
				jQuery(".statelistwrap").show();
				jQuery("#u_r_state").prop('required',true);
			}
			jQuery("#u_r_state").html( data );
		});
	});
	jQuery('#u_r_state').change(function(){
		//Code
		jQuery("#u_r_city").html( "<option value=''>Select City</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getCityListByCountry: "getCityListByCountryChk", st_id: this.value }
		})
		.done(function( data ) {
                    jQuery(".u_r_city").html(data);
                    jQuery("#u_r_city").html(data);
		});
	});

	
	
	jQuery('#u_r_country_profile').change(function(){
		//Code
		var countryid = this.value;
		jQuery("#u_r_state_profile").html( "<option value=''>Select State</option>" );
		jQuery("#u_r_city_profile").html( "<option value=''>Select City</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value }
		})
		.done(function( data ) {
			jQuery("#u_r_state_profile").html( data );
		});
	});
	
		jQuery('#u_r_state_profile').change(function(){
			//alert(); 
		//Code
		jQuery("#u_r_city_profile").html( "<option value=''>Select City</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getCityListByCountry: "getCityListByCountryChk", st_id: this.value }
		})
		.done(function( data ) {
			jQuery("#u_r_city_profile").html( data );
		});
	});
	
	jQuery('#u_r_country_artist_bkp').change(function(){
		//Code
		var countryid = this.value;
		if(countryid != 233){
			jQuery(".statelistartistwrap").hide();
			jQuery("#u_r_state_artist").prop('required',false);
		}
		jQuery("#u_r_state_artist").html( "<option value=''>Select State</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value }
		})
		.done(function( data ) {
			if(countryid == 233){
				jQuery(".statelistartistwrap").show();
				jQuery("#u_r_state_artist").prop('required',true);
			}
			jQuery("#u_r_state_artist").html( data );
		});
	});
	jQuery('#u_r_country_client').change(function(){
		//Code
		var countryid = this.value;
		if(countryid != 233){
			jQuery(".statelistclientwrap").hide();
			jQuery("#u_r_state_client").prop('required',false);
		}
		jQuery("#u_r_state_client").html( "<option value=''>Select State</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value }
		})
		.done(function( data ) {
			if(countryid == 233){
				jQuery(".statelistclientwrap").show();
				jQuery("#u_r_state_client").prop('required',true);
			}
			jQuery("#u_r_state_client").html( data );
		});
	});
	jQuery('#u_r_country_company').change(function(){
		//Code
		var countryid = this.value;
		if(countryid != 233){
			jQuery(".statelistcompanywrap").hide();
			jQuery("#u_r_state_company").prop('required',false);
		}
		jQuery("#u_r_state_company").html( "<option value=''>Select State</option>" );
		jQuery.ajax({
			method: "POST",
			url: site_url+"controllers/ajax_controller/register-ajax-controller.php",
			data: { getStateListByCountry: "getStateListByCountryChk", cnt_id: this.value }
		})
		.done(function( data ) {
			if(countryid == 233){
				jQuery(".statelistcompanywrap").show();
				jQuery("#u_r_state_company").prop('required',true);
			}
			jQuery("#u_r_state_company").html( data );
		});
	});
});