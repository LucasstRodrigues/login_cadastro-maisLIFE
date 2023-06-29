<?php
    session_start();
    // Verifica se os campos do formulário não estão vazios
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        include_once('../php/config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Verificação se existe no banco de dados o email e a senha fornecida
        $sql = "SELECT * FROM tb_usuario WHERE ds_email = '$email' and ds_senha = '$senha'";

        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1) // Se não houver nenhuma correspondência para o email e senha fornecidos 
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: ../paginas/index.php');
            
        }
        else 
        {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: ../paginas/pagina_principal.php');
        }
    }
    else
    {
        header('Location: ../paginas/index.php');
    }
?>