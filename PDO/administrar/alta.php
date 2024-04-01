<!--PRUEBA PDO-->
<?php
//require_once('d:\DAW 2\XAMPP\ARCHIVOS\htdocs\Pokemon\PDO\php_librarys\bd.php');
require_once('..\php_librarys\bd.php');

// Obtener tipos de la base de datos (asegúrate de tener la conexión y la consulta adecuadas)
$tipos = selectTiposPokemon();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de cromos</title>

    <!-- <link rel="stylesheet" href="../css/formulario.css"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body> <!-- style="background-color:rgb(244, 249, 253);" -->
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

    <div class="card mx-auto m-5" style="width:60%;">
        <div class="card-header">
            <h1> Nuevo Pokémon </h1>
        </div>
        <div class="card-body">
            <form id="miFormulario" class="mx-auto mt-5" style="max-width: 800px; background-color: white; " action="../phpControllers/cromosController.php" method="POST">

                <!-- nombre -->
                <div class="form-floating mb-3">
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="n">
                    <label for="floatingNombre">Nombre Pokémon</label>
                </div>
                <!-- tipo -->
                <div id="tipos" class="row g-3">
                    <div class="col-auto">

                        <select name="nombreTipo[]" id="tipo1" class="form-select mt-4" aria-label="Default select example">
                            <option value="default" selected disabled>Tipo 1</option>
                            <?php foreach ($tipos as $tipo) {
                                echo ' <option value="' . $tipo['id'] . '">' . $tipo['nombreTipo'] . '</option>';
                            }

                            ?>
                        </select> <br>
                    </div>
                    <div class="col-auto">

                        <select name="nombreTipo[]" id="tipo2" class="form-select mt-4" aria-label="Default select example">
                            <option value="default" selected disabled>Tipo 2</option>
                            <?php foreach ($tipos as $tipo) {
                                echo ' <option value="' . $tipo['id'] . '">' . $tipo['nombreTipo'] . '</option>';
                            }

                            ?>
                        </select> <br>
                    </div>
                </div>
                <!-- Región -->


                <select name="nombreRegion" id="nombreRegion" class="form-select mt-4" aria-label="Default select example">
                    <option value="default" selected disabled>Región</option>
                    <option value="kanto">Kanto</option>
                    <option value="johto">Johto</option>
                    <option value="hoenn">Hoenn</option>
                    <option value="sinnoh">Sinnoh</option>
                    <option value="unova">Unova</option>
                    <option value="kalos">Kalos</option>
                    <option value="alola">Alola</option>
                    <option value="galar">Galar</option>
                </select> <br>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <!-- Imagen  -->
                <div class="mb-5">
                    <label for="formFile" class="form-label">Seleccionar Imagen</label>
                    <input name="imagen" class="form-control" type="file" id="formFile">
                </div>
                <!-- botón -->
                <div style="float:right; margin-bottom:5%;"> <!-- para que me centre el botón -->
                    <button type="submit" name="insert" class="btn btn-light">Dar de alta</button>
                </div> <br><br>


            </form>
        </div>
    </div>


</body>

</html>