<?php 
$this->load->view('pubs/header');
?>
			<!-- section start -->
			<!-- ================ -->
			<section class="clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class="blog section">
								<?php
								if($post){
									$url = current_url();
									echo "
									<h1 class=\"text-bluesky page-title\">".$post['post_title']."</h1>
									<div class=\"separator-2\"></div>
									<div class=\"blog-content\">".$post['post_content']."</div>
									
									<div class=\"separator-2\"></div>
									<div class=\"entry-meta\">
										<span><i class=\"fa fa-comment fa-fw\"></i><a href=\"".$url."#comments\">0 Komentar</a></span>
										<span><i class=\"fa fa-heart fa-fw\"></i><a href=\"#\" class=\"suka\" id=\"suka_12\"><strong>".$post['post_like']."</strong> Suka</a></span>
										<span><i class=\"fa fa-check-square-o fa-fw\"></i><a href=\"#\">".$post['post_klik']." Klik</a></span>
										<span><i class=\"fa fa-facebook fa-fw\"></i><a target=\"_blank\" href=\"https://www.facebook.com/sharer/sharer.php?u=".urlencode($url)."\">bagikan</a></span>
										<span><i class=\"fa fa-twitter fa-fw\"></i><a target=\"_blank\" href=\"https://www.twitter.com/share?url=".urlencode($url)."\">Cuitkan</a></span>
										<span><i class=\"fa fa-linkedin fa-fw\"></i><a target=\"_blank\" href=\"https://www.linkedin.com/cws/share?url=".urlencode($url)."\">bagikan</a></span>
									</div>
									<div class=\"separator-2\"></div>
									";
								}
								
								?>
							</div>
							
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
						<div class="col-md-4 bg-blue-sky">
							<div class=" bg-blue-sky widget">
								
								<aside id="wg_embed" class="widget ">
									<div class="title-section clearfix">
										<h4 class="lead-title"><i class="fa fa-share-alt"></i> Bagikan Ke Jejaring Sosial</h4>
										<div class="white-line uk-clearfix"></div>
									</div>
									<div>
										<ul class="nav nav-pills">
											<!--linked in	-->
											<li><script type="IN/Share"></script></li>
											<!--Twitter 	-->
											<li><a class="twitter-share-button" href="<?php echo current_url(); ?>">Tweet</a></li>
											<li style="top: -2px;" id="fbshare"><div class="fb-share-button" 
												data-href="<?php echo current_url(); ?>" 
												data-layout="button" data-size="small">
											</div></li>
										</ul>
									</div>
								</aside>
								
								
								<aside id="wg_embed" class="widget ">
									<div class="title-section clearfix">
										<h4 class="lead-title"><i class="fa fa-paste"></i> Tempelkan di Web lain</h4>
										<div class="white-line uk-clearfix"></div>
									</div>
									<div>
										<p style="color:#444">Gunakan skrip berikut ini untuk memasang tautan dari situs web anda ke halaman ini:</p>
										<div  style="height:100px;width:100%;overflow:auto;background:#f5f5f5;color:" onclick="selectText('selectable')" id="selectable">
										<code>
											&lt;div style="border:solid 1px #ccc;border-radius:.5em;-webkit-box-shadow: 5px 6px 8px 0px #d8d8d8;box-shadow: 5px 6px 8px 0px #d8d8d8;background:#fff;color:#888;padding:1em;"&gt;&lt;a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"&gt;&lt;img src="<?php echo base_url('/assets/img/oda-l.png');?>" alt="Open Data APBD" style="width:100%;margin:0;padding:0;margin-bottom:1em;"/&gt;&lt;span style="margin:0;padding:0;font-size:1.6em;font-weight:600;color:#888;line-height:1em;"&gt;Open Data APB <?php echo $page['title']; ?>&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;
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
