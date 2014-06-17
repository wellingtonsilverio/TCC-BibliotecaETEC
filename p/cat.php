<style type="text/css">
#faixaTitulo{
	margin-left:10px;
	margin-right:10px;
	background-color:rgba(255, 51, 51, 0.7);
}
#faixaTitulo h1{
	padding:10px;
	padding-left:0px;
}
</style>
<div id="faixaTitulo"><h1 id="tituPag"><img src="imgs/icoLivro.png">POR CATEGORIA</h1></div>
<?php
$cid = $_GET['CID'];
$sqlUpdate = $banco->prepare("UPDATE categorias SET ctg_click = ctg_click + 1 WHERE ctg_id = ?");
$sqlUpdate->execute(array($cid));


$sqlCommanda = $banco->prepare("SELECT * FROM lvo_ctg WHERE lc_cat = ?");
$sqlCommanda->execute(array($cid));

if($lvo_ctgCat = $sqlCommanda->fetch(PDO::FETCH_NUM)){
	$sqlCommand = $banco->prepare("SELECT * FROM livro WHERE lvo_id = ? ORDER BY `lvo_titulo` DESC LIMIT 0,12");
	$sqlCommand->execute(array($lvo_ctgCat[1]));
	
	while($verNoticia = $sqlCommand->fetch(PDO::FETCH_NUM)){
		echo '	<a href="http://localhost/tcc/p/livroselect.php?liv='.$verNoticia[0].'" class="boxer" data-boxer-height="570" data-boxer-width="920">
				<div id="contLivro" style="background:url(capas/'.$verNoticia[6].'">
					<div id="contLivDesc"><div style="margin:5px;">
						<div style="text-align:center; font-weight:bold; font-size:20px;">
							'.utf8_encode(limitarC($verNoticia[1], 20)).'
						</div>
						<div style="text-align:center;">
							'.utf8_encode(limitarC($verNoticia[2], 8)).'/'.utf8_encode(limitarC($verNoticia[3], 8)).'/Estrela
						</div>
					</div>
				</div>
				   <div id="pelicula"></div>
				</div>
				</a>';
	}
}else{
	echo "<h1>Não á nenhum livro nessa Categoria.</h1>";
}

while($lvo_ctgCat = $sqlCommanda->fetch(PDO::FETCH_NUM)){
	$sqlCommand = $banco->prepare("SELECT * FROM livro WHERE lvo_id = ? ORDER BY `lvo_titulo` DESC LIMIT 0,12");
	$sqlCommand->execute(array($lvo_ctgCat[1]));
	
	while($verNoticia = $sqlCommand->fetch(PDO::FETCH_NUM)){
		echo '	<a href="http://localhost/tcc/p/livroselect.php?liv='.$verNoticia[0].'" class="boxer" data-boxer-height="570" data-boxer-width="920">
				<div id="contLivro" style="background:url(capas/'.$verNoticia[6].'">
					<div id="contLivDesc"><div style="margin:5px;">
						<div style="text-align:center; font-weight:bold; font-size:20px;">
							'.utf8_encode(limitarC($verNoticia[1], 20)).'
						</div>
						<div style="text-align:center;">
							'.utf8_encode(limitarC($verNoticia[2], 8)).'/'.utf8_encode(limitarC($verNoticia[3], 8)).'/Estrela
						</div>
					</div>
				</div>
				   <div id="pelicula"></div>
				</div>
				</a>';
	}
}

?>
