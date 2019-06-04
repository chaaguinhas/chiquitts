<?php

require './protege.php';
require './config.php';
require './_lib/conexao.php';
require './_lib/funcoes.php';

$msg = array();
$nome = '';
$email = '';
$cpf = '';
$idproprietario = 0;

if($_POST){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    if(strlen($cpf) != 11){
        $msg[] = 'CPF inválido, digite os 11 números novamente';
    }
    elseif( existeCpf($conn, $cpf)){
        $msg[] = 'CPF já existente, digite outro';
    }

    if(!$msg){
        $sql = "Insert into proprietario (nome, email, cpf)
        Values (:nome, :email, :cpf)";
        $prep = $conn->prepare($sql);
        $prep->bindValue(':nome', $nome);
        $prep->bindValue(':email', $email);
        $prep->bindValue(':cpf', $cpf);
        $prep->execute();
        $idproprietario = $conn->lastInsertId();

        $url = "cadastrar-proprietario.php?idproprietario=$idproprietario";
        javascriptAlertFim("Proprietário Cadastrado", $url);
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo-aux.css">
    <title>Cadastrar Proprietários</title>
</head>

<body>
    <div id="head">
        <header id="cabecalho">
            <nav id="menu">
                <h1><a href="./">Chiquitts Mechanical</a></h1>
                <ul id="nav-tabs">
                    <li id="nav-item">
                        <a href="./">Home</a>
                    </li>
                    <li id="nav-item">
                        <a href="proprietario.php" id="prop">Proprietários
                            <li><a href="cadastrar-proprietario.php">Cadastrar proprietários</a></li>
                        </a>
                    </li>
                    <li id="nav-item">
                        <a href="veiculo.php" id="veic">Veículos
                            <li><a href="cadastrar-veiculo.php">Cadastrar veiculos</a></li>
                        </a>
                    </li>
                    <li i="nav-item">
                        <a href="logout.php" id="aexit">Sair</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
    <div id="container">
        <div id="title">
            <img src="_imagens/icone-propri-index.png" alt="Veículos">
            <h1 id="header-form">Proprietários</h1>
            <?php if ($msg) { msgHtml($msg); } ?>
        </div>
        <form action="cadastrar-proprietario.php" method="POST">
            <div id="form-item">
                <label for="fnome">Nome</label><br>
                <input type="text" placeholder="Nome completo" id="fnome" name="nome" value="" required/>
            </div>
            <div id="form-item">
                <label for="fmail">Email</label><br>
                <input type="email"  placeholder="Email válido" id="fmail" name="email" value=""/>
            </div>
            <div id="form-item">
                <label for="fcpf">CPF</label><br>
                <input type="text" placeholder="CPF de 11 dígitos" id="fcpf" name="cpf" value=""/>
            </div>
                <button type="submit" id="btn-cadast">Cadastrar</button>
                <button type="reset" id="btn-cancel">Cancelar</button>
        </form>
    </div>
</body>

</html>