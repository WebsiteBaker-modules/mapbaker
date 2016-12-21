<?php 
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

//find best values
$query_pins = $database->query("SELECT latitude, longitude, active FROM `".TABLE_PREFIX."mod_map_markers` WHERE active = 1 AND section_id='$section_id'");
if($query_pins->numRows() > 0) {
	$minlat = 10000.0; $maxlat = -10000.0;
	$minlon = 10000.0; $maxlon = -10000.0;
	while($pin = $query_pins->fetchRow()) {
		$lat = floatval($pin['latitude']); 
		if ($lat > $maxlat) {$maxlat = $lat;}
		if ($lat < $minlat) {$minlat = $lat;}
		
		$lon = floatval($pin['longitude']);
		if ($lon > $maxlon) {$maxlon = $lon;}
		if ($lon < $minlon) {$minlon = $lon;}
	}
	$deflatitude = 0.5 * ($minlat + $maxlat);
	$deflongitude = 0.5 * ($minlon + $maxlon);
	
	$slat = $maxlat -  $minlat;
	$slon = $maxlon -  $minlon;
	
	//Hmm - stimmt das so?
	$z = 1;
	$grad = 380.0;
	while($z < 16) {
		$grad = 0.5* $grad;
		if (0.9*$grad < $slon) break; //Breite: eigentlich: 1.0* , aber 0.9, damit es nicht zu knapp wird
		if (0.3*$grad < $slat) break; //Höhe: eigentlich: 0.5* , aber 0.3, damit es nicht zu knapp wird
		$z++;
	}
	$defzoom = $z;
	
}	
?>