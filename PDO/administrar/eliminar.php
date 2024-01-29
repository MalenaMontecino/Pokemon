<!--PRUEBA PDO-->
<?php
require_once('../php_librarys/bd.php');

$cromos = selectCromos();
?>

<!--PRUEBA PDO-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar cromos</title>

    <!-- <link rel="stylesheet" href="/css/css.css"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">

        <div class="container-fluid">
            <!--LOGO-->
            <a class="navbar-brand" href="http://localhost/Pokemon/PDO/index.php">
                <img src="\Pokemon\PDO\images\pokemon_logo.png" width="100" height="40">
            </a>
            <!--BUTTON DESPLEGABLE-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--SUB-ELECCIONES-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--HOME-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/Pokemon/PDO/index.php">Cromos existentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="alta.php">Dar de alta</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="eliminar.php">Administración</a>
                    </li>
                
                </ul>

            </div>

        </div>
    </nav>
    <!-- CARDS -->
    <div class="container mt-5 mb-5">
        <div class="row ">
            <?php foreach ($cromos as $cromo) { ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4"> <!-- responsive -->
                    <div class="card h-100">
                        <form action="../phpControllers/cromosController.php" method="POST">
                            <h5 id='nombrePokemon' style="background-color:rgb(221, 237, 250);" class="card-title text-center p-3">
                                <?php echo $cromo['nombre']; ?>
                            </h5>
                            <img src="../images/imgPokemon/<?php echo $cromo['imagen']; ?>" class="card-img-left img-fluid" alt="<?php echo $cromo['nombre']; ?>">
                            <div class="card-body">
                                <p class="card-text"><strong>ID:</strong>
                                    <?php echo $cromo['id']; ?>
                                </p>
                                <p class="card-text"><strong>Tipo:</strong>
                                    <?php echo $cromo['nombreTipo']; ?>
                                </p>
                                <p class="card-text">
                                    <?php echo $cromo['descripcion']; ?>
                                </p>
                                <p class="card-text"><strong>Región:</strong>
                                    <?php echo $cromo['nombreRegion']; ?>
                                </p>
                                <input type="hidden" name="id" value="<?php echo $cromo['id']; ?>">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
                                    <button type="submit" name="update" class="btn btn-primary  me-md-2">Modificar</button>
                                    <button type="submit" name="delete" class="btn btn-danger ">Eliminar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            <?php } ?>
        </div>
    </div>
    
</body>

</html>