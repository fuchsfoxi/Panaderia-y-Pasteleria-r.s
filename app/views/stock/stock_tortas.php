<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Tortas</title>
</head>
<body>
<?php include '../components/menu.php'; ?>
<?php include '../components/menu_Ingres.php'; ?>

    <div class="ingreso_datos_tortas">
        <div class="stock_tortas">
            <input type="number" id="Canti_Tortas" placeholder="Cantidad de tortas" min="0" step="1">
        </div>

        <div class="stock_tortas">
            <select id="Producto_Tortas">
                <option value="Chocolate">Chocolate</option>
                <option value="Vainilla">Vainilla</option>
                <option value="Fresa">Fresa</option>
                <option value="Limón">Limón</option>
                <option value="Coco">Coco</option>
            </select>
        </div>

        <div class="boton_guardar_tortas">
            <button id="guardarStockTortas">Guardar</button>
        </div>

        <div class="Carta_guardado_tortas"> 

        </div>
    </div>
</body>
</html>