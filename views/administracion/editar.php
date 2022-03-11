<!-- Modal editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <form action="/administracion" method="post">
                        <input type="hidden" name="id" id="update_id">
                        <div class="form-group">
                            <input type="hidden" name="nombre" class="form-control" id="nombre">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sexo">Área</label>
                            <select name="area" id="area" class="form-select">
                                <option value="1">GAF</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rangoId" class="form-label">Rango</label>
                            <select name="rangoId" id="rangoId" class="form-select">
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger text-uppercase" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-outline-success text-uppercase">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>