<?php
require_once('conexaoPDO.php');
require_once('livro.php');

$idLogin = $_GET['idLogin'];
$_SESSION['idLogin'] = $idLogin;

$listaLivros = Livro::all();
echo json_encode($listaLivros);
	

?>