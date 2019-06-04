<?php

require './protege.php';
require './config.php';
require './_lib/conexao.php';
require './_lib/funcoes.php';

$q = '';
$idveiculo = 0;

if ( isset($_GET['q']) ) {
    $q = strtolower($_GET['q']);
}
if ( isset($_GET['v.idveiculo']) ) {
    $idveiculo = (int) $_GET['v.idveiculo'];
}

$sql = "Select
v.idveiculo, v.idproprietario, v.idmarca, m.marca, placa, modelo, ano
From veiculo as v
inner join marca as m on v.idmarca = m.idmarca ";

$where = array();

if ($q != '') {
    $where[] = "(LOWER(modelo) Like '%$q%')";
}

if($idveiculo>0){
    $where[] = "(v.idveiculo = $idveiculo)";
}

if($where){
    $sql .= " Where " . join(" AND ", $where);
}

$res = $conn->query($sql);

//Busca no BD para armazenar o nome e o cpf do proprietario de um veiculo

$cmd = "Select v.idproprietario, p.nome, p.cpf
From veiculo as v 
inner join proprietario as p on v.idproprietario = p.idproprietario";

$nomes = $conn->query($cmd);

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="_css/estilo-aux.css">
    <title>Veículo</title>
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
                    <img src="_imagens/icone-veiculo-index.png" alt="Veículos">
                    <h1 id="header-form">Veículos</h1>
                </div>
        
                <div id="panel-body">
                    <form id="form-search" method="get" action="">
                        <div id="form-group">
                            <label id="lbl-search" for="fqq">Veículos</label>
                            <input type="search" id="fqq" name="q" placeholder="Modelo do veículo" value="">
                        </div>
                        <button type="submit" id="btn-search">Pesquisar</button>
                    </form>
                </div>
        
                <table id="table-prop">
                    <thead>
                        <tr id="body-table">
                            <th>#ID</th>
                            <th>PLACA</th>
                            <th>MODELO</th>
                            <th>ANO</th>
                            <th>MARCA</th>
                            <th>PROPRIETÁRIO</th>
                        </tr>
                    </thead>
                    <tbody>

                    <!-- Select
v.idveiculo, v.idproprietario, v.idmarca, m.marca, placa, modelo, ano
From veiculo as v
inner join marca as m on v.idmarca = m.idmarca ; -->

                        <?php
                            while ( ($linha1 = $res->fetch(PDO::FETCH_ASSOC)) && ($linha2 = $nomes->fetch(PDO::FETCH_ASSOC)) ) {
                        ?>
                        
                        <tr>
                            <td><?= $linha1['idveiculo']?></td>
                            <td><?= $linha1['placa']?></td>
                            <td><?= $linha1['modelo']?></td>
                            <td><?= $linha1['ano']?></td>
                            <td><?= $linha1['marca']?></td>
                            <td><?= $linha2['nome'] . "<br>" . "CPF: ". $linha2['cpf'] ?></td>
                        </tr>

                        <?php } ?>
                        

                    </tbody>
                </table>
    </div>
</body>
</html>