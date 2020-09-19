<?php
include("cabecalho.php");
?>
<section class="container-fluid">
    <div class="row" style="margin-bottom:50px;">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3" id="sobre">
                <h1 class="page-header">O que é esta Ferramenta ?</h1>
                <?php
                    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] == "com.lunetagovapp") {
                        echo '
                            <div>
                                <p class="text-info">
                                    O Luneta Gov App é um portal de transparência que disponibiliza a visualização de execuções orçamentárias do governo federal, estados e municípios.
                                </p>
                                <p>
                                    Você pode buscar por dados de onde foi gasto o dinheiro público, e até mesmo dados sobre recebeu esta verba, qual a forma, dentre outras.
                                </p>
            
                            </div>
                            <div>
                                <p>
                                    O objetivo do Luneta Gov App é auxiliar na fiscalização das transações públicas e na diminuição da corrupção através do aumento da transparência da execução orçamentária.
                                </p>
                                <p>
                                    Esta ferramenta foi construída com o intuito de participar do projeto <i>Eu não aceito a corrupção Edição 2</i>.
                                </p>
                            </div>
            
                            <h1 class="page-header">Sobre</h1>
                            <h2>Por quem foi criado esse aplicativo?</h2>
                            <p>
                                Esse aplicativo foi desenvolvido por Gabriel Borges, aluno da Universidade Virtual de São Paulo, sob orientação do Prof.º Msc. José Rodolfo Beluzo, professor do Ensino Básico, Técnico e Tecnológico do IFSP Campus Araraquara/SP.
                            </p>
                            <h2>Qual o objetivo da ferramenta?</h2>
                            <p>
                                Temos como objetivo criar para a sociedade uma ferramente que possibilite buscar e visualizar os dados dos portais de transparência de forma customizada pelo usuário de maneira que seja facíl para entender o processo da execução orçamentária
                                e portanto facilitar o processo de identificar corrupção.

                            </p>
                        ';
                    } else {

                        echo '
                            <div>
                                <p class="text-info">
                                    O Portal de Transparência é uma ferramenta que disponibiliza a visualização de execuções orçamentárias do governo federal, estados e municípios.
                                </p>
                                <p>
                                    Você pode buscar por dados de onde foi gasto o dinheiro público, e até mesmo dados sobre recebeu esta verba, qual a forma, dentre outras.
                                </p>
            
                            </div>
                            <div>
                                <p>
                                    O objetivo dos Portais de Transparência é aumentar a transparência da gestão pública, permitindo que o cidadão acompanhe como o dinheiro público está sendo utilizado e ajude a fiscalizar estas execuções.
                                </p>
                                <p>
                                Esta ferramenta foi construída com o intuito de agrupar todos os dados de portais de transparência em um só local. Mas ainda estamos em construção! :) Por enquanto você encontra dados de 2015 do governo do estado de São Paulo. Em breve novos anos e novas fontes governamentais estarão disponíveis.
                                </p>
                            </div>
            
                            <h1 class="page-header">Sobre</h1>
                            <h2>Por quem foi criada esta ferramenta?</h2>
                            <p>
                                Esta ferramenta foi inicialmente elaborada pelo aluno Matheus Felize Z. de Macedo para um projeto de Trabalho de Conclusão de Curso(TCC) no IFSP campus Barretos/SP. Atualmente está sob desenvolvimento do aluno Gabriel Borges do IFSP campus Araraquara/SP como projeto de Iniciação Científica Voluntária. Ambos os alunos estão ou estiveram sob orientação do Prof.º Msc. José Rodolfo Beluzo, professor do Ensino Básico, Técnico e Tecnológico do IFSP Campus Araraquara/SP.
                            </p>
                            <h2>Qual o objetivo da ferramenta?</h2>
                            <p>
                                Temos como objetivo criar para a sociedade uma ferramente que possibilite buscar e visualizar os dados dos portais de transparência de forma customizada pelo usuário, além de disponibilizar novas informações através de processos de mineração de dados.
                            </p>
                        ';

                    }
                ?>
                
        </div>
    </div>           
<?php
include("rodape.php");
?>
