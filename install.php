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
 * @version         $Id: install.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

if(defined('WB_URL')) {

        $database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_map_categories`");
        $mod_map_categories = 'CREATE TABLE `'.TABLE_PREFIX.'mod_map_categories` ( '
                  . '`section_id` INT(10) NOT NULL DEFAULT \'0\','
                . '`page_id` INT NOT NULL DEFAULT \'0\' ,'
                . '`cat_id` INT(10) NOT NULL AUTO_INCREMENT,'
                . '`cat_name` VARCHAR(255) NOT NULL DEFAULT \'\','
                . '`icon_id` varchar(30) NOT NULL default \'default\', '
                . '`icon_url` varchar(255) NOT NULL default \'\', '
                . '`active` INT(1) NOT NULL DEFAULT \'1\','
                . '`pos` INT(10) NOT NULL DEFAULT \'0\','
                . 'PRIMARY KEY  (cat_id)'
                . ')';
        $database->query($mod_map_categories);

        $database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_map_markers`");
        $mod_map_markers = 'CREATE TABLE `'.TABLE_PREFIX.'mod_map_markers` ( '
                . '`section_id` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . '`page_id` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . '`marker_id` INT( 10 ) NOT NULL auto_increment,'
                . '`cat_id` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . '`marker` VARCHAR( 255 ) NOT NULL , '
                . '`latitude` DECIMAL( 18, 15 ) NOT NULL DEFAULT \'0\', '
                . '`longitude` DECIMAL( 18, 15 ) NOT NULL DEFAULT \'0\', '
                . '`icon_id` varchar(30) NOT NULL default \'\', '
                . '`description` TEXT NULL , '
                . '`active` INT(1) NOT NULL DEFAULT \'1\','
                . '`pos` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . 'PRIMARY KEY ( `marker_id` ) '
                . ')';
        $database->query($mod_map_markers);

        $database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_map_geofeeds`");
        $mod_map_geofeeds = 'CREATE TABLE `'.TABLE_PREFIX.'mod_map_geofeeds` ( '
                . '`section_id` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . '`page_id` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . '`geofeed_id` INT( 10 ) NOT NULL auto_increment,'
                . '`geofeed` VARCHAR( 255 ) NOT NULL , '
                . '`url` VARCHAR( 255 ) NOT NULL , '
                . '`active` INT(1) NOT NULL DEFAULT \'1\','
                . '`pos` INT( 10 ) NOT NULL DEFAULT \'0\', '
                . 'PRIMARY KEY ( `geofeed_id` ) '
                . ')';
        $database->query($mod_map_geofeeds);


        $database->query("DROP TABLE IF EXISTS `".TABLE_PREFIX."mod_map_settings`");
        $mod_map_settings = 'CREATE TABLE `'.TABLE_PREFIX.'mod_map_settings` ( '
                . '`section_id` INT(10) NOT NULL DEFAULT \'0\','
                . '`page_id` INT(10) NOT NULL DEFAULT \'0\' ,'
                . '`width` INT(4) NOT NULL DEFAULT \'500\','
                . '`height` INT(4) NOT NULL DEFAULT \'500\','
                . '`template_infowindow` TEXT NOT NULL,'
                . '`gmkey` VARCHAR(255) NOT NULL DEFAULT \'\','
                . '`maptype` VARCHAR(255) NOT NULL DEFAULT \'G_NORMAL_MAP\','
                . '`deflatitude` DECIMAL(18,15) NOT NULL DEFAULT \'52.4760\','
                . '`deflongitude` DECIMAL(18,15) NOT NULL DEFAULT \'13.4333\','
                . '`defzoom` VARCHAR(255) NOT NULL DEFAULT \'5\','
                . 'PRIMARY KEY (section_id)'
                . ')';
        $database->query($mod_map_settings);


        $database->query("DROP TABLE IF EXISTS`".TABLE_PREFIX."mod_map_icons`");
        $mod_map_icons = 'CREATE TABLE `'.TABLE_PREFIX.'mod_map_icons` ( '
                . '`icon_id` varchar(30) NOT NULL default \'\','
                . '`icon` varchar(100) NOT NULL default \'\','
                . '`shaddow` varchar(100) NOT NULL default \'\','
                . 'UNIQUE KEY `icon_id` (`icon_id`)'
                . ')';
        $database->query($mod_map_icons);

$icons = array();
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('default', 'https://maps.google.com/mapfiles/marker.png', 'https://maps.google.com/mapfiles/kml/pal2/icon0s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-0', 'https://maps.google.com/mapfiles/kml/pal2/icon0.png', 'https://maps.google.com/mapfiles/kml/pal2/icon0s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-1', 'https://maps.google.com/mapfiles/kml/pal2/icon1.png', 'https://maps.google.com/mapfiles/kml/pal2/icon1s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-2', 'https://maps.google.com/mapfiles/kml/pal2/icon2.png', 'https://maps.google.com/mapfiles/kml/pal2/icon2s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-3', 'https://maps.google.com/mapfiles/kml/pal2/icon3.png', 'https://maps.google.com/mapfiles/kml/pal2/icon3s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-4', 'https://maps.google.com/mapfiles/kml/pal2/icon4.png', 'https://maps.google.com/mapfiles/kml/pal2/icon4s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-5', 'https://maps.google.com/mapfiles/kml/pal2/icon5.png', 'https://maps.google.com/mapfiles/kml/pal2/icon5s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-6', 'https://maps.google.com/mapfiles/kml/pal2/icon6.png', 'https://maps.google.com/mapfiles/kml/pal2/icon6s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-7', 'https://maps.google.com/mapfiles/kml/pal2/icon7.png', 'https://maps.google.com/mapfiles/kml/pal2/icon7s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-8', 'https://maps.google.com/mapfiles/kml/pal2/icon8.png', 'https://maps.google.com/mapfiles/kml/pal2/icon8s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-9', 'https://maps.google.com/mapfiles/kml/pal2/icon9.png', 'https://maps.google.com/mapfiles/kml/pal2/icon9s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-10', 'https://maps.google.com/mapfiles/kml/pal2/icon10.png', 'https://maps.google.com/mapfiles/kml/pal2/icon10s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('church', 'https://maps.google.com/mapfiles/kml/pal2/icon11.png', 'https://maps.google.com/mapfiles/kml/pal2/icon11s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('park', 'https://maps.google.com/mapfiles/kml/pal2/icon12.png', 'https://maps.google.com/mapfiles/kml/pal2/icon12s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('golfCourse', 'https://maps.google.com/mapfiles/kml/pal2/icon13.png', 'https://maps.google.com/mapfiles/kml/pal2/icon13s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-16', 'https://maps.google.com/mapfiles/kml/pal2/icon16.png', 'https://maps.google.com/mapfiles/kml/pal2/icon16s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-17', 'https://maps.google.com/mapfiles/kml/pal2/icon17.png', 'https://maps.google.com/mapfiles/kml/pal2/icon17s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-18', 'https://maps.google.com/mapfiles/kml/pal2/icon18.png', 'https://maps.google.com/mapfiles/kml/pal2/icon18s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-19', 'https://maps.google.com/mapfiles/kml/pal2/icon19.png', 'https://maps.google.com/mapfiles/kml/pal2/icon19s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-20', 'https://maps.google.com/mapfiles/kml/pal2/icon20.png', 'https://maps.google.com/mapfiles/kml/pal2/icon20s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-21', 'https://maps.google.com/mapfiles/kml/pal2/icon21.png', 'https://maps.google.com/mapfiles/kml/pal2/icon21s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-22', 'https://maps.google.com/mapfiles/kml/pal2/icon22.png', 'https://maps.google.com/mapfiles/kml/pal2/icon22s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-23', 'https://maps.google.com/mapfiles/kml/pal2/icon23.png', 'https://maps.google.com/mapfiles/kml/pal2/icon23s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('martini', 'https://maps.google.com/mapfiles/kml/pal2/icon27.png', 'https://maps.google.com/mapfiles/kml/pal2/icon27s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('bed', 'https://maps.google.com/mapfiles/kml/pal2/icon28.png', 'https://maps.google.com/mapfiles/kml/pal2/icon28s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('gas', 'https://maps.google.com/mapfiles/kml/pal2/icon29.png', 'https://maps.google.com/mapfiles/kml/pal2/icon29s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('film', 'https://maps.google.com/mapfiles/kml/pal2/icon30.png', 'https://maps.google.com/mapfiles/kml/pal2/icon30s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('newspaper', 'https://maps.google.com/mapfiles/kml/pal2/icon31.png', 'https://maps.google.com/mapfiles/kml/pal2/icon31s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-32', 'https://maps.google.com/mapfiles/kml/pal2/icon32.png', 'https://maps.google.com/mapfiles/kml/pal2/icon32s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-39', 'https://maps.google.com/mapfiles/kml/pal2/icon39.png', 'https://maps.google.com/mapfiles/kml/pal2/icon39s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('restaurant', 'https://maps.google.com/mapfiles/kml/pal2/icon40.png', 'https://maps.google.com/mapfiles/kml/pal2/icon40s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('yellowcar', 'https://maps.google.com/mapfiles/kml/pal2/icon47.png', 'https://maps.google.com/mapfiles/kml/pal2/icon47s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-48', 'https://maps.google.com/mapfiles/kml/pal2/icon48.png', 'https://maps.google.com/mapfiles/kml/pal2/icon48s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-49', 'https://maps.google.com/mapfiles/kml/pal2/icon49.png', 'https://maps.google.com/mapfiles/kml/pal2/icon49s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-50', 'https://maps.google.com/mapfiles/kml/pal2/icon50.png', 'https://maps.google.com/mapfiles/kml/pal2/icon50s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-54', 'https://maps.google.com/mapfiles/kml/pal2/icon54.png', 'https://maps.google.com/mapfiles/kml/pal2/icon54s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal2-55', 'https://maps.google.com/mapfiles/kml/pal2/icon55.png', 'https://maps.google.com/mapfiles/kml/pal2/icon55s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('plane', 'https://maps.google.com/mapfiles/kml/pal2/icon56.png', 'https://maps.google.com/mapfiles/kml/pal2/icon56s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('soccer', 'https://maps.google.com/mapfiles/kml/pal2/icon57.png', 'https://maps.google.com/mapfiles/kml/pal2/icon57s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('bank', 'https://maps.google.com/mapfiles/kml/pal2/icon58.png', 'https://maps.google.com/mapfiles/kml/pal2/icon58s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('coffee', 'https://maps.google.com/mapfiles/kml/pal2/icon62.png', 'https://maps.google.com/mapfiles/kml/pal2/icon62s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-0', 'https://maps.google.com/mapfiles/kml/pal3/icon0.png', 'https://maps.google.com/mapfiles/kml/pal3/icon0s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-1', 'https://maps.google.com/mapfiles/kml/pal3/icon1.png', 'https://maps.google.com/mapfiles/kml/pal3/icon1s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-2', 'https://maps.google.com/mapfiles/kml/pal3/icon2.png', 'https://maps.google.com/mapfiles/kml/pal3/icon2s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-3', 'https://maps.google.com/mapfiles/kml/pal3/icon3.png', 'https://maps.google.com/mapfiles/kml/pal3/icon3s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-4', 'https://maps.google.com/mapfiles/kml/pal3/icon4.png', 'https://maps.google.com/mapfiles/kml/pal3/icon4s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-5', 'https://maps.google.com/mapfiles/kml/pal3/icon5.png', 'https://maps.google.com/mapfiles/kml/pal3/icon5s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-6', 'https://maps.google.com/mapfiles/kml/pal3/icon6.png', 'https://maps.google.com/mapfiles/kml/pal3/icon6s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-7', 'https://maps.google.com/mapfiles/kml/pal3/icon7.png', 'https://maps.google.com/mapfiles/kml/pal3/icon7s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-8', 'https://maps.google.com/mapfiles/kml/pal3/icon8.png', 'https://maps.google.com/mapfiles/kml/pal3/icon8s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-9', 'https://maps.google.com/mapfiles/kml/pal3/icon9.png', 'https://maps.google.com/mapfiles/kml/pal3/icon9s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-10', 'https://maps.google.com/mapfiles/kml/pal3/icon10.png', 'https://maps.google.com/mapfiles/kml/pal3/icon10s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-11', 'https://maps.google.com/mapfiles/kml/pal3/icon11.png', 'https://maps.google.com/mapfiles/kml/pal3/icon11s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-12', 'https://maps.google.com/mapfiles/kml/pal3/icon12.png', 'https://maps.google.com/mapfiles/kml/pal3/icon12s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-13', 'https://maps.google.com/mapfiles/kml/pal3/icon13.png', 'https://maps.google.com/mapfiles/kml/pal3/icon13s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-14', 'https://maps.google.com/mapfiles/kml/pal3/icon14.png', 'https://maps.google.com/mapfiles/kml/pal3/icon14s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-15', 'https://maps.google.com/mapfiles/kml/pal3/icon15.png', 'https://maps.google.com/mapfiles/kml/pal3/icon15s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-16', 'https://maps.google.com/mapfiles/kml/pal3/icon16.png', 'https://maps.google.com/mapfiles/kml/pal3/icon16s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-17', 'https://maps.google.com/mapfiles/kml/pal3/icon17.png', 'https://maps.google.com/mapfiles/kml/pal3/icon17s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-18', 'https://maps.google.com/mapfiles/kml/pal3/icon18.png', 'https://maps.google.com/mapfiles/kml/pal3/icon18s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-19', 'https://maps.google.com/mapfiles/kml/pal3/icon19.png', 'https://maps.google.com/mapfiles/kml/pal3/icon19s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-20', 'https://maps.google.com/mapfiles/kml/pal3/icon20.png', 'https://maps.google.com/mapfiles/kml/pal3/icon20s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('building', 'https://maps.google.com/mapfiles/kml/pal3/icon21.png', 'https://maps.google.com/mapfiles/kml/pal3/icon21s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-22', 'https://maps.google.com/mapfiles/kml/pal3/icon22.png', 'https://maps.google.com/mapfiles/kml/pal3/icon22s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-23', 'https://maps.google.com/mapfiles/kml/pal3/icon23.png', 'https://maps.google.com/mapfiles/kml/pal3/icon23s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-24', 'https://maps.google.com/mapfiles/kml/pal3/icon24.png', 'https://maps.google.com/mapfiles/kml/pal3/icon24s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-25', 'https://maps.google.com/mapfiles/kml/pal3/icon25.png', 'https://maps.google.com/mapfiles/kml/pal3/icon25s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('market', 'https://maps.google.com/mapfiles/kml/pal3/icon26.png', 'https://maps.google.com/mapfiles/kml/pal3/icon26s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('globe', 'https://maps.google.com/mapfiles/kml/pal3/icon27.png', 'https://maps.google.com/mapfiles/kml/pal3/icon27s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-28', 'https://maps.google.com/mapfiles/kml/pal3/icon28.png', 'https://maps.google.com/mapfiles/kml/pal3/icon28s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('mountain', 'https://maps.google.com/mapfiles/kml/pal3/icon29.png', 'https://maps.google.com/mapfiles/kml/pal3/icon29s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-30', 'https://maps.google.com/mapfiles/kml/pal3/icon30.png', 'https://maps.google.com/mapfiles/kml/pal3/icon30s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-31', 'https://maps.google.com/mapfiles/kml/pal3/icon31.png', 'https://maps.google.com/mapfiles/kml/pal3/icon31s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-32', 'https://maps.google.com/mapfiles/kml/pal3/icon32.png', 'https://maps.google.com/mapfiles/kml/pal3/icon32s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-33', 'https://maps.google.com/mapfiles/kml/pal3/icon33.png', 'https://maps.google.com/mapfiles/kml/pal3/icon33s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-34', 'https://maps.google.com/mapfiles/kml/pal3/icon34.png', 'https://maps.google.com/mapfiles/kml/pal3/icon34s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-35', 'https://maps.google.com/mapfiles/kml/pal3/icon35.png', 'https://maps.google.com/mapfiles/kml/pal3/icon35s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-36', 'https://maps.google.com/mapfiles/kml/pal3/icon36.png', 'https://maps.google.com/mapfiles/kml/pal3/icon36s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-37', 'https://maps.google.com/mapfiles/kml/pal3/icon37.png', 'https://maps.google.com/mapfiles/kml/pal3/icon37s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-38', 'https://maps.google.com/mapfiles/kml/pal3/icon38.png', 'https://maps.google.com/mapfiles/kml/pal3/icon38s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-39', 'https://maps.google.com/mapfiles/kml/pal3/icon39.png', 'https://maps.google.com/mapfiles/kml/pal3/icon39s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-40', 'https://maps.google.com/mapfiles/kml/pal3/icon40.png', 'https://maps.google.com/mapfiles/kml/pal3/icon40s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-41', 'https://maps.google.com/mapfiles/kml/pal3/icon41.png', 'https://maps.google.com/mapfiles/kml/pal3/icon41s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-42', 'https://maps.google.com/mapfiles/kml/pal3/icon42.png', 'https://maps.google.com/mapfiles/kml/pal3/icon42s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-43', 'https://maps.google.com/mapfiles/kml/pal3/icon43.png', 'https://maps.google.com/mapfiles/kml/pal3/icon43s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('information', 'https://maps.google.com/mapfiles/kml/pal3/icon44.png', 'https://maps.google.com/mapfiles/kml/pal3/icon44s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('attention', 'https://maps.google.com/mapfiles/kml/pal3/icon45.png', 'https://maps.google.com/mapfiles/kml/pal3/icon45s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('redcross', 'https://maps.google.com/mapfiles/kml/pal3/icon46.png', 'https://maps.google.com/mapfiles/kml/pal3/icon46s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('nuclear', 'https://maps.google.com/mapfiles/kml/pal3/icon47.png', 'https://maps.google.com/mapfiles/kml/pal3/icon47s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-48', 'https://maps.google.com/mapfiles/kml/pal3/icon48.png', 'https://maps.google.com/mapfiles/kml/pal3/icon48s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-49', 'https://maps.google.com/mapfiles/kml/pal3/icon49.png', 'https://maps.google.com/mapfiles/kml/pal3/icon49s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-50', 'https://maps.google.com/mapfiles/kml/pal3/icon50.png', 'https://maps.google.com/mapfiles/kml/pal3/icon50s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-51', 'https://maps.google.com/mapfiles/kml/pal3/icon51.png', 'https://maps.google.com/mapfiles/kml/pal3/icon51s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-52', 'https://maps.google.com/mapfiles/kml/pal3/icon52.png', 'https://maps.google.com/mapfiles/kml/pal3/icon52s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-53', 'https://maps.google.com/mapfiles/kml/pal3/icon53.png', 'https://maps.google.com/mapfiles/kml/pal3/icon53s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-54', 'https://maps.google.com/mapfiles/kml/pal3/icon54.png', 'https://maps.google.com/mapfiles/kml/pal3/icon54s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-55', 'https://maps.google.com/mapfiles/kml/pal3/icon55.png', 'https://maps.google.com/mapfiles/kml/pal3/icon55s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('house', 'https://maps.google.com/mapfiles/kml/pal3/icon56.png', 'https://maps.google.com/mapfiles/kml/pal3/icon56s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-57', 'https://maps.google.com/mapfiles/kml/pal3/icon57.png', 'https://maps.google.com/mapfiles/kml/pal3/icon57s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-58', 'https://maps.google.com/mapfiles/kml/pal3/icon58.png', 'https://maps.google.com/mapfiles/kml/pal3/icon58s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-59', 'https://maps.google.com/mapfiles/kml/pal3/icon59.png', 'https://maps.google.com/mapfiles/kml/pal3/icon59s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-60', 'https://maps.google.com/mapfiles/kml/pal3/icon60.png', 'https://maps.google.com/mapfiles/kml/pal3/icon60s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-61', 'https://maps.google.com/mapfiles/kml/pal3/icon61.png', 'https://maps.google.com/mapfiles/kml/pal3/icon61s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-62', 'https://maps.google.com/mapfiles/kml/pal3/icon62.png', 'https://maps.google.com/mapfiles/kml/pal3/icon62s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal3-63', 'https://maps.google.com/mapfiles/kml/pal3/icon63.png', 'https://maps.google.com/mapfiles/kml/pal3/icon63s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-0', 'https://maps.google.com/mapfiles/kml/pal4/icon0.png', 'https://maps.google.com/mapfiles/kml/pal4/icon0s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-1', 'https://maps.google.com/mapfiles/kml/pal4/icon1.png', 'https://maps.google.com/mapfiles/kml/pal4/icon1s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-2', 'https://maps.google.com/mapfiles/kml/pal4/icon2.png', 'https://maps.google.com/mapfiles/kml/pal4/icon2s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-3', 'https://maps.google.com/mapfiles/kml/pal4/icon3.png', 'https://maps.google.com/mapfiles/kml/pal4/icon3s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-4', 'https://maps.google.com/mapfiles/kml/pal4/icon4.png', 'https://maps.google.com/mapfiles/kml/pal4/icon4s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-5', 'https://maps.google.com/mapfiles/kml/pal4/icon5.png', 'https://maps.google.com/mapfiles/kml/pal4/icon5s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-6', 'https://maps.google.com/mapfiles/kml/pal4/icon6.png', 'https://maps.google.com/mapfiles/kml/pal4/icon6s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-7', 'https://maps.google.com/mapfiles/kml/pal4/icon7.png', 'https://maps.google.com/mapfiles/kml/pal4/icon7s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-8', 'https://maps.google.com/mapfiles/kml/pal4/icon8.png', 'https://maps.google.com/mapfiles/kml/pal4/icon8s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-9', 'https://maps.google.com/mapfiles/kml/pal4/icon9.png', 'https://maps.google.com/mapfiles/kml/pal4/icon9s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-10', 'https://maps.google.com/mapfiles/kml/pal4/icon10.png', 'https://maps.google.com/mapfiles/kml/pal4/icon10s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-11', 'https://maps.google.com/mapfiles/kml/pal4/icon11.png', 'https://maps.google.com/mapfiles/kml/pal4/icon11s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-12', 'https://maps.google.com/mapfiles/kml/pal4/icon12.png', 'https://maps.google.com/mapfiles/kml/pal4/icon12s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-13', 'https://maps.google.com/mapfiles/kml/pal4/icon13.png', 'https://maps.google.com/mapfiles/kml/pal4/icon13s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-14', 'https://maps.google.com/mapfiles/kml/pal4/icon14.png', 'https://maps.google.com/mapfiles/kml/pal4/icon14s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('redcar', 'https://maps.google.com/mapfiles/kml/pal4/icon15.png', 'https://maps.google.com/mapfiles/kml/pal4/icon15s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-16', 'https://maps.google.com/mapfiles/kml/pal4/icon16.png', 'https://maps.google.com/mapfiles/kml/pal4/icon16s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-17', 'https://maps.google.com/mapfiles/kml/pal4/icon17.png', 'https://maps.google.com/mapfiles/kml/pal4/icon17s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-18', 'https://maps.google.com/mapfiles/kml/pal4/icon18.png', 'https://maps.google.com/mapfiles/kml/pal4/icon18s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-19', 'https://maps.google.com/mapfiles/kml/pal4/icon19.png', 'https://maps.google.com/mapfiles/kml/pal4/icon19s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-20', 'https://maps.google.com/mapfiles/kml/pal4/icon20.png', 'https://maps.google.com/mapfiles/kml/pal4/icon20s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-21', 'https://maps.google.com/mapfiles/kml/pal4/icon21.png', 'https://maps.google.com/mapfiles/kml/pal4/icon21s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-22', 'https://maps.google.com/mapfiles/kml/pal4/icon22.png', 'https://maps.google.com/mapfiles/kml/pal4/icon22s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-23', 'https://maps.google.com/mapfiles/kml/pal4/icon23.png', 'https://maps.google.com/mapfiles/kml/pal4/icon23s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-24', 'https://maps.google.com/mapfiles/kml/pal4/icon24.png', 'https://maps.google.com/mapfiles/kml/pal4/icon24s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-25', 'https://maps.google.com/mapfiles/kml/pal4/icon25.png', 'https://maps.google.com/mapfiles/kml/pal4/icon25s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-26', 'https://maps.google.com/mapfiles/kml/pal4/icon26.png', 'https://maps.google.com/mapfiles/kml/pal4/icon26s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-27', 'https://maps.google.com/mapfiles/kml/pal4/icon27.png', 'https://maps.google.com/mapfiles/kml/pal4/icon27s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-28', 'https://maps.google.com/mapfiles/kml/pal4/icon28.png', 'https://maps.google.com/mapfiles/kml/pal4/icon28s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-29', 'https://maps.google.com/mapfiles/kml/pal4/icon29.png', 'https://maps.google.com/mapfiles/kml/pal4/icon29s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('temperature', 'https://maps.google.com/mapfiles/kml/pal4/icon30.png', 'https://maps.google.com/mapfiles/kml/pal4/icon30s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-31', 'https://maps.google.com/mapfiles/kml/pal4/icon31.png', 'https://maps.google.com/mapfiles/kml/pal4/icon31s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-32', 'https://maps.google.com/mapfiles/kml/pal4/icon32.png', 'https://maps.google.com/mapfiles/kml/pal4/icon32s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-33', 'https://maps.google.com/mapfiles/kml/pal4/icon33.png', 'https://maps.google.com/mapfiles/kml/pal4/icon33s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-34', 'https://maps.google.com/mapfiles/kml/pal4/icon34.png', 'https://maps.google.com/mapfiles/kml/pal4/icon34s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-35', 'https://maps.google.com/mapfiles/kml/pal4/icon35.png', 'https://maps.google.com/mapfiles/kml/pal4/icon35s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-36', 'https://maps.google.com/mapfiles/kml/pal4/icon36.png', 'https://maps.google.com/mapfiles/kml/pal4/icon36s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-37', 'https://maps.google.com/mapfiles/kml/pal4/icon37.png', 'https://maps.google.com/mapfiles/kml/pal4/icon37s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-38', 'https://maps.google.com/mapfiles/kml/pal4/icon38.png', 'https://maps.google.com/mapfiles/kml/pal4/icon38s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-39', 'https://maps.google.com/mapfiles/kml/pal4/icon39.png', 'https://maps.google.com/mapfiles/kml/pal4/icon39s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('rain', 'https://maps.google.com/mapfiles/kml/pal4/icon40.png', 'https://maps.google.com/mapfiles/kml/pal4/icon40s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('sun', 'https://maps.google.com/mapfiles/kml/pal4/icon41.png', 'https://maps.google.com/mapfiles/kml/pal4/icon41s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('clowdy', 'https://maps.google.com/mapfiles/kml/pal4/icon42.png', 'https://maps.google.com/mapfiles/kml/pal4/icon42s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('snow', 'https://maps.google.com/mapfiles/kml/pal4/icon43.png', 'https://maps.google.com/mapfiles/kml/pal4/icon43s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('thunderbolt', 'https://maps.google.com/mapfiles/kml/pal4/icon44.png', 'https://maps.google.com/mapfiles/kml/pal4/icon44s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('webcam', 'https://maps.google.com/mapfiles/kml/pal4/icon45.png', 'https://maps.google.com/mapfiles/kml/pal4/icon45s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('photo', 'https://maps.google.com/mapfiles/kml/pal4/icon46.png', 'https://maps.google.com/mapfiles/kml/pal4/icon46s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('star', 'https://maps.google.com/mapfiles/kml/pal4/icon47.png', 'https://maps.google.com/mapfiles/kml/pal4/icon47s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-48', 'https://maps.google.com/mapfiles/kml/pal4/icon48.png', 'https://maps.google.com/mapfiles/kml/pal4/icon48s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-49', 'https://maps.google.com/mapfiles/kml/pal4/icon49.png', 'https://maps.google.com/mapfiles/kml/pal4/icon49s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-50', 'https://maps.google.com/mapfiles/kml/pal4/icon50.png', 'https://maps.google.com/mapfiles/kml/pal4/icon50s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-51', 'https://maps.google.com/mapfiles/kml/pal4/icon51.png', 'https://maps.google.com/mapfiles/kml/pal4/icon51s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-52', 'https://maps.google.com/mapfiles/kml/pal4/icon52.png', 'https://maps.google.com/mapfiles/kml/pal4/icon52s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-53', 'https://maps.google.com/mapfiles/kml/pal4/icon53.png', 'https://maps.google.com/mapfiles/kml/pal4/icon53s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-54', 'https://maps.google.com/mapfiles/kml/pal4/icon54.png', 'https://maps.google.com/mapfiles/kml/pal4/icon54s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-55', 'https://maps.google.com/mapfiles/kml/pal4/icon55.png', 'https://maps.google.com/mapfiles/kml/pal4/icon55s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-56', 'https://maps.google.com/mapfiles/kml/pal4/icon56.png', 'https://maps.google.com/mapfiles/kml/pal4/icon56s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-57', 'https://maps.google.com/mapfiles/kml/pal4/icon57.png', 'https://maps.google.com/mapfiles/kml/pal4/icon57s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-58', 'https://maps.google.com/mapfiles/kml/pal4/icon58.png', 'https://maps.google.com/mapfiles/kml/pal4/icon58s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-59', 'https://maps.google.com/mapfiles/kml/pal4/icon59.png', 'https://maps.google.com/mapfiles/kml/pal4/icon59s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-60', 'https://maps.google.com/mapfiles/kml/pal4/icon60.png', 'https://maps.google.com/mapfiles/kml/pal4/icon60s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-61', 'https://maps.google.com/mapfiles/kml/pal4/icon61.png', 'https://maps.google.com/mapfiles/kml/pal4/icon61s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('greencar', 'https://maps.google.com/mapfiles/kml/pal4/icon62.png', 'https://maps.google.com/mapfiles/kml/pal4/icon62s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal4-63', 'https://maps.google.com/mapfiles/kml/pal4/icon63.png', 'https://maps.google.com/mapfiles/kml/pal4/icon63s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-0', 'https://maps.google.com/mapfiles/kml/pal5/icon0.png', 'https://maps.google.com/mapfiles/kml/pal5/icon0s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-1', 'https://maps.google.com/mapfiles/kml/pal5/icon1.png', 'https://maps.google.com/mapfiles/kml/pal5/icon1s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-2', 'https://maps.google.com/mapfiles/kml/pal5/icon2.png', 'https://maps.google.com/mapfiles/kml/pal5/icon2s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-3', 'https://maps.google.com/mapfiles/kml/pal5/icon3.png', 'https://maps.google.com/mapfiles/kml/pal5/icon3s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-4', 'https://maps.google.com/mapfiles/kml/pal5/icon4.png', 'https://maps.google.com/mapfiles/kml/pal5/icon4s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-5', 'https://maps.google.com/mapfiles/kml/pal5/icon5.png', 'https://maps.google.com/mapfiles/kml/pal5/icon5s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-6', 'https://maps.google.com/mapfiles/kml/pal5/icon6.png', 'https://maps.google.com/mapfiles/kml/pal5/icon6s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-7', 'https://maps.google.com/mapfiles/kml/pal5/icon7.png', 'https://maps.google.com/mapfiles/kml/pal5/icon7s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-8', 'https://maps.google.com/mapfiles/kml/pal5/icon8.png', 'https://maps.google.com/mapfiles/kml/pal5/icon8s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-9', 'https://maps.google.com/mapfiles/kml/pal5/icon9.png', 'https://maps.google.com/mapfiles/kml/pal5/icon9s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-10', 'https://maps.google.com/mapfiles/kml/pal5/icon10.png', 'https://maps.google.com/mapfiles/kml/pal5/icon10s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-11', 'https://maps.google.com/mapfiles/kml/pal5/icon11.png', 'https://maps.google.com/mapfiles/kml/pal5/icon11s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-12', 'https://maps.google.com/mapfiles/kml/pal5/icon12.png', 'https://maps.google.com/mapfiles/kml/pal5/icon12s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-13', 'https://maps.google.com/mapfiles/kml/pal5/icon13.png', 'https://maps.google.com/mapfiles/kml/pal5/icon13s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-14', 'https://maps.google.com/mapfiles/kml/pal5/icon14.png', 'https://maps.google.com/mapfiles/kml/pal5/icon14s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('autobahn', 'https://maps.google.com/mapfiles/kml/pal5/icon15.png', 'https://maps.google.com/mapfiles/kml/pal5/icon15s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-16', 'https://maps.google.com/mapfiles/kml/pal5/icon16.png', 'https://maps.google.com/mapfiles/kml/pal5/icon16s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-17', 'https://maps.google.com/mapfiles/kml/pal5/icon17.png', 'https://maps.google.com/mapfiles/kml/pal5/icon17s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-18', 'https://maps.google.com/mapfiles/kml/pal5/icon18.png', 'https://maps.google.com/mapfiles/kml/pal5/icon18s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-19', 'https://maps.google.com/mapfiles/kml/pal5/icon19.png', 'https://maps.google.com/mapfiles/kml/pal5/icon19s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-20', 'https://maps.google.com/mapfiles/kml/pal5/icon20.png', 'https://maps.google.com/mapfiles/kml/pal5/icon20s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-21', 'https://maps.google.com/mapfiles/kml/pal5/icon21.png', 'https://maps.google.com/mapfiles/kml/pal5/icon21s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-22', 'https://maps.google.com/mapfiles/kml/pal5/icon22.png', 'https://maps.google.com/mapfiles/kml/pal5/icon22s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-23', 'https://maps.google.com/mapfiles/kml/pal5/icon23.png', 'https://maps.google.com/mapfiles/kml/pal5/icon23s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-24', 'https://maps.google.com/mapfiles/kml/pal5/icon24.png', 'https://maps.google.com/mapfiles/kml/pal5/icon24s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-25', 'https://maps.google.com/mapfiles/kml/pal5/icon25.png', 'https://maps.google.com/mapfiles/kml/pal5/icon25s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-26', 'https://maps.google.com/mapfiles/kml/pal5/icon26.png', 'https://maps.google.com/mapfiles/kml/pal5/icon26s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-27', 'https://maps.google.com/mapfiles/kml/pal5/icon27.png', 'https://maps.google.com/mapfiles/kml/pal5/icon27s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-28', 'https://maps.google.com/mapfiles/kml/pal5/icon28.png', 'https://maps.google.com/mapfiles/kml/pal5/icon28s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-29', 'https://maps.google.com/mapfiles/kml/pal5/icon29.png', 'https://maps.google.com/mapfiles/kml/pal5/icon29s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-30', 'https://maps.google.com/mapfiles/kml/pal5/icon30.png', 'https://maps.google.com/mapfiles/kml/pal5/icon30s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-31', 'https://maps.google.com/mapfiles/kml/pal5/icon31.png', 'https://maps.google.com/mapfiles/kml/pal5/icon31s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-32', 'https://maps.google.com/mapfiles/kml/pal5/icon32.png', 'https://maps.google.com/mapfiles/kml/pal5/icon32s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-33', 'https://maps.google.com/mapfiles/kml/pal5/icon33.png', 'https://maps.google.com/mapfiles/kml/pal5/icon33s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-34', 'https://maps.google.com/mapfiles/kml/pal5/icon34.png', 'https://maps.google.com/mapfiles/kml/pal5/icon34s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-35', 'https://maps.google.com/mapfiles/kml/pal5/icon35.png', 'https://maps.google.com/mapfiles/kml/pal5/icon35s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-36', 'https://maps.google.com/mapfiles/kml/pal5/icon36.png', 'https://maps.google.com/mapfiles/kml/pal5/icon36s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-37', 'https://maps.google.com/mapfiles/kml/pal5/icon37.png', 'https://maps.google.com/mapfiles/kml/pal5/icon37s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-38', 'https://maps.google.com/mapfiles/kml/pal5/icon38.png', 'https://maps.google.com/mapfiles/kml/pal5/icon38s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-39', 'https://maps.google.com/mapfiles/kml/pal5/icon39.png', 'https://maps.google.com/mapfiles/kml/pal5/icon39s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-40', 'https://maps.google.com/mapfiles/kml/pal5/icon40.png', 'https://maps.google.com/mapfiles/kml/pal5/icon40s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-41', 'https://maps.google.com/mapfiles/kml/pal5/icon41.png', 'https://maps.google.com/mapfiles/kml/pal5/icon41s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-42', 'https://maps.google.com/mapfiles/kml/pal5/icon42.png', 'https://maps.google.com/mapfiles/kml/pal5/icon42s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-43', 'https://maps.google.com/mapfiles/kml/pal5/icon43.png', 'https://maps.google.com/mapfiles/kml/pal5/icon43s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-44', 'https://maps.google.com/mapfiles/kml/pal5/icon44.png', 'https://maps.google.com/mapfiles/kml/pal5/icon44s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-45', 'https://maps.google.com/mapfiles/kml/pal5/icon45.png', 'https://maps.google.com/mapfiles/kml/pal5/icon45s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-46', 'https://maps.google.com/mapfiles/kml/pal5/icon46.png', 'https://maps.google.com/mapfiles/kml/pal5/icon46s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-47', 'https://maps.google.com/mapfiles/kml/pal5/icon47.png', 'https://maps.google.com/mapfiles/kml/pal5/icon47s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-48', 'https://maps.google.com/mapfiles/kml/pal5/icon48.png', 'https://maps.google.com/mapfiles/kml/pal5/icon48s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-49', 'https://maps.google.com/mapfiles/kml/pal5/icon49.png', 'https://maps.google.com/mapfiles/kml/pal5/icon49s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-50', 'https://maps.google.com/mapfiles/kml/pal5/icon50.png', 'https://maps.google.com/mapfiles/kml/pal5/icon50s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-51', 'https://maps.google.com/mapfiles/kml/pal5/icon51.png', 'https://maps.google.com/mapfiles/kml/pal5/icon51s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-52', 'https://maps.google.com/mapfiles/kml/pal5/icon52.png', 'https://maps.google.com/mapfiles/kml/pal5/icon52s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-53', 'https://maps.google.com/mapfiles/kml/pal5/icon53.png', 'https://maps.google.com/mapfiles/kml/pal5/icon53s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-54', 'https://maps.google.com/mapfiles/kml/pal5/icon54.png', 'https://maps.google.com/mapfiles/kml/pal5/icon54s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-55', 'https://maps.google.com/mapfiles/kml/pal5/icon55.png', 'https://maps.google.com/mapfiles/kml/pal5/icon55s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-56', 'https://maps.google.com/mapfiles/kml/pal5/icon56.png', 'https://maps.google.com/mapfiles/kml/pal5/icon56s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-57', 'https://maps.google.com/mapfiles/kml/pal5/icon57.png', 'https://maps.google.com/mapfiles/kml/pal5/icon57s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-58', 'https://maps.google.com/mapfiles/kml/pal5/icon58.png', 'https://maps.google.com/mapfiles/kml/pal5/icon58s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-59', 'https://maps.google.com/mapfiles/kml/pal5/icon59.png', 'https://maps.google.com/mapfiles/kml/pal5/icon59s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-60', 'https://maps.google.com/mapfiles/kml/pal5/icon60.png', 'https://maps.google.com/mapfiles/kml/pal5/icon60s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-61', 'https://maps.google.com/mapfiles/kml/pal5/icon61.png', 'https://maps.google.com/mapfiles/kml/pal5/icon61s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-62', 'https://maps.google.com/mapfiles/kml/pal5/icon62.png', 'https://maps.google.com/mapfiles/kml/pal5/icon62s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('pal5-63', 'https://maps.google.com/mapfiles/kml/pal5/icon63.png', 'https://maps.google.com/mapfiles/kml/pal5/icon63s.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerA', 'https://www.google.com/mapfiles/markerA.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerB', 'https://www.google.com/mapfiles/markerB.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerC', 'https://www.google.com/mapfiles/markerC.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerD', 'https://www.google.com/mapfiles/markerD.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerE', 'https://www.google.com/mapfiles/markerE.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerF', 'https://www.google.com/mapfiles/markerF.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerG', 'https://www.google.com/mapfiles/markerG.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerH', 'https://www.google.com/mapfiles/markerH.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerI', 'https://www.google.com/mapfiles/markerI.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerJ', 'https://www.google.com/mapfiles/markerJ.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerK', 'https://www.google.com/mapfiles/markerK.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerL', 'https://www.google.com/mapfiles/markerL.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerM', 'https://www.google.com/mapfiles/markerM.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerN', 'https://www.google.com/mapfiles/markerN.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerO', 'https://www.google.com/mapfiles/markerO.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerP', 'https://www.google.com/mapfiles/markerP.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerQ', 'https://www.google.com/mapfiles/markerQ.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerR', 'https://www.google.com/mapfiles/markerR.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerS', 'https://www.google.com/mapfiles/markerS.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerT', 'https://www.google.com/mapfiles/markerT.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerU', 'https://www.google.com/mapfiles/markerU.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerV', 'https://www.google.com/mapfiles/markerV.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerW', 'https://www.google.com/mapfiles/markerW.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerX', 'https://www.google.com/mapfiles/markerX.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerY', 'https://www.google.com/mapfiles/markerY.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('markerZ', 'https://www.google.com/mapfiles/markerZ.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('ddstart', 'https://www.google.com/mapfiles/dd-start.png', 'https://www.google.com/mapfiles/shadow50.png');";
$icons[] = "INSERT INTO `".TABLE_PREFIX."mod_map_icons` VALUES ('ddend', 'https://www.google.com/mapfiles/dd-end.png', 'https://www.google.com/mapfiles/shadow50.png');";
for($x=0;$x<count($icons);$x++){
        $database->query($icons[$x]);
}


        // Insert info into the search table
        // Module query info
        $field_info = array();
        $field_info['page_id'] = 'page_id';
        $field_info['title'] = 'page_title';
        $field_info['link'] = 'link';
        $field_info['description'] = 'description';
        $field_info['modified_when'] = 'modified_when';
        $field_info['modified_by'] = 'modified_by';
        $field_info = serialize($field_info);
        $database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('module', 'mapbaker', '$field_info')");
        // Query start
        $query_start_code = "SELECT [TP]pages.page_id, [TP]pages.page_title,        [TP]pages.link, [TP]pages.description, [TP]pages.modified_when, [TP]pages.modified_by        FROM [TP]mod_map_markers, [TP]pages WHERE ";
        $database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('query_start', '$query_start_code', 'mapbaker')");
        // Query body
        $query_body_code = "
        [TP]pages.page_id = [TP]mod_map_markers.page_id AND [TP]mod_map_markers.marker LIKE \'%[STRING]%\'
        OR [TP]pages.page_id = [TP]mod_map_markers.page_id AND [TP]mod_map_markers.description LIKE \'%[STRING]%\' ";
        $database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('query_body', '$query_body_code', 'mapbaker')");
        // Query end
        $query_end_code = "";
        $database->query("INSERT INTO ".TABLE_PREFIX."search (name,value,extra) VALUES ('query_end', '$query_end_code', 'mapbaker')");

}

?>