<?php
	$controle = "dados";
	include("cabecalho.php");


unset($_SESSION["historico"]); 
	unset($_SESSION["consulta"]);
	unset($_SESSION["funcao"]);
	unset($_SESSION["subFuncao"]);
	unset($_SESSION["orgao"]);
	unset($_SESSION["categoria"]);
	unset($_SESSION["unidadeorcamentaria"]);
	unset($_SESSION["unidadegestora"]);
	unset($_SESSION["modalidade"]);
	unset($_SESSION["elemento"]);
	unset($_SESSION["item"]);
	unset($_SESSION["credor"]);
	unset($_SESSION["licitacao"]);
	unset($_SESSION["fonteRecursos"]);
	unset($_SESSION["acao"]);
	unset($_SESSION["totalPago"]);
	unset($_SESSION["grupo"]);

	unset($_SESSION["listarGrupo"]);
	unset($_SESSION["listarFuncao"]);
	unset($_SESSION["listarSubFuncao"]);
	unset($_SESSION["listarOrgao"]);
	unset($_SESSION["listarUnidadeOrcamentaria"]);
	unset($_SESSION["listarUnidadeGestora"]);
	unset($_SESSION["listarModalidade"]);
	unset($_SESSION["listarCategoria"]);
	unset($_SESSION["listarElemento"]);
	unset($_SESSION["listarCredor"]);
	unset($_SESSION["listarItem"]);
	unset($_SESSION["listarLicitacao"]);
	unset($_SESSION["listarFonteRecursos"]);
	unset($_SESSION["listarAcao"]);
	unset($_SESSION["listarValorPago"]);
	unset($_SESSION["listarValorLiquido"]);
	unset($_SESSION["listarValorEmpenhado"]);
	unset($_SESSION["listarValorDeAnosAnteriores"]);



	$sql = "SELECT * FROM historico WHERE id_historico=".$_GET["historico"];
	$select = $conn->prepare($sql);
	$select->execute() or die($sql);

  $linha = $select->fetch();

   $_SESSION["historico"] = 1;

   $_SESSION["funcao"]  = $linha["funcao"];
   $_SESSION["subFuncao"]  = $linha["subFuncao"];                       
	 $_SESSION["orgao"]  = $linha["orgao"];
	 $_SESSION["categoria"]  = $linha["categoria"];
	 $_SESSION["unidadeorcamentaria"]  = $linha["unidadeOrcamentaria"];
	 $_SESSION["unidadegestora"]  = $linha["unidadeGestora"];
	 $_SESSION["modalidade"]  = $linha["modalidade"];
	 $_SESSION["elemento"]  = $linha["elemento"];
	 $_SESSION["item"]  = $linha["item"];
	 $_SESSION["credor"]  = $linha["credor"];
	 $_SESSION["licitacao"]  = $linha["licitacao"];
	 $_SESSION["fonteRecursos"]  = $linha["fonteRecurso"];
	 $_SESSION["acao"]  = $linha["acao"];
	 $_SESSION["grupo"]  = $linha["grupo"];                 
                               
   if($linha["listarGrupo"])
       $_SESSION["listarGrupo"]  = $linha["listarGrupo"];


   if($linha["listarFuncao"])
       	 $_SESSION["listarFuncao"]  = $linha["listarFuncao"];


   if($linha["listarSubFuncao"])
       $_SESSION["listarSubFuncao"]  = $linha["listarSubFuncao"];


   if($linha["listarOrgao"])
       $_SESSION["listarOrgao"]  = $linha["listarOrgao"];


   if($linha["listarUnidadeOrcamentaria"])
       $_SESSION["listarUnidadeOrcamentaria"]  = $linha["listarUnidadeOrcamentaria"];


   if($linha["listarUnidadeGestora"])
        $_SESSION["listarUnidadeGestora"]  = $linha["listarUnidadeGestora"];


   if($linha["listarModalidade"])
       $_SESSION["listarModalidade"]  = $linha["listarModalidade"];


   if($linha["listarCategoria"])
       $_SESSION["listarCategoria"]  = $linha["listarCategoria"];


   if($linha["listarElemento"])
        $_SESSION["listarElemento"]  = $linha["listarElemento"];


   if($linha["listarCredor"])
        $_SESSION["listarCredor"]  = $linha["listarCredor"];


   if($linha["listarItem"])
      $_SESSION["listarItem"]  = $linha["listarItem"];
	 
   if($linha["listarLicitacao"])
      $_SESSION["listarLicitacao"]  = $linha["listarLicitacao"];
	 
   if($linha["listarFonteRecursos"])
      $_SESSION["listarFonteRecursos"]  = $linha["listarFonteRecursos"];
	 
   if($linha["listarValorPago"])
      $_SESSION["listarValorPago"]  = $linha["listarValorPago"];
	 

   if($linha["listarValorLiquido"])
      $_SESSION["listarValorLiquido"]  = $linha["listarValorLiquidado"];
	 

   if($linha["listarValorEmpenhado"])
      $_SESSION["listarValorEmpenhado"]  = $linha["listarValorEmpenhado"];
	 

   if($linha["listarValorDeAnosAnteriores"])
      $_SESSION["listarValorDeAnosAnteriores"]  = $linha["listarValoresAnteriores"];

	 
?>
<script>
location.href="consultas.php";</script>

