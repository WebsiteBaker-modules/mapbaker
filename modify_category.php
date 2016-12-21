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
 * @version         $Id: modify_category.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

require('../../config.php');

// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

$backlink = ADMIN_URL.'/pages/modify.php?page_id='.(int)$page_id;

$category_id = $admin->checkIDKEY('category_id', false, 'GET');
// Get id
if(!$category_id) {
        $admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], $backlink);
                exit();
}



// Load Language file
if(LANGUAGE_LOADED) {
    require_once(WB_PATH.'/modules/mapbaker/languages/EN.php');
    if(file_exists(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php')) {
        require_once(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php');
    }
}

// Get info on
$query_category = $database->query("SELECT "
        ." ".TABLE_PREFIX."mod_map_categories.section_id, "
        ." ".TABLE_PREFIX."mod_map_categories.page_id, "
        ." ".TABLE_PREFIX."mod_map_categories.cat_id, "
        ." ".TABLE_PREFIX."mod_map_categories.cat_name, "
        ." ".TABLE_PREFIX."mod_map_categories.icon_id, "
        ." ".TABLE_PREFIX."mod_map_categories.icon_url, "
        ." ".TABLE_PREFIX."mod_map_categories.active, "
        ." ".TABLE_PREFIX."mod_map_categories.pos, "
        ." ".TABLE_PREFIX."mod_map_icons.icon, "
        ." ".TABLE_PREFIX."mod_map_icons.shaddow "
        ." FROM ".TABLE_PREFIX."mod_map_categories "
        ." LEFT JOIN ".TABLE_PREFIX."mod_map_icons  "
        ." ON ".TABLE_PREFIX."mod_map_categories.icon_id=".TABLE_PREFIX."mod_map_icons.icon_id  "
        ." WHERE ".TABLE_PREFIX."mod_map_categories.cat_id='$category_id'");
$fetch_category = $query_category->fetchRow();

$active = $admin->strip_slashes($fetch_category['active']);
$icon_id = $admin->strip_slashes($fetch_category['icon_id']);
$icon_url = $admin->strip_slashes($fetch_category['icon_url']);
$icon = $admin->strip_slashes($fetch_category['icon']);
?>

<style type="text/css">
.setting_name {
        vertical-align: top;
}
</style>

<script type="text/javascript">
        function getIcon()
        {
                var w = window.open('<?php echo WB_URL; ?>/modules/mapbaker/icons.php',null,'width=300,height=320,channelmode=no,directories=no,location=no,menubar=no,resizable=no,status=no,titlebar=no,toolbar=no,scrollbars=yes');
        }

        function updateImage()
        {
                if(document.getElementById("icon_url").value!="")
                {
                        document.getElementById("icon_id").value= "custom";
                        document.getElementById("icon_preview").src=document.getElementById("icon_url").value;
                }
                else
                {
                        document.getElementById("icon_id").value= "default";
                        document.getElementById("icon_preview").src="https://maps.google.com/mapfiles/marker.png";
                }
        }
</script>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
</head>
<body>

<form name="modify" action="<?php echo WB_URL; ?>/modules/mapbaker/save_category.php" method="post" style="margin: 0;">

<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
<input type="hidden" name="category_id" value="<?php echo $admin->getIDKEY($category_id); ?>">

<table class="row_a" style="width:100%">
<tr>
        <td class="setting_name" style="width:280px">
                <label for="cat_name" accesskey="n"><b><?php echo $MBTEXT['NAME']; ?>:</b></label>
        </td>
        <td class="setting_name">
                <input type="text" name="cat_name" id="cat_name" value="<?php echo $admin->strip_slashes($fetch_category['cat_name']); ?>" style="width: 98%;" maxlength="255" />
        </td>
</tr>
<tr>
        <td class="setting_name" style="width:280px">
                <label for="cat_name" accesskey="n"><b><?php echo $MBTEXT['CATEGORY_ICON']; ?>:</b></label>
        </td>
        <td class="setting_name">
                <?php
                                if($icon_id=="custom")
                                {
                                        echo '<input type="hidden" name="icon_id" id="icon_id" value="custom" />';
                                        echo '<img id="icon_preview" width="20" src="'.$icon_url.'" border="0" />&nbsp;&nbsp;&nbsp';
                                        echo '<input type="button" value="'.$MBTEXT['CHOOSE_ICON'].'"  onClick="getIcon();" />';
                                }
                                else
                                {
                                        echo '<input type="hidden" name="icon_id" id="icon_id" value="'.$icon_id.'" />';
                                        echo '<img id="icon_preview" width="20" src="'.$icon.'" border="0" />&nbsp;&nbsp;&nbsp';
                                        echo '<input type="button" value="'.$MBTEXT['CHOOSE_ICON'].'"  onClick="getIcon();" />';
                                }
                        ?>
        </td>
</tr>
<tr>
        <td class="setting_name" style="width:280px">
                <label for="cat_name" accesskey="n"><b><?php echo $MBTEXT['CUSTOM_ICON']; ?>:</b></label>
        </td>
        <td class="setting_name">
                <input type="text" name="icon_url" id="icon_url" value="<?php echo $admin->strip_slashes($fetch_category['icon_url']); ?>" onBlur="updateImage();" style="width: 98%;" maxlength="255" />
        </td>
</tr>
<tr>        <td class="setting_name" style="width:280px">
                <label for="cat_name" accesskey="n"><b><?php echo $MBTEXT['ACTIVE']; ?>:</b></label>
        </td>
        <td class="setting_name">
                <input type="radio" value="1" name="active" <?php if ($active == '1') { echo "checked"; } ?>><?php echo $TEXT['YES'];?>
                <input type="radio" value="0" name="active" <?php if ($active == '0') { echo "checked"; } ?>><?php echo $TEXT['NO'];?>
        </td>
</tr>

<table  style="width:100%">
<tr>
        <td align="left">
                <input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;">
        </td>
        <td align="right">
                <input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/modify.php?page_id=<?php echo $page_id; ?>';" style="width: 100px; margin-top: 5px;" />
        </td>
</tr>
</table>
</form>
<?php

// Print admin footer
$admin->print_footer();

?>