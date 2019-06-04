<?php

require './protege.php';
require './config.php';
require './_lib/conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo-aux.css">
    <title>Chiquitts Mechanical</title>
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
        <h1>Chiquitts Mechanical</h1>
        <h2>Bem vindo <?= $_SESSION['nome'] ?></h2>
        <label><a href="proprietario.php" id="cprop"><img src="_imagens/icone-propri-index.png" alt="Proprietários" id="img-prop">Proprietários</a></label>
        <a href="veiculo.php" id="cveic"><img src="_imagens/icone-veiculo-index.png" alt="Veículos" id="img-veic">Veículos</a>
    </div>
</body>
</html>
</body>
</html>