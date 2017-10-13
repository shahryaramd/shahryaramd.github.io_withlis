<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" href="globe3d.png">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
    <link rel="stylesheet" href="../src/leaflet-search.css" />
    <link rel="stylesheet" type="text/css" href="qw2/css/qgis2web.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src='https://api.mapbox.com/mapbox.js/v2.2.1/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.2.1/mapbox.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />
  <!-- <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/> -->

    <link rel="stylesheet" href="../js/leaflet.zoomhome.css"/>
    <link rel="stylesheet" href="Print/dist/easyPrint.css"/>
   <link rel="stylesheet" href="mylocation/dist/L.Control.Locate.min.css" />
   <link rel="stylesheet" href="mylocation/style.css" />
   <link rel="stylesheet" href="legend/src/leaflet-panel-layers.css" />
   <link rel="stylesheet" href="legend/icons.css" />
   <link rel="stylesheet" href="sidebar/css/leaflet-sidebar.css" />
   <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="../js/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.6.0/js/mui.min.js"></script>
    <!-- <script src="https://use.fontawesome.com/ac0fc3f247.js"></script> -->
    <script src="../js/fonticon.js" ></script>
   <link rel="stylesheet" href="qw2/css/label.css" />
    <link rel="stylesheet" href="qw2/css/MarkerCluster.css" />
    <link rel="stylesheet" href="qw2/css/MarkerCluster.Default.css" />
    <!-- <link rel="stylesheet" href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css" /> -->
    <link rel="stylesheet" type="text/css" href="webgis.css">
    <!--<link 
        rel="stylesheet" 
        href="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.css"
    />-->
   
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="materialize/js/materialize.min.js"></script> -->

    <script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js" type="text/javascript"></script>
    <script src="../src/leaflet-search.js"></script>
    <script src="../js/leaflet.zoomhome.js"></script>
<!-- For popup -->
    <script src="../js/jquery.bpopup.min.js"></script>

    
    <!-- for qgis2web -->
    <script src="qw2/js/OSMBuildings-Leaflet.js"></script>
    <script src="qw2/js/leaflet-hash.js"></script>
    <script src="qw2/js/label.js"></script>
    <script src="qw2/js/Autolinker.min.js"></script>
    <!-- <script src="http://k4r573n.github.io/leaflet-control-osm-geocoder/Control.OSMGeocoder.js"></script> -->
    <script src="qw2/js/proj4.js"></script>
    <script src="qw2/js/proj4leaflet.js"></script>
    <script src="qw2/js/leaflet.markercluster.js"></script>
<!-- /////////////// -->
    <link rel="stylesheet" href=" Leaflet.MeasureControl-gh-pages/Leaflet.draw/dist/leaflet.draw.css" />
    <link rel="stylesheet" href=" Leaflet.MeasureControl-gh-pages/leaflet.measurecontrol.css" />

    <script type="text/javascript" src="myrouting.js"></script>

    <script src=" Leaflet.MeasureControl-gh-pages/Leaflet.draw/dist/leaflet.draw.js"></script>

    <script src=" Leaflet.MeasureControl-gh-pages/leaflet.measurecontrol.js"></script>

    <link href='fullscr/leaflet.fullscreen.css' rel='stylesheet' />
    <script src='fullscr/Leaflet.fullscreen.min.js'></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.s/mq-map.js?key=aLnojtzcFJOuNAd6BxA3uz8pn7PHhrWv"></script>
        <script src="https://www.mapquestapi.com/sdk/leaflet/v2.s/mq-routing.js?key=aLnojtzcFJOuNAd6BxA3uz8pn7PHhrWv"></script>

    <!---->
    <title>IIT Kanpur WebGIS</title>
  </head>
  <body>
    <!-- Data layers -->
        <script src="qw2/data/json_Landuse2015any0.js"></script>
        <script src="qw2/data/json_Academic1.js"></script>
        <script src="qw2/data/json_Facilities2.js"></script>
        <script src="qw2/data/json_Residential3.js"></script>
        <script src="qw2/data/json_ShopsCanteens4.js"></script>
        <script src="qw2/data/json_FitnessSports5.js"></script>
        <script src="qw2/data/json_EventVenues6.js"></script>
        <script src="qw2/data/json_Religious7.js"></script>
        <script src="qw2/data/json_Parking8.js"></script>
        <script src="qw2/data/json_HallWalkways9.js"></script>
        <script src="qw2/data/json_ParksLawns10.js"></script>
        <script src="qw2/data/json_Waterbody11.js"></script>
        <script src="qw2/data/json_Security12.js"></script>
        <script src="qw2/data/json_Unconstructed13.js"></script>
        <script src="qw2/data/json_Roads14.js"></script>
        <script src="qw2/data/json_Contours15.js"></script>
        <script src="qw2/data/json_Landmarks16.js"></script>
        <script src="qw2/data/json_IITKBoundary17.js"></script>
        <script src="qw2/data/json_Merged18.js"></script>
        <script src="qw2/data/json_Mergednew18.js"></script>
    <!-- ////////////////// -->

    <script src="Print/dist/leaflet.easyPrint.js"></script>
    <script src="Print/dist/jQuery.print.js"></script>


    <div style="">
          <img src="globe3d.png" style="z-index: -1; position:fixed; height:85px;width:85px;left:20px;top:10px;">
          <H2 style="position: absolute; z-index: 2;margin-top:25px;padding-left:100px; 
          /*color: rgb(106, 38, 128);*/
          color: #fff;
          font-family: 'Roboto', sans-serif;
        font-size: 30px;"> <span style="font-size:40px">G</span>EOGRAPHICAL <span style="font-size:40px">I</span>NFORMATION <span style="font-size:40px">S</span>YSTEM </H2> 
      <!-- <i><span style="font-size:60%">for</span> </i> IIT KANPUR </H2> -->
             
             <a href="https://iitk.ac.in"><img src="iitkwhite1.png" style="z-index:10;height:77px;width:360px;position:fixed;top:20px;left:920px;"></a>


       </div>
    <div id="welcomesign"  style=" margin-left:1000px;">
        <p>Welcome <?php echo $userRow['user_name']; ?>! &nbsp;&nbsp;&nbsp;<a href="logout.php?logout">Sign Out</a></p>
    </div>

<div style="margin-left:670px;margin-top:-20px;">
<!-- <a href="http://www.showmyweather.com/in/kanpur/" title="Kanpur India Weather Forecast" onclick="window.open(this.href);return(false);"><script type="text/javascript" src="http://www.showmyweather.com/weather_widget.php?int=1&type=js&country=in&state=&city=Kanpur&smallicon=1&current=1&forecast=0&color=fff&width=175&padding=1&border_width=1&border_color=fff&font_size=11&font_family=Sans Serif&showicons=1&measure=&d=2016-06-19"></script></a><div style="width:177px;text-align:center;font-size:0.6em;margin-top:0.5em;"><a href="https://weather.com/en-IN/weather/today/l/26.51,80.23">Detailed Weather</a></div> -->
    <div id="findbox_top"></div>
    <div style="margin-left:60px"><a href="https://weather.com/en-IN/weather/today/l/26.51318,80.23306">IITK Weather</a></div>

</div>
<!-- SIDEBAR/////////////// -->
      <div id="sidebar" class="sidebar collapsed">
              <!-- Nav tabs -->
              <div class="sidebar-tabs">
                  <ul role="tablist">
                      <li><a href="#home" role="tab" title="Home"><i class="fa fa-home"></i></a></li>
                      <li><a href="#profile" role="tab" title="Search"><i class="fa fa-binoculars"></i></a></li>
                      <li><a href="#fb" role="tab" title="Interior Navigation"><i class="fa fa-street-view"></i></a></li>
                      <li ><a href="#messages" role="tab" title="Path Finder"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></li>
                      <li ><a href="#shutdown" role="tab" title="Add Notifications"><i class="fa fa-bell" aria-hidden="true"></i></i></a></li>
                      <li ><a href="#seeshutdown" role="tab" title="See Cuurent Notifications"><i class="fa fa-eye" aria-hidden="true"></i></i></a></li>
                      <li ><a href="#events" role="tab" title="Add an Event"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></i></a></li>
                      <li ><a href="#showevents" role="tab" title="See Upcoming/Current Events"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></i></a></li>
                      <li ><a href="#lnf" role="tab" title="Add Lost/Found Item"><i class="fa fa-search-plus" aria-hidden="true"></i></i></a></li>
                      <li ><a href="#showlnf" role="tab" title="See Lost/Found Items"><i class="fa fa-search" aria-hidden="true"></i></i></a></li>
                      <li ><a href="#bird" role="tab" title="Sighted a creature?"><i class="fa fa-camera-retro"></i></i></a></li>
                  </ul>

                  <ul role="tablist">
                      <li><a href="#about" title="About" role="tab"><i class="fa fa-info-circle"></i></a></li>
                  
                      <li><a href="#settings" title="Help" role="tab"><i class="fa fa-question-circle-o"></i></a></li>
                  </ul>
              </div>

              <!-- Tab panes -->
              <div class="sidebar-content">
                  <div class="sidebar-pane" id="home" >
                      <h1 class="sidebar-header">Home<div class="sidebar-close"><i class="fa fa-caret-left"></i></div>
                      </h1>

                      <h2 align="center">Welcome to Web GIS of IIT Kanpur</h2>
                       <img src="iitk3.jpg" width="100%" height="100%" style="position:relative;opacity:1;">
                        <button style="margin-left: 60px;" class="mui-btn mui-btn--raised mui-btn--primary" onclick="map.setView([26.50943,80.23397], 15);"> <i class="fa fa-undo"></i> Reset View </button>
                  </div>

                  <div class="sidebar-pane" id="profile">
                      <h1 class="sidebar-header">Search<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                    <!-- SEARCH STARTS HERE -->
                    <div id="tabs_container">     
                        <ul id="tabs">
                            <li class="active"><a href="#tab1">Search All</a></li>
                            <li><a class="icon_accept" href="#tab2">Search Specific</a></li>
                            <!-- <li><a href="#tab3">Get position</a></li> -->
                        </ul>
                        </div>

                        <div id="tabs_content_container">
                          <div id="tab1" class="tab_content" style="display: block;">
                                  <p> Search All Buildings</p><br>
                                  <div id="findbox_allbldg"></div>
                                                
                                  <button class= "mui-btn mui-btn--raised mui-btn--primary" onclick="getcent(); return false;" > Locate on Google Maps</button>
                                  <img src="gm.png" title="Locate on Google Maps" style="height:45px;width:45px;margin-left:20px;display:inline;position:absolute;">
                                  
                          </div>
                          <div id="tab2" class="tab_content" >
                           
                            <p> Academic: </p>
                              <div id="findbox_acad"></div>
                              <p> Residential: </p>
                              <div id="findbox_resid"></div>
                              <div id="findbox_resid_house"></div>
                              <div id="findbox_resid_hall"></div>
                              <p>Facilities: </p>
                              <div id="findbox_fac"></div>
                              <div id="findbox_shops"></div>
                             <div id="findbox_fit"></div>
                              <div id="findbox_rel"></div>
                              <p>Security</p>
                               <div id="findbox_sec"></div>
                          </div>
                          <!-- <div id="tab3" class="tab_content">

                            <button onclick="onMapClick(e)">Get coordinates</button>
                              <script>
                               
                                function onMapClick(e) {
                                var popup = L.popup()
                                .setLatLng(e.latlng)
                                .setContent("You clicked the map at " + e.latlng)
                                .openOn(map);
                              </script>
                          </div> -->
                        </div>
                         <script type="text/javascript">
                        $(document).ready(function(){
                              //  When user clicks on tab, this code will be executed
                              $("#tabs li").click(function() {
                                  //  First remove class "active" from currently active tab
                                  $("#tabs li").removeClass('active');
                           
                                  //  Now add class "active" to the selected/clicked tab
                                  $(this).addClass("active");
                           
                                  //  Hide all tab content
                                  $(".tab_content").hide();
                           
                                  //  Here we get the href value of the selected tab
                                  var selected_tab = $(this).find("a").attr("href");
                           
                                  //  Show the selected tab content
                                  $(selected_tab).fadeIn();
                           
                                  //  At the end, we add return false so that the click on the link is not executed
                                  return false;
                              });
                          });
                        </script>
     
                     <!--  <div id="findbox"></div>
                      <div id="findbox2"></div>
                      <div id="findbox3"></div> -->
                  </div>

                  <div class="sidebar-pane" id="fb">
                      <h1 class="sidebar-header">Interior Navigation<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                        <div id="fbtext" class="mui-container">
                          <br><br>
                          <h3> You can query with : </h3>
                          <ul> 
                            <li> Name of any professor</li>
                            <li> Name of facility at FB </li>
                            <li> Room number </li>
                          </ul>
                        <button id="my-button" class= "mui-btn mui-btn--raised mui-btn--accent"> <i class="fa fa-street-view"></i>Start Navigating</button>
                        <div id="element_to_pop_up">
                            <a class="b-close"><img src="X.png" height="10px" width="10"></a>
                            <iframe src="qwfb/indexnew.html" width="500px" frameborder="0" height="600px"></iframe>
                        </div>
                        </div>
                  </div>                      


                  <div class="sidebar-pane" id="messages">
                      <h1 class="sidebar-header">Routing<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                      <!-- <button id="findroute">Start Routing</button> -->
                      <div id="findbox_from"></div>
                      
                      <input type="button" id="startbt" class= "button-0" onclick="document.getElementById('endbt').disabled=false;startloc(); return false;" value="Confirm Start" />
                      <br>
                      <div id="findbox_to"></div>
                      
                       <input type="button" id="endbt" class= "button-0" onclick="document.getElementById('startbt').disabled=true;endloc(); return false;" value="Confirm End " />
                       <script type="text/javascript">
                         document.getElementById("endbt").disabled = true;
                       </script>
                     
                      <!-- <input name="textbox1" id="textbox1" type="text" /> -->
                      
                      <br><br><br>
                      <div>
                      <button style="left:50px;" class="mui-btn mui-btn--raised mui-btn--accent" onclick="routingfunction(); return false;"><i class="fa fa-car"></i> Find Route</button>
                   
                      <button class="mui-btn mui-btn--raised mui-btn--danger"  onclick="getdirn(); return false;"><i class="fa fa-google" aria-hidden="true"></i> Navigate on Google Maps</button>
                      </div>
                      <!-- <img src="gm.png" title="View on Google Maps" style="z-index:10000;height:40px;width:40px;display:inline;margin-left:150px;margin-top:20px;"> -->

                      <!-- <input type="button" class= "button-gm" id="button-gd" onclick="getdirn(); return false;" value="View on Google Maps" /> -->
                      
                      <div id='route-narrative' style="padding-top: 95px; color: #228B22; font-family:Arial, Helvetica, sans-serif">
                      </div>
                  
                  </div>

                  <div class="sidebar-pane" id="shutdown">
                      <h1 class="sidebar-header">Shutdown Notifications<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                        <p> </p>
                        <div id="findbox_shut"></div>
                        <form name="form1" > 
                          <input type="button" id="addshut" class= "mui-btn mui-btn--small mui-btn--fab mui-btn--primary" onclick="addshutplace(); return false;" value="  +  " />
                          
                          <input type="button" id="delshut" class= "mui-btn mui-btn--small mui-btn--fab mui-btn--primary" onclick="delshutplace(); return false;" value=" -  " />
                          <select name="listValue" id="listbox" multiple>
                            <option value="empty">
                          </select>

                          <select id="shutselect">
                          <option value="void">Select Shutdown Type</option>
                
                          <option value="1">Electricity</option>
                          <option value="2">Honey Beehives Removal</option>
                          <option value="3">Water</option>
                           <option value="4">Miscellaneous</option>
                          </select>
                          <input type="text" placeholder="Enter Description" class="eventinfo" id="shutdescr"><br>
                          <!-- Date/time select for ending shutdown -->
                          <div id="closedate">

                              <script src="webshim-1.15.10/js-webshim/dev/polyfiller.js"></script>
                              <script>
                                  webshim.setOptions("forms-ext", {
                                                    "datetime-local": {
                                                    "openOnFocus": true,
                                                    "calculateWidth": false,
                                                    "popover": {
                                                      "position": {
                                                        "my": "left middle",
                                                        "at": "right middle"
                                                      },
                                                      "inline": true
                                                    }
                                                  }
                                                  });
                                  webshims.polyfill('forms forms-ext');
                            </script>
                            <input id="datetime-shutstrt"  class="eventinfo" placeholder="Shutdown Start Time" type="datetime-local" />
                            <input id="datetime-shutend"  class="eventinfo" placeholder="Shutdown End Time" type="datetime-local" />
                          </div>
                          <!-- ////////////// -->

                          <input type="button" id="submshut" class= "mui-btn mui-btn--raised mui-btn--accent" onclick="submshutplace();" value="Submit Information" />
                          
                          <br><br><br>
                          <div id="status"></div>

                        </form>
                        
                        <!-- <button class="button-0" id="shuttype" onclick="selshuttype();" type="button"> Confirm </button> -->
                  </div>


                  <!-- SEE SHUTDOWN -->
                  <div class="sidebar-pane" id="seeshutdown">
                      <h1 class="sidebar-header">Know Shutdown Locations<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                      <form name="form2">
                      <select id="shutselectsee">
                      <option value="void">Select Shutdown Type</option>
                      <option value="1">Electricity</option>
                      <option value="2">Honey Beehives Removal</option>
                      <option value="3">Water</option>
                       <option value="4">Miscellaneous</option>
                      </select>
                      <br>
                    
                      <input type="button" id="seeshut" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="seeshutplace();" value="SHOW" />
                      <input type="button" id="hideshut" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="hideshutplace();" value="HIDE" />

                      <br><br><br>
                      <div id="gethead"></div>
                        <select name="listValue" id="listboxsee" multiple>
                            <option value="empty">
                          </select>
                    <div id="findbox_see"></div>
                      </form>

                  </div>

                  <!-- Events -->
                   <div class="sidebar-pane" id="events">
                      <h1 class="sidebar-header">Add Events<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                      
                      <div id="event_loc_all"></div>
                      <br>
                      <input type="text" placeholder="Enter Event Name" class="eventinfo" id="eventname"><br>
                      <input type="text" placeholder="Enter Description" class="eventinfo" id="eventdescr"><br>
                      <input type="text" placeholder="Your Name" class="eventinfo" id="adder"><br>
                      
                       <input id="datetime-eventstart" class="eventinfo" placeholder="Event Starts At" type="datetime-local" /><br>
                       <input id="datetime-eventend" class="eventinfo" placeholder="Event Ends At" type="datetime-local" />
                       
                       <br>
                       <input type="button" id="addevent" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="addevent();" value=" + ADD EVENT" />
                       <br><br><br><br>
                       <div style="top:30px;" id="statusevent"></div>
                  </div>

                  <!-- Show events -->
                  <div class="sidebar-pane" id="showevents">
                      <h1 class="sidebar-header">See Upcoming Events<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>

                      <input type="button" id="showevent" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="showevent();" value="SHOW events" />
                      <input type="button" id="hideevent" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="hideevent();" value="hide" />
                      <form name="form3">
                      <br><br><br>
                      <div id ="getheadev"></div>
                      <select name="listValue" id="listboxevent" multiple>
                            <option value="empty">
                      </select>
                      <div id="findbox_event"></div>
                      </form>


                  </div>

                  <!-- Lost and found -->
                   <div class="sidebar-pane" id="lnf">
                      <h1 class="sidebar-header">Lost and Found Portal<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                      
                      <div id="lnf_loc_all"></div>
                      <br>
                      <form name="form4"></form>
                      <input type="text" placeholder="Enter Object Name" class="eventinfo" id="objname"><br>
                      <input type="text" placeholder="Enter Description" class="eventinfo" id="objdescr"><br>
                      <input type="text" placeholder="Your Name" class="eventinfo" id="objadder"><br>
                      <input type="text" placeholder="Your Address" class="eventinfo" id="objaddress"><br>
                      <input id="datetime-obj" class="eventinfo" placeholder="Enter Date and Time" type="datetime-local" /><br>
                      <select id="objsel">
                      <option value="void">Select Lost/Found</option>
                      <option value="1">Lost</option>
                      <option value="2">Found</option>
                      </select>
                       
                       
                       <input type="button" id="addobj" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="addobj();" value="Add Information" />
                       <div style="top:30px;" id="statusobj"></div>
                  </div>

                  <!-- Show lost and found -->
                  <div class="sidebar-pane" id="showlnf">
                      <h1 class="sidebar-header">See Lost and Found Objects <div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                      <form name="form5">
                      <select id="seeobjsel">
                      <option value="void">Select Lost/Found</option>
                      <option value="1">Lost</option>
                      <option value="2">Found</option>
                      </select>
                   
                       <input type="button" id="showobj" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="shobj();" value="Show objects" />
                       <input type="button" id="hideobj" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="hdobj();" value="Hide" />
                      <br><br><br>
                      <div id ="getheadobj"></div>
                      <select name="listValue" id="listboxobj" multiple>
                            <option value="empty">
                      </select>
                      <div id="findbox_obj"></div>
                      </form>
                  </div>

                  <!-- Birds adding -->
                   <div class="sidebar-pane" id="bird">
                      <h1 class="sidebar-header">Spotted a bird? <div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>

                      <input type="button" id="seebr" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="seebr();" value="See Current Sightings" />
                      <input type="button" id="hidebr" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="hdbr();" value="Hide" />
                      <div id="getheadbr" style="margin-top:15px;"></div>
                      <hr>
                      <h2 align="center"> Add Sightings</h2>

                      
                      <input type="text" placeholder="Enter Creature Name" class="eventinfo" id="brname"><br>
                      <input type="text" placeholder="Enter Description" class="eventinfo" id="brdescr"><br>
                      <input type="text" placeholder="Your Name" class="eventinfo" id="bradder"><br>

                      <p style="font-size: 14px;"> Place marker from <i class="fa fa-map-marker"></i> icon on map to enter location !</p> 
                      <input type="button" id="addbrloc" class= "mui-btn mui-btn--raised mui-btn--primary" onclick="addbrloc();" value="Confirm Location" />

                      <br><br>
                      <input type="text" placeholder="Location" class="eventinfo" id="brloc" disabled><br>

                       <input id="datetime-br" class="eventinfo" placeholder="Enter Date and Time" type="datetime-local" /><br>
                       
                       <input type="button" id="addbr" class= "mui-btn mui-btn--raised mui-btn--accent" onclick="addbr();" value="+ Add Information" />
                       <div style="top:30px;" id="statusbr"></div>



                   </div>

                  <div class="sidebar-pane" id="about">
                      <h1 class="sidebar-header">About<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                        <br>
                        <img src="abts.png" height="100%" width="100%"><br><br>
                        <p align="center" style="font-size: 17px;"> The Web-based GIS of IIT Kanpur has been developed as an undergraduate project under Prof. Bharat Lohani, Department of Civil Engineering, IIT Kanpur. All the data is copyright to Geoinformatics Division, IIT Kanpur. </p><br><br>
                        <hr>

                        <p align="center">Please provide your valuable feedback and report any bugs to Shahryar K Ahmad (shahryar@iitk.ac.in) or Prof. Bharat Lohani (blohani@iitk.ac.in)</p>



                  </div>
                  <div class="sidebar-pane" id="settings">
                      <h1 class="sidebar-header">Help<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
                        <br>
                        <img src="help.jpeg" height="100%" width="100%"><br>
                        
                        <h3>From here, you can:</h3>
                        <ul>
                          <li>Get details of any place just by clicking  on any map feature</li>
                          <li>Measure perimeter</li>
                          <li>Measure area</li>
                          <li>Draw arbitrary polygons and get their statistics</li>
                          <li>Search for a feature</li>
                          <li>Add and see shutdown notifications</li>
                          <li>Add and see current and upcoming events in campus</li>
                          <li>Add and locate lost and found items</li>
                          <li>Add and see sightings in campus</li>
                        </ul>
                  </div>
              </div>
          </div>


       <!-- /////////////// -->

     <div id="overlay">
        <div id="progstat"></div>
        <div id="progress"></div>
      </div>

    <div id="map" class="sidebar-map"></div>
    <div id="route-narrative"></div>
    <script src="sidebar/js/leaflet-sidebar.js"></script>

    <script src="legend/src/leaflet-panel-layers.js"></script>

    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-geodesy/v0.1.0/leaflet-geodesy.js'></script>
    <script src="mylocation/src/L.Control.Locate.js" ></script>
   <!-- style landmark  -->
   <style type="text/css">

    .labelandmarks {

      background: rgb(235, 235, 235);
      background: rgba(235, 235, 235, 0.81);
      background-clip: padding-box;
      border-color: #777;
      border-color: rgba(0,0,0,0.25);
      border-radius: 4px;
      border-style: solid;
      border-width: 4px;
      color: #111;
      display: block;
      font: 12px/20px "Helvetica Neue", Arial, Helvetica, sans-serif;
      font-weight: bold;
      padding: 1px 6px;
      position: absolute;
      -webkit-user-select: none;
         -moz-user-select: none;
          -ms-user-select: none;
              user-select: none;
      pointer-events: none;
      white-space: nowrap;
     }

  </style>
<!-- For page loading -->
<script type="text/javascript">
;(function(){
  function id(v){return document.getElementById(v); }
  function loadbar() {
    var ovrl = id("overlay"),
        prog = id("progress"),
        stat = id("progstat"),
        img = document.images,
        c = 0;
        tot = img.length;

    function imgLoaded(){
      c += 1;
      var perc = ((100/tot*c) << 0) +"%";
      prog.style.width = perc;
      stat.innerHTML = "Loading "+ perc;
      if(c===tot) return doneLoading();
    }
    function doneLoading(){
      ovrl.style.opacity = 0;
      setTimeout(function(){ 
        ovrl.style.display = "none";
      }, 1200);
    }
    for(var i=0; i<tot; i++) {
      var tImg     = new Image();
      tImg.onload  = imgLoaded;
      tImg.onerror = imgLoaded;
      tImg.src     = img[i].src;
    }    
  }
  document.addEventListener('DOMContentLoaded', loadbar, false);
}());
  
    // For Login Popup
  ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#login-button').bind('click', function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#element_to_pop_up0').bPopup();

            });

        });

    })(jQuery);

   //<!--For FB popup  -->
// <script type="text/javascript">
// Semicolon (;) to ensure closing of earlier scripting
    // Encapsulation
    // $ is assigned to jQuery
    ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#my-button').bind('click', function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#element_to_pop_up').bPopup();

            });

        });

    })(jQuery);


</script>

    <script type="text/javascript">
    var highlightLayer;
    function highlightFeature(e) {
        highlightLayer = e.target;

        if (e.target.feature.geometry.type === 'LineString') {
          highlightLayer.setStyle({
            color: '#fff00',
          });
        } else {
          highlightLayer.setStyle({
            fillColor: '#ffff00',
            fillOpacity: 1
          });
        }
        // highlightLayer.openPopup();  //don't popup on hover
    }
    var crs = new L.Proj.CRS('EPSG:32644', '+proj=utm +zone=44 +datum=WGS84 +units=m +no_defs', {
            resolutions: [2800, 1400, 700, 350, 175, 84, 42, 21, 11.2, 5.6, 2.8, 1.4, 0.7, 0.35, 0.14, 0.07],
        });
        L.ImageOverlay.include({
            getBounds: function () {
                return this._bounds;
            }
        });
      var basemap = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
              maxZoom: 20,
              attribution: '© 2016 | Developed and Designed by <a href="http://home.iitk.ac.in/~shahryar">Shahryar K Ahmad</a> ' +
        '| Supervised by <a href="http://home.iitk.ac.in/~blohani">Prof. Bharat Lohani</a>',
              subdomains:['mt0','mt1','mt2','mt3']
          });
      var map = L.map('map', 
          { fullscreenControl: true,
            // crs: crs,      //not loading basemap due to this
            continuousWorld: false,
            worldCopyJump: false, 
            measureControl:false,
            zoomControl:false //true, maxZoom:28, minZoom:1
        }).setView([26.50943,80.23397], 15);
      // map.locate({setView: true, maxZoom: 16});
      basemap.addTo(map);
      // Zoom home
      var zoomHome = L.Control.zoomHome();
      zoomHome.addTo(map);
      var hash = new L.Hash(map);
        var feature_group = new L.featureGroup([]);
        var bounds_group = new L.featureGroup([]);
        var raster_group = new L.LayerGroup([]);
        var initialOrder = new Array();
        var layerOrder = new Array();
        function stackLayers() {
            for (index = 0; index < initialOrder.length; index++) {
                map.removeLayer(initialOrder[index]);
                map.addLayer(initialOrder[index]);
            }
            if (bounds_group.getLayers().length) {
                map.fitBounds(bounds_group.getBounds());
            }
        }
        function restackLayers() {
            for (index = 0; index < layerOrder.length; index++) {
                layerOrder[index].bringToFront();
            }
        }

      
      var sidebar = L.control.sidebar('sidebar').addTo(map);
      // add location control to global name space for testing only
      // on a production site, omit the "lc = "!
      lc = L.control.locate({
          follow: true,
          strings: {
              title: "Show me where I am!"
          }
      }).addTo(map);

      map.on('startfollowing', function() {
          map.on('dragstart', lc._stopFollowing, lc);
      }).on('stopfollowing', function() {
          map.off('dragstart', lc._stopFollowing, lc);
      });

      // var circle = L.circle([51.508, -0.11], 500, {
      // color: 'red',
      // fillColor: '#f03',
      // fillOpacity: 0.5}).addTo(map);
      // circle.bindPopup("Well Done, 786!");
      
///////////////////////////////////////////////////////////////////////////////////////////////////
///*********************************************************************************************///      
///******************************************LAYERS*********************************************///      
///*********************************************************************************************///      
///*********************************************************************************************///            
///////////////////////////////////////////////////////////////////////////////////////////////////

       function pop_Landuse2015any0(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleLanduse2015any0(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">type</th><td>' + (feature.properties['type'] !== null ? Autolinker.link(String(feature.properties['type'])) : '') + '</td></tr><tr><th scope="row">use</th><td>' + (feature.properties['use'] !== null ? Autolinker.link(String(feature.properties['use'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleLanduse2015any0(feature) {
      switch (feature.properties.type) {
                case 'BUILT UP':
                    return {
                    weight: '1.04',
                    fillColor: '#f1f4c7',
                    color: '#afb38a',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

                case 'FOOTPATH':
                    return {
                    weight: '1.04',
                    fillColor: '#942033',
                    color: '#afb38a',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

                case 'OPEN SPACES':
                    return {
                    weight: '1.04',
                    fillColor: '#badd69',
                    color: '#809848',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

                case 'PARKWAYS':
                    return {
                    weight: '1.04',
                    fillColor: '#ffffbf',
                    color: '#000000',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

                case 'ROAD EDGE':
                    return {
                    weight: '1.04',
                    fillColor: '#b1b7b6',
                    color: '#000000',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

                case 'WATER BODY':
                    return {
                    weight: '1.04',
                    fillColor: '#3288bd',
                    color: '#000000',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

                case 'STADIUM':
                    return {
                    weight: '1.04',
                    fillColor: '#badd69',
                    color: '#809848',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    opacity: '1.0',
                    fillOpacity: '1.0',
                };
                break;

            }
        }
        var json_Landuse2015any0JSON = new L.geoJson(json_Landuse2015any0, {
            onEachFeature: pop_Landuse2015any0,
            style: doStyleLanduse2015any0
        });
        layerOrder[layerOrder.length] = json_Landuse2015any0JSON;
        bounds_group.addLayer(json_Landuse2015any0JSON);
        initialOrder[initialOrder.length] = json_Landuse2015any0JSON;
        feature_group.addLayer(json_Landuse2015any0JSON);
        function pop_Academic1(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleAcademic1(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">Department</th><td>' + (feature.properties['Department'] !== null ? Autolinker.link(String(feature.properties['Department'])) : '') + '</td></tr><tr><th scope="row">USE</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">Road_ID</th><td>' + (feature.properties['Road_ID'] !== null ? Autolinker.link(String(feature.properties['Road_ID'])) : '') + '</td></tr><tr><th scope="row">NameUse</th><td>' + (feature.properties['NameUse'] !== null ? Autolinker.link(String(feature.properties['NameUse'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleAcademic1(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#f60511',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Academic1JSON = new L.geoJson(json_Academic1, {
            onEachFeature: pop_Academic1,
            style: doStyleAcademic1
        });
        layerOrder[layerOrder.length] = json_Academic1JSON;
        bounds_group.addLayer(json_Academic1JSON);
        initialOrder[initialOrder.length] = json_Academic1JSON;
        feature_group.addLayer(json_Academic1JSON);
        function pop_Facilities2(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleFacilities2(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">USE</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">RD_ID</th><td>' + (feature.properties['RD_ID'] !== null ? Autolinker.link(String(feature.properties['RD_ID'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleFacilities2(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#6af1c4',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Facilities2JSON = new L.geoJson(json_Facilities2, {
            onEachFeature: pop_Facilities2,
            style: doStyleFacilities2
        });
        layerOrder[layerOrder.length] = json_Facilities2JSON;
        bounds_group.addLayer(json_Facilities2JSON);
        initialOrder[initialOrder.length] = json_Facilities2JSON;
        feature_group.addLayer(json_Facilities2JSON);
        function pop_Residential3(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleResidential3(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Address2</th><td>' + (feature.properties['Address2'] !== null ? Autolinker.link(String(feature.properties['Address2'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">BLOCK</th><td>' + (feature.properties['BLOCK'] !== null ? Autolinker.link(String(feature.properties['BLOCK'])) : '') + '</td></tr><tr><th scope="row">Road_ID</th><td>' + (feature.properties['Road_ID'] !== null ? Autolinker.link(String(feature.properties['Road_ID'])) : '') + '</td></tr><tr><th scope="row">ConstYr</th><td>' + (feature.properties['ConstYr'] !== null ? Autolinker.link(String(feature.properties['ConstYr'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">HouseName</th><td>' + (feature.properties['HouseName'] !== null ? Autolinker.link(String(feature.properties['HouseName'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleResidential3(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#ee22d7',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 0.0,
                fillOpacity: 1.0
            };
        }
        var json_Residential3JSON = new L.geoJson(json_Residential3, {
            onEachFeature: pop_Residential3,
            style: doStyleResidential3
        });
        layerOrder[layerOrder.length] = json_Residential3JSON;
        bounds_group.addLayer(json_Residential3JSON);
        initialOrder[initialOrder.length] = json_Residential3JSON;
        feature_group.addLayer(json_Residential3JSON);
        function pop_ShopsCanteens4(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleShopsCanteens4(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">USE</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">RD_ID</th><td>' + (feature.properties['RD_ID'] !== null ? Autolinker.link(String(feature.properties['RD_ID'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleShopsCanteens4(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#ff6e50',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_ShopsCanteens4JSON = new L.geoJson(json_ShopsCanteens4, {
            onEachFeature: pop_ShopsCanteens4,
            style: doStyleShopsCanteens4
        });
        layerOrder[layerOrder.length] = json_ShopsCanteens4JSON;
        bounds_group.addLayer(json_ShopsCanteens4JSON);
        initialOrder[initialOrder.length] = json_ShopsCanteens4JSON;
        feature_group.addLayer(json_ShopsCanteens4JSON);
        function pop_FitnessSports5(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleFitnessSports5(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">AREA</th><td>' + (feature.properties['AREA'] !== null ? Autolinker.link(String(feature.properties['AREA'])) : '') + '</td></tr><tr><th scope="row">Road_ID</th><td>' + (feature.properties['Road_ID'] !== null ? Autolinker.link(String(feature.properties['Road_ID'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">ConstYr</th><td>' + (feature.properties['ConstYr'] !== null ? Autolinker.link(String(feature.properties['ConstYr'])) : '') + '</td></tr><tr><th scope="row">LastUPD</th><td>' + (feature.properties['LastUPD'] !== null ? Autolinker.link(String(feature.properties['LastUPD'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleFitnessSports5(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#127036',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_FitnessSports5JSON = new L.geoJson(json_FitnessSports5, {
            onEachFeature: pop_FitnessSports5,
            style: doStyleFitnessSports5
        });
        layerOrder[layerOrder.length] = json_FitnessSports5JSON;
        bounds_group.addLayer(json_FitnessSports5JSON);
        initialOrder[initialOrder.length] = json_FitnessSports5JSON;
        feature_group.addLayer(json_FitnessSports5JSON);
        function pop_EventVenues6(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleEventVenues6(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">USE</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">RD_ID</th><td>' + (feature.properties['RD_ID'] !== null ? Autolinker.link(String(feature.properties['RD_ID'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleEventVenues6(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#c94fff',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_EventVenues6JSON = new L.geoJson(json_EventVenues6, {
            onEachFeature: pop_EventVenues6,
            style: doStyleEventVenues6
        });
        layerOrder[layerOrder.length] = json_EventVenues6JSON;
        bounds_group.addLayer(json_EventVenues6JSON);
        initialOrder[initialOrder.length] = json_EventVenues6JSON;
        feature_group.addLayer(json_EventVenues6JSON);
        function pop_Religious7(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleReligious7(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">AREA</th><td>' + (feature.properties['AREA'] !== null ? Autolinker.link(String(feature.properties['AREA'])) : '') + '</td></tr><tr><th scope="row">Road_ID</th><td>' + (feature.properties['Road_ID'] !== null ? Autolinker.link(String(feature.properties['Road_ID'])) : '') + '</td></tr><tr><th scope="row">ConstYr</th><td>' + (feature.properties['ConstYr'] !== null ? Autolinker.link(String(feature.properties['ConstYr'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">LastUPD</th><td>' + (feature.properties['LastUPD'] !== null ? Autolinker.link(String(feature.properties['LastUPD'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleReligious7(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#0fb79e',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Religious7JSON = new L.geoJson(json_Religious7, {
            onEachFeature: pop_Religious7,
            style: doStyleReligious7
        });
        layerOrder[layerOrder.length] = json_Religious7JSON;
        bounds_group.addLayer(json_Religious7JSON);
        initialOrder[initialOrder.length] = json_Religious7JSON;
        feature_group.addLayer(json_Religious7JSON);
        function pop_Parking8(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleParking8(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Road_ID</th><td>' + (feature.properties['Road_ID'] !== null ? Autolinker.link(String(feature.properties['Road_ID'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">NatureAddr</th><td>' + (feature.properties['NatureAddr'] !== null ? Autolinker.link(String(feature.properties['NatureAddr'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleParking8(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#da7f24',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Parking8JSON = new L.geoJson(json_Parking8, {
            onEachFeature: pop_Parking8,
            style: doStyleParking8
        });
        layerOrder[layerOrder.length] = json_Parking8JSON;
        bounds_group.addLayer(json_Parking8JSON);
        initialOrder[initialOrder.length] = json_Parking8JSON;
        feature_group.addLayer(json_Parking8JSON);
        function pop_HallWalkways9(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleHallWalkways9(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">Location</th><td>' + (feature.properties['Location'] !== null ? Autolinker.link(String(feature.properties['Location'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleHallWalkways9(feature) {
            return {
                weight: 1.04,
                color: '#809848',
                fillColor: '#ab2929',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_HallWalkways9JSON = new L.geoJson(json_HallWalkways9, {
            onEachFeature: pop_HallWalkways9,
            style: doStyleHallWalkways9
        });
        layerOrder[layerOrder.length] = json_HallWalkways9JSON;
        bounds_group.addLayer(json_HallWalkways9JSON);
        initialOrder[initialOrder.length] = json_HallWalkways9JSON;
        feature_group.addLayer(json_HallWalkways9JSON);
        function pop_ParksLawns10(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleParksLawns10(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">Id</th><td>' + (feature.properties['Id'] !== null ? Autolinker.link(String(feature.properties['Id'])) : '') + '</td></tr><tr><th scope="row">NATURE</th><td>' + (feature.properties['NATURE'] !== null ? Autolinker.link(String(feature.properties['NATURE'])) : '') + '</td></tr><tr><th scope="row">Shape_Length</th><td>' + (feature.properties['Shape_Length'] !== null ? Autolinker.link(String(feature.properties['Shape_Length'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleParksLawns10(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#14e282',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_ParksLawns10JSON = new L.geoJson(json_ParksLawns10, {
            onEachFeature: pop_ParksLawns10,
            style: doStyleParksLawns10
        });
        layerOrder[layerOrder.length] = json_ParksLawns10JSON;
        bounds_group.addLayer(json_ParksLawns10JSON);
        initialOrder[initialOrder.length] = json_ParksLawns10JSON;
        feature_group.addLayer(json_ParksLawns10JSON);
        function pop_Waterbody11(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleWaterbody11(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">Id</th><td>' + (feature.properties['Id'] !== null ? Autolinker.link(String(feature.properties['Id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">Shape_Length</th><td>' + (feature.properties['Shape_Length'] !== null ? Autolinker.link(String(feature.properties['Shape_Length'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleWaterbody11(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#1a27e4',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Waterbody11JSON = new L.geoJson(json_Waterbody11, {
            onEachFeature: pop_Waterbody11,
            style: doStyleWaterbody11
        });
        layerOrder[layerOrder.length] = json_Waterbody11JSON;
        bounds_group.addLayer(json_Waterbody11JSON);
        initialOrder[initialOrder.length] = json_Waterbody11JSON;
        feature_group.addLayer(json_Waterbody11JSON);
        function pop_Security12(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleSecurity12(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">USE</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">RD_ID</th><td>' + (feature.properties['RD_ID'] !== null ? Autolinker.link(String(feature.properties['RD_ID'])) : '') + '</td></tr><tr><th scope="row">ConstYr</th><td>' + (feature.properties['ConstYr'] !== null ? Autolinker.link(String(feature.properties['ConstYr'])) : '') + '</td></tr><tr><th scope="row">LastUPD</th><td>' + (feature.properties['LastUPD'] !== null ? Autolinker.link(String(feature.properties['LastUPD'])) : '') + '</td></tr><tr><th scope="row">NameUse</th><td>' + (feature.properties['NameUse'] !== null ? Autolinker.link(String(feature.properties['NameUse'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleSecurity12(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#531532',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Security12JSON = new L.geoJson(json_Security12, {
            onEachFeature: pop_Security12,
            style: doStyleSecurity12
        });
        layerOrder[layerOrder.length] = json_Security12JSON;
        bounds_group.addLayer(json_Security12JSON);
        initialOrder[initialOrder.length] = json_Security12JSON;
        feature_group.addLayer(json_Security12JSON);
        function pop_Unconstructed13(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleUnconstructed13(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">About</th><td>' + (feature.properties['About'] !== null ? Autolinker.link(String(feature.properties['About'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleUnconstructed13(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#a5a5a5',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 1.0
            };
        }
        var json_Unconstructed13JSON = new L.geoJson(json_Unconstructed13, {
            onEachFeature: pop_Unconstructed13,
            style: doStyleUnconstructed13
        });
        layerOrder[layerOrder.length] = json_Unconstructed13JSON;
        bounds_group.addLayer(json_Unconstructed13JSON);
        initialOrder[initialOrder.length] = json_Unconstructed13JSON;
        feature_group.addLayer(json_Unconstructed13JSON);
        function pop_Roads14(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleRoads14(feature));

                },
                //mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">Id</th><td>' + (feature.properties['Id'] !== null ? Autolinker.link(String(feature.properties['Id'])) : '') + '</td></tr><tr><th scope="row">type</th><td>' + (feature.properties['type'] !== null ? Autolinker.link(String(feature.properties['type'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">Surface</th><td>' + (feature.properties['Surface'] !== null ? Autolinker.link(String(feature.properties['Surface'])) : '') + '</td></tr><tr><th scope="row">TEMPNAME</th><td>' + (feature.properties['TEMPNAME'] !== null ? Autolinker.link(String(feature.properties['TEMPNAME'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleRoads14(feature) {
            return {
                weight: 3.04,
                color: '#ffffff',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0
            };
        }
        var json_Roads14JSON = new L.geoJson(json_Roads14, {
            onEachFeature: pop_Roads14,
            style: doStyleRoads14
        });
        layerOrder[layerOrder.length] = json_Roads14JSON;
        bounds_group.addLayer(json_Roads14JSON);
        initialOrder[initialOrder.length] = json_Roads14JSON;
        feature_group.addLayer(json_Roads14JSON);
        function pop_Contours15(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleContours15(feature));

                },
                //mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">CONTOUR</th><td>' + (feature.properties['CONTOUR'] !== null ? Autolinker.link(String(feature.properties['CONTOUR'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleContours15(feature) {
            return {
                weight: 1.14,
                color: '#c09363',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0
            };
        }
        var json_Contours15JSON = new L.geoJson(json_Contours15, {
            onEachFeature: pop_Contours15,
            style: doStyleContours15
        });
        layerOrder[layerOrder.length] = json_Contours15JSON;
        bounds_group.addLayer(json_Contours15JSON);
        function pop_Landmarks16(feature, layer) {

            layer.on({
              // alert('inside pop_landmarks');
                mouseout: function(e) {
                    layer.setStyle(doStyleLandmarks16(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row"></th><td>' + (feature.properties['name'] !== null ? Autolinker.link(String(feature.properties['name'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleLandmarks16() {
            return {
                radius: 3.4,
                fillColor: '#5c2b5c',
                color: '#000000',
                weight: 0.0,
                opacity: 1.0,
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                fillOpacity: 1.0
            }
        }
        function doPointToLayerLandmarks16(feature, latlng) {
            // return L.circleMarker(latlng, doStyleLandmarks16())
            return L.circleMarker(latlng, doStyleLandmarks16()).bindLabel(feature.properties['name'], {noHide:true, className: 'labelandmarks'})

        }
         var json_Landmarks16JSON = new L.geoJson(json_Landmarks16, {
            onEachFeature: pop_Landmarks16, 
            pointToLayer: doPointToLayerLandmarks16
            });
        layerOrder[layerOrder.length] = json_Landmarks16JSON;

        bounds_group.addLayer(json_Landmarks16JSON);
        initialOrder[initialOrder.length] = json_Landmarks16JSON;
        feature_group.addLayer(json_Landmarks16JSON);

        var visible;

        map.on('zoomend', function (e) {
          if (map.getZoom() > 15) {
            if (!visible) {
              json_Landmarks16JSON.eachLayer(function (layer) {
                layer.showLabel();
              });
              visible = true;
            }
          } else {
            if (visible) {
              json_Landmarks16JSON.eachLayer(function (layer) {
                layer.hideLabel();
              });
              visible = false;
            }
          }
        });

        function pop_IITKBoundary17(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleIITKBoundary17(feature));

                },
                mouseover: highlightFeature,
            });
        }

        function doStyleIITKBoundary17(feature) {
            return {
                weight: 5.04,
                color: '#721515',
                fillColor: '#000000',
                dashArray: '12.6,6.3,1.26,6.3',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 1.0,
                fillOpacity: 0.0
            };
        }
        var json_IITKBoundary17JSON = new L.geoJson(json_IITKBoundary17, {
            onEachFeature: pop_IITKBoundary17,
            style: doStyleIITKBoundary17
        });
        layerOrder[layerOrder.length] = json_IITKBoundary17JSON;
        bounds_group.addLayer(json_IITKBoundary17JSON);

        function pop_Mergednew18(feature, layer) {
            layer.on({
                mouseout: function(e) {
                    layer.setStyle(doStyleMergednew18(feature));

                },
                mouseover: highlightFeature,
            });
            var popupContent = '<table><tr><th scope="row">id</th><td>' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td></tr><tr><th scope="row">Name</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">ShortName</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Nature</th><td>' + (feature.properties['Nature'] !== null ? Autolinker.link(String(feature.properties['Nature'])) : '') + '</td></tr><tr><th scope="row">Department</th><td>' + (feature.properties['Department'] !== null ? Autolinker.link(String(feature.properties['Department'])) : '') + '</td></tr><tr><th scope="row">USE</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Address1</th><td>' + (feature.properties['Address1'] !== null ? Autolinker.link(String(feature.properties['Address1'])) : '') + '</td></tr><tr><th scope="row">Floors</th><td>' + (feature.properties['Floors'] !== null ? Autolinker.link(String(feature.properties['Floors'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr><tr><th scope="row">Road_ID</th><td>' + (feature.properties['Road_ID'] !== null ? Autolinker.link(String(feature.properties['Road_ID'])) : '') + '</td></tr><tr><th scope="row">Address2</th><td>' + (feature.properties['Address2'] !== null ? Autolinker.link(String(feature.properties['Address2'])) : '') + '</td></tr><tr><th scope="row">BLOCK</th><td>' + (feature.properties['BLOCK'] !== null ? Autolinker.link(String(feature.properties['BLOCK'])) : '') + '</td></tr><tr><th scope="row">HouseName</th><td>' + (feature.properties['HouseName'] !== null ? Autolinker.link(String(feature.properties['HouseName'])) : '') + '</td></tr><tr><th scope="row">About</th><td>' + (feature.properties['About'] !== null ? Autolinker.link(String(feature.properties['About'])) : '') + '</td></tr><tr><th scope="row">Combined</th><td>' + (feature.properties['Combined'] !== null ? Autolinker.link(String(feature.properties['Combined'])) : '') + '</td></tr></table>';
            layer.bindPopup(popupContent);
        }

        function doStyleMergednew18(feature) {
            return {
                weight: 1.04,
                color: '#000000',
                fillColor: '#e1e1e1',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                opacity: 0.0,
                fillOpacity: 0.258823529412
            };
        }
        var json_Mergednew18JSON = new L.geoJson(json_Mergednew18, {
            onEachFeature: pop_Mergednew18,
            style: doStyleMergednew18
        });
        layerOrder[layerOrder.length] = json_Mergednew18JSON;
        bounds_group.addLayer(json_Mergednew18JSON);
        initialOrder[initialOrder.length] = json_Mergednew18JSON;
        feature_group.addLayer(json_Mergednew18JSON);
////////////////LAYER ends (from qgis2web)///////////////
  
        raster_group.addTo(map);
        feature_group.addTo(map);

///OSM geocoder//////        
        // var osmGeocoder = new L.Control.OSMGeocoder({
        //     collapsed: true,
        //     position: 'bottomright',
        //     text: 'Search World',
        // });
        // osmGeocoder.addTo(map);

//// TOGGLE LAYERS //////////////////////////
//       L.control.layers({
//           'Google Streets' : L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
//               maxZoom: 20,
//               subdomains:['mt0','mt1','mt2','mt3']
//           }),
       
//         'Google Satellite' : L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
//     maxZoom: 20,
//     subdomains:['mt0','mt1','mt2','mt3']
// }),
//         'Google Terrain' : L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
//     maxZoom: 20,
//     subdomains:['mt0','mt1','mt2','mt3']
// }),
//         'OpenStreetMap': L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
          
//           'Topographic Map' : L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}')
          
//       }).addTo(map);

      ///// of qgis2web//////////
        var baseMaps = {'Google Streets' : L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
              maxZoom: 20,
              subdomains:['mt0','mt1','mt2','mt3']
          }),
        
        'Google Satellite' : L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}),
        'Google Terrain' : L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}),
        'OpenStreetMap': L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
          
          'Topographic Map' : L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}')};
        L.control.layers(baseMaps,{'': json_Mergednew18JSON,
          // '<img src="qw2/legend/IITKBoundary17.png" /> IITK Boundary': json_IITKBoundary17JSON,
          '<img src="qw2/legend/Landmarks16.png" /> Landmarks': json_Landmarks16JSON,'<img src="qw2/legend/Contours15.png" /> Contours': json_Contours15JSON,'<img src="qw2/legend/Roads14.png" /> Roads': json_Roads14JSON,'<img src="qw2/legend/Unconstructed13.png" /> Unconstructed': json_Unconstructed13JSON,'<img src="qw2/legend/Security12.png" /> Security': json_Security12JSON,'<img src="qw2/legend/Waterbody11.png" /> Waterbody': json_Waterbody11JSON,'<img src="qw2/legend/ParksLawns10.png" /> Parks/Lawns': json_ParksLawns10JSON,'<img src="qw2/legend/HallWalkways9.png" /> Hall Walkways': json_HallWalkways9JSON,'<img src="qw2/legend/Parking8.png" /> Parking': json_Parking8JSON,'<img src="qw2/legend/Religious7.png" /> Religious': json_Religious7JSON,'<img src="qw2/legend/EventVenues6.png" /> Event Venues': json_EventVenues6JSON,'<img src="qw2/legend/FitnessSports5.png" /> Fitness/Sports': json_FitnessSports5JSON,'<img src="qw2/legend/ShopsCanteens4.png" /> Shops/Canteens': json_ShopsCanteens4JSON,'<img src="qw2/legend/Residential3.png" /> Residential': json_Residential3JSON,'<img src="qw2/legend/Facilities2.png" /> Facilities': json_Facilities2JSON,'<img src="qw2/legend/Academic1.png" /> Academic': json_Academic1JSON,'Landuse <br />': json_Landuse2015any0JSON,},{collapsed:true, autoZIndex:true}).addTo(map);
        
        json_Mergednew18JSON.bringToBack();
        json_Landuse2015any0JSON.bringToBack();

//SEARCH TOOL //////////////////////////

      
      // currently json_Mergednew18JSON is the layer to search instead of all merged
    var searchControl= new L.Control.Search({
        container: 'findbox_top',
        layer: json_Mergednew18JSON,
        propertyName: 'Combined',
        
        textPlaceholder: 'Search Any Place',
        initial: false,
        collapsed: false,
        markerLocation: true,
        callTip: function(text, val) {
      var type = val.layer.feature.properties.Department;
      return '<a href="#" class="'+type+'">'+text+'('+type+')'+'</a>';
    }
      }) ;
      map.addControl(searchControl);  
   
     var searchControl= new L.Control.Search({
        container: 'findbox_allbldg',
        layer: json_Mergednew18JSON,
        propertyName: 'Combined',
        
        textPlaceholder: 'Enter Any Name or Initials',
        initial: false,
        collapsed: false,
        markerLocation: true,
        callTip: function(text, val) {
      var type = val.layer.feature.properties.Department;
      return '<a href="#" class="'+type+'">'+text+'('+type+')'+'</a>';
    }
      }) ;
      map.addControl(searchControl);

      var searchControl= new L.Control.Search({
        container: 'findbox_acad',
        layer: json_Academic1JSON,
        propertyName: 'Name',
        textPlaceholder: 'Enter Name/Department/Initials',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl);

      var searchControl= new L.Control.Search({
        container: 'findbox_resid',
        layer: json_Residential3JSON,
        propertyName: 'Name',
        textPlaceholder: 'Enter Name/Initials',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl);

      var searchControl= new L.Control.Search({
        container: 'findbox_resid_house',
        layer: json_Residential3JSON,
        propertyName: 'HouseName',
        textPlaceholder: '[OR] Search House Number',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl);

      var searchControl= new L.Control.Search({
        container: 'findbox_resid_hall',
        layer: json_Residential3JSON,
        propertyName: 'BLOCK',
        textPlaceholder: '[OR] Search Hall Block',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl);

      var searchControl= new L.Control.Search({
        container: 'findbox_fac',
        layer: json_Facilities2JSON,
        propertyName: 'Name',
        textPlaceholder: 'Enter Name/Initials',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl);
      var searchControl= new L.Control.Search({
        container: 'findbox_shops',
        layer: json_ShopsCanteens4JSON,
        propertyName: 'Name',
        textPlaceholder: '[OR] Search Shop Name/Initials',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl);

      var searchControl= new L.Control.Search({
        container: 'findbox_fit',
        layer: json_FitnessSports5JSON,
        propertyName: 'Name',
        textPlaceholder: '[OR] Search Fitness/Sport Places',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl)
      var searchControl= new L.Control.Search({
        container: 'findbox_rel',
        layer: json_Religious7JSON,
        propertyName: 'Name',
        textPlaceholder: '[OR] Search Religious Places',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl)

      var searchControl= new L.Control.Search({
        container: 'findbox_sec',
        layer: json_Security12JSON,
        propertyName: 'NameUse',
        textPlaceholder: 'Search Security Checkpoints',
        initial: false,
        collapsed: false,
        markerLocation: true
      }) ;
      map.addControl(searchControl)
//////////////////////////////////////

      ////See on GOOGLE MAPS////////////
      var maplat;
      var maplng;
      function getcent(){
          mapCenter = map.getCenter();
    
          var str=String(mapCenter);
          mapcent = str.match(/[+-]?\d+(\.\d+)?/g); //     /\d+/g);
          maplat = mapcent[0];
          maplng = mapcent[1];
          //alert(strcent[0]);
          url='https://www.google.co.in/maps/place/'+maplat+'N+'+maplng+'E/@'+maplat+','+maplng+',17z';
          window.open(url);
          //return [startlat, startlng];
      };

/// FOR ROUTING/////////////////
     var startCenter;
     var strcent;
     var startlat;
     var startlng;
     var endCenter;
     var endcent;
     var endlat;
     var endlng;
      
     var searchControl= new L.Control.Search({
        container: 'findbox_from',
        layer: json_Mergednew18JSON,
        propertyName: 'Combined',
        
        textPlaceholder: 'Start',
        initial: false,
        collapsed: false,
        markerLocation: false,
        
      }) ;
      map.addControl(searchControl);
      function startloc(){
          startCenter = map.getCenter();
    
          var str=String(startCenter);
          strcent = str.match(/[+-]?\d+(\.\d+)?/g); //     /\d+/g);
          startlat = strcent[0];
          startlng = strcent[1];
          // alert(strcent[0]);

          //return [startlat, startlng];
      };

       var searchControl= new L.Control.Search({
          container: 'findbox_to',
          layer: json_Mergednew18JSON,
          propertyName: 'Combined',
          
          textPlaceholder: 'End',
          initial: false,
          collapsed: false,
          markerLocation: false,
          
        }) ;
        map.addControl(searchControl);

      function endloc(){ 
         endCenter = map.getCenter();
         var str=String(endCenter);
           endcent = str.match(/[+-]?\d+(\.\d+)?/g); //     /\d+/g);
           endlat = endcent[0];
           endlng = endcent[1];

          // alert(endlat);
          // alert(endlng);

          // var endlat = endCenter.lat();
          // var endlng = endCenter.lng();
          //return [endlat, endlng];
      };
      

                  
      function routingfunction(){
          // var startcoord=startloc();
          // var endcoord=endloc();
          // var startlat = startcoord[0];
          // var startlng = startcoord[1];
          
          // var endlat = endcoord[0];
          // var endlng = endcoord[1];
          var dir;
          dir = MQ.routing.directions()
          .on('success', function(data) {
            var legs = data.route.legs,
                html = '',
                maneuvers,
                i;

            if (legs && legs.length) {
                maneuvers = legs[0].maneuvers;

                for (i=0; i < maneuvers.length; i++) {
                    html +=  '<i class="fa fa-space-shuttle"></i>';
                    html += maneuvers[i].narrative + '<br>';
                }

                L.DomUtil.get('route-narrative').innerHTML = html;
            }
          });
 
          dir.route({
              locations: [
                  { latLng: { lat: startlat, lng: startlng} },
                   { latLng: { lat: endlat, lng: endlng} }
              ]
          });

          // map.addLayer(MQ.routing.routeLayer({
          //     directions: dir,
          //     fitBounds: true
          // }));

          CustomRouteLayer = MQ.Routing.RouteLayer.extend({
            
          });
          map.addLayer(new CustomRouteLayer({
            directions: dir,
            fitBounds: true,
            draggable: true,
            ribbonOptions: {
              draggable: true,
              ribbonDisplay: { color: '#8333FF', opacity: 1 },
              widths: [13]
            }
          }));

        };
       

// END SEARCH & ROUTING TOOL ----------------------

//ROUTE ON GM
function getdirn(){
          url1='https://www.google.co.in/maps/dir/'+startlat+','+startlng+'/'+endlat+','+endlng+'/@'+startlat+','+startlng+',17z';
          window.open(url1);
          //return [startlat, startlng];
      };

// SHUTDOWN NOTIFICATIONS
          var searchControl= new L.Control.Search({
          container: 'findbox_shut',
          layer: json_Mergednew18JSON,
          propertyName: 'Combined',
          
          textPlaceholder: 'Enter Shutdown Location',
          initial: false,
          collapsed: false,
          markerLocation: true,
          
        }) ;
        map.addControl(searchControl);

//Adding and deleting from list box
        var i=0;
        function addshutplace(){
          // alert(document.getElementsByName("searchbox").value);
          var v = document.getElementsByName("searchbox").value;
       // get the TextBox Value and assign it into the variable
       AddOpt = new Option(v, v);
       document.form1.listValue.options[i++] = AddOpt;
       return true;
    }

      function delshutplace() {
           var s = 1;
           var Index;
           if (document.form1.listValue.selectedIndex == -1) {
              alert("Please select any item from the ListBox");
              return true;
           }
           while (s > 0) {
               Index = document.form1.listValue.selectedIndex;
               if (Index >= 0) {
                    document.form1.listValue.options[Index] = null;
                     --i;
               }
               else
                  s = 0;
           }
           return true;
      }

      var myLayer = {
        "type": "FeatureCollection",
        "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
        "features":[],
      }
      var json_shutdown = new L.geoJson(myLayer);
      // myLayer.addData(geojsonFeature);
      // shutfeature={};
      function submshutplace () {
        // alert(document.getElementById('datetime-local').value)
                   
        var list = document.getElementById('listbox');
        // console.log(list.options)
        
        L.geoJson(json_Mergednew18, {
            onEachFeature: checkMatch
        });
         
      }

      // title={};
      
      function checkMatch (feature) {
        var list = document.getElementById('listbox');
        for(var i = 0; i < list.options.length; ++i){
          // title=list.options[i].value;
       
        // console.log(i)
          if (list.options[i].value==feature.properties.Combined){

            // myLayer['features'].push(feature);
            // var myLayerString= JSON.stringify(feature);
            var myLayerId=feature.properties.id;
            var myfeatname=feature.properties.Combined;
            var select = document.getElementById("shutselect");
            var answer = select.options[select.selectedIndex].value;
            var shutdesc=document.getElementById("shutdescr").value;
            var shutstrtdate = document.getElementById('datetime-shutstrt').value;
            var shutenddate = document.getElementById('datetime-shutend').value;
            var descr; 
            switch (answer) {
                      case '1':   descr='1';break;
                      case '2':   descr='2';break;
                      case '3':   descr='3';break;
                      case '4':   descr='4';break;
                      default :   descr='0';break;
                  };
             ////Posting to php using AJAX /////////////

              // Create our XMLHttpRequest object
              var hr = new XMLHttpRequest();
              // Create some variables we need to send to our PHP file
              var url = "postphp.php";
              var vars = "description="+descr+"&shutdownlayer="+myLayerId+"&featname="+myfeatname+"&shutdesc="+shutdesc+"&shutstr="+shutstrtdate+"&shutend="+shutenddate;
              hr.open("POST", url, true);
              // Set content type header information for sending url encoded variables in the request
              hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              // Access the onreadystatechange event for the XMLHttpRequest object
              hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                  var return_data = hr.responseText;
                  document.getElementById("status").innerHTML = return_data;
                // alert(feature.properties.Combined);
                }
              }
              // Send the data to PHP now... and wait for response to update the status div
              hr.send(vars); // Actually execute the request
              document.getElementById("status").innerHTML = "processing...";

              ////////DONE POSTING TO PHP////////////////

          }
       
        }
        // document.getElementById("status").innerHTML = return_data+'with following features'+featlist;
      }

///SHUTDOWN STYLES/////////
        function pop_shutdown(feature, layer) {
                    layer.on({
                        mouseout: function(e) {
                            layer.setStyle(doStyleshutdown(feature));

                        },
                        mouseover: highlightFeature,
                    });
                    var select = document.getElementById("shutselectsee");
                    var answer = select.options[select.selectedIndex].value;

                    switch (answer) {
                                  case '1':    shutres='Electricity Shutdown'; break;
                                  case '2':    shutres='Honey Beehives Removal';break;
                                  case '3':    shutres='Water Shutdown';break;
                                  case '4':    shutres='Miscellaneous Shutdown';break;
                                  default :    shutres='Other Shutdown';break;
                                }
                    var popupContent = '<table><tr><th scope="row"><b>Type</b></th><td> <b>' + shutres + '</b></td></tr><tr><th scope="row"><b>Shutdown Starts</b></th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row"><b>Shutdown Ends</b></th><td>' + (feature.properties['About'] !== null ? Autolinker.link(String(feature.properties['About'])) : '') + '</td></tr><tr><th scope="row">Location</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">Description</th><td>' + (feature.properties['ShortName'] !== null ? Autolinker.link(String(feature.properties['ShortName'])) : '') + '</td></tr><tr><th scope="row">Type</th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Department</th><td>' + (feature.properties['Department'] !== null ? Autolinker.link(String(feature.properties['Department'])) : '') + '</td></tr><tr><th scope="row">Shape_Leng</th><td>' + (feature.properties['Shape_Leng'] !== null ? Autolinker.link(String(feature.properties['Shape_Leng'])) : '') + '</td></tr><tr><th scope="row">Shape_Area</th><td>' + (feature.properties['Shape_Area'] !== null ? Autolinker.link(String(feature.properties['Shape_Area'])) : '') + '</td></tr></table>';
                    layer.bindPopup(popupContent);
        }
       
        function doStyleshutdown(feature) {
          var select = document.getElementById("shutselectsee");
          var answer = select.options[select.selectedIndex].value;
            return {
                        weight: 1.04,
                        color: '#000000',
                        fillColor: '#000',
                        dashArray: '',
                        lineCap: 'square',
                        lineJoin: 'bevel',
                        opacity: 1,
                        fillOpacity: 1
                    };
                    
            
        }
        
///////SEE SHUTDOWN LOCATIONS////////////
      // for shutdown markers///
      function onEachshutFeature(feature, layer) {
              var popupContent = "<p> Shutdown Details: </p>";

              if (feature.properties && feature.properties.popupContent) {
                popupContent += feature.properties.popupContent;
              }

              layer.bindPopup(popupContent);
            }
    var shutIcon = L.icon({
      iconUrl: 'shutmark.png',
      iconSize: [32, 37],
      iconAnchor: [16, 37],
      popupAnchor: [0, -28]
    });

    var shutLayer = {      
            "type": "FeatureCollection",
            // "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features":[],
          }
    var json_shut = new L.geoJson(shutLayer);

    /////

      fname=[];
      enddates=[];
      function seeshutplace() {
        
        map.removeLayer(json_Unconstructed13JSON);
        map.removeLayer(json_Security12JSON);
        map.removeLayer(json_Waterbody11JSON);
        map.removeLayer(json_ParksLawns10JSON);
        map.removeLayer(json_HallWalkways9JSON);
        map.removeLayer(json_Parking8JSON);
        map.removeLayer(json_Religious7JSON);
        map.removeLayer(json_EventVenues6JSON);
        map.removeLayer(json_FitnessSports5JSON);
        map.removeLayer(json_ShopsCanteens4JSON);
        map.removeLayer(json_Residential3JSON);
        map.removeLayer(json_Facilities2JSON);
        map.removeLayer(json_Academic1JSON);

        map.removeLayer(json_shut);
        map.removeLayer(json_shutdown);
        var select = document.getElementById("shutselectsee");
        var answer = select.options[select.selectedIndex].value;
        var hret = new XMLHttpRequest();

        var ans="answer="+answer;
        hret.open("POST", "getphp.php", true);
        hret.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        for (var i = 0; i < fname.length; ++i){     // empty the listbox

              document.form2.listValue.options[i]=null;
            }
        hret.onreadystatechange = function() {
          if (hret.readyState == 4 && hret.status == 200) {
            // document.getElementById("getlayer").innerHTML = hret.responseText;
            lc=hret.responseText;
            // lcj=JSON.parse(lc );
            splittypes = lc.split("___");
            console.log(splittypes)
            lc1=splittypes[0].slice(0,-1);
            lc2=splittypes[1].slice(0,-1);
            lc3=splittypes[2].slice(0,-1);
            lc4=splittypes[3].slice(0,-1);
            // layerwhole=layercomma.replace(/,\s*$/, "");
            layerstr=lc1.split("|");
            strdetail=lc2.split("|");
            strdates=lc3.split("|");
            enddates=lc4.split("|");
            // newdates=[];
            // for (i = 0; i < enddates.length; i++){
            //     // nd[i]=Date.parse(enddates[i]);
            //     newdates[i]= new Date(enddates[i]);
            //     console.log(newdates[i])
            // }
            myLayer.features=[];
            // console.log(fname.length)
            
            fname=[];
            featsh=[];
            shutLayer = {      
              "type": "FeatureCollection",
              "features":[],
            }
            for (i = 0; i < layerstr.length; i++) {     
              L.geoJson(json_Mergednew18, {
                  onEachFeature: function (feature, layer) {
                    if(feature.properties.id==layerstr[i]){        //check database layer id matches with which feature of jsonmerged
                      feature.properties.About=enddates[i];
                      feature.properties.USE=strdates[i];
                      feature.properties.ShortName=strdetail[i];
                      myLayer['features'].push(feature);
                      // myLayer['features'].push(enddates[i]);
                      fname.push(feature.properties.Combined);

                       //For shutdown layer coordinates
                      var getCentroid = function (arr) { 
                          return arr.reduce(function (x,y) {
                              return [x[0] + y[0]/arr.length, x[1] + y[1]/arr.length] 
                          }, [0,0]) 
                      }
                      centroidPoly=getCentroid(feature.geometry.coordinates[0]);
                      featsh[i]={
                      "geometry": {
                          "type": "Point",
                          "coordinates": [

                             centroidPoly[0],
                             centroidPoly[1]
                              ]
                          },
                          "type": "Feature",
                          "properties": {
                              "popupContent": "<table><tr><th><b>Name</th><td>"+"Shutdown"+ "</b></th></tr><tr><th><b>Location</th><td>"+ feature.properties.Name+ "</b></th></tr><tr><th >Description</th><td>"+strdetail[i] + "</td></tr><tr><th>Starts on</th><td>" + strdates[i] + "</td></tr><tr><th>Ends on</th><td>" + enddates[i] + "</td></tr></table>"



                          }
                      };

                      shutLayer['features'].push(featsh[i]);
                      //////////////////

                    }

                  }
              });
             }
             if (fname.length==1){
              document.getElementById('gethead').innerHTML=fname.length+' place with shutdown !';  
             }
             else{
                document.getElementById('gethead').innerHTML=fname.length+' places with shutdown !';
             }
            for(var i = 0; i < fname.length; ++i){
                var vn=fname[i];
               addname = new Option(vn, vn);
               document.form2.listValue.options[i] = addname;
             }
           
            
            // Add mylayer
            json_shutdown=L.geoJson(myLayer, {
                        onEachFeature: pop_shutdown,
                        style: doStyleshutdown
                    });
            
            json_shutdown.addTo(map);

            // Add marker shutdown layer
           

            json_shut=L.geoJson(shutLayer, {

              style: function (feature) {
                return feature.properties;
              },

              pointToLayer: function (feature, latlng) {
                // alert(latlng)
                return L.marker(latlng, {icon: shutIcon});
              },

              onEachFeature: onEachshutFeature
            });

            json_shut.addTo(map);
            // var json_myLayerJSON = new L.geoJson(myLayer);  //DONE ADDING SHUTDOWN FEATURE ON MAP

            document.getElementById("listboxsee").addEventListener("click", zoomToShutdown);

         }
        };
        
        hret.send(ans);
        // return json_shutdown;
     }
     var searchControlsee= new L.Control.Search({
        container: 'findbox_see',
        layer: json_Mergednew18JSON,
        propertyName: 'Combined',
        
        textPlaceholder: 'Select Element to Zoom',
        initial: false,
        collapsed: false,
        markerLocation: false,
        }) ;
     map.addControl(searchControlsee);
     function zoomToShutdown() {
      // alert('inside fnc')
        Index = document.form2.listValue.selectedIndex;
        zoomname=document.form2.listValue.options[Index].value;
        searchControlsee.searchText( zoomname );
       
     }


     function hideshutplace() {          
      // console.log(json_shutdown);
        map.addLayer(json_Unconstructed13JSON);
        map.addLayer(json_Security12JSON);
        map.addLayer(json_Waterbody11JSON);
        map.addLayer(json_ParksLawns10JSON);
        map.addLayer(json_HallWalkways9JSON);
        map.addLayer(json_Parking8JSON);
        map.addLayer(json_Religious7JSON);
        map.addLayer(json_EventVenues6JSON);
        map.addLayer(json_FitnessSports5JSON);
        map.addLayer(json_ShopsCanteens4JSON);
        map.addLayer(json_Residential3JSON);
        map.addLayer(json_Facilities2JSON);
        map.addLayer(json_Academic1JSON);
      map.removeLayer(json_shut);
      map.removeLayer(json_shutdown);
     }
//////////////

// EVENTS Adding //////////////
        var searchControl= new L.Control.Search({
          container: 'event_loc_all',
          layer: json_Mergednew18JSON,
          propertyName: 'Combined',
          
          textPlaceholder: 'Event Location- All',
          initial: false,
          collapsed: false,
          markerLocation: true,
          
        }) ;
        map.addControl(searchControl);

        var eventLayer = {
        "type": "FeatureCollection",
        "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
        "features":[],
      }
      var json_event = new L.geoJson(eventLayer);

        function addevent() {
          evloc=document.getElementsByName("searchbox").value;
          if (evloc==undefined){
            alert('Please select a location');
          }
          L.geoJson(json_Mergednew18, {
            onEachFeature: checkEventMatch
        });
         
      }

      
      function checkEventMatch (feature) {
          evloc=document.getElementsByName("searchbox").value;

          if (evloc==feature.properties.Combined){
            
            var eventLayerId=feature.properties.id;
            var eventfeatname=feature.properties.Combined;

            var eventstart = document.getElementById('datetime-eventstart').value;
            var eventend = document.getElementById('datetime-eventend').value; 
            var eventname = document.getElementById('eventname').value;
            var eventdescr = document.getElementById('eventdescr').value; 
            var eventadder = document.getElementById('adder').value; 
             ////Posting to php using AJAX /////////////

              // Create our XMLHttpRequest object
              var hr = new XMLHttpRequest();
              console.log(eventfeatname)
              // Create some variables we need to send to our PHP file
              var url = "postevent.php";
              var vars = "eventname="+eventname+"&eventdescr="+eventdescr+"&evid="+eventLayerId+"&evlocation="+eventfeatname+"&adder="+eventadder+"&eventstart="+eventstart+"&eventend="+eventend;
              hr.open("POST", url, true);
              // Set content type header information for sending url encoded variables in the request
              hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              // Access the onreadystatechange event for the XMLHttpRequest object
              hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                  var return_data = hr.responseText;
                  document.getElementById("statusevent").innerHTML = return_data;
                // alert(feature.properties.Combined);
                }
              }
              // Send the data to PHP now... and wait for response to update the status div
              hr.send(vars); // Actually execute the request
              document.getElementById("statusevent").innerHTML = "processing...";

              ////////DONE POSTING TO PHP////////////////

          }
      }
// EVENTS Showing/////////////////
    function pop_event(feature, layer) {
                    layer.on({
                        mouseout: function(e) {
                            layer.setStyle(doStyleEvent(feature));

                        },
                        mouseover: highlightFeature,
                    });
                    
                    var popupContent = '<table><tr><th scope="row"><b>Event </b></th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Location</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">Description</th><td>' + (feature.properties['About'] !== null ? Autolinker.link(String(feature.properties['About'])) : '') + '</td></tr><tr><th scope="row">Starts at</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Ends at</th><td>' + (feature.properties['BLOCK'] !== null ? Autolinker.link(String(feature.properties['BLOCK'])) : '') +'</td></tr><tr><th scope="row">Added by</th><td>' + (feature.properties['Department'] !== null ? Autolinker.link(String(feature.properties['Department'])) : '') +'</td></tr></table>';
                    

                    // var popupContent='event';
                    layer.bindPopup(popupContent);
        }
       
        function doStyleEvent(feature) {
          
               return {
                          weight: 1.04,
                          color: '#000000',
                          fillColor: 'yellow',
                          dashArray: '',
                          lineCap: 'square',
                          lineJoin: 'bevel',
                          opacity: 1,
                          fillOpacity: 1
                      };
                    
            
        }


// For event marker layer

   function onEachevmarkFeature(feature, layer) {
              var popupContent = "<p> Event Details: </p>";

              if (feature.properties && feature.properties.popupContent) {
                popupContent += feature.properties.popupContent;
              }

              layer.bindPopup(popupContent);
            }
    var evmarkIcon = L.icon({
      iconUrl: 'evmark1.png',
      iconSize: [32, 37],
      iconAnchor: [16, 37],
      popupAnchor: [0, -28]
    });

    var evmarkLayer = {      
            "type": "FeatureCollection",
            // "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features":[],
          }
    var json_evmark = new L.geoJson(evmarkLayer);
//////////
    evname=[];
    function showevent() {
        map.removeLayer(json_Unconstructed13JSON);
        map.removeLayer(json_Security12JSON);
        map.removeLayer(json_Waterbody11JSON);
        map.removeLayer(json_ParksLawns10JSON);
        map.removeLayer(json_HallWalkways9JSON);
        map.removeLayer(json_Parking8JSON);
        map.removeLayer(json_Religious7JSON);
        map.removeLayer(json_EventVenues6JSON);
        map.removeLayer(json_FitnessSports5JSON);
        map.removeLayer(json_ShopsCanteens4JSON);
        map.removeLayer(json_Residential3JSON);
        map.removeLayer(json_Facilities2JSON);
        map.removeLayer(json_Academic1JSON);

        map.removeLayer(json_evmark);
        map.removeLayer(json_event);
        var hev = new XMLHttpRequest();
      
        hev.open("POST", "getevent.php", true);
        hev.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        for (var i = 0; i < evname.length; ++i){     // empty the listbox

              document.form3.listValue.options[i]=null;
            }
        hev.onreadystatechange = function() {
          if (hev.readyState == 4 && hev.status == 200) {
            // document.getElementById("getlayer").innerHTML = hev.responseText;
            lc=hev.responseText;
            // lcj=JSON.parse(lc );
            splittypes = lc.split("___");
// |26|42|27|21|", "Talks|Talks|Talks|Talks|Talks|", "|Techkriti17|Techkriti"17|Techkriti…", "|2017-03-14 13:00:00|2017-03-14 13:…", "|2017-03-14 16:00:00|2017-03-14 16:…"             
            console.log(splittypes)
            lc0=splittypes[0].slice(1);   //remove first  |
            lc0=lc0.slice(0,-1);          // remove ending |
            lc1=splittypes[1].slice(0,-1);
            lc2=splittypes[2].slice(1);
            lc2=lc2.slice(0,-1);
            lc3=splittypes[3].slice(1);
            lc3=lc3.slice(0,-1);
            lc4=splittypes[4].slice(1);
            lc4=lc4.slice(0,-1);
            lc5=splittypes[5].slice(1);
            lc5=lc5.slice(0,-1);
            // layerwhole=layercomma.replace(/,\s*$/, "");
            evids=lc0.split("|");
            evtit=lc1.split("|");
            evdes=lc2.split("|");
            evstrt=lc3.split("|");
            evend=lc4.split("|");
            evadder=lc5.split("|");
            eventLayer.features=[];
            // console.log(evname.length)
            
            evname=[];
            featev=[];
           
            for (i = 0; i < evids.length; i++) {     
              L.geoJson(json_Mergednew18, {
                  onEachFeature: function (feature, layer) {
                    if(feature.properties.id==evids[i]){        //check database layer id matches with which feature of jsonmerged
                      
                      feature.properties.Type=evtit[i];
                      feature.properties.About=evdes[i];
                      feature.properties.USE=evstrt[i];
                      feature.properties.BLOCK=evend[i];
                      feature.properties.Department=evadder[i];
                      eventLayer['features'].push(feature);
                      // myLayer['features'].push(enddates[i]);
                      evname.push(feature.properties.Combined);
                      
                      //For marker layer coordinates
                      var getCentroid = function (arr) { 
                          return arr.reduce(function (x,y) {
                              return [x[0] + y[0]/arr.length, x[1] + y[1]/arr.length] 
                          }, [0,0]) 
                      }
                      centroidPoly=getCentroid(feature.geometry.coordinates[0]);
                      
                      featev[i]={
                      "geometry": {
                          "type": "Point",
                          "coordinates": [
                              centroidPoly[0],
                              centroidPoly[1]
                            ]
                          },
                          "type": "Feature",
                          "properties": {
                              "popupContent": "<table><tr><th><b>Name</th><td>"+evtit[i]+ "</b></th></tr><tr><th><b>Location</th><td>"+ feature.properties.Name+ "</b></th></tr><tr><th >Description</th><td>" + evdes[i] + "</td></tr><tr><th >Added by</th><td>" + evadder[i] + "</td></tr><tr><th>Starts on</th><td>" + evstrt[i] + "</td></tr><tr><th>Ends on</th><td>" + evend[i] + "</td></tr></table>"

                          }
                      };

                      evmarkLayer['features'].push(featev[i]);
                      //////////////////

                    }

                  }
              });
             }
             if (evname.length==1){
              document.getElementById('getheadev').innerHTML=evname.length+' event is upcoming !';  
             }
             else{
                document.getElementById('getheadev').innerHTML=evname.length+' events are upcoming !';
             }
            for(var i = 0; i < evname.length; ++i){
                var vn=evtit[i]+': '+evname[i];
               addname = new Option(vn, vn);
               document.form3.listValue.options[i] = addname;
             }
           
            
            // Add mylayer
            json_event=L.geoJson(eventLayer, {
                        onEachFeature: pop_event,
                        style: doStyleEvent
                    });
            json_event.addTo(map);
          // Add marker events layer
           

            json_evmark= L.geoJson(evmarkLayer, {

              style: function (feature) {
                return feature.properties;
              },

              pointToLayer: function (feature, latlng) {
                // alert(latlng)
                return L.marker(latlng, {icon: evmarkIcon});
              },

              onEachFeature: onEachevmarkFeature
            });
            json_evmark.addTo(map);
            // var json_myLayerJSON = new L.geoJson(myLayer);  //DONE ADDING SHUTDOWN FEATURE ON MAP

            document.getElementById("listboxevent").addEventListener("click", zoomToEvent);

         }
        };
        
        hev.send();
     }

     var searchControlevent= new L.Control.Search({
        container: 'findbox_event',
        layer: json_Mergednew18JSON,
        propertyName: 'Combined',
        
        textPlaceholder: 'Select Element to Zoom',
        initial: false,
        collapsed: false,
        markerLocation: false,
        }) ;
     map.addControl(searchControlevent);
     function zoomToEvent() {
      // alert('inside fnc')
        var Index = document.getElementById("listboxevent").selectedIndex;
        zoomname=document.getElementById("listboxevent").options[Index].value;
        evsrch=zoomname.split(": ")
        searchControlevent.searchText( evsrch[1] );
       
     }

     function hideevent() {  

      // console.log(json_shutdown);
       map.addLayer(json_Unconstructed13JSON);
        map.addLayer(json_Security12JSON);
        map.addLayer(json_Waterbody11JSON);
        map.addLayer(json_ParksLawns10JSON);
        map.addLayer(json_HallWalkways9JSON);
        map.addLayer(json_Parking8JSON);
        map.addLayer(json_Religious7JSON);
        map.addLayer(json_EventVenues6JSON);
        map.addLayer(json_FitnessSports5JSON);
        map.addLayer(json_ShopsCanteens4JSON);
        map.addLayer(json_Residential3JSON);
        map.addLayer(json_Facilities2JSON);
        map.addLayer(json_Academic1JSON);
      map.removeLayer(json_evmark);
      map.removeLayer(json_event);
     }    

// Lost and Found Adding //////////////
        var searchControl= new L.Control.Search({
          container: 'lnf_loc_all',
          layer: json_Mergednew18JSON,
          propertyName: 'Combined',
          
          textPlaceholder: 'Enter Nearest Location',
          initial: false,
          collapsed: false,
          markerLocation: true,
          
        }) ;
        map.addControl(searchControl);
        var lnfLayer = {      
        "type": "FeatureCollection",
        "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
        "features":[],
      }
      var json_obj = new L.geoJson(lnfLayer);

        function addobj() {
          objloc=document.getElementsByName("searchbox").value;
          if (objloc==undefined){
            alert('Please select a location');
          }
          L.geoJson(json_Mergednew18, {
            onEachFeature: checkObjMatch
        });
         
      }

      
      function checkObjMatch (feature) {
          objloc=document.getElementsByName("searchbox").value;

          if (objloc==feature.properties.Combined){
            
            var objLayerId=feature.properties.id;
            var objfeatname=feature.properties.Combined;

            var objtime = document.getElementById('datetime-obj').value;
            var objname = document.getElementById('objname').value;
            var objdescr = document.getElementById('objdescr').value; 
            var objadder = document.getElementById('objadder').value; 
            var objaddress = document.getElementById('objaddress').value; 
            var objsel= document.getElementById('objsel').value;
             ////Posting to php using AJAX /////////////

              // Create our XMLHttpRequest object
              var hr = new XMLHttpRequest();
              console.log(objfeatname)
              // Create some variables we need to send to our PHP file
              var url = "postobj.php";
              var vars = "objname="+objname+"&objdescr="+objdescr+"&objid="+objLayerId+"&objlocation="+objfeatname+"&adder="+objadder+"&address="+objaddress+"&objtime="+objtime+"&objsel="+objsel;
              hr.open("POST", url, true);
              // Set content type header information for sending url encoded variables in the request
              hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              // Access the onreadystatechange obj for the XMLHttpRequest object
              hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                  var return_data = hr.responseText;
                  document.getElementById("statusobj").innerHTML = return_data;
                // alert(feature.properties.Combined);
                }
              }
              // Send the data to PHP now... and wait for response to update the status div
              hr.send(vars); // Actually execute the request
              document.getElementById("statusobj").innerHTML = "processing...";

              ////////DONE POSTING TO PHP////////////////

          }
      }

// Lost found showing/////////////////
// marker///
// For  marker layer

   function onEachlnfFeature(feature, layer) {
              var popupContent = "<p> Object Details: </p>";

              if (feature.properties && feature.properties.popupContent) {
                popupContent += feature.properties.popupContent;
              }

              layer.bindPopup(popupContent);
            }
    var lnfIcon = L.icon({
      iconUrl: 'lnfm.png ',
      iconSize: [32, 37],
      iconAnchor: [16, 37],
      popupAnchor: [0, -28]
    });

    var lnfmLayer = {      
            "type": "FeatureCollection",
            // "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features":[],
          }
    var json_lnf = new L.geoJson(lnfmLayer);
    //////////
    function pop_obj(feature, layer) {
                    layer.on({
                        mouseout: function(e) {
                            layer.setStyle(doStyleObj(feature));

                        },
                        mouseover: highlightFeature,
                    });
                    var select = document.getElementById("seeobjsel");
                    var answer = select.options[select.selectedIndex].value;
                    switch (answer) {
                      case '1':   descr='Lost';break;
                      case '2':   descr='Found';break;
 
                      default :   descr='';break;
                  };
                    var popupContent = '<table><tr><th scope="row"><b>Object '+descr+' </b></th><td>' + (feature.properties['Type'] !== null ? Autolinker.link(String(feature.properties['Type'])) : '') + '</td></tr><tr><th scope="row">Location</th><td>' + (feature.properties['Name'] !== null ? Autolinker.link(String(feature.properties['Name'])) : '') + '</td></tr><tr><th scope="row">Description</th><td>' + (feature.properties['About'] !== null ? Autolinker.link(String(feature.properties['About'])) : '') + '</td></tr><tr><th scope="row">Entered at</th><td>' + (feature.properties['USE'] !== null ? Autolinker.link(String(feature.properties['USE'])) : '') + '</td></tr><tr><th scope="row">Added by</th><td>' + (feature.properties['BLOCK'] !== null ? Autolinker.link(String(feature.properties['BLOCK'])) : '') +'</td></tr><tr><th scope="row">Contact Address</th><td>' + (feature.properties['Department'] !== null ? Autolinker.link(String(feature.properties['Department'])) : '') +'</td></tr></table>';
                    

                    // var popupContent='event';
                    layer.bindPopup(popupContent);
        }
       
        function doStyleObj(feature) {
          
               return {
                          weight: 1.04,
                          color: '#000000',
                          fillColor: 'yellow',
                          dashArray: '',
                          lineCap: 'square',
                          lineJoin: 'bevel',
                          opacity: 1,
                          fillOpacity: 1
                      };
                    
            
        }

    objname=[];
    function shobj() {
        map.removeLayer(json_Unconstructed13JSON);
        map.removeLayer(json_Security12JSON);
        map.removeLayer(json_Waterbody11JSON);
        map.removeLayer(json_ParksLawns10JSON);
        map.removeLayer(json_HallWalkways9JSON);
        map.removeLayer(json_Parking8JSON);
        map.removeLayer(json_Religious7JSON);
        map.removeLayer(json_EventVenues6JSON);
        map.removeLayer(json_FitnessSports5JSON);
        map.removeLayer(json_ShopsCanteens4JSON);
        map.removeLayer(json_Residential3JSON);
        map.removeLayer(json_Facilities2JSON);
        map.removeLayer(json_Academic1JSON);        
        map.removeLayer(json_obj);
        map.removeLayer(json_lnf);
        var select = document.getElementById("seeobjsel");
        var answer = select.options[select.selectedIndex].value;
        var hobj = new XMLHttpRequest();

        var ans="answer="+answer;
      
        hobj.open("POST", "getobj.php", true);
        hobj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        for (var i = 0; i < objname.length; ++i){     // empty the listbox

              document.form5.listValue.options[i]=null;
        }
        hobj.onreadystatechange = function() {
          if (hobj.readyState == 4 && hobj.status == 200) {
            // document.getElementById("getlayer").innerHTML = hobj.responseText;
            lc=hobj.responseText;
            // lcj=JSON.parse(lc );
            splittypes = lc.split("___");
// |26|42|27|21|", "Talks|Talks|Talks|Talks|Talks|", "|Techkriti17|Techkriti"17|Techkriti…", "|2017-03-14 13:00:00|2017-03-14 13:…", "|2017-03-14 16:00:00|2017-03-14 16:…"             
            console.log(splittypes)
            lc0=splittypes[0].slice(0,-1);   //remove last  |
            lc1=splittypes[1].slice(0,-1);
            lc2=splittypes[2].slice(0,-1);
            lc3=splittypes[3].slice(0,-1);
            lc4=splittypes[4].slice(0,-1);
            lc5=splittypes[5].slice(0,-1);
            lc6=splittypes[6].slice(0,-1);
            // layerwhole=layercomma.replace(/,\s*$/, "");
            objids=lc0.split("|");
            objtit=lc1.split("|");
            objdes=lc2.split("|");
            objtm=lc3.split("|");
            objadr=lc4.split("|");
            objadrs=lc5.split("|");
            objsl=lc6.split("|");
            lnfLayer.features=[];
            // console.log(objname.length)
            
            objname=[];
            featln=[];
            lnfmLayer = {      
              "type": "FeatureCollection",
              // "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
              "features":[],
            }
            for (i = 0; i < objids.length; i++) {     
              L.geoJson(json_Mergednew18, {
                  onEachFeature: function (feature, layer) {
                    if(feature.properties.id==objids[i]){        //check database layer id matches with which feature of jsonmerged
                      
                      feature.properties.Type=objtit[i];
                      feature.properties.About=objdes[i];
                      feature.properties.USE=objtm[i];
                      feature.properties.BLOCK=objadr[i];
                      feature.properties.Department=objadrs[i];
                      lnfLayer['features'].push(feature);
                      // myLayer['features'].push(enddates[i]);
                      objname.push(feature.properties.Combined);

                      //For lnf marker layer coordinates
                      var getCentroid = function (arr) { 
                          return arr.reduce(function (x,y) {
                              return [x[0] + y[0]/arr.length, x[1] + y[1]/arr.length] 
                          }, [0,0]) 
                      }
                      centroidPoly=getCentroid(feature.geometry.coordinates[0]);
                      
                      featln[i]={
                      "geometry": {
                          "type": "Point",
                          "coordinates": [
                              centroidPoly[0],
                              centroidPoly[1]
                            ]
                          },
                          "type": "Feature",
                          "properties": {
                              "popupContent": "<table><tr><th><b>Name</th><td>"+objtit[i]+ "</b></th></tr><tr><th><b>Location</th><td>"+ feature.properties.Name+ "</b></th></tr><tr><th >Description</th><td>" + objdes[i] + "</td></tr><tr><th >Added by</th><td>" + objadr[i] + "</td></tr><tr><th>Adder's Address</th><td>" + objadrs[i] + "</td></tr><tr><th>Added on</th><td>" + objtm[i] + "</td></tr></table>"

                          }
                      };

                      lnfmLayer['features'].push(featln[i]);
                      //////////////////



                    }

                  }
              });
             }
             if (objname.length==1){
              document.getElementById('getheadobj').innerHTML=evname.length+' object is found !';
             }
             else{
                document.getElementById('getheadobj').innerHTML=objname.length+' objects are found !';
             }
            for(var i = 0; i < objname.length; ++i){
                var vn=objtit[i]+': '+objname[i];
               addname = new Option(vn, vn);
               document.form5.listValue.options[i] = addname;
             }
           
            
            // Add mylayer
            json_obj= L.geoJson(lnfLayer, {
                        onEachFeature: pop_obj,
                        style: doStyleObj
                    });
            json_obj.addTo(map);
            // var json_myLayerJSON = new L.geoJson(myLayer);  //DONE ADDING SHUTDOWN FEATURE ON MAP

            // Add marker lnf layer
           

            json_lnf= L.geoJson(lnfmLayer, {

              style: function (feature) {
                return feature.properties;
              },

              pointToLayer: function (feature, latlng) {
                // alert(latlng)
                return L.marker(latlng, {icon: lnfIcon});
              },

              onEachFeature: onEachlnfFeature
            });
            json_lnf.addTo(map);
            document.getElementById("listboxobj").addEventListener("click", zoomToObj);

         }
        };
        
        hobj.send(ans);
        // return json_shutdown;
     }

     var searchControlobj= new L.Control.Search({
        container: 'findbox_obj',
        layer: json_Mergednew18JSON,
        propertyName: 'Combined',
        
        textPlaceholder: 'Select Element to Zoom',
        initial: false,
        collapsed: false,
        markerLocation: false,
        }) ;
     map.addControl(searchControlobj);
     function zoomToObj() {
      // alert('inside fnc')
        Index = document.form5.listValue.selectedIndex;
        zoomname=document.form5.listValue.options[Index].value;
        objsrch=zoomname.split(": ")
        searchControlobj.searchText( objsrch[1] );
       
     }

     function hdobj() {
        map.removeLayer(json_obj);
        map.removeLayer(json_lnf);        
        map.addLayer(json_Unconstructed13JSON);
        map.addLayer(json_Security12JSON);
        map.addLayer(json_Waterbody11JSON);
        map.addLayer(json_ParksLawns10JSON);
        map.addLayer(json_HallWalkways9JSON);
        map.addLayer(json_Parking8JSON);
        map.addLayer(json_Religious7JSON);
        map.addLayer(json_EventVenues6JSON);
        map.addLayer(json_FitnessSports5JSON);
        map.addLayer(json_ShopsCanteens4JSON);
        map.addLayer(json_Residential3JSON);
        map.addLayer(json_Facilities2JSON);
        map.addLayer(json_Academic1JSON);        

     }

var brdloc;
 
// START MEASURE TOOLS /////////////////
      L.Control.measureControl().addTo(map);

      var featureGroup = L.featureGroup().addTo(map);

      var drawControl = new L.Control.Draw({
        edit: {
          featureGroup: featureGroup,
          remove: true
        },
        draw: {
          polyline: false,
          polygon: {
            allowIntersection: false,
            showArea: true,
            drawError: {
              color: '#b00b00',
              timeout: 1000
            },
            shapeOptions: {
              color: '#bada55'
            }
          },
          circle: {
            shapeOptions: {
              color: '#662d91'
            }
          },
          marker: true
        }
      }).addTo(map);

      // map.on('draw:created', showPolygonArea);
      map.on('draw:created', function (e) {
        var type = e.layerType,
            layer = e.layer;

        map.addLayer(layer);

        if (type === 'marker') {   
            brdloc=layer.getLatLng();
            layer.bindPopup('Location: ' + layer.getLatLng()).openPopup();
        }
        if (type === 'polygon') {    
            featureGroup.clearLayers();
            featureGroup.addLayer(e.layer);
            e.layer.bindPopup((LGeo.area(e.layer)).toFixed(2) + ' m<sup>2</sup>');
            e.layer.openPopup();
        }

    });

      map.on('draw:edited', showPolygonAreaEdited);

      function showPolygonAreaEdited(e) {
        e.layers.eachLayer(function(layer) {
          showPolygonArea({ layer: layer });
        });
      }
      function showPolygonArea(e) {
        featureGroup.clearLayers();
        featureGroup.addLayer(e.layer);
        e.layer.bindPopup((LGeo.area(e.layer)).toFixed(2) + ' m<sup>2</sup>');
        e.layer.openPopup();

        
      }
//END MEASURE TOOLS --------------------

// Birds adding///////////////
        function addbrloc() {

           document.getElementById('brloc').value=brdloc;
        }

        
        function addbr() {
   

            var brstr=String(document.getElementById('brloc').value);
            brcent = brstr.match(/[+-]?\d+(\.\d+)?/g); //     /\d+/g);
            brlat = brcent[0];
            brlng = brcent[1];
            // alert(brlng)
            var brtime = document.getElementById('datetime-br').value;
            var brname = document.getElementById('brname').value;
            var brdescr = document.getElementById('brdescr').value; 
            var bradder = document.getElementById('bradder').value; 
            // var brloc = document.getElementById('brloc').value; 
            // var brsel= document.getElementById('brsel').value;

             ////Posting to php using AJAX /////////////

              // Create our XMLHttpRequest object
              var hr = new XMLHttpRequest();
              console.log(brtime)
              // Create some variables we need to send to our PHP file
              var url = "postbr.php";
              var vars = "brname="+brname+"&brdescr="+brdescr+"&adder="+bradder+"&brtime="+brtime+"&brlat="+brlat+"&brlng="+brlng;
              hr.open("POST", url, true);
              // Set content type header information for sending url encoded variables in the request
              hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              // Access the onreadystatechange obj for the XMLHttpRequest object
              hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                  var return_data = hr.responseText;
                  document.getElementById("statusbr").innerHTML = return_data;
                // alert(feature.properties.Combined);
                }
              }
              // Send the data to PHP now... and wait for response to update the status div
              hr.send(vars); // Actually execute the request
              document.getElementById("statusbr").innerHTML = "Processing...";

              ////////DONE POSTING TO PHP////////////////
        }


// See birds ///////////////////
  var baseballIcon = L.icon({
      iconUrl: 'brd.png',
      iconSize: [32, 37],
      iconAnchor: [16, 37],
      popupAnchor: [0, -28]
    });

    var brLayer = {      
            "type": "FeatureCollection",
            // "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features":[],
          }
    var json_br = new L.geoJson(brLayer);

    function seebr() {
        map.removeLayer(json_Unconstructed13JSON);
        map.removeLayer(json_Security12JSON);
        map.removeLayer(json_Waterbody11JSON);
        map.removeLayer(json_ParksLawns10JSON);
        map.removeLayer(json_HallWalkways9JSON);
        map.removeLayer(json_Parking8JSON);
        map.removeLayer(json_Religious7JSON);
        map.removeLayer(json_EventVenues6JSON);
        map.removeLayer(json_FitnessSports5JSON);
        map.removeLayer(json_ShopsCanteens4JSON);
        map.removeLayer(json_Residential3JSON);
        map.removeLayer(json_Facilities2JSON);
        map.removeLayer(json_Academic1JSON);        
       map.removeLayer(json_br);
        var hobj = new XMLHttpRequest();

     
        hobj.open("POST", "getbr.php", true);
        hobj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        hobj.onreadystatechange = function() {
          if (hobj.readyState == 4 && hobj.status == 200) {
            // document.getElementById("getlayer").innerHTML = hobj.responseText;
            lc=hobj.responseText;
            // lcj=JSON.parse(lc );
            splittypes = lc.split("___");
            console.log(splittypes)
            lc0=splittypes[0].slice(0,-1);   //remove last  |
            lc1=splittypes[1].slice(0,-1);
            lc2=splittypes[2].slice(0,-1);
            lc3=splittypes[3].slice(0,-1);
            lc4=splittypes[4].slice(0,-1);
            lc5=splittypes[5].slice(0,-1);
            // layerwhole=layercomma.replace(/,\s*$/, "");
            brnm=lc0.split("|");
            brds=lc1.split("|");
            brad=lc2.split("|");
            brtm=lc3.split("|");
            brlt=lc4.split("|");
            brln=lc5.split("|");
            brLayer.features=[];
            // console.log(objname.length)
            featbr=[];
            for (i = 0; i < brnm.length; i++) {
                  featbr[i]={
                      "geometry": {
                          "type": "Point",
                          "coordinates": [
                              brln[i],
                              brlt[i]
                          ]
                      },
                      "type": "Feature",
                      "properties": {
                          "popupContent": "<table><tr><th><b>Name</th><td>"+brnm[i]+ "</b></th></tr><tr><th >Description</th><td>" + brds[i] + "</td></tr><tr><th >Sighted by</th><td>" + brad[i] + "</td></tr><tr><th>Sighted on</th><td>" + brtm[i] + "</td></tr></table>"

                      }
                  };

                  brLayer['features'].push(featbr[i]);
            }
             
            // for (i = 0; i < brnm.length; i++) {     
            //   L.geoJson(json_Mergednew18, {
            //       onEachFeature: function (feature, layer) {
            //         if(feature.properties.id==objids[i]){        //check database layer id matches with which feature of jsonmerged
                      
            //           feature.properties.Type=objtit[i];
            //           feature.properties.About=objdes[i];
            //           feature.properties.USE=objtm[i];
            //           feature.properties.BLOCK=objadr[i];
            //           feature.properties.Department=objadrs[i];
            //           lnfLayer['features'].push(feature);
            //           // myLayer['features'].push(enddates[i]);
            //           objname.push(feature.properties.Combined);

            //         }

            //       }
            //   });
            //  }
             if (brnm.length==1){
              document.getElementById('getheadbr').innerHTML=brnm.length+' sighting is found !';
             }
             else{
                document.getElementById('getheadbr').innerHTML=brnm.length+' sightings are found !';
             }
            // for(var i = 0; i < objname.length; ++i){
            //     var vn=objtit[i]+': '+objname[i];
            //    addname = new Option(vn, vn);
            //    document.form5.listValue.options[i] = addname;
            //  }
           
            
            // Add mylayer
            function onEachFeature(feature, layer) {
              var popupContent = "<p> Picture sighted: </p>";

              if (feature.properties && feature.properties.popupContent) {
                popupContent += feature.properties.popupContent;
              }

              layer.bindPopup(popupContent);
            }

            json_br=L.geoJson(brLayer, {

              style: function (feature) {
                return feature.properties;
              },

              pointToLayer: function (feature, latlng) {
                // alert(latlng)
                return L.marker(latlng, {icon: baseballIcon});
              },

              onEachFeature: onEachFeature
            });
            json_br.addTo(map);

            // L.geoJson(brLayer, {
            //             onEachFeature: pop_obj,
            //             style: doStyleObj
            //         }).addTo(map);
            // L.geoJson(brLayer).addTo(map);
            
            // var json_myLayerJSON = new L.geoJson(myLayer);  //DONE ADDING SHUTDOWN FEATURE ON MAP

            // document.getElementById("listboxobj").addEventListener("click", zoomToEvent);

         }
        };
        
        hobj.send();
        // return json_shutdown;
     }
        
      function hdbr() {
        map.addLayer(json_Unconstructed13JSON);
        map.addLayer(json_Security12JSON);
        map.addLayer(json_Waterbody11JSON);
        map.addLayer(json_ParksLawns10JSON);
        map.addLayer(json_HallWalkways9JSON);
        map.addLayer(json_Parking8JSON);
        map.addLayer(json_Religious7JSON);
        map.addLayer(json_EventVenues6JSON);
        map.addLayer(json_FitnessSports5JSON);
        map.addLayer(json_ShopsCanteens4JSON);
        map.addLayer(json_Residential3JSON);
        map.addLayer(json_Facilities2JSON);
        map.addLayer(json_Academic1JSON);        
        map.removeLayer(json_br);
      }

//PRINT TOOL
      L.easyPrint().addTo(map)
// SCALE
      // function onLocationFound(e) {
      //       var radius = e.accuracy / 2;
      //       L.marker(e.latlng).addTo(map)
      //       .bindPopup("You are within " + radius + " meters from this point")
      //       .openPopup();
      //       L.circle(e.latlng, radius).addTo(map);
      //   }
      //   map.on('locationfound', onLocationFound);
        L.control.scale({options: {position: 'bottomleft', maxWidth: 100, metric: false, imperial: true, updateWhenIdle: false}}).addTo(map);
        // stackLayers();
        // map.on('overlayadd', restackLayers);
      
    </script>



  </body>
</html>