<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock - Bocaditos</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/stock_css/stock_panes.css">
</head>
<body>
    <?php include __DIR__ . '/../layouts/menu.php'; ?>
<main>
    <form action="<?= BASE_URL ?>/stock/guardar" method="POST">
        <input type="hidden" name="tipo" value="Bocadito">

        <div class="stock_Panes">
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" required>
        </div>

        <div class="stock_Panes">
            <label for="id_turno">Turno</label>
            <select id="id_turno" name="id_turno" required>
                <?php foreach ($turnos as $turno): ?>
                    <option value="<?= $turno['id_turno'] ?>">
                        <?= $turno['nombre_turno'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="stock_Panes">
            <label for="id_producto">Producto</label>
            <select id="id_producto" name="id_producto" required>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto['id_producto'] ?>">
                        <?= $producto['nombre_prod'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Guardar</button>
    </form>

    <div class="cards-produccion">
        <?php foreach ($bocaditos as $bocadito): ?>
            <div class="card-produccion">
                <div class="card-prod-header">
                    <span class="card-prod-nombre"><?= htmlspecialchars($bocadito['nombre_prod']) ?></span>
                <span class="card-prod-fecha">
                <?= $bocadito['hora_agotada'] ?? '' ?>
            </span>
    </div>
                <div class="card-prod-footer">
                    <span>Latas: <?= $bocadito['cantidad_prod'] ?></span>
                    <span><?= htmlspecialchars($bocadito['nombre_turno']) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
<script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script>
</body>
</html>