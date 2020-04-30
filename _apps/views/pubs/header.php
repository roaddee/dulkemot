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
	<meta name="description" content="Open Data APBD Daerah Istimewa Yogyakarta, meliputi satu propinsi, empat kabupaten dan satu kota. Beserta detail per OPD dan Rangkuman per pemerintah daerah">
	<meta name="author" content="">

	<title><?php echo $page['title']; ?> :: <?php echo APP_TITLE; ?></title>
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
												<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo current_url(); ?>&p[title]=<?php echo $page['title']; ?>"><i class="fa fa-facebook"></i></a></li>
												<li class="twitter"><a target="_blank" href="https://twitter.com/share?text=<?php echo $page['title']; ?>&url=<?php echo current_url(); ?>"><i class="fa fa-twitter"></i></a></li>
												<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo current_url(); ?>&title=<?php echo $page['title']; ?>&summary=<?php echo $page['desc']; ?>&source=<?php echo $_SERVER['HTTP_HOST']; ?>"><i class="fa fa-linkedin"></i></a></li>
												<li class="pinterest"><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo current_url(); ?>&description=<?php echo $page['title']; ?>"><i class="fa fa-pinterest"></i></a></li>
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
