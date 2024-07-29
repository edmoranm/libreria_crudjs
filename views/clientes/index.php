<?php include_once '../../includes/header.php' ?>
<div class="container">
    <h1 class="text-center">Formulario de Clientes</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="cli_id" id="cli_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="cli_nombre">Nombre del cliente</label>
                    <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="cli_apellido">Apellido del cliente</label>
                    <input type="text" name="cli_apellido" id="cli_apellido" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="cli_nit">Nit del cliente</label>
                    <input type="number" name="cli_nit" id="cli_nit" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="cli_telefono">Telefono del cliente</label>
                    <input type="number" name="cli_telefono" id="cli_telefono" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-secondary w-100">Cancelar</button>
                </div>
                <div class="col">
                    <button type="reset" id="btnLimpiar" class="btn btn-secondary w-100">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 table-responsive">
            <h2 class="text-center">Listado de clientes</h2>
            <table class="table table-bordered table-hover" id="tablaClientes">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>nit</th>
                        <th>telefono</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">No hay clientes disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="/libreria_crudjs/src/js/funciones.js"></script>
<script defer src="/libreria_crudjs/src/js/clientes/index.js"></script>
<?php include_once '../../includes/footer.php' ?>