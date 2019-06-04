<?php

require './protege.php';
require './config.php';
require './_lib/conexao.php';
require './_lib/funcoes.php';

$q = '';
$idproprietario = 0;

if ( isset($_GET['q']) ) {
    $q = strtolower($_GET['q']);
}
if ( isset($_GET['idproprietario']) ) {
    $idproprietario = (int) $_GET['idproprietario'];
}

$sql = "Select 
idproprietario, 
nome, email, cpf
From proprietario";

$where = array();

if ($q != '') {
    $where[] = "(LOWER(nome) Like '%$q%')";
}

if($idproprietario>0){
    $where[] = "(idproprietario = $idproprietario)";
}

if($where){
    $sql .= " Where " . join(" AND ", $where);
}

$res = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo-aux.css">
    <title>Proprietário</title>
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
        </div>

        <div id="panel-body">
            <form id="form-search" method="get" action="">
                <div id="form-group">
                    <label id="lbl-search" for="fq">Proprietários</label>
                    <input type="search" id="fq" name="q" placeholder="Nome do proprietário" value="<?php echo $q; ?>">
                </div>
                <button type="submit" id="btn-search">Pesquisar</button>
            </form>
        </div>

        <table id="table-prop">
            <thead>
                <tr id="body-table">
                    <th>#ID</th>
                    <th>NOME</th>
                    <th>E-Mail</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>

            <?php
                while ( $linha = $res->fetch(PDO::FETCH_ASSOC) ) {
            ?>

                <tr>
                    <td><?= $linha['idproprietario']?></td>
                    <td><?= $linha['nome']?></td>
                    <td><?= $linha['email']?></td>
                    <td><?= $linha['cpf']?></td>
                </tr>

                <?php } ?>
                
            </tbody>
        </table>
    </div>
</body>

</html>