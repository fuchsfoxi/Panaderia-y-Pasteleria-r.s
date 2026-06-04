<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/historial.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <?php include __DIR__ . '/../layouts/menu.php'; ?>
<main>
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
                <div class="carta_historial_header">
                        <span class="carta_historial_nombre">
                            <?php if ($item['tipo'] === 'Pan'): ?>
                                <i class="fa-solid fa-bread-slice"></i>
                            <?php elseif ($item['tipo'] === 'Bocadito'): ?>
                                <i class="fa-solid fa-cookie"></i>
                            <?php elseif ($item['tipo'] === 'Torta'): ?>
                                <i class="fa-solid fa-cake-candles"></i>
                            <?php else: ?>
                                <i class="fa-solid fa-box"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($item['nombre_prod']) ?>
                        </span>
                        <!-- ← BORRA LA LÍNEA SUELTA QUE ESTABA AQUÍ -->
                        <span class="carta_historial_fecha">
                            <i class="fa-regular fa-calendar"></i>
                            <?= $item['fecha'] ?? '' ?>
                        </span>
                    </div>
                <div class="carta_historial_footer">
                    <div class="carta_historial_info">
                        <span>Latas: <?= $item['cantidad_prod'] ?></span>
                    </div>
                    <span class="carta_historial_info"><?= htmlspecialchars($item['nombre_turno']) ?></span>
                    <div class="carta_historial_acciones">
                        <button class="btn-editar btn-editar-modal"
                            data-id="<?= $item['id_produccion'] ?>"
                            data-cantidad="<?= $item['cantidad_prod'] ?>"
                            data-turno="<?= $item['id_turno'] ?>"
                            data-producto="<?= $item['id_producto'] ?>"
                            data-fecha="<?= $item['fecha_raw'] ?? '' ?>">
                            <i class="fa-solid fa-pen"></i> Editar
                        </button>
                        <a href="<?= BASE_URL ?>/produccion/eliminar/<?= $item['id_produccion'] ?>" class="btn-eliminar">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>

    <!-- Modal editar -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <h2>Editar registro</h2>
                <button class="modal-cerrar" id="modalCerrar">&times;</button>
            </div>
            <form method="POST" id="modalForm">
                <div class="modal-campo">
                    <label>Producto</label>
                    <select name="id_producto" id="modal_producto">
                        <?php foreach ($productos as $p): ?>
                            <option value="<?= $p['id_producto'] ?>"><?= htmlspecialchars($p['nombre_prod']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-campo">
                    <label>Cantidad</label>
                    <input type="number" name="cantidad" id="modal_cantidad" required>
                </div>
                <div class="modal-campo">
                    <label>Turno</label>
                    <select name="id_turno" id="modal_turno">
                        <?php foreach ($turnos as $t): ?>
                            <option value="<?= $t['id_turno'] ?>"><?= htmlspecialchars($t['nombre_turno']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-campo">
                    <label>Fecha</label>
                    <input type="date" name="hora_agotada" id="modal_fecha">
                </div>
                <button type="submit" class="modal-guardar">Guardar</button>
            </form>
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/historial.js"></script>
</body>
</html>