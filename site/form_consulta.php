<form name="consulta" id="consulta" action="consultas.php" method="post">
    
    <fieldset>
        <legend>
            Selecione uma Esfera Governamental e o item orçamentário
        </legend>
        Esfera: 
        <input type="radio" name="esfera" disabled> <span style="color:#f0f0f0;"> Governo Federal</span>
        <input type="radio" name="esfera" checked> Governo Estadual
        <input type="radio" name="esfera" disabled>  <span style="color:#f0f0f0;"> Governo Municipal</span>
        <br />
        Item:
        <input type="radio" name="itemOrcamentario" disabled> <span style="color:#f0f0f0;"> Receita</span>
        <input type="radio" name="itemOrcamentario" checked> Despesa
    </fieldset>
    <br />
    <fieldset >
        <legend>Selecione os filtros que deseja realizar em sua consulta</legend>
        <table>
            <tbody>
                <!--ANO-->
                <tr>
                    <td>
                        <select name="anoExecucao" class="filtroExec" >
                            <option value="0">::selecione um ano::</option>
                            <?php
                            $select = $conn->prepare("SELECT DISTINCT ano FROM `despesaestado` ORDER BY ano");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["ano"] . "'>" . $l["ano"] . "</option>";
                            }
                            ?>
                        </select>
                        
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <select name="funcao" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma função::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `funcaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idFuncao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Apresenta a execução de despesas por área e finalidade do Governo Federal"/>
                    </td>
                    <td>
                        <select name="subfuncao" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma subfunção::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `subfuncaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idSubFuncao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="É o nível de agregação imediatamente inferior à função e está relacionado à finalidade da ação governamental"/>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="acao" style="width: 80%" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma ação::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `acaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idAcao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Ação Governamental é o conjunto de operações cujos produtos contribuem para os objetivos do programa governamental, a ação pode ser um projeto, atividade ou operação especial."/>
                    </td>
                    <td>
                        <select name="orgao" class="filtroExec" style="width:80%">
                            <option value="0">::selecione um orgão::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `orgaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idOrgao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Denominação dada às unidades responsáveis pelo desempenho das funções de governo"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="categoria" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma categoria::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `categoriadespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idCategoria"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Classificação da receita e despesa, com a finalidade de analisar a arrecadação e a despesa do governo"/>
                    </td>
                    <td>
                        <select name="grupo" class="filtroExec" style="width:80%">
                            <option value="0">::selecione um grupo::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `grupodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idGrupo"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Agrupamentos em função de características comuns a determinados gastos, tais como a Unidade Orçamentária que realizou o gasto, as exigências legais para determinadas despesas etc"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="unidadeorcamentaria" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma unidade orçamentária::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `unidadeorcamentariadespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idUnidadeOrcamentaria"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="É o menor nível da classificação institucional."/>
                    </td>
                    <td>
                        <select name="unidadegestora" class="filtroExec"style="width:80%">
                            <option value="0">::selecione uma unidade gestora::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `unidadegestoradespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idUnidadeGestora"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="São unidades que gerem recursos públicos."/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="modalidade" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma modalidade::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `modalidadedespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idModalidade"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Tem por finalidade indicar se os recursos são aplicados diretamente por órgãos ou entidades no âmbito da mesma esfera do Governo ou por outro ente da Federação e suas respectivas entidades"/>
                    </td>
                    <td>
                        <select name="elemento" class="filtroExec" style="width:80%">
                            <option value="0">::selecione um elemento::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `elementodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idElemento"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="É um recurso de codificação da despesa, de que se serve a Administração Pública para registrar e acompanhar suas atividades"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="item" class="filtroExec" style="width:80%">
                            <option value="0">::selecione um item::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `itemdespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idItem"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Desmembramento dos elementos de despesa"/>
                    </td>
                    <td>
                        <select name="credor" class="filtroExec" style="width:80%">
                            <option value="0">::selecione um credor::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `credordespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idCredor"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="É toda instituição titular de um crédito, ou, que tem a receber de outrem uma certa importância em dinheiro."/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="licitacao" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma licitação::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `licitacaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idLicitacao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                        <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Procedimento administrativo por meio do qual a Administração Pública seleciona a proposta mais vantajosa para futura contratação que melhor atenda ao interesse público."/>
                    </td>
                    <td>
                        <select name="fonterecursos" class="filtroExec" style="width:80%">
                            <option value="0">::selecione uma fonte de recursos::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `fonterecursosdespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idFonteRecurso"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                         <img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
                        title="Identifica as origens dos ingressos de recursos, que financiam os gastos públicos, detalhando quais são as receitas que custeiam determinadas despesas."/>
                    </td>
                </tr>
            </tbody></table>
    </fieldset>
    <br>

    <fieldset id="camposDefinidores">
        <legend>Mostrar os seguintes campos definidores da despesa no resultado da pesquisa</legend>
        <br />
        <label><input type="checkbox" name="listarFuncao" class="topDezCheck"> Função</label>
        <label><input type="checkbox" name="listarSubFuncao" class="topDezCheck">SubFunção</label>
        <label><input type="checkbox" name="listarAcao" class="topDezCheck">Ação</label>  
        <label><input type="checkbox" name="listarOrgao" class="topDezCheck">Orgão</label> 
        <label><input type="checkbox" name="listarCategoria" class="topDezCheck">Categoria</label> 
        <label><input type="checkbox" name="listarGrupo" class="topDezCheck">Grupo</label> 
        <label><input type="checkbox" name="listarUnidadeOrcamentaria" class="topDezCheck">Unidade Orçamentária</label> <br><br>
        <label><input type="checkbox" name="listarUnidadeGestora" class="topDezCheck">Unidade Gestora</label> 
        <label><input type="checkbox" name="listarModalidade" class="topDezCheck">Modalidade</label>
        <label><input type="checkbox" name="listarElemento" class="topDezCheck">Elemento</label> 
        <label><input type="checkbox" name="listarItem" class="topDezCheck">Item</label> 
        <label><input type="checkbox" name="listarCredor" class="topDezCheck">Credor</label> 
        <label><input type="checkbox" name="listarLicitacao" class="topDezCheck">Licitação</label> 
        <label><input type="checkbox" name="listarFonteRecursos" class="topDezCheck">Fonte de Recursos</label>

    </fieldset>

    <br>

    <fieldset id="execucaoOrcamentaria">
        <legend>Quais etapas da execução orçamentária deseja visualizar?</legend>
        <input type="checkbox" name="listarValorPago" id="listarValorPago"> Valor Pago 	
        <input type="checkbox" name="listarValorEmpenhado" id="listarValorEmpenhado"> Valor Empenhado 
        <input type="checkbox" name="listarValorLiquido" id="listarValorLiquido"> Valor Liquidado 
        <input type="checkbox" name="listarDeAnosAnteriores" id="listarDeAnosAnteriores"> Valor de Anos Anteriores 
    </fieldset>

    <br>

    <fieldset id="fieldTopDez" style="display:none">
        <legend>Mostrar os 10 maiores resultados segundo o seguinte campo definidor</legend>
        <select name="selectTopDez" id="selectTopDez">
            <option value="0">::selecione uma opção::</option>
        </select>    
    </fieldset>

    <br>


    <!--
<fieldset>
    <legend>escolha um elemento para análise em gráfico pizza dos gastos</legend>
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
    
    </fieldset> -->

    <?php
    if (isset($_SESSION["logado"])) {
        ?>
        <script>
            function habilitarTitulo() {

                if (document.getElementById('salvar').checked == true) {

                    document.getElementById('descricao').style.display = "block";
                } else {
                    document.getElementById('descricao').style.display = "none";
                }

            }
        </script>	
        <fieldset>
            <legend>
                Deseja salvar esta consulta?
            </legend>
            <input type="radio" name="salvar" id="salvar" value="Sim" 
                   onchange="habilitarTitulo();" >Sim
            <input type="radio" name="salvar" value="Não" onchange="habilitarTitulo();" checked>Não



            <div  id="descricao" style="display:none;">
                Dê uma descrição a respeito da consulta realizada:<br />
                <textarea  name="descricao" style="width:300px; height:150px;" ></textarea>
            </div>
        </fieldset>		

        <?php
    }
    ?>
    <p>
        <a href="http://transparencia.al.gov.br/portal/glossario/">Glossário<img src="images/qicon.png" class="logoDuvida" alt="quest icon" height="20"
             title="glossário do Portal da Transparência, onde estão explicados os nomes, descrições e títulos utilizados no Luneta"/>
        </a>
    </p>
    <div class="message" >
        <br />
        <input type="hidden" name="consultar" value="1">
        <input type="button" id="botaoConsulta"  value="CONSULTAR!" >
    </div>

</form>