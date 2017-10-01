<?php

session_start();

include("conexao.php");

$sql = "SELECT * FROM historico";

$stmt = $conn->prepare($sql);

$stmt->execute();

while ($linha = $stmt->fetch()) {
    echo $linha["titulo"];
    echo "</table> <br />";
}
?>