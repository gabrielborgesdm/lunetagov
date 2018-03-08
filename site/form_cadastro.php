<?php
include("cabecalho.php");
?>
<section class="container-fluid footerBottom">
    <div class="row" style="margin-bottom:50px;">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
            <?php
            if(empty($_POST)){
                echo'
                <h1 class="page-header">Cadastre sua conta</h1>
                <form name="cadastro" id="formCadastro" method="post"  action="#">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Cadastro</legend>

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" required="required" class="form-control text-center" id="nome" placeholder="Digite seu nome"/>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" required="required" class="form-control text-center" id="email" placeholder="Digite seu e-mail"/>
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" required="required" class="form-control text-center" id="senha" placeholder="Digite sua senha" />
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" required="required" class="form-control text-center" id="estado" placeholder="Insira o nome do seu Estado" />
                        </div>

                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" required="required" class="form-control text-center" id="cidade" placeholder="Insira o nome de sua cidade" />
                        </div>

                        <button type="submit" id="btnCadastro" class="btn btn-default col-xs-12">Cadastrar</button>
                    </fieldset>
                </form>
                ';
            }
            else{
                $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
                $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
                $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';

                if(empty($nome) || empty($email) || empty($senha) || empty($estado) || empty($cidade)){
                    echo'
                    <h1 class="text-danger">Complete todos os campos antes de submeter o formulário!</h1>
                    <a href="form_Cadastro.php" class="btn btn-default btn-lg">Tentar novamente!</a>
                    ';
                }
                else{
                    //Este é melhor que o md5(), mas o banco nao suporta a quantidade de caracteres
                    //$senha = password_hash($senha, PASSWORD_DEFAULT);
                    $senha = md5($senha);

                    $PDO = conexaoDB();

                    $sql = "SELECT email, senha FROM login WHERE email = :email AND senha = :senha LIMIT 1";
                    $stmt = $PDO->prepare($sql);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':senha', $senha);
                    $stmt->execute();

                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($users) > 0){
                        echo'
                        <h1 class="text-warning">Esta conta já foi cadastrada!</h1>
                        <a href="form_Cadastro.php" class="btn btn-default btn-lg">Voltar</a>
                        ';
                    }
                    else{

                        $PDO = conexaoDB();

                        $sql = "INSERT INTO login (nome, email, senha, estado, cidade) VALUES(:nome, :email, :senha, :estado, :cidade)";
                        $stmt = $PDO->prepare($sql);
                        $stmt->bindParam(':nome', $nome);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':senha', $senha);
                        $stmt->bindParam(':estado', $estado);
                        $stmt->bindParam(':cidade', $cidade);

                        if ($stmt->execute()){
                            echo'
                            <h1 class="text-success">Conta cadastrada com sucesso!</h1>
                            <a href="login.php" class="btn btn-default btn-lg">Fazer Login</a>
                            ';
                        }
                        else
                        {
                            echo'
                            <h1 class="text-danger">Ocorreu um erro!</h1>;
                            <a href="form_Cadastro.php" class="btn btn-default btn-lg">Tentar novamente</a>
                            ';
                            print_r($stmt->errorInfo());
                        }
                    }
                }
            }
            ?>
        </div>
    </div>        

<?php include("rodape.php");?>
