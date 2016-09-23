<?php
/** no direct access **/
defined('_WPLEXEC') or die('Restricted access');

// Load Google Maps API
wpl_global::include_google_maps();
    
$map_activities = wpl_activity::get_activities('plisting_position1', 1);
?>
<script type="text/javascript">
var wpl_map<?php echo $this->activity_id; ?>;
var markers_array<?php echo $this->activity_id; ?> = new Array();
var loaded_markers<?php echo $this->activity_id; ?> = new Array();
var markers<?php echo $this->activity_id; ?>;
var bounds<?php echo $this->activity_id; ?>;
var infowindow<?php echo $this->activity_id; ?>;
var wpl_map_bounds_extend<?php echo $this->activity_id; ?> = true;
var wpl_map_set_default_geo_point<?php echo $this->activity_id; ?> = true;

if(typeof google_place_radius == 'undefined') var google_place_radius = 1100;

function wpl_initialize<?php echo $this->activity_id; ?>()
{
	/** create empty LatLngBounds object **/
	bounds<?php echo $this->activity_id; ?> = new google.maps.LatLngBounds();
	var mapOptions = {
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.<?php echo (isset($this->googlemap_view) ? $this->googlemap_view : 'ROADMAP'); ?>,
        <?php if(isset($this->overviewmap) and $this->overviewmap): ?>
        overviewMapControl: true,
        overviewMapControlOptions: {opened: true}
        <?php endif; ?>
	}
    
	/** init map **/
	wpl_map<?php echo $this->activity_id; ?> = new google.maps.Map(document.getElementById('wpl_map_canvas<?php echo $this->activity_id; ?>'), mapOptions);
	infowindow<?php echo $this->activity_id; ?> = new google.maps.InfoWindow();
	
	/** load markers **/
	wpl_load_markers<?php echo $this->activity_id; ?>(markers<?php echo $this->activity_id; ?>);
	
    <?php if(isset($this->googlemap_view) and $this->googlemap_view == 'WPL'): ?>
    var styles = [{"featureType": "water", "stylers": [{"color": "#46bcec"},{"visibility": "on"}]},{"featureType": "landscape","stylers": [{"color": "#f2f2f2"}]},{"featureType": "road","stylers": [{"saturation": -100},{"lightness": 45}]},{"featureType": "road.highway","stylers": [{"visibility": "simplified"}]},{"featureType": "administrative","elementType": "labels.text.fill","stylers": [{"color": "#444444"}]},{"featureType": "poi","stylers": [{"visibility": "off"}]}];
    var styledMap = new google.maps.StyledMapType(styles, {name: "WPL Map"});

    wpl_map<?php echo $this->activity_id; ?>.mapTypes.set('map_style', styledMap);
    wpl_map<?php echo $this->activity_id; ?>.setMapTypeId('map_style');
    <?php endif; ?>

    /* Check Google Places */
	if((typeof google_place != 'undefined') && (google_place == 1) && typeof marker != 'undefined')
	{
        var request = {
            location: marker.position,
            radius: google_place_radius
        };
  
		var service = new google.maps.places.PlacesService(wpl_map<?php echo $this->activity_id; ?>);
		service.search(request, wpl_gplace_callback<?php echo $this->activity_id; ?>);
	}
    
    if(typeof wpl_dmgfc_init != 'undefined')
    {
        var wpl_dmgfc_init_listener = google.maps.event.addListener(wpl_map<?php echo $this->activity_id; ?>, 'idle', function()
        {
            wpl_dmgfc_init();
            jQuery('.wpl_map_canvas').append('<div class="wpl_dmgfc_container"></div>');

            /** Remove listener **/
            google.maps.event.removeListener(wpl_dmgfc_init_listener);
        });
    }
    
    // Show get direction form
    wplj('.wpl-map-get-direction').removeClass('wpl-util-hidden');
}

function wpl_marker<?php echo $this->activity_id; ?>(dataMarker)
{
	if(wplj.inArray(dataMarker.id, loaded_markers<?php echo $this->activity_id; ?>) != '-1') return true;

	<?php if($this->map_property_preview): ?>
	wpl_preview_property_add_events<?php echo $this->activity_id; ?>(dataMarker);
	<?php else: ?>

  	marker = new google.maps.Marker({
		position: new google.maps.LatLng(dataMarker.googlemap_lt, dataMarker.googlemap_ln),
		map: <?php echo ($this->show_marker ? 'wpl_map'.$this->activity_id : 'null'); ?>,
		property_ids: dataMarker.pids,
		icon: '<?php echo wpl_global::get_wpl_url(); ?>assets/img/listing_types/gicon/'+dataMarker.gmap_icon,
		title: dataMarker.title,
	});
	
	/** extend the bounds to include each marker's position **/
  	if(wpl_map_bounds_extend<?php echo $this->activity_id; ?>) bounds<?php echo $this->activity_id; ?>.extend(marker.position);
  
	loaded_markers<?php echo $this->activity_id; ?>.push(dataMarker.id);
  	markers_array<?php echo $this->activity_id; ?>.push(marker);

	google.maps.event.addListener(marker, "<?php echo $this->infowindow_event; ?>", function(event)
	{
        /** Don't run APS AJAX search because of boundary change due to opening infowindow **/
        if(typeof wpl_aps_freeze != 'undefined') wpl_aps_freeze = true;

		if(this.html)
        {
            infowindow<?php echo $this->activity_id; ?>.close();
            infowindow<?php echo $this->activity_id; ?>.setContent(this.html);
            infowindow<?php echo $this->activity_id; ?>.open(wpl_map<?php echo $this->activity_id; ?>, this);
        }
        else
        {
            /** AJAX loader **/
            wplj("#wpl_map_canvas<?php echo $this->activity_id; ?>").append('<div class="map_search_ajax_loader"><img src="<?php echo wpl_global::get_wpl_asset_url('img/ajax-loader4.gif'); ?>" /></div>');

            infowindow_html = get_infowindow_html<?php echo $this->activity_id; ?>(this.property_ids);
            this.html = infowindow_html;
            infowindow<?php echo $this->activity_id; ?>.close();
            infowindow<?php echo $this->activity_id; ?>.setContent(infowindow_html);
            infowindow<?php echo $this->activity_id; ?>.open(wpl_map<?php echo $this->activity_id; ?>, this);

            /** AJAX loader **/
            wplj(".map_search_ajax_loader").remove();
        }
	});
	<?php endif; ?>
}

function wpl_load_markers<?php echo $this->activity_id; ?>(markers, delete_markers)
{
	if(delete_markers)
    {
        delete_markers<?php echo $this->activity_id; ?>();
        bounds<?php echo $this->activity_id; ?> = new google.maps.LatLngBounds();
    }
	
	for(var i = 0; i < markers.length; i++)
	{
		wpl_marker<?php echo $this->activity_id; ?>(markers[i]);
	}
    
	if(!markers.length && wpl_map_set_default_geo_point<?php echo $this->activity_id; ?>)
	{
		wpl_map<?php echo $this->activity_id; ?>.setCenter(new google.maps.LatLng(default_lt<?php echo $this->activity_id; ?>, default_ln<?php echo $this->activity_id; ?>));
		wpl_map<?php echo $this->activity_id; ?>.setZoom(parseInt(default_zoom<?php echo $this->activity_id; ?>));
	}
	else
	{
		/** now fit the map to the newly inclusive bounds **/
		if(wpl_map_bounds_extend<?php echo $this->activity_id; ?>) wpl_map<?php echo $this->activity_id; ?>.fitBounds(bounds<?php echo $this->activity_id; ?>);
	}
}

function get_infowindow_html<?php echo $this->activity_id; ?>(property_ids)
{
	var infowindow_html;

	<?php if($this->map_property_preview): ?>
	ajax_layout = '&tpl=infowindow_preview';
	<?php else: ?>
	ajax_layout = '&tpl=infowindow';
	<?php endif; ?>

	wplj.ajax(
	{
		url: '<?php echo wpl_global::get_full_url(); ?>',
		data: 'wpl_format=c:functions:ajax&wpl_function=infowindow&property_ids='+property_ids+'&wpltarget=<?php echo wpl_request::getVar('wpltarget', 0); ?>'+ajax_layout,
		type: 'GET',
		async: false,
		cache: false,
		timeout: 30000,
		success: function(data)
		{
			infowindow_html = data;
		}
	});
	
	return infowindow_html;
}

function delete_markers<?php echo $this->activity_id; ?>()
{
	if(markers_array<?php echo $this->activity_id; ?>)
	{
		for(i=0; i < markers_array<?php echo $this->activity_id; ?>.length; i++) markers_array<?php echo $this->activity_id; ?>[i].setMap(null);
		markers_array<?php echo $this->activity_id; ?>.length = 0;
	}
	
	if(loaded_markers<?php echo $this->activity_id; ?>) loaded_markers<?php echo $this->activity_id; ?>.length = 0;
}

/** Google places functions **/
function wpl_gplace_callback<?php echo $this->activity_id;?>(results, status)
{
	if(status == google.maps.places.PlacesServiceStatus.OK)
	{
		for(var i=0; i<results.length; i++) wpl_gplace_marker<?php echo $this->activity_id;?>(results[i]);
	}
}

function wpl_gplace_marker<?php echo $this->activity_id;?>(place)
{
	var placeLoc = place.geometry.location;
	var image = new google.maps.MarkerImage
    (
        place.icon,
        new google.maps.Size(51, 51),
        new google.maps.Point(0, 0),
        new google.maps.Point(17, 34),
        new google.maps.Size(25, 25)
    );

	// create place types title
	var title_str = '';
    
	for(var i=0; i<place.types.length; i++)
	{
		title_str = title_str+place.types[i];
		if((i+1) != place.types.length) title_str = title_str+', ';
	}
    
	var marker = new google.maps.Marker(
    {
		map: wpl_map<?php echo $this->activity_id; ?>,
		icon: image,
		title: title_str,
		position: place.geometry.location
	});
    
    /** extend the bounds to include each marker's position **/
  	bounds<?php echo $this->activity_id; ?>.extend(place.geometry.location);
    
	google.maps.event.addListener(marker, 'click', function()
	{
		infowindow<?php echo $this->activity_id; ?>.setContent('<div class="wpl_gplace_infowindow_container" style="color: #000000;">'+place.name+'</div>');
		infowindow<?php echo $this->activity_id; ?>.open(wpl_map<?php echo $this->activity_id; ?>, this);
	});
}

function wpl_load_map_markers(request_str, delete_markers)
{
    if(typeof delete_markers == 'undefined') delete_markers = false;
    
    /** AJAX loader **/
    wplj("#wpl_map_canvas<?php echo $this->activity_id; ?>").append('<div class="map_search_ajax_loader"><img src="<?php echo wpl_global::get_wpl_asset_url('img/ajax-loader4.gif'); ?>" /></div>');
    
    request_str = 'wpl_format=f:property_listing:raw&wplmethod=get_markers&'+request_str;
    var markers;
    
    wplj.ajax(
    {
        url: '<?php echo wpl_global::get_full_url(); ?>',
        data: request_str,
        type: 'GET',
        dataType: 'jSON',
        async: true,
        cache: false,
        timeout: 30000,
        success: function(data)
        {
            /** AJAX loader **/
            wplj(".map_search_ajax_loader").remove();
            
            /** Disable Map search **/
            if(typeof wpl_aps_freeze != 'undefined') wpl_aps_freeze = true;
            
            markers = data.markers;
            
            <?php foreach($map_activities as $activity): ?>
            wpl_load_markers<?php echo $activity->id; ?>(markers, delete_markers);
            <?php endforeach; ?>
        }
    });
}

<?php if($this->get_direction): ?>
function wpl_get_direction<?php echo $this->activity_id; ?>(lat, lng)
{
    var text_direction = <?php echo ($this->get_direction == 2 ? 'true' : 'false'); ?>;
    var from = wplj('#wpl_get_direction_addr<?php echo $this->activity_id; ?>').val();
    
    wpl_draw_direction<?php echo $this->activity_id; ?>(from, lat, lng, text_direction);
    
    // Show reset button
    wplj('.wpl-map-get-direction-reset').removeClass('wpl-util-hidden');
    
	return false;
}

var wpl_directionsDisplay;
var wpl_directionsService;

function wpl_draw_direction<?php echo $this->activity_id; ?>(from, lat, lng, text_direction)
{
	wplj("#wpl_map_canvas<?php echo $this->activity_id; ?>").fadeTo(300, .4);
	var dest = new google.maps.LatLng(lat ,lng);
    
	if(wpl_directionsDisplay != null)
	{ 
    	wpl_directionsDisplay.setMap(null);
		wpl_directionsDisplay.setPanel(null);
	}
    
	wpl_directionsDisplay = new google.maps.DirectionsRenderer();
 	wpl_directionsService = new google.maps.DirectionsService();
 
 	var request = {
   		origin:  from, 
   		destination: dest,
   		travelMode: google.maps.DirectionsTravelMode.DRIVING
 	};
 
 	wpl_directionsService.route(request, function(result, status)
    {
   		if(status == google.maps.DirectionsStatus.OK)
        {
    		wpl_directionsDisplay.setDirections(result);
     		wpl_directionsDisplay.setMap(wpl_map<?php echo $this->activity_id; ?>);
            
			if(text_direction) wpl_directionsDisplay.setPanel(document.getElementById("wpl_map_direction_text<?php echo $this->activity_id; ?>"));
   		}
        
        wplj("#wpl_map_canvas<?php echo $this->activity_id; ?>").fadeTo(300, 1);
 	});
}

function wpl_remove_direction<?php echo $this->activity_id; ?>()
{
    wplj('#wpl_get_direction_addr<?php echo $this->activity_id; ?>').val('');
    wplj('#wpl_get_direction_form<?php echo $this->activity_id; ?>').submit();
    
    // Hide reset button
    wplj('.wpl-map-get-direction-reset').addClass('wpl-util-hidden');
}
<?php endif; ?>
</script>