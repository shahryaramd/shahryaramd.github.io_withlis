//
//#######################################
//LIS Atlas: A web based visualization framework for LIS output
// Javascript code written for rendering the map and LIS output data based on leaflet.js API
/*Written by Shahryar Khalique Ahmad

Graduate Student and Research Assistant
Homepage: http://students.washington.edu/skahmad/
Department of Civil and Environmental Engineering
University of Washington
skahmad@uw.edu, shahryaramd786@gmail.com*/
//#######################################


function highlightFeature(e) {
    highlightLayer = e.target;
    highlightLayer.setStyle({
        fillColor: '#ffff00',
        fillOpacity: 0.9
    });
    var popup = L.popup()
        .setLatLng(e.latlng)
        .setContent(e.target.feature.properties['name'])
        .openOn(map);

    //highlightLayer.openPopup();
}

function highlightFeature_nopop(e) {
    highlightLayer = e.target;
    highlightLayer.setStyle({
        fillColor: '#ffff00',
        fillOpacity: 0.9
    });
    //    var popup = L.popup()
    //    .setLatLng(e.latlng)
    //        .setContent('Basin ID ' + (e.target.feature.properties['USERBASINI']).toString())
    //        .openOn(map);
    //highlightLayer.openPopup();
}
var basemaps = [
    L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 22,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        label: 'Google Satellite'
        //        bounds: [
        //            new L.LatLng(28, 60),
        //                    new L.LatLng(40, 90)
        //                ]
    }),
    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 22,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        label: 'Google Streets'
    }), L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Terrain_Base/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: USGS, Esri, TANA, DeLorme, and NPS',
        maxZoom: 13,
        label: "ESRI World Terrain"
    })
];

var map = L.map('map', {
    zoomControl: true,
    maxZoom: 22,
    minZoom: 2
}).fitBounds([
    [25.5661459227, 60.1451360703],
    [42.2867860536, 75.2538583755]
]);

map.addControl(L.control.basemaps({
    basemaps: basemaps,
    tileX: 0,
    tileY: 0,
    tileZ: 1
}));


//GIBS
var gibsLayers = {};

var baseMapsGibs = [];
var overlayGibs = [];


var options = {
    container_width: "300px",
    group_maxHeight: "80px",
    //container_maxHeight : "350px",
    exclusive: false,
    collapsed: true,
    position: 'topright',
    autoZIndex: true
};

var gibscontrol = L.Control.styledLayerControl(baseMapsGibs, overlayGibs, options);
//var gibsControl = L.control.layers(gibsLayers, null, {
//    collapsed: true
//})

var reflayer = new L.GIBSLayer('Reference_Features', {
    transparent: true
}) //.addTo(map);


//
var hash = new L.Hash(map);
var layerControl = L.control.layers({}, {}, {
    collapsed: false,

});
//layerControl.addTo(map);

var legendT = L.control({
    position: 'bottomleft'
});

var legendSM = L.control({
    position: 'bottomleft'
});

var legendSW = L.control({
    position: 'bottomleft'
});
var legendP = L.control({
    position: 'bottomleft'
});
var legendET = L.control({
    position: 'bottomleft'
});

//gibs legend
var legendG = L.control({
    position: 'bottomleft'
});
// legend definition ends

var timeseries_color = 'rgba(1, 235, 255, 0.55)';
var stats_color = 'rgba(229, 93, 9, 0.55)';

// Overlay layer functions start

function pop_Timeseries0(feature, layer) {
    layer.on({
        mouseout: function (e) {
            layer.setStyle(style_Timeseries0(feature));

        },
        mouseover: highlightFeature_nopop,
        click: function (e) {
            var dn = e.target.feature.properties['USERBASINI'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=centralasia&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent).openPopup();
        },
    });
}

function style_Timeseries0() {
    return {
        pane: 'pane_Timeseries0',
        opacity: 1,
        color: 'rgba(0,0,0,1.0)',
        dashArray: '',
        lineCap: 'butt',
        lineJoin: 'miter',
        weight: 1.0,
        fillOpacity: 1,
        fillColor: timeseries_color,
    }
}
map.createPane('pane_Timeseries0');
map.getPane('pane_Timeseries0').style.zIndex = 606;
map.getPane('pane_Timeseries0').style['mix-blend-mode'] = 'normal';
var layer_Timeseries0 = new L.geoJson(json_Timeseries0, {
    attribution: '<a href=""></a>',
    pane: 'pane_Timeseries0',
    onEachFeature: pop_Timeseries0,
    style: style_Timeseries0
});

function pop_Statistics1(feature, layer) {
    layer.on({
        mouseout: function (e) {
            layer.setStyle(style_Statistics1(feature));

        },
        mouseover: highlightFeature_nopop,
        click: function (e) {
            var dn = e.target.feature.properties['USERBASINI'];
            var content = '<iframe id="ts_wa" width="800" height="500" src="stats.html?param1=centralasia&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent).openPopup();
        },
    });
}


function style_Statistics1() {
    return {
        pane: 'pane_Statistics1',
        opacity: 1,
        color: 'rgba(0,0,0,1.0)',
        dashArray: '',
        lineCap: 'butt',
        lineJoin: 'miter',
        weight: 1.0,
        fillOpacity: 1,
        fillColor: stats_color,
    }
}
map.createPane('pane_Statistics1');
map.getPane('pane_Statistics1').style.zIndex = 607;
map.getPane('pane_Statistics1').style['mix-blend-mode'] = 'normal';
var layer_Statistics1 = new L.geoJson(json_Statistics1, {
    attribution: '<a href=""></a>',
    pane: 'pane_Statistics1',
    onEachFeature: pop_Statistics1,
    style: style_Statistics1
});

Timeseries0 = L.layerGroup().addLayer(layer_Timeseries0);
Statistics1 = L.layerGroup().addLayer(layer_Statistics1);

var dummybnds = [
    [46.7799750845, -122.954871228],
    [48.0992388984, -120.679454044]
];
var dataLayer = new L.imageOverlay("dummy", dummybnds, {
    opacity: 1,
    interactive: true
});

L.easyPrint({
    title: 'Export Map',
    //            position: 'topright'
    elementsToHide: 'div'
}).addTo(map);
var scaleOptions = {
    imperial: true,
    position: "bottomright"
};
L.control.scale(scaleOptions).addTo(map);

// KML Load
var style = {
    color: 'red',
    opacity: 1.0,
    fillOpacity: 0.5,
    weight: 2,
    clickable: false
};
