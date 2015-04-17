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
 * @version         $Id: delete_marker.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

// Get id
if(!isset($_GET['marker_id']) OR !is_numeric($_GET['marker_id'])) {
        header("Location: ".ADMIN_URL."/pages/index.php");
} else {
        $marker_id = $_GET['marker_id'];
}

// Include WB admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
require(WB_PATH.'/modules/admin.php');

// Delete row
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_markers WHERE marker_id = '$marker_id' LIMIT 1");

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
        $admin->print_error($database->get_error(), ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
} else {
        $admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();





?>