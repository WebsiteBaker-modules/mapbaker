<?php 
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

//Query Settings:
$theq = "SELECT * FROM `".TABLE_PREFIX."mod_map_settings`" ;
if (isset($showsection) AND is_numeric($showsection)) {$theq .= " WHERE section_id='$showsection' "; }
$theq .= " LIMIT 1";
$query_settings = $database->query($theq);
if($query_settings->numRows() > 0) {
	$set = $query_settings->fetchRow();
	$template_infowindow = $admin->strip_slashes($fetch_settings['template_infowindow']); 
} else {
 	echo "no settings"; return 0; 
}


//Select categories. All, if no $showsection given:
$theq = "SELECT * FROM `".TABLE_PREFIX."mod_map_categories` WHERE active = 1" ;
if (isset($showsection) AND is_numeric($showsection)) {$theq .= " AND section_id='$showsection' "; }
$theq .= " ORDER BY section_id,pos ASC";
$query_cats = $database->query($theq);

if($query_cats->numRows() < 1) { echo "no map categories"; return 0; }

$mapoutput = '';
while($cat = $query_cats->fetchRow()) {	
	$icon_id = $admin->strip_slashes($cat['icon_id']);
	$icon_url = $admin->strip_slashes($cat['icon_url']);
	//$icon = $admin->strip_slashes($cat['icon']);
	$cat_name = $admin->strip_slashes($cat['cat_name']);

	//Select Markers in this category:
	$theq = "SELECT * FROM `".TABLE_PREFIX."mod_map_markers` WHERE active = '1' AND cat_id='".$cat['cat_id']."'";
	if (isset($showsection) AND is_numeric($showsection)) {$theq .= " AND section_id='$showsection'"; }
	$theq .= " ORDER BY pos ASC";
	$query_pins = $database->query($theq);
	if($query_pins->numRows() > 0) {
		$mapoutput .= '<div class="cat_block cat_block'.$cat['cat_id'].'"><h3 class="cat_name">'.$cat_name.'</h3>';		
	
	 	while($pin = $query_pins->fetchRow()) {
		
			//Now, we have everything we need:
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
			$mapoutput .= '<div class="map_item map_item'.$marker_id.'"><div class="map_item_inner">
			'.$processedDescription.'
			</div></div>';
			
			//$processedDescription = str_replace(array("\r\n","\n","\r","\t"),"",$processedDescription);
			//$processedDescription = str_replace(array("'"),"\'",$processedDescription);
		}
		$mapoutput .= '</div>';	
	}
}

if ($mapoutput != '') {
	echo '<div class="map_list_output">
	'.$mapoutput.'
	</div>';
}



?>