const decimalsPlaces=2;
var zoom = 11;

var limite = L.geoJson(null, {
  style: limite,
  //onEachFeature: popup
});
var drenaje = L.geoJson(null, {
  style: drenaje,
  //onEachFeature: popup
});

var tanques = L.geoJson(null, {
  onEachFeature: popupTanques,
  pointToLayer: marcadores,
});
var subestaciones = L.geoJson(null, {
  onEachFeature: popupSubestaciones,
  pointToLayer: marcadores,
});


var plantas_rebombeo = L.geoJson(null, {
  onEachFeature: popupPlantasRebombeo,
  pointToLayer: marcadores,
});
var map = L.map('map').setView([19.3878, -99.1500], zoom);

var cartodbLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


$(document).ready(function () {



  //Inicia control de Capas
  var baseMaps = {
    "Seleccion de capas": cartodbLayer
  };

  var overlayMaps = {
    //"Perimetro CDMX": limite,
    "Tanques": tanques,
    "Subestaciones": subestaciones,
    "Plantas rebombeo": plantas_rebombeo

  };
  L.control.layers(baseMaps, overlayMaps, {
    position: 'topright', // 'topleft', 'bottomleft', 'bottomright'
    collapsed: false // true
  }).addTo(map);


  /* $.getJSON(serverurl+"/vistas/assets/geojson/PCDMXline.geojson", function (data) {
     console.log(data)
     limite.addData(data);
   });
   limite.addTo(map);*/

  getDataPuntos("plantas_rembombeo").then(data => {
    //console.log(data)
    plantas_rebombeo.addData(data)
    plantas_rebombeo.addTo(map)
  });

  getDataPuntos("tanques").then(data => {
    // console.log(data)
    tanques.addData(data)
    tanques.addTo(map)
  });

  getDataPuntos("subestaciones").then(data => {
    // console.log(data)
    subestaciones.addData(data)
    subestaciones.addTo(map)
  });




})



function getDataPuntos($tipo) {

  var data = [];
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: serverurl + "ajax/homeAjax.php",
      method: "post",
      error: function (e) {
        console.log(e)
        reject(e)
      },
      dataType: "json",
      data: { "accion": "CONSULTA", "tipo_puntos": $tipo },
      success: (res) => {
        console.log(res)
        data = res
        resolve(data);
      },
      timeout: 4000
    })
  })
  //console.log(data)

}

// Función para ventana de datos al hacer click sobre el punto

function popupPlantasRebombeo(feature, layer) {
  feature.properties.gasto = parseFloat(feature.properties.gasto).toFixed(decimalsPlaces);
  feature.properties.tirante = parseFloat(feature.properties.tirante).toFixed(decimalsPlaces);
  layer.bindPopup(`
<b>Nombre planta: </b> ${feature.properties.punto} <br></br>
<b>Ultima hora ingresada: </b> ${feature.properties.hora_programada} <br>
<b>Tirante: </b> ${feature.properties.tirante} <br>
<b>Gasto: </b> ${feature.properties.gasto} <br>
<b>Bomba(s): </b> ${feature.properties.bomba} <br>
`);

}

// Función para ventana de datos al hacer click sobre el punto

function popupTanques(feature, layer) {


  feature.properties.descarga_uno = parseFloat(feature.properties.descarga_uno).toFixed(decimalsPlaces);
  feature.properties.descarga_dos = parseFloat(feature.properties.descarga_dos).toFixed(decimalsPlaces);
  feature.properties.descarga_tres = parseFloat(feature.properties.descarga_tres).toFixed(decimalsPlaces);
  feature.properties.tirante_uno = parseFloat(feature.properties.tirante_uno).toFixed(decimalsPlaces);
  feature.properties.tirante_dos = parseFloat(feature.properties.tirante_dos).toFixed(decimalsPlaces);
  feature.properties.tirante_tres = parseFloat(feature.properties.tirante_tres).toFixed(decimalsPlaces);
  feature.properties.tirante_cuatro = parseFloat(feature.properties.tirante_cuatro).toFixed(decimalsPlaces);
  layer.bindPopup(`
  <b>Nombre tanque: </b> ${feature.properties.tanque} <br></br> 
  <b>Ultima hora ingresada: </b> ${feature.properties.fecha_hora_programada} <br>
  <b>Bypass: </b> ${feature.properties.bypass} <br>
  <b>Descarga uno: </b> ${feature.properties.descarga_uno} <br>
  <b>Descarga dos: </b> ${feature.properties.descarga_dos} <br>
  <b>Descarga tres: </b> ${feature.properties.descarga_tres} <br>
  
  <b>Eq1: </b> ${feature.properties.eq1} <br>
  <b>Eq2: </b> ${feature.properties.eq2} <br>
  <b>Eq3: </b> ${feature.properties.eq3} <br>
  <b>Eq4: </b> ${feature.properties.eq4} <br>
  <b>Eq5: </b> ${feature.properties.eq5} <br>
  <b>Equipos: </b> ${feature.properties.equipos} <br>

  <b>Tirante uno: </b> ${feature.properties.tirante_uno} <br>
  <b>Tirante dos: </b> ${feature.properties.tirante_dos} <br>
  <b>Tirante tres: </b> ${feature.properties.tirante_tres} <br>
  <b>Tirante cuatro: </b> ${feature.properties.tirante_cuatro} <br>`);

}
// Función para ventana de datos al hacer click sobre el punto

function popupSubestaciones(feature, layer) {
  feature.properties.amperaje = parseFloat(feature.properties.amperaje).toFixed(decimalsPlaces);
  layer.bindPopup(`
<b>Nombre subestacion: </b> ${feature.properties.subestacion} <br></br>
<b>Ultima hora ingresada: </b> ${feature.properties.fecha_hora_programada} <br>
<b>Amperaje: </b> ${feature.properties.amperaje} <br>
`);

}



function marcadores(feature, latlng) {
  return L.marker(latlng)
}