-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2023 a las 02:17:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `papeleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `hora` text NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `compra_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha` varchar(64) NOT NULL,
  `hora` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`compra_id`, `usuario_id`, `total`, `fecha`, `hora`) VALUES
(1, 4, 15, '23-02-2023', '04:36:05'),
(2, 4, 15, '23-02-2023', '04:36:17'),
(3, 4, 15, '23-02-2023', '04:36:53'),
(4, 4, 7, '23-02-2023', '04:38:01'),
(5, 4, 16, '23-02-2023', '04:38:51'),
(7, 5, 60, '04-03-2023', '06:31:24'),
(8, 5, 60, '04-03-2023', '06:33:22'),
(9, 5, 36, '04-03-2023', '06:33:58'),
(10, 5, 22, '04-03-2023', '06:39:34'),
(11, 5, 12, '04-03-2023', '06:40:29'),
(12, 5, 6, '04-03-2023', '06:41:27'),
(13, 5, 6, '04-03-2023', '06:43:58'),
(14, 5, 6, '04-03-2023', '06:44:27'),
(15, 5, 18, '04-03-2023', '06:45:02'),
(16, 5, 8, '07-03-2023', '02:00:21'),
(17, 6, 51, '21-03-2023', '02:30:40'),
(18, 7, 50, '26-03-2023', '04:23:59'),
(19, 7, 18, '26-03-2023', '04:25:33'),
(20, 7, 25, '26-03-2023', '05:11:59'),
(21, 7, 25, '26-03-2023', '05:12:31'),
(22, 7, 25, '26-03-2023', '05:12:47'),
(23, 7, 36, '26-03-2023', '05:14:36'),
(26, 7, 54, '26-03-2023', '05:20:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compra`
--

CREATE TABLE `detalles_compra` (
  `detalle_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_compra`
--

INSERT INTO `detalles_compra` (`detalle_id`, `compra_id`, `producto_id`, `precio`, `cantidad`, `total`) VALUES
(1, 1, 1, 3, 1, 3),
(2, 1, 3, 6, 2, 12),
(3, 4, 1, 3, 1, 3),
(4, 4, 2, 4, 1, 4),
(5, 5, 5, 10, 1, 10),
(6, 7, 2, 4, 2, 8),
(7, 9, 3, 6, 6, 36),
(8, 10, 3, 6, 3, 18),
(9, 11, 3, 6, 2, 12),
(10, 12, 3, 6, 1, 6),
(11, 14, 3, 6, 1, 6),
(12, 15, 3, 6, 3, 18),
(13, 16, 2, 4, 2, 8),
(14, 17, 2, 4, 3, 12),
(15, 18, 7, 25, 2, 50),
(16, 19, 17, 18, 1, 18),
(17, 20, 7, 25, 1, 25),
(18, 21, 8, 25, 1, 25),
(19, 22, 8, 25, 1, 25),
(20, 23, 17, 18, 2, 36),
(21, 26, 17, 18, 3, 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(256) NOT NULL,
  `producto_precio` int(11) NOT NULL,
  `producto_stock` int(11) NOT NULL,
  `producto_descripcion` text NOT NULL,
  `producto_img` varchar(512) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `ruta` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `producto_nombre`, `producto_precio`, `producto_stock`, `producto_descripcion`, `producto_img`, `proveedor_id`, `ruta`) VALUES
(1, 'Lápiz Amarillo Dixon ', 4, 7, 'El lápiz amarillo Dixon es una herramienta clásica y confiable para estudiantes, artistas y profesionales. Con su cuerpo de madera de alta calidad y su mina resistente, este lápiz es perfecto para escribir, dibujar y esbozar con facilidad.\r\n\r\nEl lápiz amarillo Dixon cuenta con una mina suave y resistente que proporciona una experiencia de escritura suave y uniforme. Además, su cuerpo de madera es duradero y resistente, lo que lo hace ideal para uso diario en el aula o en la oficina.\r\n\r\nCon su diseño sencillo y elegante, el lápiz amarillo Dixon es una herramienta atemporal que nunca pasa de moda. Su color amarillo vibrante lo hace fácil de identificar y encontrar en cualquier estuche o porta lápices, y su durabilidad lo convierte en una opción económica y sostenible para tus necesidades de escritura y dibujo.', 'lapiz-amarillo-dixon.webp', 1, 'lapiz-amarillo-dixon'),
(2, 'Lápiz Verde Bic', 4, 5, 'Presentamos el mejor compañero de escritura: ¡el lápiz Bic! Este instrumento de escritura elegante y con estilo no solo es un placer para la vista, sino que también es increíblemente funcional y versátil. Ya sea que esté tomando notas, esbozando ideas o simplemente escribiendo una lista de tareas pendientes, el lápiz Bic ofrece líneas suaves y precisas con cada trazo. Fabricado con materiales de alta calidad, este lápiz es resistente y duradero, lo que lo convierte en la elección perfecta para estudiantes, artistas y profesionales por igual. Con su agarre cómodo y su diseño fácil de usar, el lápiz Bic seguramente se convertirá en su herramienta de escritura. Entonces, ¿por qué conformarse con una experiencia de escritura limitada? ¡Actualízate al lápiz Bic hoy y experimenta la diferencia por ti mismo.', 'lapiz-verde-bic.webp', 3, 'lapiz-verde-bic'),
(3, 'Pincel Rojo Barrilito', 6, 3, 'El pincel rojo Barrilito es una herramienta esencial para artistas y aficionados a la pintura. \r\nSu suave y resistente cerda permite una aplicación uniforme y precisa de la pintura, lo que garantiza una experiencia de pintura cómoda y agradable. \r\nAdemás, su mango ergonómico se adapta perfectamente a la mano, lo que lo hace fácil y cómodo de manejar. \r\nCon el pincel rojo Barrilito, podrás crear obras de arte con detalles precisos y de alta calidad.', 'pincel-rojo-barrilito.jpg', 2, 'pincel-rojo-barrilito'),
(4, 'Lápiz Amarillo PaperMate', 4, 15, 'El lápiz amarillo PaperMate es un clásico y confiable lápiz que ha sido utilizado por generaciones de estudiantes y profesionales. \r\nSu mina suave y resistente proporciona una escritura uniforme y su cuerpo amarillo brillante es fácilmente reconocible en cualquier lugar. \r\nAdemás, su diseño hexagonal antideslizante garantiza un agarre cómodo y seguro durante la escritura, lo que lo convierte en una excelente opción para tomar notas, dibujar o escribir.', 'lapiz-amarillo-papermate.jpg', 4, 'lapiz-amarillo-papermate'),
(5, 'Pluma Azor', 10, 12, 'La pluma Azor es una herramienta elegante y sofisticada que es perfecta para firmar documentos importantes o para tomar notas en reuniones y conferencias. \r\nSu cuerpo ligero y suave garantiza una escritura cómoda y su tinta de alta calidad garantiza una experiencia de escritura suave y sin manchas. \r\nAdemás, su diseño clásico y atemporal le da un toque de elegancia a cualquier conjunto de escritura, lo que la convierte en una excelente opción para profesionales y estudiantes por igual.', 'pluma-amarilla-azor.webp', 5, 'pluma-amarilla-azor'),
(6, 'Goma Bicolor Barrilito', 10, 9, 'La goma bicolor Barrilito es una herramienta práctica para estudiantes y profesionales que necesitan corregir errores de escritura. \r\nCon sus dos colores diferentes, esta goma es perfecta para borrar lápices de colores y lápices regulares. \r\nAdemás, su diseño ergonómico le da un agarre cómodo y seguro durante el uso, lo que lo hace fácil de manejar. \r\nLa goma bicolor Barrilito es una opción ideal para aquellos que necesitan una herramienta práctica y eficaz para corregir errores de escritura.', 'goma-bicolor-barrilito.webp', 2, 'goma-bicolor-barrilito'),
(7, '500 Hojas Blancas Carta Scribe', 799, 9, 'Este paquete de 500 hojas blancas Carta Scribe es una solución perfecta para todas tus necesidades de impresión y escritura. Cada hoja es de alta calidad y garantiza una impresión nítida y clara, lo que lo hace ideal para documentos importantes y presentaciones. \r\nAdemás, su tamaño estándar lo hace fácil de usar con cualquier impresora o fotocopiadora, lo que lo convierte en una excelente opción para cualquier tipo de proyecto.', '500-hojas-blancas-carta-scribe.webp', 6, '500-hojas-blancas-carta-scribe'),
(8, 'Compás Barrilito', 25, 5, 'El compás Barrilito es una herramienta esencial para estudiantes y profesionales que necesitan dibujar círculos precisos. Con su punta afilada y su cuerpo resistente, este compás garantiza una experiencia de dibujo suave y precisa. Además, su diseño ergonómico le da un agarre cómodo y seguro durante el uso, lo que lo hace fácil de manejar. \r\nEl compás Barrilito es una excelente opción para aquellos que necesitan una herramienta precisa y confiable para dibujar círculos y arcos.', 'compás-barrilito.webp', 2, 'compás-barrilito'),
(9, 'Sacapuntas con deposito y goma Barrilito', 15, 15, 'El sacapuntas con depósito y goma Barrilito es una herramienta imprescindible para cualquier estudiante o profesional que utilice lápices de madera. \r\nSu diseño práctico incluye un depósito para almacenar las virutas de lápiz y una goma de borrar incorporada para corregir errores de escritura. Además, su cuerpo resistente y duradero garantiza una larga vida útil. \r\nEl sacapuntas con depósito y goma Barrilito es fácil de usar y transportar, lo que lo hace ideal para llevar en estuches de lápices o en el bolsillo. \r\nCon esta herramienta en tu arsenal, siempre tendrás un lápiz afilado y una goma a mano.', 'sacapuntas-con-deposito-y-goma-barrilito.webp', 2, 'sacapuntas-con-deposito-y-goma-barrilito'),
(10, 'Goma Bicolor Barrilito', 15, 17, 'La goma bicolor Barrilito es una herramienta esencial para corregir errores en tus trabajos escolares, de oficina o de arte. Su diseño bicolor te permite borrar tanto lápiz como tinta, lo que la hace extremadamente versátil y práctica. Además, su tamaño compacto y forma ergonómica la hacen fácil de manejar y cómoda de usar durante largos periodos de tiempo.\r\n\r\nLa goma bicolor Barrilito está hecha con materiales de alta calidad que garantizan un borrado suave y sin manchas. La goma blanca elimina fácilmente las marcas de lápiz, mientras que la goma roja borra tinta y otras marcas permanentes. Ya sea que estés borrando una simple línea o corrigiendo un trabajo completo, esta goma bicolor es la herramienta perfecta para el trabajo.\r\n\r\nCon su tamaño compacto y ligero, la goma bicolor Barrilito es fácil de llevar contigo a donde quiera que vayas. Ya sea que estés en la escuela, en la oficina o en tu estudio de arte, siempre tendrás una herramienta de alta calidad a mano para corregir errores en tus trabajos. Confía en la goma bicolor Barrilito para hacer el trabajo de manera rápida, eficiente y sin manchas.', 'goma-bicolor-barrilito.webp', 2, 'goma-bicolor-barrilito'),
(11, 'Lápiz Adhesivo Pritt', 10, 10, 'El lápiz adhesivo Pritt es la herramienta perfecta para aquellos que buscan una solución rápida y efectiva para pegar papel, cartón y otros materiales ligeros. Con su diseño ergonómico y suave, el lápiz se desliza suavemente sobre el papel para proporcionar una capa uniforme de adhesivo.\r\n\r\nEl adhesivo de Pritt es resistente y duradero, por lo que puede estar seguro de que sus proyectos permanecerán unidos durante mucho tiempo. Además, es lavable, por lo que no hay necesidad de preocuparse por manchar su ropa o superficies.\r\n\r\nEl lápiz adhesivo Pritt es fácil de usar y es la solución ideal para proyectos escolares, manualidades y trabajos de oficina. Además, su tamaño compacto lo hace fácil de transportar en una bolsa o estuche.\r\n\r\nNo busques más para una solución de adhesión confiable y conveniente. El lápiz adhesivo Pritt es la elección perfecta para todas tus necesidades de pegado.', 'lápiz-adhesivo-pritt.webp', 7, 'lápiz-adhesivo-pritt'),
(12, 'Mini Engrapadora Artesco', 25, 14, 'La mini engrapadora Artesco es una herramienta compacta y práctica que se adapta perfectamente a cualquier estuche de lápices o bolsillo. Con un tamaño pequeño pero poderoso, esta mini engrapadora es capaz de grapar hasta 12 hojas de papel de manera limpia y precisa.\r\n\r\nSu diseño ergonómico y resistente le proporciona un agarre cómodo y seguro, lo que facilita su uso para largos periodos de tiempo. Además, la mini engrapadora Artesco viene con una base de almacenamiento para grapas, lo que te permite tener fácil acceso a grapas adicionales cuando las necesites.\r\n\r\nCon su tamaño compacto y su capacidad de grapar hasta 12 hojas de papel, la mini engrapadora Artesco es la herramienta perfecta para estudiantes, profesionales y cualquier persona que necesite grapar documentos de manera rápida y eficiente mientras se desplaza. Olvídate de las molestias de grapar con herramientas grandes y pesadas, y lleva contigo la mini engrapadora Artesco donde quiera que vayas.', 'mini-engrapadora-artesco.webp', 9, 'mini-engrapadora-artesco'),
(13, 'Lápiz Adhesivo Dixon', 12, 16, 'El lápiz adhesivo Dixon es una herramienta de pegado eficiente y duradera para proyectos escolares, manualidades y trabajos de oficina. Con su diseño compacto y fácil de usar, el lápiz adhesivo Dixon se desliza sin esfuerzo sobre el papel para proporcionar una capa uniforme de adhesivo.\r\n\r\nEste lápiz adhesivo utiliza un adhesivo de alta calidad que garantiza una unión fuerte y duradera, lo que significa que tus proyectos permanecerán unidos durante mucho tiempo. Además, su fórmula no tóxica lo hace seguro para su uso en proyectos de arte y manualidades para niños.\r\n\r\nEl lápiz adhesivo Dixon también es lavable, por lo que no tienes que preocuparte por manchas en tu ropa o superficies. Su tamaño compacto lo hace fácil de transportar en una bolsa o estuche, lo que lo convierte en la elección perfecta para estudiantes, artistas y profesionales por igual.', 'lápiz-adhesivo-dixon.webp', 8, 'lápiz-adhesivo-dixon'),
(14, 'Cuaderno 100 Hojas Scribe', 30, 15, 'El cuaderno Scribe de 100 hojas es la herramienta perfecta para organizar y tomar notas en cualquier momento y lugar. Con su cubierta resistente y duradera, este cuaderno es capaz de soportar el uso diario y resistir el paso del tiempo.\r\n\r\nCada hoja del cuaderno Scribe está diseñada con líneas precisas y uniformes que facilitan la escritura y el dibujo. Además, las hojas son lo suficientemente gruesas para evitar que la tinta traspase la página, lo que garantiza un trabajo limpio y ordenado.\r\n\r\nEl tamaño del cuaderno Scribe es perfecto para llevarlo en una mochila, cartera o bolso de mano, lo que lo hace ideal para estudiantes, profesionales y cualquier persona que necesite tomar notas y organizar su trabajo mientras se desplaza. Con 100 hojas disponibles, este cuaderno te proporciona suficiente espacio para tomar notas durante varios días o incluso semanas.\r\n\r\nYa sea que lo utilices para tomar apuntes en la escuela, hacer listas de tareas en el trabajo o simplemente para escribir tus pensamientos, el cuaderno Scribe de 100 hojas es la herramienta perfecta para mantener tus pensamientos y trabajos organizados y al alcance de tu mano.', 'cuaderno-100-hojas-scribe.webp', 6, 'cuaderno-100-hojas-scribe'),
(15, 'Cuaderno 100 Hojas Barrilito', 35, 18, 'El cuaderno Barrilito de 100 hojas es una herramienta esencial para cualquier estudiante, profesional o persona que necesite tomar notas y organizar su trabajo de manera eficiente. Con su cubierta resistente y duradera, este cuaderno puede soportar el uso diario y resistir el paso del tiempo.\r\n\r\nCada hoja del cuaderno Barrilito está diseñada con líneas precisas y uniformes, lo que facilita la escritura y el dibujo. Además, las hojas son lo suficientemente gruesas para evitar que la tinta traspase la página, lo que garantiza un trabajo limpio y ordenado.\r\n\r\nEl tamaño del cuaderno Barrilito es perfecto para llevarlo en una mochila, cartera o bolso de mano, lo que lo hace ideal para tomar notas en la escuela, en el trabajo o incluso durante tus viajes. Con 100 hojas disponibles, tendrás suficiente espacio para tomar notas durante varios días o incluso semanas.\r\n\r\nAdemás, el cuaderno Barrilito cuenta con un diseño atractivo y funcional que lo hace fácil de usar. Con una encuadernación en espiral, podrás voltear las hojas sin problemas, lo que te permite acceder a tus notas de manera rápida y sencilla.', 'cuaderno-100-hojas-barrilito.webp', 2, 'cuaderno-100-hojas-barrilito'),
(16, 'Tijeras Punta Roma Barrilito', 18, 17, 'Las tijeras de punta roma Barrilito son la herramienta ideal para cortar papel, cartón, tela y otros materiales con precisión y facilidad. Con sus hojas de acero inoxidable, estas tijeras son duraderas y resistentes al desgaste.\r\n\r\nLas tijeras Barrilito están diseñadas con un mango ergonómico que se adapta cómodamente a tu mano, lo que te permite cortar durante largos períodos de tiempo sin fatiga en la mano. Además, las hojas de las tijeras están afiladas para cortar con precisión y evitar deshilachados.\r\n\r\nLas tijeras Barrilito de punta roma son ideales para cualquier trabajo que requiera cortes rectos y precisos. Desde cortar papel para manualidades hasta cortar tela para proyectos de costura, estas tijeras pueden manejar una amplia gama de materiales y tareas.\r\n\r\nCon un tamaño de 20 cm, estas tijeras son lo suficientemente grandes como para manejar tareas de corte de tamaño mediano, pero lo suficientemente pequeñas como para guardarlas en un cajón o bolsa de herramientas. Además, su diseño de alta calidad y su acabado elegante las hacen perfectas para cualquier ambiente de trabajo.', 'tijeras-punta-roma-barrilito.webp', 2, 'tijeras-punta-roma-barrilito'),
(17, 'Plumón para Pizarrón Azul Magistral', 30, 8, 'El plumón para pizarrón Azul Magistral es la herramienta perfecta para presentaciones en aulas, oficinas y reuniones. Con su tinta de color azul vibrante, este plumón garantiza una escritura clara y fácilmente visible en cualquier pizarra blanca o de vidrio.\r\n\r\nEl diseño de punta de bala del plumón para pizarrón Azul Magistral asegura una escritura suave y precisa, lo que permite crear líneas nítidas y legibles para tus presentaciones. Además, su tinta de secado rápido reduce las manchas y borrones para una presentación limpia y profesional.\r\n\r\nEste plumón para pizarrón también cuenta con una tapa con clip para un almacenamiento seguro y conveniente, lo que lo hace ideal para profesores, presentadores y profesionales que necesitan llevar su equipo de presentación con ellos.', 'plumón-para-pizarrón-azul-magistral.webp', 10, 'plumón-para-pizarrón-azul-magistral'),
(18, 'Calculadora Barrilito', 55, 18, 'La calculadora Barrilito es una herramienta indispensable para cualquier persona que necesite realizar cálculos precisos y rápidos. Con una pantalla clara y fácil de leer, esta calculadora puede mostrar hasta 10 dígitos y cuenta con todas las funciones básicas de cálculo, incluyendo sumar, restar, multiplicar y dividir.\r\n\r\nAdemás, la calculadora Barrilito es fácil de usar y cuenta con teclas grandes y suaves al tacto, lo que la hace cómoda para escribir incluso durante largas sesiones de trabajo. También tiene una tecla de retroceso para corregir errores de forma rápida y eficiente.\r\n\r\nEsta calculadora es compacta y fácil de transportar, lo que la hace ideal para llevarla en tu bolso o mochila. También tiene una función de apagado automático para prolongar la vida útil de la batería.\r\n\r\nYa sea que estés trabajando en tu hogar, oficina o en movimiento, la calculadora Barrilito te brinda la capacidad de realizar cálculos con precisión y rapidez. Su diseño simple pero eficiente la hace perfecta para cualquier tarea de cálculo, desde la contabilidad hasta la ciencia y la matemática.', 'calculadora-barrilito.webp', 2, 'calculadora-barrilito'),
(19, 'Corrector Líquido Bic', 18, 17, 'El corrector líquido Bic es la solución perfecta para corregir errores de escritura en papel, cartón y otros materiales similares. Con su punta de precisión, el corrector líquido Bic permite una aplicación suave y uniforme, lo que garantiza que tus correcciones sean precisas y efectivas.\r\n\r\nEste corrector líquido es de secado rápido, por lo que no tendrás que preocuparte por esperar demasiado tiempo para continuar con tu trabajo. Además, su fórmula de alta calidad garantiza una cobertura completa y duradera, lo que significa que tus correcciones permanecerán intactas durante mucho tiempo.\r\n\r\nEl diseño compacto del corrector líquido Bic lo hace fácil de transportar en un estuche o bolsillo, lo que lo convierte en una herramienta ideal para estudiantes, profesionales y cualquier persona que necesite corregir errores sobre la marcha.', 'corrector-líquido-bic.webp', 3, 'corrector-líquido-bic'),
(20, 'Corrector Cinta Bic', 25, 12, 'El corrector cinta Bic es un accesorio imprescindible para cualquier persona que necesita corregir errores en documentos escritos de forma rápida y sencilla. Este corrector está diseñado con una cinta de alta calidad que es capaz de cubrir completamente la mayoría de los errores, permitiendo que el texto quede completamente legible después de la corrección.\r\n\r\nEl corrector cinta Bic es fácil de usar y se desliza suavemente sobre la página, dejando una corrección limpia y uniforme. La cinta es opaca, lo que significa que no hay necesidad de preocuparse por manchas o transparencias en la corrección. Además, el diseño ergonómico del corrector lo hace fácil de sostener y usar cómodamente durante largas sesiones de trabajo.\r\n\r\nOtra gran ventaja del corrector cinta Bic es su durabilidad. La cinta es resistente a la rotura y a la decoloración, lo que significa que tus correcciones permanecerán nítidas y claras durante mucho tiempo después de haber sido aplicadas. También cuenta con un mecanismo de retroceso para corregir errores de forma rápida y precisa.\r\n\r\nEste corrector cinta Bic es compacto y fácil de transportar, lo que lo hace ideal para llevar en tu bolso, mochila o estuche de lápices. Ya sea que estés en la oficina, en la escuela o en cualquier otro lugar donde necesites realizar correcciones rápidas y precisas, el corrector cinta Bic es la solución perfecta para ti.', 'corrector-cinta-bic.webp', 3, 'corrector-cinta-bic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `proveedor_id` int(11) NOT NULL,
  `empresa` varchar(256) NOT NULL,
  `telefono` varchar(32) NOT NULL,
  `correo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `empresa`, `telefono`, `correo`) VALUES
(1, 'Dixon', '5512345678', 'contacto@dixon.com'),
(2, 'Barrilito', '5518989812', 'contacto@barrilito.com'),
(3, 'Bic', '5556745689', 'contacto@bic.com'),
(4, 'Paper Mate', '5514545675', 'contacto@paperMate.com'),
(5, 'Azor', '5556455689', 'contacto@azor.com'),
(6, 'Scribe', '5590216384', 'contacto@scribe.com'),
(7, 'Pritt', '5567897892', 'contacto@pritt.com'),
(8, 'Dixon', '5566909034', 'contacto@dixon.com'),
(9, 'Artesco', '5555555555', 'contacto@artesco.com'),
(10, 'Magistral', '5578989012', 'contacto@magistral.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(512) NOT NULL,
  `username` varchar(32) NOT NULL,
  `correo` varchar(256) NOT NULL,
  `contraseña` varchar(32) NOT NULL,
  `admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `username`, `correo`, `contraseña`, `admin`) VALUES
(1, 'gs', '', 'ada@gmail.com', '1750bd2975e54d55c9ffaffa6f6309c2', NULL),
(3, 'gs', '', 'ada@gmail.com', '1750bd2975e54d55c9ffaffa6f6309c2', NULL),
(4, 'Julio', '', 'julio@gmail.com', '1750bd2975e54d55c9ffaffa6f6309c2', NULL),
(5, 'Julio', '', 'julio1@gmail.com', '9450476b384b32d8ad8b758e76c98a69', NULL),
(6, 'a', '', 'b@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL),
(7, 'Julio Serrepe', 'asr7', 'julioserrepe1@gmail.com', '8f2e19735c9de5a93ad5763eac054375', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_padre` (`id_padre`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `compras_ibfk_1` (`usuario_id`);

--
-- Indices de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `detalles_compra_ibfk_1` (`compra_id`),
  ADD KEY `detalles_compra_ibfk_2` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `provedores` (`proveedor_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`proveedor_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `comentarios` (`id_comentario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD CONSTRAINT `detalles_compra_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_compra_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `provedores` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`proveedor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
