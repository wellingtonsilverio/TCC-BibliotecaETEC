<?php
include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();

$id = $_SESSION['id'];

$uid = $_GET['uid'];
$lid = $_GET['lid'];

if($uid != $id){
	break;
}

$selectL = $banco->prepare("SELECT * FROM `livro` WHERE `lvo_id` = ?");
$selectL->execute(array($lid));
$selectLivro = $selectL->fetch(PDO::FETCH_NUM);

if(isset($_POST['nao'])){
	$selectMensagem = $banco->prepare("DELETE FROM `ped_alu` WHERE `pal_usr` = ? AND `pal_lvo` = ?");
	if($selectMensagem->execute(array($uid,$lid))){
		echo '<h1>Você optou por não avaliar, Obrigado!</h1><br />Feche esta janela, clicando em qualquer espaço ou no X.';
		break;
	}
}
if(isset($_POST['enviar'])){
	$ava = $_POST['listAvaliacao'];
	$coment = $_POST['coment'];
	$selectMensagem = $banco->prepare("INSERT INTO `avalicomenta` (avl_usr, avl_lvo, avl_avaliacao, avl_comentario) VALUES (?, ?, ?, ?)");
	if($selectMensagem->execute(array($uid,$lid, $ava, $coment))){
		echo '<h1>Avaliação feita com sucesso!, Obrigado!</h1><br />Feche esta janela, clicando em qualquer espaço ou no X.';
		$selectMensagem = $banco->prepare("DELETE FROM `ped_alu` WHERE `pal_usr` = ? AND `pal_lvo` = ?");
		$selectMensagem->execute(array($uid,$lid));
		break;
	}
}

?>
<form method="post">
<h1>Avaliação do estado físico do livro <?php echo $selectLivro['1']; ?> entregue:</h1>
Nota:<select name="listAvaliacao" id="listAvaliacao" style="margin:10px;"><option>1</option><option>2</option><option>3</option><option>4</option><option selected>5</option></select>
<br />
Comentario:<br />
<textarea id="coment" name="coment" style="width:45%; margin:10px; float:left; height:100px;">
</textarea>
<input type="submit" id="enviar" name="enviar" value="Enviar avaliação" style="width:50%; background:#000055; border:none; padding-top:10px; padding-bottom:10px; margin-top:70px; float:right;" />
<br />
<input type="submit" id="nao" name="nao" value="Não avaliar" style="width:100%; background:#000055; border:none; padding-top:10px; padding-bottom:10px; margin-top:10px;" /> 
</form>
