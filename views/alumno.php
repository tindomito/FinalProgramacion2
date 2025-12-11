<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="alumno-card">
        <div class="row g-4 align-items-center">
          <!-- Foto -->
          <div class="col-md-4 text-center">
            <div class="photo-wrapper">
              <img src="img/banners/teoindomito.jpg" alt="Foto del alumno Teo Indomito" class="img-fluid">
            </div>
          </div>

          <!-- Datos -->
          <div class="col-md-8">
            <h1 class="text-light fw-bold mb-4">
              <i class="bi bi-person-badge text-accent me-2"></i>Datos del Alumno
            </h1>

            <div class="info-list">
              <div class="info-item">
                <span class="info-label">Alumno</span>
                <span class="info-value">Teo Indomito</span>
              </div>
              <div class="info-item">
                <span class="info-label">Edad</span>
                <span class="info-value">22 anios</span>
              </div>
              <div class="info-item">
                <span class="info-label">Comision</span>
                <span class="info-value">DWM3AP</span>
              </div>
              <div class="info-item">
                <span class="info-label">Turno</span>
                <span class="info-value">Maniana</span>
              </div>
              <div class="info-item">
                <span class="info-label">Profesor</span>
                <span class="info-value">Alejandro D'Addezio</span>
              </div>
              <div class="info-item">
                <span class="info-label">Materia</span>
                <span class="info-value text-accent">Programacion 2</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tecnologias usadas -->
      <div class="tech-card mt-4">
        <h5 class="text-light mb-4">
          <i class="bi bi-code-slash text-accent me-2"></i>Tecnologias utilizadas
        </h5>
        <div class="tech-badges">
          <span class="tech-badge">
            <i class="bi bi-filetype-php"></i> PHP
          </span>
          <span class="tech-badge">
            <i class="bi bi-filetype-html"></i> HTML5
          </span>
          <span class="tech-badge">
            <i class="bi bi-filetype-css"></i> CSS3
          </span>
          <span class="tech-badge">
            <i class="bi bi-bootstrap"></i> Bootstrap 5
          </span>
          <span class="tech-badge">
            <i class="bi bi-database"></i> MySQL
          </span>
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

.alumno-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 2rem;
}

.photo-wrapper {
  background-color: #2a2a2a;
  border-radius: 12px;
  padding: 1rem;
  display: inline-block;
}

.photo-wrapper img {
  border-radius: 8px;
  max-width: 200px;
  transition: transform 0.3s ease;
}

.photo-wrapper:hover img {
  transform: scale(1.02);
}

.info-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.info-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 1rem;
  background-color: #2a2a2a;
  border-radius: 8px;
  transition: all 0.2s ease;
}

.info-item:hover {
  background-color: #333;
}

.info-label {
  color: #888;
  font-size: 0.9rem;
}

.info-value {
  color: #f5f5f5;
  font-weight: 500;
}

.tech-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 1.5rem;
}

.tech-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.tech-badge {
  background-color: #2a2a2a;
  color: #0dcaf0;
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-size: 0.875rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s ease;
}

.tech-badge:hover {
  background-color: #0dcaf0;
  color: #121212;
}
</style>
