<?php 

	if(isset($_GET["l"])){
		$link = base64_decode($_GET["l"]);
		$pag[1]="pages/atendimentos/consulta.php";
		$pag[4]="pages/atendimentos/novo.php";
		$pag[2]="helpdesk/consulta.php";
		$pag[3]="perfil/consulta.php";
		$pag[5]="pages/atendimentos/espec.php";
		$pag[6]="pages/atendimentos/solicitacao.php";
		$pag[7]="pages/chamados/call.php";
		$pag[8]="pages/cadastro/unidades.php";
		$pag[9]="pages/cadastro/usuarios.php";
		$pag[10]="pages/perfil/clinica.php";
		$pag[11]="pages/perfil/usuario.php";
		$pag[12]="pages/chat/list.php";

	}

	if(!empty($link))
	{			
		if (file_exists($pag[$link]))
		{
			
			include $pag[$link];
			
		}
		else
		{
			print "a pagina nao foi encontrada";
		}
			
	}else{
		include "notificacoes.php";
	}
?>
	
 