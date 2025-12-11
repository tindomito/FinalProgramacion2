<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="contact-card">
        <div class="text-center mb-5">
          <i class="bi bi-envelope display-4 text-accent"></i>
          <h1 class="mt-3 text-light fw-bold">Contactanos</h1>
          <p class="text-muted">Estamos para ayudarte. Completa el formulario y te responderemos pronto.</p>
        </div>

        <form action="index.php" method="get">
          <input type="hidden" name="sec" value="enviado" />

          <div class="row g-4">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control bg-dark text-light border-secondary" id="nombre" name="nombre" placeholder="Tu nombre" required>
                <label for="nombre" class="text-muted">Nombre</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control bg-dark text-light border-secondary" id="email" name="email" placeholder="tu@email.com" required>
                <label for="email" class="text-muted">Email</label>
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control bg-dark text-light border-secondary" id="asunto" name="asunto" placeholder="Asunto">
                <label for="asunto" class="text-muted">Asunto</label>
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control bg-dark text-light border-secondary" id="comentario" name="comentario" placeholder="Tu mensaje" style="height: 150px" required></textarea>
                <label for="comentario" class="text-muted">Mensaje</label>
              </div>
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-accent btn-lg w-100">
                <i class="bi bi-send me-2"></i>Enviar mensaje
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Info adicional -->
      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="info-card text-center">
            <i class="bi bi-geo-alt display-5 text-accent"></i>
            <h5 class="mt-3 text-light">Ubicacion</h5>
            <p class="text-muted small mb-0">Buenos Aires, Argentina</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card text-center">
            <i class="bi bi-telephone display-5 text-accent"></i>
            <h5 class="mt-3 text-light">Telefono</h5>
            <p class="text-muted small mb-0">+54 11 1234-5678</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card text-center">
            <i class="bi bi-clock display-5 text-accent"></i>
            <h5 class="mt-3 text-light">Horario</h5>
            <p class="text-muted small mb-0">Lun - Vie: 9:00 - 18:00</p>
          </div>
        </div>
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

.contact-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 2.5rem;
}

.info-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 12px;
  padding: 1.5rem;
  transition: all 0.3s ease;
}

.info-card:hover {
  border-color: #0dcaf0;
  transform: translateY(-3px);
}

.form-control {
  border-radius: 8px;
  padding: 1rem;
}

.form-control:focus {
  border-color: #0dcaf0;
  box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
  background-color: #1a1a1a;
}

.form-floating > label {
  padding: 1rem;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
  color: #0dcaf0;
}

.bg-dark {
  background-color: #1a1a1a !important;
}
</style>
