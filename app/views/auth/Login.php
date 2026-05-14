<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title><?php echo TITLE_BUSINESS; ?></title>
</head>
<body>

   
    <?php if(isset($error) && $error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="" method="POST">

        <label for="user">Usuario</label>

        <input id="user" type="text" name="user" required>

        <label for="pass">Contraseña</label>

        <input id="pass" type="password" name="pass" required>

        <button type="submit">Enviar</button>

    </form>

</body>
</html>
