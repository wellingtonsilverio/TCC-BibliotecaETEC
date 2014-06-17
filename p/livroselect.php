<?php

include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();
	
$liv = $_GET['liv'];

$select = $banco->prepare("SELECT * FROM `livro` WHERE lvo_id = ?");
$select->execute(array($liv));

$livro = $select->fetch(PDO::FETCH_NUM);

?>
<style type="text/css">
#divl img{
	width:330px;
}
div#btnLL{
	margin-left:60px;
}
#btnLL{
	background:#000055;
	padding:10px;
	margin:5px;
	width:400px;
	color:#FFF;
	text-align:center;
}
h1{
	
}
h2{
	line-height:none;
	text-height:0;
	margin:0;
	padding:0;
}
h3{
	line-height:none;
	text-height:0;
	margin:3px;
	padding:0;
}
#coment{
	background-color:#DB2528;
	padding:10px;
	margin:5px;
	height:65px;
	color:#FFFFFF;
}
a{
	color:#B90003;
	text-decoration:none;
}
#foto div{ background:#45515C; padding-right:15px; }
#foto div img{ width:45px; margin:3px; margin-top:10px; margin-bottom:10px; margin-left:15px; }
</style>
<div id="divl" style="float:left; width:360px;">
<div id="foto">
<img src="../capas/<?php echo $livro[6]; ?>" />
<div style=" width:180px; display:inline-table;">
<?php

$selectCa = $banco->prepare("SELECT * FROM `avalicomenta` WHERE `avl_lvo` = ?");
$selectCa->execute(array($liv));
$mediaA = 0;

while($comenti = $selectCa->fetch(PDO::FETCH_NUM)){
	$mediaA = ($mediaA + $comenti[3]);
}
if($mediaA == 0){
	$mediaA = 0;
}else{
	$mediaA = $mediaA / $selectCa->rowCount();
}
if($mediaA > 0){
	echo '<img src="../estrela.png" />';
}else{
	echo '<img src="../estrelaN.png" />';
}
if($mediaA > 1){
	echo '<img src="../estrela.png" />';
}else{
	echo '<img src="../estrelaN.png" />';
}
if($mediaA > 2){
	echo '<img src="../estrela.png" />';
}else{
	echo '<img src="../estrelaN.png" />';
}
if($mediaA > 3){
	echo '<img src="../estrela.png" />';
}else{
	echo '<img src="../estrelaN.png" />';
}
if($mediaA > 4){
	echo '<img src="../estrela.png" />';
}else{
	echo '<img src="../estrelaN.png" />';
}
?>
</div>

</div>
<h3>Categorias</h3>
<?php
$selectRel = $banco->prepare("SELECT * FROM lvo_ctg WHERE lc_livro = ?");
$selectRel->execute(array($livro[0	]));
while($idCat = $selectRel->fetch(PDO::FETCH_NUM)){
	$selectCat = $banco->prepare("SELECT * FROM categorias WHERE ctg_id = ? ORDER BY `ctg_click` DESC");
	$selectCat->execute(array($idCat[2]));
	$cate = $selectCat->fetch(PDO::FETCH_NUM);
	
	echo "<a style='margin:10px; color:#000; text-decoration:none; text-transform:uppercase;' href='../index.php?p=cat&amp;CID=".$cate[0]."' target='_parent'>".$cate[1]."</a>";
}
?>
<h3>Estante</h3>
<?php $Eid = $livro[7];
$seleE = $banco->prepare("SELECT * FROM `estante` WHERE `ett_id` = ?");
$seleE->execute(array($Eid));
$estante = $seleE->fetch(PDO::FETCH_NUM);
echo utf8_encode($estante[1]);
 ?>
</div>

<div style="float:right; width:525px;">
<h2 style="text-transform:uppercase; padding-top:40px; font-size:50px;"><?php echo utf8_encode($livro[1]); ?></h2>
<h3><?php echo utf8_encode($livro[2]); ?> / <?php echo utf8_encode($livro['3']); ?></h3>
<br />
<h1 style="font-size:18px;">Sinopse:</h1>
<?php echo utf8_encode($livro[5]); ?>
<div style="width:340px;">
    <?php
    if(isset($_SESSION['id'])){
		if($livro[4] == 1){
			echo '<a href="retirar.php?liv='.$liv.'"><input  id="btnLL" type="button" style="margin:10px; margin-left:50px; padding-left:150px; padding-right:150px;" value="RETIRAR LIVRO" /></a>';
		}else if($livro[4] == 0){
			//Selecionar a tabela Alugar, onde procura pelo id do Livro, o primeiro adicionado e ativo
			$selectL = $banco->prepare("SELECT * FROM `alugar` WHERE `alg_lvo` = ? AND `alg_status` = '1' ORDER BY `alg_id` DESC");
			$selectL->execute(array($livro[0]));
			$alugarLivro = $selectL->fetch(PDO::FETCH_NUM);
			
			//selecionar o usuario, que alugou o livro, da tabela Aluga.
			$selectU = $banco->prepare("SELECT * FROM `usuario` WHERE `usr_id` = ?");
			$selectU->execute(array($alugarLivro[2]));
			$userA = $selectU->fetch(PDO::FETCH_NUM);
			
			echo "<div id='btnLL'>livro com ".$userA[4].", até ".$alugarLivro[3]."</div>";
		}
	}else{
		echo '<div id="btnLL">Você precisa estar logado para retirar algum livro.</div>';
	}
	?>
</div>
<h3>Comentarios</h3>
<?php
$selectC = $banco->prepare("SELECT * FROM `avalicomenta` WHERE `avl_lvo` = ? ORDER BY `avl_id` DESC LIMIT 0,3");
$selectC->execute(array($liv));
while($coment = $selectC->fetch(PDO::FETCH_NUM)){
	
	$selectUC = $banco->prepare("SELECT * FROM `usuario` WHERE `usr_id` = ?");
	$selectUC->execute(array($coment[1]));
	$usr = $selectUC->fetch(PDO::FETCH_NUM);
	
	echo '<div id="coment"><h2>'.$usr[4].' / '.$coment[3].' pontos</h2>'.utf8_encode($coment[4]).'</div>';
}
?>
</div>
