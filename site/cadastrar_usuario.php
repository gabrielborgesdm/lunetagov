<?php
include("conexao.php");

$sql = $conn->prepare("INSERT INTO login VALUES ('',:nome,:email,:senha,:cidade,:estado) ");
$vetor_insercao = array("nome" => $_POST["nome"], "email" => $_POST["email"], "senha" => $_POST["senha"],
    "estado" => $_POST["estado"], "cidade" => $_POST["cidade"]);
$sql->execute($vetor_insercao) or die("Erro ao inserir" . $sql->error_log);
?>

<script>
    alert("usuario cadastrado com sucesso.");
    location.href = "index.php";
</script>