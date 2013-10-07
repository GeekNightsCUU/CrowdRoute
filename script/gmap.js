// configuration
var myZoom = 12;
var myMarkerIsDraggable = true;
var myCoordsLenght = 6;
var defaultLat = 28.670223;
var defaultLng = -106.073738;

var bus_image = 'imgs/pointer.png';

var map = new google.maps.Map(document.getElementById('canvas'), {
	zoom: myZoom,
	center: new google.maps.LatLng(defaultLat, defaultLng),
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	panControl: false,
    zoomControl: true,
    scaleControl: false,
    streetViewControl: false
});

var myMarker = new google.maps.Marker({
	position: new google.maps.LatLng(defaultLat, defaultLng),
	draggable: myMarkerIsDraggable,
	icon: bus_image
});

google.maps.event.addListener(myMarker, 'dragend', function(evt){
	document.getElementById('latitude').value = evt.latLng.lat().toFixed(myCoordsLenght);
	document.getElementById('longitude').value = evt.latLng.lng().toFixed(myCoordsLenght);
});

google.maps.event.addListener(map, 'click', function(evt){
	myMarker.setPosition(evt.latLng);
});

// centers the map on markers coords
map.setCenter(myMarker.position);

// adds the marker on the map
myMarker.setMap(map);

function placeMarker(location) {
  var marker = new google.maps.Marker({
      position: location,
      map: map
  });
}