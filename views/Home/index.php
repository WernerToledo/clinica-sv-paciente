<?php require_once VIEW_LAYOUT_PATH . 'header.php' ?>
<?php $consultas = $viewData["datosConsulta"] ?? array(); ?>
<!-- INSERTAR CONTENIDO -->

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mb-2">
            <form class="d-flex" action="<?= URL ?>Home/cargarConsulta" method="post">
                <input class="form-control me-2" type="text" placeholder="Introduzca su DUI" name="dui">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="shadow-lg p-3 mb-5 bg-white rounded table table-striped table-bordered text-nowrap text-center" id="tabla-ejemplo">
            <thead class="thead-light">
                <tr>
                    <th>Nombre del paciente</th>
                    <th>Padecimientos</th>
                    <th>Alergias</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Medicamentos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta) : ?>
                    <tr>
                        <td><?= $consulta['nombre'] ?></td>
                        <td><?= $consulta['padecimientos'] ?></td>
                        <td><?= $consulta['alergias'] ?></td>
                        <td><?= $consulta['descripcion'] ?></td>
                        <td><?= date('d-m-Y', strtotime($consulta['fecha_consulta'])) ?></td>
                        <td>
                            <ul>
                                <?php foreach (json_decode($consulta['medicamento'], true) ?? array() as $medicamento) : ?>
                                    <li><?= $medicamento['medicamento'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- FIN CONTENIDO -->

<?php require_once VIEW_LAYOUT_PATH . "footer.php" ?>