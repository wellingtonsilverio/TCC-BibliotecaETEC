<?php
$selectP = $banco->prepare("SELECT * FROM usuario WHERE usr_id = ?");
$selectP->execute(array($_SESSION['id']));

$selectPfetch = $selectP->fetch(PDO::FETCH_NUM);
$selectALU = $banco->prepare("SELECT * FROM ped_alu WHERE pal_usr = ? AND pal_status = '1'");
$selectALU->execute(array($_SESSION['id']));
if($selectALUfetch = $selectALU->fetch(PDO::FETCH_NUM)){
	echo '<a href="http://localhost/tcc/p/alavaliar.php?uid='.$selectALUfetch[1].'&lid='.$selectALUfetch[2].'&" class="boxer" data-boxer-height="400" data-boxer-width="600" id="avaliar"></a>';
	echo '<script>window.onload = function(){ $("#hfluLog").hide(); $("#avaliar").click(); }</script>';
}

?>
<div style="margin-top:-15px;">
<a href="http://localhost/tcc/p/mensagem.php" class="boxer" data-boxer-height="600" data-boxer-width="500"><div id="paiIco"><img src="mensagens.png" /><div>MENSAGENS (0)</div></div></a>
<a href="http://localhost/tcc/p/lista.php" class="boxer" data-boxer-height="600" data-boxer-width="800"><div id="paiIco"><img src="documento.png" /><div>LISTA DE ESPERA</div></div></a>
<a href="http://localhost/tcc/p/opcoes.php" class="boxer" data-boxer-height="320" data-boxer-width="430"><div id="paiIco"><img src="editar.png" /><div>ALTERAR CONTA</div></div></a>
<a href="sair.php"><div id="paiIco"><img src="sair2.png" /><div>SAIR</div></div></a>
</div>

