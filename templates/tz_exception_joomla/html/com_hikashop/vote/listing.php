<?php
/**
 * @package    HikaShop for Joomla!
 * @version    2.3.3
 * @author    hikashop.com
 * @copyright    (C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
$current_url = hikashop_currentURL();
$set = JRequest::getString('sort_comment', '');
$config = JFactory::getConfig();
if (HIKASHOP_J30) {
    $sef = $config->get('sef');
} else {
    $sef = $config->getValue('config.sef');
}

if (!empty($set)) {
    if ($sef) {
        $current_url = preg_replace('/\/sort_comment-' . $set . '/', '', $current_url);
    } else {
        $current_url = preg_replace('/&sort_comment=' . $set . '/', '', $current_url);
    }
}
$row = & $this->rows;
$elt = & $this->elts;
$pagination = & $this->pagination;
$no_comment = 1;

$hikashop_vote_con_req_list = $row->hikashop_vote_con_req_list;
$useful_rating = $row->useful_rating;
$comment_enabled = $row->comment_enabled;
$useful_style = $row->useful_style;
$show_comment_date = $row->show_comment_date;

if ($comment_enabled == 1) {
    $hikashop_vote_user_id = hikashop_loadUser();
    if (($hikashop_vote_con_req_list == 1 && $hikashop_vote_user_id != "") || $hikashop_vote_con_req_list == 0) {
        ?>
        <div class="hikashop_listing_comment ui-corner-top"><?php echo JText::_('TPL_EXEC_HIKASHOP_LISTING_COMMENT'); ?>
            <?php if ($row->vote_comment_sort_frontend) { ?>
                <span style="float: right;" class="hikashop_sort_listing_comment">
				<?php
                if ($sef)
                    echo '<select name="sort_comment" onchange="var url=\'' . $current_url . '\'+\'/sort_comment-\'+this.value;  document.location.href=\'' . JRoute::_('\'+url+\'') . '\'">';
                else
                    echo '<select name="sort_comment" onchange="var url=\'' . $current_url . '\'+\'&sort_comment=\'+this.value;  document.location.href=\'' . JRoute::_('\'+url+\'') . '\'">';
                ?>
                    <option <?php if ($set == 'date') echo "selected"; ?>
                        value="date"><?php echo JText::_('HIKASHOP_COMMENT_ORDER_DATE'); ?></option>
				<option <?php if ($set == 'helpful') echo "selected"; ?>
                    value="helpful"><?php echo JText::_('HIKASHOP_COMMENT_ORDER_HELPFUL'); ?></option>
                    </select>
			</span>
            <?php } ?>
        </div>
        <ul class="comment-list ">
            <?php
            for ($i = 1; $i <= count($elt); $i++) {
                if (!empty ($elt[$i]->vote_comment)) {
                    ?>
                    <li>
                        <article class="comment">
                            <div class="comment-content">

                                <h5 class="comment-author skew-25">
                                        <span class="author-name skew25">
                                        <?php if ($elt[$i]->vote_pseudo == '0') { ?>
                                            <?php echo $elt[$i]->username; ?>
                                        <?php } else { ?>
                                            <?php echo $elt[$i]->vote_pseudo; ?>
                                        <?php } ?>
                                    </span>

                                    <div class="hika_comment_listing_stars ui-rating">
                                        <?php
                                        $nb_star_vote = $elt[$i]->vote_rating;
                                        JRequest::setVar("nb_star", $nb_star_vote);
                                        $nb_star_config = $row->vote_star_number;
                                        JRequest::setVar("nb_max_star", $nb_star_config);
                                        if ($nb_star_vote != 0) {
                                            for ($k = 0; $k < $nb_star_vote; $k++) {
                                                ?><a class="ui-rating-full skew25"></a><?php
                                            }
                                            $nb_star_empty = $nb_star_config - $nb_star_vote;
                                            if ($nb_star_empty != 0) {
                                                for ($j = 0; $j < $nb_star_empty; $j++) {
                                                    ?><a class="ui-rating-empty skew25"></a><?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php if ($show_comment_date) { ?>

                                        <span class="comment-date skew25">
                                            <?php
                                            $class = hikashop_get('class.vote');
                                            $vote = $class->get($elt[$i]->vote_id);
                                            echo hikashop_getDate($vote->vote_date);
                                            ?>
                                        </span>

                                    <?php } ?>
                                </h5>
                                <p>
                                    <?php echo $elt[$i]->vote_comment; ?>
                                </p>
                            </div>
                        </article>
                    </li>
                    <?php
                    $no_comment = 0;
                }
            }?>
        </ul>
        <?php $later = '';
        if ($no_comment == 1) {?>
            <?php echo JText::_('HIKASHOP_NO_COMMENT_YET'); ?>
        <?php
        } else {
            $this->pagination->form = '; document.hikashop_comment_form';
            $later = '<div class="pagination">' . $this->pagination->getListFooter() . $this->pagination->getResultsCounter() . '</div>';
            echo $later;
        }
    }
}
?>
