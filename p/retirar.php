<?php
include('../include/conexao.php');
include('../include/funcoes.php');


$banco = Conexao::conectarBanco();

$liv = $_GET['liv'];
if(isset($_SESSION['id'])){
	$user = $_SESSION['id'];
}else{
	echo '<script language="javascript">alert("Você precisa estar logado para retirar um livro");</script>';
	break;
}

$select = $banco->prepare("SELECT * FROM `livro` WHERE `lvo_id` = ?");
$select->execute(array($liv));
$livro = $select->fetch(PDO::FETCH_NUM);

$selectU = $banco->prepare("SELECT * FROM `usuario` WHERE `usr_id` = ?");
$selectU->execute(array($user));
$users = $selectU->fetch(PDO::FETCH_NUM);

$d = date('Ymd');

$res = "";

if(isset($_POST['btnRetirar'])){
	if(isset($_POST['cbLi'])){
		
		$selectL = $banco->prepare("SELECT * FROM `alugar` WHERE `alg_usr` = ? AND `alg_status` = '1' ORDER BY `alg_id` DESC");
		$selectL->execute(array($user));
		
		if(!$alugarLivro = $selectL->fetch(PDO::FETCH_NUM)){
			do{
			$lid = $liv;
			$uid = $user;
			$ent = $_POST['listData'];
			$idR = rand(111111111,999999999);
			
			$insert = $banco->prepare("INSERT INTO `bibliotecaetec`.`alugar` (`alg_id`, `alg_lvo`, `alg_usr`, `alg_entrega`, `alg_status`) VALUES (?, ?, ?, ?, '1');");
			}while(!$insert->execute(array($idR,$lid,$uid,$ent)));
			$update = $banco->prepare("UPDATE `livro` SET `lvo_disp` = '0' WHERE `lvo_id` = ?");
			if($update->execute(array($lid))){
				header('Location: rfinal.php?cod='.$idR);
			}
		}else{
			$res = "Você já esta com um livro alugado, ou pendente para devolução.";
		}
		
	}else{
		$res = "Confirme e leia os codigos de emprestimo de livros.";
	}
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Retirar</title>
<style type="text/css">
input[type=text]{
	margin-top:-20px;
	width:400px;
}
p{
	padding-left:5px;
}
</style>
</head>

<body>
<form method="post">
<p>Nome:</p><input name="txtNome" type="text" id="txtNome" value="<?php echo utf8_encode($users[4]); ?>" readonly="true">
<p>Série/Sala:</p><input name="txtSala" type="text" id="txtSala" value="<?php echo utf8_encode($users[6]); ?>" readonly="true">
<p>Nome do livro:</p><input name="txtNomeL" type="text" id="txtNomeL" value="<?php echo utf8_encode($livro[1]); ?>" readonly="true">
<p>data de devolução:</p><select name="listData" id="listData">
<option><?php 
$d = addDayIntoDate($d,6);
echo $d[6].$d[7]."/".$d[4].$d[5]."/".$d[0].$d[1].$d[2].$d[3];
?></option>
<option><?php 
$d = addDayIntoDate($d,7);
echo $d[6].$d[7]."/".$d[4].$d[5]."/".$d[0].$d[1].$d[2].$d[3];
?></option>
</select>
<textarea id="normas" style="float:right; height:500px; width:50%; margin-top:-200px;">
Normas da Biblioteca:
1. Não é permitida a utilização de qualquer aparelh
o eletrônico: aparelhos de som, celular, mp3,
entre outros.
2. Não é permitido ingerir qualquer alimento ou beb
idas no seu interior.
3. Os livros de consulta (permanentes), não poderão
ser retirados, exceto para trabalhos em
classe, desde que haja autorização prévia do coorde
nador da área.
4. Será estabelecida uma multa diária, para o aluno
que não devolver o livro no prazo previsto. No
caso de danificação ou perda de livros a pessoa dev
erá indenizar a biblioteca com o mesmo
livro de edição igual ou posterior, caso o mesmo es
teja esgotado nas livrarias, o coordenador
de área deverá sugerir um novo título de igual teor
para substituir o mesmo.
5. Os livros da Biblioteca circulantes ou de leitur
a poderão ser retirados por um período de 07
(sete) dias, desde que não haja lista de presença.
6. Caso o aluno apresente 03 (três) atrasos no mesm
o semestre ficará impossibilitado de retirar
livros na biblioteca, sendo apenas facultada a cons
ulta local dos mesmos.
7. Ex-alunos ou membros da comunidade poderão consu
ltar livros, desde que devidamente
autorizados pelos coordenadores de área. É vedado o
empréstimo de Livros para alunos
matriculados apenas no estágio obrigatório, bem com
o as pessoas supracitadas neste
parágrafo.
8. O aluno que retirar um livro para colega ou quai
squer pessoa, será responsável pelo(s)
mesmo(s) e arcará com as devidas responsabilidades
em caso de infração citadas no
parágrafo 04.
9. O aluno contribuinte à APM da escola estará auto
maticamente inscrito como sócio na
biblioteca, devendo apenas entregar uma foto 3x4 re
cente. Os demais alunos deverão
contribuir com a Taxa simbólica de R$ 5,00 (cinco r
eais) para associar-se a Biblioteca, bem
como trazer uma foto 3x4 recente.
10. A duração da inscrição do aluno na biblioteca v
ale durante um ano letivo em curso, sendo
necessária a renovação no ano posterior. Observação
: Alunos dos 3º Módulo do Ensino
Técnico terão suas inscrições cessadas no final do
semestre de conclusão de seu respectivo
curso. 
</textarea>
<p><input name="cbLi" type="checkbox" id="cbLi">li e aceitos os codigos de emprestimo de livros.</p>
<p style="color:#A70002;"><?php echo $res; ?></p>
<p><input name="btnRetirar" type="submit" id="btnRetirar" value="Concluir retirada"></p>
</form>
</body>
</html>
