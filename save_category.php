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
 * @version         $Id: save_category.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

/*
Array ( [section_id] => 219 [page_id] => 179 [category_id] => 5 [a3a5a81d81a51895] => b6d484f62ce53a5a [cat_name] => Kategorie 3 [icon_id] => default [icon_url] => [active] => 1 [save] => Speichern )*/

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
        $category_id = intval($_POST['category_id']);
}

$backlink = ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id;

$admin_header = false;
// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

$category_id = $admin->checkIDKEY('category_id', false, 'POST');
// Get id
if(!$category_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}

$admin->print_header(); 

// Validate all fields
if($admin->get_post('cat_name') == '' AND $admin->get_post('icon_id') == '') {
        $admin->print_error($MESSAGE['GENERIC']['FILL_IN_ALL'], WB_URL.'/modules/mapbaker/modify_category.php?page_id='.$page_id.'&section_id='.$section_id.'&category_id='.$admin->getIDKEY($category_id));
} else {

$cat_name = $admin->add_slashes(str_replace('?php', '', $_POST['cat_name']));
$icon_id = $admin->add_slashes(str_replace('?php', '', $_POST['icon_id']));
$icon_url = $admin->add_slashes(str_replace('?php', '', $_POST['icon_url']));
$active = $admin->add_slashes(str_replace('?php', '', $_POST['active']));
}

// Update row

$sql  = 'UPDATE `'.TABLE_PREFIX.'mod_map_categories` SET ';
$sql .=  '`cat_name` = \''.$cat_name.'\', ';
$sql .=  '`icon_id` = \''.$icon_id.'\', ';
$sql .=  '`icon_url` = \''.$icon_url.'\', ';
$sql .=  '`active` = \''.$active.'\' ';
$sql .=  'WHERE `cat_id` = '.$category_id.' ';
$sql .= '';

$database->query($sql);

// Check if there is a db error, otherwise say successful
if($database->is_error()) {
        $admin->print_error($database->get_error(), WB_URL.'/modules/mapbaker/modify_category.php?page_id='.$page_id.'&section_id='.$section_id.'&category_id='.$admin->getIDKEY($category_id));
} else {
        $admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>