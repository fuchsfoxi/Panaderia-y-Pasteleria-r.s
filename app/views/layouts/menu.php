<?php 
    $rutaActual = explode('/', trim($_GET['url'] ?? 'dashboard', '/'))[0] ?: 'dashboard';
?>

<div class="topbar">
    <div class="title-business">
        <span><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></span>
    </div>
    <div class="btn-menu">
        <button class="hamburger" aria-label="Abrir menú" <?php echo $rutaActual === 'dashboard' ? 'disabled' : ''; ?>>
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<div class="overlay"></div>

<aside class="sidebar">
    <div class="sidebar-logo"><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></div>
    <ul>
        <li>
            <a href="<?php echo BASE_URL; ?>/home" class="<?php echo $rutaActual === 'dashboard' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li class="dropdown">
            <a href="<?php echo BASE_URL; ?>/stock" class="<?php echo $rutaActual === 'stock' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Stock</span>
            </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo BASE_URL;?>/app/views/stock/Stock_panes.php">Panes</a></li>
                    <li><a href="<?php echo BASE_URL;?>/app/views/stock/stock_bocaditos.php">Bocaditos</a></li>
                    <li><a href="<?php echo BASE_URL;?>/app/views/stock/stock_tortas.php">Tortas</a></li>
                </ul>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>/historial" class="<?php echo $rutaActual === 'historial' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Historial</span>  
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