<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos campos
    $required_fields = ['name', 'email', 'subject', 'message'];
    $errors = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "O campo " . ucfirst($field) . " é obrigatório.";
        }
    }
    
    // Validação específica do email
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email inválido.";
    }
    
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => 'Erros de validação:',
            'errors' => $errors
        ]);
        exit;
    }
    
    // Sanitização dos dados
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    // Criação do objeto PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configurações do servidor Hostinger
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'suporte@expaybank.com.br';
        $mail->Password = 'Contivan444#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SSL;
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        
        // Configurações de debug (remova em produção)
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Mude para DEBUG_SERVER para debugar
        
        // Remetente e destinatário
        $mail->setFrom('suporte@expaybank.com.br', 'Suporte ExPay');
        $mail->addAddress('suporte@expaybank.com.br', 'Suporte ExPay');
        $mail->addReplyTo($email, $name);
        
        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = "[Contato Site] " . $subject;
        
        $emailBody = "
        <h2>Nova mensagem do formulário de contato</h2>
        <p><strong>Nome:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Assunto:</strong> {$subject}</p>
        <p><strong>Mensagem:</strong></p>
        <p>{$message}</p>
        <hr>
        <p><small>Esta mensagem foi enviada através do formulário de contato do site.</small></p>
        ";
        
        $mail->Body = $emailBody;
        $mail->AltBody = strip_tags(str_replace(['<br>', '</p>'], "\n", $emailBody));
        
        // Envio do email
        $mail->send();
        
        // Log da mensagem
        $log_entry = date('Y-m-d H:i:s') . " - Email enviado de: " . $email . "\n";
        file_put_contents('dados.txt', $log_entry, FILE_APPEND);
        
        echo json_encode([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Em breve entraremos em contato.'
        ]);
        
    } catch (Exception $e) {
        error_log("Erro no envio de email: " . $mail->ErrorInfo);
        echo json_encode([
            'success' => false,
            'message' => 'Desculpe, ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente mais tarde.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método de requisição inválido.'
    ]);
}
?> 