<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/Login.css">
    <title><?= TITLE_BUSINESS ?></title>
</head>
<body>

    <video class="video_fondo" autoplay muted loop playsinline>
        <source src="<?= BASE_URL ?>/public/videos/fondo_animado.webm" type="video/webm">
    </video>
        <div class="container">
            <form class="form" action="" method="POST">
                <div class="form_front">
                    <div class="form_details">INICIAR SESIÓN</div>
                    <p class="form_sub">Ingresa tus datos para continuar</p>

                    <?php if(isset($error) && $error): ?>
                        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <input type="text" class="input" placeholder="Usuario" name="user" autocomplete="username" required>
                    <input type="password" class="input" placeholder="Contraseña" name="password" autocomplete="current-password" required>
                    <button class="btn" type="submit">Iniciar sesión</button>
                </div>
            </form>
        </div>

</body>
</html>