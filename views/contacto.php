<h1>Contacto</h1>
<form class="container" action="?sec='enviado'" method="get">
    <?php
        if (isset($_GET['sec']) && $_GET['sec'] === 'contacto') {
        ?>
        <input type="hidden" name="sec" value="enviado" />
        <?php
        }
    ?>

<div class="mb-3">
  <label for="nombre" class="form-label">Nombre</label>
  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
</div>
<div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
</div>
<div class="mb-3">
  <label for="comentario" class="form-label">Comentario</label>
  <textarea class="form-control" id="comentario" rows="3" name="comentario"></textarea>
</div>

    <input type="submit" value="Enviar" class="btn btn-primary mb-3">
</form>