<?php
class Livro{
	function selectPescLivro($banco){
		return $sqlCommand = $banco->prepare("SELECT * FROM livro WHERE lvo_titulo like ? OR lvo_autor like ? OR lvo_editora like ? OR lvo_des like ? ORDER BY `lvo_id` DESC LIMIT 0,12");
	}
	
	function selectLivro($banco){
		return $sqlCommand = $banco->prepare("SELECT * FROM livro ORDER BY `lvo_id` DESC LIMIT 0,12");
	}
	
	function getLivro($banco, $verNoticia){
		//Verificar o banco
		$selectCa = $banco->prepare("SELECT * FROM `avalicomenta` WHERE `avl_lvo` = ?");
		$selectCa->execute(array($verNoticia[0]));
		
		//Variaveis zeradas
		$mediaA = 0;
		$estrela = "";
		
		//Gerar estrelas na variavel $estrela
		while($comenti = $selectCa->fetch(PDO::FETCH_NUM)){
			$mediaA = ($mediaA + $comenti[3]);
		}
		if($mediaA == 0){
			$mediaA = 0;
		}else{
			$mediaA = $mediaA / $selectCa->rowCount();
		}
		if($mediaA > 0){
			$estrela .= '<img src="estrela.png" />';
		}else{
			$estrela .= '<img src="estrelaN.png" />';
		}
		if($mediaA > 1){
			$estrela .= '<img src="estrela.png" />';
		}else{
			$estrela .= '<img src="estrelaN.png" />';
		}
		if($mediaA > 2){
			$estrela .= '<img src="estrela.png" />';
		}else{
			$estrela .= '<img src="estrelaN.png" />';
		}
		if($mediaA > 3){
			$estrela .= '<img src="estrela.png" />';
		}else{
			$estrela .= '<img src="estrelaN.png" />';
		}
		if($mediaA > 4){
			$estrela .= '<img src="estrela.png" />';
		}else{
			$estrela .= '<img src="estrelaN.png" />';
		}
		
		//Retorna HTML do Livro
		return '	<a href="http://localhost/tcc/p/livroselect.php?liv='.$verNoticia[0].'" class="boxer" data-boxer-height="600" data-boxer-width="920">
				<div id="contLivro" style="background-image:url(capas/'.$verNoticia[6].'); background-size:240px;">
					<div id="contLivDesc"><div style="margin:5px;">
						<h1>
							'.utf8_encode(limitarC($verNoticia[1], 20)).'
						</h1>
						<div style="text-align:center;" id="star">
							'.utf8_encode(limitarC($verNoticia[2], 8)).'/'.utf8_encode(limitarC($verNoticia[3], 8)).'/ '.$estrela.' 
						</div>
					</div>
				</div>
				   <div id="pelicula"></div>
				</div>
				</a>';
	}
}
?>
