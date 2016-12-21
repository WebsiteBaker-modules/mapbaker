<?php

/*
 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2007, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Must include code to stop this file being access directly
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

// Load Language file
if(LANGUAGE_LOADED) {
    require_once(WB_PATH.'/modules/mapbaker/languages/EN.php');
    if(file_exists(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php')) {
        require_once(WB_PATH.'/modules/mapbaker/languages/'.LANGUAGE.'.php');
    }
}

//Delete empty records
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_categories  WHERE section_id = '$section_id' and cat_name=''");
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_markers  WHERE cat_id = 0 and marker=''");
$database->query("DELETE FROM ".TABLE_PREFIX."mod_map_geofeeds  WHERE geofeed = '' and url=''");

//Settings should have been added in add.php, here query once again.
$query_settings = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_map_settings WHERE section_id='$section_id'");
if( $query_settings->numRows() == 0 ) {
        $database->query("INSERT INTO ".TABLE_PREFIX."mod_map_settings VALUES($section_id,'','','','')");
}

?>


<?php
// Loop through existing links
//$query_cats = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_categories` WHERE section_id='$section_id' ORDER BY pos ASC");
$query_cats = $database->query("SELECT "
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
." LEFT JOIN ".TABLE_PREFIX."mod_map_icons "
." ON ".TABLE_PREFIX."mod_map_categories.icon_id=".TABLE_PREFIX."mod_map_icons.icon_id "
." WHERE section_id='$section_id' "
." ORDER BY ".TABLE_PREFIX."mod_map_categories.pos ASC");

if($query_cats->numRows() > 0) {
         $ii = 1;
        while($cat = $query_cats->fetchRow()) {
        $category_id = $admin->getIDKEY($cat['cat_id']);
                $icon_id = $admin->strip_slashes($cat['icon_id']);
                $icon_url = $admin->strip_slashes($cat['icon_url']);
                $icon = $admin->strip_slashes($cat['icon']);

                ?>
                <table class=" mapbaker mapbaker_cat_markers" cellpadding="2" cellspacing="0" border="0" width="100%">
				
						<?php $active = $cat['active']; 
                        echo '<tr class="mapbaker_cat mapbaker_active'.$active.'"><td class="mapbaker_cat_icon" width="35" nowrap>';                            

                                if($icon_id=="custom")  {
                                    echo '<img src="'.$cat['icon_url'].'" border="0" width="20">';
                                }  else  {
                                    echo '<img src="'.$cat['icon'].'" border="0" width="20">';
                                }
								
                                ?>
                                </td>
                                <td class="mapbaker_status" width="40" nowrap>                                
                                <?php
                                if($admin->strip_slashes($cat['active'])=='1') {
                                      echo '<img src="'.THEME_URL.'/images/visible_16.png" border="0" alt="'.$TEXT['ENABLED'].'" /> ';
                                } else {
                                                echo '<img src="'.THEME_URL.'/images/hidden_16.png" border="0" alt="'.$TEXT['DISABLED'].'" /> ';
                                } ?>
                                <a href="<?php echo WB_URL; ?>/modules/mapbaker/modify_category.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&category_id=<?php echo $category_id; ?>"><img src="<?php echo THEME_URL; ?>/images/modify_16.png" border="0" alt="" /></a>
                                </td>
                                <td class="mapbaker_name"   nowrap>
								 <div><?php echo $admin->strip_slashes($cat['cat_name']);?></div>                                
                                </td>
								<td class="mapbaker_coords" width="200" nowrap>Latitude / Longitude</td>
								
								
                                <td class="mapbaker_pos" width="25" nowrap>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/move_up.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&category_id=<?php echo $category_id; ?>" title="<?php echo $TEXT['MOVE_UP']; ?>">
                                        <?php
                                        if($ii > 1) { ?>
                                                <img src="<?php echo THEME_URL; ?>/images/up_16.png" border="0" alt="^" />
                                                <?php ;} ?>
                                        </a>
										  </td>
                               <td class="mapbaker_pos" width="25" nowrap>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/move_down.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&category_id=<?php echo $category_id; ?>" title="<?php echo $TEXT['MOVE_DOWN']; ?>">
                                         <?php if($ii < $query_cats->numRows()) { ?>
                                                <img src="<?php echo THEME_URL; ?>/images/down_16.png" border="0" alt="v" />
                                        <?php ;} ?>
                                        </a>
								 </td>
								  <td class="mapbaker_del" width="40" nowrap>		
                                        <a href="javascript: confirm_link('<?php echo $TEXT['ARE_YOU_SURE']; ?>', '<?php
                                            echo WB_URL; ?>/modules/mapbaker/delete_category.php?page_id=<?php echo $page_id; ?>&amp;section_id=<?php
                                            echo $section_id; ?>&amp;category_id=<?php echo $category_id; ?>');" title="<?php
                                            echo $TEXT['DELETE']; ?>">
											<img style="float:right" src="<?php echo THEME_URL; ?>/images/delete_16.png" border="0" alt="X" />
                                        </a>
									</td>
                        </tr>
               
                <?php
                $query_pins = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_markers` WHERE section_id='$section_id' AND cat_id='".$cat['cat_id']."' ORDER BY pos ASC");
                if($query_pins->numRows() > 0)
                {
                        $row = 'a';
                        $ia = 1;
                        while($pin = $query_pins->fetchRow())  {
                        //	$active = $admin->strip_slashes(substr(strip_tags($pin['active']),0,5)); //
							$active = $pin['active']; 
							echo '<tr class="mapbaker_marker mapbaker_active'.$active.'" row_'.$row.'">';
                        ?>
                       
						 <td class="mapbaker_cat_icon" width="35" nowrap>&nbsp;</td>
						
                                <td class="mapbaker_status" nowrap>
									<?php  if($active=='1') {
												echo '<img src="'.THEME_URL.'/images/visible_16.png" border="0" alt="'.$TEXT['ENABLED'].'" /> ';
											} else {
												echo '<img src="'.THEME_URL.'/images/hidden_16.png" border="0" alt="'.$TEXT['DISABLED'].'" /> ';
											}
                                        ?>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/modify_marker.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&marker_id=<?php echo $admin->getIDKEY($pin['marker_id']); ?>">
                                                <img src="<?php echo THEME_URL; ?>/images/modify_16.png" border="0" alt="Modify - " />
                                        </a>
                                </td>
                                
                                <td class="mapbaker_name" >
										<?php echo $pin['marker_id']; ?>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/modify_marker.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&marker_id=<?php echo $admin->getIDKEY($pin['marker_id']); ?>">
                                                <?php echo $admin->strip_slashes(substr(strip_tags($pin['marker']),0,40)); ?>
                                        </a>
                                </td>
                                <td class="mapbaker_coords">
                                        <?php echo $admin->strip_slashes(substr(strip_tags($pin['latitude']),0,8)); ?> /                               
                                        <?php echo $admin->strip_slashes(substr(strip_tags($pin['longitude']),0,8)); ?>
                                </td>
                               
                               <td class="mapbaker_pos" width="25" nowrap>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/move_up.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&marker_id=<?php echo $admin->getIDKEY($pin['marker_id']); ?>" title="<?php echo $TEXT['MOVE_UP']; ?>">
                                        <?php
                                        if($ia > 1) { ?>
                                                <img src="<?php echo THEME_URL; ?>/images/up_16.png" border="0" alt="^" />
                                                <?php ;} ?>
                                        </a>
                                </td>
                               <td class="mapbaker_pos" width="25" nowrap>
                                        <?php

                                        if($ia < $query_pins->numRows()) { ?>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/move_down.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&marker_id=<?php echo $admin->getIDKEY($pin['marker_id']); ?>" title="<?php echo $TEXT['MOVE_DOWN']; ?>">

                                                <img src="<?php echo THEME_URL; ?>/images/down_16.png" border="0" alt="v" />
                                        </a>
                                        <?php ;} ?>
                                </td>
                                  <td class="mapbaker_del" width="40" nowrap>
                                <a href="javascript: confirm_link('<?php echo $TEXT['ARE_YOU_SURE']; ?>', '<?php
                                            echo WB_URL; ?>/modules/mapbaker/delete_marker.php?page_id=<?php echo $page_id; ?>&amp;section_id=<?php
                                            echo $section_id; ?>&amp;marker_id=<?php echo $pin['marker_id']; ?>');" title="<?php
                                            echo $TEXT['DELETE']; ?>">
                                             <img style="float:right" src="<?php echo THEME_URL; ?>/images/delete_16.png" border="0" alt="X" />
                                        </a>
                                </td>
                        </tr>
                        <!-- end of ONE marker! -->
                        <?php
                        // Alternate row color
                        if($row == 'a') { $row = 'b'; } else { $row = 'a'; }
                        $ia++;
                }
        } else {
                echo '<i>'.$TEXT['NONE_FOUND'].'</i>';
        }
        $ii++;
        ?>
</table>
<br />


<?php
        }

} else {
        echo '<i>'.$TEXT['NONE_FOUND'].'</i>';
}

?>



<input type="button" style="width: 25%;" value="<?php echo $MBTEXT['ADD_MARKER']; ?>" onclick="javascript: window.location = '<?php echo WB_URL; ?>/modules/mapbaker/add_marker.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';"  />
<input type="button" style="width: 25%;" value="<?php echo $MBTEXT['NEW_CATEGORY']; ?>" onclick="javascript: window.location = '<?php echo WB_URL; ?>/modules/mapbaker/add_category.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" />
      
<input type="button" style="width: 25%; float:right;"  value="<?php echo $MBTEXT['SETTINGS']; ?>" onclick="javascript: window.location = '<?php echo WB_URL; ?>/modules/mapbaker/modify_settings.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';"  />


<br /><hr />



<table class="mapbaker mapbaker_geofeeds" cellpadding="2" cellspacing="0" border="0" width="100%">
                <?php
                $query_feeds = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_map_geofeeds` WHERE section_id='$section_id' ORDER BY pos ASC");
                if($query_feeds->numRows() > 0) {				
				
                        $row = 'a';

                        $ib = 1;
                        while($feed = $query_feeds->fetchRow())
                        {
                        $geofeed_id = $admin->getIDKEY($feed['geofeed_id']);

                                $active = $admin->strip_slashes(substr(strip_tags($feed['active']),0,5));
                        ?>
                        <tr class="row_<?php echo $row; ?>" height="20">
						 	 <td class="mapbaker_cat_icon" width="35" nowrap>&nbsp;</td>
                                 <td class="mapbaker_status" width="40" nowrap>
									 <?php if($active=='1') {
                                                        echo '<img src="'.THEME_URL.'/images/visible_16.png" border="0" alt="'.$TEXT['ENABLED'].'" title="'.$TEXT['ENABLED'].'" /> ';
                                              }  else {
                                                        echo '<img src="'.THEME_URL.'/images/hidden_16.png" border="0" alt="'.$TEXT['DISABLED'].'" title="'.$TEXT['DISABLED'].'" /> ';
													}
                                        ?>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/modify_geofeed.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&geofeed_id=<?php echo $geofeed_id; ?>">
                                                <img src="<?php echo THEME_URL; ?>/images/modify_16.png" border="0" alt="<?php echo $TEXT['MODIFY']; ?> - <?php echo $admin->strip_slashes(substr(strip_tags($feed['geofeed']),0,100)); ?>" title="<?php echo $TEXT['MODIFY']; ?> - <?php echo $admin->strip_slashes(substr(strip_tags($feed['geofeed']),0,100)); ?>" />
                                        </a>
                                </td>
                                 <td class="mapbaker_name"   nowrap>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/modify_geofeed.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&geofeed_id=<?php echo $geofeed_id; ?>">
                                                <?php echo $admin->strip_slashes(substr(strip_tags($feed['geofeed']),0,100)); ?>
                                        </a>
                                </td>
                                <td>
                                        <?php echo $admin->strip_slashes(substr(strip_tags($feed['url']),0,255)); ?>
                                </td>
                               
                               <td class="mapbaker_pos" width="25" nowrap>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/move_up.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&geofeed_id=<?php echo $geofeed_id; ?>" title="<?php echo $TEXT['MOVE_UP']; ?>">
                                          <?php
                                               if($ib > 1) { ?>
                                          <img src="<?php echo THEME_URL; ?>/images/up_16.png" border="0" alt="^" />
                                          <?php } ?>
                                        </a>
                                </td>
                                <td class="mapbaker_pos" width="25" nowrap>
                                        <a href="<?php echo WB_URL; ?>/modules/mapbaker/move_down.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&geofeed_id=<?php echo $geofeed_id; ?>" title="<?php echo $TEXT['MOVE_DOWN']; ?>">
                                               <?php if($ib < $query_feeds->numRows()) { ?>
                                                <img src="<?php echo THEME_URL; ?>/images/down_16.png" border="0" alt="v" />
                                               <?php } ?>

                                        </a>
                                </td>
                               <td class="mapbaker_del" width="40" nowrap>
                                <a href="javascript: confirm_link('<?php echo $TEXT['ARE_YOU_SURE']; ?>', '<?php
                                            echo WB_URL; ?>/modules/mapbaker/delete_geofeed.php?page_id=<?php echo $page_id; ?>&amp;section_id=<?php
                                            echo $section_id; ?>&amp;geofeed_id=<?php echo $geofeed_id; ?>');" title="<?php
                                            echo $TEXT['DELETE']; ?>">


                                                <img style="float:right" src="<?php echo THEME_URL; ?>/images/delete_16.png" border="0" alt="X" />

                                        </a>
                                </td>
                        </tr>
                        <!-- end of ONE geofeed! -->
                        <?php
                        // Alternate row color
                        if($row == 'a') { $row = 'b'; } else { $row = 'a'; }
                        $ib++;
                }
        } else {
                echo '<i>'.$TEXT['NONE_FOUND'].'</i>';
        }
        ?>

</table>
<br />
<input style="width: 50.5%;" type="button" value="<?php echo $MBTEXT['ADD_GEOURL']; ?>" onclick="javascript: window.location = '<?php echo WB_URL; ?>/modules/mapbaker/add_geofeed.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';"  />

