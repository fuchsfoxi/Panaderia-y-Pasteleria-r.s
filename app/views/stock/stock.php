<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
</head>
<body>
    <?php include __DIR__ . '/../../layouts/menu.php'; ?>

    <div class="stock_contenido_general">
        
        <a href="<?= BASE_URL ?>/produccion/crear?tipo=Pan">
            <div class="carta_stock">
                <img src="<?= BASE_URL ?>/public/img/stock_panes.jpg" alt="pan">
                <p>Panes</p>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/produccion/crear?tipo=Bocadito">
            <div class="carta_stock">
                <img src="<?= BASE_URL ?>/public/img/stock_bocaditos.jpg" alt="bocadito">
                <p>Bocaditos</p>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/produccion/crear?tipo=Torta">
            <div class="carta_stock">
                <img src="<?= BASE_URL ?>/public/img/stock_tortas.jpg" alt="torta">
                <p>Tortas</p>
            </div>
        </a>

    </div>
</body>
</html>