<?php
session_start();
include("conexao.php");
$conn = conexaoDB();
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Luneta GOV</title>
        <link type="text/css" rel="stylesheet" href="css/style.css"/>

        <!--Bootstrap v3.7-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid ">
                <div class="navbar-header">
                   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <img class="img-responsive" src="images/log.png"/>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" >

                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>

                        <li>
                            <a href="consultas.php">Consultas</a>
                        </li>
                        
                        <li>
                            <a href="sobre.php">Sobre</a>
                        </li>

                        <li>
                            <a href="contato.php">Contato</a>
                        </li>

                        <?php
                        if (isset($_SESSION["logado"])) {
                            echo'
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Conta
                                    <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                    <li role="separator" class="divider"></li>
                                    <li class="text-center" style="padding:5px;">Bem vindo <strong>'.$_SESSION["nome"].'</strong>!</li>
                                     <li role="separator" class="divider"></li>   
                                    <!--Não Funcionando
                                      <li><a href="dados_pre_selecionados.php">Histórico de Pesquisa</a></li>
                                    -->
                                      <li><a class="btn btn-default col-xs-4 col-xs-offset-4" style="padding:3px 10px !important;" href="logout.php">Sair</a></li>
                                </ul>      
                            </li>
                            ';
                        }
                        else{
                            echo'
                                <li><a href="login.php">Login/Cadastro</a><li>
                            ';
                        }
			?>

                    </ul>
                </div>
            </div>
        </nav>
