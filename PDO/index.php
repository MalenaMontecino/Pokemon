<!--PRUEBA PDO-->
<?php
require_once('./php_librarys/bd.php');

$ciudades = selectCiudades();
?>

<!--PRUEBA PDO-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cromos</title>

    <!-- <link rel="stylesheet" href="./css/css.css"> -->

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
            <a class="navbar-brand" href="#">LOGO</a>
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
                        <a class="nav-link active" aria-current="page" href="#">Cromos existentes</a>
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
                            <li><a class="dropdown-item" href="./administrar/modificar.php">Modificar datos</a></li>
                            <li><a class="dropdown-item" href="./administrar/alta.php">Dar de alta</a></li>
                            <li><a class="dropdown-item" href="./administrar/eliminar.php">Eliminar </a></li>
                        </ul>
                    </li>

                </ul>
                <!--BUSCAR-->
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>

            </div>

        </div>
    </nav>




    <!--PRUEBA PDO-->


    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>Identificador</th>
                <th>Nombre</th>

            </tr>
            <?php foreach ($ciudades as $ciudad) { ?>
                <tr>
                    <td>
                        <?php echo $ciudad['id_ciudad'] ?>
                    </td>
                    <td>
                        <?php echo $ciudad['nombre'] ?>
                    </td>

                </tr>

            <?php } ?>


        </table>

    </div>

    <!--PRUEBA PDO-->


    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>