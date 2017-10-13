 
function myrtfunc(){
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
            html += (i+1) + '. ';
            html += maneuvers[i].narrative + '';
        }

        L.DomUtil.get('route-narrative').innerHTML = html;
    }
  });

  dir.route({
      locations: [
          'iit kanpur',
           { latLng: { lat: 26.50943, lng: 80.23397 } }
      ]
  });

  map.addLayer(MQ.routing.routeLayer({
      directions: dir,
      fitBounds: true
  }));

};
