<?php
include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();

$id = $_SESSION['id'];

$selectMensagem = $banco->prepare("SELECT * FROM `mensagens` WHERE `msg_usr_r` = ? ORDER BY `msg_id` DESC");
$selectMensagem->execute(array($id));

$selectUser = $banco->prepare("SELECT * FROM `usuario` WHERE `usr_id` = ?");

if(isset($_POST['btnE'])){
	$hid = $_POST['hid'];
	
	$delet = $banco->prepare("DELETE FROM `mensagens` WHERE `msg_id` = ?");
	if($delet->execute(array($hid))){
		header('Location: mensagem.php');
	}
	
}

if(isset($_POST['titulo'])){
	
	$idR = $_POST['rec'];
	$idM = $_SESSION['id'];
	$titulo = $_POST['titulo'];
	$men = $_POST['men'];
	
	$insert = $banco->prepare("INSERT INTO `bibliotecaetec`.`mensagens` (`msg_id`, `msg_usr_r`, `msg_usr_m`, `msg_mensagem`, `msg_titulo`, `msg_data`) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP);");
	$insert->execute(array($idR,$idM,$men,$titulo));
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mensagem</title>
<link rel="stylesheet" type="text/css" href="../css/padrao.css" />
<style type="text/css">
#btnC{
	width:100%;
	padding-bottom:20px;
	padding-top:20px;
	background-color:#800507;
	text-align:center;
	font-size:24px;
	margin-bottom:10px;
}
a:hover{
	cursor:pointer;
}
#criarMensagem{
	text-align:center;
}
#criarMensagem textarea{
	width:93%;
}
#criarMensagem select{
	margin-left:-15px;;
}
#criarMensagem input, select{
	width:45%;
	border-radius:4px;
	border:none;
	box-shadow:0 0 3px #727272;
	margin:5px;
	padding:5px;
}
#criarMensagem input[type=submit]{
	width:100%;
	border:none;
	box-shadow:none;
	border-radius:0;
	margin:0;
	padding:20px;
	margin-bottom:15px;
}
#mensagens{
	border-bottom:4px solid #8A2022;
	padding-bottom:3px;
	margin-bottom:3px;
}

#mensagens div{
	float:left;
	width:50%;
	padding-bottom:5px;
}
#mensagens section{
	width:100%;
	text-align:center;
	color:#A4A4A4;
}
</style>
</head>
<body>
<div id="criarMensagem">
<form method="post" id="form" name="form">
<select id="rec" name="rec">
<?php

$selectUserF = $banco->prepare("SELECT * FROM `usuario` WHERE `usr_tipo` = '2'");
$selectUserF->execute();

while($useF = $selectUserF->fetch(PDO::FETCH_NUM)){
	echo '<option value="'.$useF[0].'">'.$useF[4].'</option>';
}
?>

</select>
<input type="text" placeholder="Titulo:" id="titulo" name="titulo" /><br>
<textarea id="men" name="men">
</textarea>
<input type="submit" value="CRIAR UMA NOVA MENSAGEM" />
</form>
</div>
<?php
while($mensagem = $selectMensagem->fetch(PDO::FETCH_NUM)){
	$selectUser->execute(array($mensagem[2]));
	$user = $selectUser->fetch(PDO::FETCH_NUM);
	echo '
<div id="mensagens">
<form method="post">
<input type="hidden" id="hid" name="hid" value="'.$mensagem[0].'" />
<div>'.$user[4].'</div><div style="font-weight:bold;">'.$mensagem[4].'</div>
<p>Mensagem:<br>
'.utf8_encode($mensagem[3]).'
</p>
<section>'.$mensagem[5].'</section>
<input type="submit" id="btnE" name="btnE" value="Deletar mensagem" />
</form>
</div>
';
}
?>
</body>
</html>