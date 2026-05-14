<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <?php include __DIR__ . '/../layouts/menu.php'; ?>
    
    <div class = "encabezado">
        <h1>PANADERIA Y PASTELERIA R.S</h1>
    </div>

    <div class = "cartas">
        <ul>
            <li>        
                <div class = "contenido_carta">
                    <p>Total de Panes</p>2
                    <div class="numero_total" id="totalPanes"></div>
                </div>
            </li>

            <li>
                <div class = "contenido_carta">
                    <p>Total de Pasteles</p>
                    <div class="numero_total" id="totalPasteles"></div>
                </div>
            </li>

            <li>
                <div class="contenido_carta">
                    <p>Total de Bocaditos</p>
                    <div class="numero_total" id="totalBocaditos"></div>
                </div>
            </li>
        </ul>
    </div>

    <div class="color_expl">
        <ul>
            <li class="color_ayer">
                <p>Ayer</p>
            </li>

            <li class="color_hoy">
                <p>Hoy</p>
            </li>
        </ul>
    </div>

    <div class="grafica">
        <canvas id="grafica_comparativa"></canvas>
    </div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>