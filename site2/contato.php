<?php
	$controle = "contato";
	include("cabecalho.php");
?>
	<center>
	<div id="contents" style="text-align:center;" align="center">
		<div class="contents">
			
			<p>
				
			</p>
			<fieldset class="fieldset2">
				<legend>
					<h1>Contato</h1>
				</legend>
				<br />
			<form class="message" action="envia-email.php" method="post" class="message" align="center">
				<input type="text" name="nome" id="nome" value="nome" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<br />
				<input type="email" name="email" id="email" value="email" />
				<br />
				<input type="text" name="assunto" id="assunto" value="assunto" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<br />
				<textarea  name="mensagem" id="mensagem"></textarea>
				<br />
				<input type="submit" value="Enviar" align="right"/>
			</form>
			</fieldset>
		</div>
		<br />
		<br />
	</div>
	</center>
	<?php
	include("rodape.php");
?>