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
class plgSystemHikashopRemarketing extends JPlugin {

	var $name = 0;
	var $pricetax = 0;
	var $pricedis = 0;
	var $cart = 0;
	var $quantityfield = 0;
	var $description = 0;
	var $picture = 0;
	var $link = 0;
	var $border = 0;
	var $badge = 0;
	var $price = 0;
	function plgSystemHikashopRemarketing(&$subject, $config){
		parent::__construct($subject, $config);
		if(!isset($this->params)){
			$plugin = JPluginHelper::getPlugin('system', 'hikashopremarketing');
			if(version_compare(JVERSION,'2.5','<')){
				jimport('joomla.html.parameter');
				$this->params = new JParameter($plugin->params);
			} else {
				$this->params = new JRegistry($plugin->params);
			}
		}
	}

	function onAfterRender() {
		if ($this->params->get('adwordsid') == 0){
			return;
		}
		$app = JFactory::getApplication();

		if ($app->isAdmin()) return true;
		$layout = JRequest::getString('layout');
		if ($layout == 'edit') return true;
		$body = JResponse::getBody();

		if (preg_match_all('#\<input (.*)\/\>#Uis', $body, $matches)) {

			$db = JFactory::getDBO();

			$para=array();
			$matches = $matches[1];
			$nbtag = count($matches);
			for ($i = 0; $i < $nbtag; $i++) {
				if (preg_match_all('#name="product_id"#Uis', $matches[$i], $pattern)) {
					if (preg_match_all('#value="(.*)"#Uis', $matches[$i], $tag)) {
						$para[] = $tag[1][0];
					}
				}
			}
			if (count($para) == 0) {
				return;
			}

			if(!defined('DS'))
				define('DS', DIRECTORY_SEPARATOR);
			if(!include_once(rtrim(JPATH_ADMINISTRATOR,DS).DS.'components'.DS.'com_hikashop'.DS.'helpers'.DS.'helper.php')) return true;

			$para = array_unique($para);
			$tags = array();

			$product_query = 'SELECT * FROM ' . hikashop_table('product') . ' WHERE product_id IN (' . implode(',', $para) . ') AND product_access=\'all\' AND product_published=1 AND product_type=\'main\'';
			$db->setQuery($product_query);
			$products = $db->loadObjectList();
			foreach($products as $k => $product){
				if (is_numeric($product->product_code)) {
					$tags[] = $product->product_code;
				}
			}
			$tags = array_unique($tags);
			if (count($tags) == 0) {
				return;
			}
			$js = '<!-- Google code for remarketingtag -->
<script type="text/javascript">

var google_tag_params = {ecomm_prodid: ['.implode(',', $tags) .']};
var google_conversion_id = '.$this->params->get('adwordsid').';
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;

</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/'.$this->params->get('adwordsid').'/?value=0&guid=ON&script=0"/>
</div>
</noscript>';
			$body = preg_replace('#\<\/body\>#', $js.'</body>', $body, 1);

			JResponse::setBody($body);
		}
	}
}
?>
