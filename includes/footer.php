<footer class="footer-section">
    <div class="container">
        <div class="footer-cta">
            <h3>Precisa de ajuda?</h3>
            <p>Nossa equipe está pronta para atender você</p>
            <button class="cta-button contact-button">
                <i class="fas fa-envelope"></i> Fale Conosco
            </button>
        </div>
        <div class="footer-content">
            <div class="footer-info">
                <img src="img/expay2.png" alt="ExPay Logo" class="footer-logo">
                <p>O banco digital que você merece.</p>
                <div class="company-info">
                    <p><strong>CNPJ:</strong> 60.127.247/0001-03</p>
                    <p><strong>Endereço:</strong><br>
                    R DA ASSEMBLEIA, 10<br>
                    SAL 3301<br>
                    CENTRO - RIO DE JANEIRO/RJ<br>
                    CEP: 20.011-901</p>
                    <p><strong>Contato:</strong><br>
                    Tel: (21) 4149-0055<br>
                    Email: suporte@expaybank.com.br</p>
                </div>
            </div>
            <div class="footer-links">
                <h5>Links Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php#home">Início</a></li>
                    <li><a href="index.php#services">Serviços</a></li>
                    <li><a href="support.php">Suporte</a></li>
                    <li><a href="privacy-policy.php">Política de Privacidade</a></li>
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
            <p>&copy; <?php echo date('Y'); ?> ExPay. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

<style>
.footer-cta {
    text-align: center;
    padding: 40px 0;
    margin-bottom: 40px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-cta h3 {
    color: #fff;
    font-size: 24px;
    margin-bottom: 10px;
}

.footer-cta p {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 20px;
}

.footer-cta .cta-button {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.footer-cta .cta-button:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.footer-cta .cta-button i {
    font-size: 20px;
}
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="js/main.js"></script> 