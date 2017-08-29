<?php
	
	set_time_limit(10000);

?>
<html>
	<body>
		<table border="1">
			<?php
			//conexao com o banco
			include("conexao.php");
			
			// Exemplo de scrip para exibir os nomes obtidos no arquivo CSV de exemplo
			 
			$delimitador = ',';
			$cerca = '"';
			 
			// Abrir arquivo para leitura
			$f = fopen($_GET['arquivo'], 'r');
			if ($f) {
			 
				// Ler cabecalho do arquivo
				$cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
			 
							
				echo '<tr>';
					
					foreach($cabecalho as $i=>$v){
						echo'<th>'.$v.'</th>';
					}	
				echo '</tr>';
			
			
			 
				// Enquanto nao terminar o arquivo
				while (!feof($f)) {
			 
					// Ler uma linha do arquivo
					$linha = fgetcsv($f, 0, $delimitador, $cerca);
					
					if (!$linha) {
						continue;
					}
			 
					// Montar registro com valores indexados pelo cabecalho
					$registro = array_combine($cabecalho, $linha);
			 
			 		foreach($registro as $i=>$v){
			 			$registro[$i] = utf8_encode($v);
			 		}
			 
					// Obtendo o nome
		
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA OrgaoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM orgaodespesaestado WHERE idOrgao = :cdOrgao");
					$select->execute(array("cdOrgao"=>$registro["CODIGO ORGAO"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						
						$insertOrgaoRec = $conn->prepare("INSERT INTO `orgaodespesaestado`(`idOrgao`,`nome`) VALUES (:cdOrgao,:nomeOrgao)");
						$insertOrgaoRec->execute(array("cdOrgao"=>$registro["CODIGO ORGAO"], "nomeOrgao"=>$registro["NOME ORGAO"])) ;
						
					}
					
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA UnidadeOrcamentariaDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `unidadeorcamentariadespesaestado` WHERE idUnidadeOrcamentaria = :cdUnidadeOrcamentaria");
					
					$select->execute(array("cdUnidadeOrcamentaria"=>$registro["CODIGO UNIDADE ORCAMENTARIA"]));
					
					
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `unidadeorcamentariadespesaestado`(`idUnidadeOrcamentaria`,`nome`) VALUES (:cdUnidadeOrcamentaria, :nomeUnidadeOrcamentaria)");
						$insertOrgaoRec->execute(array("cdUnidadeOrcamentaria"=>$registro["CODIGO UNIDADE ORCAMENTARIA"], "nomeUnidadeOrcamentaria"=>$registro["NOME UNIDADE ORCAMENTARIA"]));
					}
		
					
		
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA UnidadeGestoraDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `unidadegestoradespesaestado` WHERE idUnidadeGestora = :cdUnidadeGestora");
					$select->execute(array("cdUnidadeGestora"=>$registro["CODIGO UNIDADE GESTORA"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `unidadegestoradespesaestado`(`idUnidadeGestora`,`nome`,`idUnidadeOrcamentaria`,`idOrgao`) VALUES (:cdUnidadeGestora,:nomeUnidadeGestora,:cdUnidadeOrcamentaria, :cdOrgao)");
						$insertOrgaoRec->execute(array("cdUnidadeGestora"=>$registro["CODIGO UNIDADE GESTORA"], "nomeUnidadeGestora"=>$registro["NOME UNIDADE GESTORA"], "cdUnidadeOrcamentaria"=>$registro["CODIGO UNIDADE ORCAMENTARIA"], "cdOrgao"=>$registro["CODIGO ORGAO"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA ProgramaDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `programadespesaestado` WHERE idPrograma = :cdPrograma");
					$select->execute(array("cdPrograma"=>$registro["CODIGO PROGRAMA"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `programadespesaestado`(`idPrograma`,`nome`) VALUES (:cdPrograma,:nomePrograma)");
						$insertOrgaoRec->execute(array("cdPrograma"=>$registro["CODIGO PROGRAMA"], "nomePrograma"=>$registro["NOME PROGRAMA"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA FuncaoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `funcaodespesaestado` WHERE idFuncao = :cdFuncao");
					$select->execute(array("cdFuncao"=>$registro["CODIGO FUNCAO"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `funcaodespesaestado`(`idFuncao`,`nome`) VALUES (:cdFuncao,:nomeFuncao)");
						$insertOrgaoRec->execute(array("cdFuncao"=>$registro["CODIGO FUNCAO"], "nomeFuncao"=>$registro["NOME FUNCAO"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA SubFuncaoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `subfuncaodespesaestado` WHERE idSubFuncao = :cdSubFuncao");
					$select->execute(array("cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `subfuncaodespesaestado`(`idSubFuncao`,`nome`) VALUES (:cdSubFuncao,:nomeSubFuncao)");
						$insertOrgaoRec->execute(array("cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"], "nomeSubFuncao"=>$registro["NOME SUBFUNCAO"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA TemSubFuncaoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `temsubfuncaodespesaestado` WHERE idFuncao = :cdFuncao AND idSubFuncao = :cdSubFuncao");
					$select->execute(array("cdFuncao"=>$registro["CODIGO FUNCAO"],"cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"] ));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `temsubfuncaodespesaestado`(`idFuncao`,`idSubFuncao`) VALUES (:cdFuncao,:cdSubFuncao)");
						$insertOrgaoRec->execute(array("cdFuncao"=>$registro["CODIGO FUNCAO"], "cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"]));
					}
					
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA TemProgramaDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `temprogramadespesaestado` WHERE idPrograma = :cdPrograma AND idSubFuncao = :cdSubFuncao");
					$select->execute(array("cdPrograma"=>$registro["CODIGO PROGRAMA"],"cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"] ));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `temprogramadespesaestado`(`idPrograma`,`idSubFuncao`) VALUES (:cdPrograma,:cdSubFuncao)");
						$insertOrgaoRec->execute(array("cdPrograma"=>$registro["CODIGO PROGRAMA"], "cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"]));
					}
					
					
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA AcaoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `acaodespesaestado` WHERE idAcao = :cdAcao AND idPrograma = :cdPrograma AND `codigo_programa_trabalho` = :cdProgramaTrabalho ");
					$select->execute(array("cdAcao"=>$registro["CODIGO ACAO"], "cdPrograma"=>$registro["CODIGO PROGRAMA"], "cdProgramaTrabalho"=>$registro["CODIGO PROGRAMA DE TRABALHO"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `acaodespesaestado`(`idAcao`,`nome`,`idPrograma`, `codigo_programa_trabalho`) VALUES (:cdAcao, :nomeAcao, :cdPrograma, :cdProgramaTrabalho)");
						$insertOrgaoRec->execute(array("cdAcao"=>$registro["CODIGO ACAO"], "nomeAcao"=>$registro[" NOME ACAO"], "cdPrograma"=>$registro["CODIGO PROGRAMA"], "cdProgramaTrabalho"=>$registro["CODIGO PROGRAMA DE TRABALHO"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA CategoriaDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `categoriadespesaestado` WHERE `idCategoria` = :cdCategoria");
					$select->execute(array("cdCategoria"=>$registro["CODIGO CATEGORIA DE DESPESA"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `categoriadespesaestado`(`idCategoria`,`nome`) VALUES (:cdCategoria,:nomeCategoria)");
						$insertOrgaoRec->execute(array("cdCategoria"=>$registro["CODIGO CATEGORIA DE DESPESA"], "nomeCategoria"=>$registro["NOME CATEGORIA DE DESPESA"]));
					
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA GrupoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `grupodespesaestado` WHERE `idGrupo` = :cdGrupo");
					$select->execute(array("cdGrupo"=>$registro["CODIGO GRUPO DE DESPESA"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `grupodespesaestado`(`idGrupo`,`nome`, `idCategoria`) VALUES (:cdGrupo, :nomeGrupo, :cdCategoria)");
						$insertOrgaoRec->execute(array("cdGrupo"=>$registro["CODIGO GRUPO DE DESPESA"], "nomeGrupo"=>$registro["NOME GRUPO DE DESPESA"], "cdCategoria"=>$registro["CODIGO CATEGORIA DE DESPESA"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA ModalidadeDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `modalidadedespesaestado` WHERE `idModalidade` = :cdModalidade");
					$select->execute(array("cdModalidade"=>$registro["CODIGO MODALIDADE"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `modalidadedespesaestado`(`idModalidade`,`nome`, `idGrupo`) VALUES (:cdModalidade, :nomeModalidade, :cdGrupo)");
						$insertOrgaoRec->execute(array("cdModalidade"=>$registro["CODIGO MODALIDADE"], "nomeModalidade"=>$registro["NOME MODALIDADE"], "cdGrupo"=>$registro["CODIGO GRUPO DE DESPESA"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA ElementoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `elementodespesaestado` WHERE `idElemento` = :cdElemento");
					$select->execute(array("cdElemento"=>$registro["CODIGO ELEMENTO DE DESPESA"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `elementodespesaestado`(`idElemento`,`nome`, `idModalidade`) VALUES (:cdElemento, :nomeElemento, :cdModalidade)");
						$insertOrgaoRec->execute(array("cdElemento"=>$registro["CODIGO ELEMENTO DE DESPESA"], "nomeElemento"=>$registro["NOME ELEMENTO DE DESPESA"], "cdModalidade"=>$registro["CODIGO MODALIDADE"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA ItemDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `itemdespesaestado` WHERE `idItem` = :cdItem");
					$select->execute(array("cdItem"=>$registro["CODIGO ITEM DE DESPESA"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `itemdespesaestado`(`idItem`,`nome`, `idElemento`) VALUES (:cdItem, :nomeItem, :cdElemento)");
						$insertOrgaoRec->execute(array("cdItem"=>$registro["CODIGO ITEM DE DESPESA"], "nomeItem"=>$registro["NOME ITEM DE DESPESA"], "cdElemento"=>$registro["CODIGO ELEMENTO DE DESPESA"]));
					}
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA NotaDeEmpenhoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `notadeempenhodespesaestado` WHERE numero = :cdNumero");
					$select->execute(array("cdNumero"=>$registro["NUMERO NOTA DE EMPENHO"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `notadeempenhodespesaestado`(`idNotadeEmpenho`,`numero`) VALUES (NULL,:numeroNotadeEmpenho)");
						$insertOrgaoRec->execute(array("numeroNotadeEmpenho"=>$registro["NUMERO NOTA DE EMPENHO"]));
					}
					
					$select = $conn->prepare("SELECT `idNotadeEmpenho` FROM `notadeempenhodespesaestado` WHERE numero = :numeroNotadeEmpenho");
					$select->execute(array("numeroNotadeEmpenho"=>$registro["NUMERO NOTA DE EMPENHO"]));
					$l=$select->fetch();
					$codNotaEmpenho = $l["idNotadeEmpenho"];
					
					
					try{
						//VERIFICANDO EXISTENCIA DE DADOS NA TABELA LicitacaoDespesaEstado
						$select = $conn->prepare("SELECT count(*) as contagem FROM `licitacaodespesaestado` WHERE nome = :cdNome");
						//Caracter "espaço" acrescentado devido ao erro no arquivo original (espaço antes do nome do campo)
						$select->execute(array("cdNome"=>$registro[" TIPO LICITACAO"]));
						$l=$select->fetch();
					}
					catch(exception $e){
										echo $e;
										die("SELECT count(*) as contagem FROM `licitacaodespesaestado` WHERE nome = '".$registro[" TIPO LICITACAO"]."'");
					}
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `licitacaodespesaestado`(`idLicitacao`,`nome`) VALUES (NULL,:cdNome)");
						$insertOrgaoRec->execute(array("cdNome"=>$registro[" TIPO LICITACAO"]));
					}
					
					$select = $conn->prepare("SELECT idLicitacao FROM `licitacaodespesaestado` WHERE nome = :cdNome");
					$select->execute(array("cdNome"=>$registro[" TIPO LICITACAO"]));
					$l=$select->fetch();
					$codLicitacao = $l["idLicitacao"];
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA CredorDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `credordespesaestado` WHERE idCredor = :cdCredor");
					$select->execute(array("cdCredor"=>$registro["CODIGO CREDOR"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `credordespesaestado`(`idCredor`,`nome`) VALUES (:idCredor,:nomeCredor)");
						$insertOrgaoRec->execute(array("idCredor"=>$registro["CODIGO CREDOR"], "nomeCredor"=>$registro["NOME CREDOR"]));
					}					
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA ProcessoDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `processodespesaestado` WHERE numero = :cdNumero");
					$select->execute(array("cdNumero"=>$registro["NUMERO PROCESSO"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `processodespesaestado`(`idProcesso`,`numero`) VALUES (NULL,:cdNumero)");
						$insertOrgaoRec->execute(array("cdNumero"=>$registro["NUMERO PROCESSO"]));
					}
					
					$select = $conn->prepare("SELECT `idProcesso` FROM `processodespesaestado` WHERE numero = :cdNumero");
					$select->execute(array("cdNumero"=>$registro["NUMERO PROCESSO"]));
					$l=$select->fetch();
					$codProcesso = $l["idProcesso"];
					
					//VERIFICANDO EXISTENCIA DE DADOS NA TABELA FonteRecursosDespesaEstado
					$select = $conn->prepare("SELECT count(*) as contagem FROM `fonterecursosdespesaestado` WHERE idFonteRecurso = :cdFonteRecurso");
					$select->execute(array("cdFonteRecurso"=>$registro["CODIGO FONTE DE RECURSOS"]));
					$l=$select->fetch();
					
					
					if($l["contagem"]== 0){
						$insertOrgaoRec = $conn->prepare("INSERT INTO `fonterecursosdespesaestado`(`idFonteRecurso`,`nome`) VALUES (:cdFonteRecurso,:cdNome)");
						$insertOrgaoRec->execute(array("cdFonteRecurso"=>$registro["CODIGO FONTE DE RECURSOS"], "cdNome"=>$registro["NOME FONTE DE RECURSOS"]));
					}
					
					
					$insert = $conn->prepare("INSERT INTO `despesaestado` 
											(
												`ano`, 
												`ValorEmpenhado`, 
												`valorLiquido`, 
												`valorPago`, 
												`valorDeAnosAnteriores`, 
												`idDespesa`, 
												`idOrgao`, 
												`idSubFuncao`, 
												`idCategoria`, 
												`idPrograma`, 
												`idGrupo`, 
												`idUnidadeOrcamentaria`, 
												`idUnidadeGestora`, 
												`idModalidade`,
												`idElemento`,
												`idItem`,
												`idCredor`,
												`idFuncao`,
												`idAcao`,
												`idNotadeEmpenho`,
												`idProcesso`,
												`idLicitacao`,
												`idFonteRecurso`
											) VALUES 
											(
												:Ano, 
												:valorEmpenhado,
												:valorLiquido,
												:valorPago,
												:valorDeAnosAnteriores,
												:idDespesa,
												:cdOrgao, 
												:cdSubFuncao, 
												:cdCategoria, 
												:cdPrograma, 
												:cdGrupo, 
												:cdUnidadeOrcamentaria, 
												:cdUnidadeGestora,
												:cdModalidade, 
												:cdElemento,
												:cdItem,
												:cdCredor,
												:cdFuncao,
												:cdAcao,
												:cdNotadeEmpenho,
												:cdProcesso,
												:cdLicitacao,
												:cdFonteRecurso)");
							

					$valorAnosAnteriores = 	$registro["VALOR PAGO DE ANOS ANTERIORES"];
					if(!$valorAnosAnteriores){
						$valorAnosAnteriores = 0;
					}
					
					$vetor_receita = array(
										"Ano"=>$_GET["ano"],
										"valorEmpenhado"=>(float)str_replace(",",".",$registro["VALOR EMPENHADO"]),
										"valorLiquido"=>(float)str_replace(",",".",$registro["VALOR LIQUIDADO"]), 
										"valorPago"=>(float)str_replace(",",".",$registro["VALOR PAGO"]),
										"valorDeAnosAnteriores"=>(float)str_replace(",",".",$valorAnosAnteriores), 
										"idDespesa"=>NULL,
										"cdOrgao"=>$registro["CODIGO ORGAO"], 
										"cdSubFuncao"=>$registro["CODIGO SUBFUNCAO"], 
										"cdCategoria"=>$registro["CODIGO CATEGORIA DE DESPESA"],
										"cdPrograma"=>$registro["CODIGO PROGRAMA"], 
										"cdGrupo"=>$registro["CODIGO GRUPO DE DESPESA"], 
										"cdUnidadeOrcamentaria"=>$registro["CODIGO UNIDADE ORCAMENTARIA"], 
										"cdUnidadeGestora"=>$registro["CODIGO UNIDADE GESTORA"], 
										"cdModalidade"=>$registro["CODIGO MODALIDADE"], 
										"cdElemento"=>$registro["CODIGO ELEMENTO DE DESPESA"],
										"cdItem"=>$registro["CODIGO ITEM DE DESPESA"],
										"cdCredor"=>$registro["CODIGO CREDOR"],
										"cdFuncao"=>$registro["CODIGO FUNCAO"],
										"cdAcao"=>$registro["CODIGO ACAO"],
										"cdNotadeEmpenho"=>$codNotaEmpenho,
										"cdProcesso"=>$codProcesso,
										"cdLicitacao"=>$codLicitacao,
										"cdFonteRecurso"=>$registro["CODIGO FONTE DE RECURSOS"]
										);
					
											
					try {
						$insert->execute($vetor_receita);		
					
					}
					catch(Exception $e) {
						echo 'Exception -> ';
						var_dump($e->getMessage());
						print_r($vetor_receita);
						echo "<br>".count($vetor_receita);
					}
					
				}
				
				fclose($f);
			}
			?>
		</table>
		
		Carregamento concluído com sucesso.
	</body>
</html>