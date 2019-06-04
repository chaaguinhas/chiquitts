<?php

/**
* Cria um window.alert com a $msg
* Se receber $url, executa um window.location = $url
* Se receber $fim = true, executa a instrucao exit
* 
* @param string $msg Mensagem para o usuario
* @param string $url Url para redirecionar o usuario
* @param boolean $fim Se true, a funcao executa um exit
*/
function javascriptAlert($msg, $url = null, $fim = false) {
	?><script>
	window.alert('<?php echo $msg; ?>');
	<?php if (null !== $url) { ?>
	window.location = '<?php echo $url; ?>';
	<?php } ?>
	</script><?php

	if ($fim) {
		exit;
	}
}

/**
* Cria um window.alert com a $msg
* Se receber $url, executa um window.location = $url
* Esta funcao executa a instrucao exit
* 
* @param string $msg Mensagem para o usuario
* @param string $url Url para redirecionar o usuario
*/
function javascriptAlertFim($msg, $url = null) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
	  <title>Mensagem</title>
	  <meta charset="utf-8">
	</head>
	<body>
	<?php javascriptAlert($msg, $url, false); ?>
	</body>
	</html>
	<?php
	exit;
}

/**
* Converte um array de mensagens em HTML
* 
* @param array $msg Lista das mensagens
* @param string $boxType Tipo da mensagem
*	Pode ser success, info, warning ou danger
*/
function msgHtml($msg) {
?>
<div>
	<ul>
		<?php foreach($msg as $m) { ?>
		<li><?php echo $m ; ?>;</li>
		<?php } ?>
	</ul>
</div>
<?php
}

/**
 * @param $cpf
 * @return bool
 * @link https://gist.github.com/guisehn/3276015
 */
function validarCpf($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
    // Valida tamanho
    if (strlen($cpf) != 11)
        return false;
    // Calcula e confere primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Calcula e confere segundo dígito verificador
    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}

function hashSenha($senha) {
    return md5("abc-$senha");
}

function mask($val, $mask) {
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++) {
        if($mask[$i] == '#') {
            if(isset($val[$k]))
                $maskared .= $val[$k++];
        } else {
            if(isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

/**
 * Recebe um CPF com somente numeros e retorna CPF mascarado
 * @param $cpf CPF somente numeros
 * @return string CPF mascarado
 */
function maskCpf($cpf) {
    return mask($cpf,'###.###.###-##');
}

function categoriaProprietario($conn, $idproprietario) {
    $sql = "Select idproprietario, nome, cpf
    From proprietario
    order by idproprietario";

    $res = $conn->query($sql);

    while( $linha = $res->fetch(PDO::FETCH_ASSOC) ) {
    ?>
        <option value="<?= $linha['idproprietario']?>"><?= $linha['nome'] . " " . "////////" . " " .  $linha['cpf']?></option>
    <?php }
}

function categoriaMarca($conn, $idmarca) {
    $sql = "Select idmarca, marca
    From marca
    order by idmarca";

    $res = $conn->query($sql);

    while( $linha2 = $res->fetch(PDO::FETCH_ASSOC) ) {
    ?>
        <option value="<?= $linha2['idmarca']?>"><?= $linha2['marca'] ?></option>
    <?php }
}



function existeCpf($conn, $cpf) {

    $sql = "Select cpf
    From proprietario
    Where cpf = $cpf";

    $res = $conn->query($sql);
    if($cpfs = $res->fetch( PDO::FETCH_ASSOC )){
        return true;
    }
}



function existePlaca($conn, $placa) {
    $placa = strtoupper($placa);

    $sql = "Select placa
    From veiculo
    Where placa = ?";
    $prep = $conn->prepare($sql);
    $prep->bindValue(1,$placa);
    $prep->execute();
    if($prep->fetch( PDO::FETCH_ASSOC )){
        return true;
    }
}

function alteraMaisculas($campo) {
    $campo.value == $campo.value.toUpperCase();
}



