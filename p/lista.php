<?php
include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();

$id = $_SESSION['id'];

$selecLis = $banco->prepare("SELECT * FROM `alugar` WHERE `alg_usr` = ?");
$selecLis->execute(array($id));

$selecLiv = $banco->prepare("SELECT * FROM `livro` WHERE `lvo_id` = ?");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista</title>
<style type="text/css">
#data{
	float:right;
	text-align:center;
}
#nome{
	float:left;
}
h1{
	margin:5px;
	padding-right:10px;
}
h2, h3{
	margin:10px;
	padding-left:10px;
}
</style>
</head>
<body>
<?php
while($alug = $selecLis->fetch(PDO::FETCH_NUM)){
	$selecLiv->execute(array($alug[1]));
	$liv = $selecLiv->fetch(PDO::FETCH_NUM);
	
	$cor = "#D5D5D5";
	$data = $alug[3][6].$alug[3][7].$alug[3][8].$alug[3][9].$alug[3][3].$alug[3][4].$alug[3][0].$alug[3][1];
	if($data < date('Ymd')){
		if($alug[4] < 1){
			$stt = "ja entregue";
			$cor = "#1ED738";
		}else{
			$stt = "atrazado";
			$cor = "#DC3235";
		}
	}else{
		$stt = "em dia";
	}
	
	echo '
<div style="width:100%; height:80px; background:'.$cor.'; margin-bottom:5px; float:left;">
	<div id="nome"><h2>'.utf8_encode($liv[1]).'</h2><h3>'.utf8_encode($liv[2]).' - '.utf8_encode($liv[3]).'</h3></div> <div id="data"><h1>'.$alug[3].'</h1> '.$stt.' </div>
    
</div>
';
}
?>
</body>
</html>