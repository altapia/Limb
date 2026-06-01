
--
-- Base de datos: `limbBot`
--

-- Se crea la base de datos si no existe
CREATE DATABASE IF NOT EXISTS `limbBot` DEFAULT CHARACTER SET utf32 COLLATE utf32_spanish_ci;
USE `limbBot`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CHATS`
--

CREATE TABLE `CHATS` (
  `CHAT_ID` int NOT NULL,
  `NOMBRE` varchar(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Estructura de tabla para la tabla `CHATS_GRUPO`
--

CREATE TABLE `CHATS_GRUPO` (
  `CHAT_ID` int NOT NULL,
  `GRUPO_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Estructura de tabla para la tabla `CMD_APOSTAR`
--

CREATE TABLE `CMD_APOSTAR` (
  `CHAT_ID` int NOT NULL,
  `PARTIDO` int DEFAULT NULL,
  `IMPORTE` double DEFAULT NULL,
  `DESCRIP` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CMD_CURRENT`
--

CREATE TABLE `CMD_CURRENT` (
  `CHAT_ID` int NOT NULL,
  `CMD` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `GRUPO` int DEFAULT NULL,
  `FEC_ACTIVIDAD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GRUPOS`
--

CREATE TABLE `GRUPOS` (
  `ID` int NOT NULL,
  `NOMBRE` varchar(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `URL_API` varchar(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `URL_WEB` varchar(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CHATS`
--
ALTER TABLE `CHATS`
  ADD PRIMARY KEY (`CHAT_ID`);

--
-- Indices de la tabla `CHATS_GRUPO`
--
ALTER TABLE `CHATS_GRUPO`
  ADD UNIQUE KEY `CHAT_ID` (`CHAT_ID`,`GRUPO_ID`);

--
-- Indices de la tabla `CMD_APOSTAR`
--
ALTER TABLE `CMD_APOSTAR`
  ADD PRIMARY KEY (`CHAT_ID`);

--
-- Indices de la tabla `CMD_CURRENT`
--
ALTER TABLE `CMD_CURRENT`
  ADD PRIMARY KEY (`CHAT_ID`);

--
-- Indices de la tabla `GRUPOS`
--
ALTER TABLE `GRUPOS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `GRUPOS`
--
ALTER TABLE `GRUPOS`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CMD_APOSTAR`
--
ALTER TABLE `CMD_APOSTAR`
  ADD CONSTRAINT `FK_CMD_CHATID` FOREIGN KEY (`CHAT_ID`) REFERENCES `CMD_CURRENT` (`CHAT_ID`) ON DELETE CASCADE;

