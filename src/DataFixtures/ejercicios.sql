-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.26 - MySQL Community Server (GPL)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para much_fit_dev
CREATE DATABASE IF NOT EXISTS `much_fit_dev` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `much_fit_dev`;

-- Volcando estructura para tabla much_fit_dev.ejercicios
CREATE TABLE IF NOT EXISTS `ejercicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla much_fit_dev.ejercicios: ~82 rows (aproximadamente)
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
INSERT INTO `ejercicios` (`id`, `descripcion`, `imagen`) VALUES
	(1, 'Press de banca Inclinado Mancuernas', ''),
	(2, 'Fondos en paralelas', ''),
	(3, 'Press de banca Inclinado', ''),
	(4, 'Sentadilla', ''),
	(5, 'Leg press (hinge )', ''),
	(6, 'Good Morning (Barbell)', ''),
	(7, 'Squat', ''),
	(8, 'Leg press', ''),
	(9, 'Good Morning', ''),
	(10, 'Chin Up', ''),
	(11, 'Lat Pulldown ', ''),
	(12, 'Seated Cable Row (close Grip)', ''),
	(13, 'Rear delt fly', ''),
	(14, 'Seated Row', ''),
	(15, 'Hammer Curl', ''),
	(16, 'Hammer Curl (Dumbbell )', ''),
	(17, 'Glute extension. ', ''),
	(18, 'Seated Military Press', ''),
	(19, 'Seated Shoulder  Press (Barbell)', ''),
	(20, 'Leg outward fly', ''),
	(21, 'Seated Military Press (Dumbbell)', ''),
	(22, 'Lateral Raise', ''),
	(23, 'Seated Shoulder Press (Dumbbell)', ''),
	(24, 'Lateral Raise (Dumbbells)', ''),
	(25, 'Bicep Curl (Barbell)', ''),
	(26, 'T-bar Row', ''),
	(27, 'Bicep Curl (barbell )', ''),
	(28, 'Incline Press (Dumbbell)', ''),
	(29, 'Tricep pushdown', ''),
	(30, 'Tricep Extension', ''),
	(31, 'Bent Over Row (Dumbbell)', ''),
	(32, 'Leg curl', ''),
	(33, 'Cycling', ''),
	(34, 'Military Press (Standing)', ''),
	(35, 'Shoulder Press (Standing)', ''),
	(36, 'Deadlift (Barbell)', ''),
	(37, 'Deadlift', ''),
	(38, 'Hammer back row wide 45 angle', ''),
	(39, 'Hammer lat pulldown', ''),
	(40, 'Rotator cuff work. ', ''),
	(41, 'Shrugs (dumbbell)', ''),
	(42, 'Hammer seated row', ''),
	(43, 'Hammer seated row (CLOSE GRIP)', ''),
	(44, 'Pull Up', ''),
	(45, 'Hammer shoulder press', ''),
	(46, 'Overhead Press (Dumbbell)', ''),
	(47, 'Overhead Press (Barbell)', ''),
	(48, 'Bench Press (Barbell)', ''),
	(49, 'Hammer Decline Chest Press', ''),
	(50, 'Front Squat (Barbell)', ''),
	(51, 'Lateral Raise (Dumbbell)', ''),
	(52, 'Leg Extension (Machine)', ''),
	(53, 'Landmine Press', ''),
	(54, 'Bicep Curl (Dumbbell)', ''),
	(55, 'Romanian Deadlift (Barbell)', ''),
	(56, 'Neutral Chin', ''),
	(57, 'Skullcrusher (Barbell)', ''),
	(58, 'Lat Pulldown (Cable)', ''),
	(59, 'Rope Never Ending ', ''),
	(60, 'Face pull', ''),
	(61, 'Front Raise (Dumbbell)', ''),
	(62, 'Deadlift - Trap Bar', ''),
	(63, 'Stairmaster', ''),
	(64, 'Hammer Row Stand 1armed', ''),
	(65, 'Sling Shot Bench', ''),
	(66, 'Sling Shot Incline', ''),
	(67, 'Hack Squat', ''),
	(68, 'Hammer Row - Wide Grip', ''),
	(69, 'Shrugs', ''),
	(70, 'Rack Pull - 1 Pin', ''),
	(71, 'Hammer High Row - 1 Arm', ''),
	(72, 'Rack Pull 2 Pin', ''),
	(73, 'kettlebell Swings', ''),
	(74, 'close grip Bench', ''),
	(75, 'Low Incline Dumbbell Bench', ''),
	(76, 'sumo deadlift', ''),
	(77, 'lying Skullcrusher', ''),
	(78, 'high bar squat', ''),
	(79, 'curl ez bar', ''),
	(80, 'Curl Dumbbell', ''),
	(81, 'Lat Pulldown Closegrip', ''),
	(82, 'Cable Fly', '');
/*!40000 ALTER TABLE `ejercicios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
