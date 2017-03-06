<?php
/**
 * Jlcackle
 *
 * @version 2.4
 * @author Kunicin Vadim(vadim@joomline.ru)
 * @copyright (C) 2011 by Kunicin Vadim(http://www.joomline.ru)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 **/

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

require_once dirname(__FILE__).'/helper.php';

class plgContentJlcackle extends JPlugin
{

	public function onContentPrepare($context, &$article, &$params, $page = 0){
		if($context == 'com_content.article'){
		JPlugin::loadLanguage( 'plg_content_jlcackle' );	
		
		if (!isset($article->catid)) {
			$article->catid='';
		}

		if (strpos($article->text, '{jlcackle-off}') !== false) {
			$article->text = str_replace("{jlcackle-off}","",$article->text);
			return true;
		}

		if (strpos($article->text, '{jlcackle}') === false && !$this->params->def('autoAdd')) {
			return true;
		}

		$exceptcat = is_array($this->params->def('categories')) ? $this->params->def('categories') : array($this->params->def('categories'));
		if (!in_array($article->catid,$exceptcat)) {
			$view = JRequest::getCmd('view');
			if ($view == 'article') {

			$doc = &JFactory::getDocument();
			
	
		switch ($doc ->getlanguage())
			{   	case 'ru-ru' : $langcackle = 'ru';
			break;
				case 'lv-lv' : $langcackle = 'lv';
			break;
				case 'de-de' : $langcackle = 'de';
		    break;
				case 'en-gb' : $langcackle = 'en';
			break;
				case 'uk-UA' : $langcackle = 'uk';
			break;
				case 'be-BY' : $langcackle = 'be';
			break;
				case 'es-ES' : $langcackle = 'es';
			break;
				case 'el-GR' : $langcackle = 'el';
			break;
				case 'fr-FR' : $langcackle = 'fr';
			break;
				case 'ro-RO' : $langcackle = 'ro';
			break;
				case 'hy-AM' : $langcackle = 'hy';
			break;
				case 'ka-GE' : $langcackle = 'ka';
			break;
				default      : $langcackle = 'en';
			break;
			}
				
				
				if ($this->params->def('enabledold')==0) {
					$apiId = $this->params->def('apiId');
					$pagehash = $article->id;
				} else {
					$apiId = $this->params->def('apiId');
					$uri = JURI::getInstance();
					$base = $uri->toString(array('scheme', 'host', 'port'));
					$article_url = $base.urldecode(JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->catslug)));
					$pagehash = $article_url;
				}
				
				$rezhtml = '';
			
				if ($this->params->def('enabledindex')) {
					plgJLCackleHelper::updatecomments($this->params->def('acountapikey'),$this->params->def('siteapikey'),$item_url);					
					$rezhtml = $this->params->def('showindex')==1 ? plgJLCackleHelper::list_jlcackle_com($item_url) : '';
				}
				
				//SSO	
				if ($this->params->def('singlesign')==1) {
					$userinfo =& JFactory::getUser();
					$mcSSOAuth	= plgJLCackleHelper::cackle_auth($this->params->def('siteapikey'),$userinfo);
					$authcackle="var mcSSOAuth = '".$mcSSOAuth."';";
				} else {$authcackle="";}
				//END SSO
				
                $jqtrue = $this->params->def('jqtrue');
                $offindex = $this->params->def('offindex');
				$providers = $this->params->def('providers');
								
                $text='';
				$scriptPage = <<<HTML

				<div id="jlmc-container" style="display:none;">$rezhtml</div>
                  		<div id="mc-container"></div>
					<script type="text/javascript">
					$authcackle
					var mcSite = '$apiId';
					var mcChannel = '$pagehash';
					var mcLocale = '$langcackle';
                    var mcJqueryOff = '$jqtrue';
					var mcProviders = '$providers';
					(function() {
						var mc = document.createElement('script');
						mc.type = 'text/javascript';
						mc.async = true;
						mc.src = 'http://cackle.me/mc.widget-min.js';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mc);
					})();
					</script>
				   $text
HTML;

				
				if ($this->params->def('autoAdd') == 1) {
					$article->text .= $scriptPage;
				} else {
					$article->text = str_replace("{jlcackle}",$scriptPage,$article->text);
				}

			}
		} else {
			$article->text = str_replace("{jlcackle}","",$article->text);
		}

	}
	}

}