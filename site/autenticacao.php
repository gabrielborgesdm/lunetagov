<?php

session_start();

if (!isset($_SESSION["logado"])) {

    include("conexao.php");
    $conn = new PDO("mysql:host=diadepromocao.com.br;dbname=ddpbr_lunetagov", "ddpbr_luneta", "123luneta456");

    $select = "SELECT * FROM login WHERE email=:email AND senha=:senha";

    $consulta = $conn->prepare($select);

    $vetor_login = array("email" => $_POST["login"], "senha" => $_POST["senha"]);

    $consulta->execute($vetor_login);

    $i = 0;
    while ($linha = $consulta->fetch()) {
        $i++;
        $linhaSessao = $linha;
    }

    if ($i == 1) {
        $_SESSION["logado"] = 1;
        $_SESSION["id_usuario"] = $linhaSessao["id_usuario"];
        $_SESSION["nome"] = $linhaSessao["nome"];
        $_SESSION["email"] = $linhaSessao["email"];
        $_SESSION["cidade"] = $linhaSessao["cidade"];
        $_SESSION["estado"] = $linhaSessao["estado"];
        header("location: index.php");
    } else {
        echo "<script  charset='utf-8'>alert('usuario e/ou senha inválidos! Tente novamente.'); location.href='login.php';</script>";
    }
} else {
    session_destroy();
    header("location: index.php");
}
?>