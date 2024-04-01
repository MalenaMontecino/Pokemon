<?php

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

function selectTiposPokemon()
{

    $conexion = openBd();

    // $sentenciaText = "SELECT * FROM pokemon_db.cromos;";

    $sentenciaText = "select * from tiposPokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}



// function insertCromos($nombre, $descripcion, $imagen, $nombreTipos, $nombreRegion)
// {
//     $conexion = openBd();

//     // Inserta en la tabla cromos
//     $sentenciaText =  "INSERT INTO cromos (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':nombre', $nombre);
//     $sentencia->bindParam(':descripcion', $descripcion);
//     $sentencia->bindParam(':imagen', $imagen);
//     $sentencia->execute();

//     // Obtiene el ID del cromo recién insertado
//     $idCromo = $conexion->lastInsertId();

//     // Inserta la relación en la tabla cromos_tipos para cada tipo seleccionado
//     foreach ($nombreTipos as $nombreTipo) {
//         $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, (SELECT id FROM tiposPokemon WHERE nombreTipo = :nombreTipo))";
//         $sentencia = $conexion->prepare($sentenciaText);
//         $sentencia->bindParam(':idCromo', $idCromo);
//         $sentencia->bindParam(':nombreTipo', $nombreTipo);
//         $sentencia->execute();
//     }

//     // Inserta la relación en la tabla cromos_regiones
//     $sentenciaText = "INSERT INTO cromos_regiones (id_cromo, id_region) VALUES (:idCromo, (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion))";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':idCromo', $idCromo);
//     $sentencia->bindParam(':nombreRegion', $nombreRegion);
//     $sentencia->execute();

//     $conexion = closeBd();
// }

function insertCromos($nombre, $descripcion, $imagen, $nombreRegion, $tipos)
{
    $conexion = openBd();

    // Inserta en la tabla cromos
    $sentenciaText =  "INSERT INTO cromos (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':imagen', $imagen);
    $sentencia->execute();

    // Obtener el ID del cromo recién insertado
    $idCromo = $conexion->lastInsertId();

    // Inserta la relación en la tabla cromos_regiones
    $sentenciaText = "INSERT INTO cromos_regiones (id_cromo, id_region) VALUES (:idCromo, (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion))";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':idCromo', $idCromo);
    $sentencia->bindParam(':nombreRegion', $nombreRegion);
    $sentencia->execute();

    // Inserta los tipos en la tabla cromos_tipos
    foreach ($tipos as $tipo) {
        $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, :idTipo)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':idCromo', $idCromo);
        $sentencia->bindParam(':idTipo', $tipo);
        $sentencia->execute();
    }

    $conexion = closeBd();
}


// function insertCromos($nombre, $descripcion, $imagen, $nombreTipo, $nombreRegion)
// {
//     $conexion = openBd();
//         // Inserta en la tabla cromos
//         $sentenciaText =  "INSERT INTO cromos (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)";
//         $sentencia = $conexion->prepare($sentenciaText);
//         $sentencia->bindParam(':nombre', $nombre);
//         $sentencia->bindParam(':descripcion', $descripcion);
//         $sentencia->bindParam(':imagen', $imagen);
//         $sentencia->execute();

//         // Obtiene el ID del cromo recién insertado
//         $idCromo = $conexion->lastInsertId();

//         // Inserta la relación en la tabla cromos_tipos para cada tipo seleccionado
//         //foreach ($nombreTipos as $nombreTipo) {
//         $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, (SELECT id FROM tiposPokemon WHERE nombreTipo = :nombreTipo))";
//         $sentencia = $conexion->prepare($sentenciaText);
//         $sentencia->bindParam(':idCromo', $idCromo);
//         $sentencia->bindParam(':nombreTipo', $nombreTipo);
//         $sentencia->execute();

//         // Inserta la relación en la tabla cromos_regiones
//         $sentenciaText = "INSERT INTO cromos_regiones (id_cromo, id_region) VALUES (:idCromo, (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion))";
//         $sentencia = $conexion->prepare($sentenciaText);
//         $sentencia->bindParam(':idCromo', $idCromo);
//         $sentencia->bindParam(':nombreRegion', $nombreRegion);
//         $sentencia->execute();

//         $conexion = closeBd();
// // }
// function deletePokemon($pokemon_id)
// {
//     echo "La función deletePokemon() se está ejecutando."; // Añade esta línea
//     try {
        
//         $conexion = openBd();
//         $sentenciaText = "DELETE from cromos where id = :id;";

//         $sentencia = $conexion->prepare($sentenciaText);
//         $sentencia->bindParam(':id', $pokemon_id);
//         $sentencia->execute();

//         $conexion = closeBd();
//     } catch (PDOException $e) {
//         echo "Error al ejecutar la consulta: " . $e->getMessage();
//     }
// }
// function deleteCromo($id)
// {
//     $conexion = openBd();
//     $sentenciaText = "DELETE from cromos where id = :id;";

//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':id', $id);
//     $sentencia->execute();

//     $conexion = closeBd();
// }
function deletePokemon($pokemon_id)
{
    echo "ID del Pokémon a eliminar: " . $pokemon_id;

    try {
        $conexion = openBd();
        $sentenciaText = "DELETE FROM cromos WHERE id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();
        // No es necesario cerrar la conexión aquí, se cerrará automáticamente al final del script
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
}
