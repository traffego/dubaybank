<?php
// Ativar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Forçar UTF-8
header('Content-Type: application/json; charset=utf-8');
mb_internal_encoding('UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Log function
function writeLog($message) {
    try {
        $logFile = __DIR__ . '/email_log.txt';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] " . (is_array($message) ? print_r($message, true) : $message) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    } catch (Exception $e) {
        error_log("Erro ao escrever log: " . $e->getMessage());
    }
}

writeLog("=== Nova requisição iniciada ===");
writeLog("Método: " . $_SERVER['REQUEST_METHOD']);
writeLog("Headers da requisição: " . print_r(getallheaders(), true));
writeLog("Dados POST: " . print_r($_POST, true));

try {
    // Verificar se o Composer está instalado
    if (!file_exists('vendor/autoload.php')) {
        throw new Exception("vendor/autoload.php não encontrado");
    }

    require 'vendor/autoload.php';

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Método de requisição inválido: " . $_SERVER["REQUEST_METHOD"]);
    }

    // Validação dos campos
    $required_fields = ['name', 'email', 'subject', 'message'];
    $errors = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "O campo " . ucfirst($field) . " é obrigatório.";
        }
    }
    
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email inválido.";
    }
    
    if (!empty($errors)) {
        throw new Exception("Erros de validação: " . implode(", ", $errors));
    }
    
    // Sanitização dos dados
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    writeLog("Dados validados com sucesso");
    
    $mail = new PHPMailer(true);
    
    // Configurações do servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'suporte@expaybank.com.br';
    $mail->Password = 'Contivan444#';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SSL;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    
    // Debug SMTP detalhado
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $debugOutput = '';
    $mail->Debugoutput = function($str, $level) use (&$debugOutput) {
        writeLog("SMTP Debug ($level): $str");
        $debugOutput .= "$str\n";
    };
    
    // Verificar conexão SMTP
    writeLog("Testando conexão SMTP...");
    try {
        $smtp = fsockopen('ssl://' . $mail->Host, $mail->Port, $errno, $errstr, 30);
        if (!$smtp) {
            throw new Exception("Erro de conexão SMTP: $errstr ($errno)");
        }
        fclose($smtp);
        writeLog("Conexão SMTP bem sucedida");
    } catch (Exception $e) {
        writeLog("Erro na conexão SMTP: " . $e->getMessage());
        throw $e;
    }
    
    // Remetente e destinatário
    $mail->setFrom('suporte@expaybank.com.br', 'Site ExPay');
    $mail->addAddress('suporte@expaybank.com.br', 'Suporte ExPay');
    $mail->addReplyTo($email, $name);
    
    // Conteúdo do email
    $mail->isHTML(true);
    $mail->Subject = "[Contato do Site] " . $subject;
    
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
    $mail->AltBody = strip_tags($emailBody);
    
    writeLog("Tentando enviar o email...");
    $mail->send();
    writeLog("Email enviado com sucesso!");
    
    echo json_encode([
        'success' => true,
        'message' => 'Mensagem enviada com sucesso! Em breve entraremos em contato.',
        'debug' => $debugOutput
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    $errorMessage = isset($mail) ? $mail->ErrorInfo : $e->getMessage();
    writeLog("Erro: " . $errorMessage);
    if (isset($debugOutput)) {
        writeLog("Debug SMTP: " . $debugOutput);
    }
    
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao enviar email: ' . $errorMessage,
        'debug' => isset($debugOutput) ? $debugOutput : null
    ], JSON_UNESCAPED_UNICODE);
}
?> 