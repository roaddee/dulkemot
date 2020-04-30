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
				 js.src = "//connect.facebook.net/id_ID/sdk.js";
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
