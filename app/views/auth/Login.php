<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/Login.css">
    <title><?= TITLE_BUSINESS ?></title>
</head>
<body>

<div class="container">
    <form class="form" action="" method="POST">
        <div class="form_front">
            <div class="form_details">Login</div>

            <?php if(isset($error) && $error): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <input type="text" class="input" placeholder="Usuario" name="user" required>
            <input type="password" class="input" placeholder="Contraseña" name="password" required>
            <button class="btn" type="submit">Iniciar sesión</button>
        </div>
    </form>
</div>

</body>
</html>