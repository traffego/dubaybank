<?php
// Ativar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log function
function writeLog($message) {
    $logFile = 'email_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

writeLog("Iniciando processamento de email");

// Verificar se o Composer está instalado
if (!file_exists('vendor/autoload.php')) {
    writeLog("Erro: vendor/autoload.php não encontrado");
    echo json_encode([
        'success' => false,
        'message' => 'Erro de configuração do servidor. Por favor, contate o administrador.'
    ]);
    exit;
}

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    writeLog("Dados recebidos via POST: " . print_r($_POST, true));
    
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
        writeLog("Erros de validação encontrados: " . print_r($errors, true));
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
    
    writeLog("Dados sanitizados e validados com sucesso");
    
    // Criação do objeto PHPMailer
    try {
        $mail = new PHPMailer(true);
        writeLog("Iniciando configuração do PHPMailer");
        
        // Configurações do servidor Hostinger
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'suporte@expaybank.com.br';
        $mail->Password = 'Contivan444#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SSL;
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        
        // Debug SMTP
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $debugOutput = '';
        $mail->Debugoutput = function($str, $level) use (&$debugOutput) {
            writeLog("SMTP Debug ($level): $str");
            $debugOutput .= "Debug ($level): $str\n";
        };
        
        writeLog("Configurando remetente e destinatário");
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
        
        writeLog("Tentando enviar o email");
        // Envio do email
        $mail->send();
        writeLog("Email enviado com sucesso");
        
        // Log da mensagem
        $log_entry = date('Y-m-d H:i:s') . " - Email enviado de: " . $email . "\n";
        file_put_contents('dados.txt', $log_entry, FILE_APPEND);
        
        echo json_encode([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Em breve entraremos em contato.'
        ]);
        
    } catch (Exception $e) {
        writeLog("Erro ao enviar email: " . $mail->ErrorInfo . "\nDebug completo:\n" . $debugOutput);
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao enviar email. Detalhes: ' . $mail->ErrorInfo,
            'debug' => $debugOutput
        ]);
    }
} else {
    writeLog("Método de requisição inválido: " . $_SERVER["REQUEST_METHOD"]);
    echo json_encode([
        'success' => false,
        'message' => 'Método de requisição inválido.'
    ]);
}
?> 