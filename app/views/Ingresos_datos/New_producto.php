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
            <button class="btn-nuevo" id="btn-abrir-modal">
                <i class="fa-solid fa-plus"></i> Nuevo Producto
            </button>
        </div>

        <!-- FILTROS -->
        <div class="filtros">
            <button class="btn-filtro activo" data-tipo="todos">Todos</button>
            <button class="btn-filtro" data-tipo="pan">Pan</button>
            <button class="btn-filtro" data-tipo="bocadito">Bocadito</button>
            <button class="btn-filtro" data-tipo="torta">Torta</button>
        </div>

                <!-- LISTA DE PRODUCTOS -->
        <div class="lista-productos" id="lista">

            <?php foreach ($productos as $p): ?>

                <?php 
                    // NORMALIZAMOS EL TIPO
                    $tipo = strtolower($p['tipo']); 
                ?>

                <div class="card-producto" data-tipo="<?= $tipo ?>">

                    <div class="card-icono">
                        <?php if ($tipo === 'pan'): ?>
                            <img src="<?= BASE_URL ?>/public/img/icon_pan.svg" class="icono-tipo">

                        <?php elseif ($tipo === 'bocadito'): ?>
                            <img src="<?= BASE_URL ?>/public/img/icon_bocaditos.svg" class="icono-tipo">

                        <?php elseif ($tipo === 'torta'): ?>
                            <img src="<?= BASE_URL ?>/public/img/icon_torta.svg" class="icono-tipo">
                        <?php endif; ?>
                    </div>

                    <div class="card-info">
                        <h3 class="card-nombre">
                            <?= htmlspecialchars($p['nombre_prod']) ?>
                        </h3>

                        <p class="card-tipo">
                            <?= ucfirst($tipo) ?>
                        </p>
                    </div>

                    <div class="card-acciones">
                        <a href="<?= BASE_URL ?>/producto/editar/<?= $p['id_producto'] ?>"
                        class="btn-editar-card"
                        data-id="<?= $p['id_producto'] ?>"
                        data-nombre="<?= htmlspecialchars($p['nombre_prod']) ?>"
                        data-tipo="<?= htmlspecialchars($p['tipo']) ?>">
                            <i class="fa-solid fa-pen"></i> Editar
                        </a>

                        <a href="<?= BASE_URL ?>/producto/eliminar/<?= $p['id_producto'] ?>"
                        class="btn-eliminar-card">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- MODAL NUEVO PRODUCTO -->
        <div class="modal-overlay" id="modal-overlay">
            <div class="modal">
                <div class="modal-header">
                    <h2>Nuevo Producto</h2>
                    <button class="modal-cerrar" id="btn-cerrar-modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="<?= BASE_URL ?>/producto/crear" method="POST" class="modal-form">
                    <div class="campo">
                        <label for="nombre">Nombre del producto</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ej: Pan de molde" required>
                    </div>
                    <div class="campo">
                        <label for="id_tipo">Tipo de producto</label>
                        <select id="id_tipo" name="id_tipo" required>
                            <option value="" disabled selected>Selecciona un tipo</option>
                            <option value="1">Pan</option>
                            <option value="2">Torta</option>
                            <option value="3">Bocadito</option>
                        </select>
                    </div>
                    <div class="modal-acciones">
                        <button type="button" class="btn-cancelar" id="btn-cancelar">Cancelar</button>
                        <button type="submit" class="btn-guardar">
                            <i class="fa-solid fa-floppy-disk"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDITAR PRODUCTO -->
        <div class="modal-overlay" id="modal-editar-overlay">
            <div class="modal">
                <div class="modal-header">
                    <h2>Editar Producto</h2>
                    <button class="modal-cerrar" id="btn-cerrar-editar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="form-editar" action="" method="POST" class="modal-form">
                    <div class="campo">
                        <label for="nombre-editar">Nombre del producto</label>
                        <input type="text" id="nombre-editar" name="nombre" placeholder="Ej: Pan de molde" required>
                    </div>
                    <div class="campo">
                        <label for="tipo-editar">Tipo de producto</label>
                        <select id="tipo-editar" name="id_tipo" required>
                            <option value="" disabled>Selecciona un tipo</option>
                            <option value="1">Pan</option>
                            <option value="2">Torta</option>
                            <option value="3">Bocadito</option>
                        </select>
                    </div>
                    <div class="modal-acciones">
                        <button type="button" class="btn-cancelar" id="btn-cancelar-editar">Cancelar</button>
                        <button type="submit" class="btn-guardar">
                            <i class="fa-solid fa-floppy-disk"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>
    <?php include __DIR__ . '/../layouts/footer.php'; ?>
    <script src="<?php echo BASE_URL; ?>/public/js/productos.js"></script>
</body>
</html>