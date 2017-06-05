<?php
    require_once('conexao.php');
    
    $usuario = $_GET['usuario'];
    $senha = $_GET['senha'];
    $telefone = $_GET['telefone'];
    $email = $_GET['email'];
    
    $sql = "insert into tbllogin(usuario, senha, email, telefone) values('".$usuario."', '".$senha."', '".$email."', '".$telefone."')";
    mysqli_query($conexao, $sql);

    if(mysqli_affected_rows($conexao) == 0){
        echo "erro";
    }

?>