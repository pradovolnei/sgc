	<?php 
		include "pages/atendimentos/consulta_controller.php";
	?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-2">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Atendimentos</li>
            </ol>
          </div>
		  <div class="col-sm-10">
			<?php 
				if($clinina_usuario)
					echo '<a href="?l='.base64_encode(5).'&cl='.base64_encode($clinina_usuario).'" style="text-decoration:none;color:#000;">';
				else
					echo "<a href='?l=".base64_encode(4)."' style='text-decoration:none;color:#000;'>";
			?>
			
            <button type="button" class="btn btn-block btn-sm pull-right add-mobile" style="background-color:#48D1CC;" >Solicitar Atendimento</button>
			</a>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  
	  
	  <form action="" method="post">
		<!-- SELECT2 EXAMPLE -->
        <?php 
			if(isset($_POST["list"]))
				echo '<div class="card card-default">';
			else
				echo '<div class="card card-default collapsed-card">';
		?>
		<a href="#" data-widget="collapse" style="text-decoration:none;color:#000;">
          <div class="card-header">
            <h3 class="card-title">Filtro de busca</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" >\/</button>
            </div>
          </div>
		</a>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Estado</label>
                  <select class="form-control" style="width: 100%;" onChange="listCity(this.value)" name="estado">
					<option value=''>Todos os estados</option>
                    
					<?php 
							$sql_lab = "SELECT uf FROM cidades GROUP BY uf ORDER BY uf ";
							
							$exec_sql_lab = mysqli_query($con, $sql_lab);
							
							while($col = mysqli_fetch_array($exec_sql_lab)){
								if(isset($_POST["estado"]) && $_POST["estado"] == $col["uf"])
									echo "<option value='".$col["uf"]."' selected> ".$col["uf"]." </option>";
								else
									echo "<option value='".$col["uf"]."'> ".$col["uf"]." </option>";
							}
						?>
                  </select>
                </div>
				
				<div id="citys">
				 <!-- /.form-group -->
					<div class="form-group">
					  <label>Cidade</label>
					  <select class="form-control" name="cidade" onChange="listLab(this.value, '') ">
						<?php 
							$sql_lab = "SELECT * FROM cidades ";
							if(isset($_POST["estado"]) && $_POST["estado"])
								$sql_lab .= " WHERE uf='".$_POST["estado"]."'";
							$exec_sql_lab = mysqli_query($con, $sql_lab);
							
							while($col = mysqli_fetch_array($exec_sql_lab)){
								
								if(isset($_POST["cidade"]) && $_POST["cidade"] == $col["id"])
									echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
								else
									echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
							}
						?>
					  </select>
					</div>
					<!-- /.form-group -->
				</div>
				
				<div id="labs">
				<div class="form-group">
                  <label>Clínica</label>
                  <select class="form-control" style="width: 100%;" onChange="listWork(this.value)" name="clinica">
					<option value=''>Todas as clínicas</option>
                    <?php 
						$sql_lab = "SELECT * FROM clinica";
						if($clinina_usuario)
							$sql_lab .= " WHERE id=".$clinina_usuario;
						
						$exec_sql_lab = mysqli_query($con, $sql_lab);
						
						while($col = mysqli_fetch_array($exec_sql_lab)){
							if(isset($_POST["clinica"]) && $_POST["clinica"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
							
						}
					?>
                  </select>
                </div>
				</div>
				
				<div id="procs">
				<div class="form-group">
                  <label>Procedimento</label>
                  <select class="form-control" style="width: 100%;" name="proc">
					<option value=''>Todas os procedimentos</option>
                    <?php 
						$sql_lab = "SELECT * 
										FROM procedimento 
										";
						if($clinina_usuario)
							$sql_lab = "SELECT a.* 
										FROM procedimento a
										LEFT JOIN (SELECT * FROM proc_clinica WHERE id_clinica=$clinina_usuario)as b ON b.id_proc = a.id
										WHERE b.id_clinica IS NOT NULL
										";
						$exec_sql_lab = mysqli_query($con, $sql_lab);
						
						while($col = mysqli_fetch_array($exec_sql_lab)){
							if(isset($_POST["proc"]) && $_POST["proc"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
                </div>
				</div>
               
              </div>
			  
			  
			  <div class="col-md-6">
                <div class="form-group">
                  <label>Plano</label>
                  <select class="form-control" style="width: 100%;" name="plano" onChange="listCity(this.value)">
                   
                    <?php 
						$sql_plano = "SELECT * FROM plano";
						$exec_sql_plano = mysqli_query($con, $sql_plano);
						echo "<option value=''> todos os planos </option>";
						while($col = mysqli_fetch_array($exec_sql_plano)){
							if(isset($_POST["plano"]) && $_POST["plano"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
                </div>
				
				
				 <!-- /.form-group -->
					<div class="form-group">
					  <label>Avaliação</label>
					  <select class="form-control" name="notas" style="width: 100%;">
						<option value=""> Todas as notas</option>
						<?php 
							$bom = null;
							$medio = null;
							$ruim = null;
							
							if(isset($_POST["notas"])){
								if($_POST["notas"] == "4-5")
									$bom = "selected";
								if($_POST["notas"] == "3-4")
									$medio = "selected";
								if($_POST["notas"] == "0-3")
									$ruim = "selected";
							}
						?>
						<option value="4-5" <?php echo $bom; ?> > 4 - 5</option>
						<option value="3-4" <?php echo $medio; ?> > 3 - 4</option>
						<option value="0-3" <?php echo $ruim; ?> > Abaixo de 3</option>
					  </select>
					</div>
					<!-- /.form-group -->
					
				<div id="works">
				<div class="form-group">
                  <label>Especialidade</label>
                  <select class="form-control" style="width: 100%;" name="especialidade" onChange="listProcs(this.value)">
					
                    <?php 
						$sql_lab = "SELECT * FROM especialidades";
						$exec_sql_lab = mysqli_query($con, $sql_lab);
						echo "<option value=''> todos as especialidades </option>";
						while($col = mysqli_fetch_array($exec_sql_lab)){
							if(isset($_POST["especialidade"]) && $_POST["especialidade"] == $col["id"])
								echo "<option value='".$col["id"]."' selected > ".$col["nome"]." </option>";
							else
								echo "<option value='".$col["id"]."'> ".$col["nome"]." </option>";
						}
					?>
                  </select>
                </div>
				</div>
				
				<div class="form-group">
                  <label>Status</label>
                  <select class="form-control" style="width: 100%;" name="status" >
					
                    <?php 
						$arra_status = ["Aguardando Confirmação da Unidade", "Atendimento Confirmado", "Realizado", "Cancelado"];
						echo "<option value=''> </option>";
						foreach($arra_status as $sit){
							if(isset($_POST["status"]) && $_POST["status"] == $sit)
								echo "<option value='".$sit."' selected> $sit </option>";
							else
								echo "<option value='".$sit."'> $sit </option>";
						}
					?>
                  </select>
                </div>
				
               
              </div>
              
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <input type="submit" value="Listar" class="btn btn-block btn-success btn-sm pull-right add-mobile" name="list" />
          </div>
        </div>
        <!-- /.card -->
		</form>
	  
       
		<?php 
			$sql_atendimentos = "SELECT a.*, b.nome as 'clinica', c.nome as 'procedimento', d.nome as 'espec', d.id as 'id_espec' 
									FROM atendimentos a 
									LEFT JOIN clinica b ON b.id = a.id_clinica 
									LEFT JOIN procedimento c ON c.id = a.id_proc
									LEFT JOIN especialidades d ON d.id = c.id_espec 
									
									WHERE a.id IS NOT NULL ";
			
			if($perfil_usuario == 4)
				$sql_atendimentos .= " AND id_paciente=".$id_usuario;
			
			if($perfil_usuario == 2 || $perfil_usuario == 3)
				$sql_atendimentos .= " AND id_clinica=".$clinina_usuario;
			
			if(isset($_GET["cnd"])){
				if($_GET["cnd"] == "td")
					$sql_atendimentos .= " AND data_agendada LIKE '%".date("Y-m-d")."%' AND status<>'Cancelado'";
				
				if($_GET["cnd"] == "pnd")
					$sql_atendimentos .= " AND data_agendada < CURDATE() AND resultado IS NULL AND status<>'Cancelado'";
			}
			
			if(isset($_POST["list"])){
				if($_POST["estado"])
					$sql_atendimentos .= " AND b.uf='".$_POST["estado"]."'";
				
				if($_POST["plano"])
					$sql_atendimentos .= " AND a.id_plano='".$_POST["plano"]."'";
				
				if($_POST["clinica"])
					$sql_atendimentos .= " AND b.id=".$_POST["clinica"];
				
				if(isset($_POST["cidade"]) && $_POST["cidade"])
					$sql_atendimentos .= " AND b.cidade='".$_POST["cidade"]."'";
				
				if($_POST["proc"])
					$sql_atendimentos .= " AND c.id='".$_POST["proc"]."'";
				
				
				if($_POST["notas"]){
					
					$notas = explode("-", $_POST["notas"]);
					
					$sql_atendimentos .= " AND a.nota >= ".$notas[0]." AND a.nota <= ".$notas[1];
				}
				
				if($_POST["status"])
					$sql_atendimentos .= " AND a.status='".$_POST["status"]."'";
					
				
			}
			
			$sql_atendimentos .= " ORDER BY data_encerramento,data_abertura DESC";

			$exec_sql_atendimentos = mysqli_query($con, $sql_atendimentos);
			
			if(mysqli_num_rows($exec_sql_atendimentos) >= 1){
				while($row = mysqli_fetch_array($exec_sql_atendimentos)){
		?>
			
		<div class="row">
          <!-- /.col (left) -->
          <div class="col-md-12 ">

            <!-- iCheck -->
            <div class="card card-success card-default collapsed-card">
			<a href="#" data-widget="collapse" style="text-decoration:none;color:#000;">
              <div class="card-header" style="background-color:#48D1CC;">
                <h6 class="card-title">Protocolo - <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT);?></h6>
              </div>
			</a>
              <div class="card-body">
                <!-- Minimal style -->
				<div class="row">
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Clínica:
						  </label> <?php echo $row["clinica"]; ?>
						</div>
					</div>
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Procedimento:
						  </label> <?php echo $row["procedimento"]; ?>
						</div>
					</div>
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Data de abertura:
						  </label> <?php echo dataBrasileira($row["data_abertura"]); ?>
						</div>
					</div>
					<div class="col-md-3">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Data de fechamento:
						  </label> <?php echo dataBrasileira($row["data_encerramento"]); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						  <label>
							Especialidade:
						  </label> <?php echo $row["espec"]; ?>
						</div>
					</div>

                    <div class="col-md-3">
						<div class="form-group">
						  <label>
							Paciente:
						  </label> <?php echo $row["nome_paciente"]; ?>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
						  <label>
							Data agendada:
						  </label> <?php echo dataBrasileira($row["data_agendada"]); ?>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
						  <label>
							Status:
						  </label> <?php echo $row["status"]; ?>
						</div>
					</div>
					
				</div>
				
				 <!-- Minimal style -->
				<div class="row">
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Observação:
						  </label> <?php echo $row["obs_paciente"]; ?> <br> <?php echo "<font color='red'>".$row["obs_clinica"]."</font>"; ?>
						</div>
					</div>
					<div class="col-md-6">
						<!-- checkbox -->
						<div class="form-group">
						  <label>
							Resultado:
						  </label> <?php echo $row["resultado"]; ?> <br> <?php if($row["laudo"]) echo "<a href='".$row["laudo"]."'> Baixar Laudo </a>"; ?>
						</div>
					</div>					
					
				</div>
				
					<?php 
						if($row["status"] == "Aguardando Confirmação da Unidade"){
							echo "<div class='row'>";
							echo '<div class="col-md-3">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-danger btn-sm pull-right '  data-toggle='modal' data-target='#cancel".$row["id"]."'> Cancelar </button> ";
							echo '</div>';
							echo '</div>';
							echo "</div>";
							
						?>
						<br />
						<form action="" method="post" >
						<div class="modal fade" id="cancel<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Cancelar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<div class="form-group">
								  <label>Observação (Máximo 1000 caracteres)</label>
								  <textarea name="obs" class="form-control" maxlength=1000 required ></textarea>
								  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
								 </div>
							  </div>
							  <div class="modal-footer">
								<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
								<input type="submit" class="btn btn-success" value='Confirmar' name="cancelar" />
							  </div>
							</div>
						  </div>
						</div>
						</form>
						
						<?php
						
						if($clinina_usuario){
						    echo "<div class='row'>";
							echo '<div class="col-md-3">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-success btn-sm pull-right '  data-toggle='modal' data-target='#confirm".$row["id"]."'> Confirmar </button> ";
							echo '</div>';
							echo '</div>';
							echo "</div>";
							
						?>
						
						<form action="" method="post" >
						<div class="modal fade" id="confirm<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Confirmar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								<div class="form-group">
								  <label>Observação (Máximo 1000 caracteres)</label>
								  <textarea name="obs" class="form-control" maxlength=1000 ></textarea>
								  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
								 </div>
							  </div>
							  <div class="modal-footer">
								<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
								<input type="submit" class="btn btn-success" value='Confirmar' name="confirm" />
							  </div>
							</div>
						  </div>
						</div>
						</form>
						<?php
						}
						
						}
					?>
					
					<?php 
						if($row["status"] == "Realizado" && $clinina_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							//echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#send".$row["id"]."'> Encaminhar </button> ";
							echo "<a href='?l=".base64_encode(6)."&cl=".base64_encode($clinina_usuario)."&sp=".base64_encode($row["id_espec"])."&sp2=".base64_encode($row["espec"])."&un=".base64_encode($row["nome_paciente"])."&ui=".$row["id_paciente"]."'><button class='btn btn-block btn-primary btn-sm add-mobile'> Encaminhar </button></a>";
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
					?>
				
				
				<?php 
						if($row["status"] == "Realizado" && $row["id_paciente"] == $id_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#nota".$row["id"]."'> Avaliar </button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
						
						if($row["status"] == "Atendimento Confirmado" && $clinina_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#result".$row["id"]."'> Fornecer resultado </button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
						
						if(($row["status"] == "Aguardando Confirmação da Unidade" || $row["status"] == "Atendimento Confirmado") && $clinina_usuario){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#remarcar".$row["id"]."'> Remarcar </button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
						
						if($row["status"] != "Cancelado"){
							echo "<div class='row'>";
							echo '<div class="col-md-10">';
							echo '<div class="form-group">';
							echo "<button class='btn btn-block btn-primary btn-sm add-mobile'  data-toggle='modal' data-target='#chat".$row["id"]."'> Enviar Mensagem</button> ";
				
							echo '</div>';
							echo '</div>';
							echo "</div>";
						}
					?>
				
				<form action="" method="post" >
				<div class="modal fade" id="nota<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Avaliar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<div class="form-group">
						  <label>Nota de 1 a 5</label>
						  <input type="number" name="nota" class="form-control" max=5 min=1 required />
						  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
						 </div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Confirmar' name="avaliar" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
				<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="result<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Resultado atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<div class="form-group">
						  <label>Resultado</label>
						  <input type="text" name="resultado" required class="form-control" maxlength=1000 >
						  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
						</div>
						
						<div class="form-group">
						  <label>Anexar laudo (Opcional)</label>
						  <input type="file" name="laudo" class="form-control" />
						 
						</div>
						
						<div class="form-group">
						  <label>Observação (Máximo 1000 caracteres)</label>
						  <textarea name="obs" class="form-control" maxlength=1000 ></textarea>
						  
						</div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Confirmar' name="finalizar" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
				
				<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="chat<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Enviar mensaegm para <?php echo $row["clinica"]; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<div class="form-group">
						  <label>Observação (Máximo 500 caracteres)</label>
						  <textarea name="obs" class="form-control" maxlength=500 ></textarea>
						  <?php 
							if($clinina_usuario){
								echo '<input type="hidden" name="receptor" value="'.$row["id_paciente"].'" />';
							}else{
								$sql_us = "SELECT id FROM usuarios WHERE id_clinica=".$row["id_clinica"]." ORDER BY RAND() LIMIT 1";
								$exec_us = mysqli_query($con,$sql_us);
								$col_us = mysqli_fetch_array($exec_us);
								echo '<input type="hidden" name="receptor" value="'.$col_us["id"].'" />';
							}
						  ?>
						  
						</div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Enviar' name="send_chat" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
				<form action="" method="post" enctype="multipart/form-data" >
				<div class="modal fade" id="remarcar<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Remarcar atendimento <?php echo str_pad($row["id"] , 6 , '0' , STR_PAD_LEFT); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<div class="form-group">
						  <label>Nova Data</label>
						  <input type="date" name="data" required class="form-control" min="<?php echo date("Y-m-d");?>" />
						  <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
						  
						</div>
						
						<div class="form-group">
						  <label>Horário</label>
						  <input type="time" name="hora" required class="form-control" />
						 
						</div>
					  </div>
					  <div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Confirmar' name="remarcar" />
					  </div>
					</div>
				  </div>
				</div>
				</form>
				
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
		
        <!-- /.row -->
			
			
		<?php
				}
			}else{
				echo "<h5><u> Nenhum atendimento solicitado</u> </h5>";
			}
			
		?>

		
		
		
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->