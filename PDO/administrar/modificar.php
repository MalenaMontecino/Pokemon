<!--PRUEBA PDO-->
<?php
require_once('C:\xampp\htdocs\Pokemon\PDO\php_librarys\bd.php');

$cromos = selectCromos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cromos</title>

    <link rel="stylesheet" href="Pokemon/PDO/css/css.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">

        <div class="container-fluid">
            <!--LOGO-->
            <a class="navbar-brand" href="http://localhost/Pokemon/PDO/index.php">LOGO</a>
            <!--BUTTON DESPLEGABLE-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--SUB-ELECCIONES-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--HOME-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/Pokemon/PDO/index.php">Cromos existentes</a>
                    </li>
                    <!--LINK
            <li class="nav-item">
                <a class="nav-link" href="#">Dar de alta</a>
            </li>-->

                    <!--SELECT-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="modificar.php">Modificar datos</a></li>
                            <li><a class="dropdown-item" href="alta.php">Dar de alta</a></li>
                            <li><a class="dropdown-item" href="eliminar.php">Eliminar </a></li>
                        </ul>
                    </li>

                </ul>
              

            </div>

        </div>
    </nav>


    
    <!--PRUEBA PDO-->


    <div class="container mt-5">
        <table class="table table-striped">
            <tr>
                <th>Identificador</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Región</th>
                <th>Imagen</th>

            </tr>
            <?php foreach ($cromos as $cromo) { ?>
                <tr>
                    <td>
                        <?php echo $cromo['id'] ?>
                    </td>
                    <td>
                        <?php echo $cromo['nombre'] ?>
                    </td>
                    <td>
                        <?php echo $cromo['nombreTipo'] ?>
                    </td>
                    <td>
                        <?php echo $cromo['descripcion'] ?>
                    </td>
                    <td>
                        <?php echo $cromo['nombreRegion'] ?>
                    </td>
                    <td>
                        <?php echo $cromo['imagen'] ?>
                    </td>



                </tr>

            <?php } ?>


        </table>

    </div>

    <!--PRUEBA PDO-->

</body>

</html>