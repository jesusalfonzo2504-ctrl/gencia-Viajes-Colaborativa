<?php
include 'config.php'; // Asegúrate de tener el archivo config.php con la conexión
$mensaje = "";

// Procesar Inserción de Datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['registro_vuelo'])) {
        $origen = $conn->real_escape_string($_POST['origen']);
        $destino = $conn->real_escape_string($_POST['destino']);
        $fecha = $_POST['fecha'];
        $plazas = intval($_POST['plazas']);
        $precio = floatval($_POST['precio']);
        
        $sql = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) 
                VALUES ('$origen', '$destino', '$fecha', $plazas, $precio)";
        if($conn->query($sql)) {
            $mensaje = "<div class='notificacion-oferta'>✅ Vuelo a $destino registrado con éxito.</div>";
        }
    }

    if (isset($_POST['registro_hotel'])) {
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $ubicacion = $conn->real_escape_string($_POST['ubicacion']);
        $habitaciones = intval($_POST['habitaciones']);
        $tarifa = floatval($_POST['tarifa']);
        
        $sql = "INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche) 
                VALUES ('$nombre', '$ubicacion', $habitaciones, $tarifa)";
        if($conn->query($sql)) {
            $mensaje = "<div class='notificacion-oferta'>✅ Hotel $nombre registrado con éxito.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Servicios - Aventura Global</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validarForm(nombreForm) {
            let form = document.forms[nombreForm];
            let campos = form.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
            for (let campo of campos) {
                if (campo.value.trim() === "") {
                    alert("Por favor, complete el campo: " + (campo.placeholder || campo.name));
                    campo.focus();
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><h1>Gestión <span>Servicios</span></h1></div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="gestion_servicios.php" class="active">Administrar</a></li>
                    <li><a href="reporte_reservas.php">Reportes</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <?php echo $mensaje; ?>

            <div class="form-row" style="padding: 20px; gap: 20px;">
                <div class="form-container" style="flex: 1; margin: 0;">
                    <h2>✈️ Registrar Vuelo</h2>
                    <form name="fVuelo" method="POST" onsubmit="return validarForm('fVuelo')">
                        <div class="form-group"><input type="text" name="origen" placeholder="Ciudad de Origen"></div>
                        <div class="form-group"><input type="text" name="destino" placeholder="Ciudad de Destino"></div>
                        <div class="form-group"><input type="date" name="fecha"></div>
                        <div class="form-group"><input type="number" name="plazas" placeholder="Plazas Disponibles"></div>
                        <div class="form-group"><input type="number" step="0.01" name="precio" placeholder="Precio (USD)"></div>
                        <input type="submit" name="registro_vuelo" value="Guardar Vuelo" class="btn-buscar">
                    </form>
                </div>

                <div class="form-container" style="flex: 1; margin: 0;">
                    <h2>🏨 Registrar Hotel</h2>
                    <form name="fHotel" method="POST" onsubmit="return validarForm('fHotel')">
                        <div class="form-group"><input type="text" name="nombre" placeholder="Nombre del Hotel"></div>
                        <div class="form-group"><input type="text" name="ubicacion" placeholder="Ubicación/Ciudad"></div>
                        <div class="form-group"><input type="number" name="habitaciones" placeholder="Habitaciones"></div>
                        <div class="form-group"><input type="number" step="0.01" name="tarifa" placeholder="Tarifa por Noche"></div>
                        <input type="submit" name="registro_hotel" value="Guardar Hotel" class="btn-buscar">
                    </form>
                </div>
            </div>

            <section class="resultados-container" style="padding: 20px;">
                <h3>📊 Inventario Actual en Base de Datos</h3>
                <div class="form-row" style="gap: 20px; align-items: flex-start;">
                    <div style="flex: 1; background: #f9f9f9; padding: 15px; border-radius: 10px;">
                        <h4>Listado de Vuelos</h4>
                        <table style="width:100%; border-collapse: collapse; margin-top:10px;">
                            <tr style="background:#2c3e50; color:white;">
                                <th style="padding:10px;">Destino</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                            </tr>
                            <?php
                            $vuelos = $conn->query("SELECT * FROM VUELO ORDER BY id_vuelo DESC");
                            while($v = $vuelos->fetch_assoc()) {
                                echo "<tr style='border-bottom:1px solid #ddd; text-align:center;'>
                                        <td style='padding:8px;'>{$v['origen']} ➔ {$v['destino']}</td>
                                        <td>{$v['fecha']}</td>
                                        <td><strong>\${$v['precio']}</strong></td>
                                      </tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <div style="flex: 1; background: #f9f9f9; padding: 15px; border-radius: 10px;">
                        <h4>Listado de Hoteles</h4>
                        <table style="width:100%; border-collapse: collapse; margin-top:10px;">
                            <tr style="background:#4a6491; color:white;">
                                <th style="padding:10px;">Hotel</th>
                                <th>Ubicación</th>
                                <th>Tarifa</th>
                            </tr>
                            <?php
                            $hoteles = $conn->query("SELECT * FROM HOTEL ORDER BY id_hotel DESC");
                            while($h = $hoteles->fetch_assoc()) {
                                echo "<tr style='border-bottom:1px solid #ddd; text-align:center;'>
                                        <td style='padding:8px;'>{$h['nombre']}</td>
                                        <td>{$h['ubicacion']}</td>
                                        <td><strong>\${$h['tarifa_noche']}</strong></td>
                                      </tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>