<?php 
require_once("../functions/autoload.php");
Autenticacion::verify();
?>

<div class="container py-5 text-light">
  <div class="text-center mb-5">
    <h1 class="display-4 fw-bold text-dark">Panel de Administración</h1>
    <p class="lead">Bienvenido a <strong>Indomito Tech</strong>. Desde aquí podrás gestionar productos, marcas y más.</p>
  </div>

  <div class="row text-center">
    <div class="col-md-4 mb-4">
      <div class="card bg-dark-accent text-white shadow-sm border-0 h-100">
        <div class="card-body">
          <h5 class="card-title">Productos</h5>
          <p class="card-text">Agregá, editá o eliminá productos del catálogo.</p>
          <a href="?sec=productos" class="btn btn-outline-light">Ir a Productos</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card bg-dark-accent text-white shadow-sm border-0 h-100">
        <div class="card-body">
          <h5 class="card-title">Marcas</h5>
          <p class="card-text">Administrá las marcas asociadas a los productos.</p>
          <a href="?sec=marcas" class="btn btn-outline-light">Ir a Marcas</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card bg-dark-accent text-white shadow-sm border-0 h-100">
        <div class="card-body">
          <h5 class="card-title">Cerrar sesión</h5>
          <p class="card-text">Cerrar tu sesión de administrador de forma segura.</p>
          <a href="actions/logout.php" class="btn btn-outline-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .bg-dark-accent {
    background-color: #1f1f1f;
  }
</style>
