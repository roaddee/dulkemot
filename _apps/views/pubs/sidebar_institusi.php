							<div class="bg-blue-sky widget">
								
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
								<?php
								/*
								 * Identifikasi Program berbasis Isu
								 * 
								 * */
								echo "
								<aside id=\"post_tags\" class=\"widget\">
									<div class=\"title-section clearfix\">
										<h4 class=\"lead-title\"><i class=\"fa fa-tags\"></i> Identifikasi Isu</h4>
										<div class=\"white-line uk-clearfix\"></div>
									</div>
									<div>
										<ul class=\"nav nav-pills\">";
										foreach($tags as $key=>$rs){
											echo "
											<li><a href=\"".site_url('apbd/tags/'.$rs['id'].'/'.$rs['parma'])."\"><i class=\"fa fa-tag\"></i> ".$rs['nama']."</a></li>
											";
										}
										echo "
										</ul>
									</div>
								</aside>
								";								
								
								
								?>
									
								<aside>
									<div class="box box-primary box-solid">
										<div class="box-header with-border">
											<h3 class="box-title text-white">Lembaga di <?php echo $wilayah;?></h3>
										</div>
										<div class="box-body no-padding">
											<ul class="nav navbar">
												<?php 
												foreach($org['org'] as $k=>$o){
													echo "<li><a href=\"".site_url('institusi/opd/'.$o['id'])."/".fixNamaUrl($o['nama'])."/\">".$o['nama']."</a></li>";
												}
												?>
											</ul>
										</div>
									</div>
								</aside>
								
								<aside>
									<div class="box box-primary box-solid">
										<div class="box-header with-border">
											<h3 class="box-title text-white">Pemerintahan Daerah</h3>
										</div>
										<div class="box-body text-center">
											<div class="row">
												<div class="col-md-2 col-sm-4 col-xs-6">
													<a href="<?php echo site_url('apbd/pemda/34'); ?>"><img src="<?php echo base_url('assets/img/34.jpg'); ?>" class="img-rounded" /></a>
												</div>
												<div class="col-md-2 col-sm-4 col-xs-6">
													<a href="<?php echo site_url('apbd/pemda/3401'); ?>"><img src="<?php echo base_url('assets/img/3401.jpg'); ?>" class="img-rounded" /></a>
												</div>
												<div class="col-md-2 col-sm-4 col-xs-6">
													<a href="<?php echo site_url('apbd/pemda/3402'); ?>"><img src="<?php echo base_url('assets/img/3402.jpg'); ?>" class="img-rounded" /></a>
												</div>
												<div class="col-md-2 col-sm-4 col-xs-6">
													<a href="<?php echo site_url('apbd/pemda/3403'); ?>"><img src="<?php echo base_url('assets/img/3403.jpg'); ?>" class="img-rounded" /></a>
												</div>
												<div class="col-md-2 col-sm-4 col-xs-6">
													<a href="<?php echo site_url('apbd/pemda/3404'); ?>"><img src="<?php echo base_url('assets/img/3404.jpg'); ?>" class="img-rounded" /></a>
												</div>
												<div class="col-md-2 col-sm-4 col-xs-6">
													<a href="<?php echo site_url('apbd/pemda/3471'); ?>"><img src="<?php echo base_url('assets/img/3471.jpg'); ?>" class="img-rounded" /></a>
												</div>
											</div>
										</div>
									</div>
								
								</aside>
								
							</div>
							
