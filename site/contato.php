<?php include("cabecalho.php"); ?>
<section class="container-fluid footerBottom">
    <div class="row" style="margin-bottom:50px;">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
            <?php
                if(empty($_POST)){
                   echo'
                    <h1 class="page-header ">Entre em contato</h1>
                    <form method="post" action="#">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                Contato
                            </legend>

                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control text-center" type="text" name="nome" id="nome" required="required" placeholder="Digite seu nome completo" />
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control text-center" type="email" name="email" id="email" required="required" placeholder="Digite seu e-mail" />
                            </div>

                            <div class="form-group">
                                <label for="assunto">Assunto</label>
                                <input class="form-control text-center" type="text" name="assunto" id="assunto" required="required" placeholder="Digite o assunto de sua mensagem" />
                            </div>

                            <div class="form-group">
                                <label for="mensagem">Mensagem</label>
                                <textarea class="form-control text-center" rows="5" name="mensagem" id="mensagem" required="required" placeholder="Digite sua mensagem" style="resize:none"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default col-xs-12" >Enviar</button>
                        </fieldset>
                    </form>
                   ';
                }
                else{
                    
                    $nome = $_POST["nome"];
                    $email = $_POST["email"];
                    $assunto = $_POST["assunto"];
                    $mensagem = $_POST["mensagem"];
                    $header = 'De: '.$email. '<br/><br/><br/>';
          
                    //videoaula https://www.youtube.com/watch?v=gor2j4muG8A
                    require '../PHPMailer/PHPMailerAutoload.php';

                    $Mailer = new PHPMailer();
                    $Mailer ->isSMTP();
                    $Mailer ->Charset = 'UTF-8';

                    //configurações
                    $Mailer ->SMTPAuth = true;
                    $Mailer ->SMTPSecure = 'ssl';

                    //nome do servidor
                    $Mailer->Host = 'smtp.gmail.com';

                    //Porta de saída do email
                    $Mailer->Port = 465;

                    //Dados de email

                    $Mailer->Username = 'seuemail@gmail.com';
                    $Mailer->Password = 'senha@senha1234';

                    //Email do Remetente
                    $Mailer->From = $email;

                    //Nome do Remetente
                    $Mailer->FromName = $nome;

                    //Assunto da mensagem
                    $Mailer->Subject = $assunto;

                    //Conteudo da Mensagem
                    $Mailer->Body = $header . ' ' .$mensagem;

                    //Corpo da Mensagem Modo de Texto
                    $Mailer->AltBody = $header . ' ' .$mensagem;;
                    
                    $Mailer->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    
                    //Destinatario
                    $Mailer->AddAddress('lunetagovbr@gmail.com');

                     if($Mailer->Send()){
                        echo'
                          <h2>E-mail Enviado com sucesso!</h2>
                          <a href="contato.php" class="btn btn-lg btn-default" >Voltar</a>
                        ';
                     }else{
                      echo "ERRO ao tentar Enviar " . $Mailer->ErrorInfo;
                     }
                }
            ?>
        </div>
    </div>
<?php
include("rodape.php");
?>
