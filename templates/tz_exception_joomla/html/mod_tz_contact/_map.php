<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 10/20/14
 * Time: 2:38 PM
 */
defined('_JEXEC') or die;
?>
<div class="cell-6 padd-top-50">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <div id="map_canvas"
         style="height: <?php echo $params->get('height_map') ?>; width: <?php echo $params->get('width_map') ?>;">
        <script type="text/javascript">
            function init_map() {
                var myOptions = {zoom: 14, center: new google.maps.LatLng(<?php echo $params->get('lat_map')?>, <?php echo $params->get('long_map')?>),
                    mapTypeId: google.maps.MapTypeId.ROADMAP};
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(<?php echo $params->get('lat_map')?>, <?php echo $params->get('long_map')?>)});
                infowindow = new google.maps.InfoWindow({content: "<div class='noScroll'><?php echo $params->get('title_map')?><?php echo $params->get('add_map');?></div>" });
                google.maps.event.addListener(marker, "click", function () {
                    infowindow.open(map, marker);
                });
                infowindow.open(map, marker);
            }
            google.maps.event.addDomListener(window, 'load', init_map);
        </script>
    </div>
</div>