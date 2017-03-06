<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.4.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2015 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><!DOCTYPE html>
<html>
  <head>
    <title>Librairie PHP pour l'API EnvoiMoinsCher</title>
    <meta charset="utf-8">
  </head>
  <body>
<?php
  $userData = parse_ini_file("config.ini");
  ini_set('error_reporting',E_ALL & ~E_NOTICE); 
?>
