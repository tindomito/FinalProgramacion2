<?php
$cantidad = count($_GET);
$names = array_keys($_GET);
$valores = array_values($_GET);
$campos = [];

for ($i = 0; $i < $cantidad; $i++) {
    if ($names[$i] != "sec") {
        $campos[$names[$i]] = $valores[$i];
    }
}
?>

<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="success-card text-center">
        <div class="success-icon">
          <i class="bi bi-check-circle"></i>
        </div>
        <h1 class="text-light fw-bold mt-4">Mensaje Enviado</h1>
        <p class="text-muted">Tu mensaje ha sido recibido correctamente. Te contactaremos pronto.</p>
      </div>

      <div class="details-card mt-4">
        <h5 class="text-light mb-4">
          <i class="bi bi-file-text text-accent me-2"></i>Resumen del mensaje
        </h5>

        <?php foreach ($campos as $key => $value): ?>
          <div class="detail-item">
            <span class="detail-label"><?= ucfirst(htmlspecialchars($key)); ?></span>
            <span class="detail-value"><?= htmlspecialchars($value); ?></span>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="text-center mt-4">
        <a href="index.php?sec=inicio" class="btn btn-accent btn-lg">
          <i class="bi bi-house me-2"></i>Volver al inicio
        </a>
        <a href="index.php?sec=filtro" class="btn btn-outline-light btn-lg ms-3">
          <i class="bi bi-shop me-2"></i>Ver productos
        </a>
      </div>
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

.success-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 3rem 2rem;
}

.success-icon {
  font-size: 5rem;
  color: #0dcaf0;
  animation: pulse-success 2s ease-in-out infinite;
}

@keyframes pulse-success {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.05);
    opacity: 0.8;
  }
}

.details-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 1.5rem;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 1rem;
  background-color: #2a2a2a;
  border-radius: 8px;
  margin-bottom: 0.75rem;
}

.detail-item:last-child {
  margin-bottom: 0;
}

.detail-label {
  color: #888;
  font-size: 0.9rem;
  font-weight: 500;
  text-transform: capitalize;
}

.detail-value {
  color: #f5f5f5;
  text-align: right;
  max-width: 60%;
  word-wrap: break-word;
}

.btn-outline-light:hover {
  background-color: #f8f9fa;
  color: #121212;
}

@media (max-width: 576px) {
  .detail-item {
    flex-direction: column;
    gap: 0.5rem;
  }
  .detail-value {
    max-width: 100%;
    text-align: left;
  }
}
</style>
