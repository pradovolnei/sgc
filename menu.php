<!-- Sidebar Menu -->
<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	  <!-- Add icons to the links using the .nav-icon class
		   with font-awesome or any other icon font library -->
	  <li class="nav-item">
		<a href="home.php" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Home
		  </p>
		</a>
	  </li>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(1); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Atendimentos
		  </p>
		</a>
	  </li>
	  <?php if(!$clinina_usuario){ ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(4); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Unidades
		  </p>
		</a>
	  </li>
	  <?php } ?>
	  <?php if($perfil_usuario == 1 || $perfil_usuario == 2){ ?>
	  <li class="nav-item has-treeview">
		<a href="#" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Cadastro
			<i class="right fa fa-angle-left"></i>
		  </p>
		</a>
		<ul class="nav nav-treeview">
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(8); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Unidades</p>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="?l=<?php echo base64_encode(9); ?>" class="nav-link">
			  <i class="fa fa-circle-o nav-icon"></i>
			  <p>Usuários</p>
			</a>
		  </li>
		</ul>
	  </li>
	  <?php } ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(7); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Fale conosco
		  </p>
		</a>
	  </li>
	  
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(11); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Perfil
		  </p>
		</a>
	  </li>
	  <?php if($perfil_usuario == 2){ ?>
	  <li class="nav-item">
		<a href="?l=<?php echo base64_encode(10); ?>" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Perfil Clínica
		  </p>
		</a>
	  </li>
	  <?php } ?>
	  <li class="nav-item">
		<a href="logout.php" class="nav-link">
		  <i class="nav-icon fa fa-th"></i>
		  <p>
			Sair
		  </p>
		</a>
	  </li>
	</ul>
</nav>
<!-- /.sidebar-menu -->