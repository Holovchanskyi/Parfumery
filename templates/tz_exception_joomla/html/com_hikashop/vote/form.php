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
$row = & $this->row;
$type_item = $row->type_item;
$hikashop_vote_nb_star = $row->hikashop_vote_nb_star;
$email_comment = $row->email_comment;
$comment_enabled = $row->comment_enabled;
$vote_enabled = $row->vote_enabled;
$hikashop_vote_average_score = $row->hikashop_vote_average_score;
$hikashop_vote_average_score_rounded = $row->hikashop_vote_average_score_rounded;
$hikashop_vote_total_vote = $row->hikashop_vote_total_vote;

$purchased = $row->purchased;
$access_vote = $row->access_vote;
$hikashop_vote_user_id = hikashop_loadUser();

$hide = 0;
if (($access_vote == 'registered' && empty($hikashop_vote_user_id)) || ($access_vote == 'buyed' && $purchased == 0)) {
    $hide = 1;
}

if ($comment_enabled == 1 && !$hide) {

    $hikashop_vote_ref_id = $row->vote_ref_id;
    $hikashop_vote_user_id = hikashop_loadUser();
    if ($hikashop_vote_user_id == '') {
        $hikashop_vote_user_id = 0;
    }

    ?>
    <div id="reload" class="hikashop_vote_form">
    <input type="hidden" name="hikashop_vote_ref_id" id="hikashop_vote_ref_id"
           value="<?php echo $hikashop_vote_ref_id; ?>"/>
    <input type="hidden" name="vote_type" id="vote_type_<?php echo $hikashop_vote_ref_id; ?>"
           value="<?php echo $type_item; ?>"/>
    <input type="hidden" name="hikashop_vote_user_id"
           id="hikashop_vote_user_id_<?php echo $hikashop_vote_ref_id; ?>"
           value="<?php echo $hikashop_vote_user_id; ?>"/>
    <input type="hidden" name="hikashop_vote_ok" id="hikashop_vote_ok_<?php echo $hikashop_vote_ref_id; ?>"
           value="0"/>

    <h3 class="block-head"><?php echo JText::_('TPL_EXEC_HIKASHOP_LET_A_COMMENT'); ?></h3>

    <div id='hikashop_vote_status_form' class="hikashop_vote_notification"></div>

    <?php
    if (hikashop_loadUser() == "") {
        ?>
        <div id="hikashop_comment_form" class="hikashop_comment_form  leave-comment contact-form">
        <div class="hikashop_comment_form_name form-input">
            <label>
                <?php echo JText::_('TPL_EXEC_HIKA_USERNAME'); ?>
            </label>
            <input type='text' name="pseudo_comment" id='pseudo_comment'/>

        </div>
        <?php
        if ($email_comment == 1) {
            ?>
            <div class="hikashop_comment_form_mail form-input">
                <label>
                    <?php echo JText::_('TPL_EXEC_HIKA_EMAIL') ; ?>
                </label>
                <input type='text' name="email_comment" id='email_comment' value=''/>

            </div>
        <?php
        } else {
            ?>
            <input type='hidden' name="email_comment" id='email_comment' value='0'/>
        <?php
        }
        ?>
        <?php
        if ($vote_enabled == 1) {
            echo '<div class="hikashop_vote_stars form-input">';
            echo '<label>'.JText::_('TPL_EXEC_HIKA_VOTE').'</label>';
            echo '<input type="hidden" name="hikashop_vote_rating" data-max="' . $hikashop_vote_nb_star . '" data-type="' . $type_item . '" data-ref="' . $hikashop_vote_ref_id . '" data-rate="' . $hikashop_vote_average_score_rounded . '" id="hikashop_vote_rating_id" />';
            ?>
            </select>
            </div>
            <div class="clear_both"></div>

        <?php
        }
        ?>
        </div>
    <?php
    } else {
        ?>
        <input type='hidden' name="pseudo_comment" id='pseudo_comment' value='0'/>
        <input type='hidden' name="email_comment" id='email_comment' value='0'/>
    <?php
    }
    ?>
    <div class="form-input contact-form">
        <label><?php echo JText::_('TPL_EXEC_HIKA_MESSAGE'); ?></label>
        <textarea type="text" name="hikashop_vote_comment" id="hikashop_vote_comment"
                  class="hikashop_comment_textarea form-input" rows="10"
                  onfocus="clearTextArea(this);"><?php echo JText::_('HIKASHOP_POST_COMMENT'); ?></textarea>
    </div>
    <div class="form-buttons">
        <input class="btn btn-large main-bg" type="button" value="<?php echo JText::_('HIKASHOP_SEND_COMMENT'); ?>"
               onClick="hikashop_send_comment();"/>
    </div>
    </div>

<?php
}
?>


<script type='text/javascript'>
    var clickedIt = false;
    function clearTextArea(id) {
        if (clickedIt == false) {
            id.value = "";
            clickedIt = true;
        }
    }
</script>
