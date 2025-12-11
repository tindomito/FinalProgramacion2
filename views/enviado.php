<?php
$cantidad = count($_GET);  
    $names = array_keys($_GET); // obtiene los nombres de las varibles  
    // var_dump($names);
    $valores = array_values($_GET); // obtiene los valores de las varibles  
    // var_dump($valores);
    $campos= [];
    for($i=0; $i<$cantidad; $i++){
        if($names[$i] != "sec"){
            $campos[$names[$i]] = $valores[$i];
        }
    } 
/*     echo "<pre>";
    var_dump($campos);
    echo "</pre>"; */
?>
<h1>Formulario Enviado</h1>
<div class="row">
    <div class="col-10 m-auto">
        <div class="card mb-3">
            <div class="card-body">
            <?php
                foreach ($campos as $key => $value) {
                ?>
                <div class="d-flex flex-row mb-3">
                    <p class="lead fw-bold"><?= ucfirst($key); ?>:</p>
                    <p class="lead ps-2"><?= $value; ?></p>
                </div>
                <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <p>Volver a <a href="?sec=inicio">Inicio</a></p>
</div>