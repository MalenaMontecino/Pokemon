<?php 
require_once('../php_librarys/bd.php');

if(isset($_POST['insert'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];
    $nombreRegion = $_POST['nombreRegion'];
    $tipos = $_POST['nombreTipo']; 
   
    move_uploaded_file($_FILES['imagen']['tmp_name'], "../images/imgPokemon/" . $imagen);
    insertCromos($nombre, $descripcion, $imagen, $nombreRegion, $tipos);
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['delete'])) {
    $pokemon_id = $_POST['pokemon_id'];
    deletePokemon($pokemon_id);
    header('Location: ../index.php');
    exit();
}if (isset($_POST['update'])) {
    $pokemon_id = $_POST['pokemon_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen']['name'];
    $nombreRegion = $_POST['nombreRegion'];
    $tipos = $_POST['nombreTipo'];
  //  error_log(print_r('Controller'+$pokemon_id, $nombre, $descripcion, $imagen, $nombreRegion, $tipos));
    if($imagen) {
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../images/imgPokemon/" . $imagen);
    } else {
        $imagen = selectCromosPorId($pokemon_id)[0]['imagen'];
    }

    // Obtener los tipos existentes del Pokémon si no se proporcionan nuevos tipos
    if (empty($tipos) || (count($tipos) === 1 && $tipos[0] === 'default')) {
        $pokemonExistente = selectCromosPorId($pokemon_id);
        $tipos = array_column($pokemonExistente, 'nombreTipo');
    }

    // Actualizar el Pokémon
    updatePokemon($pokemon_id, $nombre, $descripcion, $imagen, $nombreRegion, $tipos);

    header('Location: ../index.php');
    exit();
}


if (isset($_POST['select'])) {
    $pokemon_id = $_POST['pokemon_id'];
    $pokemon = selectCromosPorId($pokemon_id);
    header('Location: ../administrar/modificar.php?id=' . $pokemon_id);
    exit();
}
?>