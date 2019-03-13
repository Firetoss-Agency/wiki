/**
 * Copy the JS to the route(s) you want to use it on.
 * Copy the Blade to the view(s) you want to use it on.
 * Add "height: 100%;" or define a static height to .acf-map.
 * Create API key and add it to existing function in app/theme/functions.php
 * Also add key to new script in <head>
 */



// Copy to JS Route
// ===================================================

// import {new_map} from '../components/google-maps'

// Create Maps
// let map = null;
// $('.acf-map').each(function() {
//   map = new_map( $(this) );
// });
// ===================================================



// Copy to Blade View
// ===================================================

// @set($location = get_field('location', 'option'))
// @if(!empty($location))
// <div class="acf-map">
//   <div class="marker"
// data-lat="{{ $location['lat'] }}"
// data-lng="{{ $location['lng'] }}">
//   </div>
//   </div>
// @endif
// ===================================================



// Google Map Embed via API

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @param	$el (jQuery element)
*  @return	n/a
*/
export function new_map( $el ) {

  let $markers = $el.find('.marker');
  let args = {
    zoom		: 12,
    center		: new google.maps.LatLng(0, 0),
    mapTypeId	: google.maps.MapTypeId.ROADMAP,
  };

  // create map
  let map = new google.maps.Map( $el[0], args);

  // add a markers reference
  map.markers = [];

  // add markers
  $markers.each(function(){
    add_marker( $(this), map );
  });

  // center map
  center_map( map );

  // return
  return map;
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/
function add_marker( $marker, map ) {
  let latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

  // create marker
  let marker = new google.maps.Marker({
    position : latlng,
    map	: map
  });

  // add to array
  map.markers.push( marker );

  // if marker contains HTML, add it to an infoWindow
  if( $marker.html() )
  {
    // create info window
    let infowindow = new google.maps.InfoWindow();

    // Populate infowindow with content
    let content = `
              <div>
              <strong>Perfect 10 Salon</strong><br>
              1950 North Main #101<br>North Logan, Utah 84341<br>
              <a href="tel:4357871010">(435) 787-1010</a>
              </div>`

    // Infowindow hover click event
    marker.addListener('click', function() {
      infowindow.setContent(content);
      infowindow.open(map, marker);
    });

    // show info window when marker is clicked
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open( map, marker );
    });
  }

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @param	map (Google Map object)
*  @return	n/a
*/
function center_map( map ) {
  let bounds = new google.maps.LatLngBounds();

  // loop through all markers and create bounds
  $.each( map.markers, function( i, marker ){
    let latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
    bounds.extend( latlng );
  });

  // only 1 marker?
  if( map.markers.length == 1 )
  {
    // set center of map
    map.setCenter( bounds.getCenter() );
    map.setZoom( 17 );
  }
  else
  {
    // fit to bounds
    map.fitBounds( bounds );
  }

}



