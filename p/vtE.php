<?php
include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Categorias</title>
<style type="text/css">
#linkCE{
	float:left;
	width:23%;
	margin:1%;
	padding-bottom:30px;
	padding-top:30px;
	background-color:#B9090C;
	text-align:center;
	border-bottom:4px solid #600304;
	color:#FFFFFF;
}
a{
	color:#000000;
	text-decoration:none;
}
</style>
</head>

<body>
<h1>Estantes</h1>
<?php
    $selec = $banco->prepare("SELECT * FROM `estante`");
	$selec->execute();
	
	while($selecFetch = $selec->fetch(PDO::FETCH_NUM)){
		echo "<a href='../index.php?p=est&amp;EID=".$selecFetch[0]."' target='_parent'><div id='linkCE'>".utf8_encode($selecFetch[1])."</div></a>";
	}
	?>
</body>
</html>