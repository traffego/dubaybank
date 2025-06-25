// Animação suave do scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        // Não fazer nada se o href for apenas #
        if (href === '#') return;
        
        e.preventDefault();
        const targetId = href.split('#')[1];
        if (!targetId) return;
        
        const target = document.getElementById(targetId);
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Contador de estatísticas
const counters = document.querySelectorAll('.counter-number');
const speed = 200;

const startCounting = (counter) => {
    const target = +counter.getAttribute('data-target');
    const count = +counter.innerText;
    const increment = target / speed;

    if (count < target) {
        counter.innerText = Math.ceil(count + increment);
        setTimeout(() => startCounting(counter), 1);
    } else {
        counter.innerText = target;
    }
};

// Observador de interseção para iniciar contagem quando visível
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            startCounting(entry.target);
            observer.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.5
});

counters.forEach(counter => {
    counter.innerText = '0';
    observer.observe(counter);
});

// Header fixo com mudança de estilo no scroll
const header = document.querySelector('.header-section');
let lastScroll = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll <= 0) {
        header.classList.remove('scroll-up');
        return;
    }

    if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
        // Scroll Down
        header.classList.remove('scroll-up');
        header.classList.add('scroll-down');
    } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
        // Scroll Up
        header.classList.remove('scroll-down');
        header.classList.add('scroll-up');
    }
    lastScroll = currentScroll;
});

// Animação de fade in dos elementos
const fadeElements = document.querySelectorAll('.fade-in');

const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            fadeObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.1
});

fadeElements.forEach(element => {
    fadeObserver.observe(element);
});

// Menu Mobile
const menuToggle = document.querySelector('.menu-toggle');
const mainNav = document.querySelector('.main-nav');
const navLinks = document.querySelectorAll('.main-nav a');

if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        mainNav.classList.toggle('active');
    });

    // Fechar menu ao clicar em um link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            mainNav.classList.remove('active');
        });
    });
}

// Mobile Menu Toggle
const mobileMenuButton = document.querySelector('.mobile-menu-button');
const mainNavMobile = document.querySelector('.main-nav');

if (mobileMenuButton && mainNavMobile) {
    mobileMenuButton.addEventListener('click', () => {
        mobileMenuButton.classList.toggle('active');
        mainNavMobile.classList.toggle('active');
        document.body.style.overflow = mainNavMobile.classList.contains('active') ? 'hidden' : '';
    });

    // Fechar menu ao clicar em um link
    const navLinksMobile = mainNavMobile.querySelectorAll('a');
    navLinksMobile.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenuButton.classList.remove('active');
            mainNavMobile.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // Fechar menu ao clicar fora
    document.addEventListener('click', (e) => {
        if (!mainNavMobile.contains(e.target) && !mobileMenuButton.contains(e.target)) {
            mobileMenuButton.classList.remove('active');
            mainNavMobile.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

// Lazy Loading Images
const lazyImages = document.querySelectorAll('img[data-src]');
const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            observer.unobserve(img);
        }
    });
});

lazyImages.forEach(img => imageObserver.observe(img));

// Fade-in Animation
const fadeElementsMobile = document.querySelectorAll('.fade-in');
const fadeObserverMobile = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.1
});

fadeElementsMobile.forEach(element => fadeObserverMobile.observe(element));

// Header Scroll Effect
const headerMobile = document.querySelector('.header-section');
let lastScrollMobile = 0;

window.addEventListener('scroll', () => {
    const currentScrollMobile = window.pageYOffset;
    
    if (currentScrollMobile <= 0) {
        headerMobile.classList.remove('scroll-up');
        return;
    }
    
    if (currentScrollMobile > lastScrollMobile && !headerMobile.classList.contains('scroll-down')) {
        headerMobile.classList.remove('scroll-up');
        headerMobile.classList.add('scroll-down');
    } else if (currentScrollMobile < lastScrollMobile && headerMobile.classList.contains('scroll-down')) {
        headerMobile.classList.remove('scroll-down');
        headerMobile.classList.add('scroll-up');
    }
    
    lastScrollMobile = currentScrollMobile;
});

// Animação de fade in para elementos quando entram na viewport
const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
};

const observerMobile = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observerMobile.unobserve(entry.target);
        }
    });
}, observerOptions);

// Elementos para animar
const animateElementsMobile = document.querySelectorAll('.benefit-card, .app-content, .phone-mockup');
animateElementsMobile.forEach(element => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(20px)';
    element.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
    observerMobile.observe(element);
});

// Classe para animação
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .fade-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    </style>
`);

// Adicionar estilos para animação do header
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .header {
            transition: transform 0.3s ease;
        }
        
        .header.scroll-down {
            transform: translateY(-100%);
        }
        
        .header.scroll-up {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
`);

// Simulação de carregamento do mockup do app
const phoneMockup = document.querySelector('.phone-mockup');
if (phoneMockup) {
    // Adiciona gradiente animado ao mockup
    phoneMockup.innerHTML = `
        <div class="mockup-screen">
            <div class="mockup-header"></div>
            <div class="mockup-content">
                <div class="mockup-item"></div>
                <div class="mockup-item"></div>
                <div class="mockup-item"></div>
            </div>
        </div>
    `;
    
    // Estilos para o mockup
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            .mockup-screen {
                height: 100%;
                padding: 20px;
                background: linear-gradient(45deg, var(--color-emerald), var(--color-gold));
            }
            
            .mockup-header {
                height: 60px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                margin-bottom: 20px;
            }
            
            .mockup-content {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            
            .mockup-item {
                height: 100px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0% { opacity: 0.6; }
                50% { opacity: 0.8; }
                100% { opacity: 0.6; }
            }
        </style>
    `);
}

// Botões CTA com efeito de hover
document.querySelectorAll('.cta-button').forEach(button => {
    button.addEventListener('mouseover', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 4px 15px rgba(80, 200, 120, 0.3)';
    });
    
    button.addEventListener('mouseout', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
    });
});

// Service Cards Animation
const serviceCards = document.querySelectorAll('.service-card');
const serviceObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            observer.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.2
});

serviceCards.forEach(card => serviceObserver.observe(card));

// Feedback Modal HTML
document.body.insertAdjacentHTML('beforeend', `
    <div id="feedbackModal" class="modal feedback-modal">
        <div class="modal-content feedback-modal-content">
            <div class="feedback-icon">
                <i class="fas fa-check-circle success-icon"></i>
                <i class="fas fa-times-circle error-icon"></i>
            </div>
            <h2 class="feedback-title"></h2>
            <p class="feedback-message"></p>
            <button class="feedback-button">OK</button>
        </div>
    </div>
`);

// Adicionar estilos para o modal de feedback
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .feedback-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .feedback-modal.show {
            opacity: 1;
        }
        
        .feedback-modal-content {
            background: #fff;
            margin: 15% auto;
            padding: 40px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            position: relative;
            text-align: center;
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .feedback-modal.show .feedback-modal-content {
            transform: translateY(0);
            opacity: 1;
        }
        
        .feedback-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        
        .success-icon {
            color: #28a745;
            display: none;
        }
        
        .error-icon {
            color: #dc3545;
            display: none;
        }
        
        .feedback-title {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feedback-message {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        
        .feedback-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .feedback-button:hover {
            background: var(--secondary-color);
        }
        
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
`);

// Função para mostrar o modal de feedback
function showFeedback(success, title, message) {
    const modal = document.getElementById('feedbackModal');
    const successIcon = modal.querySelector('.success-icon');
    const errorIcon = modal.querySelector('.error-icon');
    const titleElement = modal.querySelector('.feedback-title');
    const messageElement = modal.querySelector('.feedback-message');
    
    // Configurar o conteúdo
    titleElement.textContent = title;
    messageElement.textContent = message;
    
    // Mostrar o ícone apropriado
    successIcon.style.display = success ? 'block' : 'none';
    errorIcon.style.display = success ? 'none' : 'block';
    
    // Mostrar o modal
    modal.style.display = 'block';
    setTimeout(() => modal.classList.add('show'), 10);
    
    // Configurar o botão de fechar
    const closeButton = modal.querySelector('.feedback-button');
    closeButton.onclick = function() {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    };
}

// Form Validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const inputs = form.querySelectorAll('input, textarea');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('error');
            } else {
                input.classList.remove('error');
            }
        });
        
        if (isValid) {
            console.log('Formulário válido, pronto para enviar');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const modal = document.getElementById('contactModal');
    const closeButtons = document.querySelectorAll('.close-modal');
    const contactButtons = document.querySelectorAll('.contact-button');
    const contactForm = document.getElementById('contactForm');
    
    if (contactButtons.length > 0 && modal) {
        contactButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });
    }

    if (closeButtons.length > 0 && modal) {
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        });
    }

    if (modal) {
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }

    // Manipulação do formulário de suporte
    const supportForm = document.getElementById('supportForm');
    if (supportForm) {
        let isSubmitting = false; // Flag para prevenir envio duplo
        
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Prevenir envio duplo
            if (isSubmitting) return;
            
            // Validação básica dos campos
            const name = this.querySelector('#name').value.trim();
            const email = this.querySelector('#email').value.trim();
            const subject = this.querySelector('#subject').value.trim();
            const message = this.querySelector('#message').value.trim();
            
            if (!name || !email || !subject || !message) {
                showFeedback(false, 'Atenção', 'Por favor, preencha todos os campos.');
                return;
            }
            
            // Desabilita o botão durante o envio
            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
            
            // Marca como enviando
            isSubmitting = true;
            
            // Coleta os dados do formulário
            const formData = new FormData(this);
            
            // Envia a requisição
            fetch('send_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na resposta do servidor: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Resposta do servidor:', data);
                if (data.success) {
                    showFeedback(true, 'Sucesso!', data.message);
                    supportForm.reset();
                } else {
                    showFeedback(false, 'Erro', data.message);
                }
            })
            .catch(error => {
                console.error('Erro detalhado:', error);
                showFeedback(false, 'Erro', 'Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
                isSubmitting = false; // Reset da flag de envio
            });
        });
    }
}); 