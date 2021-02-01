<!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom fixed-top" style="background-image: linear-gradient(to bottom right, #00FFFF, #00BFFF) !important;">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link pushmobile" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
		<label> SGC </label>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
	  <?php 
			$sql = "SELECT b.nome,b.id,a.data,a.mensagem ,b.id_clinica
					FROM chat a 
					LEFT JOIN usuarios b ON b.id = a.id_remetente
					WHERE a.id_receptor = $id_usuario AND a.status IS NULL
					ORDER BY data DESC
			";
			$exec = mysqli_query($con,$sql);
			$totalpen = mysqli_num_rows($exec);
		 ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <?php 
			if($totalpen>0)
				echo '<span class="badge badge-danger navbar-badge">'.$totalpen.'</span>'; 
		  ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
		 <?php 
			if($totalpen>0){
				while($col = mysqli_fetch_array($exec)){
					$corpo = '<a href="?l='.base64_encode(12).'&rm='.$col["id"].'" class="dropdown-item">
							<div class="media">
							  
							  <div class="media-body">
								<h3 class="dropdown-item-title">
								  <b>';
								if($col["id_clinica"])
									$corpo .= clinica($col["id"]);
								else
									$corpo .= $col["nome"];
									
								 $corpo .= '</b>
								 
								</h3>
								<p class="text-sm">'.msgLimit($col["mensagem"]).'</p>
								<p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> '.diferencaTempo($col["data"]).'</p>
							  </div>
							</div>
						  </a>
						  <div class="dropdown-divider"></div>';
						  
						  echo $corpo;
				}
			}else{
				$corpo = '
							<div class="media">
							  
							  <div class="media-body">
								
								<h3 class="dropdown-item-title">Nenhuma mensagem pendente</h3>
								<p class="text-sm"></p>
								<p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> </p>
							  </div>
							</div>
						  
						  <div class="dropdown-divider"></div>';
						  
						  echo $corpo;
			}
		 ?>

          <a href="?l=<?php echo base64_encode(12);?>" class="dropdown-item dropdown-footer">Todas as Mensagens</a>
        </div>
      </li>
	  
	  <?php
		$sql_not = "SELECT * FROM notificacao WHERE id_usuario = $id_usuario AND status IS NULL";
		$exec_not = mysqli_query($con,$sql_not);
		$total = mysqli_num_rows($exec_not);
	  ?>
	  
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $total;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right not-mobile">
          <span class="dropdown-item dropdown-header"><?php echo $total;?> Notificações</span>
		  
			<?php 
			while($row = mysqli_fetch_array($exec_not)){
				echo ' <div class="dropdown-divider"></div>
						  <a href="'.$row["link"].'" class="dropdown-item">
							'.$row["notificacao"].'
							<span class="float-right text-muted text-sm">'.diferencaTempo($row["data"]).'</span>
						  </a>';
			}
		  ?>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->