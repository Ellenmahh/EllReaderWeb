<?php
    require_once('conexao.php');
    require_once('API.php');
	
    $id = $_GET['idLogin'];

	$sql = "select * from tbllivro as l 
    left join  tblfavoritos as f on l.id = f.idLivro 
    and f.idUsuario = ".$id." 
    where f.favoritos = 1;";

	$select = mysqli_query($conexao,$sql);
	
	while($rs = mysqli_fetch_array($select)){
		echo json_encode($rs);
	}
	

?>