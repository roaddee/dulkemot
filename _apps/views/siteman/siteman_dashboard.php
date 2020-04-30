<?php
/*
 * siteman_dashboard.php
 * 
 * Copyright 2016 Isnu Suntoro <isnusun@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

$this->load->view('siteman/siteman_header');
?>
<!-- Left side column. contains the logo and sidebar -->
<?php
$this->load->view('siteman/siteman_sidebar');
?>
 <!-- Content Wrapper. Contains page content -->

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			<?php echo $pageTitle;?>
			<small>Control panel</small>
			</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo site_url('siteman')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-bullhorn fa-fw"></i> Selamat Datang Sdr. <?php echo $user['nama']; ?></h3>
						</div>
						<div class="box-body">
							<p><strong>Sdr. <?php echo $user['nama']; ?>,</strong> silakan lanjutkan aktivitas anda. </p>
							<p>Bisa mulai dengan menu-menu disebelah kiri atau menu berikut ini:</p>
							
							<?php 
							echo "<a class=\"btn btn-app\" href=\"".site_url('siteman/profil')."\"><i class=\"fa fa-gear\"></i>Data Pribadi</a>";
							if($user['tingkat'] <= 1){
								echo "
								<a class=\"btn btn-app\" href=\"".site_url('admin/pengguna')."\"><i class=\"fa fa-users\"></i>Pengguna</a>
								<a class=\"btn btn-app\" href=\"".site_url('admin/lembaga')."\"><i class=\"fa fa-building-o\"></i>Lembaga</a>
								<a class=\"btn btn-app\" href=\"".site_url('admin/laman')."\"><i class=\"fa fa-sitemap\"></i>Laman Web</a>
								<a class=\"btn btn-app\" href=\"".site_url('admin/konfigurasi')."\"><i class=\"fa fa-cogs\"></i>Sistem</a>
								";
							}
							
							if(	$user['tingkat'] < 3){
								echo "
								<a class=\"btn btn-app\" href=\"".site_url('program_bansos')."\"><i class=\"fa fa-cubes\"></i> <span>Jaminan Sosial</span></a>
								<a class=\"btn btn-app\" href=\"".site_url('program_kerja')."\"><i class=\"fa fa-cubes\"></i> <span>Program Nangkis</span></a>
								";
							}
							
							if(($user['tingkat'] == 3) || ($user['tingkat'] == 0)){
								/*
								 * Untuk Petugas Entry Data
								 * */
								echo "
								<a class=\"btn btn-app btn-primary\" href=\"".site_url('verivali')."\"><i class=\"fa fa-balance-scale\"></i> <span>VeriVali Data</span></a>
								";
							}
							
							echo "
							<a class=\"btn btn-app\" href=\"".site_url('posts')."\"><i class=\"fa fa-newspaper-o\"></i>CMS Artikel</a>
							";
							
							// echo var_dump($this->session->userdata);
							?>
						</div>
					</div>
					
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#info" data-toggle="tab">Info</a></li>
							<li><a href="#salut" data-toggle="tab">Komponen dan Penghormatan</a></li>
							<li><a href="#lisensi" data-toggle="tab">Lisensi</a></li>
							<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-th"></i></a></li>
						</ul>
						
						<div class="tab-content">
							<div class="tab-pane active" id="info">
								<span class="fa-stack fa-lg pull-right ">
									<i class="fa fa-circle-o fa-stack-2x"></i>
									<i class="fa fa-info fa-stack-1x"></i>
								</span>
								<b>Sekilas tentang <?php echo APP_TITLE; ?>:</b>
							</div>

							<div class="tab-pane" id="salut">
								<span class="fa-stack fa-lg text-green pull-right">
									<i class="fa fa-circle-o fa-stack-2x"></i>
									<i class="fa fa-gift fa-stack-1x"></i>
								</span>
								<div>
<p>Aplikasi <?php echo APP_TITLE." ".APP_VERSION; ?> ini dikembangkan dengan memanfaatkan teknologi aplikasi berbasis web, dengan menggunakan skrip <a href="http://php.net/downloads.php" target="_blank">PHP versi 7</a>, dalam rangkakerja (Framework) <a href="https://www.codeigniter.com/" target="_blank">CodeIgniter versi 3.1.2</a>&nbsp;dijalankan pada web server yang bisa mendukung skrip PHP. Anda bisa menggunakan <a href="https://httpd.apache.org" target="_blank">Apache</a>, <a href="https://nginx.org/" target="_blank">Nginx</a>, <a href="http://www.iis.net/" target="_blank">IIS</a> (belum pernah dicoba, namun seharusnya bisa).&nbsp;</p>
<p>Untuk mesin basis data, aplikasi ini menggunakan <a href="http://www.mysql.com/" target="_blank">MySQL v5.7</a>(atau yang lebih baru)&nbsp;atau bisa juga menggunakan <a href="https://mariadb.org/" target="_blank">MariaDB 5.7</a>(atau yang lebih baru).</p>
<p>Upaya untuk memberikan kinerja tampilan yang optimal, kami memilih menggunakan <a href="https://jquery.com/" target="_blank">jQuery 2.10</a>&nbsp;dan&nbsp;<a href="http://getbootstrap.com/" target="_blank">Twitter Bootstrap v.3</a>&nbsp;dengan komponen-komponen javascript yang sudah dikemas didalamnya.&nbsp;</p>
<p>Template theme yang kami gunakan disini untuk admin panel adalah &nbsp;<a href="https://github.com/almasaeed2010/AdminLTE/" target="_blank">AdminLTE v.2.3.7</a> dari <a href="https://almsaeedstudio.com/" target="_blank">Almsaeed Studio</a>&nbsp;yang berlisensi <a href="https://opensource.org/licenses/MIT" target="_blank">MIT</a>&nbsp;yang mana dengan lisensi tersebut kita bisa menggunakan, menyalin, memodifikasi, menggabungkan, mempublikasikan, mendistribusikan, mensublisensikan, dan atau menjual salinan piranti lunak tersebut. Namun harus dengan menyatakan bahwa sumber asli dari piranti tersebut berasal dari pembuat awal.</p>
<p>Sedangkan untuk tampilan halaman publik, kami menggunakan template versi tidak berbayar/gratis dari <a href="http://www.andreagalanti.it" target="_blank">Flatfy Theme versi 1.0 oleh Andrea Galanti</a>.<br></p>
<p>Komponen-komponen lainnya yang mendukung aplikasi ini bisa ditampilkan seperti saat ini adalah:&nbsp;</p>
<ul>
	<li>Font Awesome<br></li>
	<li>jQuery-Autocomplete</li>
	<li>dataTables</li>
	<li>Date Range Picker for Bootstrap</li>
	<li>Highcharts</li>
	<li>gauge.js</li>
	<li>iCheck</li>
	<li>Ion.RangeSlider</li>
	<li>jQuery</li>
	<li>PNotify - Awesome JavaScript notifications</li>
	<li>Pace</li>
	<li>bootstrap-progressbar</li>
	<li>Select2</li>
	<li>Sidebar Transitions - simple off-canvas navigations</li>
	<li>jQuery Tags Input Plugin</li>
	<li>Autosize - resizes text area to fit text</li>
	<li>ValidationEngine</li>
	</ul>
<p>Semoga apa yang kita lakukan hari ini bisa berguna untuk kebaikan bersama.&nbsp;</p>
<p>Salam,&nbsp;</p>
<p>Pengembang</p>									
								</div>
							</div>

							<div class="tab-pane" id="lisensi">
									
									<?php
									if(ENVIRONMENT=='production'){
										echo "
										<span class=\"fa-stack fa-lg text-red pull-right\">
											<i class=\"fa fa-circle-o fa-stack-2x\"></i>
											<i class=\"fa fa-copyright fa-stack-1x\"></i>
										</span>
										<div>
										";
										$connected = @fsockopen("www.google.com", 80,$errno, $errstr, 5); 
										if ($connected){
											$strTxt = file_get_contents("http://www.gnu.org/licenses/gpl-3.0.txt");
											echo "<img src=\"http://www.gnu.org/graphics/gplv3-88x31.png\"/>";
										}
									}else{
										echo "
										<span class=\"fa-stack fa-lg text-green pull-right\">
											<i class=\"fa fa-circle-o fa-stack-2x\"></i>
											<i class=\"fa fa-copyright fa-stack-1x\"></i>
										</span>
										<div>
										";
										$strTxt = file_get_contents(base_url('assets/gpl-3.0.txt'));
									}	
									echo nl2br($strTxt);
									?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<!-- footer section -->

<?php

$this->load->view('siteman/siteman_footer');
