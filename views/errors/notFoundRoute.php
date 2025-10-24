<body><div class="custom-bg text-dark">
    <div class="d-flex align-items-center justify-content-center min-vh-100 px-2">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="fs-2 fw-medium mt-4">Oops! Página não encontrada :\</p>
            <p class="mt-4 mb-5"><?= isset($route) ? 'Route <strong>' . htmlspecialchars($route) . '</strong> not found.' : 'Page not found.' ?></p>
            <a href="/" class="btn btn-light fw-semibold rounded-pill px-4 py-2 custom-btn">
                Return to home page
            </a>
        </div>
    </div>
</div>