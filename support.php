<?php include 'includes/header.php'; ?>

<section class="support-hero" style="padding-top: 120px; background: var(--light-bg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-5" style="color: var(--primary-color);">Central de Suporte</h1>
                
                <div class="support-info-card mb-4">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h2>Email</h2>
                            <p>suporte@expaybank.com.br</p>
                            <p>Número do caso: 102617778843</p>
                        </div>
                    </div>
                </div>

                <div class="support-info-card mb-4">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="info-content">
                            <h2>Endereço</h2>
                            <p>R DA ASSEMBLEIA, 10</p>
                            <p>SAL 3301</p>
                            <p>CENTRO - RIO DE JANEIRO/RJ</p>
                            <p>CEP: 20.011-901</p>
                        </div>
                    </div>
                </div>

                <div class="support-info-card mb-5">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="info-content">
                            <h2>Informações Adicionais</h2>
                            <p>CNPJ: 60.127.247/0001-03</p>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Contato -->
                <div class="support-info-card">
                    <h2 class="mb-4">Entre em Contato</h2>
                    <form id="supportForm" action="send_email.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Assunto</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background-color: var(--primary-color); border-color: var(--primary-color);">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Mensagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.support-info-card {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.info-icon {
    font-size: 24px;
    color: var(--primary-color);
    background: rgba(197, 165, 114, 0.1);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-content h2 {
    font-size: 24px;
    color: var(--secondary-color);
    margin-bottom: 15px;
}

.info-content p {
    font-size: 16px;
    color: var(--text-color);
    margin-bottom: 5px;
    line-height: 1.5;
}

.form-control {
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(197, 165, 114, 0.25);
}

.form-label {
    font-weight: 500;
    margin-bottom: 8px;
}

.btn-primary:hover {
    background-color: #b08d5a !important;
    border-color: #b08d5a !important;
}
</style>

<!-- Script para manipulação do formulário -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('supportForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validação dos campos
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();
        
        // Verificar se todos os campos estão preenchidos
        if (!name || !email || !subject || !message) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }
        
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
        
        // Criar FormData e verificar os dados
        const formData = new FormData(this);
        console.log('Dados do formulário:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        fetch('send_email.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Resposta do servidor:', data); // Debug
            if (data.success) {
                alert(data.message);
                form.reset();
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
            alert('Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?> 