<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LANDING</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/landing.css">
</head>
<body>
    <button class="boton_iniciar_Session">
            <span><a href="<?= BASE_URL ?>/login">Iniciar sesión</a></span>
    </button>

    <div class="img_landing">
        <img src="<?= BASE_URL ?>/public/img/imglanding.svg" alt="Imagen de panadería">
    </div>

    <div class="titulo_landing">
        <h1>BIENVENIDO A LA PANADERIA Y PASTELERIA R.S</h1>
    </div>


            <!-- From Uiverse.io by gharsh11032000 --> 
        <div class="carta_general_landing">
            <div class="card">
                <div class="content">
                <img src="<?= BASE_URL ?>/public/icons/iconslanding1.svg" alt="icono">
                    <h2>Registra tu producción diaria</h2>
                    <p class="para">
                        Ingresa panes, bocaditos y tortas de cada turno de forma rápida y sencilla.
                    </p>
                </div>
            </div>
        

        
            <div class="card">
                <div class="content">
                    <img src="<?= BASE_URL ?>/public/icons/iconslanding2.svg" alt="icono">
                    <h2>Consulta tu historial</h2>
                    <p class="para">
                        Revisa y gestiona todos los registros de producción en cualquier momento.
                    </p>
                </div>
            </div>


            <div class="card">
                <div class="content">
                    <img src="<?= BASE_URL ?>/public/icons/iconslanding2.svg" alt="icono">
                    <h2> Acceso seguro y confiable</h2>
                    <p class="para">
                        Solo el personal autorizado puede ingresar al sistema. Tus datos protegidos en todo momento.
                    </p>
                </div>
            </div>



        </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</body> 
</html>