<?php

require './config.php';
require './_lib/conexao.php';
require './_lib/funcoes.php';

$msg = array();

if ($_POST) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "Select idusuario, nome
  From usuario
  WHERE email = '$email'
    AND senha = '$senha'";

    $prep = $conn->prepare($sql);
    $prep->bindValue(':email', $email);
    $prep->bindValue(':senha', $senha);
    $prep->execute();

    $usuario = $prep->fetch(PDO::FETCH_ASSOC);

    if($usuario){
        session_start();
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['nome'] = $usuario['nome'];
        header('location:./');
        exit;
    }

    $msg[] = 'Email e/ou senha incorretos';
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <title>Chiquitts Mechanical</title>
</head>

<body>

    <div id="nameProject">
        <h1>
            Chiquitts Mechanical
        </h1>
    </div>

    <div id="container">
        <h1>Login</h1>

       

        <form action="login.php" method="post">
            <fieldset>
                <label for="lemail" id="email">Email<input type="email" class="campo" name="email" id="lemail" placeholder="exemplo@gmail.com" size="30" /></label>

                <label for="lsenha" id="senha">Senha<input type="password" class="campo" name="senha" id="lsenha" placeholder="******" size="30" /></label>

                <button type="submit" id="lsubmit">Enviar</button>

                <p id="user">Os usuários cadastrados para teste estão</p>
                <p id="login">na pasta ./_docs/usuarios.txt<br></p>
                
            </fieldset>
            <?php if ($msg) { msgHtml($msg); } ?>
        </form>
        
    </div>

    <footer id="rodape">
        <p><span id="scont">Contato:</span>
            <a href="https://www.facebook.com/chaaguinhas" id="aface" target="_blank"><img src="_imagens/icone-facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/chaaguinhas/" id="ainsta" target="_blank"><img src="_imagens/icone-instagram.png" alt=""></a>
            <a href="https://www.linkedin.com/in/gabriel-chagas-77280a185/" id="alinke" target="_blank"><img src="_imagens/icone-linkedin.png" alt="" id="link"></a>
        </p>
    </footer>

</body>

</html>