<?php
    include("cabecalho.php");
?>						
<section class="container-fluid footerBottom">
    <div class="row" style="margin-bottom:50px;">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
            <?php
            if(empty($_POST)){
                echo'
                <h1 class="page-header">Faça login ou cadastre-se</h1>
                <form name="login" method="post" action="#">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Login</legend>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" required="required" class="form-control text-center" name="email" id="email" placeholder="Digite seu e-mail"/>                             
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control text-center" type="password" name="senha" required="required" id="senha" placeholder="Digite sua senha" />                
                        </div>

                        <button type="submit" class="btn btn-default col-xs-12">Entrar</button>      
                    </fieldset>                              
                    <h4 class="text-center">Ainda não é usuário? Clique <a href="form_cadastro.php">aqui</a> para se cadastrar</h4>                   
                </form>';
            }
            else{
                $email = isset($_POST['email']) ? $_POST['email'] : '';  
                $senha = isset($_POST['senha']) ? $_POST['senha'] : '';      

                if(empty($email) || empty($senha)){
                    echo'
                    <h1 class="text-danger">Complete todos os campos antes de submeter o formulário!</h1>
                    <a href="login.php" class="btn btn-default btn-lg">Tentar novamente!</a>
                    ';
                }
                else{
                    //Este é melhor que o md5(), mas o banco nao suporta a quantidade de caracteres
                    //$senha = password_hash($senha, PASSWORD_DEFAULT);
                    $senha = md5($senha);
                    
                    $PDO = conexaoDB();
                    
                    $sql = "SELECT nome, email, senha, estado, cidade, id_usuario FROM login WHERE email = :email AND senha = :senha LIMIT 1";
                    $stmt = $PDO->prepare($sql);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':senha', $senha);
                    $stmt->execute();

                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (count($users) <= 0){
                        echo'
                        <h1 class="text-danger">Conta inválida, tente novamente!</h1>
                        <a href="login.php" class="btn btn-default btn-lg">Voltar</a>
                        ';
                    }
                    else{
                        $user = $users[0];
                        $_SESSION["logado"] = 1;
                        $_SESSION["id_usuario"] = $user["id_usuario"];
                        $_SESSION["nome"] = $user["nome"];
                        $_SESSION["email"] = $user["email"];
                        $_SESSION["cidade"] = $user["cidade"];
                        $_SESSION["estado"] = $user["estado"];
                        header("Location: index.php");
                    }   
                }
            }
            ?>
        </div>    
    </div>       	        
<?php include("rodape.php");?>	
