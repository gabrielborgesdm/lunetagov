# Lunetagov
## Notas da atualização:
- Foi implementado no Luneta o framework Bootstrap v3.3.7.
- Sistema de login e cadastro refeito com a funcao md5() que não é tão segura como password_hash() mas é a unica suportada devido ao limite de caracteres do banco.
- Sistema de contato refeito com a biblioteca PHPMailer.
- Atualização feita por Gabriel Borges de Moraes.

## Instalação:
- Extraia o diretorio luneta para seu servidor
- Mude os dados do banco no arquivo site/conexao.php.
- Importe o banco de dados através do arquivo ddpbr_luneta.sql disponível no diretório LunetaGov
 
## Importante: 
- Eu desativei o sistema de colsultas por histórico pois o mesmo não funciona, caso queira ativar basta mudar: 
	- site/cabecalho.php linha 65
	- site/formConsulta.php linha 422

- Coloquei a conexao em PDO dentro de uma função, assim não necessário mudar os dados do banco várias vezes.
- Não esqueça de colocar o email e senha que enviará as mensagens no arquivo site/contato.php linha 66
