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
 * @version         $Id: modify_settings.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Load Language file
if(LANGUAGE_LOADED) {
    require_once(WB_PATH.'/modules/mapbaker/languages/EN.php');
    if(file_exists(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php')) {
        require_once(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php');
    }
}

// Get header and footer
$query_settings = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_map_settings WHERE section_id='$section_id'");
$fetch_settings = $query_settings->fetchRow();
?>


<form name="edit" action="<?php echo WB_URL; ?>/modules/mapbaker/save_settings.php" method="post" style="margin: 0;">

<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
<?php echo $admin->getFTAN(); ?>

<strong><?php echo $MBTEXT['SETTINGS']; ?></strong>
<table class="mapbaker mapbaker_setting" cellpadding="2" cellspacing="0" border="0" align="center" width="100%">
<tr>
<td style="width: 60%"><?php echo $MBTEXT['KEY']; ?>:</td>
<td style="width: 40%"><input type="text" name="gmkey" id="gmkey" value="<?php echo $admin->strip_slashes($fetch_settings['gmkey']); ?>" style="width: 98%;" maxlength="255" /></td>
</tr>

<tr>
<td><?php echo $MBTEXT['MAP_TYPE']; ?>:</td>
<td>
                <input type="radio" value="G_NORMAL_MAP" name="maptype" <?php if ($admin->strip_slashes($fetch_settings['maptype']) == 'G_NORMAL_MAP') { echo "checked"; } ?>><?php echo $MBTEXT['G_NORMAL_MAP'];?>
                <input type="radio" value="G_SATELLITE_MAP" name="maptype"  <?php if ($admin->strip_slashes($fetch_settings['maptype']) == 'G_SATELLITE_MAP') { echo "checked"; } ?>><?php echo $MBTEXT['G_SATELLITE_MAP'];?>
                <input type="radio" value="G_HYBRID_MAP" name="maptype"  <?php if ($admin->strip_slashes($fetch_settings['maptype']) == 'G_HYBRID_MAP') { echo "checked"; } ?>><?php echo $MBTEXT['G_HYBRID_MAP'];?>
</td>
</tr>
<tr>
<td><?php echo $MBTEXT['DEFAULT_LATITUDE']; ?>:</td>
<td><input type="text" name="deflatitude" id="deflatitude" value="<?php echo $admin->strip_slashes($fetch_settings['deflatitude']); ?>" style="width: 98%;" maxlength="255" /></td>
</tr>
<tr>
<td><?php echo $MBTEXT['DEFAULT_LONGITUDE']; ?>:</td>
<td><input type="text" name="deflongitude" id="deflongitude" value="<?php echo $admin->strip_slashes($fetch_settings['deflongitude']); ?>" style="width: 98%;" maxlength="255" /></td>
</tr>
<tr>
<td><?php echo $MBTEXT['DEFAULT_ZOOM']; ?>:</td>
<td><input type="range" name="defzoom" id="defzoom" min="1" max="18"  value="<?php echo $admin->strip_slashes($fetch_settings['defzoom']); ?>" style="width: 98%;" maxlength="255">
<!-- input type="text" name="defzoom" id="defzoom" value="<?php echo $admin->strip_slashes($fetch_settings['defzoom']); ?>" style="width: 98%;" maxlength="255" /--></td>
</tr>
<tr>
<td><?php echo $MBTEXT['MAP_WIDTH']; ?>:</td>
<td class="setting_name"> <input type="text" name="width" id="width" value="<?php echo $admin->strip_slashes($fetch_settings['width']); ?>" style="width: 98%;" maxlength="255" /></td>
</tr>
<tr>
<td><?php echo $MBTEXT['MAP_HEIGHT']; ?>:</td>
<td><input type="text" name="height" id="height" value="<?php echo $admin->strip_slashes($fetch_settings['height']); ?>" style="width: 98%;" maxlength="255" /></td>
</tr>
<tr>
<td><?php echo $MBTEXT['TEMPLATE_MARKER']; ?>:</td>
<td><textarea name="template_infowindow" style="width: 98%; height: 200px;"><?php echo $admin->strip_slashes($fetch_settings['template_infowindow']); ?></textarea></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
        <td align="left">
                <input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;">  <input type="checkbox" name="findbest" value="1"><?php echo $MBTEXT['FITMAP']; ?></form>
        </td>
        <td align="right">
                <input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/modify.php?page_id=<?php echo $page_id; ?>';" style="width: 100px; margin-top: 5px;" />
        </td>
</tr>
</table>

<?php
// Print admin footer
$admin->print_footer();

?>