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
 * @version         $Id: modify_marker.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

$backlink = ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id;


if(!isset($_GET['page_id']) || !is_numeric($_GET['page_id'])) {
        header("Location: index.php");
        exit(0);
} else {
        $page_id = intval($_GET['page_id']);
}

if(!isset($_GET['section_id']) || !is_numeric($_GET['section_id'])) {
        header("Location: index.php");
        exit(0);
} else {
        $section_id = intval($_GET['section_id']);
}

$marker_id = $admin->checkIDKEY('marker_id', false, 'GET');
// Get id
if(!$marker_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}
        $marker = (isset($_GET['marker']) ? intval($_GET['marker']) : '');
        $latitude = (isset($_GET['latitude']) ? intval($_GET['latitude']) : '');
        $longitude = (isset($_GET['longitude']) ? intval($_GET['longitude']) : '');
        $description = (isset($_GET['description']) ? intval($_GET['description']) : '');





// Load Language file
if(LANGUAGE_LOADED) {
    require_once(WB_PATH.'/modules/mapbaker/languages/EN.php');
    if(file_exists(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php')) {
        require_once(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php');
    }
}

// Get info on marker
$query_marker = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_map_markers WHERE marker_id='$marker_id' AND section_id='$section_id' ");
$fetch_marker = $query_marker->fetchRow();

$latitude = $admin->strip_slashes($fetch_marker['latitude']);
$longitude= $admin->strip_slashes($fetch_marker['longitude']);
$active= $admin->strip_slashes($fetch_marker['active']);

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

//

if(intval($latitude)==0 && intval($longitude)==0) {
	//$latitude = $deflatitude;
	//$longitude = $deflongitude;
}


?>

<form name="modify" action="<?php echo WB_URL; ?>/modules/mapbaker/save_marker.php" method="post" style="margin: 0;">
<table class="mapbaker" cellpadding="0" cellspacing="0" border="0" align="center" width="100%" >
<tr><td style="width:470px">

<?php if(intval($latitude)==0 && intval($longitude)==0) {
	echo '<iframe src="kram/geopos.php?lat='.$latitude.'&amp;lon='.$longitude.'" width="460" height="470" frameborder="0" marginheight="0" marginwidth="0" name="geopos"></iframe>';
} else {

 echo '<div id="map" style="width: 460px; height: 400px; border: 1px solid #000000;"></div>'; 

//build template
echo '<script type="text/javascript" src="http://www.google.com/jsapi?key='.$gmkey.'"></script>';
echo '<script type="text/javascript">

                function updateMarker()
                {
                        map.clearOverlays();
                        var lat = document.getElementById("latitude").value;
                        var lng = document.getElementById("longitude").value;
                        var point = new GLatLng(lat,lng);
                        marker = new GMarker(point);
                        map.addOverlay(marker);
                }

          var map;
          var marker;
          google.load("maps", "2");
      // Call this function when the page has been loaded


                function initialize() {
                        map = new google.maps.Map2(document.getElementById("map"));

                        map.addControl(new GSmallMapControl());
                        map.addControl(new GMapTypeControl());

                        map.setMapType('.$maptype.');

                        map.setCenter(new google.maps.LatLng('.$latitude.', '.$longitude.'), '.$defzoom.');
                        map.enableScrollWheelZoom();
                        var point = new GLatLng('.$latitude.', '.$longitude.');
                        marker = new GMarker(point);
                        map.addOverlay(marker);

                        GEvent.addListener(map,"click", function(marker, latlng) {
                                if (latlng) {
                                        map.clearOverlays();

                                        document.getElementById("latitude").value = latlng.lat();
                                        document.getElementById("longitude").value = latlng.lng();

                                        marker = new GMarker(latlng);
                                        map.addOverlay(marker);
                                }
                        });
                }
      google.setOnLoadCallback(initialize);
    </script>';



}?>
</td>
<td>
<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
<input type="hidden" name="marker_id" value="<?php echo $admin->getIDKEY($marker_id); ?>">

<p>
<label for="category" accesskey="c"><?php echo $MBTEXT['CATEGORY']; ?>:</label><br />
<select name="category" id="category" style="width: 98%;">
<?php
// Get categories
$query_categories = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_map_categories WHERE section_id='".$section_id."' ORDER BY pos ASC");
if($query_categories->numRows() > 0){
	while( $fetch_categories = $query_categories->fetchRow() ) {
		if($fetch_categories['cat_id'] == $fetch_marker['cat_id']){ $selected = "selected"; } else { $selected = ""; }
		echo '<option value="'.$fetch_categories['cat_id'].'" '.$selected.'>'.$admin->strip_slashes($fetch_categories['cat_name']).'</option>';
	}
}
?>
</select>      
</p>
<p><label for="marker" accesskey="q"><?php echo $MBTEXT['MARKER_NAME']; ?>:</label><br />
<input type="text" name="marker" id="marker" value="<?php echo $admin->strip_slashes($fetch_marker['marker']); ?>" style="width: 98%;" maxlength="255" />
</p>
<p><label for="cat_name" accesskey="n"><?php echo $MBTEXT['ACTIVE']; ?>:</label><br />
<input type="radio" value="1" name="active" <?php if ($active == '1') { echo "checked"; } ?>><?php echo $TEXT['YES'];?>
<input type="radio" value="0" name="active" <?php if ($active == '0') { echo "checked"; } ?>><?php echo $TEXT['NO'];?>
</p>
		
<p><label for="latitude" accesskey="q"><?php echo $MBTEXT['LATITUDE']; ?>:</label><br />
<input type="text" name="latitude" id="latitude" value="<?php echo $latitude; ?>" style="width: 98%;" maxlength="20" onBlur="updateMarker();" />
</p>

<p><label for="longitude" accesskey="q"><?php echo $MBTEXT['LONGITUDE']; ?>:</label>
<input type="text" name="longitude" id="longitude" value="<?php echo $longitude; ?>" style="width: 98%;" maxlength="20" onBlur="updateMarker();" />


</td></tr></table>
<label for="description" accesskey="q"><?php echo $MBTEXT['DESCRIPTION']; ?>:</label><br />

<?php
$content = $fetch_marker['description'];
$name="description";

if(!isset($wysiwyg_editor_loaded)) {
        $wysiwyg_editor_loaded=true;

        if (!defined('WYSIWYG_EDITOR') OR WYSIWYG_EDITOR=="none" OR !file_exists(WB_PATH.'/modules/'.WYSIWYG_EDITOR.'/include.php')) {
                function show_wysiwyg_editor($name,$id,$content,$width,$height) {
                        echo '<textarea name="'.$name.'" id="'.$id.'" style="width: '.$width.'; height: '.$height.';">'.$content.'</textarea>';
                }
        } else {
                $id_list=array();
                $query_wysiwyg = $database->query("SELECT section_id FROM ".TABLE_PREFIX."sections WHERE page_id = '$page_id' AND module = 'mapbaker'");
                if($query_wysiwyg->numRows() > 0) {
                        while($wysiwyg_section = $query_wysiwyg->fetchRow()) {
                                $entry='content'.$wysiwyg_section['section_id'];
                                array_push($id_list,$entry);
                        }
                        require(WB_PATH.'/modules/'.WYSIWYG_EDITOR.'/include.php');
                }
        }
}

show_wysiwyg_editor('description','content'.$section_id,htmlspecialchars($content),'100%','350px');

?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
        <td align="left">
                <input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;">  <input type="checkbox" checked="checked" name="findbest" id="findbest" value="1"><?php echo $MBTEXT['FITMAP']; ?></form></form>
        </td>
        <td align="right">
                <input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/modify.php?page_id=<?php echo $page_id; ?>';" style="width: 100px; margin-top: 5px;" />
        </td>
</tr>
</table>



<?php

// Print admin footer
$admin->print_footer();

?>