<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
</head>
<body>
    <?php include '../components/menu.php'; ?>
    <?php include '../components/menu_historial.php'; ?>

    <div class="historial_contenido">
        
        <div class="fecha_historial">
            <input type="date" name="fecha_historial" id="fecha_historial">
        </div>

        <div class="produccion_historial">
            <select name="filtrar_producto" id="producto_filtrar">
                <option value="todos">Todos los productos</option>
                <option value="panes">Panes</option>
                <option value="bocaditos">Bocaditos</option>
                <option value="tortas">Tortas</option>
            </select>
        </div>
    </div>

</body>
</html>