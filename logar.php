<?php

  require_once('conexao.php');


	$usuario = $_GET['usuario'];
	$senha = $_GET['senha'];

	$sql = "select * from tbllogin where usuario='".$usuario."' and senha=".$senha;

  $select =mysqli_query($conexao,$sql);

	if($rs = mysqli_fetch_array($select)){
		echo json_encode($rs);
	}
?>
