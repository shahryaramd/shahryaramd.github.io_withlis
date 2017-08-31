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
}
var basemaps = [
    L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 22,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        label: 'Google Satellite'

    }),
    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 22,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        label: 'Google Streets'
    }),
    L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Terrain_Base/MapServer/tile/{z}/{y}/{x}', {
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

var reflayer = new L.GIBSLayer('Reference_Features', {
    transparent: true
})


// Define layer control
var hash = new L.Hash(map);
var layerControl = L.control.layers({}, {}, {
    collapsed: false,

});


//Define legends for colormap
var legendT = L.control({
    position: 'bottomleft'
});
var legendTA = L.control({
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

// Define gibs layer colormap
var legendG = L.control({
    position: 'bottomleft'
});
// legend definition ends

//Color of shapefiles for timeseries and statistics
var timeseries_color = 'rgba(1, 235, 255, 0.55)';
var stats_color = 'rgba(229, 93, 9, 0.55)';

// Overlay layer functions start
function pop_eastafricaS0(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_eastafricaS0(feature));

        },
        mouseover: highlightFeature,
    });
    var popupContent = '<iframe width="600" height="420" src="chart.html" frameborder="0" ></iframe>';
    layer.bindPopup(popupContent);
}

function style_eastafricaS0() {
    return {
        pane: 'pane_eastafricaS0',
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
map.createPane('pane_eastafricaS0');
map.getPane('pane_eastafricaS0').style.zIndex = 600;
map.getPane('pane_eastafricaS0').style['mix-blend-mode'] = 'normal';
var layer_eastafricaS0 = new L.geoJson(json_eastafricaS0, {
    attribution: '<a href=""></a>',
    pane: 'pane_eastafricaS0',
    onEachFeature: pop_eastafricaS0,
    style: style_eastafricaS0
});

function pop_eastafricaT1(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_eastafricaT1(feature));

        },
        mouseover: highlightFeature,
        click: function(e) {
            var dn = e.target.feature.properties['DN'];
            var ndn = e.target.feature.properties['name'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=eastafrica&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent);
        },
    });
}

function style_eastafricaT1() {
    return {
        pane: 'pane_eastafricaT1',
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
map.createPane('pane_eastafricaT1');
map.getPane('pane_eastafricaT1').style.zIndex = 601;
map.getPane('pane_eastafricaT1').style['mix-blend-mode'] = 'normal';
var layer_eastafricaT1 = new L.geoJson(json_eastafricaT1, {
    attribution: '<a href=""></a>',
    pane: 'pane_eastafricaT1',
    onEachFeature: pop_eastafricaT1,
    style: style_eastafricaT1
});

function pop_westafricaS2(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_westafricaS2(feature));

        },
        mouseover: highlightFeature,
    });
    var popupContent = '<iframe width="600" height="420" src="chart.html" frameborder="0" ></iframe>';
    layer.bindPopup(popupContent);
}

function style_westafricaS2() {
    return {
        pane: 'pane_westafricaS2',
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
map.createPane('pane_westafricaS2');
map.getPane('pane_westafricaS2').style.zIndex = 602;
map.getPane('pane_westafricaS2').style['mix-blend-mode'] = 'normal';
var layer_westafricaS2 = new L.geoJson(json_westafricaS2, {
    attribution: '<a href=""></a>',
    pane: 'pane_westafricaS2',
    onEachFeature: pop_westafricaS2,
    style: style_westafricaS2
});

function pop_westafricaT3(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_westafricaT3(feature));

        },
        mouseover: highlightFeature,
        click: function(e) {
            var dn = e.target.feature.properties['DN'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=westafrica&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent);
        },
    });

}

function style_westafricaT3() {
    return {
        pane: 'pane_westafricaT3',
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
map.createPane('pane_westafricaT3');
map.getPane('pane_westafricaT3').style.zIndex = 603;
map.getPane('pane_westafricaT3').style['mix-blend-mode'] = 'normal';
var layer_westafricaT3 = new L.geoJson(json_westafricaT3, {
    attribution: '<a href=""></a>',
    pane: 'pane_westafricaT3',
    onEachFeature: pop_westafricaT3,
    style: style_westafricaT3
});

function pop_southafricaS4(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_southafricaS4(feature));

        },
        mouseover: highlightFeature,

    });
    var popupContent = '<iframe width="600" height="420" src="chart.html" frameborder="0" ></iframe>';
    layer.bindPopup(popupContent);
}

function style_southafricaS4() {
    return {
        pane: 'pane_southafricaS4',
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
map.createPane('pane_southafricaS4');
map.getPane('pane_southafricaS4').style.zIndex = 604;
map.getPane('pane_southafricaS4').style['mix-blend-mode'] = 'normal';
var layer_southafricaS4 = new L.geoJson(json_southafricaS4, {
    attribution: '<a href=""></a>',
    pane: 'pane_southafricaS4',
    onEachFeature: pop_southafricaS4,
    style: style_southafricaS4
});

function pop_southafricaT5(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_southafricaT5(feature));

        },
        mouseover: highlightFeature,
        click: function(e) {
            var dn = e.target.feature.properties['DN'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=southernafrica&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent);
        },
    });
}

function style_southafricaT5() {
    return {
        pane: 'pane_southafricaT5',
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
map.createPane('pane_southafricaT5');
map.getPane('pane_southafricaT5').style.zIndex = 605;
map.getPane('pane_southafricaT5').style['mix-blend-mode'] = 'normal';
var layer_southafricaT5 = new L.geoJson(json_southafricaT5, {
    attribution: '<a href=""></a>',
    pane: 'pane_southafricaT5',
    onEachFeature: pop_southafricaT5,
    style: style_southafricaT5
});

function pop_afghanistanS6(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_afghanistanS6(feature));

        },
        mouseover: highlightFeature_nopop,
        click: function(e) {
            var dn = e.target.feature.properties['USERBASINI'];
            var content = '<iframe id="ts_wa" width="800" height="500" src="stats.html?param1=centralasia&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent).openPopup();
        },
    });
}

function style_afghanistanS6() {
    return {
        pane: 'pane_afghanistanS6',
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
map.createPane('pane_afghanistanS6');
map.getPane('pane_afghanistanS6').style.zIndex = 606;
map.getPane('pane_afghanistanS6').style['mix-blend-mode'] = 'normal';
var layer_afghanistanS6 = new L.geoJson(json_afghanistanS6, {
    attribution: '<a href=""></a>',
    pane: 'pane_afghanistanS6',
    onEachFeature: pop_afghanistanS6,
    style: style_afghanistanS6
});

function pop_afghanistanT7(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_afghanistanT7(feature));

        },
        mouseover: highlightFeature_nopop,
        click: function(e) {
            var dn = e.target.feature.properties['USERBASINI'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=centralasia&param2=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=", "param2=" + dn);
            layer.bindPopup(popupContent);
        },
    });
}


function style_afghanistanT7() {
    return {
        pane: 'pane_afghanistanT7',
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
map.createPane('pane_afghanistanT7');
map.getPane('pane_afghanistanT7').style.zIndex = 607;
map.getPane('pane_afghanistanT7').style['mix-blend-mode'] = 'normal';
var layer_afghanistanT7 = new L.geoJson(json_afghanistanT7, {
    attribution: '<a href=""></a>',
    pane: 'pane_afghanistanT7',
    onEachFeature: pop_afghanistanT7,
    style: style_afghanistanT7
});

eastafricaS0 = L.layerGroup().addLayer(layer_eastafricaS0);
eastafricaT1 = L.layerGroup().addLayer(layer_eastafricaT1);
westafricaS2 = L.layerGroup().addLayer(layer_westafricaS2);
westafricaT3 = L.layerGroup().addLayer(layer_westafricaT3);
southafricaS4 = L.layerGroup().addLayer(layer_southafricaS4);
southafricaT5 = L.layerGroup().addLayer(layer_southafricaT5);
afghanistanS6 = L.layerGroup().addLayer(layer_afghanistanS6);
afghanistanT7 = L.layerGroup().addLayer(layer_afghanistanT7);

//dummy bounds, just for initiating
var dummybnds = [
    [46.7799750845, -122.954871228],
    [48.0992388984, -120.679454044]
];

//Initializing the data layer for overlaying png image corresponding to the raster dataset
var dataLayer = new L.imageOverlay("dummy", dummybnds, {
    opacity: 1,
    interactive: true
});

//Printing the map
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
L.control.coordinates({
    position: "bottomright",
    decimals: 2,
    decimalSeperator: ".",
    labelTemplateLat: "Latitude: {y}",
    labelTemplateLng: "Longitude: {x}"
}).addTo(map);
