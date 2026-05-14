<?php 
    $rutaActual = explode('/', trim($_GET['url'] ?? 'dashboard', '/'))[0] ?: 'dashboard';
?>

<div class="topbar">
    <div class="title-business">
        <span><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></span>
    </div>
    <div class="btn-menu">
        <button class="hamburger" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<div class="overlay"></div>

<aside class="sidebar">
    <div class="sidebar-logo"><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></div>
    <ul>
        <li>
            <a href="<?php echo BASE_URL; ?>/home" class="<?php echo $rutaActual === 'home' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>/stock" class="<?php echo $rutaActual === 'stock' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Stock</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>/historial" class="<?php echo $rutaActual === 'historial' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Historial</span>  
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>/producto" class="<?php echo $rutaActual === 'producto' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-bread-slice"></i>
                <span>Productos</span>
            </a>
        </li>
        <li class="nav-logout">
            <a href="<?php echo BASE_URL; ?>/logout" id="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesión</span>
            </a>
        </li>
    </ul>
</aside>
<script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script>