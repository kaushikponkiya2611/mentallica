<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>
            <?= $controller_class->pageTitle ?> - ProjectName</title>
        <link rel="icon" type="image/png" href="<?= $LOCATION['SITE_ADMIN'] ?>images/favicon.ico">
            <link href="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/<?= $controller_class->mytheme ?>" rel="stylesheet" type="text/css"/>

            <link href="<?= $LOCATION['SITE_ADMIN'] ?>css/styles.css" rel="stylesheet" type="text/css" />
            <link href="<?= $LOCATION['SITE_ADMIN'] ?>css/green.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" type="text/css" href="<?= $LOCATION['SITE_ADMIN'] ?>css/superfish.css" />
            <link href="<?= $LOCATION['SITE_ADMIN'] ?>css/menu.css" rel="stylesheet" type="text/css" />
            <link href="<?= $LOCATION['SITE_ADMIN'] ?>uploadify/uploadify.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript">
                var pid = "<?= $_GET['pid'] ?>";
<?php
if ($_GET['pid'] == 'employeemanagement') {
    ?>
                    var pid_upper = "Employee";
                    var pid_lower = "employee";
    <?php
} else {
    ?>
                    var pid_upper = "<?= ucfirst($_GET['pid']) ?>";
                    var pid_lower = "<?= $_GET['pid'] ?>";
    <?php
}
?>

                var site_url = "<?= $_SESSION['ADMIN_DOMAIN_NAME'] ?>";
                var site_url_front = "<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>";

                var rootpath = "<?= $_SERVER["DOCUMENT_ROOT"] ?>";
            </script>
            <!--[if IE]>
            <link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
            <![endif]-->
            <!--  jquery core -->
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/defaultscript.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/popup.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery-1.4.1.min.js"></script>

            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.scrollTo-1.4.1-min.js"></script>

            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/ui.core.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.bind.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.selectbox-0.5_style_2.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.filestyle.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.tooltip.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/custom_jquery.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.datePicker.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/date.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.mousewheel-3.0.4.pack.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.fancybox-1.3.4.pack.js"></script>
            <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/ui.checkbox.js"></script>

            <link rel="stylesheet" type="text/css" href="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.fancybox-1.3.4.css" media="screen" />

            <?php
            if ($_GET['pid'] != 'dashboard') {
                ?>
                <![if !IE 7]>
                <!--  styled select box script version 1 -->
                <script src="<?= $LOCATION['SITE_ADMIN'] ?>views/javascripts/js/jquery.selectbox-0.5.js" type="text/javascript"></script>
                <script type="text/javascript">

                $(document).ready(function () {
                    $('.styledselect').selectbox({inputClass: "selectbox_styled"});

                });
                </script>
                <![endif]>
                <!--  styled select box script version 2 -->
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.styledselect_form_1').selectbox({inputClass: "styledselect_form_1"});
                        $('.styledselect_form_2').selectbox({inputClass: "styledselect_form_2"});
                    });

                </script>
                <!--  styled select box script version 3 -->
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.styledselect_pages').selectbox({inputClass: "styledselect_pages"});
                    });
                </script>
                <!--  styled file upload script -->
                <script type="text/javascript" charset="utf-8">
                    $(function () {
                        $("input.file_1").filestyle({
                            image: "images/forms/upload_file.gif",
                            imageheight: 29,
                            imagewidth: 78,
                            width: 300
                        });
                    });

                </script>
                <!-- Custom jquery scripts -->
                <!-- Tooltips -->
                <script type="text/javascript">
                    $(function () {
                        $('a.info-tooltip ').tooltip({
                            track: true,
                            delay: 0,
                            fixPNG: true,
                            showURL: false,
                            showBody: " - ",
                            top: -35,
                            left: 5
                        });

                    });

                </script>
                <script src="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/src/js/jscal2.js"></script>
                <script src="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/src/js/lang/en.js"></script>
                <link rel="stylesheet" type="text/css" href="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/src/css/jscal2.css" />
                <link rel="stylesheet" type="text/css" href="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/src/css/border-radius.css" />
                <link rel="stylesheet" type="text/css" href="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/src/css/steel/steel.css" />
                <!--  date picker script -->
                <link href="<?= $LOCATION['SITE_ADMIN'] ?>stylesheets/datePicker.css" rel="stylesheet" type="text/css"/>
                <script type="text/javascript" charset="utf-8">

                    $(function ()
                    {
                        // initialise the "Select date" link
                        $('#date-pick')
                                .datePicker(
                                        // associate the link with a date picker
                                                {
                                                    createButton: false,
                                                    startDate: '01/01/2005',
                                                    endDate: '31/12/2020'
                                                }
                                        ).bind(
                                                // when the link is clicked display the date picker
                                                'click',
                                                function ()
                                                {
                                                    updateSelects($(this).dpGetSelected()[0]);
                                                    $(this).dpDisplay();
                                                    return false;
                                                }
                                        ).bind(
                                                // when a date is selected update the SELECT
                                                'dateSelected',
                                                function (e, selectedDate, $td, state)
                                                {
                                                    updateSelects(selectedDate);
                                                }
                                        ).bind(
                                                'dpClosed',
                                                function (e, selected)
                                                {
                                                    updateSelects(selected[0]);
                                                }
                                        );

                                        var updateSelects = function (selectedDate)
                                        {
                                            var selectedDate = new Date(selectedDate);
                                            $('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
                                            $('#m option[value=' + (selectedDate.getMonth() + 1) + ']').attr('selected', 'selected');
                                            $('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
                                        }
                                        // listen for when the selects are changed and update the picker
                                        $('#d, #m, #y')
                                                .bind(
                                                        'change',
                                                        function ()
                                                        {
                                                            var d = new Date(
                                                                    $('#y').val(),
                                                                    $('#m').val() - 1,
                                                                    $('#d').val()
                                                                    );
                                                            $('#date-pick').dpSetSelected(d.asString());
                                                        }
                                                );

                                        // default the position of the selects to today
                                        var today = new Date();
                                        updateSelects(today.getTime());
                                        // and update the datePicker to reflect it...

                                        $('#d').trigger('change');
                                    });
                </script>
                <!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
                <script type="text/javascript">

                    function trimAll(sString)
                    {
                        while (sString.substring(0, 1) == ' ')
                        {
                            sString = sString.substring(1, sString.length);
                        }
                        while (sString.substring(sString.length - 1, sString.length) == ' ')
                        {
                            sString = sString.substring(0, sString.length - 1);
                        }
                        return sString;
                    }
                    function checkaddress(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "")
                        {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_ENTER_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='negative'");
                            return false;
                        }
                        else {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_VALID_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='positive'");
                            return true;
                        }
                    }
                    function checkfield(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "")
                        {
                            $("#error-inner" + name).show().fadeOut(5000);
                            $("#error-inner" + name).html('This field is required');
                            return false;
                        } else {
                            $("#error-inner" + name).hide();
                            return false;
                        }
                    }

                    function checkfield_2(obj) {
                        var name = obj.id;
                        if (trimAll(obj.value) == "")
                        {
                            $("#error-inner" + name).show().fadeOut(5000);
                            $("#error-inner" + name).html('This field is required');
                            return false;
                        } else {
                            $("#error-inner" + name).hide();
                            return false;
                        }
                    }

                    function checkdrpdwn(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "0")
                        {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This field is required');
                            $("#txt_pagename").focus();
                            return false;
                        } else {
                            $("#error" + name).hide();
                            return false;
                        }
                    }

                    function checkdrpdwnvalnull(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "")
                        {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This field is required');
                            return false;
                        } else {
                            $("#error" + name).hide();
                            return false;
                        }
                    }

                    function checknumberfield(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "")
                        {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This field is required');
                            $("#txt_pagename").focus();
                            return false;
                        }
                        else if (obj.value != "") {
                            return checkoptnumberfield(obj);
                        }
                    }
                    function checkoptnumberfield(obj) {
                        var name = obj.name;
                        if (!IsNumeric(trimAll(obj.value)) && trimAll(obj.value) == "") {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This field is required');
                            $("#txt_pagename").focus();
                            return false;
                        }
                        else if (!IsNumeric(trimAll(obj.value)) && trimAll(obj.value) != "") {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This field is required');
                            $("#txt_pagename").focus();
                            return false;
                        }
                        else {
                            $("#error" + name).hide();
                            return false;
                        }
                    }
                    function checktelephnumb(obj) {
                        var name = obj.name;
                        var numb = /[0-9+-]+$/;
                        if (trimAll(obj.value) == "")
                        {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_ENTER_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='negative'");
                            return false;
                        } else if (numb.test(trimAll(obj.value)) == false) {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_INVALID_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='negative'");
                            return false;
                        } else {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_VALID_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='positive'");
                            return true;
                        }
                    }

                    function comparefield(obj1, obj2) {
                        var name = obj1.name;
                        if (trimAll(obj1.value) != trimAll(obj2.value))
                        {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_COMPARE_NOT_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='negative'");
                            return false;
                        } else {
                            eval("document.getElementById('validate" + name + "').style.display='block'");
                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_COMPARE_VALUE; ?>'");
                            eval("document.getElementById('validate" + name + "').className ='positive'");
                            return true;
                        }
                    }

                    function checkmail(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "")
                        {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This Field is required');
                            return false;
                        }
                        else {
                            return checkoptmail(obj);
                        }
                    }

                    function checkoptmail(obj) {
                        var name = obj.name;
                        var reg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
                        if (!reg.test(trimAll(obj.value)) && trimAll(obj.value) != "")
                        {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('Invalid Email Id');
                            return false;
                        } else {
                            $("#error" + name).hide();
                            return false;
                        }
                    }
                    function checkalphanumericfield(obj) {
                        var name = obj.name;
                        if (trimAll(obj.value) == "")
                        {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('This Field is required');
                            return false;
                        } else {
                            return alphanumeric(obj);
                        }
                    }

                    function alphanumeric(obj) {
                        var name = obj.name;
                        var alphanumeric = /^[a-zA-Z0-9]+$/;
                        if (alphanumeric.test(trimAll(obj.value)) == false) {
                            $("#error" + name).show();
                            $("#error-inner" + name).html('Invalid Value');
                            return false;
                        } else {
                            $("#error" + name).hide();
                            return false;
                        }

                    }

                    function checkalphanumspace(obj) {

                        var name = obj.name;

                        var alphanumsp = /^[a-zA-Z0-9 ]+$/;

                        if (trimAll(obj.value) == "") {

                            $("#error" + name).show();

                            $("#error-inner" + name).html('This Field is required');

                            return false;

                        } else if (alphanumsp.test(trimAll(obj.value)) == false) {

                            $("#error" + name).show();

                            $("#error-inner" + name).html('Invalid Value');

                            return false;

                        } else {

                            $("#error" + name).hide();

                            return false;

                        }

                    }

                    function checkwebaddress(obj) {

                        var name = obj.name;

                        var webaddress = /^[https://]|[w][w][w]+\.[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]+$/;

                        if (trimAll(obj.value) == "") {

                            $("#error" + name).show();

                            $("#error-inner" + name).html('This Field is required');

                            return false;

                        } else if (webaddress.test(trimAll(obj.value)) == false) {

                            $("#error" + name).show();

                            $("#error-inner" + name).html('Invalid Value');

                            return false;

                        } else {

                            $("#error" + name).hide();

                            return false;

                        }

                    }

                    function date(obj) {

                        var name = obj.name;

                        var d = /^[0-9-]/;

                        if (trimAll(obj.value) == "") {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_ENTER_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;

                        } else if (!d.test(trimAll(obj.value))) {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_INVALID_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;

                        } else {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_VALID_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='positive'");

                            return true;

                        }

                    }



                    function checkalphaspacefield(obj) {

                        var name = obj.name;

                        if (trimAll(obj.value) == "")

                        {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_ENTER_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;

                        } else {

                            return checkalphaspace(obj);

                        }

                    }





                    function checkalphaspace(obj) {

                        var name = obj.name;

                        var alpspace = /^[a-zA-Z ]+$/;

                        if (alpspace.test(trimAll(obj.value)) == false) {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo "Invalid Value.Numeric or any special char. not allow"; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;

                        } else {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_VALID_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='positive'");

                            return true;

                        }



                    }

                    function alpha(obj) {

                        var name = obj.name;

                        var alpha = /^[a-zA-Z]+$/;

                        if (alpha.test(trimAll(obj.value)) == false)

                        {



                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_ALPHA_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;

                        } else {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_VALID_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='positive'");

                            return true;

                        }

                    }

                    function IsNumeric(strString)

                    {

                        var strValidChars = "0123456789";

                        var strChar;

                        var blnResult = true;

                        if (strString.length == 0)
                            return false;

                        //  test strString consists of valid characters listed above

                        for (i = 0; i < strString.length && blnResult == true; i++)

                        {

                            strChar = strString.charAt(i);

                            if (strValidChars.indexOf(strChar) == -1)

                            {

                                blnResult = false;

                            }

                        }

                        return blnResult;

                    }

                    function comparedate(obj1, obj2) {

                        var name = obj2.name;

                        currentTime = new Date();

                        dt = currentTime.format('Y-m-d');

                        if (trimAll(obj1.value) == "")

                        {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_ENTER_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;

                        }

                        else if (obj1.value < dt)

                        {
                            name2 = obj1.name;



                            eval("document.getElementById('validate" + name2 + "').style.display='block'");

                            eval("document.getElementById('validate" + name2 + "').innerHTML='<?php echo $lang->_COMPARE_SDATE_NOT_VALUE; ?>'");

                            eval("document.getElementById('validate" + name2 + "').className ='negative'");

                            return false;



                        }

                        else if (obj1.value > obj2.value)

                        {





                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_COMPARE_DATE_NOT_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='negative'");

                            return false;



                        } else {

                            eval("document.getElementById('validate" + name + "').style.display='block'");

                            eval("document.getElementById('validate" + name + "').innerHTML='<?php echo $lang->_VALID_VALUE; ?>'");

                            eval("document.getElementById('validate" + name + "').className ='positive'");

                            return true;

                        }

                    }

                </script>
                <!--<script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>uploadify/jquery-1.4.2.min.js"></script>
                
                <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>uploadify/swfobject.js"></script>
                
                <script type="text/javascript" src="<?= $LOCATION['SITE_ADMIN'] ?>uploadify/jquery.uploadify.v2.1.4.min.js"></script>
                
                <script type="text/javascript">
                
                    // <![CDATA[
                
                    $(document).ready(function() {
                
                      $('#file_upload').uploadify({
                
                        'uploader'  : 'uploadify/uploadify.swf',
                
                        'script'    : 'uploadify/uploadify.php',
                
                        'cancelImg' : 'uploadify/cancel.png',
                
                        'folder'    : '/uploads',
                
                        'auto'      : true,
                
                                'multi'	:true,
                
                                'folder'    : 'upload/'
                
                      });
                
                    });
                
                    // ]]>
                
                </script>-->
                <?php
            }
            ?>

            <?php /* ?><script type="text/javascript" src="<?=$LOCATION['SITE_ADMIN']?>nailthumb/jquery.nailthumb.1.1.min.js"></script>
              <link href="<?=$LOCATION['SITE_ADMIN']?>nailthumb/jquery.nailthumb.1.1.css" rel="stylesheet" type="text/css" /><?php */ ?>
    </head>
    <body>
        <div class="block_outerdiv" id="div_loader">
            <div class="block_innerdiv" id="div_loader2"></div>
        </div>
        <div class="wrapper">
            <!-- Start: page-top-outer -->
            <div id="page-top-outer">
                <!-- Start: page-top -->
                <div id="page-top">
                    <?php
                    include_once('header.php');
                    ?>
                </div>
                <!-- End: page-top -->
            </div>
            <!-- End: page-top-outer -->
            <div class="clear">&nbsp;</div>
            <!--  start nav-outer-repeat................................................................................................. START -->
            <div class="nav-outer-repeat">
                <!--  start nav-outer -->
                <?php
                include_once('menu.php');
                ?>
                <div class="clear"></div>
                <!--  start nav-outer -->
            </div>
            <!--  start nav-outer-repeat................................................... END -->
            <div class="clear"></div>
            <!-- start content-outer -->
            <div id="content-outer">
                <div class="red_bg">
                    <div class="middle_main">
                        <div style="margin:0 auto;width:98%">
                            <?php
                            $image = $controller_class->mainimage;

                            if ($image == '') {
                                $image = 'default.png';
                            }
                            ?>
                            <div class="coman_width"><img src="<?= $LOCATION['SITE_ADMIN'] ?>images/menu/<?= $image ?>" width="32" height="32" alt="cog"></div>
                            <div class="float_left location_padding" style="font-size:14px;"><?= $controller_class->h1 ?></div>
                            <div class="float_right" id="main_addbutton">
                                <?php
                                if ($_GET['pid'] != 'dashboard' && $_GET['pid'] != 'radio' && $_GET['pid'] != 'setting' && $_GET['pid'] != '' && $_GET['pid'] != 'changepassword' && $_GET['pid'] != 'payment' && $_GET['pid'] != 'advertise' && $_GET['pid'] != 'individual' && $_GET['pid'] != 'employersmail' && $_GET['pid'] != 'plans' && $_GET['pid'] != 'artists' && $_GET['pid'] != 'client' && $_GET['pid'] != 'company' && $_GET['pid'] != 'category_artist') {
                                    if ($_GET['pid'] == 'test123') {
                                        ?>
                                        <input class="addbutton_bg" type="button" value="Back to HR" name="btn_add" onclick="javascript:window.location.href = site_url + 'index.php?pid=hr'">
                                            <?php
                                        } else {
                                            ?>
                                            <input class="addbutton_bg" type="button" value="Add New" name="btn_add" onclick="showadd1('<?php echo $_REQUEST['pid'] ?>')">
                                                <?php
                                            }
                                        }
                                        ?>
                                        </div>
                                        <div class="clear"></div>
                                        </div>
                                        </div>
                                        </div>
                                        <!-- start content -->
                                        <div id="content">
                                            <!--<div id="page-heading"><h1><?= $controller_class->h1 ?>
                                            </h1>
                                          </div>
                                            -->
                                            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
                                                <tr>
                                                    <th rowspan="3" class="sized"><img src="<?= $LOCATION['SITE_ADMIN'] ?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
                                                    <th class="topleft"></th>
                                                    <td id="tbl-border-top">&nbsp;</td>
                                                    <th class="topright"></th>
                                                    <th rowspan="3" class="sized"><img src="<?= $LOCATION['SITE_ADMIN'] ?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
                                                </tr>
                                                <tr>
                                                    <td id="tbl-border-left"></td>
                                                    <td><!--  start content-table-inner -->
                                                        <div id="content-table-inner">
                                                            <?php
                                                            if (isset($_SESSION['ADMIN_ID']) && $_SESSION['ADMIN_ID'] != '') {
                                                                if (isset($_GET['pid']) && $_GET['pid'] != '') {
                                                                    if (isset($_GET['pid']) && is_file('views/' . $_GET['pid'] . '.php')) {
                                                                        require_once($_GET['pid'] . '.php');
                                                                    } else {
                                                                        require_once('not-found.php');
                                                                    }
                                                                } else {
                                                                    require_once('dashboard.php');
                                                                }
                                                            }
                                                            ?>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <!--  end content-table-inner  -->
                                                    </td>
                                                    <td id="tbl-border-right"></td>
                                                </tr>
                                                <tr>
                                                    <th class="sized bottomleft"></th>
                                                    <td id="tbl-border-bottom">&nbsp;</td>
                                                    <th class="sized bottomright"></th>
                                                </tr>
                                            </table>
                                            <div class="clear">&nbsp;</div>
                                        </div>
                                        <!--  end content -->
                                        <div class="clear">&nbsp;</div>
                                        </div>
                                        <!--  end content-outer -->
                                        <div class="clear">&nbsp;</div>
                                        <!-- start footer -->
                                        <div class="push"></div>
                                        </div>
                                        <div id="footer">
                                            <?php
                                            include_once('footer.php');
                                            ?>
                                        </div>
                                        <!-- end footer -->
                                        </body>
                                        </html>
