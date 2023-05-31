<?php

$consulta = $viewData['consulta']['datos'];

$json = $consulta['medicamento'] == "" ? "[]" : $consulta['medicamento'];

// Decodificar la cadena JSON y convertirla en un array en PHP
$medicamentos = json_decode($json, true);

$li = '';

foreach ($medicamentos as $medicamento) {
    $li .= '<li>' . $medicamento['medicamento'] . '</li>';
}

require_once 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

// Crea una instancia de Html2Pdf
$html2pdf = new Html2Pdf();

// Genera el código HTML que deseas convertir a PDF
$html = '<html>
            <body>
                <style>

                    .font-size{
                        font-size:16px;
                    }

                    .padding-left{
                        padding-left:20px;
                    }

                    .padding-top{
                        padding-top:30px;
                    }
                </style>
                <table style="width:100%;margin:auto; padding-left:50px;padding-right:50px;">
                    <tbody >
                        <tr>
                            <td colspan="2">
                                <img src="' . URL . 'public/img/logo.png" style="width:80px;height:80px;" >
                            </td>
                            <td colspan="10">
                                <h3>
                                    UNIVERSIDAD CATÓLICA DE EL SALVADOR
                                </h3>
                                <h4>
                                    CLINICA - SV
                                </h4>
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" class="padding-top" >
                                <b>Nombre:</b>  ' . $consulta['nombre'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>DUI:</b> ' . $consulta['dui'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>Carnet:</b> ' . $consulta['carnet'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>Doctor:</b> ' . $consulta['doctor'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>Fecha consulta:</b> ' . $consulta['fecha_consulta'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>Padecimiento:</b> ' . $consulta['padecimientos'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>Alergias:</b>' . $consulta['alergias'] . '
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="6" style="padding-top:15px;" >
                                <b>Medicamentos:</b>
                                <ul>' . $li . '</ul>
                            </td>
                        </tr>
                        <tr class="font-size" >
                            <td colspan="12" style="padding-top:15px;" >
                                <b>Descripción:</b> ' . $consulta['descripcion'] . '
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
         </html>';

// Convierte el HTML a PDF
$html2pdf->writeHTML($html);
$html2pdf->output('CONSULTA_' . $consulta['fecha_consulta'] . '-' . $consulta['nombre'] . '.pdf');
