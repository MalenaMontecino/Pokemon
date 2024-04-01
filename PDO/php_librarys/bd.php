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
function selectCromosPorId($pokemon_id)
{
    $conexion = openBd();

    $sentenciaText = "SELECT c.*, r.nombreRegion, tp.nombreTipo
    FROM cromos c
    LEFT JOIN cromos_regiones cr ON c.id = cr.id_cromo
    LEFT JOIN regiones r ON cr.id_region = r.id
    LEFT JOIN cromos_tipos ct ON c.id = ct.id_cromo
    LEFT JOIN tiposPokemon tp ON ct.id_tipo = tp.id
    WHERE c.id = :id;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $pokemon_id);
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

function updatePokemon($pokemon_id, $nombre, $descripcion, $imagen, $nombreRegion, $tipos)
{
    try {
        $conexion = openBd();

        // Actualizar los datos en la tabla cromos
        $sentenciaText = "UPDATE cromos SET nombre = :nombre, descripcion = :descripcion, imagen = :imagen WHERE id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':imagen', $imagen);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Actualizar la región en la tabla cromos_regiones
        $sentenciaText = "UPDATE cromos_regiones SET id_region = (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion) WHERE id_cromo = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':nombreRegion', $nombreRegion);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Eliminar los tipos existentes en la tabla cromos_tipos relacionados con el Pokémon
        $sentenciaText = "DELETE FROM cromos_tipos WHERE id_cromo = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Insertar los nuevos tipos en la tabla cromos_tipos
        foreach ($tipos as $tipo) {
            $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, :idTipo)";
            $sentencia = $conexion->prepare($sentenciaText);
            $sentencia->bindParam(':idCromo', $pokemon_id);
            $sentencia->bindParam(':idTipo', $tipo);
            $sentencia->execute();
        }

        echo "Pokémon actualizado correctamente.";

        // No es necesario cerrar la conexión aquí, se cerrará automáticamente al final del script
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
}

function deletePokemon($pokemon_id)
{
    echo "ID del Pokémon a eliminar: " . $pokemon_id;

    try {
        $conexion = openBd();

        // Eliminar los registros de la tabla cromos_tipos relacionados con el cromo de ID especificado
        $sentenciaText = "DELETE FROM cromos_tipos WHERE id_cromo = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Eliminar los registros de la tabla cromos_regiones relacionados con el cromo de ID especificado
        $sentenciaText = "DELETE FROM cromos_regiones WHERE id_cromo = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Finalmente, eliminar el cromo de la tabla cromos
        $sentenciaText = "DELETE FROM cromos WHERE id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // No es necesario cerrar la conexión aquí, se cerrará automáticamente al final del script
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
}
