
CREATE DATABASE `pokemons-seijas-tomas`;

CREATE TABLE `tipopokemon` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `imagenTipo` varchar(150) NOT NULL
);

CREATE TABLE `usuario` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
);

CREATE TABLE `pokemon` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `numero` int(4) NOT NULL ,
  `nombre` varchar(30) NOT NULL ,
  `imagen` varchar(150) NOT NULL,
  `tipoPokemon` int(11) NOT NULL,
  FOREIGN KEY (tipoPokemon) REFERENCES tipopokemon (id)
);



INSERT INTO `usuario` (`id`, `nombreUsuario`, `password`) VALUES
(1, 'admin', 'admin1234');

INSERT INTO `tipopokemon` (`id`, `tipo`, `imagenTipo`) VALUES
(1, 'Acero', 'recursos/img/tipoPokemon/acero.gif'),
(2, 'Agua', 'recursos/img/tipoPokemon/agua.gif'),
(3, 'Bicho', 'recursos/img/tipoPokemon/bicho.gif'),
(4, 'Dragon', 'recursos/img/tipoPokemon/dragon.gif'),
(5, 'Electrico', 'recursos/img/tipoPokemon/electrico.gif'),
(6, 'Fantasma', 'recursos/img/tipoPokemon/fantasma.gif'),
(7, 'Fuego', 'recursos/img/tipoPokemon/fuego.gif'),
(8, 'Hada', 'recursos/img/tipoPokemon/hada.gif'),
(9, 'Hielo', 'recursos/img/tipoPokemon/hielo.gif'),
(10, 'Lucha', 'recursos/img/tipoPokemon/lucha.gif'),
(11, 'Normal', 'recursos/img/tipoPokemon/normal.gif'),
(12, 'Planta', 'recursos/img/tipoPokemon/planta.gif'),
(13, 'Psiquico', 'recursos/img/tipoPokemon/psiquico.gif'),
(14, 'Roca', 'recursos/img/tipoPokemon/roca.gif'),
(15, 'Siniestro', 'recursos/img/tipoPokemon/siniestro.gif'),
(16, 'Tierra', 'recursos/img/tipoPokemon/tierra.gif'),
(17, 'Veneno', 'recursos/img/tipoPokemon/veneno.gif'),
(18, 'Volador', 'recursos/img/tipoPokemon/volador.gif'),
(19, '???', 'recursos/img/tipoPokemon/___.gif');

INSERT INTO `pokemon` (`id`, `numero`, `nombre`, `imagen`, `tipoPokemon`) VALUES
(1, 1, 'Bulbasaur', 'recursos/img/pokemon/bulbasaur.png', 12),
(2, 4, 'Charmander', 'recursos/img/pokemon/charmander.png', 7),
(3, 7, 'Squirtle', 'recursos/img/pokemon/squirtle.png', 2),
(4, 25, 'Pikachu', 'recursos/img/pokemon/pikachu.png', 5),
(5, 66, 'Machop', 'recursos/img/pokemon/machop.png', 10);