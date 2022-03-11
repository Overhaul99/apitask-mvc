<!-- Modal eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>¿Estas Seguro de Eliminar al Usuario?</h4>
                    <!-- Formulario -->
                    <form action="/administracion/eliminar" method="post">
                        <input type="hidden" name="id" id="delete_id">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger text-uppercase" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-outline-success text-uppercase">Si Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>