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
 * @version         $Id: save_marker.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

if(!isset($_POST['page_id']) || !is_numeric($_POST['page_id'])) {
        header("Location: index.php");
        exit(0);
} else {
        $page_id = intval($_POST['page_id']);
}

if(!isset($_POST['section_id']) || !is_numeric($_POST['section_id'])) {
        header("Location: index.php");
        exit(0);
} else {
        $section_id = intval($_POST['section_id']);
}

$backlink = ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id;

$admin_header = false;
// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

$marker_id = $admin->checkIDKEY('marker_id', false, 'POST');
// Get id
if(!$marker_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}


$admin->print_header();

// Include WB admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
require(WB_PATH.'/modules/admin.php');


// Validate all fields
if($marker_id == '' AND $admin->get_post('latitude') == '') {
        $admin->print_error($MESSAGE['GENERIC']['FILL_IN_ALL'], WB_URL.'/modules/mapbaker/modify_marker.php?page_id='.$page_id.'&section_id='.$section_id.'&marker_id='.$admin->getIDKEY($marker_id));
} else {
        $marker = htmlspecialchars($admin->add_slashes($admin->get_post('marker')));
        $category = $admin->add_slashes($admin->get_post('category'));
        $latitude = $admin->add_slashes($admin->get_post('latitude'));
        $longitude = $admin->add_slashes($admin->get_post('longitude'));
        $description = $admin->add_slashes($admin->get_post('description'));
        $active = $admin->add_slashes($admin->get_post('active'));
}

// Update row


$sql  = 'UPDATE `'.TABLE_PREFIX.'mod_map_markers` SET ';
$sql .=  '`marker` = \''.$marker.'\', ';
$sql .=  '`latitude` = \''.$latitude.'\', ';
$sql .=  '`longitude` = \''.$longitude.'\', ';
$sql .=  '`description` = \''.$description.'\', ';
$sql .=  '`cat_id` = \''.$category.'\', ';
$sql .=  '`active` = \''.$active.'\' ';
$sql .=  'WHERE `marker_id` = '.(int)$marker_id.' ';
$sql .= '';

$database->query($sql);


// Check if there is a db error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), WB_URL.'/modules/mapbaker/modify_marker.php?page_id='.$page_id.'&section_id='.$section_id.'&marker_id='.$admin->getIDKEY($marker_id));
} else {
	//Fix map size if wanted:
	if (isset($_POST['findbest']) AND $_POST['findbest'] == 1) {
		include('kram/fitmap.inc.php');
		// Update settings
		$database->query("UPDATE ".TABLE_PREFIX."mod_map_settings SET deflatitude = '$deflatitude', deflongitude = '$deflongitude', defzoom = '$defzoom' WHERE section_id = '$section_id'");   
	}
	$admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>