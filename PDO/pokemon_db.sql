drop database if exists pokemon_db;
CREATE DATABASE pokemon_db;
USE pokemon_db;

drop table if exists cromos;
CREATE TABLE cromos (
    id INT PRIMARY KEY,
    nombre VARCHAR(25),
    descripcion VARCHAR(200),
    imagen LONGBLOB
);
drop table if exists regiones;
CREATE TABLE regiones (
    id INT PRIMARY KEY,
    nombreRegion VARCHAR(25)
);
-- RELACIÓN 1:N
drop table if exists cromos_regiones;
CREATE TABLE cromos_regiones (
    id INT PRIMARY KEY,
    id_cromo INT,
    id_region INT,
    FOREIGN KEY (id_cromo) REFERENCES cromos(id),
    FOREIGN KEY (id_region) REFERENCES regiones(id)
);

drop table if exists tiposPokemon;
CREATE TABLE tiposPokemon (
    id INT PRIMARY KEY,
    nombreTipo VARCHAR(25)
);

-- RELACIÓN M:N
drop table if exists cromos_tipos;
CREATE TABLE cromos_tipos (
    id INT PRIMARY KEY,
    id_cromo INT,
    id_tipo INT,
    FOREIGN KEY (id_cromo) REFERENCES cromos(id),
    FOREIGN KEY (id_tipo) REFERENCES tiposPokemon(id)
);


-- VALORES
-- Insertar datos en la tabla 'regiones'
INSERT INTO regiones (id, nombreRegion) VALUES
(1, 'Kanto'),
(2, 'Johto'),
(3, 'Hoenn'),
(4, 'Sinnoh'),
(5, 'Unova'),
(6, 'Kalos'),
(7, 'Alola'),
(8, 'Galar');

-- Insertar datos en la tabla 'tiposPokemon'
INSERT INTO tiposPokemon (id, nombreTipo) VALUES
(1, 'Agua'),
(2, 'Fuego'),
(3, 'Planta'),
(4, 'Eléctrico'),
(5, 'Hielo'),
(6, 'Volador'),
(7, 'Tierra'),
(8, 'Roca'),
(9, 'Veneno'),
(10, 'Psíquico'),
(11, 'Lucha'),
(12, 'Bicho'),
(13, 'Normal'),
(14, 'Fantasma'),
(15, 'Siniestro'),
(16, 'Hada'),
(17, 'Acero'),
(18, 'Dragón');

-- Insertar datos en la tabla 'cromos'
INSERT INTO cromos (id, nombre, descripcion, imagen) VALUES
(1, 'Bulbasaur', 'Tipo Planta/Veneno', NULL),
(2, 'Charmander', 'Tipo Fuego', NULL),
(3, 'Squirtle', 'Tipo Agua', NULL),
(4, 'Chikorita', 'Tipo Planta', NULL),
(5, 'Cyndaquil', 'Tipo Fuego', NULL),
(6, 'Totodile', 'Tipo Agua', NULL),
(7, 'Treecko', 'Tipo Planta', NULL),
(8, 'Torchic', 'Tipo Fuego', NULL),
(9, 'Mudkip', 'Tipo Agua', NULL),
(10, 'Turtwig', 'Tipo Planta', NULL),
(11, 'Chimchar', 'Tipo Fuego', NULL),
(12, 'Piplup', 'Tipo Agua', NULL),
(13, 'Snivy', 'Tipo Planta', NULL),
(14, 'Tepig', 'Tipo Fuego', NULL),
(15, 'Oshawott', 'Tipo Agua', NULL),
(16, 'Chespin', 'Tipo Planta', NULL),
(17, 'Fennekin', 'Tipo Fuego', NULL),
(18, 'Froakie', 'Tipo Agua', NULL),
(19, 'Rowlet', 'Tipo Planta/Volador', NULL),
(20, 'Litten', 'Tipo Fuego', NULL),
(21, 'Popplio', 'Tipo Agua', NULL),
(22, 'Grookey', 'Tipo Planta', NULL),
(23, 'Scorbunny', 'Tipo Fuego', NULL),
(24, 'Sobble', 'Tipo Agua', NULL),
(25, 'Bulbasaur_Alola', 'Tipo Planta/Veneno', NULL),
(26, 'Charmander_Alola', 'Tipo Fuego/Volador', NULL),
(27, 'Squirtle_Alola', 'Tipo Agua/Hielo', NULL);

-- Insertar datos en la tabla 'cromos_regiones'
INSERT INTO cromos_regiones (id, id_cromo, id_region) VALUES
(1, 1, 1),  -- Bulbasaur pertenece a Kanto
(2, 2, 1),  -- Charmander pertenece a Kanto
(3, 3, 1),  -- Squirtle pertenece a Kanto
(4, 4, 2),  -- Chikorita pertenece a Johto
(5, 5, 2),  -- Cyndaquil pertenece a Johto
(6, 6, 2),  -- Totodile pertenece a Johto
(7, 7, 3),  -- Treecko pertenece a Hoenn
(8, 8, 3),  -- Torchic pertenece a Hoenn
(9, 9, 3),  -- Mudkip pertenece a Hoenn
(10, 10, 4), -- Turtwig pertenece a Sinnoh
(11, 11, 4), -- Chimchar pertenece a Sinnoh
(12, 12, 4), -- Piplup pertenece a Sinnoh
(13, 13, 5), -- Snivy pertenece a Unova
(14, 14, 5), -- Tepig pertenece a Unova
(15, 15, 5), -- Oshawott pertenece a Unova
(16, 16, 6), -- Chespin pertenece a Kalos
(17, 17, 6), -- Fennekin pertenece a Kalos
(18, 18, 6), -- Froakie pertenece a Kalos
(19, 19, 7), -- Rowlet pertenece a Alola
(20, 20, 7), -- Litten pertenece a Alola
(21, 21, 7), -- Popplio pertenece a Alola
(22, 22, 8), -- Grookey pertenece a Galar
(23, 23, 8), -- Scorbunny pertenece a Galar
(24, 24, 8), -- Sobble pertenece a Galar
(25, 25, 7), -- Bulbasaur_Alola pertenece a Alola
(26, 26, 7), -- Charmander_Alola pertenece a Alola
(27, 27, 7); -- Squirtle_Alola pertenece a Alola

-- Insertar datos en la tabla 'cromos_tipos'
INSERT INTO cromos_tipos (id, id_cromo, id_tipo) VALUES
(1, 1, 3),  -- Bulbasaur es de tipo Planta/Veneno
(2, 2, 2),  -- Charmander es de tipo Fuego
(3, 3, 1),  -- Squirtle es de tipo Agua
(4, 4, 3),  -- Chikorita es de tipo Planta
(5, 5, 2),  -- Cyndaquil es de tipo Fuego
(6, 6, 1),  -- Totodile es de tipo Agua
(7, 7, 3),  -- Treecko es de tipo Planta
(8, 8, 2),  -- Torchic es de tipo Fuego
(9, 9, 1),  -- Mudkip es de tipo Agua
(10, 10, 3), -- Turtwig es de tipo Planta
(11, 11, 2), -- Chimchar es de tipo Fuego
(12, 12, 1), -- Piplup es de tipo Agua
(13, 13, 3), -- Snivy es de tipo Planta
(14, 14, 2), -- Tepig es de tipo Fuego
(15, 15, 1), -- Oshawott es de tipo Agua
(16, 16, 3), -- Chespin es de tipo Planta
(17, 17, 2), -- Fennekin es de tipo Fuego
(18, 18, 1), -- Froakie es de tipo Agua
(19, 19, 3), -- Rowlet es de tipo Planta/Volador
(20, 20, 2), -- Litten es de tipo Fuego
(21, 21, 1), -- Popplio es de tipo Agua
(22, 22, 3), -- Grookey es de tipo Planta
(23, 23, 2), -- Scorbunny es de tipo Fuego
(24, 24, 1), -- Sobble es de tipo Agua
(25, 25, 3), -- Bulbasaur_Alola es de tipo Planta/Veneno
(26, 26, 6), -- Charmander_Alola es de tipo Fuego/Volador
(27, 27, 5); -- Squirtle_Alola es de tipo Agua/Hielo
