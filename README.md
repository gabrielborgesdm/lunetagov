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
    - Para fazer a importação utilize crie um banco de dados
    - Abra o shell do mysql
    - digite o seguinte comando `mysql -u [username_do_db] -p [nome_do_banco_criado] < ddpbr_lunetagov.sql`
 
## Importante: 
- Eu desativei o sistema de colsultas por histórico pois ele não funciona, caso queira ativar basta mudar: 
	- site/cabecalho.php linha 65
	- site/formConsulta.php linha 422
- Arrumei o estouro de memória que estava acontecendo no downloadExibeConsulta.php e implementei o PDO::FETCH_ASSOC no método fetch(), assim retornando apenas o array associativo.
- Coloquei a conexao em PDO dentro de uma função, assim não necessário mudar os dados do banco várias vezes.
- Não esqueça de colocar o email e senha que enviará as mensagens no arquivo site/contato.php linha 66
