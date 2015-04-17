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
 * @version         $Id: move_down.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

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

$backlink = ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id;

$marker_id = $admin->checkIDKEY('marker_id', false, 'GET');
$category_id = $admin->checkIDKEY('category_id', false, 'GET');
$geofeed_id = $admin->checkIDKEY('geofeed_id', false, 'GET');

if(!$marker_id) {
        if(!$category_id) {
                if(!$geofeed_id) {
                $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
                }
                 else {
                 $id = $geofeed_id;
                 $id_field = 'geofeed_id';
                 $table = TABLE_PREFIX.'mod_map_geofeeds';
                 }
                 }
        elseif(!$category_id) {
                $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
                }
                else {
                $id = $category_id;
                $id_field = 'cat_id';
                $table = TABLE_PREFIX.'mod_map_categories';
                }
               } else {
        $id = $marker_id;
        $id_field = 'marker_id';
        $table = TABLE_PREFIX.'mod_map_markers';
}



// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Include the ordering class
require(WB_PATH.'/framework/class.order.php');

// Create new order object an reorder
$order = new order($table, 'pos', $id_field, 'section_id');
if($order->move_down($id)) {
        $admin->print_success($TEXT['SUCCESS'], $backlink);
} else {
        $admin->print_error($TEXT['ERROR'], $backlink);
}

// Print admin footer
$admin->print_footer();

?>