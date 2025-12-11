<?php
require_once "classes/Secciones.php";
$secciones = Secciones::secciones_del_sitio();
?>

<header class="bg-dark shadow-sm">
  <nav class="navbar navbar-expand-lg navbar-dark container">
    <a class="navbar-brand fw-bold text-accent" href="?sec=inicio">INDOMITO Tech</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php foreach ($secciones as $value): ?>
          <?php if ($value->getInMenu()): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($_GET['sec'] ?? 'inicio' === $value->getVinculo()) echo 'active'; ?>" href="?sec=<?= $value->getVinculo(); ?>">
                <?= $value->getTexto(); ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>
</header>
<style>
    .bg-dark {
  background-color: #1e1e1e !important;
}

.navbar-brand {
  font-size: 1.5rem;
  letter-spacing: 1px;
}

.text-accent {
  color: #0dcaf0 !important;
}

.navbar-dark .navbar-nav .nav-link {
  color: #ddd;
  transition: all 0.2s ease-in-out;
}

.navbar-dark .navbar-nav .nav-link:hover,
.navbar-dark .navbar-nav .nav-link.active {
  color: #0dcaf0;
  border-bottom: 2px solid #0dcaf0;
}

</style>