<footer class="site-footer">
  <div class="container">
    <div class="footer-content">
      <div class="footer-brand">
        <span class="brand-name">INDOMITO Tech</span>
        <span class="brand-tagline">Tu mundo tecnologico</span>
      </div>
      <div class="footer-info">
        <p class="mb-0">&copy; <?= date("Y"); ?> Indomito Tech - Todos los derechos reservados</p>
        <p class="mb-0 small text-muted">Teo Indomito - Programacion 2</p>
      </div>
    </div>
  </div>
</footer>

<style>
.site-footer {
  background-color: #1a1a1a;
  border-top: 1px solid #2a2a2a;
  padding: 2rem 0;
  margin-top: auto;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.footer-brand {
  display: flex;
  flex-direction: column;
}

.brand-name {
  color: #0dcaf0;
  font-size: 1.25rem;
  font-weight: 700;
  letter-spacing: 1px;
}

.brand-tagline {
  color: #666;
  font-size: 0.8rem;
}

.footer-info {
  text-align: right;
  color: #888;
  font-size: 0.9rem;
}

@media (max-width: 576px) {
  .footer-content {
    flex-direction: column;
    text-align: center;
  }
  .footer-info {
    text-align: center;
  }
}
</style>

</body>
</html>
