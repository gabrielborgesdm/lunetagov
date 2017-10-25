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
                        <select name="anoExecucao">
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
                        <select name="funcao" class="filtroExec">
                            <option value="0">::selecione uma função::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `funcaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idFuncao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="subfuncao" class="filtroExec">
                            <option value="0">::selecione uma subfunção::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `subfuncaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idSubFuncao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="acao" class="filtroExec">
                            <option value="0">::selecione uma ação::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `acaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idAcao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="orgao" class="filtroExec">
                            <option value="0">::selecione um orgão::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `orgaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idOrgao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="categoria" class="filtroExec">
                            <option value="0">::selecione uma categoria::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `categoriadespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idCategoria"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="grupo" class="filtroExec">
                            <option value="0">::selecione um grupo::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `grupodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idGrupo"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="unidadeorcamentaria" class="filtroExec">
                            <option value="0">::selecione uma unidade orçamentária::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `unidadeorcamentariadespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idUnidadeOrcamentaria"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="unidadegestora" class="filtroExec">
                            <option value="0">::selecione uma unidade gestora::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `unidadegestoradespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idUnidadeGestora"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="modalidade" class="filtroExec">
                            <option value="0">::selecione uma modalidade::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `modalidadedespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idModalidade"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="elemento" class="filtroExec">
                            <option value="0">::selecione um elemento::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `elementodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idElemento"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="item" class="filtroExec">
                            <option value="0">::selecione um item::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `itemdespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idItem"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="credor" class="filtroExec">
                            <option value="0">::selecione um credor::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `credordespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idCredor"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="licitacao" class="filtroExec">
                            <option value="0">::selecione uma licitação::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `licitacaodespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idLicitacao"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="fonterecursos" class="filtroExec">
                            <option value="0">::selecione uma fonte de recursos::</option>
                            <?php
                            $select = $conn->prepare("SELECT * FROM `fonterecursosdespesaestado` ORDER BY nome");
                            $select->execute(array());

                            while ($l = $select->fetch()) {

                                echo "<option value='" . $l["idFonteRecurso"] . "'>" . $l["nome"] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody></table>
    </fieldset>
    <br>

    <fieldset id="camposDefinidores">
        <legend>Mostrar os seguintes campos definidores da despesa no resultado da pesquisa</legend>
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

    <div class="message" >
        <br />
        <input type="hidden" name="consultar" value="1">
        <input type="button" id="botaoConsulta"  value="CONSULTAR!" >
    </div>

</form>