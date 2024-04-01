<?php 
require_once('../php_librarys/bd.php');
//Alta
if(isset($_POST['insert'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $nombreRegion = $_POST['nombreRegion'];
    $tipos = $_POST['nombreTipo']; 
   
    insertCromos($nombre, $descripcion, $imagen, $nombreRegion, $tipos);
    header('Location: ../index.php');
    exit();
}

//Eliminar
if (isset($_POST['delete'])) {
    $pokemon_id = $_POST['pokemon_id'];
    deletePokemon($pokemon_id);
    header('Location: ../index.php');
    exit();
}

//Modificar
if (isset($_POST['update'])) {
   
    $pokemon_id = $_POST['pokemon_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $nombreRegion = $_POST['nombreRegion'];
    $tipos = $_POST['nombreTipo']; 

    updatePokemon($pokemon_id,$nombre, $descripcion, $imagen, $nombreRegion, $tipos); 
    header('Location: ../index.php');
    exit();
}

//Sacar datos para modificar
if (isset($_POST['select'])) {
    $pokemon_id = $_POST['pokemon_id'];
    $pokemon = selectCromosPorId($pokemon_id);
    header('Location: ../administrar/modificar.php?id=' . $pokemon_id);
    exit();
}

?>