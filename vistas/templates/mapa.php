<!DOCTYPE html>
<html>
<main>
<div class="col s12">

    <head>
        <title>A Leaflet map!</title>
 <link rel="stylesheet" href="http://unpkg.com/leaflet@1.0.3/dist/leaflet.css"
 integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ=="
 crossorigin=""/>
<script src="http://unpkg.com/leaflet@1.0.3/dist/leaflet.js"
 integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg=="
 crossorigin=""></script>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="leaflet/leaflet-heat.js"></script>
<script type="text/javascript" src="http://187.216.198.249:8020/cdn/js/libs/leaflet.js"></script>
<style>
  #map{ height: 100% }
</style>
        <style>
            body {
                margin: 0px;
            }



            #map {
                position: absolute;
                height: 100%;
                width: 100%;
                background-color: #333;
            }


        </style>
    </head>

    <script src="http://unpkg.com/leaflet-ant-path" type="text/javascript"></script>



    <body>
    <nav class="green" role="navigation">

            <div class="nav-wrapper">
                <div class="brand-logo center">
                    <ul>
                        <li>
                            <h4 style=" line-height: 73%; margin: 1rem 0; text-align: center;">Propuesta de la Visualización del Mapa</h4>
                        </li>
                    </ul>
                </div>
                <ul class="right">

            
                </ul>
            </div>
        </nav>
        <div id="map"></div>
    </body>
    <script>


        //------------------------------------------------------------------------

var map = L.map('map').setView([19.4000, -99.1500], 11); // CDMX

var cartodbLayer = L.tileLayer( 'http://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib3NjYXJhYWRyaWFuIiwiYSI6ImNqem11dmQ0cTAwZG4zbm54MXk3bGNyMHMifQ.tYkjBWxxWdamrOG9ESvYrw', {
   maxZoom: 18,
   //opacity: 0.5
  }).addTo(map);

var CartoDB_DarkMatter = L.tileLayer('http://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="http://carto.com/attributions">CARTO</a>',
  subdomains: 'abcd',
  maxZoom: 19
});



map.setZoom(11); var coords=[]; var route=[[
  [
  [ 19.950874, -99.298781],
  [ 19.932801, -99.290008],
  [ 19.921276, -99.285271],
  [ 19.907866, -99.279409],
  [ 19.893797, -99.273185],
  [ 19.874486, -99.265386],
  [ 19.853387, -99.259324],
  [ 19.840073, -99.255495],
  [ 19.825751, -99.251712],
  [ 19.813000, -99.247858],
  [ 19.802813, -99.246652],
  [ 19.803242, -99.246677],
  [ 19.791099, -99.241125],
  [ 19.770023, -99.235323],
  [ 19.755985, -99.231404],
  [ 19.732347, -99.227147],
  [ 19.711922, -99.228480],
  [ 19.704678, -99.223692],
  [ 19.688489, -99.221771],
  [ 19.663260, -99.220419],
  [ 19.640257, -99.219210],
  [ 19.617901, -99.217888],
  [ 19.603943, -99.212597],
  [ 19.593467, -99.204536],
  [ 19.585360, -99.198340],
  [ 19.575269, -99.185986],
  [ 19.550727, -99.168576],
  [ 19.528994, -99.179766],
  [ 19.511456, -99.176462],
  [ 19.495144, -99.172626],
  [ 19.476538, -99.175093],
  [ 19.468195, -99.176486],
  [ 19.456673, -99.178606],
  [ 19.437325, -99.183051],
  [ 19.425929, -99.185401],
  [ 19.413123, -99.191951],
  [ 19.408374, -99.193834],
  [ 19.405464, -99.194208],
  [ 19.398619, -99.192260],
  [ 19.393429, -99.192768],
  [ 19.382849, -99.191587],
  [ 19.370627, -99.191117],
  [ 19.367454, -99.191729],
  [ 19.363502, -99.191715],
  [ 19.361235, -99.192208],
  [ 19.353450, -99.190707],
  [ 19.346399, -99.191546],
  [ 19.339676, -99.191535],
  [ 19.336437, -99.191845]
  ],
  [
  [ 19.471350, -99.228311],
  [ 19.464019, -99.224211],
  [ 19.456261, -99.219827],
  [ 19.454235, -99.219454],
  [ 19.450996, -99.218222],
  [ 19.445259, -99.214469],
  [ 19.442361, -99.209545],
  [ 19.435707, -99.209617],
  [ 19.426958, -99.210886],
  [ 19.420732, -99.207313],
  [ 19.416683, -99.197306],
  [ 19.413874, -99.194139],
  [ 19.408385, -99.193851]
  ],
  [
  [ 19.550369, -99.168627],
  [ 19.532740, -99.157166],
  [ 19.531568, -99.156517],
  [ 19.524613, -99.158687],
  [ 19.520098, -99.157440],
  [ 19.512918, -99.154423],
  [ 19.496891, -99.147678],
  [ 19.478503, -99.140442],
  [ 19.470511, -99.137146],
  [ 19.460063, -99.144138],
  [ 19.458499, -99.143653],
  [ 19.447910, -99.146079],
  [ 19.434113, -99.149202],
  [ 19.423646, -99.153537],
  [ 19.417908, -99.154121],
  [ 19.417252, -99.147164],
  [ 19.410490, -99.148348],
  [ 19.400145, -99.150236],
  [ 19.399919, -99.153780],
  [ 19.399694, -99.157691]
  ],
  [
  [ 19.410490, -99.148348],
  [ 19.409079, -99.132210],
  [ 19.409915, -99.120399],
  [ 19.409769, -99.112924]
  ],
  [
  [ 19.531724, -99.156262],
  [ 19.526749, -99.141052],
  [ 19.519374, -99.123703],
  [ 19.499112, -99.109891],
  [ 19.488028, -99.101373],
  [ 19.486213, -99.096937],
  [ 19.484875, -99.094223],
  [ 19.477099, -99.097495],
  [ 19.474446, -99.091681],
  [ 19.457207, -99.097978],
  [ 19.438894, -99.105133],
  [ 19.432742, -99.108042],
  [ 19.431848, -99.108893],
  [ 19.431313, -99.109736],
  [ 19.430913, -99.111116],
  [ 19.430813, -99.112890],
  [ 19.431141, -99.115610],
  [ 19.431403, -99.117141]
  ],
  [
  [ 19.432834, -99.107915],
  [ 19.425797, -99.111145],
  [ 19.409766, -99.112859],
  [ 19.399389, -99.113443],
  [ 19.394283, -99.112785],
  [ 19.390379, -99.113482],
  [ 19.386964, -99.111762],
  [ 19.379094, -99.110341],
  [ 19.375618, -99.108298],
  [ 19.373278, -99.107824],
  [ 19.371897, -99.107452],
  [ 19.368696, -99.107452],
  [ 19.354516, -99.111404],
  [ 19.352314, -99.110131],
  [ 19.347827, -99.110649],
  [ 19.336655, -99.113307],
  [ 19.319076, -99.113436],
  [ 19.315463, -99.098278],
  [ 19.302293, -99.086509],
  [ 19.290772, -99.076962]
  ],
  [
  [ 19.353719, -99.133470],
  [ 19.349383, -99.120255],
  [ 19.336558, -99.113306],
  [ 19.318949, -99.113253],
  [ 19.316980, -99.112711],
  [ 19.313466, -99.110726],
  [ 19.311358, -99.110299],
  [ 19.305358, -99.111745],
  [ 19.299917, -99.113206]
  ],
  [
  [ 19.950411, -99.296436],
  [ 19.945286, -99.294689],
  [ 19.944270, -99.294213],
  [ 19.943012, -99.293404],
  [ 19.941922, -99.292572],
  [ 19.940804, -99.291410],
  [ 19.936424, -99.286015],
  [ 19.929761, -99.278145],
  [ 19.920184, -99.269077],
  [ 19.919607, -99.268751],
  [ 19.904381, -99.262062],
  [ 19.899976, -99.260277],
  [ 19.898913, -99.259638],
  [ 19.898101, -99.258941],
  [ 19.897123, -99.257997],
  [ 19.886557, -99.244257],
  [ 19.879097, -99.234670],
  [ 19.875375, -99.230023],
  [ 19.871612, -99.225502],
  [ 19.868610, -99.222008],
  [ 19.867458, -99.221139],
  [ 19.864513, -99.219440],
  [ 19.853239, -99.212549],
  [ 19.842420, -99.206384],
  [ 19.837529, -99.203925],
  [ 19.825467, -99.197934],
  [ 19.813571, -99.194350],
  [ 19.812057, -99.193551],
  [ 19.791921, -99.170008],
  [ 19.785837, -99.166332],
  [ 19.782128, -99.162819],
  [ 19.778045, -99.159701],
  [ 19.765160, -99.149267],
  [ 19.761477, -99.143299],
  [ 19.751906, -99.129806],
  [ 19.749883, -99.126920],
  [ 19.749364, -99.125604],
  [ 19.749139, -99.124297],
  [ 19.748906, -99.116873],
  [ 19.748827, -99.110421],
  [ 19.748306, -99.108748],
  [ 19.747660, -99.107240],
  [ 19.746386, -99.105865],
  [ 19.744875, -99.104967],
  [ 19.719964, -99.092872],
  [ 19.699278, -99.082429],
  [ 19.662200, -99.064507],
  [ 19.578855, -99.024749],
  [ 19.577225, -99.025659],
  [ 19.568310, -99.032061],
  [ 19.529590, -99.059519],
  [ 19.512367, -99.071764],
  [ 19.507093, -99.074756],
  [ 19.503910, -99.076236],
  [ 19.501220, -99.076563],
  [ 19.481449, -99.086260],
  [ 19.480756, -99.086612],
  [ 19.474602, -99.091610],
  [ 19.457030, -99.098078]
  ],
  [
  [ 19.425870, -99.111095],
  [ 19.415821, -99.092303],
  [ 19.407005, -99.075678],
  [ 19.396618, -99.059612],
  [ 19.386923, -99.042757],
  [ 19.379931, -99.030307],
  [ 19.384254, -99.025067],
  [ 19.380086, -99.016902],
  [ 19.371542, -99.002093]
  ],
  [
  [ 19.484869, -99.094272],
  [ 19.482026, -99.085969]
  ],
  [
  [ 19.396524, -99.059772],
  [ 19.387176, -99.059232],
  [ 19.374547, -99.061012],
  [ 19.361845, -99.066274],
  [ 19.357874, -99.063249],
  [ 19.352579, -99.063862],
  [ 19.347777, -99.064129],
  [ 19.339245, -99.063972],
  [ 19.332117, -99.064324]
  ],
  [
  [ 19.377569, -99.095081],
  [ 19.377394, -99.080513],
  [ 19.375861, -99.068949],
  [ 19.374601, -99.061088],
  [ 19.371194, -99.050983],
  [ 19.370327, -99.045403]
  ],
  [
  [ 19.485941, -99.012029],
  [ 19.482462, -99.029698],
  [ 19.490900, -99.047101],
  [ 19.495493, -99.058470],
  [ 19.498485, -99.064386],
  [ 19.503281, -99.076274]
  ]
]];
route.forEach(function(e, i){coords.push(e.reverse())});
var antPath = L.polyline.antPath; var path = antPath(coords, { "paused": false, "reverse": true, "delay": 3000,"dashArray": [10, 20], "weight": 6, "opacity": 1, "color": "#000000", "pulseColor": "#999999" }); 
path.addTo(map);

function limite(feature) {
  return {
    //weight: 3.3,
    color: '#FA5858',
    opacity: 1,
    //color: 'Red',
    fillOpacity: 0.5
  };
};
var limite = L.geoJson(null, {
    style : limite
    //onEachFeature: popup
});
$.getJSON("PCDMXline.geojson", function (data3) {
    limite.addData(data3);
});
limite.addTo(map);



      $.ajax({
    url: 'fugas2019.php',
    dataType: 'json',
    async: false,
    success: function(data19) {
        addressPoints19 = data19;
    }
});
    var addressPoints119 = addressPoints19;
    

    var heat19 = L.heatLayer(addressPoints119, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    heat19.addTo(map);


  $.ajax({
    url: 'diametro/medio.php',
    dataType: 'json',
    async: false,
    success: function(data) {
        addressPoints = data;
    }
});
    var addressPoints1 = addressPoints;
    

    var heat1 = L.heatLayer(addressPoints1, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat1.addTo(map);

      $.ajax({
    url: 'diametro/6.php',
    dataType: 'json',
    async: false,
    success: function(data17) {
        addressPoints17 = data17;
    }
});
    var addressPoints117 = addressPoints17;
    

    var heat17 = L.heatLayer(addressPoints117, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat17.addTo(map);

    $.ajax({
    url: 'diametro/sd.php',
    dataType: 'json',
    async: false,
    success: function(datasd) {
        addressPoints11sd = datasd;
    }
});
    var addressPoints1sd = addressPoints11sd;
    

    var heat1sd = L.heatLayer(addressPoints1sd, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat1sd.addTo(map);

   $.ajax({
    url: 'diametro/4.php',
    dataType: 'json',
    async: false,
    success: function(data4) {
        addressPoints4 = data4;
    }
});
    var addressPoint4 = addressPoints4;
    

    var heat4 = L.heatLayer(addressPoint4, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat4.addTo(map);


  $.ajax({
    url: 'diametro/12.php',
    dataType: 'json',
    async: false,
    success: function(data12) {
        addressPoints12 = data12;
    }
});
    var addressPoint12 = addressPoints12;
    

    var heat12 = L.heatLayer(addressPoint12, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat12.addTo(map);

  $.ajax({
    url: 'diametro/12.php',
    dataType: 'json',
    async: false,
    success: function(data12) {
        addressPoints12 = data12;
    }
});
    var addressPoint12 = addressPoints12;
    

    var heat12 = L.heatLayer(addressPoint12, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat12.addTo(map);

  $.ajax({
    url: 'diametro/1.php',
    dataType: 'json',
    async: false,
    success: function(datauno) {
        addressPointsuno = datauno;
    }
});
    var addressPointuno = addressPointsuno;
    

    var heatuno = L.heatLayer(addressPointuno, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heatuno.addTo(map);
$.ajax({
    url: 'diametro/2.php',
    dataType: 'json',
    async: false,
    success: function(datados) {
        addressPointsdos = datados;
    }
});
    var addressPointdos = addressPointsdos;
    

    var heatdos = L.heatLayer(addressPointdos, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heatdos.addTo(map);

$.ajax({
    url: 'diametro/3.php',
    dataType: 'json',
    async: false,
    success: function(datatres) {
        addressPointstres = datatres;
    }
});
    var addressPointtres = addressPointstres;
    

    var heattres = L.heatLayer(addressPointtres, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heattres.addTo(map);

$.ajax({
    url: 'diametro/5.php',
    dataType: 'json',
    async: false,
    success: function(datacinco) {
        addressPointscinco = datacinco;
    }
});
    var addressPointcinco = addressPointscinco;
    

    var heatcinco = L.heatLayer(addressPointcinco, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heatcinco.addTo(map);

$.ajax({
    url: 'diametro/8.php',
    dataType: 'json',
    async: false,
    success: function(dataocho) {
        addressPointsocho = dataocho;
    }
});
    var addressPointocho = addressPointsocho;
    

    var heatocho = L.heatLayer(addressPointocho, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heatocho.addTo(map);
$.ajax({
    url: 'diametro/10.php',
    dataType: 'json',
    async: false,
    success: function(datadiez) {
        addressPointsdiez = datadiez;
    }
});
    var addressPointdiez = addressPointsdiez;
    

    var heatdiez = L.heatLayer(addressPointdiez, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heatdiez.addTo(map);

    $.ajax({
    url: 'diametro/12.php',
    dataType: 'json',
    async: false,
    success: function(datadoce) {
        addressPointsdoce = datadoce;
    }
});
    var addressPointdoce = addressPointsdoce;
    

    var heatdoce = L.heatLayer(addressPointdoce, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heatdoce.addTo(map);

    $.ajax({
    url: 'diametro/16.php',
    dataType: 'json',
    async: false,
    success: function(data16) {
        addressPoints16 = data16;
    }
});
    var addressPoint16 = addressPoints16;
    

    var heat16 = L.heatLayer(addressPoint16, {
        radius : 15, // default value
        //fillColor: 'yellow',
        //blur : 5, // default value
         gradient: {
           0.10: 'rgb(0,0,255)',
           //0.20: 'rgb(0, 250, 250)',
           0.30: 'rgb(0,0,255)',
           0.40: 'rgb(0,0,255)',
           0.50: 'rgb(0,0,255)',
           0.60: 'rgb(0,255,0)',//verde
           0.70: 'rgb(0,255,0)',//verde
           0.80: 'rgb(255,255,0)',
          0.85 : 'rgb(255,0,0)'
       } 
    });
    //heat16.addTo(map);




//Inicia control de Capas
var baseMaps = {
    "Google": cartodbLayer,
    "Carto": CartoDB_DarkMatter
};
var baseMaps1 = {
    
};


//L.control.layers(baseMaps, overlayMaps).addTo(map);
var layertopleft = new L.control.layers(baseMaps, overlayMaps).addTo(map);
var layerbotleft = new L.control.layers(baseMaps1, overlayMaps1, {collapsed: false, position: "bottomright"}).addTo(map);

$(".leaflet-top" + ".leaflet-right").children().prepend();
//$(".leaflet-top" + ".leaflet-right").children().prepend('<div id="mapSubTitle" style="text-align: center;"><span style="font-size:16pt">Fugas por Diametro CDMX</span></div><hr>');


</script>
</div>
</main>
</html>
