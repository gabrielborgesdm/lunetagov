<?php
$controle = "consulta";
include("cabecalho.php");
?>


<div id="contents">
    <div class="features">
        <br />
        <h1>Consultas</h1>

        <hr /> 
        <?php
        include("form_consulta.php");
        ?>



        <?php
        include("exibe_consulta.php");
        ?>				


    </div>
</div>
<br />
<?php include("rodape.php"); ?>	
