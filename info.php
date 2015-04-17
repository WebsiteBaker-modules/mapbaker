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
 * @version         $Id: info.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

/*
v 1.68
+ add a simple line <hr /> in modify.php to separat more than one section on the same page
+ add section_id on view.php to use more than one Map on the same page in multiple sections

v1.67 (jacobi22 / 2014/01/17)
+corrected FTAN in modify.php   - Thx to dbs
+corrected FTAN in save_geofeed.php  - Thx to dbs
+corrected FTAN in delete_geofeed.php  - Thx to dbs


v1.66 (jacobi22 / 2014/01/11)
+corrected move_down.php (forgot order geofeeds)
+corrected move_up.php  (forgot order geofeeds)
+fixed error in install.php (missing "if exist" in Drop Table - Thx evaki)
-remove standard entry in database for field gmkey in table mod_map_settings (map doesnt work with a free text, need Google AP-Key)
+fixed errors/Notizes in modify_geofeed.php and modify_markers.php (undefined index - Thx evaki)
+add title-tag for icons in modify.php

+implement FTAN for all forms
+setting PHP-Version in file-headers (requirements) up to PHP 5.3.2
+setting WB-Version in file headers (platform) up to WB 2.8.3 and higher (needed for FTAN)


v1.65 (arogait 2011/02/18)
+ Added German translation
+ Admin-Url replaced by Theme-URL in the modify.php (Now Map Baker is using the back-end style of WB 2.8.x!)

v1.6 (westhouseit 2010/05/05)
+ Added upgrade.php to module can be installed over existing one without wiping all markers.

v1.5
Whats New (westhouseit 2010/04/25)
+ Temp fix. All icons manually sized to 20x32. Problem with buildGSize to be fixed.

v1.4
Whats New (westhouseit 2010/04/05)
+ Added CDATA to prevent parsing of JS by XML validators.
+ Added noscript for fallback
+ Added $wb->preprocess to view.php for wblink conversion.

v1.3
Whats New (dfelix 2009/09/11)
+ corrected bug when creating categories.
+ added French translation (thanks to speedercanard)

v1.2
Whats New (dfelix 2009/08/20)
+ added icon suport to marker categories

v1.1
Whats New (dfelix 2009/08/19)
+ added external geoRSS and KML
+ added hilight marker through querystring ?marker_id=* (crnogorac081 request)

v1.0 * First public release
Whats New (dfelix 2009/08/18)
+ Markers can now be placed direcly in the map.
+ delete.php missing in last .zip.

v0.4
Whats New (dfelix 2009/08/17)
+ Configurable map size in settings
+ Default Map types configurable in settings.

v0.3
Whats New (dfelix 2009/08/11)
+ Corrected some browser issues
+ added template_infowindow in order to customize map ballon presentation

v0.2
Whats New (dfelix 2009/08/11)
+ Corrected some browser issues
+ pinpoints are now called markers

v0.1
Whats New (dfelix 2009/08/08)
+ first implementation

*/

$module_directory = 'mapbaker';
$module_name = 'Map Baker';
$module_function = 'page';
$module_version = '1.70';
$module_platform = '> 2.8.3';
$module_author = 'David Felix  (dfelix@live.com.pt). Improved by Westhouse IT developers, Jacobi22';
$module_license = 'GNU General Public License';
$module_description = '

A Google Maps based marker manager.
<br />
<br />Map Baker can use Google Maps API, <b>but its no requiered</b>.
<br />You need to sign up for a Google Maps API key, and agree with the <a href="http://code.google.com/intl/pt-PT/apis/maps/terms.html">terms and conditions</a> in order to use this module.
<br />
<ul>
        <li><a href="http://code.google.com/intl/pt-PT/apis/maps/terms.html">Maps APIs Terms</a></li>
        <li><a href="http://code.google.com/intl/pt-PT/apis/maps/signup.html">Sign Up for the Google Maps API</a></li>
</ul>
<br />The generated key should be used in the Module Settings.
<br />The module can display KML- and KMZ-Files and work with a georss.rss (see for more information at http://de.wikipedia.org/wiki/GeoRSS
';

?>