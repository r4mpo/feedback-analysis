<body><div class="custom-bg text-dark">
    <div class="d-flex align-items-center justify-content-center min-vh-100 px-2">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="fs-2 fw-medium mt-4">Oops! Página não encontrada :\</p>
            <p class="mt-4 mb-5"><?= isset($route) ? 'A rota <strong>' . htmlspecialchars($route) . '</strong> não foi encontrada.' : 'Página não encontrada.' ?></p>
            <a href="/" class="btn btn-light fw-semibold rounded-pill px-4 py-2 custom-btn">
                Voltar à página inicial
            </a>
        </div>
    </div>
</div>