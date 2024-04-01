<?php 
require_once('../php_librarys/bd.php');
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
if (isset($_POST['delete'])) {
    $pokemon_id = $_POST['pokemon_id'];
    deletePokemon($pokemon_id);
    header('Location: ../index.php');
    exit();
}
if (isset($_POST['update'])) {
   
    $pokemon_id = $_POST['pokemon_id'];
    updatePokemon($pokemon_id); 
   // header('Location: ../administrar/modificar.php');
    header('Location: ../index.php');
    exit();
}
if (isset($_POST['select'])) {
    $pokemon_id = $_POST['pokemon_id'];
    $pokemon = selectCromosPorId($pokemon_id);
    // Redirige a la página que muestra los datos, pasando el ID como parámetro GET
    header('Location: ../administrar/modificar.php?id=' . $pokemon_id);
    exit();
}

// if (isset($_POST['select'])) {
   
//     $pokemon_id = $_POST['pokemon_id'];
//     selectCromosPorId($pokemon_id); 
//     header('Location: ../administrar/modificar.php');
//    // header('Location: ../index.php');
//     exit();
// }
?>