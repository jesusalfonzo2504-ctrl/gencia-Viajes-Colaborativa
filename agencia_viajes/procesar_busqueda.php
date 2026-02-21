<?php
session_start();
require_once 'ClaseViaje.php';

// Inventario con tipos diferenciados (Punto 1 y 2 de la actividad)
$destinosDisponibles = [
    ['id' => 1, 'tipo' => 'paquete', 'ciudad' => 'París', 'pais' => 'Francia', 'precio' => 1200, 'categoria' => '4 estrellas', 'img' => '🏨'],
    ['id' => 2, 'tipo' => 'paquete', 'ciudad' => 'Cancún', 'pais' => 'México', 'precio' => 900, 'categoria' => '5 estrellas', 'img' => '🏨'],
    ['id' => 101, 'tipo' => 'vuelo', 'ciudad' => 'Madrid', 'pais' => 'España', 'precio' => 450, 'categoria' => 'Económica', 'img' => '✈️'],
    ['id' => 102, 'tipo' => 'vuelo', 'ciudad' => 'Nueva York', 'pais' => 'USA', 'precio' => 550, 'categoria' => 'Económica', 'img' => '✈️'],
    ['id' => 103, 'tipo' => 'vuelo', 'ciudad' => 'Tokio', 'pais' => 'Japón', 'precio' => 1100, 'categoria' => 'Business', 'img' => '✈️']
];

// Captura de datos del formulario
$tipo = $_POST['tipo_busqueda'] ?? 'paquete';
$ciudad = $_POST['ciudad'] ?? '';
$precio = $_POST['precio_max'] ?? 5000;
$cat = $_POST['categoria'] ?? 'Todas';

// Instanciar clase y filtrar
$filtro = new FiltroViaje($ciudad, $precio, $cat, $tipo);
$resultados = $filtro->aplicarFiltros($destinosDisponibles);

// Lógica de carrito
if (isset($_POST['add_item'])) {
    if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];
    foreach ($destinosDisponibles as $d) {
        if ($d['id'] == $_POST['add_item']) {
            $_SESSION['carrito'][] = $d;
            header("Location: carrito.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Resultados - Aventura Global</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><h1>Aventura <span>Global</span></h1></div>
            <nav><ul><li><a href="index.php">Inicio</a></li><li><a href="formulario_viaje.php">Nueva Búsqueda</a></li></ul></nav>
        </header>
        <main style="padding: 20px;">
            <?php echo $filtro->mostrarFiltroAplicado(); ?>

            <div class="resultados-container">
                <?php if (!empty($resultados)): ?>
                    <?php foreach ($resultados as $res): ?>
                        <div class="destino-card">
                            <div class="destino-info">
                                <h3><?php echo $res['img'] . " " . $res['ciudad']; ?></h3>
                                <p><?php echo $res['pais']; ?> - <?php echo $res['categoria']; ?></p>
                                <p class="destino-precio">$<?php echo $res['precio']; ?> USD</p>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="add_item" value="<?php echo $res['id']; ?>">
                                <button type="submit" class="btn-reservar">Seleccionar</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align:center; padding: 50px;">
                        <p>No se encontraron resultados. Intenta aumentar el presupuesto o buscar por "Vuelos".</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>