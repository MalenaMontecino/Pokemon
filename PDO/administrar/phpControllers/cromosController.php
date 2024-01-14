<?php 
require_once('../php_librarys/bd.php');

if(isset($_POST['insert'])){
 insertCromos($_POST['id'],$_POST['nombre'], $_POST['descripcion'], $_POST['imagen']);
 header('Location: ../index.php');
 exit();
}
?>