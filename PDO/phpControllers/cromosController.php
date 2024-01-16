<?php 
require_once('../php_librarys/bd.php');

if(isset($_POST['insert'])){   
 insertCromos($_POST['nombre'], $_POST['descripcion'], $_POST['imagen'],$_POST['nombreTipo'], $_POST['nombreRegion']);// $_POST[ 'nombreRegion'], $_POST['nombreTipo']
 header('Location: ../index.php');
 exit();
} elseif (isset($_POST['delete'])){
    deleteCromo($_POST['id']);
    header('Location: ../index.php');
}
?>