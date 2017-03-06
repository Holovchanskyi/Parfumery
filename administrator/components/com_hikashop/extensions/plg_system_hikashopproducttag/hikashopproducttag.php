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
defined('_JEXEC') or die('Restricted access');
?>
<?php

class plgSystemHikashopproducttag extends JPlugin {
	function onHikashopBeforeDisplayView(&$view){
		$option = JRequest::getString('option');
		$ctrl = JRequest::getString('ctrl');
		$task = JRequest::getString('task');

		if ($option!='com_hikashop'||$ctrl!='product'||$task!='show') return;

		ob_start();
	}
	function onHikashopAfterDisplayView(&$view){
		$option = JRequest::getString('option');
		$ctrl = JRequest::getString('ctrl');
		$task = JRequest::getString('task');

		if ($option!='com_hikashop'||$ctrl!='product'||$task!='show') return;

		$config =& hikashop_config();
		$default_params = $config->get('default_params');

		$product_page = ob_get_clean();

		$product_page_parts = explode('class="hikashop_product_page ', $product_page);
		if(!empty($product_page_parts[1])){
			$product_page_parts[1] = 'itemscope itemtype="http://schema.org/Product" class="hikashop_product_page ' .$product_page_parts[1];

			$pattern='/id="hikashop_product_name_main"/';
			$replacement='id="hikashop_product_name_main" itemprop="name"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);
			if($default_params['show_price'] == 1){
				$currency_id = hikashop_getCurrency();
				$null = null;
				$currencyClass = hikashop_get('class.currency');
				$currencies = $currencyClass->getCurrencies($currency_id,$null);
				$data=$currencies[$currency_id];

				$pattern='/<span id="hikashop_product_price_main" class="hikashop_product_price_main">/';
				$replacement= '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span id="hikashop_product_price_main" class="hikashop_product_price_main"><meta itemprop="priceCurrency" content="'.$data->currency_code.'" />';
				$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);
				$pattern='/<(span|div) id="(hikashop_product_weight_main|hikashop_product_width_main|hikashop_product_length_main|hikashop_product_height_main|hikashop_product_characteristics|hikashop_product_options|hikashop_product_custom_item_info|hikashop_product_price_with_options_main|hikashop_product_quantity_main)"/';
				$replacement='</div> <$1 id="$2"';
				$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);
				$pattern='/class="hikashop_product_price_main"(.*)class="hikashop_product_price hikashop_product_price_0/msU';
				$replacement='class="hikashop_product_price_main" $1 itemprop="price" class="hikashop_product_price hikashop_product_price_0';
				$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);
			}
			$pattern='/id="hikashop_product_vote_listing"/';
			$replacement='id="hikashop_product_vote_listing" itemprop="reviews" itemscope itemtype="http://schema.org/Review"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);

			$pattern='/class="ui-corner-all hika_comment_listing"/';
			$replacement='class="ui-corner-all hika_comment_listing" itemprop="reviews" itemscope itemtype="http://schema.org/Review"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1]);
			$pattern='/class="hikashop_vote_listing_comment"/';
			$replacement='class="hikashop_vote_listing_comment" itemprop="description"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1]);

			$pattern='/class="hika_comment_listing_content"/';
			$replacement='class="hika_comment_listing_content" itemprop="description"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1]);
			$pattern='/class="hikashop_vote_listing_username"/';
			$replacement='class="hikashop_vote_listing_username" itemprop="author"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1]);

			$pattern='/class="hika_vote_listing_username"/';
			$replacement='class="hika_vote_listing_username" itemprop="author"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1]);
			$pattern='/class="hikashop_product_description_main"/';
			$replacement='class="hikashop_product_description_main" itemprop="description"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);
			$pattern='/class="hikashop_vote_stars"/';
			$replacement='class="hikashop_vote_stars" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);
			$pattern='/id="hikashop_main_image"/';
			$replacement='id="hikashop_main_image" itemprop="image"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1]);

			$ratemax=JRequest::getVar("nb_max_star");//nbmax
			$raterounded=JRequest::getVar("rate_rounded");//moy
			$pattern='/(<span\s+class="hikashop_total_vote")/iUs';
			$replacement = '<span style="display:none" itemprop="ratingValue">'.$raterounded.'</span><span style="display:none" itemprop="bestRating">'.$ratemax.'</span>$1 itemprop="reviewCount"';
			$product_page_parts[1] = preg_replace($pattern,$replacement,$product_page_parts[1],1);


		}
		foreach($product_page_parts as $parts){
			echo $parts;
		}
	}
}
