drop database if exists pokemon_db;
CREATE DATABASE pokemon_db;
USE pokemon_db;

drop table if exists cromos;
CREATE TABLE cromos (
    id INT auto_increment PRIMARY KEY,
    nombre VARCHAR(25),
    descripcion VARCHAR(200),
    imagen LONGBLOB
);
drop table if exists regiones;
CREATE TABLE regiones (
    id INT auto_increment PRIMARY KEY,
    nombreRegion VARCHAR(25)
);
-- RELACIÓN 1:N
drop table if exists cromos_regiones;
CREATE TABLE cromos_regiones (
    id INT auto_increment PRIMARY KEY,
    id_cromo INT,
    id_region INT,
    FOREIGN KEY (id_cromo) REFERENCES cromos(id),
    FOREIGN KEY (id_region) REFERENCES regiones(id)
);

drop table if exists tiposPokemon;
CREATE TABLE tiposPokemon (
    id INT auto_increment PRIMARY KEY,
    nombreTipo VARCHAR(25)
);

-- RELACIÓN M:N
drop table if exists cromos_tipos;
CREATE TABLE cromos_tipos (
    id INT auto_increment PRIMARY KEY,
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
(8, 'Fantasma'),
(9, 'Veneno'),
(10, 'Psíquico'),
(11, 'Lucha'),
(12, 'Bicho'),
(13, 'Normal'),
(14, 'Roca'),
(15, 'Siniestro'),
(16, 'Hada'),
(17, 'Acero'),
(18, 'Dragón');

-- Insertar datos en la tabla 'cromos'
INSERT INTO cromos (id, nombre, descripcion, imagen) VALUES
(1, 'Bulbasaur', 'Un Pokémon de tipo Planta/Veneno conocido por tener una planta en su espalda que crece a medida que evoluciona.', 'bulbasur.png'),
(2, 'Charmander', 'Un pequeño Pokémon de tipo Fuego con una llama en la punta de su cola.', 'charmander.png'),
(3, 'Squirtle', 'Un simpático Pokémon de tipo Agua con una cáscara en forma de caparazón en su espalda.', 'squirtle.png'),
(4, 'Chikorita', 'Un Pokémon de tipo Planta con una hoja en su cabeza que usa para detectar cambios en el ambiente.', 'chikorita.png'),
(5, 'Cyndaquil', 'Un Pokémon de tipo Fuego con llamas en su espalda que enciende cuando se siente amenazado.', 'cyndaquil.png'),
(6, 'Totodile', 'Un Pokémon de tipo Agua con fuertes mandíbulas que utiliza para atrapar a sus presas.', 'totodile.png'),
(7, 'Treecko', 'Un ágil Pokémon de tipo Planta conocido por su velocidad y su cola en forma de hoja.', 'treecko.png'),
(8, 'Torchic', 'Un pequeño Pokémon de tipo Fuego con un cuerpo cubierto de plumas.', 'torchic.png'),
(9, 'Mudkip', 'Un Pokémon de tipo Agua con aletas en sus mejillas que le permiten detectar corrientes de agua.', 'mudkip.png'),
(10, 'Turtwig', 'Un Pokémon de tipo Planta con un caparazón en su espalda que le sirve de protección.', 'turtwig.png'),
(11, 'Chimchar', 'Un juguetón Pokémon de tipo Fuego con una llama ardiente en su cola.', 'chimchar.png'),
(12, 'Piplup', 'Un pingüino Pokémon de tipo Agua con una corona de plumas en la cabeza.', 'piplup.png'),
(13, 'Snivy', 'Un Pokémon de tipo Planta con una actitud serena y un collar de hojas alrededor de su cuello.', 'snivy.png'),
(14, 'Tepig', 'Un Pokémon de tipo Fuego con un cuerpo cubierto de cerdas que se encienden cuando está emocionado.', 'tepig.png'),
(15, 'Oshawott', 'Un Pokémon de tipo Agua con una concha en forma de caparazón que usa como espada.', 'oshawott.png'),
(16, 'Chespin', 'Un Pokémon de tipo Planta con púas en su espalda que usa para defenderse de los enemigos.', 'chespin.png'),
(17, 'Fennekin', 'Un Pokémon de tipo Fuego con orejas grandes y una llama en su cola.', 'fennekin.png'),
(18, 'Froakie', 'Un ágil Pokémon de tipo Agua con la capacidad de saltar grandes distancias.', 'froakie.png'),
(19, 'Rowlet', 'Un Pokémon de tipo Planta/Volador con grandes ojos y una actitud tranquila.', 'rowlet.png'),
(20, 'Litten', 'Un felino Pokémon de tipo Fuego con un pelaje caliente y una personalidad independiente.', 'litten.png'),
(21, 'Popplio', 'Un juguetón Pokémon de tipo Agua conocido por sus habilidades acuáticas y su nariz redonda.', 'popplio.png'),
(22, 'Grookey', 'Un Pokémon de tipo Planta con un palo como accesorio que utiliza como instrumento musical.', 'grookey.png'),
(23, 'Scorbunny', 'Un Pokémon de tipo Fuego con una energía inagotable y una cola en forma de llama.', 'scorbunny.png'),
(24, 'Sobble', 'Un tímido Pokémon de tipo Agua que se camufla en el agua para evitar peligros.', 'sobble.png');

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
(24, 24, 8); -- Sobble pertenece a Galar


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
(24, 24, 1); -- Sobble es de tipo Agua

-- select * from tiposPokemon;
SELECT c.*, r.nombreRegion, tp.nombreTipo
    FROM cromos c
    LEFT JOIN cromos_regiones cr ON c.id = cr.id_cromo
    LEFT JOIN regiones r ON cr.id_region = r.id
    LEFT JOIN cromos_tipos ct ON c.id = ct.id_cromo
    LEFT JOIN tiposPokemon tp ON ct.id_tipo = tp.id;
    
-- Eliminar los registros de cromos_regiones relacionados con el cromo de ID 25
DELETE FROM cromos_regiones WHERE id_cromo = 26;

-- Eliminar los registros de cromos_tipos relacionados con el cromo de ID 25
DELETE FROM cromos_tipos WHERE id_cromo = 26;

-- Finalmente, eliminar el cromo de la tabla cromos
DELETE FROM cromos WHERE id = 26;

