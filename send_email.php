<?php
// Ativar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log function
function writeLog($message) {
    $logFile = __DIR__ . '/email_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

// Verificar permissões de escrita
$logFile = __DIR__ . '/email_log.txt';
if (!is_writable(dirname($logFile))) {
    error_log("Diretório não tem permissão de escrita: " . dirname($logFile));
}

writeLog("=== Nova requisição iniciada ===");
writeLog("Método: " . $_SERVER['REQUEST_METHOD']);
writeLog("Dados POST: " . print_r($_POST, true));

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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    writeLog("Dados validados com sucesso");
    
    try {
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
        
        // Debug SMTP detalhado
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $debugOutput = '';
        $mail->Debugoutput = function($str, $level) use (&$debugOutput) {
            writeLog("SMTP Debug ($level): $str");
            $debugOutput .= "$str\n";
        };
        
        // Verificar conexão SMTP antes de prosseguir
        try {
            writeLog("Testando conexão SMTP...");
            $smtp = fsockopen($mail->Host, $mail->Port, $errno, $errstr, 30);
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
        ]);
        
    } catch (Exception $e) {
        $errorMessage = $mail->ErrorInfo ?? $e->getMessage();
        writeLog("Erro ao enviar email: " . $errorMessage);
        writeLog("Debug SMTP: " . $debugOutput);
        
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao enviar email: ' . $errorMessage,
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