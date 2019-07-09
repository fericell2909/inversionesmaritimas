
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `cie10` (
  `id` int(10) UNSIGNED NOT NULL,
  `id10` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dec10` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `grp10` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `cie10`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cie10_id10_unique` (`id10`);
ALTER TABLE `cie10`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
