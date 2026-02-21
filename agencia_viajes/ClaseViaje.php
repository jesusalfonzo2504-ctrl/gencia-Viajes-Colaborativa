<?php
class FiltroViaje {
    private $ciudad;
    private $precioMaximo;
    private $categoriaHotel;
    private $tipoBusqueda; // Nueva propiedad para la actividad
    
    public function __construct($ciudad = '', $precioMax = 1500, $categoria = 'Todas', $tipo = 'paquete') {
        $this->ciudad = strtolower(trim($ciudad));
        $this->precioMaximo = (float)$precioMax;
        $this->categoriaHotel = $categoria;
        $this->tipoBusqueda = $tipo;
    }

    public function aplicarFiltros($destinos) {
        $resultados = [];
        foreach ($destinos as $destino) {
            $coincide = true;
            
            // Filtro por tipo (Vuelo o Paquete) - REQUISITO ACTIVIDAD
            if ($destino['tipo'] !== $this->tipoBusqueda) $coincide = false;
            
            // Filtro por ciudad (más flexible)
            if (!empty($this->ciudad) && strpos(strtolower($destino['ciudad']), $this->ciudad) === false) $coincide = false;
            
            // Filtro por precio
            if ($destino['precio'] > $this->precioMaximo) $coincide = false;
            
            // Filtro por categoría (solo si es paquete)
            if ($this->tipoBusqueda === 'paquete' && $this->categoriaHotel !== 'Todas' && $destino['categoria'] !== $this->categoriaHotel) {
                $coincide = false;
            }

            if ($coincide) $resultados[] = $destino;
        }
        return $resultados;
    }

    public function mostrarFiltroAplicado() {
        return "<div class='filtros-aplicados' style='padding:15px; background:#eef2ff; border-radius:8px; margin-bottom:20px;'>
                    <p>Buscando: <strong>" . ucfirst($this->tipoBusqueda) . "s</strong> en <strong>" . ($this->ciudad ?: 'Cualquier lugar') . "</strong> | Presupuesto: <strong>$" . $this->precioMaximo . "</strong></p>
                </div>";
    }
}
?>