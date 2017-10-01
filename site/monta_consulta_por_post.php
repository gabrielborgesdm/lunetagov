<?php

/*
  Caso $_POST["funcao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da funcao escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$sqlFiltro = "";
$_SESSION["funcao"] = $_POST["funcao"];
if ($_POST['funcao'] != 0) {
    $sqlFiltro .= " AND idFuncao=:funcao";
    $arraySql["funcao"] = $_POST['funcao'];
}

/*
  Caso $_POST["subFuncao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da subFuncao escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["subfuncao"] = $_POST["subfuncao"];
if ($_POST['subfuncao'] != 0) {
    $sqlFiltro .= " AND idsubFuncao=:subFuncao";
    $arraySql["subFuncao"] = $_POST['subfuncao'];
}

/*
  Caso $_POST["orgao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do orgao escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["orgao"] = $_POST["orgao"];
if ($_POST['orgao'] != 0) {
    $sqlFiltro .= " AND idOrgao=:Orgao";
    $arraySql["Orgao"] = $_POST['orgao'];
}

/*
  Caso $_POST["categoria"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da categoria escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["categoria"] = $_POST["categoria"];
if ($_POST['categoria'] != 0) {
    $sqlFiltro .= " AND idCategoria=:Categoria";
    $arraySql["Categoria"] = $_POST['categoria'];
}

/*
  Caso $_POST["grupo"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do grupo escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["grupo"] = $_POST["grupo"];
if ($_POST['grupo'] != 0) {
    $sqlFiltro .= " AND idGrupo=:Grupo";
    $arraySql["Grupo"] = $_POST['grupo'];
}

/*
  Caso $_POST["unidadeOrcamentaria"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da unidadeOrcamentaria escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["unidadeorcamentaria"] = $_POST["unidadeorcamentaria"];
if ($_POST['unidadeorcamentaria'] != 0) {
    $sqlFiltro .= " AND idUnidadeOrcamentaria=:UnidadeOrcamentaria";
    $arraySql["UnidadeOrcamentaria"] = $_POST['unidadeorcamentaria'];
}

/*
  Caso $_POST["unidadeGestora"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da unidadeGestora escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["unidadegestora"] = $_POST["unidadegestora"];
if ($_POST['unidadegestora'] != 0) {
    $sqlFiltro .= " AND idUnidadeGestora=:UnidadeGestora";
    $arraySql["UnidadeGestora"] = $_POST['unidadegestora'];
}

/*
  Caso $_POST["modalidade"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da modalidade escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["modalidade"] = $_POST["modalidade"];
if ($_POST['modalidade'] != 0) {
    $sqlFiltro .= " AND idModalidade=:Modalidade";
    $arraySql["Modalidade"] = $_POST['modalidade'];
}

/*
  Caso $_POST["elemento"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do elemento escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["elemento"] = $_POST["elemento"];
if ($_POST['elemento'] != 0) {
    $sqlFiltro .= " AND idElemento=:Elemento";
    $arraySql["Elemento"] = $_POST['elemento'];
}

/*
  Caso $_POST["item"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do item escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["item"] = $_POST["item"];
if ($_POST['item'] != 0) {
    $sqlFiltro .= " AND idItem=:Item";
    $arraySql["Item"] = $_POST['item'];
}

/*
  Caso $_POST["credor"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do credor escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["credor"] = $_POST["credor"];
if ($_POST['credor'] != 0) {
    $sqlFiltro .= " AND idCredor=:Credor";
    $arraySql["Credor"] = $_POST['credor'];
}

/*
  Caso $_POST["licitacao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da licitacao escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["licitacao"] = $_POST["licitacao"];
if ($_POST['licitacao'] != 0) {
    $sqlFiltro .= " AND idLicitacao=:Licitacao";
    $arraySql["Licitacao"] = $_POST['licitacao'];
}

/*
  Caso $_POST["fonterecursos"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da fonteRecursos escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["fonterecursos"] = $_POST["fonterecursos"];
if ($_POST['fonterecursos'] != 0) {
    $sqlFiltro .= " AND idFonteRecurso=:FonteRecurso";
    $arraySql["FonteRecursos"] = $_POST['fonterecursos'];
}

/*
  Caso $_POST["acao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da acao escolhida
  e acrescenta-se no vetor $arraySql o valor referente a este filtro
 */
$_SESSION["acao"] = $_POST["acao"];
if ($_POST['acao'] != 0) {
    $sqlFiltro .= " AND idAcao=:Acao";
    $arraySql["Acao"] = $_POST['acao'];
}


$sqlTotais = $sql . $sqlFiltro;

$select = $conn->prepare($sqlTotais);
$select->execute($arraySql) or die($sql);
$l = $select->fetch();

$pg = 0;
?>