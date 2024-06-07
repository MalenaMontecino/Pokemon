<?php
require_once('../php_librarys/bd.php');

// Obtener tipos de la base de datos
$tiposDB = selectTiposPokemon();

$pokemon_id = $_GET['id']; //url
$pokemons = selectCromosPorId($pokemon_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/Pokemon/PDO/index.php">
                <img src="\Pokemon\PDO\images\pokemon_logo.png" width="100" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="http://localhost/Pokemon/PDO/index.php">Cromos existentes</a></li>
                    <li class="nav-item"><a class="nav-link" href="alta.php">Dar de alta</a></li>
                    <li class="nav-item"><a class="nav-link" href="eliminar.php">Administración</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card mx-auto m-5" style="width:60%;">
        <div class="card-header"><h1>Modificar Pokémon</h1></div>
        <div class="card-body">
            <form id="miFormulario" class="mx-auto mt-5" style="max-width: 800px; background-color: white;" action="../phpControllers/cromosController.php" method="POST" enctype="multipart/form-data">
                <?php
                $pokemonAgrupados = array();
                foreach ($pokemons as $pokemon) {
                    $pokemonId = $pokemon['id'];
                    if (!isset($pokemonAgrupados[$pokemonId])) {
                        $pokemonAgrupados[$pokemonId] = array();
                    }
                    $pokemonAgrupados[$pokemonId][] = $pokemon;
                }

                foreach ($pokemonAgrupados as $grupo) {
                    $tipos = array();
                    foreach ($grupo as $cromo) {
                        $tipos[] = $cromo['nombreTipo'];
                    }
                ?>
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="n" value="<?php echo $grupo[0]['nombre'] ?>">
                        <label for="floatingNombre">Nombre Pokémon</label>
                    </div>

                    <div id="tipos" class="row g-3">
                        <div class="col-auto">
                            <select name="nombreTipo[]" id="tipo1" class="form-select mt-4">
                                <option value="default" selected><?php echo $tipos[0]; ?></option>
                                <?php foreach ($tiposDB as $tipoDB) {
                                    echo '<option value="' . $tipoDB['id'] . '">' . $tipoDB['nombreTipo'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select name="nombreTipo[]" id="tipo2" class="form-select mt-4">
                                <option value="default" selected>
                                    <?php 
                                    //comprobar si tiene 2o tipo
                                    if (isset($tipos[1]) && $tipos[1] !== null) {
                                        echo $tipos[1];
                                    } else {
                                        echo 'Tipo 2';
                                    }
                                    ?>
                                </option>
                                <?php foreach ($tiposDB as $tipoDB) {
                                    echo '<option value="' . $tipoDB['id'] . '">' . $tipoDB['nombreTipo'] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <select name="nombreRegion" id="nombreRegion" class="form-select mt-4">
                        <option value="default" selected><?php echo $grupo[0]['nombreRegion'] ?></option>
                        <option value="kanto">Kanto</option>
                        <option value="johto">Johto</option>
                        <option value="hoenn">Hoenn</option>
                        <option value="sinnoh">Sinnoh</option>
                        <option value="unova">Unova</option>
                        <option value="kalos">Kalos</option>
                        <option value="alola">Alola</option>
                        <option value="galar">Galar</option>
                    </select>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"><?php echo $grupo[0]['descripcion'] ?></textarea>
                    </div>

                    <div class="mb-5">
                        <label for="formFile" class="form-label">Seleccionar Imagen</label>
                        <input name="imagen" class="form-control" type="file" id="formFile">
                    </div>

                    <div style="float:right; margin-bottom:5%;">
                        <input type="hidden" name="pokemon_id" value="<?php echo $pokemon_id; ?>">
                        <button type="submit" name="update" class="btn btn-light me-md-2">Modificar</button>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</body>

</html>
