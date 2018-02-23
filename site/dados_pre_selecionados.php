<?php include("cabecalho.php");?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
            <?php
            $sql = "SELECT DAY(data) as dia, MONTH(data) as mes, YEAR(data) as ano, descricao,id_historico FROM historico WHERE id_usuario = " . $_SESSION['id_usuario'] . " ORDER BY data DESC";
            $select = $conn->prepare($sql);
            $select->execute() or die($sql);
            ?>
            <ul>
                <?php
                while ($l = $select->fetch()) {
                    echo 
                    '<li>
                        <div class="date">
                            <p>
                                <span>' . $l["dia"] . '/' . $l["mes"] . '</span>
                                ' . $l["ano"] . '
                            </p>
                        </div>
                        <h2>
                            <a href="historico.php?historico=' . $l["id_historico"] . '">
                                Acessar esta consulta
                            </a>
                        </h2>
                        <p>	' . $l["descricao"] . '</p>
                        <br />
                        <br />
                    </li>';
                }
                ?>
            </ul>           
        </div>
    </div>
</div>
<?php include("rodape.php");?>