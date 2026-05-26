CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_flujo` text DEFAULT NULL,
  `color_sangre` text DEFAULT NULL,
  `dolor` text DEFAULT NULL,
  `sentimientos` text DEFAULT NULL,
  `medicamento` text DEFAULT NULL,
  `antojos` text DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 