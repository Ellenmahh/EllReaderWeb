<?php
require_once('conexaoPDO.php');
require_once('livro.php');

$query = $_GET["q"];

$listaLivros = Livro::buscar($query);
echo json_encode($listaLivros);


?>
