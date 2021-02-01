
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bem vindo!</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col (left) -->
          <div class="col-lg-3 col-6">
			 <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
				<?php 
					$sql = "SELECT COUNT(*) as 'total' FROM chat WHERE id_receptor=$id_usuario AND status IS NULL";
					$exec = mysqli_query($con,$sql);
					$col = mysqli_fetch_array($exec);
					
					echo "<h3>".$col["total"]."</h3>";
				?>
                
                <p>Novas Mensagens</p>
              </div>
              <div class="icon">
                <i class="fa fa-comments"></i>
              </div>
              <a href="?l=<?php echo base64_encode(12);?>" class="small-box-footer">Exibir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
		  
		  
		   <!-- /.col (left) -->
          <div class="col-lg-3 col-6">
			 <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
					if($clinina_usuario)
						$sql = "SELECT COUNT(*) as 'total' FROM atendimentos WHERE id_clinica=$clinina_usuario";
					else
						$sql = "SELECT COUNT(*) as 'total' FROM atendimentos WHERE id_paciente=$id_usuario";
					
					$sql .= " AND data_agendada LIKE '%".date("Y-m-d")."%' AND status<>'Cancelado'";
					
					$exec = mysqli_query($con,$sql);
					$col = mysqli_fetch_array($exec);
					
					echo "<h3>".$col["total"]."</h3>";
				?>
                <p>Atendimentos para hoje</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-md"></i>
              </div>
              <a href="?l=<?php echo base64_encode(1); ?>&cnd=td" class="small-box-footer">Exibir todos <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
		  
		   <!-- /.col (left) -->
          <div class="col-lg-3 col-6">
			 <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
					if($clinina_usuario)
						$sql = "SELECT COUNT(*) as 'total' FROM atendimentos WHERE id_clinica=$clinina_usuario";
					else
						$sql = "SELECT COUNT(*) as 'total' FROM atendimentos WHERE id_paciente=$id_usuario";
					
					$sql .= " AND data_agendada < CURDATE() AND resultado IS NULL AND status<>'Cancelado'";
					
					$exec = mysqli_query($con,$sql);
					$col = mysqli_fetch_array($exec);
					
					echo "<h3>".$col["total"]."</h3>";
				?>
                <p>Atendimentos aguardando resultado</p>
              </div>
              <div class="icon">
                <i class="fa fa-plus-square"></i>
              </div>
              <a href="?l=<?php echo base64_encode(1); ?>&cnd=pnd" class="small-box-footer">Exibir todos <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
		  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->