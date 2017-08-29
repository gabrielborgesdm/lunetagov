<?php

/*
		Caso $_SESSION["funcao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da funcao escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/

	if($_SESSION['funcao']!=0){
		$sqlFiltro .= " AND idFuncao=:funcao";
		$arraySql["funcao"]=$_SESSION['funcao'];
	}

	/*
		Caso $_SESSION["subFuncao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da subFuncao escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	if($_SESSION['subfuncao']!=0){
		$sqlFiltro .= " AND idsubFuncao=:subFuncao";
		$arraySql["subFuncao"]=$_SESSION['subfuncao'];
	}
	
	/*
		Caso $_SESSION["orgao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do orgao escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['orgao']!=0){
		$sqlFiltro .= " AND idOrgao=:Orgao";
		$arraySql["Orgao"]=$_SESSION['orgao'];
	}
	
	/*
		Caso $_SESSION["categoria"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da categoria escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['categoria']!=0){
		$sqlFiltro .= " AND idCategoria=:Categoria";
		$arraySql["Categoria"]=$_SESSION['categoria'];
	}
	
	/*
		Caso $_SESSION["grupo"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do grupo escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	$_SESSION["grupo"] = $_SESSION["grupo"];
	if($_SESSION['grupo']!=0){
		$sqlFiltro .= " AND idGrupo=:Grupo";
		$arraySql["Grupo"]=$_SESSION['grupo'];
	}
	
	/*
		Caso $_SESSION["unidadeOrcamentaria"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da unidadeOrcamentaria escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['unidadeorcamentaria']!=0){
		$sqlFiltro .= " AND idUnidadeOrcamentaria=:UnidadeOrcamentaria";
		$arraySql["UnidadeOrcamentaria"]=$_SESSION['unidadeorcamentaria'];
	}
	
	/*
		Caso $_SESSION["unidadeGestora"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da unidadeGestora escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['unidadegestora']!=0){
		$sqlFiltro .= " AND idUnidadeGestora=:UnidadeGestora";
		$arraySql["UnidadeGestora"]=$_SESSION['unidadegestora'];
	}

	/*
		Caso $_SESSION["modalidade"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da modalidade escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['modalidade']!=0){
		$sqlFiltro .= " AND idModalidade=:Modalidade";
		$arraySql["Modalidade"]=$_SESSION['modalidade'];
	}
	
	/*
		Caso $_SESSION["elemento"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do elemento escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['elemento']!=0){
		$sqlFiltro .= " AND idElemento=:Elemento";
		$arraySql["Elemento"]=$_SESSION['elemento'];
	}
	
	/*
		Caso $_SESSION["item"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do item escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['item']!=0){
		$sqlFiltro .= " AND idItem=:Item";
		$arraySql["Item"]=$_SESSION['item'];
	}
	
	/*
		Caso $_SESSION["credor"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro do credor escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['credor']!=0){
		$sqlFiltro .= " AND idCredor=:Credor";
		$arraySql["Credor"]=$_SESSION['credor'];
	}

	/*
		Caso $_SESSION["licitacao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da licitacao escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['licitacao']!=0){
		$sqlFiltro .= " AND idLicitacao=:Licitacao";
		$arraySql["Licitacao"]=$_SESSION['licitacao'];
	}

	/*
		Caso $_SESSION["fonterecursos"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da fonteRecursos escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['fonterecursos']!=0){
		$sqlFiltro .= " AND idFonteRecurso=:FonteRecurso";
		$arraySql["FonteRecursos"]=$_SESSION['fonterecursos'];
	}

	/*
		Caso $_SESSION["acao"] seja diferente de zero, acrescenta-se na variavel $sql a condicao de filtro da acao escolhida
		e acrescenta-se no vetor $arraySql o valor referente a este filtro
	*/
	
	if($_SESSION['acao']!=0){
		$sqlFiltro .= " AND idAcao=:Acao";
		$arraySql["Acao"]=$_SESSION['acao'];
	}

	
	$sqlTotais = $sql.$sqlFiltro;
	
	$select = $conn->prepare($sqlTotais);
	$select->execute($arraySql) or die($sql);
	$l=$select->fetch();

	$pg = 0;

?>