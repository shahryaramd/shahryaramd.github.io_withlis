// Initialize date

function initialize()
{
    var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

    var date = new Date();
    date.setDate(date.getDate()-1);
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based
    var mmfull = (monthNames[date.getMonth()]).toString();
    var dd  = date.getDate().toString();
    var reqDate = yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]);
    document.getElementById('forecastdate').value = (dd[1]?dd:"0"+dd[0]) +" "+ mmfull + ", "+ yyyy ;
    document.getElementById('optimdate').value = (dd[1]?dd:"0"+dd[0]) +" "+ mmfull + ", "+ yyyy;
    document.getElementById('downloaddate').value = (dd[1]?dd:"0"+dd[0]) +" "+ mmfull + ", "+ yyyy;
// document.getElementById('selInfo').innerHTML = "Please select Basin.";
}


//Materialize options
$(document).ready(function() {
    $('select').material_select();
  });

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    // close: 'Ok',
    closeOnSelect: true // Close upon selecting a date,
});


function initChart(){

    var srcChart=""
    if (document.getElementById('actualVar').value == "inflow") {
        srcChart = "charts/curr_inoutflow.html";
    } else if (document.getElementById('actualVar').value == "elev") {
        srcChart = "charts/curr_level.html";
    } else if (document.getElementById('actualVar').value == "hp") {
        srcChart = "charts/curr_hp.html";
    } else {
        srcChart = ""
    }

    if (srcChart == ""){
        document.getElementById('ifr_actual').innerHTML= "Please select a variable to start with!"
    } else{
        strIfr='<iframe src='+srcChart+' height="430px" width="500px" frameborder="0"></iframe>'
        document.getElementById('ifr_actual').innerHTML= strIfr;
    }
}

function initForecastChart() {
    var date = new Date(document.getElementById('forecastdate').value);
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = date.getDate().toString();
    var reqDate = yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]);
    if (document.getElementById('forecastVar').value == "gfs") {
        srcChart = "charts/forecast_inflow.html?date="+reqDate;
    } else if (document.getElementById('forecastVar').value == "gefs") {
        srcChart = "charts/forecast_inflow_gefs.html?date="+reqDate;
    } else {
        srcChart = ""
    }

    if (srcChart == ""){
        document.getElementById('ifr_forecast').innerHTML= "Please select a variable to start with!"
    } else{
        strIfr='<iframe src='+srcChart+' height="430px" width="500px" frameborder="0"></iframe>'
        document.getElementById('ifr_forecast').innerHTML= strIfr;
    }

}

function initOptimChart() {
    var date = new Date(document.getElementById('optimdate').value);
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = date.getDate().toString();
    var reqDate = yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]);
    if (document.getElementById('optimVar').value == "outflow") {
        srcChart = "charts/optim_outflow.html?date="+reqDate;
    } else if (document.getElementById('optimVar').value == "elev") {
        srcChart = "charts/optim_elev.html?date="+reqDate;
    } else if (document.getElementById('optimVar').value == "hp") {
        srcChart = "charts/optim_hp.html?date="+reqDate;
    } else {
        srcChart = ""
    }

    if (srcChart == ""){
        document.getElementById('ifr_optim').innerHTML= "Please select a variable to start with!"
    } else{
        strIfr='<iframe src='+srcChart+' height="430px" width="500px" frameborder="0"></iframe>'
        document.getElementById('ifr_optim').innerHTML= strIfr;
    }

}



//Define Layers
var highlightLayer;
function highlightFeature(e) {
    highlightLayer = e.target;

    if (e.target.feature.geometry.type === 'LineString') {
      highlightLayer.setStyle({
        color: '#ffff00',
      });
    } else {
      highlightLayer.setStyle({
        fillColor: '#ffff00',
        fillOpacity: 1
      });
    }
}
L.ImageOverlay.include({
    getBounds: function () {
        return this._bounds;
    }
});
var map = L.map('map', {
    zoomControl:true, maxZoom:28, minZoom:1
});
map.setView(new L.LatLng(44.6354, -122.0794), 11);
var hash = new L.Hash(map);
var measureControl = new L.Control.Measure(
    { position: 'topleft' },
    { activeColor: '#ABE67E' },
    { completedColor: '#C8F2BE' },
    {
    // primaryLengthUnit: 'meters',
    secondaryLengthUnit: 'kilometers',
    primaryAreaUnit: 'sqmeters'
    // secondaryAreaUnit: 'hectares'
});
measureControl.addTo(map);
var bounds_group = new L.featureGroup([]);
var basemap0 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 22,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});
basemap0.addTo(map);
var basemap1 = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom: 22,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});
// basemap1.addTo(map);
var basemap2 = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Terrain_Base/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: USGS, Esri, TANA, DeLorme, and NPS',
    maxZoom: 13
});
// basemap2.addTo(map);
function setBounds() {
}
function geoJson2heat(geojson, weight) {
  return geojson.features.map(function(feature) {
    return [
      feature.geometry.coordinates[1],
      feature.geometry.coordinates[0],
      feature.properties[weight]
    ];
  });
}
function pop_DrainageBasin0(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_DrainageBasin0_0(feature));

        }
        // mouseover: highlightFeature,
    });
    var popupContent = '<table>\
            <tr>\
                <td colspan="2">' + (feature.properties['ID'] !== null ? Autolinker.link(String(feature.properties['ID'])) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['GRIDCODE'] !== null ? Autolinker.link(String(feature.properties['GRIDCODE'])) : '') + '</td>\
            </tr>\
        </table>';
    layer.bindPopup(popupContent);
}

function style_DrainageBasin0_0() {
    return {
        pane: 'pane_DrainageBasin0',
        opacity: 1,
        color: 'rgba(0,53,118,1.0)',
        dashArray: '',
        lineCap: 'butt',
        lineJoin: 'miter',
        weight: 1.0,
        fillOpacity: 1,
        fillColor: 'rgba(115,213,232,0.517647058824)',
    }
}
map.createPane('pane_DrainageBasin0');
map.getPane('pane_DrainageBasin0').style.zIndex = 400;
map.getPane('pane_DrainageBasin0').style['mix-blend-mode'] = 'normal';
var layer_DrainageBasin0 = new L.geoJson(json_DrainageBasin0, {
attribution: '<a href=""></a>',
pane: 'pane_DrainageBasin0',
onEachFeature: pop_DrainageBasin0,
style: style_DrainageBasin0_0,
});
bounds_group.addLayer(layer_DrainageBasin0);
map.addLayer(layer_DrainageBasin0);
function pop_DetroitLake1(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_DetroitLake1_0(feature));

        },
        mouseover: highlightFeature,
    });
    var popupContent = '<table>\
            <tr>\
                <td colspan="2">' + (feature.properties['GRAND_ID'] !== null ? Autolinker.link(String(feature.properties['GRAND_ID'])) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['AREA_SKM'] !== null ? Autolinker.link(String(feature.properties['AREA_SKM'])) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['POLY_SRC'] !== null ? Autolinker.link(String(feature.properties['POLY_SRC'])) : '') + '</td>\
            </tr>\
        </table>';
    layer.bindPopup(popupContent);
}

function style_DetroitLake1_0() {
    return {
        pane: 'pane_DetroitLake1',
        opacity: 1,
        color: 'rgba(0,0,0,1.0)',
        dashArray: '',
        lineCap: 'butt',
        lineJoin: 'miter',
        weight: 1.0,
        fillOpacity: 1,
        fillColor: 'rgba(18,133,255,1.0)',
    }
}
map.createPane('pane_DetroitLake1');
map.getPane('pane_DetroitLake1').style.zIndex = 401;
map.getPane('pane_DetroitLake1').style['mix-blend-mode'] = 'normal';
var layer_DetroitLake1 = new L.geoJson(json_DetroitLake1, {
attribution: '<a href=""></a>',
pane: 'pane_DetroitLake1',
onEachFeature: pop_DetroitLake1,
style: style_DetroitLake1_0,
});
bounds_group.addLayer(layer_DetroitLake1);
map.addLayer(layer_DetroitLake1);
function pop_DetroitDam2(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_DetroitDam2_0(feature));

        },
        mouseover: highlightFeature,
    });
    var popupContent = '<table>\
            <tr>\
                <td colspan="2">' + (feature.properties['GRAND_ID'] !== null ? Autolinker.link(String(feature.properties['GRAND_ID'])) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['LAT_DD'] !== null ? Autolinker.link(String(feature.properties['LAT_DD'])) : '') + '</td>\
            </tr>\
        </table>';
    layer.bindPopup(popupContent);
}

function style_DetroitDam2_0() {
    return {
        pane: 'pane_DetroitDam2',
        radius: 4.0,
        opacity: 1,
        color: 'rgba(0,0,0,1.0)',
        dashArray: '',
        lineCap: 'butt',
        lineJoin: 'miter',
        weight: 1,
        fillOpacity: 1,
        fillColor: 'rgba(255,0,0,1.0)',
    }
}
map.createPane('pane_DetroitDam2');
map.getPane('pane_DetroitDam2').style.zIndex = 402;
map.getPane('pane_DetroitDam2').style['mix-blend-mode'] = 'normal';
var layer_DetroitDam2 = new L.geoJson(json_DetroitDam2, {
    attribution: '<a href=""></a>',
    pane: 'pane_DetroitDam2',
    onEachFeature: pop_DetroitDam2,
    pointToLayer: function (feature, latlng) {
        var context = {
            feature: feature,
            variables: {}
        };
        return L.circleMarker(latlng, style_DetroitDam2_0(feature))
    },
});
bounds_group.addLayer(layer_DetroitDam2);
map.addLayer(layer_DetroitDam2);
var baseMaps = {'Google Streets': basemap0, 'Google Satellites': basemap1, 'ESRI World Terrain': basemap2};
var layerControl = L.control.layers(baseMaps,{'<img src="legend/DetroitDam2.png" /> Detroit Dam': layer_DetroitDam2,'<img src="legend/DetroitLake1.png" /> Detroit Lake': layer_DetroitLake1,'<img src="legend/DrainageBasin0.png" /> Drainage Basin': layer_DrainageBasin0,},{collapsed:true}).addTo(map);
setBounds();

function initMap() {
    map.setView(new L.LatLng(44.6354, -122.0794), 10);
    layer_DrainageBasin0 = new L.geoJson(json_DrainageBasin0, {
        pane: 'pane_DrainageBasin0',
        style: style_DrainageBasin0_0,
    });
    layer_DetroitLake1 = new L.geoJson(json_DetroitLake1, {
        pane: 'pane_DetroitLake1',
        onEachFeature: pop_DetroitLake1,
        style: style_DetroitLake1_0,
    });
    layer_DetroitDam2 = new L.geoJson(json_DetroitDam2, {
        pane: 'pane_DetroitDam2',
        onEachFeature: pop_DetroitDam2,
        pointToLayer: function (feature, latlng) {
            var context = {
                feature: feature,
                variables: {}
            };
            return L.circleMarker(latlng, style_DetroitDam2_0(feature))
        },
    });
    if (document.getElementById('dam').value == "-1") {
        alert('Please select a dam')
        map.removeLayer(layer_DrainageBasin0);
        map.removeLayer(layer_DetroitLake1);
        map.removeLayer(layer_DetroitDam2);
        // map.setView(new L.LatLng(44.6354, -122.0794), 10);

        // map.addLayer(layer_DrainageBasin0);
        // map.addLayer(layer_DetroitLake1);
        // map.addLayer(layer_DetroitDam2);
        // layerControl.addTo(map);
    }
}
