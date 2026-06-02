<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
</head>
<body>
    <h1>Detalles del Producto</h1>
    <?php

    $nombre = "Computadora HP pavilion 15";
    $precio = 1000;
    $disponibilidad = 12;
    ?>
    <ol>
        <li><strong>Nombre:</strong> <?php echo $nombre; ?></li>
        <li><strong>Precio:</strong> $<?php echo $precio; ?></li>
        <li><strong>Disponibilidad:</strong> <?php echo $disponibilidad; ?> unidades en bodega</li>
    </ol>
</body>
</html>

