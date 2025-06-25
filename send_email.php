<?php
// Ativar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Forçar UTF-8
header('Content-Type: application/json; charset=utf-8');

// Log function
function writeLog($message) {
    $logFile = __DIR__ . '/email_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

writeLog("=== Nova requisição iniciada ===");
writeLog("POST data: " . print_r($_POST, true));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação básica
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Por favor, preencha todos os campos.'
        ]);
        exit;
    }

    // Sanitização dos dados
    $name = strip_tags(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST['subject']));
    $message = strip_tags(trim($_POST['message']));

    // Validação do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Por favor, forneça um email válido.'
        ]);
        exit;
    }

    // Configurações do email
    $to = 'suporte@expaybank.com.br';
    $subject = '[Contato do Site] ' . $subject;

    // Headers específicos para a Hostinger
    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: Site ExPay <suporte@expaybank.com.br>';
    $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    // Corpo do email em HTML
    $emailBody = "
    <html>
    <head>
        <title>Nova mensagem do site</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
            .content { background-color: #ffffff; padding: 20px; border-radius: 5px; }
            .footer { font-size: 12px; color: #666; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Nova mensagem do formulário de contato</h2>
            </div>
            <div class='content'>
                <p><strong>Nome:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Assunto:</strong> {$subject}</p>
                <p><strong>Mensagem:</strong></p>
                <p>" . nl2br($message) . "</p>
            </div>
            <div class='footer'>
                <p>Esta mensagem foi enviada através do formulário de contato do site.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Tenta enviar o email
    writeLog("Tentando enviar email para: " . $to);
    $result = mail($to, $subject, $emailBody, implode("\r\n", $headers));

    if ($result) {
        writeLog("Email enviado com sucesso!");
        echo json_encode([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Em breve entraremos em contato.'
        ]);
    } else {
        $error = error_get_last();
        writeLog("Erro ao enviar email: " . print_r($error, true));
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao enviar mensagem. Por favor, tente novamente mais tarde.',
            'error' => $error
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método inválido'
    ]);
}
?> 