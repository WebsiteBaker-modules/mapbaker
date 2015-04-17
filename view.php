<?php

/**
 *
 * @category        modules
 * @package         mapbaker
 * @author          WebsiteBaker Project
 * @copyright       2004-2009, Ryan Djurovich
 * @copyright       2009-2011, Website Baker Org. e.V.
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/gpl.html
 * @platform        WebsiteBaker 2.8.3 and up
 * @requirements    PHP 5.3.2 and higher
 * @version         $Id: view.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

// Must include code to stop this file being access directly
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

$iconSizeW = 24; 
$iconSizeH = 24; 




// Get settings
$query_settings = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_settings` WHERE section_id='$section_id' LIMIT 1");
$fetch_settings = $query_settings->fetchRow();

// gmaps configuration settings
$gmkey = $admin->strip_slashes($fetch_settings['gmkey']);
$maptype = $admin->strip_slashes($fetch_settings['maptype']);
$deflatitude = $admin->strip_slashes($fetch_settings['deflatitude']);
$deflongitude = $admin->strip_slashes($fetch_settings['deflongitude']);
$defzoom = $admin->strip_slashes($fetch_settings['defzoom']);
$template_infowindow = $admin->strip_slashes($fetch_settings['template_infowindow']);
$mapwidth = $admin->strip_slashes($fetch_settings['width']);
$mapheight = $admin->strip_slashes($fetch_settings['height']);

//build template
echo '<noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b>
      However, it seems JavaScript is either disabled or not supported by your browser.
      To view Google Maps, enable JavaScript by changing your browser options, and then
      try again.
</noscript>';

echo '<script type="text/javascript" src="http://www.google.com/jsapi?key='.$gmkey.'"></script>
<script type="text/javascript">
    //<![CDATA[

        var map;
        google.load("maps", "2");

        function buildIcon(width,iconUrl,shdUrl){
            var ico = new GIcon(G_DEFAULT_ICON);
            ico.image = iconUrl;
            ico.shadow = shdUrl;
                var iconSize =  buildGSize(width,iconUrl);
//            ico.iconSize = iconSize;
            ico.iconSize =   new GSize('.$iconSizeW.','.$iconSizeH.');
            ico.shadowSize = buildGSize(width,shdUrl);
                ico.iconAnchor = new GPoint(iconSize.width/2, iconSize.height/2);
            ico.infoWindowAnchor = new GPoint(iconSize.width/2, iconSize.height/2);
                return ico;
        }

        function buildGSize(width,iconUrl){
                var img = new Image();
                img.src = iconUrl;
                var imgWidth = img.naturalWidth || img.width;
                var imgHeight = img.naturalHeight || img.height;
                img.width = width;
                img.height = parseInt(imgHeight*width/imgWidth);
                var size = new GSize(img.width,img.height);
                return size;
        }

        function createMarker(lat,lng,desc,ico) {
                var latlng = new GLatLng(lat,lng);
                var marker = new GMarker(latlng,{icon:ico});
                marker.value = desc;
                GEvent.addListener(marker,"click", function() {
                        var myHtml = desc;
                        map.openInfoWindowHtml(latlng, myHtml);
                });
                return marker;
        }

        function initialize()
        {
                map = new google.maps.Map2(document.getElementById("map'.$section_id.'"));
                map.addControl(new GSmallMapControl());
                map.addControl(new GMapTypeControl());
                map.setMapType('.$maptype.');
                map.setCenter(new google.maps.LatLng('.$deflatitude.', '.$deflongitude.'), '.$defzoom.');
                map.enableScrollWheelZoom();

                ';

                // Add geofeeds
                $query_feeds = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_geofeeds` WHERE section_id='".$section_id."' ORDER BY pos ASC");
                if($query_feeds->numRows() > 0)
                {
                        $feedcount = 0;
                        while($feed = $query_feeds->fetchRow())
                        {
                                $url=$admin->strip_slashes($feed['url']);
                                $active=$admin->strip_slashes($feed['active']);
                                if ($active == '1')
                                {
                                        echo '
                var g'.$feedcount.' = new GGeoXml("'.$url.'");
                map.addOverlay(g'.$feedcount.');
                                        ';
                                }
                                $feedcount++;
                        }
                }

                // Add markers
                $query_cats = $database->query("SELECT "
                ." ".TABLE_PREFIX."mod_map_categories.section_id, "
                ." ".TABLE_PREFIX."mod_map_categories.page_id, "
                ." ".TABLE_PREFIX."mod_map_categories.cat_id, "
                ." ".TABLE_PREFIX."mod_map_categories.cat_name, "
                ." ".TABLE_PREFIX."mod_map_categories.icon_id, "
                ." ".TABLE_PREFIX."mod_map_categories.icon_url, "
                ." ".TABLE_PREFIX."mod_map_categories.active, "
                ." ".TABLE_PREFIX."mod_map_categories.pos, "
                ." ".TABLE_PREFIX."mod_map_icons.icon, "
                ." ".TABLE_PREFIX."mod_map_icons.shaddow "
                ." FROM ".TABLE_PREFIX."mod_map_categories "
                ." LEFT JOIN ".TABLE_PREFIX."mod_map_icons "
                ." ON ".TABLE_PREFIX."mod_map_categories.icon_id=".TABLE_PREFIX."mod_map_icons.icon_id "
                ." ORDER BY ".TABLE_PREFIX."mod_map_categories.pos ASC");

                if($query_cats->numRows() > 0)
                {
                        while($cat = $query_cats->fetchRow())
                        {
                                $activeCat=$admin->strip_slashes($cat['active']);
                                if($activeCat==1)
                                {

                                switch($cat['icon_id'])
                                {
                                case 'default':
                                                echo '
                var cat'.$cat['cat_id'].'Icon = new GIcon(G_DEFAULT_ICON);
';
                                  break;
                                case 'custom':
                                                echo '
                var cat'.$cat['cat_id'].'Icon = buildIcon(20,\''.$cat['icon_url'].'\',\'http://maps.google.com/mapfiles/kml/pal2/icon0s.png\');
';
                                  break;
                                default:
                                                echo '
                var cat'.$cat['cat_id'].'Icon = buildIcon(20,\''.$cat['icon'].'\',\''.$cat['shaddow'].'\');
';
                                }

                                        $query_pins = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_markers` WHERE cat_id='".$cat['cat_id']."' and section_id='".$section_id."' ORDER BY pos ASC");
                                        if($query_pins->numRows() > 0)
                                        {
                                                while($pin = $query_pins->fetchRow())
                                                {
                                                        $active=$admin->strip_slashes($pin['active']);

                                                        if($active=='1')
                                                        {
                                                                $marker=$admin->strip_slashes($pin['marker']);
                                                                $latitude=$admin->strip_slashes($pin['latitude']);
                                                                $longitude=$admin->strip_slashes($pin['longitude']);
                                                                $description=$admin->strip_slashes($pin['description']);
                                                                $marker_id=$admin->strip_slashes($pin['marker_id']);

                                                                //template
                                                                $replace_pattern = array('{NAME}' => $marker, '{DESCRIPTION}'  => $description, '{LATITUDE}'  => $latitude, '{LONGITUDE}'  => $longitude);
                                                                $processedDescription = strtr($template_infowindow, $replace_pattern);

                                                                // Replace wb_link with real links
                                                                $wb->preprocess($processedDescription);

                                                                $processedDescription = str_replace(array("\r\n","\n","\r","\t"),"",$processedDescription);
                                                                $processedDescription = str_replace(array("'"),"\'",$processedDescription);


                                                                echo '
                var marker'.$marker_id.' = createMarker('.$latitude.','.$longitude.',\''.$processedDescription.'\',cat'.$cat['cat_id'].'Icon);
                map.addOverlay(marker'.$marker_id.');
';
                                                        }
                                                }
                                        }
                                }
                        }
                }

                //highlight marker by querystring marker_id
                if(isset($_GET["marker_id"]) AND is_numeric($_GET["marker_id"]))
                {
                        $marker_id = $_GET['marker_id'];
                        echo '
                        if(typeof(marker'.$marker_id .')!="undefined")
                                GEvent.trigger(marker'.$marker_id .', "click");
                        ';
                }

                echo'
      }
      google.setOnLoadCallback(initialize);

    //]]>
    </script>
        ';

// Add a top anchor
echo '<a name="top"></a>';
// map div
echo '<div id="map'.$section_id.'" style="width: 100%; max-width:'.$mapwidth.'px; height: '.$mapheight.'px; border: 1px solid #000000;"></div>';


?>