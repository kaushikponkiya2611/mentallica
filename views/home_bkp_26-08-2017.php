<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    
    <div class="container">
    <div class="row blue-border-main">
     <div class=''>
        
    		<?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");?>
                    
                    
                        <?php /* ?>
                          <!-- row -->
                          <div class="row">
                          <?php foreach ($controller_class -> getuserimages as $key => $imgsdata):?>
                          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                          <?php if($_SESSION['po_userses']['flc_usrlogin_plan'] == 3):?>
                          <a href="<?php echo $_SESSION['SITE_NAME']."upload/images/".$imgsdata['image']; ?>" class="example-image-link thumb" data-lightbox="example-set" data-title="<?php echo $imgsdata['image_text'];?>">
                          <img src="<?php echo $_SESSION['SITE_NAME']."upload/images/300/".$imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                          </a>
                          <?php else: ?>
                          <img src="<?php echo $_SESSION['SITE_NAME']."upload/images/300/".$imgsdata['image']; ?>" alt="..." class='example-image img-responsive' />
                          <?php endif;?>
                          </div>
                          <?php endforeach; ?>
                          </div><!-- /.row -->
                          <?php */ ?>
        
        
        
        
        
                        <div class="container">
        
                            <!-- Content Header (Page header) -->
                            <!-- <section class="content-header">
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                </ol>
                            </section> -->
                            <!-- Page Header -->
                            <div class="row">
                                <div class="banner-and-text homevideo-bg">
                                    <div class="col-md-7">
                                        <div class="rot-cat-banner-imgs">
                                            <!--<video controls="controls" height="" src="http://mentallica.com/projectone/upload/video/<?php //echo $controller_class->homevideo[0]['image']; ?>">
                                                Your browser does not support the HTML5 Video element.
                                            </video>-->
                                            <img class="header-leftimg img-responsive" src="upload/images/gifeyeandmentallpen.gif">
                                        </div>
                                    </div>
                                    <div class="col-md-5 homevideo-right">
                                        <div class="artists-favorite-text">
                                            <h1>Be the Artists favorite !</h1>
                                            <p>Mentallica is besides a platform for Marriage of the Arts, and a  window to the world to give your project the contacts needed,  a New concept for Art Auctions. Let the Artist himself decide who gets to buy his piece. Or put down your specific project offer and get a dream team.Or simply contact the Artist  for a custom made job.</p>
                                            <p>Put down your Bid together with your location, way you would love to receive the Art work, Payment method and reason for buying.</p>
                                            <p>The Artist will contact you!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
        
                            <!-- /.row -->
        
        
                            <!-- Projects Row -->
                            <div class="row home-cont-row">
                                <?php
                                $modcnt = 0;
                                foreach ($controller_class->homecategorylist as $key => $catdata):
                                    /* $userimages = $controller_class -> getuserbypreviewcategory($catdata['id']);
                                      $userimagesarr = array();
                                      foreach ($userimages as $k => $uimages) {
                                      if($uimages['image'] != ''):
                                      $userimagesarr[] = $uimages['image'];
                                      endif;
                                      }
                                      $usrimgcount = count($userimagesarr);
                                      $userimagesstr = implode(",", $userimagesarr); */
        
                                    $usrimgcount = '5';
                                    $numAreas = array("1", "2", "3", "4", "5");
                                    $settings = $controller_class->getAllSettings();
                                    $userimagesstr="";
                                    //foreach($numAreas as $kk=>$vvv){
                                    for($numAreas=1;$numAreas<=5;$numAreas++){
                                        $randomNumbera = rand(1, 5);                                       
                                        $userimagesstr.= ',default/'.$settings['default_category_'.$randomNumbera];                                       
                                    }
                                    
                                    $userimagesstr=trim($userimagesstr,",");
                                    
                                    $photoAreas = array($settings['default_category_1'], $settings['default_category_2'], $settings['default_category_3'], $settings['default_category_4'], $settings['default_category_5']);
                              
                                    $explode_artist_id = explode(",", $catdata['artist_ids']);
                                    $all_image_artist = '';
                                    unset($all_artist_image);
                                    $varset=0;
                                    for ($i = 0; $i < count($explode_artist_id); $i++) {
                                        $userimages = $controller_class->getuserdetailfromuserid($explode_artist_id[$i]);
                                        if ($explode_artist_id[$i] != '') {
                                            $usercatimages = $controller_class->getusercatimageonhome($catdata['id'],$userimages['id']);
                                            if ($usercatimages['profile_pic'] != '') {
                                                $all_artist_image[] = 'art/'.$usercatimages['profile_pic'];  
                                            }elseif ($userimages['image'] != '' && $usercatimages['profile_pic']=="") {
                                              $all_artist_image[] = 'artist/'.$userimages['image'];  
                                            }else{
                                                $all_artist_image[] = 'artist/default.jpg';
                                            }
                                            
                                        }else{
                                            $randomNumber = rand(0, (count($photoAreas) - 1));
                                            $all_artist_image[] = 'default/'.$photoAreas[$randomNumber];
                                            $varset=1;
                                        }
                                    }
        
                                    $all_image_artist = implode(",", $all_artist_image);
                                    
                                    if ($varset == 0) {
                                        $imgCNT= count($explode_artist_id);;
                                    } else {
                                        $imgCNT=5;
                                    }
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-xs-6">
                                        <div class="homeport-item">
                                            <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "artistlist/" . $catdata['id']; ?>">
                                                <div class="homeport-item-imgbox">
        
                                                    <div class="clearfix rot-cat-usr-imgs homeport-item-img"
                                                         id="cat_<?php echo $catdata['id']; ?>"
                                                         style="background-image: url('<?php echo $_SESSION['SITE_NAME'] . "img/no-profile-picture-icon-620x389.jpg"; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-userimages="<?php
                                                         if ($varset == 0) {
                                                             echo $all_image_artist;
                                                         } else {
                                                             echo $userimagesstr;
                                                         }
                                                         ?>" data-catdiv="<?php echo $catdata['id']; ?>" data-usrimgcnt="<?php echo $imgCNT; ?>">&nbsp;</div>
                                                </div>
                                                <!--<div class="portfolio-item-point">
        
                                                    <?php
        /*                                            $s = 1;
                                                    if (count($explode_artist_id) != 0 && $catdata['artist_ids'] != '') {
                                                        $total_count = count($explode_artist_id);
                                                    } else {
                                                        $total_count = $usrimgcount;
                                                    }
                                                    for ($i = 0; $i < $total_count; $i++) {
                                                        */?>
                                                        <div class="portfolio-item-point<?php /*echo sprintf("%02d", $s); */?>">
                                                            <img src="img/portfolio-item-point.png">
                                                        </div>
                                                        <?php
        /*                                                $s++;
                                                        if ($s == 3) {
                                                            $s = 1;
                                                        }
                                                    }
                                                    */?>
                                                </div>-->
                                                <!--<a class="" href="">
                                                    <img src="<?php echo $_SESSION['SITE_NAME'] . "img/no-profile-picture-icon-620x389.jpg"; ?>" alt="..." class='example-image img-responsive' />
                                                </a>-->
                                                <!--<div class="cleardiv"></div>-->
        
                                            </a>
                                            <h3><?php echo $catdata['categoryName']; ?></h3>
                                        </div>
                                    </div>
                                    <?php
                                    $modcnt++;
                                    if ($modcnt % 4 == 0):
                                        ?></div><div class="row home-cont-row"><?php endif; ?>
                                <?php endforeach; ?> 
        
                            </div>
                            <!-- /.row -->
        
                            <div class="row home-cont-row artlogosection">
                           		<div class="container">
                                <div class="row">
        
                                   <?php
                                   
                                    foreach ($controller_class->homesponserlist as $keys => $spData){?>
                                    <div class="col-md-3 col-sm-4 col-xs-4 center">
                                        <div class="home_page_logo">
                                            <a href="<?=$spData['link']?>" target="_blank"><img class="img-responsive" src="<?php echo $_SESSION['SITE_NAME'] . "upload/sponser/".$spData['image'] ?>" title="<?=$spData['title']?>" alt="img"></a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
        
                                </div>
                          </div>
                            </div>
                            <!--<hr>-->
        
                            <!-- Pagination -->
                            <!--<div class="row text-center">
                                <div class="col-lg-12">
                                    <ul class="pagination">
                                        <li>
                                            <a href="#">«</a>
                                        </li>
                                        <li class="active">
                                            <a href="#">1</a>
                                        </li>
                                        <li>
                                            <a href="#">2</a>
                                        </li>
                                        <li>
                                            <a href="#">3</a>
                                        </li>
                                        <li>
                                            <a href="#">4</a>
                                        </li>
                                        <li>
                                            <a href="#">5</a>
                                        </li>
                                        <li>
                                            <a href="#">»</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>--><!-- /.Pagination -->
        
                            <!--<hr>-->
        
                        </div>
        
        
                        <div class="art-swapping-hands-text-slider">
                            <div class="container">
                            	<div class="row"> <div class="art-swapping-main">Art swapping hands</div> </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="art-swapping-hands-text">
                                            <p>Artists buy credit packages to display and comment their Art work in different ways. They decide if or when their pieces go on Auction and for how long. Clients place their Bids together with details about transport and such .</p>
                                            <p>Bidding itself is regulated. Before being able to do so clients must be registered with the site. Mentallica is a design community dedicated to inovation and quality and designed to be the marriage of the Arts. Artist will be dynamicaly promoted by online marketing, online and realworld worldwide events to give Artists the best possible exposure. (preferred membership) Gold members get a special zoom function on top of 500 uploads a month in all categories. Silver members get 200 uploads/month in one category.</p>
                                            <p>There might be overlapping categories that's why we propose golden memberships for our selected artists. For example in the music section you can find upcoming artists -producers ready to cooperate on your project and/or a download link to their work and booking info. Mentallica is all about connections. </p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="art-swapping-hands-slider">
                                            <div class="">
                                                <?php
                                                $advertiseimagesarr = array();
                                                foreach ($controller_class->homeadvertiselist as $key => $advalue) {
                                                    if ($advalue['image'] != ''):
                                                        $advertiseimagesarr[] = $advalue['image'];
                                                    endif;
                                                }
                                                $advimgcount = count($advertiseimagesarr);
                                                $imadvertiseimagesarr = implode(",", $advertiseimagesarr);
                                                //echo '<pre/>'; print_r($advertiseimagesarr); die;
                                                ?>
                                                <div class="col-xs-12 clearfix rot-cat-adv-imgs"  style="min-height: 300px; background-image: url('<?php echo $_SESSION['SITE_NAME'] . "img/no-profile-picture-icon-620x389.jpg"; ?>'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" data-advimages="<?php echo $imadvertiseimagesarr; ?>" data-advdiv="<?php echo $advalue['id']; ?>" data-advimgcnt="<?php echo $advimgcount; ?>">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
        
        
        
                    
                
            </div>

    		<?php include('footernew.php'); ?>
		</div>
     </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            var catarr = [];
            $(".rot-cat-usr-imgs").each(function () {
                var catval = $(this).data("catdiv");
                var imgcnt = $(this).data("usrimgcnt");
                var curele = $(this);
                //alert(catval);
                catarr.push({catid: catval, imgindx: 0, totimgs: imgcnt, curelt: curele});

            });

            (function loop() {
                var rand = Math.round(Math.random() * (9000 - 100)) + 20;
                setTimeout(function() {
                        catarr = rotateuserimgs(catarr)
                        loop();  
                }, rand);
            }());
            
            var advarr = [];
            $(".rot-cat-adv-imgs").each(function () {
                var advdiv = $(this).data("advdiv");
                var advimgcnt = $(this).data("advimgcnt");
                var adcurele = $(this);
                advarr.push({catid: advdiv, imgindx: 0, totimgs: advimgcnt, curelt: adcurele});
            });

            var intervalId = setInterval(function () {
                advarr = rotateadvimgs(advarr);
            }, 3000);
        });

        function rotateadvimgs(catarr) {
            var newcatarr = new Array();
            var aabbcc = "aabbcc";
            catarr.forEach(function (entry) {
                // alert(entry.catid);    
                if (parseInt(entry.totimgs) > 0) {
                    //var getcatdiv = $("div").find("[data-catdiv='" + entry.catid + "']");
                    var getcatdiv = entry.curelt;
                    var userimglstbycat = getcatdiv.data("advimages");
                    var curimgtoshow = userimglstbycat.split(",");

                    var curcatimg = site_url + "upload/advertisement/" + curimgtoshow[entry.imgindx];

                    /*$.ajax({
                     url: site_url + 'controllers/ajax_controller/common-ajax-controller.php',
                     type: 'post',
                     data: 'getBrandFromCategory=1&catid=' + catid,
                     success: function (result)
                     {
                     var curcatimg = site_url + "upload/advertisement/" + curimgtoshow[entry.imgindx];
                     $("#section_sidebarpart").html(result);
                     getcatdiv.css("background-image","url('"+curcatimg+"')")
                     }
                     });*/
                    getcatdiv.css("background-image", "url('" + curcatimg + "')");
                }
                entry.imgindx = entry.imgindx + 1 >= entry.totimgs ? 0 : entry.imgindx + 1;
                newcatarr.push(entry);
            });
            return newcatarr;
        }


        function rotateuserimgs(catarr) {
            var newcatarr = new Array();
            var aabbcc = "aabbcc";
            catarr.forEach(function (entry) {

                if (parseInt(entry.totimgs) > 0) {
                    //var getcatdiv = $("div").find("[data-catdiv='" + entry.catid + "']");
                    var getcatdiv = entry.curelt;
                    var userimglstbycat = getcatdiv.data("userimages");
                    
                    
                    var curimgtoshow = userimglstbycat.split(",");
                    var curcatimg = site_url + "upload/" + curimgtoshow[entry.imgindx];
                    getcatdiv.css("background-image", "url('" + curcatimg + "')");
                }
                entry.imgindx = entry.imgindx + 1 >= entry.totimgs ? 0 : entry.imgindx + 1;
                newcatarr.push(entry);
            });

            return newcatarr;
        }
    </script>
</body>