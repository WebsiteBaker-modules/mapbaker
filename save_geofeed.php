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
 * @version         $Id: save_geofeed.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
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
// Get id
$geofeed_id = $admin->checkIDKEY('geofeed_id', false, 'POST');
// Get id
if(!$geofeed_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}


$admin->print_header();

// Validate all fields
if($admin->get_post('geofeed') == '' AND $admin->get_post('url') == '') {
        $admin->print_error($MESSAGE['GENERIC']['FILL_IN_ALL'], WB_URL.'/modules/mapbaker/modify_geofeed.php?page_id='.$page_id.'&section_id='.$section_id.'&geofeed_id='.$geofeed_id);
} else {
        $geofeed = htmlspecialchars($admin->add_slashes($admin->get_post('geofeed')));
        $url = htmlspecialchars($admin->add_slashes($admin->get_post('url')));
        $active = htmlspecialchars($admin->add_slashes($admin->get_post('active')));
}

// Update row
$database->query("UPDATE ".TABLE_PREFIX."mod_map_geofeeds SET geofeed='$geofeed', url='$url',active='$active' WHERE geofeed_id='$geofeed_id'");

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
        $admin->print_error($database->get_error(), WB_URL.'/modules/mapbaker/modify_geofeed.php?page_id='.$page_id.'&section_id='.$section_id.'&geofeed_id='.$geofeed_id);
} else {
        $admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>