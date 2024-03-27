<?php 
require_once('../php_librarys/bd.php');



// if(isset($_POST['insert'])){   
//  insertCromos($_POST['nombre'], $_POST['descripcion'], $_POST['imagen'],$_POST['nombreTipo'], $_POST['nombreRegion']);// $_POST[ 'nombreRegion'], $_POST['nombreTipo']
//  header('Location: ../index.php');
//  exit();
// } 

if(isset($_POST['insert'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
    $nombreRegion = $_POST['nombreRegion'];
    $tipos = $_POST['nombreTipo']; // Esto será un array de IDs de tipos
   // $tiposConcatenados = implode($tipos,",", $tipos);
    // Procesar la imagen aquí y moverla a la ubicación deseada en tu servidor
    
    // Llama a la función insertCromos con los datos recopilados
    insertCromos($nombre, $descripcion, $imagen, $nombreRegion, $tipos);
    header('Location: ../index.php');
    exit();
}









// if (isset($_POST['delete'])){
//     deleteCromo($_POST['id']);
//     header('Location: ../index.php');
//     exit();
// }
?>