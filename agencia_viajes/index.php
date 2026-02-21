<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agencia Aventura Global - Reserva en Línea</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><h1>Aventura <span>Global</span></h1></div>
            <nav>
                <ul>
                    <li><a href="index.php" class="active">Inicio</a></li>
                    <li><a href="formulario_viaje.php">Buscador</a></li>
                    <li><a href="carrito.php">Carrito (<?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>)</a></li>
                <li><a href="reporte_reservas.php" class="active">Reportes</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="hero" style="text-align: center; padding: 60px 20px;">
                <h2>Explora el mundo con confianza</h2>
                <p>Implementamos las mejores prácticas de seguridad y tecnología para tus reservas de vuelos y hoteles.</p>
                <div style="margin-top: 30px;">
                    <a href="formulario_viaje.php" class="btn-buscar" style="text-decoration:none; display:inline-block; width:auto; padding: 15px 40px;">Empezar mi Aventura</a>
                </div>
            </section>

            <section style="padding: 40px; background: #f4f7f6;">
                <h3 style="text-align:center; margin-bottom: 20px;">Nuestros Servicios Integrados</h3>
                <div style="display: flex; gap: 20px; justify-content: center;">
                    <div style="background:white; padding: 20px; border-radius: 10px; flex: 1; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h4>✈️ Vuelos</h4>
                        <p>Conexión en tiempo real con las principales aerolíneas.</p>
                    </div>
                    <div style="background:white; padding: 20px; border-radius: 10px; flex: 1; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        <h4>🏨 Hoteles</h4>
                        <p>Acuerdos exclusivos con cadenas de 3 a 5 estrellas.</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>