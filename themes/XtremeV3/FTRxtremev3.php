<?php

/*--------------------------*/
/* XtremeV3 Footer Section  */
/*--------------------------*/
/* Fixed & Full Width Style */
/*--------------------------*/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

global $customlang, $ThemeInfo, $banners;

if(blocks_visible('right') && !defined('ADMIN_FILE')):

echo '</div>'
    .'  <div class="body-background" style="vertical-align: top;"><img src="'.xtremev3_images_dir.'spacer.gif" style="width:5px; height:1px" border="0" alt=""></div>'
    .'  <div class="body-background" style="vertical-align: top">';
    blocks('right'); 

endif;

echo '  </div>'
    .'  <div style="background-image: url('.xtremev3_images_dir.'sideright.png); vertical-align: top"><img src="'.xtremev3_images_dir.'spacer.gif" style="width:40px; height:5px" alt=""></div>'
    .'</section>'

    .'<footer>'
    
    .'<section id="flex-container">'
    .'  <div class="flex-item"><img src="'.xtremev3_ftr_images.'FTRbartop_01.png" style="width: 114px; height: 23px;"></div>'
    .'  <div class="flex-item" style="width: 100%; height: 23px; background-image: url('.xtremev3_ftr_images.'FTRbartop_Bg_Stretch.png)"></div>'
    .'  <div class="flex-item"><img src="'.xtremev3_ftr_images.'FTRbartop_03.png" style="width: 114px; height: 23px;"></div>'
    .'</section>'

    .'<section id="flex-container">'
    .'  <div class="flex-item"><img src="'.xtremev3_ftr_images.'FTR_01.png" style="width: 35px; height: 71px;"></div>'
    .'  <div class="flex-item" style="width: 100%; height: 71px; background-image: url('.xtremev3_ftr_images.'FTR_Bg_Stretch.png)">'
    .'    <div align="left" style="line-height: 28px; padding-top:8px; padding-left:20px;"><span style="color: #F1F1F1">'.$ThemeInfo['fms1'].'<br />'.$ThemeInfo['fms2'].'<br /></span></div>'
    .'  </div>'
    .'  <div class="flex-item" style="width: 58px; height: 71px; background-image: url('.xtremev3_ftr_images.'FTR_Copyright.png); padding-right: 20px;">'
    .'    <div style="padding-top:46px;">'
    .'      <a class="copyright" href="javascript: void(0)" onclick="window.open(\''.xtremev3_theme_dir.'copyrights.php\', \'windowname1\', \'width=800, height=500\'); return false;">'
    .'        <span class="tooltip-html" title="'.xtremev3_copyright_click.'">'.$customlang['global']['copyrights'].'</span>'
    .'      </a>'
    .'    </div>'
    .'  </div>'
    .'  <div class="flex-item"><img src="'.xtremev3_ftr_images.'FTR_04.png" style="width: 35px; height: 71px;"></div>'
    .'</section>'

    .'<section id="flex-container">'
    .'  <div class="flex-item"><img src="'.xtremev3_ftr_images.'FTRbarbtm_01.png" style="width: 114px; height: 15px;"></div>'
    .'  <div class="flex-item" style="width: 100%; height: 15px; background-image: url('.xtremev3_ftr_images.'FTRbarbtm_Bg_Stretch.png)">'
    .'    <div class="tooltip-html center" style="font-size: xx-small;" title="'.xtremev3_copyright.'"><span style="color: #141B05;">'.str_replace('<br />', '', xtremev3_copyright).'</span></div>'
    .'  </div>'
    .'  <div class="flex-item"><img src="'.xtremev3_ftr_images.'FTRbarbtm_03.png" style="width: 114px; height: 15px;"></div>'
    .'</section>'

    .'</footer>'

    .'</div>';

    if (!empty($banners)):
        echo '<div class="center">'.ads(2).'</div>';
    endif;

?>