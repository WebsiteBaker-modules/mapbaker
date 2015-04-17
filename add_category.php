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
 * @version         $Id: add_category.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Include the ordering class
require(WB_PATH.'/framework/class.order.php');

// Get new order
$order = new order(TABLE_PREFIX.'mod_map_categories', 'pos', 'category_id', 'section_id');
$position = $order->get_new($section_id);

// Insert new row into database
$database->query("INSERT INTO ".TABLE_PREFIX."mod_map_categories (section_id,page_id,cat_id,cat_name,pos) VALUES ('$section_id','$page_id','0','',$position)");

// Get the id
$category_id = $database->get_one("SELECT LAST_INSERT_ID()");

// Say that a new record has been added, then redirect to modify page
if($database->is_error()) {
        $admin->print_error($database->get_error(), WB_URL.'/modules/mapbaker/modify_category.php?page_id='.$page_id.'&section_id='.$section_id.'&category_id='.$admin->getIDKEY($category_id));
} else {
        $admin->print_success($TEXT['SUCCESS'], WB_URL.'/modules/mapbaker/modify_category.php?page_id='.$page_id.'&section_id='.$section_id.'&category_id='.$admin->getIDKEY($category_id));
}

// Print admin footer
$admin->print_footer();

?>