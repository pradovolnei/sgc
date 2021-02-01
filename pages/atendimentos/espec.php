
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-8">
            <ol class="breadcrumb float-sm-left">
			  <li class="breadcrumb-item"><a href="?l=<?php echo base64_encode(4); ?>" >Novo Atendimento</a></li>
              <li class="breadcrumb-item active">Especialidades</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		
		
			<?php 
					$sql_especs = "SELECT d.nome AS 'especialidade', d.id
									, GROUP_CONCAT(c.nome) AS 'procedimento' 
									FROM proc_clinica a
									LEFT JOIN clinica b ON b.id = a.id_clinica
									LEFT JOIN procedimento c ON c.id  = a.id_proc
									LEFT JOIN especialidades d ON d.id = c.id_espec
									";						
					if(isset($_GET["cl"]))
						$sql_especs .= " WHERE b.id=".base64_decode($_GET["cl"]);
					
					$sql_especs .= " GROUP BY d.id";
					$sql_especs .= " ORDER BY d.nome DESC ";
					
						
					$exec_sql_especs = mysqli_query($con,$sql_especs) or die(mysqli_error($con));
					if(mysqli_num_rows($exec_sql_especs) > 0){
						while($col = mysqli_fetch_array($exec_sql_especs)){
							
						?>						
						<a href="?l=<?php echo base64_encode(5); ?>" style="text-decoration:none;color:#000;">
						<div class="card card-info" >
						
						  <div class="card-header" style="background-image: linear-gradient(to bottom right, #0077FF, #00BFFF) !important;">
							<h3 class="card-title"><?php echo $col["especialidade"]; ?> </h3> 
						  </div>
						
						  
						  <div class="card-body">
						  
							
							<?php
								$explode = explode(",", $col["procedimento"]);
								sort($explode);
								foreach($explode as $parte){
									echo $parte."<br>";
								}
								
								echo "<br>";
								
								echo "<a href='?l=".base64_encode(6)."&cl=".$_GET["cl"]."&sp=".base64_encode($col["id"])."&sp2=".base64_encode($col["especialidade"])."'><button class='btn btn-block btn-primary btn-sm add-mobile'> Solicitar </button></a>";
							?>
							
							
						  </div>
						  <!-- /.card-body -->
						</div>
						<!-- /.card -->
						</a>
						<?php
						}
					}else{
						echo "<h3> Nenhuma rede encontrada... </h3>";
					}
					
						?>
		
       

		
		
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->