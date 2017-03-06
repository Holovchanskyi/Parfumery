<?php
 /**
 * @package mod_jlvkgroup
 * @author Kunicin Vadim (vadim@joomline.ru), Anton Voynov (anton@joomline.net)
 * @version 2.4
 * @copyright (C) 2010-2013 by JoomLine (http://www.joomline.net)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
// No direct access
defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__).'/helper.php';
$group_id 	= $params->get('group_id');
$width 		= $params->get('width');
$mode 		= $params->get('mode');
$height 	= $params->get('height');
$wide 		= $params->get('wide');
$color1		= $params->get('color1');
$color2 	= $params->get('color2');
$color3 	= $params->get('color3');
$link 		= $params->get('link');
$linknone	= '';

require JModuleHelper::getLayoutPath('mod_jlvkgroup', $params->get('layout', 'default'));
