<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/stock_css/stock.css">
</head>
<body>
    <?php include __DIR__ . '/../layouts/menu.php'; ?>
<main>
    <div class="stock_contenido_general">
        
        <a href="<?= BASE_URL ?>/produccion/crear?tipo=Pan">
            <div class="carta_stock">
                <img src="<?= BASE_URL ?>/public/img/stock_panes.svg" alt="pan">
                <p>Panes</p>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/produccion/crear?tipo=Bocadito">
            <div class="carta_stock">
                <img src="<?= BASE_URL ?>/public/img/stock_bocaditos.svg" alt="bocadito">
                <p>Bocaditos</p>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/produccion/crear?tipo=Torta">
            <div class="carta_stock">
                <img src="<?= BASE_URL ?>/public/img/stock_tortas.svg" alt="torta">
                <p>Tortas</p>
            </div>
        </a>

    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</main>
    <script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script> 
</body>
</html>