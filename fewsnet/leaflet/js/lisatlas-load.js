//LIS Atlas: A web based visualization framework for LIS output
//
//Written by Shahryar Khalique Ahmad
//
//Graduate Student and Research Assistant
//Homepage: http://students.washington.edu/skahmad/
//Department of Civil and Environmental Engineering
//University of Washington
//skahmad@uw.edu, shahryaramd786@gmail.com

// lisatlasload.js: Loads the leaflet map, with functions for switching between models, parameters, changing dates, animation etc.

// Overlay layer popup

function pop_eastafricaT(feature, layer) {

    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_eastafricaT1(feature));

        },
        mouseover: highlightFeature,
        click: function(e) {
            var dn = e.target.feature.properties['DN'];
            var ndn = e.target.feature.properties['name'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=eastafrica&param2=&param3=" frameborder="0" style="z-index:1000000;"></iframe>';
            var popupContent = content.replace("param2=&param3=", "param2=" + dn + "&param3=" + dataset.value);
            layer.bindPopup(popupContent).openPopup();
        },
    });
}

function pop_westafricaT(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_westafricaT3(feature));

        },
        mouseover: highlightFeature,
        click: function(e) {
            var dn = e.target.feature.properties['DN'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=westafrica&param2=&param3=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=&param3=", "param2=" + dn + "&param3=" + dataset.value);
            layer.bindPopup(popupContent).openPopup();
        },
    });

}

function pop_southafricaT(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_southafricaT5(feature));

        },
        mouseover: highlightFeature,
        click: function(e) {
            var dn = e.target.feature.properties['DN'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=southernafrica&param2=&param3=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=&param3=", "param2=" + dn + "&param3=" + dataset.value);
            layer.bindPopup(popupContent).openPopup();
        },
    });
}

function pop_afghanistanT(feature, layer) {
    layer.on({
        mouseout: function(e) {
            layer.setStyle(style_afghanistanT7(feature));

        },
        mouseover: highlightFeature_nopop,
        click: function(e) {
            var dn = e.target.feature.properties['USERBASINI'];
            //$('#ts_WA').attr('src', "timeseries.html?param1=wa&param2=");
            var content = '<iframe id="ts_wa" width="700" height="420" src="timeseries.html?param1=centralasia&param2=&param3=" frameborder="0"></iframe>';
            var popupContent = content.replace("param2=&param3=", "param2=" + dn + "&param3=" + dataset.value);
            layer.bindPopup(popupContent).openPopup();
        },
    });
}
////////////////////

// Exporting dataset
// function save() {
//     alert(imgdata)
//     var url = imgdata;
//     var a  = document.createElement('a');
//     a.href = url;
//     //a.download = 'image.png';
//
//     a.click();
//
// }

////////////////////

function playforward() {
    var temporal = document.getElementById("temporal");
    el = document.getElementById('seldate');


    if (temporal.value == "daily") {
        var curdate = new Date(document.getElementById('seldate').value);
        curdate.setDate(curdate.getDate() + 2);
        var yyyy = curdate.getFullYear().toString();
        var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
        var dd = curdate.getDate().toString();
        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);
    } else if (temporal.value == "monthly") {
        //document.getElementById('seldate').stepUp(1);
        el = document.getElementById('seldate');
        var curdate = new Date(document.getElementById('seldate').value);
        curdate.setDate(curdate.getDate() - 5);
        var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
        curdate.setMonth(curdate.getMonth() + 2);
        var yyyy = curdate.getFullYear().toString();
        var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
        var dd = curdate.getDate().toString();

        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);

    }

    var status = mapInit();
    if (status == "datapresent") {
        playtime = setTimeout(playforward, 500);
        btforward.disabled = true;
        btback.disabled = true;
        btpause.disabled = false;
    } else {
        //document.getElementById("message").innerHTML = "Future data unavailable";
        $(document).ready(function() {
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
    var temporal = document.getElementById("temporal");
    el = document.getElementById('seldate');

    var curdate = new Date(document.getElementById('seldate').value);
    curdate.setDate(curdate.getDate());
    var yyyy = curdate.getFullYear().toString();
    var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = curdate.getDate().toString();
    if (temporal.value == "daily") {
        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);
    } else if (temporal.value == "monthly") {
        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);
    }
    var status = mapInit();
    if (status == "datapresent") {
        playtime = setTimeout(playback, 500);
        btforward.disabled = true;
        btback.disabled = true;
        btpause.disabled = false;
    } else {
        //document.getElementById("message").innerHTML = "Previous data unavailable";
        $(document).ready(function() {
            $('#message').delay(2500).fadeOut();
        });

        btforward.disabled = false;
        btback.disabled = false; //true;
        btpause.disabled = true;
    }


}
// Initialize date
function initialize() {

    var date = new Date();
    date.setDate(date.getDate() - 1);
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = date.getDate().toString();
    var reqDate = yyyy + (mm[1] ? mm : "0" + mm[0]) + (dd[1] ? dd : "0" + dd[0]);
    document.getElementById('seldate').value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);


} 

// Functions for incrementing/decrementing date

function decreaseDate() {
    var temporal = document.getElementById("temporal");
    el = document.getElementById('seldate');

    var curdate = new Date(document.getElementById('seldate').value);
    curdate.setDate(curdate.getDate());
    var yyyy = curdate.getFullYear().toString();
    var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = curdate.getDate().toString();

    if (temporal.value == "daily") {
        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);
    } else if (temporal.value == "monthly") {
        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);
    }
}

function increaseDate() {
    var temporal = document.getElementById("temporal");
    el = document.getElementById('seldate');

    if (temporal.value == "daily") {
        var curdate = new Date(document.getElementById('seldate').value);
        curdate.setDate(curdate.getDate() + 2);
        var yyyy = curdate.getFullYear().toString();
        var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
        var dd = curdate.getDate().toString();
        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);
    } else if (temporal.value == "monthly") {
        //document.getElementById('seldate').stepUp(1);
        el = document.getElementById('seldate');
        var curdate = new Date(document.getElementById('seldate').value);
        curdate.setDate(curdate.getDate() - 5);
        var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
        curdate.setMonth(curdate.getMonth() + 2);
        var yyyy = curdate.getFullYear().toString();
        var mm = (curdate.getMonth() + 1).toString(); // getMonth() is zero-based
        var dd = curdate.getDate().toString();

        el.value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]);
        ev = document.createEvent('Event');
        ev.initEvent('change', true, false);
        el.dispatchEvent(ev);

    }
}

// Generate options based on the user's selection of region
function genOptions() {
    if ((layerControl._map)) {
        layerControl.remove(map);
    }
    document.getElementById("compare").checked = false;
    map.removeControl(legendG)

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
    var cmp = document.getElementById('comp_checkbox');
    cmp.style.display = 'none';
    var exp = document.getElementById('exportdiv');
    exp.style.display = 'none';

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
    var temporal = document.getElementById("temporal");

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

        forcing.options[1] = new Option("GDAS", "gdas");

        for (i = 1; i < dataset.options.length; i++) {
            dataset.options[i] = null;
        }
        dataset.options[1] = new Option("SWE", "swe");
        dataset.options[2] = new Option("Temperature", "temperature")
        //dataset.options[3] = new Option("Precipitation", "precipitation");

        //default options
        model.value = "noah";
        forcing.value = "gdas";
        dataset.value = "swe";
    } else if (region.value == 'eastafrica' || region.value == 'southernafrica' || region.value == 'westafrica') {

        model.options[1] = new Option("NOAH33", "noah");
        model.options[2] = new Option("VIC412", "vic");

        forcing.options[1] = new Option("RFE+GDAS", "rg");
        forcing.options[2] = new Option("CHIRPS+MERRA2", "cm");

        dataset.options[1] = new Option("Soil Moisture", "soilmoisture");
        dataset.options[2] = new Option("Temperature", "temperature")
        dataset.options[3] = new Option("Temperature Anomaly", "temperature_anomaly")
        dataset.options[4] = new Option("Precipitation", "precipitation");
        dataset.options[5] = new Option("Evapotranspiration", "evapotranspiration");
        dataset.options[6] = new Option("Runoff (Timeseries only)", "runoff");

        //default options
        model.value = "noah";
        forcing.value = "rg";
        dataset.value = "soilmoisture";
    }
    temporal.value = "daily";
    handleDate();
    mapInit();

}

// Add/remove compare dataset option
function fireGibs(checkboxElem) {
    if (checkboxElem.checked) {
        addGibs();
    } else {
        removeGibs();
    }
}

function addGibs() {
    mapInit();
}

function removeGibs() {
    for (var id in L.GIBS_LAYERS) {
        if (map.hasLayer(gibsLayers[id])) {
            id_added = id
            map.removeLayer(gibsLayers[id]);
        }
    }
    map.removeLayer(gibsLayers['Reference_Features'])
    if ((gibscontrol._map)) {
        gibscontrol.remove(map);
    }
    map.removeControl(legendG);
}

// Handle the temporal options (daily/monthly) based on selected forcing
function handleTemporal() {
    // Set temporal scale options
    var temporal = document.getElementById("temporal");
    for (i = 1; i < temporal.options.length; i++) {
        temporal.options[i] = null;
    }
    if (forcing.value == 'cm') {
        temporal.options[1] = new Option("Monthly", "monthly");
        temporal.value = "monthly" //default
    } else if (forcing.value == 'rg' || 'gdas') {
        temporal.options[1] = new Option("Daily", "daily");
        temporal.options[2] = new Option("Monthly", "monthly");
        temporal.value = "daily" //default
    }
    handleDate();
    mapInit();
}
// Modify the date format according to selected temporal option
function handleDate() {
    if (temporal.value == "monthly") {
        document.getElementById('seldate').type = "month";
        var date = new Date();
        date.setDate(date.getDate() - 1);
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString(); // getMonth() is zero-based
        document.getElementById('seldate').value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0])

        var elem = document.createElement('input');
        elem.setAttribute('type', 'date');
        //safari/firefox
        if (elem.type === 'text') {
            $('#seldate').prop("disabled", true);
        } else {
            $('#seldate').prop("disabled", false);
        }


    } else if (temporal.value == "daily") {
        $('#seldate').prop("disabled", false);
        document.getElementById('seldate').type = "date";
        var date = new Date();
        date.setDate(date.getDate() - 1);
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString(); // getMonth() is zero-based
        var dd = date.getDate().toString();
        document.getElementById('seldate').value = yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]);
    }
    mapInit();
}
// Load leaflet map and the queried datasets
function mapInit() {
    if (temporal.value == "daily") {
        $('#seldate').prop("disabled", false);
    }
    //Reset map
    if (map.hasLayer(dataLayer)) {
        $(dataLayer._image).fadeOut(200, function() {
            //map.removeLayer(dataLayer);
        });
    }
    if ((layerControl._map)) {
        layerControl.remove(map);
    }
    if (map.hasLayer(gibsLayers['Reference_Features'])) {
        map.removeLayer(gibsLayers['Reference_Features']);
    }
    map.removeControl(legendG)

    var id_added = 'none'
    for (var id in L.GIBS_LAYERS) {
        if (map.hasLayer(gibsLayers[id])) {
            id_added = id
            map.removeLayer(gibsLayers[id]);
        }
    }

    if ((gibscontrol._map)) {
        gibscontrol.remove(map);

    }

    map.removeLayer(afghanistanS6)
    map.removeLayer(afghanistanT7)
    map.removeLayer(westafricaS2)
    map.removeLayer(westafricaT3)
    map.removeLayer(southafricaS4)
    map.removeLayer(southafricaT5)
    map.removeLayer(eastafricaS0)
    map.removeLayer(eastafricaT1)

    // gibs control
    var x = document.getElementById("compare");
    if (x.checked == true) {
        var dateOrig = document.getElementById('seldate').value;

        for (var id in L.GIBS_LAYERS) {
            gibsLayers[id] = new L.GIBSLayer(id, {
                date: new Date(dateOrig),
                transparent: true
            });
        }

        gibsLayers['Reference_Features'].addTo(map);
        gibsLayers['Reference_Features'].bringToFront();

        //styled control
        baseMapsGibs = [{
                groupName: "Surface Temperature",
                //expanded: true,
                layers: {
                    "MODIS Terra (Day)": gibsLayers['MODIS_Terra_Land_Surface_Temp_Day'],
                    "MODIS Terra (Night)": gibsLayers['MODIS_Terra_Land_Surface_Temp_Night'],
                    "MODIS Aqua (Day)": gibsLayers['MODIS_Aqua_Land_Surface_Temp_Day'],
                    "MODIS Aqua (Night)": gibsLayers['MODIS_Aqua_Land_Surface_Temp_Night']
                }
            },
            {
                groupName: "Precipitation",
                layers: {
                    "AMSR2 Surface ppt rate (Day) ": gibsLayers['AMSR2_Surface_Precipitation_Rate_Day'],
                    "AMSR2 Surface ppt rate (Night) ": gibsLayers['AMSR2_Surface_Precipitation_Rate_Night'],
                    "Aqua/AIRS precipitation(Day)": gibsLayers['AIRS_Precipitation_Day'],
                    "Aqua/AIRS precipitation(Night)": gibsLayers['AIRS_Precipitation_Night']

                }
            },
            {
                groupName: "Snow Water Equivalent",
                layers: {
                    "AMSR2 SWE": gibsLayers['AMSR2_Snow_Water_Equivalent']
                }
            },
            //            {
            //                groupName: "Snow Cover",
            //                layers: {
            //                    "Modis Terra Snow Cover": gibsLayers['MODIS_Terra_Snow_Cover'],
            //                    "Modis Aqua Snow Cover": gibsLayers['MODIS_Aqua_Snow_Cover'],
            //                    //                    "Modis Terra NDSI": gibsLayers['MODIS_Terra_NDSI_Snow_Cover'],
            //                    //                    "Modis Aqua NDSI": gibsLayers['MODIS_Aqua_NDSI_Snow_Cover']
            //
            //                }
            //            },

            {
                groupName: "Corrected Reflectance",
                layers: {
                    "MODIS Terra (True Color)": gibsLayers['MODIS_Terra_CorrectedReflectance_TrueColor'],
                    "MODIS Aqua (True Color)": gibsLayers['MODIS_Aqua_CorrectedReflectance_TrueColor'],
                    "MODIS Terra (Bands 7-2-1)": gibsLayers['MODIS_Terra_CorrectedReflectance_Bands721'],
                    "MODIS Aqua (Bands 7-2-1)": gibsLayers['MODIS_Aqua_CorrectedReflectance_Bands721'],


                }
            },
            {
                groupName: "Soil Moisture",
                layers: {
                    //                    "SMAP L3 Active (3km)": gibsLayers['SMAP_L3_Active_Soil_Moisture'],
                    //                    "SMAP L3 Active-Passive (9km)": gibsLayers['SMAP_L3_Active_Passive_Soil_Moisture'],
                    "SMAP L3 Passive (Day, 9km)": gibsLayers['SMAP_L3_Passive_Enhanced_Day_Soil_Moisture'],
                    "SMAP L3 Passive (Night, 9km)": gibsLayers['SMAP_L3_Passive_Enhanced_Night_Soil_Moisture'],
                    "AMSR-U2 NPD (Day, 25km)": gibsLayers['AMSRU2_Soil_Moisture_NPD_Day'],
                    "AMSR-U2 NPD (Night, 25km)": gibsLayers['AMSRU2_Soil_Moisture_NPD_Night']
                }
            }
        ];

        overlayGibs = [{
            groupName: "Borders",
            expanded: true,
            layers: {
                "Country/State Borders": gibsLayers['Reference_Features']
            }
        }];

        options = {
            container_width: "210px",
            group_maxHeight: "80px",
            //container_maxHeight : "350px",
            exclusive: false,
            collapsed: false,
            position: 'bottomright',
            autoZIndex: true
        };

        gibscontrol = L.Control.styledLayerControl(baseMapsGibs, overlayGibs, options);
        map.addControl(gibscontrol);

        if (id_added != 'none') {
            gibsLayers[id_added].addTo(map);
        }

        //  Legend for GIBS layer
        map.on('baselayerchange', function(e) {
            if (e.name == 'MODIS Terra (True Color)' || e.name == 'MODIS Aqua (True Color)' || e.name == 'MODIS Terra (Bands 7-2-1)' || e.name == 'MODIS Aqua (Bands 7-2-1)') {
                map.removeControl(legendG)
                legendG.onAdd = function(map) {
                    var div = L.DomUtil.create('div', 'legend');
                    div.innerHTML += '<b><center>' + e.name + '</b></center>';
                    return div;
                };
            } else {
                var selgibs = (e.layer._layerInfo.title)
                map.removeControl(legendG)
                legendG.onAdd = function(map) {
                    var div = L.DomUtil.create('div', 'legend');
                    div.innerHTML += '<b><center>' + e.name + '</b></center>';
                    div.innerHTML += '<img src="images/gibs/' + selgibs + '.png" /><br>';
                    return div;
                };
            }

            legendG.addTo(map);
        });

    }
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
        onEachFeature: pop_afghanistanT,
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
        onEachFeature: pop_southafricaT,
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
        onEachFeature: pop_westafricaT,
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
        onEachFeature: pop_eastafricaT,
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
        getBounds: function() {
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
    var strTemporal = temporal.options[temporal.selectedIndex].value;

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
        yearpick = datepick.substring(0, 4);
        //path to data layer
        var imgdata = 'DATA_DIR/tile/' + strRegion + '/' + strModel + '/' + strForcing + '/' + strTemporal + '/' + strDataset + '/' + yearpick + '/' + datepick + '.png';


        if (region.value == 'centralasia') {
            layerControl.addOverlay(afghanistanT7, '<img src="legend/ts.png" width=17px style="vertical-align: middle" /> Timeseries');
            layerControl.addOverlay(afghanistanS6, '<img src="legend/stat.png" width=15px style="vertical-align: middle"/> Statistics');
            var img_bounds = [ // CA
                [25, 60],
                [40, 90]
            ];

        } else if (region.value == 'eastafrica') {
            //uncomment the next line if adding statistics
            layerControl.addOverlay(eastafricaT1, '<img src="legend/ts.png" style="vertical-align: middle" width=17px /> Timeseries');
            //layerControl.addOverlay(eastafricaS0, '<img src="legend/stat.png" width=20px /> Statistics');
            if (model.value == 'noah') {
                var img_bounds = [ // EA - NOAH
                    [-11.70,22.00],//[-12.0, 21.75],
                    [23.00,51.40]//[23.25, 51.25]
                ];
            }else if (model.value == 'vic') {
                var img_bounds = [ // EA - VIC
                    [-11.75,21.75],//[-12.0, 21.75],
                    [23.25,51.25]//[23.25, 51.25]
                ];
            }
        } else if (region.value == 'southernafrica') {
            //uncomment the next line if adding statistics
            layerControl.addOverlay(southafricaT5, '<img src="legend/ts.png" width=17px style="vertical-align: middle"/> Timeseries');
            //layerControl.addOverlay(southafricaS4, '<img src="legend/stat.png" width=20px /> Statistics');
            if (model.value == 'noah') {
                var img_bounds = [ // SA - NOAH
                    [-37.9,6.0],//[-37.8, 6.0],
                    [6.4, 54.6]
                ];
            } else if (model.value == 'vic') {
                var img_bounds = [ // SA - VIC
                    [-34.50,5.75],//[-34.75, 5.75],
                    [6.75, 51.25]
                ];
            }
        } else if (region.value == 'westafrica') {
            //uncomment the next line if adding statistics
            layerControl.addOverlay(westafricaT3, '<img src="legend/ts.png" width=17px style="vertical-align: middle"/> Timeseries');
            //layerControl.addOverlay(westafricaS2, '<img src="legend/stat.png" width=20px /> Statistics');
            if (model.value == 'noah') {
                var img_bounds = [ // WA - NOAH
                    [5.3, -18.7],
                    [17.7, 25.9]
                ];
            } else if (model.value == 'vic') {
                var img_bounds = [ // WA - VIC
                    [5.0, -17.25],
                    [18.0, 25.75]
                ];
            }
        }
        // add png overlay
        dataLayer = new L.imageOverlay(imgdata, img_bounds, {
            opacity: 1,
            interactive: false
        });


        $('#bgopacity').on('input', function(value) {
            dataLayer.setOpacity($(this).val() * '.01');
        });

        // save dataset option
        document.getElementById("savebtn").onclick = function() {
            var a = document.createElement('a');
            var urldata = strRegion + '_' + strModel + '_' + strForcing + '_' + strTemporal + '_' + strDataset + '_' + datepick + '.png';
            a.href = imgdata;
            a.download = urldata;
            a.click();
        };


        // Adding legends
        map.removeControl(legendSM);
        map.removeControl(legendT);
        map.removeControl(legendTA);
        map.removeControl(legendSW);
        map.removeControl(legendP);
        map.removeControl(legendET);

        if (dataset.value == 'swe') {

            // Legend////////
            legendSW.onAdd = function(map) {
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
            legendSM.onAdd = function(map) {
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
            legendT.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<center><b>Temperature (˚C)</b></center>';
                div.innerHTML += '<img src="images/temperature.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendT.addTo(map);
            ////////////////


        } else if (dataset.value == 'temperature_anomaly') {

            // Legend////////
            legendTA.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<center><b>Temperature Anomaly(˚C)</b></center>';
                div.innerHTML += '<img src="images/temperature_anomaly.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendTA.addTo(map);
            ////////////////


        } else if (dataset.value == 'precipitation') {

            // Legend////////
            legendP.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<center><b>Precipitation (mm/day)</b></center>';
                div.innerHTML += '<img src="images/precipitation.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendP.addTo(map);
            ////////////////


        } else if (dataset.value == 'evapotranspiration') {

            // Legend////////
            legendET.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<center><b>Evapotranspiration (mm/day)</b></center>';
                div.innerHTML += '<img src="images/evapotranspiration.png" /><br>';
                div.innerHTML += '<center><font size="2" color="black">Dataset for <b>' + dateOrig + '</b></font></center>';
                return div;
            };
            legendET.addTo(map);
            ////////////////


        }

        // give message if data unavailable
        var http = new XMLHttpRequest();
        http.open('HEAD', imgdata, false);
        http.send();

        // get id of message/compare divs to display on data loading
        var msg = document.getElementById('message');
        var opc = document.getElementById('selOpacity');
        var cmp = document.getElementById('comp_checkbox');
        var exp = document.getElementById('exportdiv');
        if (http.status != 404) {
            msg.style.display = 'none';
            opc.style.display = 'block';
            cmp.style.display = 'block';
            exp.style.display = 'block';

            map.addLayer(dataLayer);
            var imgElement = dataLayer.getElement();
            dataLayer.getElement().classList.add('styleOverlay');
            return "datapresent";
        } else {
            msg.style.display = 'block';
            opc.style.display = 'none';
            cmp.style.display = 'none';
            exp.style.display = 'none';

            $(document).ready(function() {
                $('#message').delay(2500).fadeOut();
            });
        }



    }
}
