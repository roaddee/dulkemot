<?php 
$this->load->view('pubs/header');
?>
			<!-- section start -->
			<!-- ================ -->
			<section class="clearfix">
				<div class="container">
					
					<div class="row">
						
						<div class="col-md-8 col-sm-12 col-xs-12">
							<div class="section">
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
							</div>

						</div>
						
						<div class="col-md-4 col-sm-12 col-xs-12 bg-blue-lang">
							<div class="">
								<?php 
								$desc = (strlen($about['post_excerpt']) > 0) ? $about['post_excerpt'] : substr($about['post_content'],0,strpos($about['post_content']," ","300"));
								?>
								<h2><a href="<?php echo site_url('publik/laman/'.$about['post_name']);?>" class="logo-font"><?php echo $about['post_title'];?></a></h2>
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
							
							<h3><?php echo $pageTitle;?> <span class="text-default"></span></h3>
							<div class="separator-2"></div>
								<?php

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
<?php 
$this->load->view('pubs/footer');

/*
 * 

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

        });
    </script>
</div>

<!---SLIDER -->

 * */
            /*responsive code end*/
            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
