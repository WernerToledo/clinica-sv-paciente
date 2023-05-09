<?php require_once VIEW_LAYOUT_PATH . 'header.php' ?>
<!--Inicio del contenido-->
 
    <table class="table table-light mt-4">
        <thead class="thead-light">
            <tr>
                <th>Medicamentos</th>
                <th>Toma</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($viewData['medicamentos']) > 0) : ?>
                    <?php foreach ($viewData['medicamentos'] as $datos) : ?>
                        <tr>
                            <td><?= $datos['medicamento']?></td>
                            <td><?= $datos['preescripcion']?></td>
                        </tr> 
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan = "6" class = "text-center">No hay datos</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
    <div class = "container">
        <p class = "text-center"><a href="<?= URL ?>Home/index/" class = "btn btn-danger">Regresar</a></p>
    </div>
<?php require_once VIEW_LAYOUT_PATH . "footer.php" ?>