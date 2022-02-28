<?php include_once __DIR__ . '/header-dashboard.php' ; ?>

    <?php  if(count($proyectos) === 0 && $usuario->permiso === "1") { ?>
        <p class="no-proyectos">No Hay Proyectos aún <a href="/crear-proyecto">Comienza creando uno</a></p>
    <?php } else { ?>
        <ul class="listado-proyectos">
            <?php foreach($proyectos as $proyecto) { ?>
                <li class="proyecto">
                    <a href="/proyecto?id=<?php echo $proyecto->url; ?>">
                        <?php echo $proyecto->proyecto; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php }?>

    <?php  if(count($proyectos) === 0 && $usuario->permiso === "0") { ?>
        <p class="no-proyectos">No Hay Proyectos aún </p>
    <?php }?>

<?php include_once __DIR__ . '/footer-dashboard.php' ; ?>