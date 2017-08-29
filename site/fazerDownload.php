<?php
	if(!empty($_POST)){
		echo'
			<form id="fazerDownload" action="downloadExibeConsulta.php" method="post">
				<fieldset>
					<legend>Deseja baixar os dados selecionados anteriormente?</legend>
							
					<h1>Escolha o formato para o download:</h1>
					<label>
						<input type="radio" value="csv" name="download" />CSV
					</label>
					<label>
						<input type="radio" value="json" name="download" />JSON
					</label>
					<label>
						<input type="radio" value="xml" name="download" />XML
					</label>
					
						<input type="hidden" name="seleciona" value="'.$selecionaDados.'"	/>
				<div class="divcontroladores">
					<input type="submit" value="Baixar" />
					<input type="reset" />
				</div>
				</fieldset>
			</form>
		';

	}
	
	
?>

