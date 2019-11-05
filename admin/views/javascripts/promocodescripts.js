function searching() {
    var alpha = /^[a-zA-Z]+$/;
    var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
    $("#searchmsg").html('');
    var flag = 0;
    var regflag = 0;
    if ($("#txt_srcpromo_code").val() == '' && $("#combo_srcuser_type").val() == '' && $("#combo_srcemail_address").val() == '') {
        flag = 1;
    }
    if (flag == 1) {
        parent.$.fancybox.close();
        $("#search").val('0');
        newdata();
    } else
    {
        if (regflag == 0)
        {
            $("#searchmsg").html('');
            var options = {
                beforeSubmit: showRequest,
                success: showResponse_search,
                url: site_url + 'controllers/ajax_controller/promocode-ajax-controller.php',
                type: "POST"
            };
            $('#form_search').submit(function ()
            {
                $(this).ajaxSubmit(options);
                return false;
            });
        }
    }
}
function showResponse_search(data, statusText) {
    if (statusText == 'success') {
        parent.$.fancybox.close();
        $("#currency").html(data);
    }
}
function adddata() {
    var alpha = /^[a-zA-Z]+$/;
    var alphanum = /^[a-zA-Z0-9]+$/;
    var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
    var mobnum = /^[0-9]{10,12}$/;
    var phonum = /^[0-9]{10,14}$/;
    var num = /^[0-9]$/;
    var decnum = /^[0-9.]$/;
    var domain = /[^,\s]+\.{1,}[^,\s]{2,}/;
    var url = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
    if ($("#txt_addpromo_code").val() == '') {
        $("#error-innertxt_addpromo_code").show().fadeOut(5000);
        $("#error-innertxt_addpromo_code").html('This field is required');
        $("#txt_addpromo_code").focus();
        return false;
    }else if ($("#txt_addemail_address").val() == '') {
        $("#error-innertxt_addemail_address").show().fadeOut(5000);
        $("#error-innertxt_addemail_address").html('This field is required');
        $("#txt_addemail_address").focus();
        return false;
    }else if(emailchk.test($("#txt_addemail_address").val()) == false){
        $("#error-innertxt_addemail_address").show().fadeOut(5000);
        $("#error-innertxt_addemail_address").html('Invalid email id');
        $("#txt_addemail_address").focus();
        return false;
    } else if ($("#txt_adduser_type").val() == '') {
        $("#error-innertxt_adduser_type").show().fadeOut(5000);
        $("#error-innertxt_adduser_type").html('This field is required');
        $("#txt_adduser_type").focus();
        return false;
    } else
    {
        var options = {
            beforeSubmit: showRequest,
            success: showResponse,
            url: site_url + 'controllers/ajax_controller/promocode-ajax-controller.php',
            type: "POST"
        };
        $('#form_promocodeadd').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    }
}
function showRequest(formData, jqForm, options) {
    return true;
}
function showResponse(data, statusText) {
    if (statusText == 'success')
    {
        if (data == 0)
        {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Email address already exist. Please try another.';
        } else if (data == 1) {
            $("#message-red").hide();
            $("#message-green").show().fadeOut(5000);
            document.getElementById('succ').innerHTML = 'Promo code added successfully.';
            newdata();
        } else if (data == 2) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Some error occurred while adding promo code.';
        }
        $('#form_promocodeadd').unbind('submit').bind('submit', function () {
        });
    }
}
function updatedata() {
    var alpha = /^[a-zA-Z]+$/;
    var alphanum = /^[a-zA-Z0-9]+$/;
    var emailchk = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
    var mobnum = /^[0-9]{10,12}$/;
    var phonum = /^[0-9]{10,14}$/;
    var num = /^[0-9]$/;
    var decnum = /^[0-9.]$/;
    var domain = /[^,\s]+\.{1,}[^,\s]{2,}/;
    var url = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
    if ($("#txt_addpromo_code").val() == '') {
        $("#error-innertxt_addpromo_code").show().fadeOut(5000);
        $("#error-innertxt_addpromo_code").html('This field is required');
        $("#txt_addpromo_code").focus();
        return false;
    }else if ($("#txt_addemail_address").val() == '') {
        $("#error-innertxt_addemail_address").show().fadeOut(5000);
        $("#error-innertxt_addemail_address").html('This field is required');
        $("#txt_addemail_address").focus();
        return false;
    }else if(emailchk.test($("#txt_addemail_address").val()) == false){
        $("#error-innertxt_addemail_address").show().fadeOut(5000);
        $("#error-innertxt_addemail_address").html('Invalid email id');
        $("#txt_addemail_address").focus();
        return false;
    } else if ($("#txt_adduser_type").val() == '') {
        $("#error-innertxt_adduser_type").show().fadeOut(5000);
        $("#error-innertxt_adduser_type").html('This field is required');
        $("#txt_adduser_type").focus();
        return false;
    } else
    {
        var options = {
            beforeSubmit: showRequest_update,
            success: showResponse_update,
            url: site_url + 'controllers/ajax_controller/promocode-ajax-controller.php',
            type: "POST"
        };
        $('#form_promocodeadd').submit(function () {
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
        if (data == 0) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Email address already exist. Please try another.';
        } else if (data == 1) {
            $("#message-red").hide();
            $("#message-green").show().fadeOut(5000);
            document.getElementById('succ').innerHTML = 'Promo code updated successfully.';
            newdata();
        } else if (data == 2) {
            $.scrollTo(0, 500);
            $("#message-red").show().fadeOut(7000);
            $("#message-green").hide();
            document.getElementById('err').innerHTML = 'Some error occurred while updating promo code.';
        }
    }
    $('#form_promocodeadd').unbind('submit').bind('submit', function () {
    });
}