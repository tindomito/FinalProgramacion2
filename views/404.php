<section class="container py-5">
  <div class="error-container text-center">
    <div class="error-icon">
      <i class="bi bi-exclamation-triangle"></i>
    </div>
    <h1 class="error-code">404</h1>
    <h2 class="error-title text-light">Pagina no encontrada</h2>
    <p class="error-message text-muted">
      Lo sentimos, la pagina que buscas no existe o fue movida.
    </p>
    <div class="error-actions mt-4">
      <a href="index.php?sec=inicio" class="btn btn-accent btn-lg">
        <i class="bi bi-house me-2"></i>Volver al inicio
      </a>
      <a href="index.php?sec=filtro" class="btn btn-outline-light btn-lg ms-3">
        <i class="bi bi-search me-2"></i>Ver productos
      </a>
    </div>
  </div>
</section>

<style>
body {
  background-color: #121212;
  color: #f5f5f5;
}

.text-accent {
  color: #0dcaf0 !important;
}

.btn-accent {
  background-color: #0dcaf0;
  border: none;
  color: #121212;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-accent:hover {
  background-color: #0bb2d4;
  color: #fff;
  transform: translateY(-2px);
}

.error-container {
  padding: 4rem 2rem;
}

.error-icon {
  font-size: 6rem;
  color: #0dcaf0;
  opacity: 0.5;
  margin-bottom: 1rem;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

.error-code {
  font-size: 8rem;
  font-weight: 700;
  color: #0dcaf0;
  line-height: 1;
  margin-bottom: 1rem;
  text-shadow: 0 0 30px rgba(13, 202, 240, 0.3);
}

.error-title {
  font-size: 1.75rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.error-message {
  font-size: 1.1rem;
  max-width: 400px;
  margin: 0 auto;
}

.btn-outline-light:hover {
  background-color: #f8f9fa;
  color: #121212;
}

@media (max-width: 576px) {
  .error-code {
    font-size: 5rem;
  }
  .error-actions .btn {
    display: block;
    width: 100%;
    margin: 0.5rem 0 !important;
  }
}
</style>
