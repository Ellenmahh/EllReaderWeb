<?php
require_once('conexao.php');
session_start();
$btn="Salvar";
$capa="";
$titulo="";
$pdf="";
$genero="";
$nome_capa = "";
$nome_pdf = "";

if(isset($_GET['modo'])){
	$modo=$_GET['modo'];
    
    if($modo=='excluir'){
			$cod=$_GET['codigo'];
			$delete='delete from tbllivro WHERE id='.$cod;
			mysqli_query($conexao,$delete);
			//echo $delete;
            header('location:index.php');
			
    }elseif($modo=='editar'){
            $cod=$_GET['codigo'];
            
            $_SESSION['idAlterar']=$cod;
            
           $sql ="select l.id,l.capa,l.titulo,l.pdf,g.genero from tbllivro as l inner join tblgenero as g on l.idgenero = g.idgenero WHERE id= " .$cod;
            
            $resultado = mysqli_query($conexao,$sql);
            $valores=mysqli_fetch_array($resultado);
            $capa = $valores['capa'];
            $titulo = $valores['titulo'];
            $pdf = $valores['pdf'];
            $genero = $valores['genero'];

            $btn="Alterar";
             
        
    }	
}


if(isset($_POST['btnsalvar'])){
   // ***************************** MOVE IMAGEM*****************************************************
    $titulo = $_POST['txtTitulo'];
	$slgeneros = $_POST['slgeneros'];
	
    $capa_arq = basename ($_FILES['fleCapa']['name']);
	if($capa_arq != ""){
		// caminho da imagem
		$caminho_img = "capas/";
		//resgatar o nome do arquivo com o caminho e o nome do objeto
		$nome_capa = $caminho_img . $capa_arq;
		$extensao = strtolower(substr($capa_arq,strlen($capa_arq)-3,3));
		if($extensao == 'jpg' || $extensao == 'png' ){
        // mover a imagem para a pasta arquivo que o caminho da imagem
            move_uploaded_file($_FILES['fleCapa']['tmp_name'],$nome_capa); 
        }
	}
    
    // ******************************** MOVE PDF***********************************************
    $pdf_arq = basename ($_FILES['flePdf']['name']);
	if($pdf_arq != ""){
		$caminho_pdf="livros/";
		$nome_pdf = $caminho_pdf . $pdf_arq;
		$extensao = strtolower(substr($pdf_arq,strlen($pdf_arq)-3,3));
		if($extensao == 'pdf' ){
			// mover a imagem para a pasta arquivo que o caminho da imagem
			move_uploaded_file($_FILES['flePdf']['tmp_name'],$nome_pdf);
		}
	}
    
    if($_POST['btnsalvar']=="Salvar"){
		$sql = " INSERT INTO tblLivro(capa,titulo,pdf,idgenero) VALUES('".$nome_capa."','".$titulo."','".$nome_pdf."',".$slgeneros.");";
		mysqli_query($conexao,$sql);
		if(mysqli_affected_rows($conexao) > 0) {
            echo  ("<script>alert('Enviado com Sucesso!);</script>");
        }
        header('location:index.php');
        //echo $sql;
    
	}elseif($_POST['btnsalvar']=="Alterar"){
		if($nome_capa != "" && $nome_pdf == ""){
			$sql="UPDATE tbllivro SET 
                capa = '".$nome_capa."',
                titulo = '".$titulo."',
                idgenero = ".$slgeneros."
                WHERE id = ". $_SESSION['idAlterar'];
		}elseif($nome_pdf != "" && $nome_capa == ""){
			$sql="UPDATE tbllivro SET
            titulo = '".$titulo."',
            pdf = '".$nome_pdf."',
            idgenero = ".$slgeneros."
            WHERE id = ".$_SESSION['idAlterar'];
        }else if($nome_pdf == "" && $nome_capa == ""){
           $sql="UPDATE tbllivro SET 
            titulo = '".$titulo."',
            idgenero = ".$slgeneros."
            WHERE id = ".$_SESSION['idAlterar'];
            
        }else{
			$sql="UPDATE tbllivro SET 
            capa = '".$nome_capa."',
            titulo = '".$titulo."',
            pdf = '".$nome_pdf."',
            idgenero = ".$slgeneros."
            WHERE id = ".$_SESSION['idAlterar'];
		}
		//echo $sql; 
		mysqli_query($conexao,$sql);
		header('location:index.php');
        
    }
}
	$sql = "select * from tblgenero";
	$selection = mysqli_query($conexao,$sql);
    
?>

<html>
	<head>
        <meta charset="UTF-8">
    	<title>Ell Reader</title> 
		<link rel="stylesheet" type="text/css" href="css/css.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#button").click(function(){
                    $("#tblvisualizar").toggle();
                });
                
            });
        </script>
	</head>
	<body >
	<form name = "frmreader" method="post" enctype="multipart/form-data" action="index.php?#conteudo">
		<section id="principal"> 
			<div id="conteudo">
					<div class="titulo"><img src="capas/logo.png"></div>
					<div id = "capa"> CAPA:<input type="file"  requered name="fleCapa"> </div>
					<div id = "titulo">TÍTULO:<input type="text" value="<?php echo $titulo?>" requered name="txtTitulo" > </div>
					<div id = "livro">LIVRO EM PDF:<input type="file" requered name="flePdf"></div>
					<div id = "genero">GÊNERO:
						<select name="slgeneros">
							<?php while($listagenero = mysqli_fetch_array($selection)){ 
                                    if($listagenero['genero'] == $genero){
                                        $result = "selected";
                                        
                                    }else{
                                         $result = "";
                                    }
                            ?>
								<option value = "<?php echo($listagenero['idgenero'])?>" <?php echo $result ?>> 
									<?php echo($listagenero['genero'])  ?> 
								</option>
										 
							<?php } ?>
						</select>
					</div>
					<div id = "botao"><input type="submit" name="btnsalvar" value="<?php echo $btn;?>" text="center" class="botaosalvar"></div>
			</div>
		</section> 
        
        <section>
             <button id="button"> VISUALIZAR/OCULTAR</button>
            <form method="post">
               
                <table id="tblvisualizar">
                 
                    <tr>
                        <td> CAPA</td>
                        <td> TÍTULO</td>
                        <td> PDF</td>
                        <td> GENERO</td>
                        <td> Editar/Excluir</td>
                        
                    </tr>
                    <?php 
                        $sql = "select l.id,l.capa,l.titulo,l.pdf,g.genero from tbllivro as l
                            inner join tblgenero as g on l.idgenero = g.idgenero ORDER BY l.id desc;";
                        $select = mysqli_query($conexao,$sql);
                        while($lista = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                    
                        <td> <img  style="height:100px;" src="<?php echo $lista['capa'] ?>"></td>
                        <td> <?php echo $lista['titulo'] ?></td>
                        <td> <?php echo $lista['pdf'] ?></td>
                        <td> <?php echo $lista['genero'] ?></td>
                        <td>
                             <a href="index.php?modo=editar&codigo=<?php echo $lista['id']?>#tblvisualizar">
                                 <img style="height:30px" src="icons/editar.png"></a>

                            <a href="index.php?modo=excluir&codigo=<?php echo $lista['id']?>#tblvisualizar"> 
                                <img style="height:35px" src="icons/excluir.png"></a>
                        </td>
                        
                    </tr>
                    
                    <?php } ?>
                
                </table>
            
            </form>
        </section>
	
	<footer id ="rodape">

	</footer>
	</body>
</html>