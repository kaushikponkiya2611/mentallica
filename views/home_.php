<style>
    .homeport-item-img{
        padding: 0 !important;
        text-align:  center;
    }
</style>
<script type="text/javascript" src="<?=$_SESSION['APP_PATH']?>rotator/functions.js"></script>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->

    <div class="container">
        <div class="row blue-border-main">
            <div class=''>

                <?php require_once($_SESSION['APP_PATH'] . "views/header.php"); ?>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <div class="container">                            
                        <div class="row">
                            <div class="banner-and-text homevideo-bg">
                                <div class="col-md-6">
                                    <div class="rot-cat-banner-imgs">
                                        <video controls="controls" height="" src="http://mentallica.com/projectone/upload/video/<?php echo $controller_class->homevideo[0]['image']; ?>">
                                            Your browser does not support the HTML5 Video element.
                                        </video>
                                    </div>
                                </div>
                                <div class="col-md-6 homevideo-right">
                                    <div class="artists-favorite-text">
                                        <h1>Be the Artists favorite !</h1>
                                        <p>Mentallica is besides a platform for Marriage of the Arts, and a  window to the world to give your project the contacts needed,  a New concept for Art Auctions. Let the Artist himself decide who gets to buy his piece. Or put down your specific project offer and get a dream team.<br> Or simply contact the Artist  for a custom made job.</p>
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

                                $usrimgcount = '5';
                                $numAreas = array("1", "2", "3", "4", "5");
                                $settings = $controller_class->getAllSettings();
                                $userimagesstr = "";
                                //foreach($numAreas as $kk=>$vvv){
                                for ($numAreas = 1; $numAreas <= 5; $numAreas++) {
                                    $randomNumbera = rand(1, 5);
                                    $userimagesstr .= ',"default/' . $settings['default_category_' . $randomNumbera].'"';
                                }

                                $userimagesstr = trim($userimagesstr, ",");
                                
                                $userimagesstr_fimg = explode(",", $userimagesstr);

                                $photoAreas = array($settings['default_category_1'], $settings['default_category_2'], $settings['default_category_3'], $settings['default_category_4'], $settings['default_category_5']);

                                $explode_artist_id = explode(",", $catdata['artist_ids']);
                                $all_image_artist = '';
                                unset($all_artist_image);
                                $varset = 0;
                                for ($i = 0; $i < count($explode_artist_id); $i++) {
                                    $userimages = $controller_class->getuserdetailfromuserid($explode_artist_id[$i]);
                                    if ($explode_artist_id[$i] != '') {
                                        $usercatimages = $controller_class->getusercatimageonhome($catdata['id'], $userimages['id']);
                                        if ($usercatimages['profile_pic'] != '') {
                                            $all_artist_image[] = '"art/' . $usercatimages['profile_pic'].'"';
                                        } elseif ($userimages['image'] != '' && $usercatimages['profile_pic'] == "") {
                                            $all_artist_image[] = '"artist/' . $userimages['image'].'"';
                                        } else {
                                            $all_artist_image[] = '"artist/default.jpg'.'"';
                                        }
                                    } else {
                                        $randomNumber = rand(0, (count($photoAreas) - 1));
                                        $all_artist_image[] = '"default/' . $photoAreas[$randomNumber].'"';
                                        $varset = 1;
                                    }
                                }

                                $all_image_artist = implode(",", $all_artist_image);

                                if ($varset == 0) {
                                    $imgCNT = count($explode_artist_id);
                                } else {
                                    $imgCNT = 5;
                                }
                                ?>
                                <div class="col-lg-3 col-md-3 col-xs-6">
                                    <div class="homeport-item">
                                        <a href="<?php echo $_SESSION['FRNT_DOMAIN_NAME'] . "artistlist/" . $catdata['id']; ?>">
                                            <div class="homeport-item-imgbox">
                                                <div class="clearfix rot-cat-usr-imgs homeport-item-img">
                                                    <?php
                                                    if ($varset == 0) {
                                                        ?><img id="myImage_<?=$catdata['id']?>" src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/<?=str_replace('"','',$all_artist_image[0])?>" alt="image test" style="max-width: 100%;max-height: 190px;" /><?php
                                                    }else{
                                                        ?><img id="myImage_<?=$catdata['id']?>" src="<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/<?=str_replace('"','',$userimagesstr_fimg[0])?>" alt="image test" style="max-width: 100%;max-height: 190px;" /><?php
                                                    }
                                                    ?>
                                                    
                                                </div>                                                
                                            </div>                                              

                                        </a>
                                        <h3><?php echo $catdata['categoryName']; ?></h3>
                                    </div>
                                </div>
                                <script>
                                    //var images = new Array ('../upload/default/140817151116slide1.jpg','../upload/default/140817151116slide2.jpg','../upload/default/140817151116slide3.jpg','../upload/default/140817151116slide4.jpg','../upload/default/140817151116slide5.jpg');
                                    <?php
                                    if ($varset == 0) {                                        
                                        ?>var images_<?=$catdata['id']?> = new Array (<?=$all_image_artist?>);<?php
                                    } else {
                                        ?>var images_<?=$catdata['id']?> = new Array (<?=$userimagesstr?>);<?php
                                    }
                                    ?>
                                    
                                    var index_<?=$catdata['id']?> = 1;

                                    function rotateImage_<?=$catdata['id']?>()
                                    {
                                      $('#myImage_<?=$catdata['id']?>').fadeOut('slow', function()
                                      {
                                        $(this).attr('src', '<?=$_SESSION['FRNT_DOMAIN_NAME']?>upload/'+images_<?=$catdata['id']?>[index_<?=$catdata['id']?>]);

                                        $(this).fadeIn('slow', function()
                                        {
                                          if (index_<?=$catdata['id']?> == images_<?=$catdata['id']?>.length-1)
                                          {
                                            index_<?=$catdata['id']?> = 0;
                                          }
                                          else
                                          {
                                            index_<?=$catdata['id']?>++;
                                          }
                                        });
                                      });
                                    }
                                    
                                    function myfunc_cat<?=$catdata['id']?>(){
                                        if(images_<?=$catdata['id']?>.length>1){
                                            setInterval (rotateImage_<?=$catdata['id']?>, 5000);
                                        }
                                    }
                                </script>
                                <?php
                                $modcnt++;
                                if ($modcnt % 4 == 0):
                                    ?></div><div class="row home-cont-row"><?php endif; ?>
                            <?php endforeach; ?> 
                            <script>
                            $(document).ready(function()
                            {                                
                            <?php
                            $array=array();
                            for($i=1000;$i<10000;$i+=300)
                            {
                                $array[$i]=$i;
                            }


                            foreach($controller_class->homecategorylist as $k => $cat){
                                //$array = array('1000', '1200', '1400', '1600', '1800', '2000', '2200', '2400', '2600', '2800', '3000', '3200', '3400', '3600');                                
                                ?>                                
                                setTimeout(myfunc_cat<?=$cat['id']?>, <?=$array[array_rand($array, 1)]?>);                                
                                <?php
                            }
                            ?>
                            });
                            </script>
                        </div>
                        <!-- /.row -->
                        <div class="row home-cont-row artlogosection">
                            <div class="container">
                                <div class="row">
                                    <?php foreach ($controller_class->homesponserlist as $keys => $spData) { ?>
                                        <div class="col-md-3 col-sm-4 col-xs-4 center">
                                            <div class="home_page_logo">
                                                <a href="<?= $spData['link'] ?>" target="_blank"><img class="img-responsive" src="<?php echo $_SESSION['SITE_NAME'] . "upload/sponser/" . $spData['image'] ?>" title="<?= $spData['title'] ?>" alt="img"></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>                            
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
                setTimeout(function () {
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