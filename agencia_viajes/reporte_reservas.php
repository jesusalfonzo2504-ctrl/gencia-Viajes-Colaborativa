<?php
include 'config.php';

// Consulta para el punto 3.3: Hoteles con más de 2 reservas
$sql_avanzada = "SELECT h.nombre, h.ubicacion, COUNT(r.id_reserva) as total_reservas 
                 FROM HOTEL h 
                 INNER JOIN RESERVA r ON h.id_hotel = r.id_hotel 
                 GROUP BY h.id_hotel 
                 HAVING total_reservas > 2";

$result_avanzada = $conn->query($sql_avanzada);

// Consulta para el listado general de reservas (punto 3.2)
$sql_general = "SELECT r.id_reserva, r.fecha_reserva, v.destino, h.nombre as hotel 
                FROM RESERVA r
                JOIN VUELO v ON r.id_vuelo = v.id_vuelo
                JOIN HOTEL h ON r.id_hotel = h.id_hotel
                ORDER BY r.fecha_reserva DESC";
$result_general = $conn->query($sql_general);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Reservas - Aventura Global</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><h1>Reportes <span>Avanzados</span></h1></div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="gestion_servicios.php">Gestión</a></li>
                    <li><a href="reporte_reservas.php" class="active">Reportes</a></li>
                </ul>
            </nav>
        </header>

        <main style="padding: 20px;">
            <div class="filtros-aplicados">
                <h3>🏆 Hoteles con Alta Demanda</h3>
                <p>Análisis de hoteles que registran más de 2 reservaciones activas.</p>
            </div>

            <table style="width:100%; border-collapse: collapse; background: white; margin-bottom: 40px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <thead>
                    <tr style="background-color: #764ba2; color: white; text-align: center;">
                        <th style="padding:15px;">Nombre del Hotel</th>
                        <th>Ubicación</th>
                        <th>Total Reservas</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result_avanzada->num_rows > 0): ?>
                        <?php while($row = $result_avanzada->fetch_assoc()): ?>
                        <tr style="text-align: center; border-bottom: 1px solid #eee;">
                            <td style="padding:12px;"><strong><?php echo $row['nombre']; ?></strong></td>
                            <td><?php echo $row['ubicacion']; ?></td>
                            <td><?php echo $row['total_reservas']; ?></td>
                            <td><span class="disponibilidad disponible">Alta Ocupación</span></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="padding:20px; text-align:center; color:gray;">No hay hoteles con más de 2 reservas actualmente.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h3>📋 Registro Histórico de Reservas</h3>
            <table style="width:100%; border-collapse: collapse; background: white; text-align: center;">
                <thead>
                    <tr style="background: #4a6491; color: white;">
                        <th style="padding:10px;">ID Reserva</th>
                        <th>Fecha</th>
                        <th>Vuelo Destino</th>
                        <th>Hotel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($res = $result_general->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding:10px;"><?php echo $res['id_reserva']; ?></td>
                        <td><?php echo $res['fecha_reserva']; ?></td>
                        <td>✈️ <?php echo $res['destino']; ?></td>
                        <td>🏨 <?php echo $res['hotel']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>