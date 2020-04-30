      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $user['foto']['s']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $user['nama']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php 
          $strA = ($this->uri->segment(1, 0) == "siteman") ? "active" : "";
          ?>
          <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
            <li class="<?php echo $strA; ?> treeview">
              <a href="<?php echo site_url('siteman');?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php 
            /*
             * Menu Admin
             * */
            if($user['tingkat'] <= 1){
							$strA = ($this->uri->segment(1, 0) == "admin") ? "active" : "";
							echo "
							<li class=\"". $strA." treeview\">
								<a href=\"#\">
									<i class=\"fa fa-files-o\"></i>
									<span>Administrasi Sistem</span>
									<i class=\"fa fa-angle-left pull-right\"></i>
								</a>
								<ul class=\"treeview-menu\">
									<li><a href=\"".site_url('admin/pengguna')."\"><i class=\"fa fa-users\"></i> Kelola Pengguna</a></li>
									<li><a href=\"".site_url('admin/lembaga')."\"><i class=\"fa fa-building-o\"></i> Data Lembaga</a></li>
									<li><a href=\"".site_url('admin/laman')."\"><i class=\"fa fa-sitemap\"></i> Halaman Statis Web</a></li>
									<!--
									<li><a href=\"".site_url('admin/konfigurasi')."\"><i class=\"fa fa-cogs\"></i> Konfigurasi Sistem</a></li>
									-->
								</ul>
							</li>
							
							";
/*
							$strA = ($this->uri->segment(1, 0) == "olahdata") ? "active" : "";
							echo "
							<li class=\"". $strA." \"><a href=\"".site_url('olahdata')."\"><i class=\"fa fa-database\"></i> <span>Olah Data</span></a></li>
							";
*/

						}
						
						if(($user['tingkat'] == 3) || ($user['tingkat'] == 0)){
							/*
							 * Untuk Petugas Entry Data
							 * */
							$strA = ($this->uri->segment(1, 0) == "unggah") ? "active" : "";
							echo "
							<li class=\"". $strA." \"><a href=\"".site_url('unggah')."\"><i class=\"fa fa-upload\"></i> <span>Unggah Berkas</span></a></li>
							";
							$strA = ($this->uri->segment(1, 0) == "olahdata") ? "active" : "";
							echo "
							<li class=\"". $strA." \"><a href=\"".site_url('olahdata')."\"><i class=\"fa fa-database\"></i> <span>Olah Data</span></a></li>
							";
						}

						$strA = (($this->uri->segment(1, 0) == "posts") ||($this->uri->segment(1, 0) == "galeri")) ? "active" : "";
						echo "
						<li class=\"". $strA." \">
							<a><i class=\"fa fa-send\"></i> <span>Publikasi</span> <i class=\"fa fa-angle-left pull-right\"></i>
							<ul class=\"treeview-menu\">
								<li><a href=\"".site_url('posts')."\"><i class=\"fa fa-newspaper-o fa-fw\"></i> <span>Analisis APBD</span></a></li>
								
							</ul>
						</li>
						";
            ?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
