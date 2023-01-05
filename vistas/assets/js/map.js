var map = L.map('map').setView([19.4000, -99.1500], 11); // Andalucía

// Capas base
var cartodbLayer = L.tileLayer( 'http://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib3NjYXJhYWRyaWFuIiwiYSI6ImNqem11dmQ0cTAwZG4zbm54MXk3bGNyMHMifQ.tYkjBWxxWdamrOG9ESvYrw', {
   maxZoom: 18,
   opacity: 0.5
  }).addTo(map);

// Función para ventana de datos al hacer click sobre el punto

function popup(feature, layer) {
	if (feature.properties && feature.properties.pozo)
	{
		layer.bindPopup("<hr>"+"<strong> Estacion: </strong>"+feature.properties.pozo+"<br/>"+ "<strong> Ubicacion: </strong>"+feature.properties.pozo+"<br/>"+ "<strong> Factor: </strong>"+feature.properties.pozo+"<br/>");
	}
}
function drenaje(feature) {
  return {
    //weight: 3.3,
    color: '#424242',
    opacity: 1,
    //color: 'Red',
    fillOpacity: 0.5
  };
};
function limite(feature) {
  return {
    //weight: 3.3,
    color: '#FA5858',
    opacity: 1,
    //color: 'Red',
    fillOpacity: 0.5
  };
};
function colorGestion(g) {
    return g == 1020 ? 'blue' :
           g == 1001  ? 'orange' :
                      'red';
}

function estaciones(feature, latlon) {
  return L.circleMarker(latlon, {
    radius: 5.0,
    //fillColor: 'red',
    fillColor: colorGestion(feature.properties.pozo),
    color: '#FFFFFF',
    weight: 2,
    opacity: 1.0,
    fillOpacity: 1.0
  })
}

var limite = L.geoJson(null, {
	style : limite,
	onEachFeature: popup
});
$.getJSON("PCDMXline.geojson", function (data3) {
	limite.addData(data3);
});
limite.addTo(map);

var estaciones = L.geoJson(null, {
	onEachFeature: popup,
	pointToLayer: estaciones,
});
$.getJSON("pozos.geojson", function (data) {
	estaciones.addData(data);
});
estaciones.addTo(map);


//var drenaje = L.geoJson(null, {
	//style : drenaje,
	//onEachFeature: popup
//});
//$.getJSON("Drenaje.geojson", function (data2) {
	//drenaje.addData(data2);
//});
//drenaje.addTo(map);






//Inicia control de Capas
var baseMaps = {
    "Google": cartodbLayer
};

var overlayMaps = {
	"Perimetro CDMX": limite,
    "Estaciones Pluviometricas": estaciones

};

L.control.layers(baseMaps, overlayMaps,{
    position: 'topright', // 'topleft', 'bottomleft', 'bottomright'
    collapsed: false // true
}).addTo(map);
