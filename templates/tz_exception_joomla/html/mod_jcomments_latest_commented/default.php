<?php
// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(PLAZART_TEMPLATE_REL . '/libraries/helpers');

$name_cm = JHtml::_('TZ.getJComment', $params);

?>
<div class="widget r-comments-w fx" data-animate="fadeInRight">

    <div class="widget-content">
        <?php if (!empty($name_cm)) : ?>
            <ul class="jcomments-latest-commented<?php echo $params->get('moduleclass_sfx'); ?>">
                <?php foreach ($name_cm as $i => $item) :  ?>
                    <li>
                        <div class="left"><i class="<?php echo JText::_('COMMENT_JCOMMENT_RECENT_LABEL')?>"></i></div>
                        <h5><?php echo JText::sprintf('NAME_COMMENTS_LABEL',$item->name);?>
                            <a href="<?php echo $item->link; ?>#comments">
                                <?php if ($params->get('showCommentsCount')) : ?>
                                    <?php echo $item->title; ?>&nbsp;(<?php echo $item->commentsCount; ?>)
                                <?php else : ?>
                                    <?php echo $item->title; ?>
                                <?php endif; ?>
                            </a>
                        </h5><span><i class="<?php echo JText::_('DATE_JCOMMENT_RECENT_LABEL')?>"></i><?php echo JHtml::_('date',$item->date,'JCOMMENT_FORMAT_DATE');?></span>

                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>