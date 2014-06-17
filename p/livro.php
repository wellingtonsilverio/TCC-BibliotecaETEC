<?php
include('include/livro.class.php');
$livro = new Livro;
?>
<style type="text/css">
#star img{
	width:11px;
	margin:1px;
}
#dic a:hover{
	transition:all 0.7s;
	color:#6F0C0D;
}
#dic a{
	margin:10px;
	color:#000000;
}
#dic{
	font-size:29px;
	margin:15px;
	margin-bottom:0;
	margin-top:0;
	background-color:#AA1E23;
	margin-left:13px;
	margin-right:10px;
	padding:5px;
	padding-left:5px;
	position:fixed;
	margin-top:-170px;
	z-index:3;
	opacity:0.9;
}
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
<div id="faixaTitulo"><h1 id="tituPag"><img src="imgs/livro2.png">LIVROS POR ORDEM ALFABETICA</h1></div>
<div id="dic"><a href="index.php?p=livro&amp;l=a">A</a><a href="index.php?p=livro&amp;l=b">B</a><a href="index.php?p=livro&amp;l=c">C</a><a href="index.php?p=livro&amp;l=d">D</a><a href="index.php?p=livro&amp;l=e">E</a><a href="index.php?p=livro&amp;l=f">F</a><a href="index.php?p=livro&amp;l=g">G</a><a href="index.php?p=livro&amp;l=h">H</a><a href="index.php?p=livro&amp;l=i">I</a><a href="index.php?p=livro&amp;l=j">J</a><a href="index.php?p=livro&amp;l=k">K</a><a href="index.php?p=livro&amp;l=l">L</a><a href="index.php?p=livro&amp;l=m">M</a><a href="index.php?p=livro&amp;l=n">N</a><a href="index.php?p=livro&amp;l=o">O</a><a href="index.php?p=livro&amp;l=p">P</a><a href="index.php?p=livro&amp;l=q">Q</a><a href="index.php?p=livro&amp;l=r">R</a><a href="index.php?p=livro&amp;l=s">S</a><a href="index.php?p=livro&amp;l=t">T</a><a href="index.php?p=livro&amp;l=u">U</a><a href="index.php?p=livro&amp;l=v">V</a><a href="index.php?p=livro&amp;l=w">W</a><a href="index.php?p=livro&amp;l=y">Y</a><a href="index.php?p=livro&amp;l=z">Z</div>
    <?php 

	if(isset($_GET['l'])){
		$letra = $_GET['l'];
		$sqlCommand = $banco->prepare("SELECT * FROM livro WHERE lvo_titulo like ? ORDER BY `lvo_titulo` ASC LIMIT 0,12");
		$sqlCommand->execute(array($letra.'%'));
	}else{
		$sqlCommand = $banco->prepare("SELECT * FROM livro ORDER BY `lvo_titulo` ASC LIMIT 0,12");
		$sqlCommand->execute();
	}
	
	while($verNoticia = $sqlCommand->fetch(PDO::FETCH_NUM)){
		echo $livro->getLivro($banco, $verNoticia);
	}
	?>
