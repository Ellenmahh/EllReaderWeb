<?php
//$conexao = new mysqli ('localhost','root','bcd127','dbellreader');
$conexao = new mysqli ($_SERVER['RDS_HOSTNAME'],$_SERVER['RDS_USERNAME'],$_SERVER['RDS_PASSWORD'],$_SERVER['RDS_DB_NAME']);


?>