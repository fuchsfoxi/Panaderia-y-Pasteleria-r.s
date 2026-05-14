<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/main.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/historial.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <?php include __DIR__ . '/../layouts/menu.php'; ?>

    <div class="historial_contenido">

        <form method="GET" action="<?= BASE_URL ?>/historial">
            <input type="date" name="fecha" id="fecha_historial">
            <select name="tipo" id="producto_filtrar">
                <option value="todos">Todos los productos</option>
                <option value="Pan">Panes</option>
                <option value="Bocadito">Bocaditos</option>
                <option value="Torta">Tortas</option>
            </select>
            <button type="submit">Buscar</button>
        </form>

        <?php foreach ($registros as $item): ?>
            <div class="carta_historial">
                <p><?= $item['nombre_prod'] ?></p>
                <p><?= $item['cantidad_prod'] ?></p>
                <p><?= $item['nombre_turno'] ?></p>
                <a href="<?= BASE_URL ?>/produccion/editar/<?= $item['id_produccion'] ?>">Editar</a>
                <a href="<?= BASE_URL ?>/produccion/eliminar/<?= $item['id_produccion'] ?>">Eliminar</a>
            </div>
        <?php endforeach; ?>

    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>