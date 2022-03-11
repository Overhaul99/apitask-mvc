<?php
$bootstrap = '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
';
?>

<?php include_once __DIR__ . './../dashboard/header-dashboard.php' ; ?>

    <div class="contenedor-tabla">
        
    <?php include_once __DIR__ . './../templates/alertas.php' ?>
        
        <div class="table-container">
            <table class="table-rwd">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Area</th>
                        <th>Rango</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Registros de la base de datos -->
                    <?php foreach($usuarios as $usuario) { ?>
                        <tr>
                            <td><?php echo $usuario->id; ?></td>
                            <td><?php echo $usuario->nombre; ?></td>
                            <td><?php echo $usuario->email; ?></td>
                            <td><?php echo $usuario->area = '1' ? 'GAF' : ''; ?></td>
                            <td><?php echo $usuario->rangoId; ?></td>
                            <td>
                                <button type="button" class="editar-usuario editbtn" data-bs-toggle="modal" data-bs-target="#editar">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button type="button" class="eliminar-usuario deletebtn" data-bs-toggle="modal" data-bs-target="#eliminar">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once __DIR__ . './editar.php' ; ?>
    <?php include_once __DIR__ . './eliminar.php' ; ?>

<?php include_once __DIR__ . './../dashboard/footer-dashboard.php' ; ?>

<?php
$script .= '
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="build/js/usuarios.js"></script>

';
?>
