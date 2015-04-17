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
 * @version         $Id: delete_geofeed.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');


if(!isset($_GET['page_id']) || !is_numeric($_GET['page_id'])) {
        header("Location: index.php");
        exit(0);
} else {
        $page_id = intval($_GET['page_id']);
}



$backlink = ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id;

$admin_header = false;
// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Get id
$geofeed_id = $admin->checkIDKEY('geofeed_id', false, 'GET');
// Get id
if(!$geofeed_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}

$admin->print_header();
// Delete row
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_geofeeds WHERE geofeed_id = '$geofeed_id' LIMIT 1");

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
        $admin->print_error($database->get_error(), ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
} else {
        $admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer

$admin->print_footer();

?>