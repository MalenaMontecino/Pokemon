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

function selectTiposPokemon(){
    
    $conexion = openBd();

    // $sentenciaText = "SELECT * FROM pokemon_db.cromos;";

    $sentenciaText = "select * from tiposPokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}





// function insertCromos($id, $nombre, $descripcion, $imagen, $nombreRegion, $nombreTipo)
// {
//     $conexion = openBd();
//     $sentenciaText = " insert into cromos (id, nombre, descripcion, imagen) values (:id, :nombre, :descripcion, :imagen)";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':id', $id);
//     $sentencia->bindParam(':nombre', $nombre);
//     $sentencia->bindParam(':descripcion', $descripcion);
//     $sentencia->bindParam(':imagen', $imagen);
//     $sentencia->execute();
    
//     // Obtiene el id del cromo insertado
//     $idCromo = $conexion->lastInsertId();

//     // Inserta en la tabla cromos_regiones usando una subconsulta
//     $sentenciaText = "INSERT INTO cromos_regiones (id_cromo, id_region) 
//     VALUES (:idCromo, (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion))";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':idCromo', $id);
//     $sentencia->bindParam(':nombreRegion', $nombreRegion);
//     $sentencia->execute();

//     // Inserta en la tabla cromos_tipos usando una subconsulta
//     $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) 
//     VALUES (:idCromo, (SELECT id FROM tiposPokemon WHERE nombreTipo = :nombreTipo))";
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':idCromo', $id);
//     $sentencia->bindParam(':nombreTipo', $nombreTipo);
//     $sentencia->execute();

   
//     $conexion = closeBd();
// }



// function insertCromos($nombre, $descripcion, $imagen, $nombreTipo, $nombreRegion) //$nombreRegion, $nombreTipo
// {
//     $conexion = openBd();

//     // Inserta en la tabla cromos
//     $sentenciaText =  "INSERT INTO cromos (nombre, descripcion, imagen, nombreTipo, nombreRegion) VALUES (:nombre, :descripcion, :imagen, :nombreTipo, :nombreRegion)";
    
//     $sentencia = $conexion->prepare($sentenciaText);
//     $sentencia->bindParam(':nombre', $nombre);
//     $sentencia->bindParam(':descripcion', $descripcion);
//     $sentencia->bindParam(':imagen', $imagen);
//     $sentencia->bindParam(':nombreTipo', $nombreTipo);
//     $sentencia->bindParam(':nombreRegion', $nombreRegion);
//     $sentencia->execute();
   
//     $conexion = closeBd();
// }

        // foreach ($nombreTipos as $nombreTipo) {
        //     $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, (SELECT id FROM tiposPokemon WHERE nombreTipo = :nombreTipo))";
        //     $sentencia = $conexion->prepare($sentenciaText);
        //     $sentencia->bindParam(':idCromo', $idCromo);
        //     $sentencia->bindParam(':nombreTipo', $nombreTipo);
        //     $sentencia->execute();
        // }

function insertCromos($nombre, $descripcion, $imagen, $nombreTipo, $nombreRegion)
{
    $conexion = openBd();
        // Inserta en la tabla cromos
        $sentenciaText =  "INSERT INTO cromos (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':imagen', $imagen);
        $sentencia->execute();

        // Obtiene el ID del cromo recién insertado
        $idCromo = $conexion->lastInsertId();

        // Inserta la relación en la tabla cromos_tipos para cada tipo seleccionado
        //foreach ($nombreTipos as $nombreTipo) {
        $sentenciaText = "INSERT INTO cromos_tipos (id_cromo, id_tipo) VALUES (:idCromo, (SELECT id FROM tiposPokemon WHERE nombreTipo = :nombreTipo))";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':idCromo', $idCromo);
        $sentencia->bindParam(':nombreTipo', $nombreTipo);
        $sentencia->execute();

        // Inserta la relación en la tabla cromos_regiones
        $sentenciaText = "INSERT INTO cromos_regiones (id_cromo, id_region) VALUES (:idCromo, (SELECT id FROM regiones WHERE nombreRegion = :nombreRegion))";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':idCromo', $idCromo);
        $sentencia->bindParam(':nombreRegion', $nombreRegion);
        $sentencia->execute();

        $conexion = closeBd();
}

function deleteCromo(){
    $conexion = openBd();
    $sentenciaText = " * from tiposPokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $conexion = closeBd();
}









?>