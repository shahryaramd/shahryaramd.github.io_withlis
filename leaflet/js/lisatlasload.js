//
//#######################################
//LIS Atlas: A web based visualization framework for LIS output
// Javascript code written for rendering the map and LIS output data based on leaflet.js API
//Written by Shahryar Khalique Ahmad  
//skahmad@uw.edu
//
//#######################################


function playforward() {
    el = document.getElementById('seldate');

    var curdate = new Date(document.getElementById('seldate').value);
    curdate.setDate(curdate.getDate() + 2);
    var yyyy = curdate.getFullYear().toString();
    var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = curdate.getDate().toString();
    el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
    ev = document.createEvent('Event');
    ev.initEvent('change', true, false);

    var status = mapInit();
    if (status == "datapresent") {
        playtime = setTimeout(playforward, 500);
        btforward.disabled = true;
        btback.disabled = true;
        btpause.disabled = false;
    } else {
        //document.getElementById("message").innerHTML = "Future data unavailable";
        $(document).ready(function () {
            $('#message').delay(2500).fadeOut();
        });
        btforward.disabled = false; //true;
        btback.disabled = false;
        btpause.disabled = true;
    }
}

function playstop() {
    clearTimeout(playtime);
    btpause.disabled = true;
    btforward.disabled = false;
    btback.disabled = false;
}

function playback() {
    el = document.getElementById('seldate');

    var curdate = new Date(document.getElementById('seldate').value);
    curdate.setDate(curdate.getDate());
    var yyyy = curdate.getFullYear().toString();
    var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = curdate.getDate().toString();
    el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
    ev = document.createEvent('Event');
    ev.initEvent('change', true, false);
    el.dispatchEvent(ev);

    var status = mapInit();
    if (status == "datapresent") {
        playtime = setTimeout(playback, 500);
        btforward.disabled = true;
        btback.disabled = true;
        btpause.disabled = false;
    } else {
        //document.getElementById("message").innerHTML = "Previous data unavailable";
        $(document).ready(function () {
            $('#message').delay(2500).fadeOut();
        });

        btforward.disabled = false;
        btback.disabled = false; //true;
        btpause.disabled = true;
    }


}

function initialize() {

    var date = new Date();
    date.setDate(date.getDate() - 2);
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = date.getDate().toString();
    var reqDate = yyyy + (mm[1] ? mm : "0" + mm[0]) + (dd[1] ? dd : "0" + dd[0]);
    document.getElementById('seldate').value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);


} 

function decreaseDate() {
    el = document.getElementById('seldate');

    var curdate = new Date(document.getElementById('seldate').value);
    curdate.setDate(curdate.getDate());
    var yyyy = curdate.getFullYear().toString();
    var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = curdate.getDate().toString();
    el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
    ev = document.createEvent('Event');
    ev.initEvent('change', true, false);
    el.dispatchEvent(ev);
}

function increaseDate() {
    el = document.getElementById('seldate');

    var curdate = new Date(document.getElementById('seldate').value);
    curdate.setDate(curdate.getDate() + 2);
    var yyyy = curdate.getFullYear().toString();
    var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = curdate.getDate().toString();
    el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
    ev = document.createEvent('Event');
    ev.initEvent('change', true, false);
    el.dispatchEvent(ev);
}

function genOptions() {
    if ((layerControl._map)) {
        layerControl.remove(map);
    }

    map.removeLayer(dataLayer);
    map.removeLayer(afghanistanS6)
    map.removeLayer(afghanistanT7)
    map.removeLayer(westafricaS2)
    map.removeLayer(westafricaT3)
    map.removeLayer(southafricaS4)
    map.removeLayer(southafricaT5)
    map.removeLayer(eastafricaS0)
    map.removeLayer(eastafricaT1)

    var msg = document.getElementById('message');
    msg.style.display = 'none';
    var opc = document.getElementById('selOpacity');
    opc.style.display = 'none';
    // Layer control /////////////////////////////
    layerControl.removeLayer(afghanistanS6)
    layerControl.removeLayer(afghanistanT7)
    layerControl.removeLayer(westafricaS2)
    layerControl.removeLayer(westafricaT3)
    layerControl.removeLayer(southafricaS4)
    layerControl.removeLayer(southafricaT5)
    layerControl.removeLayer(eastafricaS0)
    layerControl.removeLayer(eastafricaT1)

    // Selections from user
    var region = document.getElementById("region");
    var model = document.getElementById("model");
    var forcing = document.getElementById("forcing");
    var dataset = document.getElementById("dataset");

    // set map view
    if (region.value == 'centralasia') {
        map.setView(new L.LatLng(40.6, 66.7), 4);

    } else if (region.value == 'eastafrica') {
        map.setView(new L.LatLng(5.70, 32.61), 4);

    } else if (region.value == 'southernafrica') {
        map.setView(new L.LatLng(-15.0, 25.61), 4);

    } else if (region.value == 'westafrica') {
        map.setView(new L.LatLng(11.2, 7.0), 5);
    }

    // Generate model options
    for (i = 1; i < model.options.length; i++) {
        model.options[i] = null;
    }
    for (i = 1; i < forcing.options.length; i++) {
        forcing.options[i] = null;
    }
    for (i = 1; i < dataset.options.length; i++) {
        dataset.options[i] = null;
    }
    if (region.value == 'centralasia') {

        model.options[1] = new Option("NOAH36", "noah");
        //model.options[2] = new Option("CLM2", "clm");

        forcing.options[1] = new Option("Daily GDAS", "gdas");

        dataset.options[1] = new Option("SWE", "swe");
        dataset.options[2] = new Option("Temperature", "temperature")
        dataset.options[3] = new Option("Precipitation", "precipitation");

        //default options
        model.value = "noah";
        forcing.value = "gdas";
        dataset.value = "swe";
    } else if (region.value == 'eastafrica' || region.value == 'southernafrica' || region.value == 'westafrica') {

        model.options[1] = new Option("NOAH33", "noah");
        model.options[2] = new Option("VIC412", "vic");

        forcing.options[1] = new Option("Daily RFE+GDAS", "rg_d");
        forcing.options[2] = new Option("Monthly RFE+GDAS", "rg_m");
        forcing.options[3] = new Option("Monthly CHIRPS+MERRA2", "cm_m");

        dataset.options[1] = new Option("Soil Moisture", "soilmoisture");
        dataset.options[2] = new Option("Temperature", "temperature")
        dataset.options[3] = new Option("Precipitation", "precipitation");

        //default options
        model.value = "noah";
        forcing.value = "rg_d";
        dataset.value = "soilmoisture";
    }

    mapInit();

}

function mapInit() {

    //Reset map
    if (map.hasLayer(dataLayer)) {
        $(dataLayer._image).fadeOut(200, function () {
            //map.removeLayer(dataLayer);
        });
    }
    if ((layerControl._map)) {
        layerControl.remove(map);

    }

    map.removeLayer(afghanistanS6)
    map.removeLayer(afghanistanT7)
    map.removeLayer(westafricaS2)
    map.removeLayer(westafricaT3)
    map.removeLayer(southafricaS4)
    map.removeLayer(southafricaT5)
    map.removeLayer(eastafricaS0)
    map.removeLayer(eastafricaT1)
    // Layer control /////////////////////////////
    layerControl.removeLayer(afghanistanS6)
    layerControl.removeLayer(afghanistanT7)
    layerControl.removeLayer(westafricaS2)
    layerControl.removeLayer(westafricaT3)
    layerControl.removeLayer(southafricaS4)
    layerControl.removeLayer(southafricaT5)
    layerControl.removeLayer(eastafricaS0)
    layerControl.removeLayer(eastafricaT1)

    layer_afghanistanT7 = new L.geoJson(json_afghanistanT7, {
        attribution: '<a href=""></a>',
        pane: 'pane_afghanistanT7',
        onEachFeature: pop_afghanistanT7,
        style: style_afghanistanT7
    });

    layer_afghanistanS6 = new L.geoJson(json_afghanistanS6, {
        attribution: '<a href=""></a>',
        pane: 'pane_afghanistanS6',
        onEachFeature: pop_afghanistanS6,
        style: style_afghanistanS6
    });

    layer_southafricaT5 = new L.geoJson(json_southafricaT5, {
        attribution: '<a href=""></a>',
        pane: 'pane_southafricaT5',
        onEachFeature: pop_southafricaT5,
        style: style_southafricaT5
    });

    layer_southafricaS4 = new L.geoJson(json_southafricaS4, {
        attribution: '<a href=""></a>',
        pane: 'pane_southafricaS4',
        onEachFeature: pop_southafricaS4,
        style: style_southafricaS4
    });

    layer_westafricaT3 = new L.geoJson(json_westafricaT3, {
        attribution: '<a href=""></a>',
        pane: 'pane_westafricaT3',
        onEachFeature: pop_westafricaT3,
        style: style_westafricaT3
    });

    layer_westafricaS2 = new L.geoJson(json_westafricaS2, {
        attribution: '<a href=""></a>',
        pane: 'pane_westafricaS2',
        onEachFeature: pop_westafricaS2,
        style: style_westafricaS2
    });

    layer_eastafricaT1 = new L.geoJson(json_eastafricaT1, {
        attribution: '<a href=""></a>',
        pane: 'pane_eastafricaT1',
        onEachFeature: pop_eastafricaT1,
        style: style_eastafricaT1
    });

    layer_eastafricaS0 = new L.geoJson(json_eastafricaS0, {
        attribution: '<a href=""></a>',
        pane: 'pane_eastafricaS0',
        onEachFeature: pop_eastafricaS0,
        style: style_eastafricaS0
    });

    eastafricaS0 = L.layerGroup().addLayer(layer_eastafricaS0);
    eastafricaT1 = L.layerGroup().addLayer(layer_eastafricaT1);
    westafricaS2 = L.layerGroup().addLayer(layer_westafricaS2);
    westafricaT3 = L.layerGroup().addLayer(layer_westafricaT3);
    southafricaS4 = L.layerGroup().addLayer(layer_southafricaS4);
    southafricaT5 = L.layerGroup().addLayer(layer_southafricaT5);
    afghanistanS6 = L.layerGroup().addLayer(layer_afghanistanS6);
    afghanistanT7 = L.layerGroup().addLayer(layer_afghanistanT7);
    // Layer control ends

    L.ImageOverlay.include({
        getBounds: function () {
            return this._bounds;
        }
    });

    // Selections from user
    var region = document.getElementById("region");
    var model = document.getElementById("model");
    var forcing = document.getElementById("forcing");
    var dataset = document.getElementById("dataset");

    var strRegion = region.options[region.selectedIndex].value;
    var strModel = model.options[model.selectedIndex].value;
    var strForcing = forcing.options[forcing.selectedIndex].value;
    var strDataset = dataset.options[dataset.selectedIndex].value;


    if (region.selectedIndex == 0) {
        console.log('Please select a region');
    } else if (model.selectedIndex == 0) {
        console.log('Please select a model');
    } else if (forcing.selectedIndex == 0) {
        console.log('Please select a forcing');
    } else if (dataset.selectedIndex == 0) {
        console.log('Please select a dataset');
    } else {

        // Check if layer control already added to map, if not, add
        if (!(layerControl._map)) {
            layerControl.addTo(map);
        }

        var dateOrig = document.getElementById('seldate').value;
        datepick = dateOrig.replace(/-/g, "");

        if (strForcing == 'rg_d') {
            var imgdata = 'DATA_DIR/tile/' + strRegion + '/' + strModel + '/rg/daily/' + strDataset + '/' + datepick + '.png';
        } else if (strForcing == 'rg_m') {
            var imgdata = 'DATA_DIR/tile/' + strRegion + '/' + strModel + '/rg/monthly/' + strDataset + '/' + datepick + '.png';
        } else if (strForcing == 'cm_m') {
            var imgdata = 'DATA_DIR/tile/' + strRegion + '/' + strModel + '/cm/monthly/' + strDataset + '/' + datepick + '.png';
        } else if (strForcing == 'gdas') {
            var imgdata = 'DATA_DIR/tile/' + strRegion + '/' + strModel + '/gdas/daily/' + strDataset + '/' + datepick + '.png';
        }
        //                var tilename = 'DATA_DIR/tile/' + strRegion + '/' + strModel + '/' + strDataset + '/' + datepick + '/' + '{z}/{x}/{y}.png';


        if (region.value == 'centralasia') {
            layerControl.addOverlay(afghanistanT7, '<img src="legend/ts.png" width=20px /> Timeseries');
            layerControl.addOverlay(afghanistanS6, '<img src="legend/stat.png" width=20px /> Statistics');
            var img_bounds = [ // CA
                [25, 60], //[21.0, 30.0],
                [40, 90] //[56.0, 100.0]
            ];

        } else if (region.value == 'eastafrica') {
            layerControl.addOverlay(eastafricaT1, '<img src="legend/ts.png" width=20px /> Timeseries');
            layerControl.addOverlay(eastafricaS0, '<img src="legend/stat.png" width=20px /> Statistics');
            var img_bounds = [ // EA
                [-12.0, 21.75],
                [23.25, 51.25]
            ];
        } else if (region.value == 'southernafrica') {
            layerControl.addOverlay(southafricaT5, '<img src="legend/ts.png" width=20px /> Timeseries');
            layerControl.addOverlay(southafricaS4, '<img src="legend/stat.png" width=20px /> Statistics');
            var img_bounds = [ // SA
                [-37.9, 6.0],
                [6.4, 54.6]
            ];
        } else if (region.value == 'westafrica') {
            layerControl.addOverlay(westafricaT3, '<img src="legend/ts.png" width=20px /> Timeseries');
            layerControl.addOverlay(westafricaS2, '<img src="legend/stat.png" width=20px /> Statistics');
            var img_bounds = [ // WA
                [5.3, -18.7],
                [17.7, 25.9]
            ];
        }
        // add png overlay
        dataLayer = new L.imageOverlay(imgdata, img_bounds, {
            opacity: 1,
            interactive: false
        });


        $('#bgopacity').on('input', function (value) {
            dataLayer.setOpacity($(this).val() * '.01');
        });

        map.removeControl(legendSM);
        map.removeControl(legendT);
        map.removeControl(legendSW);
        map.removeControl(legendP);

        if (dataset.value == 'swe') {

            // Legend////////
            legendSW.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<b><center>Snow Water Equivalent (mm)</b></center>';
                div.innerHTML += '<img src="images/swe.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendSW.addTo(map);
            ////////////////

        } else if (dataset.value == 'soilmoisture') {

            // Legend////////
            legendSM.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<b><center>Soil Moisture (Percentile)</b></center>';
                div.innerHTML += '<img src="images/soilmoisture.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendSM.addTo(map);
            ////////////////


        } else if (dataset.value == 'temperature') {

            // Legend////////
            legendT.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<center><b>Temperature (˚C)</b></center>';
                div.innerHTML += '<img src="images/temperature.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendT.addTo(map);
            ////////////////


        } else if (dataset.value == 'precipitation') {

            // Legend////////
            legendP.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<center><b>Precipitation (mm/day)</b></center>';
                div.innerHTML += '<img src="images/precipitation.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendP.addTo(map);
            ////////////////


        }

        // give message if data unavailable
        var http = new XMLHttpRequest();
        http.open('HEAD', imgdata, false);
        http.send();
        var msg = document.getElementById('message');
        var opc = document.getElementById('selOpacity');
        if (http.status != 404) {
            msg.style.display = 'none';
            opc.style.display = 'block';
            map.addLayer(dataLayer);
            var imgElement = dataLayer.getElement();
            dataLayer.getElement().classList.add('styleOverlay');
            return "datapresent";
        } else {
            msg.style.display = 'block';
            opc.style.display = 'none';
            $(document).ready(function () {
                $('#message').delay(2500).fadeOut();
            });
        }
    }
}
