<?php
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <style>
        .two-fields {
            width: 100%;
        }

        .two-fields .input-group {
            width: 100%;
        }

        .two-fields input {
            width: 50% !important;
        }
    </style>
</head>

<body>
    <a href="../inicio_voucher.php">Volver</a>
    <br>
    <br>
  
    <?php

    $sql = "SELECT * FROM voucher_nuevos";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group two-fields"></div>
                    <label for="">Viaje No <?php echo $row['viaje_no'] ?></label>
                    <div class="input-group">
                        <label>Fecha
                            <input type="text" placeholder="<?php echo $row['completado'] ?>">
                        </label>
                        <label>Cuenta
                            <input type="text" placeholder="<?php echo $row['c_costo'] ?>">
                        </label>
                    </div>
                    <label>Nombre
                        <input type="text" value="<?php echo $row['nom_pasaj'] ?>">
                    </label>

                    <label>Origen
                        <input type="text" value="<?php echo $row['origen'] ?>">
                    </label>
                    <label for="">Destino
                        <input type="text" value="<?php echo $row['destino'] ?>">
                    </label>
                    <br>
                    <label for="">Peajes</label>
                    <input type="text" value="<?php echo $row['peaje'] ?>">
                    <label for="">Total</label>
                    <input type="text" value="<?php echo $row['total'] ?>">
                    <br>
                </div>

            </div>

        </div>
        <br><br><br>
    <?php
    }

    ?>
</body>

</html>