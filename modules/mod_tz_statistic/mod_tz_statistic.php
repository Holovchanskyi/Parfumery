<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();

require_once dirname(__FILE__).'/helper.php';

$list            = modTZStatistcHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$doc    = JFactory::getDocument();
$doc -> addStyleSheet(JUri::root().'modules/mod_tz_statistic/css/style.css');
$doc -> addScript('//html5shiv.googlecode.com/svn/trunk/html5.js');
$doc -> addScript(JUri::root().'modules/mod_tz_statistic/js/canvas.js');
$doc -> addScript(JUri::root().'modules/mod_tz_statistic/js/jquery.easing.min.js');
$doc -> addScript(JUri::root().'modules/mod_tz_statistic/js/jquery.easypiechart.min.js');
$doc -> addScript(JUri::root().'modules/mod_tz_statistic/js/resizeimage.js');

$scaleColor = 'false';
if($params -> get('scaleColor')){
    $scaleColor = '"'.$params -> get('scaleColor').'"';
}

$doc -> addStyleDeclaration('
    #TzStatistic'.$module -> id.'.TzStatistic .chart{
        width: '.$params -> get('size',110).'px;
        height: '.$params -> get('size',110).'px;
    }
    video{
      position: absolute;
      }
');

$ratio =  explode(':',$params -> get('video_ratio','360:640'));
$doc -> addScriptDeclaration('jQuery(function(){
        var videoW  = '.$ratio[1].',
            videoH  = '. $ratio[0].';

        jQuery(window).bind("load resize",function(){
            var imgsize = resizeImage(videoW,videoH,jQuery(".tz-video-exception").outerWidth(),jQuery(".tz-video-exception").outerHeight());
            jQuery(".TzStatistic").find("video").css({
               width: imgsize.width,
                height: imgsize.height,
                top: imgsize.top,
                left: imgsize.left
            });
        });
    });');

require JModuleHelper::getLayoutPath('mod_tz_statistic',$params -> get('layout','default'));
