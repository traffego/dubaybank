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
            // Aqui você pode adicionar o código para enviar o formulário
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
    
    // Só adiciona os event listeners se os elementos existirem
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

    // Form submission - apenas se o formulário existir
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validação dos campos
            const name = this.querySelector('#name').value.trim();
            const email = this.querySelector('#email').value.trim();
            const subject = this.querySelector('#subject').value.trim();
            const message = this.querySelector('#message').value.trim();
            
            if (!name || !email || !subject || !message) {
                alert('Por favor, preencha todos os campos.');
                return;
            }
            
            const formData = new FormData(contactForm);
            const submitButton = contactForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
            
            fetch('send_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    contactForm.reset();
                    if (modal) {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                } else {
                    if (data.errors) {
                        alert(data.message + '\n' + data.errors.join('\n'));
                    } else {
                        alert(data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao enviar mensagem. Por favor, tente novamente.');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });
    }

    // Manipulação do formulário de suporte
    const supportForm = document.getElementById('supportForm');
    if (supportForm) {
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validação básica dos campos
            const name = this.querySelector('#name').value.trim();
            const email = this.querySelector('#email').value.trim();
            const subject = this.querySelector('#subject').value.trim();
            const message = this.querySelector('#message').value.trim();
            
            if (!name || !email || !subject || !message) {
                alert('Por favor, preencha todos os campos.');
                return;
            }
            
            // Desabilita o botão durante o envio
            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
            
            // Coleta os dados do formulário
            const formData = new FormData(this);
            
            // Log dos dados do formulário
            console.log('Dados do formulário:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
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
                    alert(data.message);
                    supportForm.reset();
                } else {
                    if (data.errors) {
                        alert(data.message + '\n' + data.errors.join('\n'));
                    } else {
                        alert(data.message || 'Erro ao enviar mensagem.');
                    }
                }
            })
            .catch(error => {
                console.error('Erro detalhado:', error);
                alert('Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            });
        });
    }
}); 