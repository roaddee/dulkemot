<?php
/*
 * Warna : 
 * 
 * header : #299ed5
 * background : #eadd00
 * biru kanan atas : #ecf4f8
 * biru kanan : #d3e1e9
 * bg-text : #f5f5f5
 * biru bawah : #299ed5
 * merah : f16349
 * 
 * */

?>

<!-- APBD Theme - Isnu Suntoro <isnusun@gmail.com> /-->
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="Flatfy Free Flat and Responsive HTML5 Template ">
	<meta name="author" content="">

	<title><?php echo $pageTitle; ?> :: <?php echo APP_TITLE; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/'); ?>favicon.ico" />


 
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<!-- Dropdown Menu CSS file -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-submenu/css/bootstrap-submenu.min.css'); ?>"> 
	<!-- Custom CSS -->
	<link href="<?php echo base_url()?>assets/css/publik.css" rel="stylesheet" type="text/css">
	<!-- Custom Fonts -->
	<link href="<?php echo base_url()?>assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway|Roboto|Roboto+Condensed:700" rel="stylesheet">

	<!-- Owl Carousel CSS file -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/'); ?>owl-carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/'); ?>owl-carousel/assets/owl.theme.default.min.css">
	
	<!-- jQuery -->
	<script src="<?php echo base_url('assets/plugins/jQuery/jQuery.min.js') ?>"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/plugins/pace/pace.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/modernizr-2.8.3.min.js'); ?>"></script>  <!-- Modernizr /-->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if IE 9]>
		<link rel="stylesheet" href="<?php echo base_url('assets/js/PIE_IE9.js'); ?>"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo base_url('assets/js/PIE_IE678.js'); ?>"></script>
	<![endif]-->

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
	<![endif]-->


	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/img/'); ?>apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/img/'); ?>apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/img/'); ?>apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/'); ?>apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/img/'); ?>apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/img/'); ?>apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/img/'); ?>apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/img/'); ?>apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/img/'); ?>apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('assets/img/'); ?>android-icon-192x192.png">
	<link rel="manifest" href="<?php echo base_url('assets/img/'); ?>manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/'); ?>favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets/img/'); ?>apple-icon-144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets/img/'); ?>apple-icon-144x144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('assets/img/'); ?>apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('assets/img/'); ?>apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/img/'); ?>apple-touch-icon-57-precomposed.png">
	
</head>
<body>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
			<!-- header-container start -->
			<div class="header-container" id="header">

				<div class="header-top colored bg-blue">
					<div class="container">
						<div class="row">
							<div class="col-xs-4 col-sm-6">
								<!-- header-top-first start -->
								<!-- ================ -->
								<div class="header-top-first clearfix">
									<ul class="list-inline visible-lg">
										<?php
										if($info['alamat_kantor']){
											if(($info['lat']) && ($info['lng'])){
												echo "<li><a href=\"https://www.google.co.id/maps/@".$info["lat"].",".$info["lng"].",".$info["zoom"]."z?hl=en&hl=en\" target=\"_blank\"><i class=\"fa fa-map-marker pr-5 pl-10\"></i>".$info['alamat_kantor']."</a></li>";
											}else{
												echo "<li><i class=\"fa fa-map-marker pr-5 pl-10\"></i>".$info['alamat_kantor']."</li>";
											}
										}
										
										?>
									</ul>
									<div class="list-inline hidden-lg hidden-md hidden-sm">

										<div class="btn-group dropdown">
											<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
											<ul class="dropdown-menu dropdown-animation">
												<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo current_url(); ?>&p[title]=<?php echo $pageTitle; ?>"><i class="fa fa-facebook"></i></a></li>
												<li class="twitter"><a target="_blank" href="https://twitter.com/share?text=<?php echo $pageTitle; ?>&url=<?php echo current_url(); ?>"><i class="fa fa-twitter"></i></a></li>
												<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo current_url(); ?>&title=<?php echo $pageTitle; ?>&summary=<?php echo $page['desc']; ?>&source=<?php echo $_SERVER['HTTP_HOST']; ?>"><i class="fa fa-linkedin"></i></a></li>
												<li class="pinterest"><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo current_url(); ?>&description=<?php echo $pageTitle; ?>"><i class="fa fa-pinterest"></i></a></li>
												<li class="googleplus"><a target="_blank" href="https://plus.google.com/share?url=<?php echo current_url(); ?>"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>

									</div>
								</div>
								<!-- header-top-first end -->
							</div>
							<div class="col-xs-8 col-sm-6">

								<!-- header-top-second start -->
								<!-- ================ -->
								<div id="header-top-second"  class="clearfix text-right">
									<ul class="list-inline">
										<?php
										if($info['telp']){
											echo "<li><i class=\"fa fa-phone pr-5 pl-10\"></i>".$info['telp']."</li>";
										}
										if($info['email']){
											echo "<li><i class=\"fa fa-envelope-o pr-5 pl-10\"></i>".$info['email']."</li>";
										}
										?>
									</ul>
								</div>
								<!-- header-top-second end -->
							</div>
							
						</div><!--/row-->
					</div><!--/container-->
				</div>
				<!-- header-top end -->
				
				<!-- header start -->
				<header class="header fixed clearfix bg-white">
					<div class="container">
						<div class="row">
							<div class="col-md-4 ">
								<!-- header-left start -->
								<!-- ================ -->
								<div class="header-left clearfix">
									
									<div class="row">
										<div class="col-md-3">
											<div id="logo" class="logo">
												<a href="<?php echo site_url("beranda"); ?>">
													<img src="<?php echo base_url(); ?>assets/img/logo.png" alt="<?php echo APP_TITLE;?>" />
												</a>
											</div>
										</div>
										<div class="col-md-9">
												<h1 class="hidden-xs" style="font-size:1.5em;line-height:1.2em;margin:0;padding:0;"><?php echo APP_TITLE; ?></h1>
												<h2 style="font-size:1em;line-height:1.2em;margin:0;padding:0;" class="hidden-xs"></h2>
										</div>
									</div>
								</div>
								<!-- header-left end -->
							</div>
							<div class="col-md-8">
								<!-- header-right start -->
								<!-- ================ -->
								<div class="header-right clearfix">
									<div class="main-navigation  animated with-dropdown-buttons">
										<!-- navbar start -->
										<!-- ================ -->
										<nav class="navbar navbar-default" role="navigation">
											<div class="container-fluid">

												<!-- Toggle get grouped for better mobile display -->
												<div class="navbar-header">
													<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
														<span class="sr-only">Toggle navigation</span>
														<span class="icon-bar"></span>
														<span class="icon-bar"></span>
														<span class="icon-bar"></span>
													</button>
													
												</div>

												<!-- Collect the nav links, forms, and other content for toggling -->
												<div class="collapse navbar-collapse" id="navbar-collapse-1">
													<!-- main-menu -->
													<ul class="nav navbar-nav navbar-right">
														
													<!-- main-menu -->
														
														<li><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> Beranda</a></li>
														<li class="dropdown" ><a href="<?php echo site_url('pemda'); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-institution"></i> Pemerintahan Daerah <i class="fa fa-chevron-down"></i></a>
															<ul class="dropdown-menu">
																<li><a href="<?php echo site_url('apbd/pemda/34'); ?>">Propinsi Daerah Istimewa Yogyakarta</a></li>
																<li><a href="<?php echo site_url('apbd/pemda/3401'); ?>">Kab. Kulonprogo</a></li>
																<li><a href="<?php echo site_url('apbd/pemda/3402'); ?>">Kab. Bantul</a></li>
																<li><a href="<?php echo site_url('apbd/pemda/3403'); ?>">Kab. Gunungkidul</a></li>
																<li><a href="<?php echo site_url('apbd/pemda/3404'); ?>">Kab. Sleman</a></li>
																<li><a href="<?php echo site_url('apbd/pemda/3471'); ?>">Kota Yogyakarta	</a></li>
															</ul>
														</li>
														<li><a href="<?php echo site_url('apbd/analisis'); ?>"><i class="fa fa-comments"></i> Analisis</a></li>
														<li><a href="<?php echo site_url('apbd/data'); ?>"><i class="fa fa-search"></i> Query Data</a></li>
														

													</ul>
													<!-- /main-menu -->
												</div>
												<!-- /.navbar-collapse -->
												
											</div>
										</nav>		
									</div>
								</div>
								<!-- /header-right start -->
							</div>
						</div>
					</div>
        </header>

        <!-- /.container -->
			</div>


			<div id="page-start"></div>

			<!-- section start -->
			<!-- ================ -->
			<section class="clearfix">
				<div class="container">
					
					<div class="row">
						
						<div class="col-md-8 col-sm-12 col-xs-12">
<div class="clearfix">
<!---SLIDER -->
    <div class="visible-lg" id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:750px;height:300px;overflow:hidden;visibility:hidden;background-color:#000000;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('<?php echo base_url('assets/img/'); ?>img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
            <div>
                <img data-u="image" src="<?php echo base_url('assets/img/'); ?>img/002.jpg" />
                <div data-u="thumb">
                    <img class="i" src="<?php echo base_url('assets/img/'); ?>img/002-s60x30.jpg" />
                    <div class="t">Banner Rotator</div>
                    <div class="c">360+ touch swipe slideshow effects</div>
                </div>
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url('assets/img/'); ?>img/003.jpg" />
                <div data-u="thumb">
                    <img class="i" src="<?php echo base_url('assets/img/'); ?>img/003-s60x30.jpg" />
                    <div class="t">Image Gallery</div>
                    <div class="c">Image gallery with thumbnail navigation</div>
                </div>
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url('assets/img/'); ?>img/004.jpg" />
                <div data-u="thumb">
                    <img class="i" src="<?php echo base_url('assets/img/'); ?>img/004-s60x30.jpg" />
                    <div class="t">Carousel</div>
                    <div class="c">Touch swipe, mobile device optimized</div>
                </div>
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url('assets/img/'); ?>img/005.jpg" />
                <div data-u="thumb">
                    <img class="i" src="<?php echo base_url('assets/img/'); ?>img/005-s60x30.jpg" />
                    <div class="t">Themes</div>
                    <div class="c">30+ professional themems + growing</div>
                </div>
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url('assets/img/'); ?>img/006.jpg" />
                <div data-u="thumb">
                    <img class="i" src="<?php echo base_url('assets/img/'); ?>img/006-s60x30.jpg" />
                    <div class="t">Tab Slider</div>
                    <div class="c">Tab slider with auto play options</div>
                </div>
            </div>
            <a data-u="any" href="https://wordpress.org/plugins/jssor-slider/" style="display:none">wordpress slideshow</a>
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort11" style="position:absolute;right:5px;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;width:200px;height:300px;" data-autocenter="2">
            <!-- Thumbnail Item Skin Begin -->
            <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                    <div data-u="thumbnailtemplate" class="tp"></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora02r" style="top:0px;right:218px;width:55px;height:55px;" data-autocenter="2"></span>
    </div>
    <!-- #endregion Jssor Slider End -->

    <!-- #endregion Jssor Slider End -->

    <script src="<?php echo base_url('assets/plugins/jssor/');?>jssor.slider-24.1.5.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
              $AutoPlay: 1,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 4,
                $SpacingX: 4,
                $SpacingY: 4,
                $Orientation: 2,
                $Align: 0,
                $Loop: 0
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 810);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*responsive code end*/

        });
    </script>
</div>

<!---SLIDER -->
						</div>
						
						<div class="col-md-4 col-sm-12 col-xs-12 bg-blue-lang">
							<div class="">
								<?php 
								$desc = (strlen($about['post_excerpt']) > 0) ? $about['post_excerpt'] : substr($about['post_content'],0,strpos($about['post_content']," ","300"));
								?>
								<h2 class="logo-font"><?php echo $about['post_title'];?></h2>
								<div><?php echo $desc;?>
								<a href="<?php echo site_url('publik/laman/'.$about['post_name']);?>">...selengkapnya</a></div>
							</div>
						</div>
					</div>
					
			</div>
			<!-- section start -->
			<!-- ================ -->
			<section class="clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class=" section"></div>
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
									<h3 class="box-title text-white">Pemerintahan Daerah</h3>
								</div>
								<div class="box-body text-center">
									<div class="row">
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/34'); ?>"><img src="<?php echo base_url('assets/img/34.jpg'); ?>" class="img-rounded" />Prop. D I Yogyakarta</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3401'); ?>"><img src="<?php echo base_url('assets/img/3401.jpg'); ?>" class="img-rounded" />Kab. Kulonprogo</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3402'); ?>"><img src="<?php echo base_url('assets/img/3402.jpg'); ?>" class="img-rounded" />Kab. Bantul</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3403'); ?>"><img src="<?php echo base_url('assets/img/3403.jpg'); ?>" class="img-rounded" />Kab. Gunungkidul</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3404'); ?>"><img src="<?php echo base_url('assets/img/3404.jpg'); ?>" class="img-rounded" />Kab. Sleman</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3471'); ?>"><img src="<?php echo base_url('assets/img/3471.jpg'); ?>" class="img-rounded" />Kota Yogyakarta	</a>
										</div>
									</div>
								</div>
							</div>

							<h3><?php echo $pageTitle;?> <span class="text-default"></span></h3>
							<div class="separator-2"></div>
								<?php
/*
							if(count($posts) > 0){
								echo "
								<div class=\"blog\">
								";
								foreach($posts as $item){
									$sampul = (strlen($item["post_cover"]) > 0)? base_url()."assets/uploads/".$item["post_cover"] : "";
									$teks = fixTag($item["post_content"]);
									if(strlen($teks)>310){
										$abstrak = substr($teks,0,strpos($teks," ",300));
									}else{
										$abstrak = $teks;
									}
									$post_url = site_url("publik/baca/".$item["ID"]."/").$item["post_name"];
									
									
									if($sampul != ""){
										echo "
										<div class=\"blog-item\">
											<div class=\"row\">
												<div class=\"col-xs-12 col-sm-4	\">
													<div class=\"post-date\">".indonesian_date(strtotime($item["post_date"]),"j F y","")."</div>
													<div class=\"overlay-container overlay-visible\">
													<img class=\"img-responsive\" src=\"".$sampul."\" width=\"100%\" alt=\"\" />
														<a href=\"".$post_url."\" class=\"overlay-link\">
															<i class=\"fa fa-link\"></i>
														</a>
													</div>
												</div>
														
												<div class=\"col-xs-12 col-sm-8 blog-content\">
													<h2><a href=\"".$post_url."\">".$item["post_title"]."</a></h2>
													<div>".$abstrak."... <a href=\"".$post_url."\"><em>selengkapnya</em> <i class=\"fa fa-angle-double-right\"></i></a></div>
													<ul class=\"post-meta\">
														<li><a href=\"#\"><i class=\"fa fa-user\"></i> ".$item["unama"]."</a></li>
														<li><a href=\"".$post_url."#comments\"><i class=\"fa fa-comment\"></i> ".$item["comment_count"]." Comments</a></li>
														<li><i class=\"fa fa-heart fa-fw\"></i><a href=\"#\" class=\"suka\" id=\"suka_".$item["ID"]."\"><strong>".$item["post_like"]."</strong> Suka</a></li>
													</ul>
												</div>
											</div>    
										</div><!--/.blog-item-->
										";

									}else{
										echo "
										<div class=\"blog-item\">
											<div class=\"row\">
												<div class=\"col-xs-12 col-sm-4\">
													<div class=\"entry-meta\">
														<span id=\"publish_date\">".indonesian_date(strtotime($item["post_date"]),"j F","")."</span>
														<span><a href=\"#\"><i class=\"fa fa-user\"></i> ".$item["unama"]."</a></span>
														<span><a href=\"".$post_url."#comments\"><i class=\"fa fa-comment\"></i> ".$item["comment_count"]." Comments</a></span>
														<span><i class=\"fa fa-heart fa-fw\"></i><a href=\"#\" class=\"suka\" id=\"suka_".$item["ID"]."\"><strong>".$item["post_like"]."</strong> Suka</a></span>
													</div>
												</div>
												<div class=\"col-xs-12 col-sm-8 blog-content\">
													<h2><a href=\"".$post_url."\">".$item["post_title"]."</a></h2>
													<h3>".$abstrak."... <a href=\"".$post_url."\"><em>selengkapnya</em> <i class=\"fa fa-angle-double-right\"></i></a></h3>
													
												</div>
											</div>    
										</div><!--/.blog-item-->
										";
										
									}
									
								}
								echo "
								</div>";								
							}
*/							
								?>
						</div>
						<div class="col-md-4 bg-blue-sky">
							<div class=" bg-blue-sky widget">
								<aside id="wg_embed" class="widget ">
									<div class="title-section clearfix">
										<h4 class="lead-title"><i class="fa fa-paste"></i> Tempelkan di Web lain</h4>
										<div class="white-line uk-clearfix"></div>
									</div>
									<div>
										<p style="color:#444">Gunakan skrip berikut ini untuk memasang tautan dari situs web anda ke halaman ini:</p>
										<div  style="height:100px;width:100%;overflow:auto;background:#f5f5f5;color:" onclick="selectText('selectable')" id="selectable">
										<code>
											&lt;div style="border:solid 1px #ccc;border-radius:.5em;-webkit-box-shadow: 5px 6px 8px 0px #d8d8d8;box-shadow: 5px 6px 8px 0px #d8d8d8;background:#fff;color:#888;padding:1em;"&gt;&lt;a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"&gt;&lt;img src="<?php echo base_url('/assets/img/oda-l.png');?>" alt="Open Data APBD" style="width:100%;margin:0;padding:0;margin-bottom:1em;"/&gt;&lt;span style="margin:0;padding:0;font-size:1.6em;font-weight:600;color:#888;line-height:1em;"&gt;Open Data APB <?php echo $pageTitle; ?>&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;
										</code>
										</div>
										<br />pratayang:

											<div style="border:solid 1px #ccc;border-radius:.5em;-webkit-box-shadow: 5px 6px 8px 0px #d8d8d8;box-shadow: 5px 6px 8px 0px #d8d8d8;background:#fff;color:#888;padding:1em;"><a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank">
											<img src="<?php echo base_url('/assets/img/oda-l.png');?>" alt="Open Data APBD" style="width:100%;margin:0;padding:0;margin-bottom:1em;"/>
											<span style="margin:0;padding:0;font-weight:600;color:#888;line-height:1em;"><?php echo APP_TITLE;?></span></a></div>

											<script type="text/javascript">
													function selectText(containerid) {
															if (document.selection) {
																	var range = document.body.createTextRange();
																	range.moveToElementText(document.getElementById(containerid));
																	range.select();
															} else if (window.getSelection) {
																	var range = document.createRange();
																	range.selectNode(document.getElementById(containerid));
																	window.getSelection().addRange(range);
															}
													}
											</script>															
										
									</div>
								</aside>	
								
								
								
							</div>
							
							
						</div>
					</div>
				</div>
			</section>
			<!-- section end -->

			<!-- footer top start -->
			<!-- ================ -->
			<div class="pv-40 footer-top" style="padding-bottom:0;margin-bottom:0;">

			<!-- footer start (Add "dark" class to #footer in order to enable dark footer) -->
			<!-- ================ -->
			<footer id="footer" class="clearfix">
				<!-- .subfooter start -->
				<!-- ================ -->
				<div class="subfooter">
					<div class="container">
						<div class="subfooter-inner">
							<div class="row">
								<div class="col-md-6">
									<p class="txt-sm">
										<a target="_blank" href="<?php echo site_url("siteman"); ?>">Klik disini untuk masuk dan beraktivitas dalam ruang tertutup login </a>
										<br />&copy; 2016 Perkumpulan IDEA Yogyakarta. Hakcipta dilindungi oleh Undang-undang.
									</p>
								</div>
								<div class="col-md-6">
									<p class="txt-sm text-right">
											<ul class="social-links pull-right">
												<?php 
												if(array_key_exists("twitter",$info)){
													echo "<li class=\"twitter\"><a target=\"_blank\" href=\"".$info['twitter']."\"><i class=\"fa fa-twitter\"></i></a></li>";
												}
												if(array_key_exists("facebook",$info)){
													echo "<li class=\"facebook\"><a target=\"_blank\" href=\"".$info['facebook']."\"><i class=\"fa fa-facebook\"></i></a></li>";
												}
												if(array_key_exists("instagram",$info)){
													echo "<li class=\"instagram\"><a target=\"_blank\" href=\"".$info['instagram']."\"><i class=\"fa fa-instagram\"></i></a></li>";
												}
												?>
											</ul>
									</p>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .subfooter end -->

			</footer>
			<!-- footer end -->
		<!-- Scroll-up -->
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/scrolltotop/css/scrollToTop.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/rs-plugin/css/settings.css'); ?>" media="screen" />

		<div class="scrollToTop circle"><i class="fa fa-angle-up"></i></div>

		<script src="<?php echo base_url("assets/plugins/bootstrap-submenu/");?>js/bootstrap-submenu.min.js" defer></script>
		<script src="<?php echo base_url('assets/js/autoNumeric-min.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/js/jquery.magnific-popup.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/js/jquery.counterup.min.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/js/masonry.pkgd.min.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/js/jquery.parallax.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/js/jquery.fitvids.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/plugins/scrolltotop/jquery-scrollToTop.min.js'); ?>" defer></script>
		<script src="<?php echo base_url('assets/js/scripts.js'); ?>" defer></script>
		
		<script>
			$(document).ready(function(){
				$('[data-submenu]').submenupicker();
				$('body').scrollToTop({
					skin: 'cycle'
				});
			});
		</script>

		<!--Facebook -->
		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
				FB.init({
					appId      : '577542629096084',
					xfbml      : true,
					version    : 'v2.7'
				});
			};

			(function(d, s, id){
				 var js, fjs = d.getElementsByTagName(s)[0];
				 if (d.getElementById(id)) {return;}
				 js = d.createElement(s); js.id = id;
				 js.src = "//connect.facebook.net/en_US/sdk.js";
				 fjs.parentNode.insertBefore(js, fjs);
			 }(document, 'script', 'facebook-jssdk'));
		</script>	
		<!--LinkedIn-->
		<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: in_ID</script>
		<!--Twitter-->
		<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

		<!--Google Analitic-->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-35956217-12', 'auto');
			ga('send', 'pageview');

		</script>			
		<!--GoogleFont
		<script type="text/javascript">
			WebFontConfig = {
				google: { families: [ 'Roboto::latin', 'Raleway::latin', 'Oswald::sans-serif','Open+Sans' ] }
			};
			(function() {
				var wf = document.createElement('script');
				wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})(); 
		</script>		
		-->

		<!-- JavaScript files placed at the end of the document so the pages load faster -->
		<!-- ================================================== -->
		<script type="text/javascript">
			var suka = $("a.suka");
			if(suka){
				$("a.suka").click(function(){
					event.preventDefault();
					var t = $(this).find("strong");
					var idnya = $(this).attr("id");var urlnya = "<?php echo site_url("sapi/suka/")?>"+idnya;
					$.ajax({url: urlnya, success: function(result){
						t.html(result);
					}	
					});
				});
			}
			
		</script>
		
	</Body>
</html>			
