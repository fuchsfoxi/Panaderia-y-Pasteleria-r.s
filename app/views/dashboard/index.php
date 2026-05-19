<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Panel de Administración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/renzo.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>

<body>

<?php include __DIR__ . '/../layouts/menu.php'; ?>

<main>

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <span>Inicio</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Dashboard</span>
    </nav>

    <!-- Título -->
    <div class="tittel_dashboard">
        <h1>PANADERIA Y PASTELERIA R.S</h1>
    </div>

    <!-- Cards de resumen (2×2) -->
    <div class="cards-grid">

        <div class="card-general">
            <h4 class="sub-texto">TOTAL DE PANES</h4>
            <div class="card-individual">
                <img src="<?php echo BASE_URL; ?>/public/img/icon_pan.svg" alt="Icono de Pan">
                <div class="card_content" id="content_panes"></div>
            </div>
        </div>

        <div class="card-general">
            <h4 class="sub-texto">TOTAL DE TORTAS</h4>
            <div class="card-individual">
                <img src="<?php echo BASE_URL; ?>/public/img/icon_torta.svg" alt="Icono de Torta">
                <div class="card_content" id="content_tortas"></div>
            </div>
        </div>

        <div class="card-general">
            <h4 class="sub-texto">TOTAL DE BOCADITOS</h4>
            <div class="card-individual">
                <img src="<?php echo BASE_URL; ?>/public/img/icon_bocadito.svg" alt="Icono de Bocadito">
                <div class="card_content" id="content_bocaditos"></div>
            </div>
        </div>

        <div class="card-general">
            <h4 class="sub-texto">ÚLTIMO TURNO REGISTRADO</h4>
            <div class="card-individual">
                <img src="<?php echo BASE_URL; ?>/public/img/icon_lista.svg" alt="Icono de Lista">
                <div class="card_content" id="content_turno"></div>
            </div>
        </div>

    </div><!-- /.cards-grid -->

    <!-- Gráfico -->
    <div class="grafico_seccion">

        <!-- Toggle Ayer / Hoy -->
        <div class="resumen_grafi">
            <div class="ayer_resumen">
                <div class="resumen_contenido" id="resumen_ayer"></div>
                <p>Ayer</p>
            </div>
            <div class="hoy_resumen">
                <div class="resumen_contenido" id="resumen_hoy"></div>
                <p>Hoy</p>
            </div>
        </div>

        <!-- Canvas del gráfico (Chart.js) -->
        <div class="grafico_contenido">
            <canvas id="grafico_barras"></canvas>
        </div>

    </div><!-- /.grafico_seccion -->

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>

</html>