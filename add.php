<?php

/*

 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2007, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

// Must include code to stop this file being access directly
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }




// These are the default setting
$template_infowindow = '<h2>{NAME}</h2>
{DESCRIPTION}
<small><b>Latitude: </b>{LATITUDE}</small><br/>
<small><b>Longitude: </b>{LONGITUDE}</small>
';

//Copy latest settings:
$addstring = '';
$query = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_map_settings ORDER BY section_id DESC LIMIT 1");
if($query->numRows() == 1) {
	$sets = $query->fetchRow();	
	foreach ($sets as $key => $value) {
		if (is_numeric($key)) {continue;}
		if ($key == 'section_id' OR $key == 'page_id')  {continue;}
		if ($value == '') {continue;}		
		$addstring .= ', '.$key."='".addslashes($value)."'";
	}	
	$theq = "INSERT INTO ".TABLE_PREFIX."mod_map_settings SET ";
	$theq .= "section_id='".$section_id."', page_id='".$page_id."' ". $addstring;
} else {
	$theq = "INSERT INTO ".TABLE_PREFIX."mod_map_settings (section_id,page_id,template_infowindow) VALUES ('$section_id', '$page_id', '$template_infowindow')";

}
$database->query($theq);

// Insert new cat_id into database
$database->query("INSERT INTO ".TABLE_PREFIX."mod_map_categories (section_id,page_id,cat_id,cat_name,pos) VALUES ('$section_id','$page_id','0','Standard','1')");


?>