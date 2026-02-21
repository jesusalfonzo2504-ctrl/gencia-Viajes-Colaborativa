<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscador - Agencia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><h1>Aventura <span>Global</span></h1></div>
            <nav><ul><li><a href="index.php">Inicio</a></li></ul></nav>
        </header>
        <main>
            <div class="form-container">
                <h2>¿Qué deseas buscar hoy?</h2>
                <form action="procesar_busqueda.php" method="POST">
                    <div class="form-group" style="text-align:center; margin-bottom:20px;">
                        <label>Tipo de servicio:</label><br>
                        <select name="tipo_busqueda" class="btn-secundario" style="width:200px; background:white; color:black; border:1px solid #ccc;">
                            <option value="paquete">🏨 Paquetes Turísticos</option>
                            <option value="vuelo">✈️ Solo Vuelos</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ciudad">Ciudad Destino:</label>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Ej: París">
                        </div>
                        <div class="form-group">
                            <label for="precio_max">Presupuesto Máximo (USD):</label>
                            <input type="number" name="precio_max" value="2000" style="width:100%; padding:8px; border-radius:5px; border:1px solid #ddd;">
                        </div>
                    </div>
                    <input type="submit" value="Buscar Ahora" class="btn-buscar">
                </form>
            </div>
        </main>
    </div>
</body>
</html>