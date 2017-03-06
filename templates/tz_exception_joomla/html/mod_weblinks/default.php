<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_weblinks
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . 'modules/mod_tz_testimonial/js/slick.min.js');
?>
<div class="weblinks<?php echo $moduleclass_sfx; ?> clients">
    <?php foreach ($list as $item) : ?>
        <div>
            <?php
            $link = $item->link;

            switch ($params->get('target', 3)) {
                case 1:
                    // Open in a new window
                    echo '<a href="' . $link . '" target="_blank" rel="' . $params->get('follow', 'nofollow') . '" class="white-bg">' .
                        htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') . '</a>';
                    break;

                case 2:
                    // Open in a popup window
                    echo "<a class=\"white-bg\" href=\"#\" onclick=\"window.open('" . $link . "', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\">" .
                        htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') . '</a>';
                    break;

                default:
                    // Open in parent window
                    echo '<a class="white-bg" href="' . $link . '" rel="' . $params->get('follow', 'nofollow') . '">' .
                        htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8') . '</a>';
                    break;
            }

            if ($params->get('description', 0)) {
                echo nl2br($item->description);
            }

            if ($params->get('hits', 0)) {
                echo '(' . $item->hits . ' ' . JText::_('MOD_WEBLINKS_HITS') . ')';
            }
            ?>
        </div>
    <?php endforeach; ?>
    <script type="text/javascript">
        jQuery('.clients').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            touchMove: true,
            slidesToScroll: 5,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
</div>
