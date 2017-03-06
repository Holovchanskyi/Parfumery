<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.4.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2015 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
function autoload($className) {
  $path = explode("_", $className);
  $last = count($path) - 1;
  $className = $path[$last];
  unset($path[$last]);
  $classPath = implode("/", $path);
  require_once("../".strtolower($classPath)."/".$className.".php");
} 
spl_autoload_register('autoload'); 
?>
