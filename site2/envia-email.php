<?php
	$status = array(
		'type'=>'success',
		'message'=>'Thank you for contact us. As early as possible  we will contact you '
	);

    $name       = @trim(stripslashes($_POST['nome'])); 
    $email      = @trim(stripslashes($_POST['email']));
    $subject    = @trim(stripslashes($_POST['assunto'])); 
    $message    = @trim(stripslashes($_POST['mensagem'])); 

    $email_from = $email;
    $email_to = 'hyro.matheus@hotmail.com';//replace with your email

    $body = 'Nome: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Assunto: ' . $subject . "\n\n" . 'Message: ' . $message;

    $success = @mail($email_to, $subject, $body, 'De: <'.$email_from.'>');

 ?>

<script>
	alert("Obrigado por entrar em contato.");
	location.href="index.php";

</script>