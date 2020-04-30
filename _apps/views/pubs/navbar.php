	<!-- NavBar-->
	<nav class="navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url('/');?>"><img style="float:left;margin-top:-5px;margin-right:1em;border:solid 2px #ccc;border-radius:20px;" src="<?php echo base_url('assets/img/android-icon-36x36.png'); ?>"/> TKPKD</a>
			</div>

			<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					
					<li class="menuItem"><a href="<?php echo site_url('publik/laman/tentangkami'); ?>"><i class="fa fa-puzzle-piece"></i> Tentang Kami</a></li>
					<li class="menuItem"><a href="<?php echo site_url('publikasi'); ?>"><i class="fa fa-cubes"></i> Aktivitas</a></li>
					<li class="menuItem dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-line-chart"></i> Kesejahteraan Dalam Angka <i class="fa fa-chevron-down"></i></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('dlmangka/pbdt/'); ?>">Basis Indikator PBDT</a></li>
							<li><a href="<?php echo site_url('dlmangka/pbk/'); ?>">Basis Indikator Lokal</a></li>
							<li><a href="<?php echo site_url('dlmangka/'); ?>">SK Gakin</a></li>
						</ul>
					</li>
					<li class="menuItem"><a href="<?php echo site_url('kontak'); ?>"><i class="fa fa-compass"></i> Hubungi Kami</a></li>
				</ul>
			</div>
		   
		</div>
	</nav> 
