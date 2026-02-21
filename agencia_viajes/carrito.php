<?php
session_start();
// Medida para evitar expiración: Actualizar último acceso
$_SESSION['ultimo_acceso'] = time();

if (isset($_GET['vaciar'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito - Agencia de Viajes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><h1>Tu <span>Carrito</span></h1></div>
            <nav><ul><li><a href="index.php">Inicio</a></li><li><a href="formulario_viaje.php">Seguir Buscando</a></li></ul></nav>
        </header>
        <main>
            <div class="form-container">
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #667eea;">
                                <th style="padding: 10px; text-align: left;">Paquete Turístico</th>
                                <th style="padding: 10px; text-align: right;">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            foreach ($_SESSION['carrito'] as $item): 
                                $total += $item['precio'];
                            ?>
                            <tr>
                                <td style="padding: 10px;"><?php echo "{$item['ciudad']} - {$item['categoria']}"; ?></td>
                                <td style="padding: 10px; text-align: right;">$<?php echo number_format($item['precio'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold; background: #f8f9fa;">
                                <td style="padding: 10px;">Total a Pagar</td>
                                <td style="padding: 10px; text-align: right;">$<?php echo number_format($total, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div style="display: flex; gap: 10px;">
                        <a href="?vaciar=1" class="btn-volver" style="background:#dc3545;">Vaciar Carrito</a>
                        <button onclick="alert('Conectando con pasarela segura...')" class="btn-buscar">Pagar Ahora</button>
                    </div>
                <?php else: ?>
                    <div class="mensaje-info">No has seleccionado ningún paquete aún.</div>
                    <a href="formulario_viaje.php" class="btn-volver">Ir a buscar viajes</a>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>