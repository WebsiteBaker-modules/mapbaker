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
 * @version         $Id: icons.php 2014-01-11 17:30:50Z David Felix/Jacobi22 $
 * @lastmodified    $Date: 2014-01-10 17:30:50 (Sa, 11 Jan 2014) $
 *
 */

include("../../config.php");

echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title>Icons</title>
<script type="text/javascript">

        function returnIconId(id,image)
        {
                window.opener.document.getElementById("icon_id").value= id;
                window.opener.document.getElementById("icon_preview").src= image;
                window.opener.document.getElementById("icon_url").value="";

                window.close();
        }


</script>
<meta http-equiv="content-type" content="text/html; utf-8"/>
</head>
<body>';
echo '<table border="0"><tr>';
$result = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_icons`");

if($result->numRows() > 0) {
        $a = 0;
        while($settings = $result->fetchRow()) {
                if (stristr($settings['icon'],'[gmap-markers]')) {
                        $gmapmatkerpath = WB_URL.MEDIA_DIRECTORY.'/gmap-markers';
                        $settings['icon'] = str_replace('[gmap-markers]', $gmapmatkerpath, $settings['icon']);
                }
                echo '<td align="center"><a href="javascript: returnIconId(\''.$settings['icon_id'].'\',\''.$settings['icon'].'\');"><img src="'.$settings['icon'].'" border="0" /></a></td>';
                $a++;
                if ($a == 8) {
                        echo "</tr>\n<tr>";
                        $a = 0;
                }
        }
}
echo '</tr></table>';
echo '</body></html>';
?>