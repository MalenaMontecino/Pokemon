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
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #e3f2fd;">

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

    <div>
    <!-- errores francisco -->
         <?php require_once('../php_partials/mensajes.php');?> 
    <!-- CARDS -->
    <div class="container mt-5 mb-5">
        <div class="row" style="margin-top:120px;">
            <?php
            // Creamos un array para almacenar temporariamente los Pokémon agrupados por ID
            $pokemonAgrupados = array();

            // Iteramos sobre los Pokémon y los agrupamos por ID
            foreach ($cromos as $cromo) {
                $pokemonId = $cromo['id'];
                if (!isset($pokemonAgrupados[$pokemonId])) {
                    $pokemonAgrupados[$pokemonId] = array();
                }
                $pokemonAgrupados[$pokemonId][] = $cromo;
            }

            // Iteramos sobre los Pokémon agrupados
            foreach ($pokemonAgrupados as $grupo) { ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4"> <!-- responsive -->
                    <div class="card h-100">

                        <form action="../phpControllers/cromosController.php" method="POST">
                            <h5 id='nombrePokemon' style="background-color:rgb(221, 237, 250);" class="card-title text-center p-3">
                                <?php echo $grupo[0]['nombre']; ?>
                            </h5>
                            <img src="../images/imgPokemon/<?php echo $grupo[0]['imagen']; ?>" class="card-img-left img-fluid" alt="<?php echo $grupo[0]['nombre']; ?>">
                            <div class="card-body" style="margin-bottom:22%;">
                                <p class="card-text"><strong>ID:</strong>
                                    <?php echo $grupo[0]['id']; ?>
                                </p>
                                <p class="card-text"><strong>Tipo:</strong>
                                    <?php
                                    // Concatenamos todos los tipos de todos los Pokémon en el grupo
                                    $tipos = array();
                                    foreach ($grupo as $cromo) {
                                        $tipos[] = $cromo['nombreTipo'];
                                    }
                                    echo implode(', ', $tipos);
                                    ?>
                                </p>
                                <p class="card-text">
                                    <?php echo $grupo[0]['descripcion']; ?>
                                </p>
                                <p class="card-text"><strong>Región:</strong>
                                    <?php echo $grupo[0]['nombreRegion']; ?>
                                </p>

                            </div>

                            <div class="position-absolute bottom-0 end-0">
                                <div class="card-footer"style="width:138%; margin-left:-38%; ">

                                    <div style="margin-left:30%; ">
                                        <input type="hidden" name="pokemon_id" value="<?php echo $grupo[0]['id']; ?>">
                                        <button type="submit" name="select" class="btn btn-primary  me-md-2">Modificar</button>
                                        <button type="submit" name="delete" class="btn btn-danger " onclick="return confirm('¿Estás seguro de que deseas eliminar este Pokémon [<?php echo $grupo[0]['id']; ?>]?')">Eliminar</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
                                </div>
</body>

</html>