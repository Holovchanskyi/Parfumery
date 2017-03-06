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
JHTML::_('behavior.tooltip');
$row =& $this->rows;
$vote_enabled = $row->vote_enabled;
$config = hikashop_config();
$vote_status = $config->get('enable_status_vote', 'vote');
if($vote_enabled != 1)
	return;

$hikashop_vote_average_score = (float)hikashop_toFloat($row->hikashop_vote_average_score);
$hikashop_vote_average_score_rounded = $row->hikashop_vote_average_score_rounded;
JRequest::setVar("rate_rounded",$hikashop_vote_average_score_rounded);
$hikashop_vote_total_vote = $row->hikashop_vote_total_vote;
$hikashop_vote_nb_star = $row->hikashop_vote_nb_star;
JRequest::setVar("nb_max_star",$hikashop_vote_nb_star);

$type_item = $row->type_item;
$hikashop_vote_ref_id = $row->vote_ref_id;

$main_div_name = $row->main_div_name;
$hikashop_vote_user_id = hikashop_loadUser();
$listing_true = $row->listing_true;
$select_id = "select_id_".$hikashop_vote_ref_id;
if($main_div_name != '' ){
	$select_id .= "_".$main_div_name;
}else{
	$select_id .= "_hikashop_main_div_name";
}

if($vote_status != 'both') {
	if(empty($main_div_name)){ ?>
		<input 	type="hidden" id="hikashop_vote_ref_id" value="<?php echo $hikashop_vote_ref_id;?>"/>
<?php } ?>
	<input 	type="hidden" id="hikashop_vote_ok_<?php echo $hikashop_vote_ref_id;?>" value="0"/>
	<input 	type="hidden" id="vote_type_<?php echo $hikashop_vote_ref_id;?>" value="<?php echo $type_item; ?>"/>
	<input 	type="hidden" id="hikashop_vote_user_id_<?php echo $hikashop_vote_ref_id;?>" value="<?php echo $hikashop_vote_user_id;?>"/>

	<div class="hikashop_vote_stars">
		<input type="hidden" name="hikashop_vote_rating" data-type="<?php echo $type_item; ?>" data-max="<?php echo $hikashop_vote_nb_star; ?>" data-ref="<?php echo $hikashop_vote_ref_id;?>" data-rate="<?php echo $hikashop_vote_average_score_rounded; ?>" id="<?php echo $select_id;?>" />
		<span class="hikashop_total_vote">(<?php echo JHTML::tooltip($hikashop_vote_average_score.'/'.$hikashop_vote_nb_star, JText::_('VOTE_AVERAGE'), '', ' '.$hikashop_vote_total_vote.' '); ?>) </span>
		<span id="hikashop_vote_status_<?php echo $hikashop_vote_ref_id;?>" class="hikashop_vote_notification_mini"></span>
	</div>
<?php
} else { ?>
	<div class="hikashop_vote_stars">
		<div class="ui-rating"><?php
			for($i = 1; $i <= $hikashop_vote_average_score_rounded; $i++) {
				echo '<span class="ui-rating-star ui-rating-full"></span>';
			}
			for($i = $hikashop_vote_average_score_rounded; $i < $hikashop_vote_nb_star; $i++) {
				echo '<span class="ui-rating-star ui-rating-empty"></span>';
			}
		?></div>
		<span class="hikashop_total_vote">(<?php echo JHTML::tooltip($hikashop_vote_average_score.'/'.$hikashop_vote_nb_star, JText::_('VOTE_AVERAGE'), '', ' '.$hikashop_vote_total_vote.' '); ?>) </span>
	</div>
<?php
}
