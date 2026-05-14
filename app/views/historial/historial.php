<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
</head>
<body>
    <?php include __DIR__ . '/../../layouts/menu.php'; ?>

    <div class="historial_contenido">
        
        <div class="fecha_historial">
            <input type="date" name="fecha_historial" id="fecha_historial">
        </div>

        <div class="produccion_historial">
            <select name="filtrar_producto" id="producto_filtrar">
                <option value="todos">Todos los productos</option>
                <option value="Pan">Panes</option>
                <option value="Bocadito">Bocaditos</option>
                <option value="Torta">Tortas</option>
            </select>
        </div>

        <!-- Lista de registros -->
        <?php foreach ($panes as $item): ?>
            <div class="carta_historial">
                <p><?= $item['nombre_prod'] ?></p>
                <p><?= $item['cantidad_prod'] ?></p>
                <p><?= $item['nombre_turno'] ?></p>
                <a href="<?= BASE_URL ?>/produccion/editar/<?= $item['id_produccion'] ?>">Editar</a>
                <a href="<?= BASE_URL ?>/produccion/eliminar/<?= $item['id_produccion'] ?>">Eliminar</a>
            </div>
        <?php endforeach; ?>

    </div>

</body>
</html>