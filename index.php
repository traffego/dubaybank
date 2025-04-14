<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dubay Bank - Seu Banco Digital</title>
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
                    <a href="#">
                        <img src="img/logo_dubay-transformed.png" alt="Dubay Bank Logo" class="logo-image">
                    </a>
                </div>
                <button class="mobile-menu-button d-lg-none" aria-label="Menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
                <nav class="main-nav">
                    <ul class="d-flex list-unstyled mb-0">
                        <li><a href="#home">Início</a></li>
                        <li><a href="#services">Serviços</a></li>
                        <li><a href="#about">Sobre</a></li>
                        <li><a href="#contact">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Dubay Bank - Seu Banco Digital</h1>
                <p>A revolução bancária que você merece. Segurança, praticidade e inovação em um só lugar.</p>
                <a href="https://wa.me/SEUNUMERO" class="cta-button" target="_blank">
                    <i class="fab fa-whatsapp"></i> Abrir Conta
                </a>
                <div class="stats">
                    <div class="stat">
                        <span class="stat-number">1M+</span>
                        <span class="stat-label">Clientes</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">R$ 2B+</span>
                        <span class="stat-label">Em transações</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">4.8</span>
                        <span class="stat-label">Avaliação</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="img/hero-image.png" alt="Dubay Bank App">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="services-container container">
            <h2 class="section-title">Nossos Serviços</h2>
            <p class="section-description">
                Oferecemos uma gama completa de serviços financeiros digitais para atender às suas necessidades, com segurança e praticidade.
            </p>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Conta Digital</h3>
                    <p>Gerencie suas finanças de forma simples e segura pelo celular.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-credit-card"></i>
                    <h3>Cartão de Crédito</h3>
                    <p>Cartão sem anuidade com cashback e benefícios exclusivos.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Investimentos</h3>
                    <p>Invista seu dinheiro com segurança e rentabilidade.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-piggy-bank"></i>
                    <h3>Poupança</h3>
                    <p>Comece a poupar com taxas atrativas e rendimento diário.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h3>Empréstimos</h3>
                    <p>Empréstimos com taxas competitivas e aprovação rápida.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Seguros</h3>
                    <p>Proteção completa para você e sua família.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-exchange-alt"></i>
                    <h3>Câmbio</h3>
                    <p>Compre e venda moedas estrangeiras com as melhores taxas.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-university"></i>
                    <h3>Financiamentos</h3>
                    <p>Realize seus sonhos com condições especiais.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Educação Financeira</h3>
                    <p>Aprenda a administrar melhor seu dinheiro.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="about-content">
            <h2>Sobre o Dubay Bank</h2>
            <p>Somos mais que um banco, somos seu parceiro financeiro. Oferecemos soluções inovadoras e personalizadas para você alcançar seus objetivos.</p>
            <a href="https://wa.me/SEUNUMERO" class="cta-button" target="_blank">
                <i class="fab fa-whatsapp"></i> Saiba Mais
            </a>
        </div>
    </section>

    <!-- App Download Section -->
    <section class="app-download-section">
        <div class="container text-center">
            <h2>Baixe nosso app</h2>
            <p>Disponível para iOS e Android</p>
            <div class="app-stores">
                <a href="#" class="store-button">
                    <img src="img/appstore-1.png" alt="App Store">
                </a>
                <a href="#" class="store-button">
                    <img src="img/googleplay-1.png" alt="Google Play">
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <img src="img/logo_dubay-transformed.png" alt="Dubay Bank Logo" class="footer-logo">
                    <p>O banco digital que você merece.</p>
                </div>
                <div class="footer-links">
                    <h5>Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home">Início</a></li>
                        <li><a href="#services">Serviços</a></li>
                        <li><a href="#about">Sobre</a></li>
                        <li><a href="#contact">Contato</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h5>Redes Sociais</h5>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Dubay Bank. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/main.js"></script>
</body>
</html> 