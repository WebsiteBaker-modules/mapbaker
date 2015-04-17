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
 * @version         $Id: save_settings.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

$admin_header = false;
// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

if (!$admin->checkFTAN())
{
        $admin->print_header();
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}
$admin->print_header();

// This code removes any php tags and adds slashes
$width = $admin->add_slashes(str_replace('?php', '', $_POST['width']));
$height = $admin->add_slashes(str_replace('?php', '', $_POST['height']));
$template_infowindow = $admin->add_slashes(str_replace('?php', '', $_POST['template_infowindow']));
$gmkey = $admin->add_slashes(str_replace('?php', '', $_POST['gmkey']));
$maptype = $admin->add_slashes(str_replace('?php', '', $_POST['maptype']));
$deflatitude = $admin->add_slashes(str_replace('?php', '', $_POST['deflatitude']));
$deflongitude = $admin->add_slashes(str_replace('?php', '', $_POST['deflongitude']));
$defzoom = $admin->add_slashes(str_replace('?php', '', $_POST['defzoom']));

if (isset($_POST['findbest']) AND $_POST['findbest'] == 1) {
	include('kram/fitmap.inc.php');
} 



// Update settings
$database->query("UPDATE ".TABLE_PREFIX."mod_map_settings SET "
        ." width = '$width', "
        ." height = '$height', "
        ." template_infowindow = '$template_infowindow', "
        ." gmkey = '$gmkey', "
        ." maptype = '$maptype', "
        ." deflatitude = '$deflatitude', "
        ." deflongitude = '$deflongitude', "
        ." defzoom = '$defzoom' "
        ." WHERE section_id = '$section_id'");

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
        $admin->print_error($database->get_error(), ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
} else {
        $admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>