<?php

include('include/conexao.php');
include('include/funcoes.php');


$banco = Conexao::conectarBanco();


?>

<!DOCTYPE HTML>
<html>
<head>
<title>Biblioteca ETEC Hortolândia</title>
<meta charset="utf-8">
<LINK REL="SHORTCUT ICON" HREF="imgs/logobeta.png"> 
<link rel="stylesheet" type="text/css" href="css/padrao.css" />
<!-- Jquery Box popup -->
		<script src="js/demo.js"></script>

		<link href="css/jquery.fs.boxer.css" rel="stylesheet" type="text/css" media="all" />
		<script src="js/jquery.fs.boxer.js"></script>

		<script>
			$(document).ready(function(e) {

				$(".boxer").not(".retina, .boxer_fixed, .boxer_top, .boxer_format, .boxer_mobile, .boxer_object").boxer({
					top: 50
				});

				$(".boxer.boxer_fixed").boxer({
					fixed: true
				});

				$(".boxer.boxer_top").boxer({
					top: 50
				});

				$(".boxer.retina").boxer({
					retina: true
				});

				$(".boxer.boxer_format").boxer({
					formatter: function($target) {
						return '<h3>' + $target.attr("title") + "</h3>";
					}
				});

				$(".boxer.boxer_object").click(function(e) {
					e.preventDefault();
					e.stopPropagation();

					$.boxer( $('<div class="inline_content"><h2>More Content!</h2><p>This was created by jQuery and loaded into the new Boxer instance.</p></div>') );
				});

				$(".boxer.boxer_mobile").boxer({
					mobile: true
				});
			});

function tamanho(div,hdiv) {
	if($("#"+div).width() == 300){
		$("#"+hdiv).hide();
		$("#"+div).width(100);
	}else{
		$("#"+div).width(300);
		$("#"+hdiv).show();
	}
}
window.onload = function(){
	$("#hfluLog").hide(0);
	$("#hfluPesq").hide(0);
	$("#hfluCat").hide(0);
	$("#hfluLiv").hide(0);
}

</script> 

</head>
<body>
	<!--Barra superior-->
	<div id="topper">
    </div>
	<div id="topperDiv">
    	<img src="imgs/logobeta.png" />
        <div id="menu-t">
            <a href="index.php">HOME</a>
            <a href="index.php?p=livro">LIVROS</a>
            <a href="index.php?p=sugestoes">SUGESTÕES</a>
            <a href="http://www.etechortolandia.com.br/novo/" target="_blank">ETEC</a>
            <a href="index.php?p=biblioteca">BIBLIOTECA</a>
            <a href="empresa" target="_blank">EXTENDSD&amp;C</a>
        </div>
    </div>
	<!--Fim da barra-->
	
	<!--Itens do menu na barra superior-->
	
	<div id="conteudo">
    
    <?php
		
if(isset($_GET['p'])){
			include('p/'.$_GET['p'].'.php');
		}else{
			include('p/home.php');
		}
	?>
    
</div>
<div id="footer">
	<div id="footDiv">
		<div id="footerdiv" align="center"> Copyright © 2014 - <a href="empresa" target="_blank">ExtendsD&amp;C</a> - TCC </div>
    </div>
</div>
<?php include('flut.php');?>
</body>
</html>
