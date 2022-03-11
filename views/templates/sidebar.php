<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2>ApiTask</h2>

        <div class="cerrar-menu">
            <img id="cerrar-menu" src="build/img/cerrar.svg" alt="imagen cerrar menu">
        </div>
    </div>

        <?php if($_SESSION['rangoId'] == 3) { ?>
            <nav class="sidebar-nav">
                <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Proyectos</a>
                <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
            </nav>
        <?php } else if($_SESSION['rangoId'] == 2) { ?>
        <nav class="sidebar-nav">
            <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Proyectos</a>
            <a class="<?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyecto</a>
            <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
        </nav>
        <?php } else { ?>
            <nav class="sidebar-nav">
                <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Proyectos</a>
                <a class="<?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyecto</a>
                <a class="<?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
                <a class="<?php echo ($titulo === 'Administración') ? 'activo' : ''; ?>" href="/administracion">Administración</a>
            </nav>
        <?php } ?>

    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>
    </div>
</aside>