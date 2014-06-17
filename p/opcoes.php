<?php
include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();

$selectP = $banco->prepare("SELECT * FROM usuario WHERE usr_id = ?");
$selectP->execute(array($_SESSION['id']));

$selectPfetch = $selectP->fetch(PDO::FETCH_NUM);

if(isset($_POST['btn'])){
	if(isset($_POST['senha']) && $_POST['senha'] != ""){
		if(isset($_POST['csenha']) && strlen($_POST['csenha']) > 4){
			//atualizar senha
			$senha = $_POST['senha'];
			$novSenha = $_POST['csenha'];
			$id = $_SESSION['id'];
			
			$update = $banco->prepare("UPDATE `usuario` SET `usr_senha` = ? WHERE `usr_id` = ? AND `usr_senha` = ?");
			if($update->execute(array($novSenha,$id,$senha))){
				echo '<script language="javascript">alert("Senha alterada com sucesso.");</script>';				
			}else{
				echo '<script language="javascript">alert("Senha incorreta.");</script>';
			}
			$senha = $_POST['csenha'];
		}else{
			$senha = $_POST['senha'];
		}
		if(isset($_POST['email']) || isset($_POST['nick'])){
			//atualizar o resto
			$id = $_SESSION['id'];
			$nick = $_POST['nick'];
			$email = $_POST['email'];
			
			$update = $banco->prepare("UPDATE `usuario` SET `usr_nick` = ?, `usr_email` = ? WHERE `usr_id` = ? AND `usr_senha` = ?");
			if($update->execute(array($nick,$email,$id,$senha))){
				header('location: opcoes.php');
			}else{
				echo '<script language="javascript">alert("Senha incorreta.");</script>';
			}
		}
	}else{
		echo '<script language="javascript">alert("Você não digitou a senha.");</script>';
	}
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Opções</title>
<style type="text/css">
input[type=text],input[type=password]{
	width:400px;
}
p{
	padding-left:5px;
	margin-bottom:-1px;
}
</style>
</head>
Opções do usuário
<form method="post">
  <p>Nick:</p> <input name="nick" type="text" id="nick" value="<?php echo $selectPfetch[1]; ?>" />
   <p>E-mail:</p> 
  <input type="text" id="email" name="email" value="<?php echo $selectPfetch[3]; ?>" />
  <p>Senha:</p> <input type="password" id="senha" name="senha" value="" />
  <p>Nova Senha:</p> <input type="password" id="csenha" name="csenha" value="" />
  <p><input name="btn" type="submit" id="btn" value="Alterar" /></p>
</form>
<body>
</body>
</html>