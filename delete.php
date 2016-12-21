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
 * @version         $Id: delete.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

// Delete section from database
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_settings WHERE section_id = '$section_id'");
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_categories WHERE section_id = '$section_id'");
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_markers WHERE section_id = '$section_id'");
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_geofeeds WHERE section_id = '$section_id'");

?>