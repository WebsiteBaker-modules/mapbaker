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
 * @version         $Id: uninstall.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

// Must include code to stop this file being access directly
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

$database->query("DELETE FROM ".TABLE_PREFIX."search WHERE name = 'module' AND value = 'mapbaker'");
$database->query("DELETE FROM ".TABLE_PREFIX."search WHERE extra = 'mapbaker'");

$database->query("DROP TABLE ".TABLE_PREFIX."mod_map_settings");
$database->query("DROP TABLE ".TABLE_PREFIX."mod_map_categories");
$database->query("DROP TABLE ".TABLE_PREFIX."mod_map_markers");
$database->query("DROP TABLE ".TABLE_PREFIX."mod_map_geofeeds");
$database->query("DROP TABLE ".TABLE_PREFIX."mod_map_icons");

?>