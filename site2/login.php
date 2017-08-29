<?php
	$controle = "consulta";
	include("cabecalho.php");
?>
<style>
.tabela{
	font-family:arial;
	font-size: 10px;
	border-color: #F0F0F0;
	border-style:solid;
	border-width:1px;
}
</style>

	<div id="contents2">
		
<script src="js/md5.js" type="text/javascript"></script>
<script src="js/md5CadastroLogin.js" type="text/javascript"></script>
			<h1>Login</h1>
			
			<hr /> 
					
		
    <fieldset class="message">
    		<legend>
           Autenticação de Usuário
         </legend>
			<form name="login" method="post"  action="autenticacao.php">
          
          Login: <input type="email" name="login" /> <br /> Senha: <input type="password" name="senha" /> 
				<input type="button" id="btn_logar" value="Logar" onclick="enviarLogin();" />
      </form>
  </fieldset>
	<br /><br />
    <fieldset class="message">
			<legend>
				Ainda não é usuário? Preencha as informações abaixo e cadastre-se
			</legend>
			<?php include("form_cadastro.php");?>
  </fieldset>      

	</div>
	<br />
<?php include("rodape.php");?>	
