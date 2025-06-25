<?php
$pageTitle = 'Início';
include 'includes/header.php';
?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <h1>ExPay Bank</h1>
                <p>Completo pra você.<br/> Inteligente para seu negócio.</p>
                <a href="#" class="cta-button contact-button">
                    <i class="fas fa-envelope"></i> Fale Conosco
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
                <img src="img/hero-image.png" alt="ExPay App">
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
            <h2>Sobre o ExPay</h2>
            <p>Somos mais que um banco, somos seu parceiro financeiro. Oferecemos soluções inovadoras e personalizadas para você alcançar seus objetivos.</p>
            <a href="#" class="cta-button contact-button">
                <i class="fas fa-envelope"></i> Entre em Contato
            </a>
        </div>
    </section>

    <!-- App Download Section -->
    <section class="app-download-section">
        <div class="container text-center">
            <h2>Baixe Nosso App</h2>
            <p>Em breve disponível para iOS e Android.</p>
            <div class="app-stores">
                <span class="store-button coming-soon">
                    <img src="img/appstore-1.png" alt="App Store - Em breve">
                    <div class="coming-soon-overlay">Em breve</div>
                </span>
                <span class="store-button coming-soon">
                    <img src="img/googleplay-1.png" alt="Google Play - Em breve">
                    <div class="coming-soon-overlay">Em breve</div>
                </span>
            </div>
            <img style="max-width: 500px !important;" src="img/create-the-dubai-landscape.png" width="100%" alt="Dubai Landscape" class="app-landscape">
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Entre em Contato</h2>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Endereço</h4>
                                <p>R DA ASSEMBLEIA, 10<br>
                                SAL 3301<br>
                                CENTRO - RIO DE JANEIRO/RJ<br>
                                CEP: 20.011-901</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Telefone</h4>
                                <p>(21) 4149-0055</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p>suporte@expaybank.com.br</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-building"></i>
                            <div>
                                <h4>CNPJ</h4>
                                <p>60.127.247/0001-03</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-card">
                        <h3>Envie uma Mensagem</h3>
                        <p>Preencha o formulário abaixo e entraremos em contato o mais breve possível.</p>
                        <button class="cta-button contact-button w-100">
                            <i class="fas fa-envelope"></i> Abrir Formulário
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Modal -->
    <div id="contactModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Entre em Contato</h2>
            <form id="contactForm" class="contact-form">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Enviar Mensagem</button>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 