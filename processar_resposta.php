<?php
session_start();

$resposta = $_POST['res'];
$user_id = $_POST['user_id'];
$pergunta_id = $_POST['pergunta_id'];
$id_user = $_SESSION['id'];
$tip = $_SESSION['user_type'];
$name_user  = $_SESSION['nome'];
var_dump($_POST);

 require_once("conexao.php");
 
 if($tip == 2){
 
  if ($conexao == false) {
            echo("Erro de conex�o com o banco de dados. Entre em contato com o administrador.");
            $erro = mysqli_connect_error($conexao);
            echo ($erro);
        } else {
			$comando = mysqli_query($conexao, "INSERT INTO resposta (id_user_fk,conteudo_resposta, id_pergunta_fk) VALUES ('$user_id','$resposta', '$pergunta_id')");
            if ($comando == false) {
                echo ("erro ao enviar comando para o banco de dados.");
                $erro = mysqli_error($conexao);
                echo($erro);
            }else{
				//header("location:forum.php");
            }
        }
        
}else{
	echo("error");
}
?>
