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
 * @version         $Id: modify_geofeed.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

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

$admin_header = false;
// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

$geofeed_id = $admin->checkIDKEY('geofeed_id', false, 'GET');
// Get id
if(!$geofeed_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}

$admin->print_header();

// Load Language file
if(LANGUAGE_LOADED) {
    require_once(WB_PATH.'/modules/mapbaker/languages/EN.php');
    if(file_exists(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php')) {
        require_once(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php');
    }
}

// Get info on geofeed
$query_geofeed = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_map_geofeeds WHERE geofeed_id='$geofeed_id' AND section_id='$section_id' ");
$fetch_geofeed = $query_geofeed->fetchRow();

$url = $admin->strip_slashes($fetch_geofeed['url']);
$active = $admin->strip_slashes($fetch_geofeed['active']);

?>

<style type="text/css">
.setting_name {
        vertical-align: top;
}
</style>

<form name="modify" action="<?php echo WB_URL; ?>/modules/mapbaker/save_geofeed.php" method="post" style="margin: 0;">

<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
<input type="hidden" name="geofeed_id"  value="<?php echo $admin->getIDKEY($geofeed_id); ?>">

<table class="row_a" cellpadding="2" cellspacing="0" border="0" align="center" width="100%">
<tr>
        <td class="setting_name">
                <label for="geofeed" accesskey="n"><b><?php echo $MBTEXT['GEOURL_NAME']; ?>:</b></label>
        </td>
</tr>
<tr>
        <td class="setting_name">
                <input type="text" name="geofeed" id="geofeed" value="<?php echo $admin->strip_slashes($fetch_geofeed['geofeed']); ?>" style="width: 98%;" maxlength="255" />
        </td>
</tr>
<tr>
        <td class="setting_name">
                <label for="url" accesskey="q"><b><?php echo $MBTEXT['GEOURL']; ?>:</b></label>
        </td>
</tr>
<tr>
        <td class="setting_name">
                <input type="text" name="url" id="url" value="<?php echo $url; ?>" style="width: 98%;" maxlength="255" />
        </td>
</tr>
<tr>
        <td class="setting_name" width="80">
                <label for="cat_name" accesskey="n"><b><?php echo $MBTEXT['ACTIVE']; ?>:</b></label>
        </td>
</tr>
<tr>
        <td class="setting_name">
                <input type="radio" value="1" name="active" <?php if ($active == '1') { echo "checked"; } ?>><?php echo $TEXT['YES'];?>
                <input type="radio" value="0" name="active" <?php if ($active == '0') { echo "checked"; } ?>><?php echo $TEXT['NO'];?>
        </td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
        <td align="left">
                <input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;"></form>
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