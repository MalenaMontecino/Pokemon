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
function obtenerTiposActuales($conexion, $pokemon_id) {
    $sentenciaText = "SELECT id_tipo FROM cromos_tipos WHERE id_cromo = :id";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $pokemon_id);
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}


//EN ESTA SE GUARDAN LOS ANTERIORES PERO NO FUNCIONA LA MODIFICACIÓN
// function obtenerTiposActuales($conexion, $pokemon_id) {
//     $sentenciaText = "SELECT tipos.nombreTipo FROM cromos_tipos 
//                       JOIN tipos ON cromos_tipos.id_tipo = tipos.id 
//                       WHERE cromos_tipos.id_cromo = :id_cromo";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':id_cromo', $pokemon_id);
//     $sentencia->execute();
//     return $sentencia->fetchAll(PDO::FETCH_COLUMN);
// }


function updatePokemon($pokemon_id, $nombre, $descripcion, $imagen, $nombreRegion, $tipos) {
  //  error_log(print_r($pokemon_id, $nombre, $descripcion, $imagen, $nombreRegion, $tipos));
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

        // Actualizar la región solo si se proporciona un nuevo valor
        if ($nombreRegion !== "default") {
            $sentenciaText = "UPDATE cromos_regiones SET id_region = (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion) WHERE id_cromo = :id";
            $sentencia = $conexion->prepare($sentenciaText);
            $sentencia->bindParam(':nombreRegion', $nombreRegion);
            $sentencia->bindParam(':id', $pokemon_id);
            $sentencia->execute();
        }

        // Obtener los tipos actuales del Pokémon
        $tiposActuales = obtenerTiposActuales($conexion, $pokemon_id);
        var_dump($tiposActuales); // resultado: array(2) { [0]=> int(2) [1]=> int(16) } 
       die("hola");
       
        // Convertir los arrays a sets para comparar
        $tiposNuevos = array_filter($tipos, function($tipo) {
            return $tipo !== 'default';
        });
        $tiposNuevosSet = array_flip($tiposNuevos);
        $tiposActualesSet = array_flip($tiposActuales);
     
        // Calcular los tipos a añadir y los tipos a eliminar
        $tiposAEliminar = array_diff_key($tiposActualesSet, $tiposNuevosSet);
        $tiposAAnadir = array_diff_key($tiposNuevosSet, $tiposActualesSet);

        // Eliminar los tipos que ya no están en la lista
        if (!empty($tiposAEliminar)) {
            $sentenciaDelete = "DELETE FROM cromos_tipos WHERE id_cromo = :id AND id_tipo = :id_tipo";
            $sentencia = $conexion->prepare($sentenciaDelete);
            $sentencia->bindParam(':id', $pokemon_id);
            foreach ($tiposAEliminar as $id_tipo => $_) {
                $sentencia->bindParam(':id_tipo', $id_tipo);
                $sentencia->execute();
            }
        }

        // Añadir los nuevos tipos
        if (!empty($tiposAAnadir)) {
            $sentenciaInsert = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, :idTipo)";
            $sentencia = $conexion->prepare($sentenciaInsert);
            $sentencia->bindParam(':idCromo', $pokemon_id);
            foreach ($tiposAAnadir as $id_tipo => $_) {
                $sentencia->bindParam(':idTipo', $id_tipo);
                $sentencia->execute();
            }
        }

        closeBd($conexion);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
