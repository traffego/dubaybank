<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ExPay' : 'ExPay - Seu Banco Digital'; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/expay2.png">
    <link rel="apple-touch-icon" href="img/expay2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;500;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="index.php">
                        <img src="img/expay2.png" alt="ExPay Logo" class="logo-image">
                    </a>
                </div>
                <button class="mobile-menu-button d-lg-none" aria-label="Menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
                <nav class="main-nav">
                    <ul class="d-flex list-unstyled mb-0">
                        <li><a href="index.php#home">Início</a></li>
                        <li><a href="index.php#services">Serviços</a></li>
                        <li><a href="support.php">Suporte</a></li>
                        <li><a href="index.php#contact">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</body>
</html> 