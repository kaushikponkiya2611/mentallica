<!DOCTYPE html>
<?php
if ($_GET['pid'] == 'login') {
    include('login.php');
} elseif ($_GET['pid'] == 'register') {
    include('register.php');
} elseif ($_GET['pid'] == 'plans') {
    include('plans.php');
} elseif ($_GET['pid'] == 'payment') {
    include('payment.php');
} elseif ($_GET['pid'] == 'login-paypal') {
    include('login-paypal.php');
} else {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title><?php echo $controller_class->pageTitle ?> | Mentallica</title>
            <link rel="icon" type="image/png" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] ?>img/siteicon/1430042965_131514.ico">

            <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

            <!-- bootstrap 3.0.2 -->
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <!-- font Awesome -->
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <!-- Ionicons -->
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
            <?php /* ?><!-- Morris chart -->
              <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/morris/morris.css" rel="stylesheet" type="text/css" />
              <!-- jvectormap -->
              <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
              <!-- fullCalendar -->
              <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
              <!-- Daterange picker -->
              <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
              <!-- bootstrap wysihtml5 - text editor -->
              <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /><?php */ ?>
            <!-- Theme style -->

            <?php //if($_GET['pid'] != "artistpreview"): ?>
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <?php //endif  ?>


            <!-- DATA TABLES -->
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/email-style.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/datepicker.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/plugins/imgzoom/imageviewer.css" rel="stylesheet" type="text/css" />
<!--            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/magiczoomplus.css" rel="stylesheet" type="text/css" />-->
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->


            <!--<link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>lightbox2/dist/css/lightbox.css">-->

            <script type="text/javascript">
                var pid = "<?= $_GET['pid'] ?>";

                var site_url = "<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>";
                var site_url_front = "<?= $_SESSION['FRNT_DOMAIN_NAME'] ?>";

                var rootpath = "<?= $_SERVER["DOCUMENT_ROOT"] ?>/";
            </script>



            <!-- jQuery 2.0.2 -->
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            
            
            <!-- Bootstrap -->
            <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/bootstrap.min.js" type="text/javascript"></script>
            <!-- Notification -->
            <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>

            

    <?php if ($_GET['pid'] != "artistsimages"): ?>
                <!-- AdminLTE App -->
                <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/AdminLTE/app.js" type="text/javascript"></script>
            <?php endif ?>
    <?php if ($_GET['pid'] == "preview" || $_GET['pid'] == "newsletter"): ?>
                <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>jQuery-gridmanager-master/dist/css/jquery.gridmanager.css" rel="stylesheet">  

                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->


        <!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/plugins/ckeditor/ckeditor.js"></script> -->
                <script src="https://cdn.ckeditor.com/4.5.9/standard-all/ckeditor.js"></script> 
                <script src="https://cdn.ckeditor.com/4.4.3/standard/adapters/jquery.js"></script> 
                <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>jQuery-gridmanager-master/dist/js/jquery.gridmanager.js"></script>
    <?php endif; ?>

            <script src='<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>zoom-master/jquery.zoom.js'></script>
            <style>
                /* styles unrelated to zoom */
                * { border:0; margin:0; padding:0; }

                /* these styles are for the demo, but are not required for the plugin */
                .zoom {
                    display:inline-block;
                    position: relative;
                    overflow: hidden;
                    padding-right: 0px;
                    padding-left: 0px;
                }
                .zoom p{
                    position:absolute; top:3px; right:28px; color:#555; font:bold 13px/1 sans-serif;
                    background-color: #fff;
                }

                /* magnifying glass icon */
                .zoom:after {
                    content:'';
                    display:block; 
                    width:33px; 
                    height:33px; 
                    position:absolute; 
                    top:0;
                    right:0;
                    background:url(<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>zoom-master/icon.png);
                }

                .zoom img {
                    display: block;
                }

                .zoom img::selection { background-color: transparent; }

                #ex2 img:hover { cursor: url(grab.cur), default; }
                #ex2 img:active { cursor: url(grabbed.cur), default; }
            </style>
            <script>
                $(document).ready(function () {
                    jQuery(".img-to-zoom").each(function () {
                        jQuery(this).zoom({on: 'click'});
                    })
                });
            </script>
            <?php /* if($_SESSION['po_userses']['flc_usrlogin_plan'] == 3):?>

              <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>lightbox2/dist/js/lightbox-plus-jquery.min.js"></script>
              <script type="text/javascript">
              jQuery.noConflict();
              // Code that uses other library's $ can follow here.
              </script>
              <?php endif; */ ?>

    <?php //if($_SESSION['po_userses']['flc_usrlogin_plan'] == 3): ?>
            <!-- Add mousewheel plugin (this is optional) -->
            <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

            <!-- Add fancyBox main JS and CSS files -->
            <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

            <!-- Add Button helper (this is optional) -->
            <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
            <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

            <!-- Add Thumbnail helper (this is optional) -->
            <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
            <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

            <!-- Add Media helper (this is optional) -->
            <script type="text/javascript" src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/magiczoomplus.js" type="text/javascript"></script>-->
<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/plugins/imgzoom/imageviewer.js" type="text/javascript"></script>
<!--<script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>js/zoomer.js" type="text/javascript"></script>-->
            <!-- page script -->
            
            <script type="text/javascript">

            $(function () {
                var viewer = ImageViewer();
                $('.gallery-items').click(function () {
                    var imgSrc = this.src,
                        highResolutionImage = $(this).data('high-res-img');

                    viewer.show(imgSrc, highResolutionImage);
                });
            });
            </script>
            <script type="text/javascript">
                /*$("a[rel=example_group]").fancybox({
                 'transitionIn'      : 'none',
                 'transitionOut'     : 'none',
                 'titlePosition'     : 'over',
                 'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
                 return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                 }
                 });*/
            </script>
            <style type="text/css">
                .fancybox-custom .fancybox-skin {
                    box-shadow: 0 0 50px #222;
                }
            </style>
            
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    /*
                     *  Simple image gallery. Uses default settings
                     */

                    jQuery('.fancybox').fancybox();

                    /*
                     *  Different effects
                     */

                    // Change title type, overlay closing speed
                    jQuery(".fancybox-effects-a").fancybox({
                        helpers: {
                            title: {
                                type: 'outside'
                            },
                            overlay: {
                                speedOut: 0
                            }
                        }
                    });

                    // Disable opening and closing animations, change title type
                    jQuery(".fancybox-effects-b").fancybox({
                        openEffect: 'none',
                        closeEffect: 'none',

                        helpers: {
                            title: {
                                type: 'over'
                            }
                        }
                    });

                    // Set custom style, close if clicked, change title type and overlay color
                    jQuery(".fancybox-effects-c").fancybox({
                        wrapCSS: 'fancybox-custom',
                        closeClick: true,

                        openEffect: 'none',

                        helpers: {
                            title: {
                                type: 'inside'
                            },
                            overlay: {
                                css: {
                                    'background': 'rgba(238,238,238,0.85)'
                                }
                            }
                        }
                    });

                    // Remove padding, set opening and closing animations, close if clicked and disable overlay
                    jQuery(".fancybox-effects-d").fancybox({
                        padding: 0,

                        openEffect: 'elastic',
                        openSpeed: 150,

                        closeEffect: 'elastic',
                        closeSpeed: 150,

                        closeClick: true,

                        helpers: {
                            overlay: null
                        }
                    });

                    /*
                     *  Button helper. Disable animations, hide close button, change title type and content
                     */

                    jQuery('.fancybox-buttons').fancybox({
                        openEffect: 'none',
                        closeEffect: 'none',

                        prevEffect: 'none',
                        nextEffect: 'none',

                        closeBtn: false,

                        helpers: {
                            title: {
                                type: 'inside'
                            },
                            buttons: {}
                        },

                        afterLoad: function () {
                            this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                        }
                    });


                    /*
                     *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
                     */

                    jQuery('.fancybox-thumbs').fancybox({
                        prevEffect: 'none',
                        nextEffect: 'none',

                        closeBtn: false,
                        arrows: false,
                        nextClick: true,

                        helpers: {
                            thumbs: {
                                width: 50,
                                height: 50
                            }
                        }
                    });

                    /*
                     *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
                     */
                    jQuery('.fancybox-media')
                            .attr('rel', 'media-gallery')
                            .fancybox({
                                openEffect: 'none',
                                closeEffect: 'none',
                                prevEffect: 'none',
                                nextEffect: 'none',

                                arrows: false,
                                helpers: {
                                    media: {},
                                    buttons: {}
                                }
                            });

                    /*
                     *  Open manually
                     */

                    jQuery("#fancybox-manual-a").click(function () {
                        jQuery.fancybox.open('1_b.jpg');
                    });

                    jQuery("#fancybox-manual-b").click(function () {
                        jQuery.fancybox.open({
                            href: 'iframe.html',
                            type: 'iframe',
                            padding: 5
                        });
                    });

                    jQuery("#fancybox-manual-c").click(function () {
                        jQuery.fancybox.open([
                            {
                                href: '1_b.jpg',
                                title: 'My title'
                            }, {
                                href: '2_b.jpg',
                                title: '2nd title'
                            }, {
                                href: '3_b.jpg'
                            }
                        ], {
                            helpers: {
                                thumbs: {
                                    width: 75,
                                    height: 50
                                }
                            }
                        });
                    });


                });
                
                

            </script>
    <?php //endif;  ?>
            <link rel="stylesheet" href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/chosen/chosen.css">
            <style type="text/css" media="all">
                /* fix rtl for demo */
                .chosen-rtl .chosen-drop { left: -9000px; }
            </style>

            <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>views/javascripts/commonscript.js" type="text/javascript"></script>

            <!-- custom css -->
            <link href="<?php echo $_SESSION['FRNT_DOMAIN_NAME']; ?>css/style.css" rel="stylesheet" type="text/css" />


            <!-- Facebook Open Graph -->
            <meta property="og:title" content="mentallica"/>
            <meta property="og:type" content="website"/>
            <meta property="og:url" content="<?php echo $FRNT_DOMAIN_NAME;?>">
            <meta property="og:site_name" content="mentallica Website"/>
            <meta property="og:description" content="Home | projectone" />
            <meta property="og:image" content="../img/gifeyeandmentallpen.gif" />

            <!-- Datepicker -->    
            <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js" type="text/javascript"></script>
            <script type="text/javascript">
                
/*                 jQuery(function() {
                    jQuery('input[name="daterange"]').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        locale: {
                            format: 'MM/DD/YYYY h:mm A'
                        }
                    });
                });*/
            </script>
        </head>
        <?php        
        if (isset($_GET['pid']) && $_GET['pid'] != '') {
            if (isset($_GET['pid']) && is_file('views/' . $_GET['pid'] . '.php')) {
                require_once($_GET['pid'] . '.php');
            } else {
                if ($_GET['pid'] == 'yxjaxnchjldmllw') {
                    $_GET['pid'] = "artistpreview";
                    require_once($_GET['pid'] . '.php');
                } else {
                    $embeddetail = $controller_class->checkembedcode(urldecode($_REQUEST['pid']));
                    if ($embeddetail['id'] != '') {
                        $_GET['workid'] = $embeddetail['username'];
                        require_once('preview.php');
                    } else {
                        require_once('not-found.php');
                    }
                }
            }
        } else {
            require_once('home.php');
        }
        ?>



    </html>
    <?php
    }?>

