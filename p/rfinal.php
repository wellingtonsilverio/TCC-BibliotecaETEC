<?php
$cod = $_GET['cod'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Retirada</title>
<script language="javascript" type="text/javascript">
function imprimir(){
	window.print();
}
</script>
</head>

<body>
<div style="position:fixed; width:800px; height:50px; top:50%; left:50%; margin-top:-50px; margin-left:-400px; color:#000000; text-align:center; font-size:14px; font-weight:bold;">Para retirar o livro na biblioteca da ETEC Hortoândia, leve este codigo. junto com seu RG ou documento com nome e foto.</div>
<div style="position:fixed; width:400px; height:50px; top:50%; left:50%; margin-top:-25px; margin-left:-200px; color:#931517; text-align:center; font-size:50px; font-weight:bold;">#<?php echo $cod; ?></div>
<div style="position:fixed; width:400px; height:50px; top:50%; left:50%; margin-top:10px; margin-left:-200px; color:#931517; text-align:center; font-size:50px; font-weight:bold;"><input type="button" value="IMPRIMIR" onClick="imprimir()"></div>
</body>
</html>