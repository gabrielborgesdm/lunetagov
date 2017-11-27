<?php
session_start();


include("conexao.php");

$ativo = ' class="active"';

$ativoHome = "";
$ativoConsulta = "";
$ativoDados = "";
$ativoSobre = "";
$ativoContato = "";


if ($controle == "index") {
    $ativoHome = $ativo;
}
if ($controle == "consulta") {
    $ativoConsulta = $ativo;
}
if ($controle == "dados") {
    $ativoDados = $ativo;
}
if ($controle == "sobre") {
    $ativoSobre = $ativo;
}
if ($controle == "contato") {
    $ativoContato = $ativo;
}
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Luneta GOV</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        <script src="js/bootstrap.min.js"></script>
        -->
        <script src="js/funcoes.js" type="text/javascript"></script>
        <script src="js/meuJquery.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="header">
            <div>
                <div class="logo">
                    <a href="index.php"></a>
                </div>
                <ul id="navigation">
                    <li <?= $ativoHome; ?>>
                        <a href="index.php">Home</a>
                    </li>
                    <li  <?= $ativoConsulta; ?>>
                        <a href="consultas.php">Consultas</a>
                    </li>
                    <li  <?= $ativoSobre; ?>>
                        <a href="sobre.php">Sobre</a>
                    </li>
                    <li>
<?php
if (isset($_SESSION["logado"])) {
    echo '<a href="dados_pre_selecionados.php">Histórico de Pesquisa</a>';
} else {
    echo '<a href="login.php">Login/Cadastro</a>';
}
?>

                    </li>			
                    <li  <?= $ativoContato; ?>>
                        <a href="contato.php">Contato</a>
                    </li>
                </ul>
            </div>
            <br />

<?php
if (isset($_SESSION["logado"])) {
    echo '
        Bem vindo, ' . $_SESSION["nome"] . '.';
    ?>
                <a href='logout.php'><input type="button" value="SAIR" /></a>
                <?php
            }
            ?>
        </div>