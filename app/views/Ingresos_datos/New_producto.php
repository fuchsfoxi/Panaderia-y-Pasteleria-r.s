<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/producto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../layouts/menu.php'; ?>
    <main>

        <!-- BOTÓN NUEVO PRODUCTO -->
        <div class="top-bar">
            <a href="<?= BASE_URL ?>/producto/crear" class="btn-nuevo">
                <i class="fa-solid fa-plus"></i> Nuevo Producto
            </a>
        </div>

        <!-- FILTROS -->
        <div class="filtros">
            <button class="btn-filtro activo" data-tipo="todos">PAN</button>
            <button class="btn-filtro" data-tipo="bocadito">Bocadito</button>
            <button class="btn-filtro" data-tipo="torta">Torta</button>
        </div>

        <!-- LISTA DE PRODUCTOS -->
        <div class="lista-productos" id="lista">
            <?php foreach ($productos as $p): ?>

            <div class="card-producto" data-tipo="<?= strtolower($p['tipo']) ?>">

                <!-- ÍCONO SEGÚN TIPO -->
                <div class="card-icono">
                    <?php if ($p['tipo'] === 'Pan'): ?>
                        <img src="<?= BASE_URL ?>/public/img/icon_pan.svg" alt="Icono de pan" class="icono-pan">
                    <?php elseif ($p['tipo'] === 'Bocadito'): ?>
                        <img src="<?= BASE_URL ?>/public/img/icon_bocaditos.svg" alt="Icono de bocadito" class="icono-bocadito">
                    <?php elseif ($p['tipo'] === 'Torta'): ?>
                        <img src="<?= BASE_URL ?>/public/img/icon_torta.svg" alt="Icono de torta" class="icono-torta">
                    <?php endif; ?>
                </div>

                <!-- NOMBRE Y TIPO -->
                <div class="card-info">
                    <h3 class="card-nombre"><?= htmlspecialchars($p['nombre_prod']) ?></h3>
                    <p class="card-tipo"><?= htmlspecialchars($p['tipo']) ?></p>
                </div>

                <!-- ACCIONES -->
                <div class="card-acciones">
                    <a href="<?= BASE_URL ?>/producto/editar/<?= $p['id_producto'] ?>" class="btn-editar-card">
                        <i class="fa-solid fa-pen"></i> Editar
                    </a>
                    <a href="<?= BASE_URL ?>/producto/eliminar/<?= $p['id_producto'] ?>" class="btn-eliminar-card">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </a>
                </div>

            </div><!-- fin .card-producto -->

            <?php endforeach; ?>
        </div><!-- fin .lista-productos -->

    </main>
    <?php include __DIR__ . '/../layouts/footer.php'; ?>
    <script src="<?php echo BASE_URL; ?>/public/js/productos.js"></script>
</body>
</html>