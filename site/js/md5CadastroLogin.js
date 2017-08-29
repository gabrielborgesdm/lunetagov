function enviarFormCadastro(){
  
  document.cadastro_usuario.senha.value=md5(document.cadastro_usuario.senha.value);
  document.cadastro_usuario.submit();

}


function enviarLogin(){
  
  document.login.senha.value=md5(document.login.senha.value);
  document.login.submit();

}