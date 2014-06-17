<?php
if(isset($_SESSION['id'])){
	$nick = $_SESSION['nick'];
	$senha = $_SESSION['senha'];
	$select = $banco->prepare("SELECT * FROM usuario WHERE usr_nick = ? AND usr_senha = ?");
	$select->execute(array($nick, $senha));
	
	if($verUsusario = $select->fetch(PDO::FETCH_ASSOC)){
	}else{
		session_destroy();
		header('Location: index.php');
	}
	
}else if(isset($_POST['nick'])){
	
	$nick = $_POST['nick'];
	$senha = $_POST['senha'];
	$select = $banco->prepare("SELECT * FROM usuario WHERE usr_nick = ? AND usr_senha = ?");
	$select->execute(array($nick, $senha));
	
	if($verUsusario = $select->fetch(PDO::FETCH_NUM)){
		$_SESSION['id'] = $verUsusario[0];
		$_SESSION['nick'] = $nick;
		$_SESSION['senha'] = $senha;
	}else{
		echo '<script language="javascript">alert("Login ou Senha incorreto.");</script>';
		header('Location: index.php');
	}
}



?>
<div id="flutuante">
    <div id="fluLog" class="fluDiv">
    <img src="imgs/icoLogin.png" style="margin-top:17px;" OnClick="tamanho('fluLog','hfluLog');" title="Painel / Login" />
    <div id="hfluLog" style="margin-top:3px;">
    <?php
    if(isset($_SESSION['id'])){
    	include('include/painel.php');
    }else{
    	echo'<form method="post"><input type="text" placeholder="nickname" id="nick" name="nick" /><input type="password" placeholder="senha" id="senha" name="senha" /><input type="submit" /></form>';
	}
	?>
    </div>
    </div>
    <div id="fluPesq" class="fluDiv">
    <img src="imgs/icoPesquisa.png" OnClick="tamanho('fluPesq','hfluPesq');" title="Pesquisa" />
    <div id="hfluPesq"><form method="get"><input type="text"  id="search" placeholder="pesquisa" name="search" /><input type="submit" style="background:#9F0002; display:none;" /></form></div>
    </div>
    <div id="fluCat" class="fluDiv">
    <img src="imgs/icoCategoria.png" OnClick="tamanho('fluCat','hfluCat');" title="Categorias" />
    <div id="hfluCat"><div>
    <?php
    $selec = $banco->prepare("SELECT * FROM `categorias` ORDER BY `ctg_click` DESC LIMIT 0,6");
	$selec->execute();
	
	while($selecFetch = $selec->fetch(PDO::FETCH_NUM)){
		echo "<a id='linkCE' href='index.php?p=cat&amp;CID=".$selecFetch[0]."'>".utf8_encode($selecFetch[1])."</a> ";
	}
	?>
    </div> <a href="http://localhost/tcc/p/vtC.php" class="boxer" data-boxer-height="600" data-boxer-width="500"><div style="margin-bottom:5px; margin-right:5px; margin-left:200px; text-align:center; padding:5px; background-color:#D7272A;">VER TUDO</div></a></div>
    </div>
    <div id="fluLiv" class="fluDiv">
    <img src="imgs/icoLivro.png" OnClick="tamanho('fluLiv','hfluLiv');" title="Estantes de Livros" />
    <div id="hfluLiv"><div>
    <?php
    $seleca = $banco->prepare("SELECT * FROM `estante` LIMIT 0,6");
	$seleca->execute();
	
	while($selecFetcha = $seleca->fetch(PDO::FETCH_NUM)){
		echo "<a id='linkCE' href='index.php?p=est&amp;EID=".$selecFetcha[0]."'>".utf8_encode($selecFetcha[1])."</a> ";
	}
	?>
    </div> <a href="http://localhost/tcc/p/vtE.php" class="boxer" data-boxer-height="600" data-boxer-width="500"><div style="margin-bottom:5px; margin-right:5px; margin-left:200px; text-align:center; padding:5px; background-color:#D7272A;">VER TUDO</div></a></div>
    </div>
</div>
