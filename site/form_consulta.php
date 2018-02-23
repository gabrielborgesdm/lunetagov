<form name="consulta" id="consulta" action="consultas.php" method="post">

    <fieldset class="form-group scheduler-border col-xs-12">
        <legend class="scheduler-border">
            Selecione uma Esfera Governamental e o item orçamentário
        </legend>
        <div class="form-check form-check-inline">
            <label>Esfera:</label>
            <label class="radio-inline">
                <input class="form-check-input" type="radio" name="esfera" disabled><span class="text-muted">Governo Federal</span>
            </label>
            <label class="radio-inline">
                <input class="form-check-input" type="radio" name="esfera" checked>Governo Estadual
            </label>
            <label class="radio-inline">
                <input class="form-check-input" type="radio" name="esfera" disabled><span class="text-muted">Governo Municipal</span>
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label>Item:</label>
            <label class="radio-inline">
                <input class="form-check-input" type="radio" name="itemOrcamentario" disabled><span class="text-muted"> Receita</span>
            </label>
            <label class="radio-inline">
                <input class="form-check-input" type="radio" name="itemOrcamentario" checked>Despesa
            </label>
        </div>
    </fieldset>

    <fieldset class="scheduler-border col-xs-12" style="padding-right:45px">
        <legend class="scheduler-border">Selecione os filtros que deseja realizar em sua consulta</legend>

        <div class="form-group col-xs-10 col-xs-offset-1">
            <select name="anoExecucao" class="filtroExec form-control" >
                <option value="0">Selecione um Ano</option>
                <?php
                $select = $conn->prepare("SELECT DISTINCT ano FROM `despesaestado` ORDER BY ano");
                $select->execute(array());
                while ($l = $select->fetch()) {
                    echo "<option value='" . $l["ano"] . "'>" . $l["ano"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-xs-1 text-left glyphiconHelp">
            <span class="glyphicon glyphicon-question-sign" rel="tooltip"  title="Ano desejado para a pesquisa"></span>
        </div>

        <div class="form-group col-xs-10 col-xs-offset-1">
            <select name="funcao" class="filtroExec form-control">
                <option value="0">Selecione uma Função</option>
                <?php
                $select = $conn->prepare("SELECT * FROM `funcaodespesaestado` ORDER BY nome");
                $select->execute(array());
                while ($l = $select->fetch()) {
                    echo "<option value='" . $l["idFuncao"] . "'>" . $l["nome"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-xs-1 text-left glyphiconHelp">
            <span class="glyphicon glyphicon-question-sign" rel="tooltip" title="Apresenta a execução de despesas por área e finalidade do Governo Federal"></span>
        </div>

        <div class="form-group col-xs-10 col-xs-offset-1">
            <select name="subfuncao" class="filtroExec form-control">
                <option value="0">Selecione uma Subfunção</option>
                <?php
                $select = $conn->prepare("SELECT * FROM `subfuncaodespesaestado` ORDER BY nome");
                $select->execute(array());
                while ($l = $select->fetch()) {
                    echo "<option value='" . $l["idSubFuncao"] . "'>" . $l["nome"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-xs-1 text-left glyphiconHelp">
            <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                title="É o nível de agregação imediatamente inferior à função e está relacionado à finalidade da ação governamental">
            </span>
        </div>

        <div class="form-group col-xs-10 col-xs-offset-1">
            <select name="acao"  class="filtroExec form-control">
                <option value="0">Selecione uma Ação</option>
                <?php
                $select = $conn->prepare("SELECT * FROM `acaodespesaestado` ORDER BY nome");
                $select->execute(array());
                while ($l = $select->fetch()) {
                    echo "<option value='" . $l["idAcao"] . "'>" . $l["nome"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-xs-1 text-left glyphiconHelp">
            <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                title="Ação Governamental é o conjunto de operações cujos produtos contribuem para os objetivos do programa governamental, a ação pode ser um projeto, atividade ou operação especial">
            </span>
        </div>

        <div class="form-group col-xs-10 col-xs-offset-1">
            <select name="orgao" class="filtroExec form-control">
                <option value="0">Selecione um orgão</option>
                <?php
                $select = $conn->prepare("SELECT * FROM `orgaodespesaestado` ORDER BY nome");
                $select->execute(array());
                while ($l = $select->fetch()) {
                    echo "<option value='" . $l["idOrgao"] . "'>" . $l["nome"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-xs-1 text-left glyphiconHelp">
            <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                title="Denominação dada às unidades responsáveis pelo desempenho das funções de governo">
            </span>
        </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="categoria" class="filtroExec form-control">
                        <option value="0">Selecione uma Categoria</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `categoriadespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idCategoria"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="Classificação da receita e despesa, com a finalidade de analisar a arrecadação e a despesa do governo">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="grupo" class="filtroExec form-control">
                        <option value="0">Selecione um Grupo</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `grupodespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idGrupo"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="Agrupamentos em função de características comuns a determinados gastos, tais como a Unidade Orçamentária que realizou o gasto, as exigências legais para determinadas despesas etc">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="unidadeorcamentaria" class="filtroExec form-control">
                        <option value="0">Selecione uma Unidade Orçamentária</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `unidadeorcamentariadespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idUnidadeOrcamentaria"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="É o menor nível da classificação institucional">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="unidadegestora" class="filtroExec form-control">
                        <option value="0">Selecione uma Unidade Gestora</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `unidadegestoradespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idUnidadeGestora"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="São unidades que gerem recursos públicos">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="modalidade" class="filtroExec form-control">
                        <option value="0">Selecione uma Modalidade</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `modalidadedespesaestado` ORDER BY nome");
                        $select->execute(array());

                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idModalidade"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="Tem por finalidade indicar se os recursos são aplicados diretamente por órgãos ou entidades no âmbito da mesma esfera do Governo ou por outro ente da Federação e suas respectivas entidades">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="elemento" class="filtroExec form-control">
                        <option value="0">Selecione um Elemento</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `elementodespesaestado` ORDER BY nome");
                        $select->execute(array());

                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idElemento"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="É um recurso de codificação da despesa, de que se serve a Administração Pública para registrar e acompanhar suas atividades">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="item" class="filtroExec form-control">
                        <option value="0">Selecione um Item</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `itemdespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idItem"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="Desmembramento dos elementos de despesa">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="credor" class="filtroExec form-control">
                        <option value="0">Selecione um Credor</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `credordespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idCredor"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="É toda instituição titular de um crédito, ou, que tem a receber de outrem uma certa importância em dinheiro">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="licitacao" class="filtroExec form-control">
                        <option value="0">Selecione uma Licitação</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `licitacaodespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idLicitacao"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="Procedimento administrativo por meio do qual a Administração Pública seleciona a proposta mais vantajosa para futura contratação que melhor atenda ao interesse público">
                    </span>
                </div>

                <div class="form-group col-xs-10 col-xs-offset-1">
                    <select name="fonterecursos" class="filtroExec form-control">
                        <option value="0">Selecione uma Fonte de Recursos</option>
                        <?php
                        $select = $conn->prepare("SELECT * FROM `fonterecursosdespesaestado` ORDER BY nome");
                        $select->execute(array());
                        while ($l = $select->fetch()) {
                            echo "<option value='" . $l["idFonteRecurso"] . "'>" . $l["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-1 text-left glyphiconHelp">
                    <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                        title="Identifica as origens dos ingressos de recursos, que financiam os gastos públicos, detalhando quais são as receitas que custeiam determinadas despesas">
                    </span>
                </div>
    </fieldset>

   <fieldset id="camposDefinidores" class="scheduler-border col-xs-12">
        <legend class="scheduler-border">Mostrar os seguintes campos definidores da despesa no resultado da pesquisa</legend>
        <div class="col-xs-12" style="padding-bottom:10px;">
            <label class="checkbox-inline">
                <input type="checkbox" name="listarFuncao" class="topDezCheck">Função
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarSubFuncao" class="topDezCheck">SubFunção
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarAcao" class="topDezCheck">Ação
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarOrgao" class="topDezCheck">Orgão
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarCategoria" class="topDezCheck">Categoria
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarGrupo" class="topDezCheck">Grupo
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarUnidadeOrcamentaria" class="topDezCheck">Unidade Orçamentária
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarUnidadeGestora" class="topDezCheck">Unidade Gestora
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarModalidade" class="topDezCheck">Modalidade
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarElemento" class="topDezCheck">Elemento
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarItem" class="topDezCheck">Item
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarCredor" class="topDezCheck">Credor
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarLicitacao" class="topDezCheck">Licitação
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarFonteRecursos" class="topDezCheck">Fonte de Recursos
            </label>
        </div>
    </fieldset>

    <fieldset id="execucaoOrcamentaria" class="scheduler-border col-xs-12">
        <legend class="scheduler-border">Quais etapas da execução orçamentária deseja visualizar?</legend>
        <div class="col-xs-12">
            <label class="checkbox-inline">
                <input type="checkbox" name="listarValorPago" id="listarValorPago">Valor Pago
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarValorEmpenhado" id="listarValorEmpenhado">Valor Empenhado
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarValorLiquido" id="listarValorLiquido">Valor Liquidado
            </label>

            <label class="checkbox-inline">
                <input type="checkbox" name="listarDeAnosAnteriores" id="listarDeAnosAnteriores">Valor de Anos Anteriores
            </label>
        </div>
    </fieldset>


    <fieldset id="fieldTopDez" class="scheduler-border col-xs-12" style="display:none; padding-right:45px !important">
        <legend class="scheduler-border">Mostrar os 10 maiores resultados segundo o seguinte campo definidor</legend>
        <div class="form-group col-xs-10 col-xs-offset-1">
            <select name="selectTopDez" id="selectTopDez" class="form-control">
                <option value="0">Selecione uma Opção</option>
            </select>
        </div>
        <div class="col-xs-1 text-left glyphiconHelp">
            <span class="glyphicon glyphicon-question-sign" rel="tooltip"
                title="Esta opção agrupa os dez maiores itens segundo o campo definidor escolhido">
            </span>
        </div>
    </fieldset>

    <!--
    <div>
        <h2>escolha um elemento para análise em gráfico pizza dos gastos</h2>
        <input type="radio" name="pizza" value="funcao">Função
        <input type="radio" name="pizza" value="subfuncao">SubFunção
        <input type="radio" name="pizza" value="acao"> Ação
        <input type="radio" name="pizza" value="orgao"> Orgão
        <input type="radio" name="pizza" value="categoria"> Categoria
        <input type="radio" name="pizza" value="grupo"> Grupo
        <input type="radio" name="pizza" value="unidadeOrcamentaria"> Unidade Orçamentária <br><br>
        <input type="radio" name="pizza" value="unidadeGestora"> Unidade Gestora
        <input type="radio" name="pizza" value="modalidade"> Modalidade
        <input type="radio" name="pizza" value="elemento"> Elemento
        <input type="radio" name="pizza" value="item"> Item
        <input type="radio" name="pizza" value="credor"> Credor
        <input type="radio" name="pizza" value="licitacao"> Licitação
        <input type="radio" name="pizza" value="fonteRecurso"> Fonte de Recursos
        </div>
    -->

    <?php
        if (isset($_SESSION["logado"])) {
            ?>
            <!--NAO FUNCIONANDO
            <script>
                function habilitarTitulo() {

                    if (document.getElementById('salvar').checked == true) {

                        document.getElementById('descricao').style.display = "block";
                    } else {
                        document.getElementById('descricao').style.display = "none";
                    }

                }
            </script>

            <fieldset class="scheduler-border col-xs-12 text-center">
                <legend class="scheduler-border">Deseja salvar esta consulta?</legend>

                <div class="col-xs-12">
                    <label class="radio-inline"><input type="radio" name="salvar" id="salvar" value="Sim" onchange="habilitarTitulo();">Sim</label>
                    <label class="radio-inline"><input type="radio" name="salvar" value="Não" onchange="habilitarTitulo();" checked>Não</label>
                </div>

                <div  id="descricao" class="form-group col-xs-10 col-xs-offset-1" style="display:none; margin-top: 10px;">
                    <label for="textDesc" class="text-muted" style="color:#555">Dê uma descrição a respeito da consulta realizada:</label>
                    <textarea class="form-control" id="textDesc" style="resize: none;" name="descricao"></textarea>
                </div>

            </fieldset>
            -->
            <?php
        }
    ?>
    <p class="col-xs-12 ">
        <a class="text-info" href="http://transparencia.al.gov.br/portal/glossario/" target="_blank">Glossário</a>
    </p>
    <div class="col-xs-12" style="margin-bottom:50px;">
        <input type="hidden" name="consultar" value="1">
        <input type="button" class=" btn btn-default btn-lg" id="botaoConsulta"  value="CONSULTAR!" >
    </div>

</form>
