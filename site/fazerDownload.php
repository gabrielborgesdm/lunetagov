<?php
echo'
    <p class="text-center">
        <a class="text-primary" data-toggle="modal" data-target="#modalDownload">Clique aqui para baixar os dados da consulta</a>
    </p>
    
    <div class="modal fade" id="modalDownload" role="dialog">
        <div class="modal-dialog">
            <!-- Conteúdo do Modal-->
            <div class="modal-content">
                <form id="fazerDownload" action="downloadExibeConsulta.php" method="post">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Selecione o formato desejado para download:</h4>
                    </div>

                    <div class="modal-body">
                        <label class="radio-inline"><input type="radio" value="csv" name="download" />CSV</label>              
                        <label class="radio-inline"><input type="radio" value="json" name="download" />JSON</label>
                        <label class="radio-inline"><input type="radio" value="xml" name="download" />XML</label>
                        <input type="hidden" name="seleciona" value="' . $selecionaDados . '"	/>                       
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-default" value="Baixar"/>
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Sair"/>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    ';
?>


