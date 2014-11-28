<?php
require 'vendor/autoload.php';						    // Carrega automaticamente todas as bibliotecas instaladas pelo composer

use Html2Text\Html2Text;                      		    // Biblioteca para criar a versão "plain-text" do email

$mail = new PHPMailer;
$mail->setLanguage('br');							    // Habilita as saídas de erro em Português
$mail->CharSet='UTF-8';

//$mail->SMTPDebug = 3;                                 // Habilita a saída "verbosa"

// Configuração dos dados do servidor
$mail->isSMTP();                                      // Configura para o uso do SMTP
$mail->Host = 'smtplw.com.br';						  // Especifica o endereço do servidor SMTP
$mail->SMTPAuth = true;                               // Habilita autenticação SMTP
$mail->SMTPSecure = 'tls';                            // Habilitar criptografia TLS, 'ssl' também está disponível
$mail->Port = 465;                                    // porta TCP: 587 | SSL/TLS: 465

// Substitua o USUÁRIO, SENHA e REMETENTE pelos dados criados no painel do SMTP Locaweb e descomente as linhas abaixo
//$mail->Username = 'USUARIO';          	            // Usuário do SMTP
//$mail->Password = 'SENHA';                 		    // Senha do SMTP
//$mail->From = 'REMETENTE';							// email de origem das mensagens enviadas. Deve ser previamente aprovado

// variáveis criadas a partir dos dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$nome_completo = $nome . " " . $sobrenome;
$destinatario = $_POST['destinatario'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
$msg_html = new Html2Text($mensagem);

// configura o objeto $mail
$mail->FromName = $nome_completo;
$mail->addAddress($destinatario);						// Endereço de envio
$mail->addReplyTo($mail->From, $nome_completo);     	// Endereço de resposta. O nome é opcional

$mail->isHTML(true);									// Configura o envio como mensagem HTML

$mail->Subject = $nome_completo . ' enviou a mensagem: ' . $assunto;
$mail->Body    = $mensagem;
$mail->AltBody = $msg_html->getText();					// Essa é a versão alternativa da msg para clientes em "plain text"

if(!$mail->send()) {
    echo '<p>A mensagem não pode ser enviada.</p>';
    echo 'Erro: ' . $mail->ErrorInfo;
} else {
    echo '<p>Mensagem enviada com sucesso!!! :-)</p>';
}