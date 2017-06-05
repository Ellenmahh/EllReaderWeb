<?php
	require_once('conexao.php');
	
	
	$id_usuario = $_GET['usuario'];
	$id_Livro = $_GET['id'];
	
	$sql = "select * from tblfavoritos where idUsuario=".$id_usuario . " and idLivro=".$id_Livro;
	$select = mysqli_query($conexao,$sql);
	
    if(mysqli_affected_rows($conexao) > 0){
        while($rs = mysqli_fetch_array($select)){
            $favoritos = $rs['favoritos'];
            if($favoritos == 0){
                $sql="UPDATE tblfavoritos SET favoritos = 1 where idUsuario =".$id_usuario . " and idLivro=".$id_Livro;
            }else {
                $sql ="UPDATE tblfavoritos SET favoritos = 0 where idUsuario =".$id_usuario . " and idLivro=".$id_Livro;
            }
        }

        mysqli_query($conexao,$sql);
    }else{
       $sql="insert into tblFavoritos(idUsuario, idLivro, favoritos) values(".$id_usuario.", ".$id_Livro.", 1)";
       mysqli_query($conexao,$sql);
        
    }

?>