<?php

session_start(); //errores francisco

function errorMessage($e)
{
    if (!empty($e->errorInfo[1])) {
        switch ($e->errorInfo[1]) {
            case 1062:
                $mensaje = 'Registro duplicado';
                break;
            case 1451:
                $mensaje = 'Registro con elementos relacionados';
                break;
            default:
                $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                break;
        }
    } else {
        switch ($e->getCode()) {

            case 1044:
                $mensaje = 'Usuario y/o password incorrecto';
                break;
            case 1049:
                $mensaje = 'Base de datos desconocida';
                break;
            case 2002:
                $mensaje = 'No se encuentra el servidor';
                break;
            default:
                $mensaje =  $e->getCode() . ' - ' . $e->getMessage();
                break;
        }
    }
    return $mensaje;
}


function openBd()
{
    try {
        $servername = "localhost";
        $username = "root";
        $password = "mysql";

        //edita el nombre cambia y te saldrá
        $conexion = new PDO("mysql:host=$servername;dbname=pokemon_db", $username, $password);
        // set el PDO modo de error para las exceptions
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec('set names utf8');

        return $conexion;
    } catch (PDOException $e) {

        //errores francisco
        $_SESSION['error'] = errorMessage($e);
    }
}

function closeBd()
{
    return null;
}

function selectCromos()
{
    $conexion = openBd();

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

    //recupero datos y los almaceno en una array $resultado
    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectTiposPokemon()
{
    $conexion = openBd();

    $sentenciaText = "SELECT * FROM tiposPokemon;";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function insertCromos($nombre, $descripcion, $imagen, $nombreRegion, $tipos)
{
    $conexion = openBd();

    try {
        // Iniciar la transacción
        $conexion->beginTransaction();

        // Inserta en la tabla cromos
        $sentenciaText = "INSERT INTO cromos (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)";
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

        // Commit de la transacción
        $conexion->commit();

        $_SESSION['mensaje'] = 'Pokemon creado correctamente!';
    } catch (PDOException $e) {
        // Rollback de la transacción en caso de error
        $conexion->rollBack();


        //errores francisco
        $_SESSION['error'] = errorMessage($e);
    }

    $conexion = closeBd();
}

function obtenerTiposActuales($conexion, $pokemon_id)
{
    $sentenciaText = "SELECT id_tipo FROM cromos_tipos WHERE id_cromo = :id";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $pokemon_id);
    $sentencia->execute();
    //guardar en array
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function updatePokemon($pokemon_id, $nombre, $descripcion, $imagen, $nombreRegion, $tipos)
{
    try {
        $conexion = openBd();
        // Iniciar la transacción
        $conexion->beginTransaction();

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

        // Quita el default del array
        $tiposNuevos = array_filter($tipos, function ($tipo) {
            return $tipo !== 'default';
        });

        if (empty($tiposNuevos)) {
            $tiposNuevos = $tiposActuales;
        }

        // Invierte el array (las claves por valores y valores por claves) para ayudar a la detección de diferencias
        $tiposNuevosSet = array_flip($tiposNuevos);
        $tiposActualesSet = array_flip($tiposActuales);

        // Calcula la diferencia
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

        // Commit de la transacción
        $conexion->commit();


        $_SESSION['mensaje'] = 'Pokemon modificado correctamente!';
    } catch (PDOException $e) {
        // Rollback de la transacción en caso de error
        $conexion->rollBack();
        //errores francisco
        $_SESSION['error'] = errorMessage($e);
    }
    closeBd($conexion);
}

function deletePokemon($pokemon_id)
{
    try {
        $conexion = openBd();
        // Iniciar la transacción
        $conexion->beginTransaction();

        // Eliminar los registros de la tabla cromos_tipos dependiendo del id
        $sentenciaText = "DELETE FROM cromos_tipos WHERE id_cromo = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Eliminar de cromos_regiones
        $sentenciaText = "DELETE FROM cromos_regiones WHERE id_cromo = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Eliminar el cromo de la tabla cromos
        $sentenciaText = "DELETE FROM cromos WHERE id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $pokemon_id);
        $sentencia->execute();

        // Commit de la transacción
        $conexion->commit();

        $_SESSION['mensaje'] = 'Pokemon eliminado correctamente!';
    } catch (PDOException $e) {
        // Rollback de la transacción en caso de error
        $conexion->rollBack();
        //errores francisco
        $_SESSION['error'] = errorMessage($e);
    }
    closeBd($conexion);
}
