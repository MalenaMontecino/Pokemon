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
    echo "ID del Pokémon a eliminar: " . $pokemon_id; // Añade esta línea
    deletePokemon($pokemon_id);
    header('Location: ../index.php');
    exit();
}

?>