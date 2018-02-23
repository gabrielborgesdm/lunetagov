
<?php
/*
  Verifica se  a consulta poderá ser exibida. Situações:
  1) Consulta acabou de ser realizada. $_POST["consultar"] está setada (e com valor 1, pré-definido no formulário);
  2) Usuário está navegando nas páginas da consulta realizada.
 */

if (isset($_POST["consultar"]) || isset($_SESSION["historico"]) || (isset($_SESSION["consulta"]) && (isset($_GET["pg"])))) {
    

    if (isset($_POST["consultar"]) && isset($_SESSION["consulta"])) {
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
    }


//vetor vazio	
    $arraySql = array();

    $sql = "SELECT SUM(valorPago) as totalPago, 
            SUM(valorEmpenhado) as totalEmpenhado, 
            SUM(valorLiquido) as  totalLiquido,
            SUM(valorDeAnosAnteriores) as totalAnosAnteriores
            FROM `despesaestado` WHERE 1=1 ";


    /* definição da página atual caso tenha entrado no exibir consultas pela 2a opção */
    if ((isset($_SESSION["consulta"]) && isset($_GET["pg"]))) {
        $pg = (int) $_GET["pg"] - 1; // pagina 2, tem que ser do 11o ao 20o resultado. Por isso o -1.
    }
    /* caso contrário, o usuário acabou de selecionar um filtro, e a consulta será realizada de acordo com o filtro. */ else {
        if (isset($_POST["funcao"])) {
            include("monta_consulta_por_post.php");
        } else {
            include("monta_consulta_por_historico.php");
        }
    }

    $pg = $pg * 10;

     
    if (!isset($_SESSION["totalPago"])) {
        $_SESSION["totalPago"] = number_format($l["totalPago"], 2, ",", ".");
    }

    echo'
    <p class="text-info">
        <h4>Total envolvido de R$ '.$_SESSION["totalPago"].'</h4>    
    </p>';

// Inicializa cabecalhos de informação da tabela
    $titulos = ' 
	<div class="table-responsive col-xs-12" style="padding:0">
            <table class="table table-bordered table-striped">
                <tr class="text-info">
                    <th>Ano</th>';

//inicializa variavel de consulta baseada nos filtros


    $select = "SELECT ano";

    //inicializa variavel que será concatenada na variavel $select após passar pelas condições dos filtros escolhidos pelo usuários
    $joinSelect = "";

    // se foi selecionado para exibir o item função (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarFuncao']) || isset($_SESSION["listarFuncao"])) {
        //cria-se a sessão listarFuncao para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarFuncao"] = 1;
        //concatena na variavel $titulo as colunas Cod Função e Função.
        $titulos .= '
            <th>Cod Função</th>
            <th>Função</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta		
        $select .= ", de.idFuncao as idFuncao, fde.nome AS nomeFuncao";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e funcaodespesaestado
        $joinSelect .= " join `funcaodespesaestado` AS fde ON fde.idFuncao=de.idFuncao";

        if ($_SESSION['funcao'] != "0") {
            $joinSelect .= ' AND de.idFuncao=' . $_SESSION['funcao'];
        }
    }

    // se foi selecionado para exibir o item subFunção (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarSubFuncao']) || isset($_SESSION["listarSubFuncao"])) {
        //cria-se a sessão listarSubFuncao para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarSubFuncao"] = 1;
        //concatena na variavel $titulo as colunas Cod SubFunção e SubFunção.
        $titulos .= '
            <th>Cod SubFunção</th>
            <th>Subfunção</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta		
        $select .= ",de.idSubFuncao as idSubFuncao, sfde.nome AS nomeSubFuncao";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e subfuncaodespesaestado
        $joinSelect .= " join `subfuncaodespesaestado` AS sfde ON sfde.idSubFuncao=de.idSubFuncao";

        if ($_SESSION['subfuncao'] != 0) {
            $joinSelect .= ' AND de.idSubFuncao=' . $_SESSION['subfuncao'];
        }
    }

    // se foi selecionado para exibir o item orgao (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarOrgao']) || isset($_SESSION["listarOrgao"])) {
        //cria-se a sessão listarOrgao para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarOrgao"] = 1;
        //concatena na variavel $titulo as colunas Cod Orgão e Orgão.
        $titulos .= '
            <th>Cod Orgão</th>
            <th>Orgão</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idOrgao as idOrgao, ode.nome AS nomeOrgao";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e orgaodespesaestado
        $joinSelect .= " join `orgaodespesaestado` AS ode ON ode.idOrgao=de.idOrgao";

        if ($_SESSION['orgao'] != 0) {
            $joinSelect .= ' AND de.idOrgao=' . $_SESSION['orgao'];
        }
    }

    // se foi selecionado para exibir o item categoria (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarCategoria']) || isset($_SESSION["listarCategoria"])) {
        //cria-se a sessão listarCategoria para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarCategoria"] = 1;
        //concatena na variavel $titulo as colunas Cod Categoria e Categoria.
        $titulos .= '
            <th>Cod Categoria</th>
            <th>Categoria</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idCategoria as idCategoria, cde.nome AS nomeCategoria";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e categoriadespesaestado
        $joinSelect .= " join `categoriadespesaestado` AS cde ON cde.idCategoria=de.idCategoria";

        if ($_SESSION['categoria'] != 0) {
            $joinSelect .= ' AND de.idCategoria=' . $_SESSION['categoria'];
        }
    }

    // se foi selecionado para exibir o item grupo (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarGrupo']) || isset($_SESSION["listarGrupo"])) {
        //cria-se a sessão listarGrupo para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarGrupo"] = 1;
        //concatena na variavel $titulo as colunas Cod Grupo e Grupo.
        $titulos .= '
            <th>Cod Grupo</th>
            <th>Grupo</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idGrupo as idGrupo, gde.nome AS nomeGrupo";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e grupodespesaestado
        $joinSelect .= " join `grupodespesaestado` AS gde ON gde.idGrupo=de.idGrupo";

        if ($_SESSION['grupo'] != 0) {
            $joinSelect .= ' AND de.idGrupo=' . $_SESSION['grupo'];
        }
    }

    // se foi selecionado para exibir o item unidadeOrcamentaria (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarUnidadeOrcamentaria']) || isset($_SESSION["listarUnidadeOrcamentaria"])) {
        //cria-se a sessão listarUnidadeOrcamentaria para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarUnidadeOrcamentaria"] = 1;
        //concatena na variavel $titulo as colunas Cod unidade Orcamentaria e Unidade Orcamentaria.
        $titulos .= '
            <th>Cod Unidade Orçamentária</th>
            <th>Unidade Orçãmentária</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idUnidadeOrcamentaria as idUnidadeOrcamentaria, uode.nome AS nomeUnidadeOrcamentaria";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e unidadeorcamentariadespesaestado
        $joinSelect .= " join `unidadeorcamentariadespesaestado` AS uode ON uode.idUnidadeOrcamentaria=de.idUnidadeOrcamentaria";

        if ($_SESSION['unidadeorcamentaria'] != 0) {
            $joinSelect .= ' AND de.idUnidadeOrcamentaria=' . $_SESSION['unidadeorcamentaria'];
        }
    }

    // se foi selecionado para exibir o item unidadeGestora (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarUnidadeGestora']) || isset($_SESSION["listarUnidadeGestora"])) {
        //cria-se a sessão listarUnidadeGestora para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarUnidadeGestora"] = 1;
        //concatena na variavel $titulo as colunas Cod Unidade Gestora e Unidade Gestora.
        $titulos .= '
            <th>Cod Unidade Gestora</th>
            <th>Unidade Gestora</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idUnidadeGestora as idUnidadeGestora, ugde.nome AS nomeUnidadeGestora";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e unidadeGestora
        $joinSelect .= " join `unidadegestoradespesaestado` AS ugde ON ugde.idUnidadeGestora=de.idUnidadeGestora";

        if ($_SESSION['unidadegestora'] != 0) {
            $joinSelect .= ' AND de.idUnidadeGestora=' . $_SESSION['unidadegestora'];
        }
    }

    // se foi selecionado para exibir o item modalidade  (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarModalidade']) || isset($_SESSION["listarModalidade"])) {
        //cria-se a sessão listarModalidade para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarModalidade"] = 1;
        //concatena na variavel $titulo as colunas Cod Modalidade e Modalidade.
        $titulos .= '
            <th>Cod Modalidade</th>
            <th>Modalidade</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idModalidade as idModalidade, mde.nome AS nomeModalidade";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e modalidadedespesaestado
        $joinSelect .= " join `modalidadedespesaestado` AS mde ON mde.idModalidade=de.idModalidade";

        if ($_SESSION['modalidade'] != 0) {
            $joinSelect .= ' AND de.idModalidade=' . $_SESSION['modalidade'];
        }
    }

    // se foi selecionado para exibir o item elemento (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarElemento']) || isset($_SESSION["listarElemento"])) {
        //cria-se a sessão listarElemento para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarElemento"] = 1;
        //concatena na variavel $titulo as colunas Cod Elemento e Elemento.
        $titulos .= '
            <th>Cod Elemento</th>
            <th>Elemento</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idElemento as idElemento, ede.nome AS nomeElemento";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e elementodespesaestado
        $joinSelect .= " join `elementodespesaestado` AS ede ON ede.idElemento=de.idElemento";

        if ($_SESSION['elemento'] != 0) {
            $joinSelect .= ' AND de.idElemento=' . $_SESSION['elemento'];
        }
    }

    // se foi selecionado para exibir o item Item (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarItem']) || isset($_SESSION["listarItem"])) {
        //cria-se a sessão listarItem para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarItem"] = 1;
        //concatena na variavel $titulo as colunas Cod Item e Item.
        $titulos .= '
            <th>Cod Item</th>
            <th>Item</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idItem as idItem, ide.nome AS nomeItem";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e itemdespesaestado
        $joinSelect .= " join `itemdespesaestado` AS ide ON ide.idItem=de.idItem";

        if ($_SESSION['item'] != 0) {
            $joinSelect .= ' AND de.idItem=' . $_SESSION['item'];
        }
    }

    // se foi selecionado para exibir o item credor (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarCredor']) || isset($_SESSION["listarCredor"])) {
        //cria-se a sessão listarCredor para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarCredor"] = 1;
        //concatena na variavel $titulo as colunas Cod Credor e Credor.
        $titulos .= '
            <th>Cod Credor</th>
            <th>Credor</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idCredor as idCredor, crde.nome AS nomeCredor";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e credordespesaestado
        $joinSelect .= " join `credordespesaestado` AS crde ON crde.idCredor=de.idCredor";

        if ($_SESSION['credor'] != 0) {
            $joinSelect .= ' AND de.idCredor=' . $_SESSION['credor'];
        }
    }

    // se foi selecionado para exibir o item licitacao (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarLicitacao']) || isset($_SESSION["listarLicitacao"])) {
        //cria-se a sessão listarLicitacao para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarLicitacao"] = 1;
        //concatena na variavel $titulo as colunas Cod Credor e Credor.
        $titulos .= '
            <th>Cod Licitação</th>
            <th>Licitação</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idLicitacao as idLicitacao, lde.nome AS nomeLicitacao";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e licitacaodespesaestado
        $joinSelect .= " join `licitacaodespesaestado` AS lde ON lde.idLicitacao=de.idLicitacao";

        if ($_SESSION['licitacao'] != 0) {
            $joinSelect .= ' AND de.idLicitacao=' . $_SESSION['licitacao'];
        }
    }

    // se foi selecionado para exibir o item fonteRecursos (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarFonteRecursos']) || isset($_SESSION["listarFonteRecursos"])) {
        //cria-se a sessão listarFonteRecursos para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarFonteRecursos"] = 1;
        //concatena na variavel $titulo as colunas Cod Fonte de Recursos e Fonte de Recursos.
        $titulos .= '
            <th>Cod Fontre de Recursos</th>
            <th>Fonte de Recursos</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idFonteRecurso as idFonteRecurso, frde.nome AS nomeFonteRecurso";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e fonterecursosdespesaestado
        $joinSelect .= " join `fonterecursosdespesaestado` AS frde ON frde.idFonteRecurso=de.idFonteRecurso";

        if ($_SESSION['fonterecursos'] != 0) {
            $joinSelect .= ' AND de.idFonteRecurso=' . $_SESSION['fonterecursos'];
        }
    }

    // se foi selecionado para exibir o item acao (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarAcao']) || isset($_SESSION["listarAcao"])) {
        //cria-se a sessão listarAcao para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarAcao"] = 1;
        //concatena na variavel $titulo as colunas Cod Acao e Acao.
        $titulos .= '
            <th>Cod Ação</th>
            <th>Ação</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",de.idAcao as idAcao, ade.nome AS nomeAcao";
        //concatena na variavel $joinSelect as juncoes de tabela despesaestado e acaodespesaestado
        $joinSelect .= " join `acaodespesaestado` AS ade ON ade.idAcao=de.idAcao";

        if ($_SESSION['acao'] != 0) {
            $joinSelect .= ' AND de.idAcao=' . $_SESSION['acao'];
        }
    }

    // se foi selecionado para exibir o item valorPago (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarValorPago']) || isset($_SESSION["listarValorPago"])) {
        //cria-se a sessão listarValorPago para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarValorPago"] = 1;
        //concatena na variavel $titulo a coluna Valor Pago.
        $titulos .= '<th>Valor Pago</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",valorPago";
    }

    // se foi selecionado para exibir o item valorEmpenhado (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarValorEmpenhado']) || isset($_SESSION["listarValorEmpenhado"])) {
        //cria-se a sessão listarValorEmpenhado para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarValorEmpenhado"] = 1;
        //concatena na variavel $titulo a coluna Valor Empenhado.
        $titulos .= '<th>Valor Empenhado</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",valorEmpenhado";
    }

    // se foi selecionado para exibir o item valorliquido (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarValorLiquido']) || isset($_SESSION["listarValorLiquido"])) {
        //cria-se a sessão listarValorLiquido para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarValorLiquido"] = 1;
        //concatena na variavel $titulo a coluna Valor Liquido.
        $titulos .= '<th>Valor Liquido</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",valorLiquido";
    }

    // se foi selecionado para exibir o item valorDeAnosAnteriores (ou no post, ou na navegação das páginas)...
    if (isset($_POST['listarValorDeAnosAnteriores']) || isset($_SESSION["listarValorDeAnosAnteriores"])) {
        //cria-se a sessão listarValorDeAnosAnteriores para que durante a navegação em páginas esta continue a entrar nos filtros.
        $_SESSION["listarValorDeAnosAnteriores"] = 1;
        //concatena na variavel $titulo a coluna Valor de Anos Anteriores.
        $titulos .= '<th>Valor de Anos Anteriores</th>';
        //concatena na variavel $select os itens a serem selecionados na consulta
        $select .= ",valorDeAnosAnteriores";
    }


    $titulos .= '</tr>';
    //Se nenhum ano tiver sido selecionado
    if (isset($_POST["anoExecucao"]) || isset($_SESSION["anoExecucao"])){
            if(!isset($_SESSION["anoExecucao"])){
                $_SESSION["anoExecucao"] = $_POST["anoExecucao"];
            }
            if($_SESSION["anoExecucao"] != 0){
                $joinSelect.= " AND ano = ".$_POST["anoExecucao"];
            }
            
	}
    
    if ((!isset($_SESSION["consulta"]) && isset($_POST["consultar"])) || isset($_SESSION["historico"])) {

        $select .= " FROM despesaestado AS de " . $joinSelect;
        $_SESSION["consulta"] = $select;
    } else {
        $select = $_SESSION["consulta"];
    }


    //conta quantos resultados foram definidos
    $selectContagem = " SELECT COUNT(*) AS qtd FROM despesaestado AS de " . $joinSelect;
    $consulta = $conn->prepare($selectContagem);
    $consulta->execute();
    $linha = $consulta->fetch();
    $qtdElementos = $linha['qtd'];

    //salvando consulta no historico
    if (isset($_POST["salvar"]) && $_POST["salvar"] == "Sim" && $_SESSION["logado"]) {

        $inserirSelect = "INSERT INTO `historico`	VALUES ('',
        :id_usuario, :data, :descricao, :funcao, :subfuncao, :acao, :orgao, :categoria, :grupo,
        :unidadeOrcamentaria, :unidadeGestora, :modalidade, :elemento, :item, :credor, :licitacao,
        :fonteRecurso, :listarFuncao, :listarSubfuncao, :listarAcao, :listarOrgao, :listarCategoria,
        :listarGrupo, :listarUnidadeGestora, :listarUnidadeOrcamentaria, :listarModalidade, 
        :listarElemento, :listarItem, :listarCredor, :listarLicitacao, :listarFonteRecursos,
        :listarValorPago, :listarValorEmpenhado, :listarValorLiquidado,:listarValoresAnteriores) ";

        $insercaoHistorico = $conn->prepare($inserirSelect);

        $trueFalse["on"] = 1;
        $trueFalse[""] = 0;

        $vetorInsercao = array(
            "id_usuario" => $_SESSION["id_usuario"],
            "data" => date("Y-m-d H:i:s"),
            "descricao" => $_POST["descricao"],
            "funcao" => $_POST["funcao"],
            "subfuncao" => $_POST["subfuncao"],
            "acao" => $_POST["acao"],
            "orgao" => $_POST["orgao"],
            "categoria" => $_POST["categoria"],
            "grupo" => $_POST["grupo"],
            "unidadeOrcamentaria" => $_POST["unidadeorcamentaria"],
            "unidadeGestora" => $_POST["unidadegestora"],
            "modalidade" => $_POST["modalidade"],
            "elemento" => $_POST["elemento"],
            "item" => $_POST["item"],
            "credor" => $_POST["credor"],
            "licitacao" => $_POST["licitacao"],
            "fonteRecurso" => $_POST["fonterecursos"],
            "listarFuncao" => $trueFalse[$_POST["listarFuncao"]],
            "listarSubfuncao" => $trueFalse[$_POST["listarSubFuncao"]],
            "listarAcao" => $trueFalse[$_POST["listarAcao"]],
            "listarOrgao" => $trueFalse[$_POST["listarOrgao"]],
            "listarCategoria" => $trueFalse[$_POST["listarCategoria"]],
            "listarGrupo" => $trueFalse[$_POST["listarGrupo"]],
            "listarUnidadeGestora" => $trueFalse[$_POST["listarUnidadeGestora"]],
            "listarUnidadeOrcamentaria" => $trueFalse[$_POST["listarUnidadeOrcamentaria"]],
            "listarModalidade" => $trueFalse[$_POST["listarModalidade"]],
            "listarElemento" => $trueFalse[$_POST["listarElemento"]],
            "listarItem" => $trueFalse[$_POST["listarItem"]],
            "listarCredor" => $trueFalse[$_POST["listarCredor"]],
            "listarLicitacao" => $trueFalse[$_POST["listarLicitacao"]],
            "listarFonteRecursos" => $trueFalse[$_POST["listarFonteRecursos"]],
            "listarValorPago" => $trueFalse[$_POST["listarValorPago"]],
            "listarValorEmpenhado" => $trueFalse[$_POST["listarValorEmpenhado"]],
            "listarValorLiquidado" => $trueFalse[$_POST["listarValorLiquido"]],
            "listarValoresAnteriores" => $trueFalse[$_POST["listarDeAnosAnteriores"]]
        );
        //print_r($vetorInsercao);
        $insercaoHistorico->execute($vetorInsercao) or die("Erro ao inserir historico");
    }
    
    //Variavel usada para o download dos dados
    $selecionaDados = $select;
    
    
    //Se for a primeira pagina a variavel torna 1
    if(isset($_GET["pg"])){
        if($_GET["pg"] == "1"){
            $validaPg1 = 1;
        }
        else{
            $validaPg1 = 0;
        }
    }
    else{
       $validaPg1 = 1; 
    }
    //armazena a variavel em uma session
    if( isset($_POST["selectTopDez"])){
        $_SESSION["selectTopDez"] = $_POST["selectTopDez"];
    }
    //só entra no if se for a primeira pagina
    if($validaPg1){
        if($_SESSION["selectTopDez"] != '0' ){
        
            switch ($_SESSION["selectTopDez"]){
                case "listarFuncao":
                    $nomeTopDez = "fde.nome";
                    break;

                case "listarSubFuncao":
                    $nomeTopDez ="sfde.nome";
                    break;

                case "listarAcao":
                    $nomeTopDez ="ade.nome";
                    break;

                case "listarOrgao":
                    $nomeTopDez ="ode.nome";
                    break;

                case "listarCategoria":
                    $nomeTopDez ="cde.nome";
                    break;

                case "listarGrupo":
                    $nomeTopDez ="gde.nome";
                    break;

                case "listarUnidadeOrcamentaria":
                    $nomeTopDez ="uode.nome";
                    break;

                case "listarUnidadeGestora":
                    $nomeTopDez ="ugde.nome";
                    break;

                case "listarModalidade":
                    $nomeTopDez ="mde.nome";
                    break;

                case "listarElemento":
                    $nomeTopDez ="ede.nome";
                    break;

                case "listarItem":
                    $nomeTopDez ="ide.nome";
                    break;

                case "listarCredor":
                    $nomeTopDez ="crde.nome";
                    break;

                case "listarLicitacao":
                    $nomeTopDez ="lde.nome";
                    break;

                case "listarFonteRecursos":
                    $nomeTopDez ="frde.nome";
                    break;

            }
            //divide o select em duas partes: tudo antes do from e tudo depois
            $selectTop10 = explode("FROM",$select);

            $selectTop10[0] = "SELECT $nomeTopDez, SUM(valorPago) as soma FROM ";
            $selectTop10[1] .= " GROUP BY $nomeTopDez ORDER BY soma DESC LIMIT 10";
            $selectTop10 = implode(" ",$selectTop10);

            $consulta = $conn->prepare($selectTop10);
            $consulta->execute();


            $i = 0;
            //armazena em uma matriz
            while ($linha = $consulta->fetch()) {

                $matrizTopDez[$i][0] = $linha["nome"];
                $matrizTopDez[$i][1] = $linha["soma"];
                $i++;
            }
            if(isset($matrizTopDez)){
                //monta a tabela com as barras de progresso
                echo'
                    <div class="col-xs-12 text-center">
                        <h1 class="text-info page-header">Top10</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-info">
                                        <th>Itens do campo definidor</th>
                                        <th>Barra de proporção</th>
                                        <th>Quantidade envolvida</th>
                                    </tr>
                                </thead>    
                    ';

                for($i=0;$i<count($matrizTopDez);$i++){
                        echo'
                            <tr>
                                <td>'.$matrizTopDez[$i][0].'</td> '
                                . '<td> <progress value="'.$matrizTopDez[$i][1].'" max="'.$matrizTopDez[0][1].'"></progress></td>'
                                .'<td class="text-info">'.number_format($matrizTopDez[$i][1], 2, ",", ".").'</td>
                            </tr>
                        ';
                }

                    echo'
                        </table>          
                    </div>    
                    '; 
            }

        }
    }    
	
    
    //finaliza a consulta com a paginação
    $select .= " LIMIT $pg, 10";

    //executa a consulta-
    $consulta = $conn->prepare($select);
    $consulta->execute();
    echo'<h1 class="text-info page-header">Consulta</h1>' . $titulos;

    $cor[0] = "#F0F0F0";
    $cor[1] = "FFFFFF";
    $i = 0;
    while ($linha = $consulta->fetch()) {

        echo 
            "<tr>
                <td>" . $linha["ano"] . "</td>";

        if (isset($_SESSION['listarFuncao'])) {
            echo '
                <td>' . $linha["idFuncao"] . '</td>
                <td>' . $linha['nomeFuncao'] . '</td>';
        }
        if (isset($_SESSION['listarSubFuncao'])) {
            echo '
                <td>' . $linha["idSubFuncao"] . '</td>
                <td>' . $linha['nomeSubFuncao'] . '</td>';
        }
        if (isset($_SESSION['listarAcao'])) {
            echo '
                <td>' . $linha["idAcao"] . '</td>
                <td>' . $linha['nomeAcao'] . '</td>';
        }
        if (isset($_SESSION['listarOrgao'])) {
            echo '
                <td>' . $linha["idOrgao"] . '</td>
                <td>' . $linha['nomeOrgao'] . '</td>';
        }
        if (isset($_SESSION['listarCategoria'])) {
            echo '
                <td>' . $linha["idCategoria"] . '</td>
                <td>' . $linha['nomeCategoria'] . '</td>';
        }
        if (isset($_SESSION['listarGrupo'])) {
            echo '
                <td>' . $linha["idGrupo"] . '</td>
                <td>' . $linha['nomeGrupo'] . '</td>';
        }
        if (isset($_SESSION['listarUnidadeGestora'])) {
            echo '
                <td>' . $linha["idUnidadeGestora"] . '</td>
                <td>' . $linha['nomeUnidadeGestora'] . '</td>';
        }
        if (isset($_SESSION['listarUnidadeOrcamentaria'])) {
            echo '
                <td>' . $linha["idUnidadeOrcamentaria"] . '</td>
                <td>' . $linha['nomeUnidadeOrcamentaria'] . '</td>';
        }
        if (isset($_SESSION['listarModalidade'])) {
            echo '
                <td>' . $linha["idModalidade"] . '</td>
                <td>' . $linha['nomeModalidade'] . '</td>';
        }
        if (isset($_SESSION['listarElemento'])) {
            echo '
                <td>' . $linha["idElemento"] . '</td>
                <td>' . $linha['nomeElemento'] . '</td>';
        }
        if (isset($_SESSION['listarItem'])) {
            echo '
                <td>' . $linha["idItem"] . '</td>
                <td>' . $linha['nomeItem'] . '</td>';
        }
        if (isset($_SESSION['listarCredor'])) {
            echo '
                <td>' . $linha["idCredor"] . '</td>
                <td>' . $linha['nomeCredor'] . '</td>';
        }
        if (isset($_SESSION['listarLicitacao'])) {
            echo '
                <td>' . $linha["idLicitacao"] . '</td>
                <td>' . $linha['nomeLicitacao'] . '</td>';
        }
        if (isset($_SESSION['listarFonteRecursos'])) {
            echo '
                <td>' . $linha["idFonteRecurso"] . '</td>
                <td>' . $linha['nomeFonteRecurso'] . '</td>';
        }
        if (isset($_SESSION['listarValorPago'])) {
            echo '
                <td>' . number_format($linha["valorPago"], 2, ",", ".") . '</td>';
        }
        if (isset($_SESSION['listarValorEmpenhado'])) {
            echo '
                <td>' . number_format($linha["valorEmpenhado"], 2, ",", ".") . '</td>';
        }
        if (isset($_SESSION['listarValorLiquido'])) {
            echo '
                <td>' . number_format($linha["valorLiquido"], 2, ",", ".") . '</td>';
        }
        if (isset($_SESSION['listarDeAnosAnteriores'])) {
            echo '
                <td>' . number_format($linha["valorDeAnosAnteriores"], 2, ",", ".") . '</td>';
        }

        echo "</tr>";
        $i++;
    }

    echo'
            </table>
        </div>
        ';

    //Inclui o form que disponibiliza arquivos csv,xml,etc
    include("fazerDownload.php");

    $qtdPagina = $qtdElementos / 10;
   
    echo'    
    <div class="col-xs-12" style="margin-bottom:20px;">
        <p class="text-info">Você está na página '. ((int) $pg / 10 + 1) . ' Existem ' . round($qtdPagina) . ' páginas para esta consulta. Digite abaixo a página desejada</p>   
        
        <form name="pagina" method="Get" class="form-inline" action="consultas.php">
            <div class="form-group">                
                <input class="form-control" type="number" name="pg" />               
            </div>           
            <button type="submit" class="btn btn-default">Ir</button>           
        </form>
    </div>
    ';

   
}
?>
