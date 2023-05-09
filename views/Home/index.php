<?php require_once VIEW_LAYOUT_PATH . 'header.php' ?>
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
    <form action="<?= URL ?>Home/cargarConsultasFechas/" method="post">
        <?php if (count($viewData['fechas']) > 0) : ?>
            <div class="row">
                <div class="col-sm-11">
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="fecha">
                        <option selected>Seleccione la fecha de consulta</option>
                        <?php foreach ($viewData['fechas'] as $fecha) : ?>
                            <option value="<?= $fecha['fecha_consulta'] ?>"><?= $fecha['fecha_consulta'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?= $fecha["id_usuario"]?>">
                <div class="col-sm-1">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="sudmit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
        <?php else:?>
            <h5>No hay fechas de consulta</h5> 
        <?php endif; ?>
    </form>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nombre del paciente</th>
                <th>Padecimientos</th>
                <th>Alergias</th>
                <th>Motivo de consulta</th>
                <th>Fecha de la consulta</th>
                <th>Medicamentos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($viewData['fechas']) > 0) : ?>
                    <?php foreach ($viewData['fechas'] as $datos) : ?>
                        <tr>
                            <td><?= $datos['nombre']?></td>
                            <td><?= $datos['padecimientos']?></td>
                            <td><?= $datos['alergias']?></td>
                            <td><?= $datos['descripcion']?></td>
                            <td><?= $datos['fecha_consulta']?></td>
                            <td class = "text-center">
                                <a href="<?= URL ?>Home/vistaMedicamento/?id=<?= $datos["id_consulta"] ?>" title="Ver medicamentos" class="btn btn-info"> 
                                    <i class="fa-sharp fa-solid fa-pills"></i>
                                 </a>
                            </td>
                        </tr> 
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan = "6" class = "text-center">No hay datos</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- FIN CONTENIDO -->

<?php require_once VIEW_LAYOUT_PATH . "footer.php" ?>