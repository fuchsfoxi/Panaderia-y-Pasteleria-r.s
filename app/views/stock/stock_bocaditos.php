<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Bocaditos</title>
</head>
<body>
<?php include __DIR__ . '/../../layouts/menu.php'; ?>

    <?php if (isset($_GET['error'])): ?>
        <p style="color:red">Debe ingresar una cantidad.</p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/produccion/crear" method="POST">

        <div class="stock_bocaditos">
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" min="1" required>
        </div>

        <div class="stock_bocaditos">
            <label for="id_producto">Bocadito</label>
            <select id="id_producto" name="id_producto" required>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto['id_producto'] ?>">
                        <?= $producto['nombre_prod'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="stock_bocaditos">
            <label for="id_turno">Turno</label>
            <select id="id_turno" name="id_turno" required>
                <?php foreach ($turnos as $turno): ?>
                    <option value="<?= $turno['id_turno'] ?>">
                        <?= $turno['nombre_turno'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Guardar</button>
    </form>
<?php include __DIR__ . '/../../layouts/footer.php'; ?>
</body>
</html>