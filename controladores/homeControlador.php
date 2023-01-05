<?php
require_once dirname(__FILE__) . '/' . '../modelos/homeModelo.php';
class homeControlador extends homeModelo
{
    public function consulta_informacion_puntos_home_controlador($tipo)
    {
        $consulta_puntos = homeModelo::consulta_informacion_puntos_home_modelo($tipo);

        $informacion_puntos = array();

        # Build GeoJSON feature collection array
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );

        while ($row = $consulta_puntos->fetch(PDO::FETCH_ASSOC)) {
            array_push($informacion_puntos, $row);

            $properties = $row;

            $feature = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        $row['lon'],
                        $row['lat']
                    )
                ),
                'properties' => $properties
            );
            # Add feature arrays to feature collection array
            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
