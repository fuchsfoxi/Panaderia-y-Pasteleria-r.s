<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Bocaditos</title>
</head>
<body>

<?php include '../components/menu.php'; ?>
<?php include '../components/menu_Ingres.php'; ?>
    
    <div class="ingreso_datos_bocaditos">
        <div class="stock_bocaditos">
            <input type="number" id="Canti_Bocaditos" placeholder="Cantidad de bocaditos" min="0" step="1">
        </div>

        <div class="stock_bocaditos">
            <input type="number" id="Canti_Latas_Bocaditos" placeholder="Cantidad de  bocaditos" min="0" step="1">
        </div>

        <div class="stock_bocaditos">
            <select id="Producto_Bocaditos">
                <option value="Cono">Cono</option>
                <option value="Cono chico">Cono chico</option>
                <option value="Oreja">Oreja</option>
                <option value="Orejita">Orejita</option>
                <option value="pionono">pionono</option>
            </select>
        </div>

        <div class="boton_guardar_bocaditos">
            <button id="guardarStockBocaditos">Guardar</button>
        </div>

        <div class="Carta_guardado_bocaditos"> </div>
    </div>
</body>
</html>