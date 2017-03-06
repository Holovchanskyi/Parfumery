<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();


if ($list):
    if ($params->get('bg_type') == 1) {
        $bg = ' .our_team {
        background: url(' . JUri::root() . $params->get('bg') . ')  no-repeat fixed 0 0 / cover #fff;
    }';
    } else {
        $bg = ' .our_team {
        background: url(' . JUri::root() . $params->get('bg') . ')  repeat scroll 0 0 #eee;
         border-bottom: 1px solid #e6e6e6;
        border-top: 1px solid #e6e6e6;
    }';
    }
    $doc = JFactory::getDocument();
    $doc->addStyleDeclaration($bg);?>
    <div class="row team-boxes">
        <?php foreach ($list as $item): ?>
            <div class="fx cell-3" data-animate="fadeInDown">
                <div class="team-box-2">
                    <div class="team-img">
                        <img src="<?php echo JUri::root() . $item->employee_image; ?>" alt=""/>
                    </div>
                    <div class="team-details">
                        <h3>
                            <?php echo $item->employee_name; ?>
                        </h3>

                        <div class="t-position">
                            <?php echo $item->employee_career; ?>
                        </div>
                        <?php echo $item->desc; ?>
                        <div class="team-socials">
                            <ul>
                                <li>
                                    <a href="<?php echo $item->facebook; ?>" title="Facebook">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $item->twitter; ?>" title="Twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $item->google; ?>" title="Google">
                                        <i class="fa fa-google"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $item->linkedin; ?>" title="Linkedin">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $item->skype; ?>" title="Skype">
                                        <i class="fa fa-skype"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>