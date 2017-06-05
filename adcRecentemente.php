<?php
    require_once('conexao.php');

	$sql = "SELECT * FROM tbllivro order by id desc limit 3;";

	$select = mysqli_query($conexao,$sql);
	

    $lista = array();
	while($rs = mysqli_fetch_array($select)){
		
        $lista[]=$rs;
       
	}
	 echo json_encode($lista);

?>