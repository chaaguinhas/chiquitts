<?php

require './protege.php';
require './config.php';
require './_lib/conexao.php';
require './_lib/funcoes.php';

$msg = array();
$placa = '';
$modelo = '';
$ano = '';
$idveiculo = 0;

if($_POST){
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $ano =  $_POST['ano'];
    $idproprietario = $_POST['lista'];
    $idmarca = $_POST['lista2'];
    if(strlen($placa) != 7){
        $msg[] = 'Número de placa inválido, digite novamente uma placa válida';
    }
    elseif(existePlaca($conn, $placa)){
        $msg[] = 'Placa já cadastrada, digite outra novamente';
    }

    if(!$msg){

        $sql = "Insert Into veiculo (idproprietario, idmarca, placa, modelo, ano)
        Value (:lista, :lista2, :placa, :modelo, :ano)";

        $prep = $conn->prepare($sql);
        $prep->bindValue(':lista', $idproprietario);
        $prep->bindValue(':placa', $placa);
        $prep->bindValue(':modelo', $modelo);
        $prep->bindValue(':ano', $ano);
        $prep->bindValue(':lista2', $idmarca);
        $prep->execute();
        $idveiculo = $conn->lastInsertId();

        $url = "cadastrar-veiculo.php?idveiculo=$idveiculo";
        javascriptAlertFim("Veículo cadastrado", $url);
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
    <title>Cadastrar Veículos</title>
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
            <?php if ($msg) { msgHtml($msg); } ?>
        </div>
        <form action="cadastrar-veiculo.php" method="POST">
            <div id="form-item">
                <label for="fplaca">Placa</label><br>
                <input type="text" placeholder="Número da Placa" id="fplaca" name="placa" value="" onkeyup="return alteraMaisculas(this)" required/>
            </div>
            <div id="form-item">
                <label for="fmodel">Modelo</label><br>
                <input type="text"  placeholder="Modelo do carro" id="fmodel" name="modelo" value="" onkeyup="return alteraMaisculas(this)"/>
            </div>
            <div id="form-item">
                <label for="fano">Ano</label><br>
                <input type="text" placeholder="CPF de 11 dígitos" id="fano" name="ano" value=""/>
            </div>

            <div>
                <label for="lista-veic" id="lbl-prop">Marca</label><br>
                
                <select name="lista2" id="lista-veic">
                    <option selected>Selecione a marca</option>
                    <?php categoriaMarca($conn, $marca) ?>
                </select>
        
            </div>

            <div>
                <label for="lista-veic" id="lbl-prop">Proprietários</label><br>
                
                <select name="lista" id="lista-veic">
                    <option selected>Selecione o proprietário</option>
                    <?php categoriaProprietario($conn, $idproprietario) ?>
                </select>
        
            </div>
            
                <button type="submit" id="btn-cadast">Cadastrar</button>
                <button type="reset" id="btn-cancel">Cancelar</button>
        </form>
    </div>
    <script>
    function alteraMaisculas(campo) {
  campo.value=campo.value.toUpperCase();
}</script>
</body>
</html>