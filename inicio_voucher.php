<?php
session_start();
include_once "./funciones/funciones.php";

$con = conexion();

$con->set_charset("utf8mb4");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCHER</title>
    <?php head(); ?>




</head>

<body>
    <style>
        form {
            padding: 5px 1px 1px;
            border: black 1px solid;
        }
    </style>


    <?php
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('Y-m-d');

    $semana = date('W');

    ?>
    <h1 class="text-center" style="margin: 5px ; ">IMPRESION DE VOUCHER</h1>


    <h5 style="text-align: center;"><?php echo $fechaActual . " " . "Semana: " . $semana ?></h5>
    <div class="row">


        <form method="post" id="addproduct" action="import_voucher.php" enctype="multipart/form-data" role="form">
            &nbsp; &nbsp;
            <input type="file" name="name" id="name" placeholder="Archivo (.xlsx)">
            &nbsp; &nbsp;
            <button type="submit">IMPORTAR</button>
            &nbsp;
        </form>
        &nbsp; &nbsp;



        <form method="post" action="impresion/imprimir_voucher.php">
            <h6>
                <button>IMPRIMIR</button>

            </h6>
        </form>


        &nbsp; &nbsp;&nbsp; &nbsp;
        <form>
            <a href="vacia_tabla_voucher.php" class="btn btn-success btn-sm">Limpiar tabla</a>
            &nbsp; &nbsp;
            <a href="../../menu.php" class="btn btn-success btn-sm">SALIR</a>
        </form>
    </div>

    <?php


    $sql = "SELECT * FROM voucher_nuevos WHERE cc= '78'";
    $datos = $con->query($sql);



    ?>
    <h5 style="text-align: center;"><?php echo $datos->num_rows; ?> Voucher importados</h5>


    <table class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">

            <th>id</th>
            <th>V No.</th>
            <th>Competado</th>
            <th>Nom Pasajero</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Movil</th>
            <th>CC</th>
            <th>Peaje</th>
            <th>Total</th>
           


        </thead>

        <?php

        while ($d = $datos->fetch_assoc()) {

        ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['viaje_no']; ?></td>
                <td><?php echo $d['completado']; ?></td>
                <td><?php echo $d['nom_pasaj']; ?></td>
                <td><?php echo $d['origen']; ?></td>
                <td><?php echo $d['destino']; ?></td>
                <td><?php echo $d['movil']; ?></td>
                <td><?php echo $d['cc']; ?></td>
                <td><?php echo $d['peaje']; ?></td>
                <td><?php echo $d['total'] ?></td>
             
            </tr>
        <?php
        }
        $sql_borra = "TRUNCATE TABLE vauchin";
        $result = $con->query($sql_borra);
        ?>

    </table>
    <script>
        // Selecciona el enlace por su ID
        var enlace = document.getElementById('miEnlace');

        // Añade un evento de clic al enlace
        enlace.addEventListener('click', function(event) {
            // Evita el comportamiento predeterminado del enlace (navegación)
            event.preventDefault();

            // Muestra un mensaje de alerta
            alert('¡Va a borrar todos los vouher!.....');
        });
    </script>
    <br><br>
    <?php foot(); ?>
</body>

</html>