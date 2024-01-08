<?php
// function openBd(){
//     $servername = "localhost";
//     $username = "root";
//     $password = "mysql";


//     $conexion = new PDO("mysql:host=$servername;dbname=hoteles_dwes", $username, $password);
//     // set the PDO error mode to exception
//     $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $conexion->exec('set names utf8');

//     return $conexion;
// }


// function closeBd(){
//     return null;
// }

// function selectCiudades(){
//     $conexion = openBd();

//     $sentenciaText = " select * from ciudades";

//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->execute();

//     $resultado = $sentencia->fetchAll();

//     $conexion = closeBd();

//     return $resultado;
// }

// function insertCiudad($id_ciudad,$nombre){
//     $conexion = openBd();
//     $sentenciaText = " insert into ciudades (id_ciudad, nombre) values (:id_ciudad, :nombre)";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':id_ciudad', $id_ciudad);
//     $sentencia->bindParam(':nombre', $nombre);
//     $sentencia->execute();

//     $conexion = closeBd();
// }





function openBd()
{
    $servername = "localhost";
    $username = "root";
    $password = "mysql";


    $conexion = new PDO("mysql:host=$servername;dbname=pokemon_db", $username, $password);
    // set the PDO error mode to exception
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec('set names utf8');

    return $conexion;
}

function closeBd()
{
    return null;
}

function selectCromos()
{
    $conexion = openBd();

    // $sentenciaText = "SELECT * FROM pokemon_db.cromos;";

    $sentenciaText = "SELECT c.*, r.nombreRegion, tp.nombreTipo
    FROM cromos c
    LEFT JOIN cromos_regiones cr ON c.id = cr.id_cromo
    LEFT JOIN regiones r ON cr.id_region = r.id
    LEFT JOIN cromos_tipos ct ON c.id = ct.id_cromo
    LEFT JOIN tiposPokemon tp ON ct.id_tipo = tp.id;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}
function getTiposFromDatabase(){
    
    $conexion = openBd();

    // $sentenciaText = "SELECT * FROM pokemon_db.cromos;";

    $sentenciaText = "select * from tiposPokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}
function insertCiudad($id_ciudad, $nombre)
{
    $conexion = openBd();
    $sentenciaText = " insert into ciudades (id_ciudad, nombre) values (:id_ciudad, :nombre)";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id_ciudad', $id_ciudad);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->execute();

    $conexion = closeBd();
}















?>