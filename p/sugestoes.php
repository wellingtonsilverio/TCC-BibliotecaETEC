﻿<style type="text/css">
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
<?php
if(isset($_POST['btn'])){
	$nome = $_POST['nome'];
	$em = $_POST['em'];
	$out = $_POST['out'];
	$txt = $_POST['txt'];
	
	$insertS = $banco->prepare("INSERT INTO `bibliotecaetec`.`sugestoes` (`sgt_id`, `sgt_nome`, `sgt_email`, `sgt_oinf`, `sgt_text`, `sgt_date`) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP);");
	if($insertS->execute(array($nome,$em,$out,$txt))){
		echo '<script language="javascript">alert("Sugestões enviada com sucesso.");</script>';
	}
	
}
?><div id="faixaTitulo"><h1 id="tituPag"><img src="imgs/tabela.png">SUGESTÕES PARA O SISTEMA</h1></div>
<div id="sug">
    <form method="post">
        <input type="text" id="nome" name="nome" placeholder="Nome completo" style="width:1000px;" />    
        <input type="text" id="em" name="em" placeholder="E-mail" style="width:1000px;" />
        <input type="text" id="out" name="out" placeholder="Outras Informações" style="width:1000px;" />
        <textarea name="txt" id="txt" style="width:1000px;">
        </textarea>
        <input type="submit" id="btn" name="btn" value="Enviar Sugestão" style="width:500px;" />
    </form>
</div>
