<?php

/*------------------------------------------------------------------------

# MOD_TZ_NEW_PRO Extension

# ------------------------------------------------------------------------

# author    tuyennv

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

$maxheight = $params->get('height_item_portfolio', 450);
$TzNewTitle = $params->get('portfolio_title');
$TzNewLink = $params->get('portfolio_link_text');
$TzNewLinkItemID = $params->get('portfolio_link');
$default_width = $params->get('tz_new_portfolio_width', '400');
$default_height = $params->get('tz_new_portfolio_height', '376');
$show_all_product = $params->get('show_portfolio_readmore', 1);
$portfolio_fix_height = $params->get('portfolio_fix_height', 1);
$menus = JMenu::getInstance('site');
$TzNewLinkItem = $menus->getItem($TzNewLinkItemID);
$show_portfolio_filter = $params->get('show_portfolio_filter', 1);
$portfolio_margin = $params->get('portfolio_margin', '4px 2px');
$show_portfolio_feature = $params->get('show_portfolio_feature', 1);
$portfolio_show_all = $params->get('portfolio_show_all', 'All');
$portfolio_view_project = $params->get('portfolio_view_project', 'View Projects');
$show_portfolio_featured = $params->get('show_portfolio_featured', 1);

$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/modules/mod_tz_news_pro/js/jquery.isotope.js');
$doc->addScript(JUri::base() . '/modules/mod_tz_news_pro/js/resizeimage.js');
$doc->addScript(JUri::base() . '/modules/mod_tz_news_pro/js/tz_new_portfolio.js');

if ($portfolio_fix_height == 1) {
    $doc->addStyleDeclaration('
        .item .TzInner, #home_content_portfolio .portfolio_content{height:' . $default_height . 'px}
        #home_content_portfolio .item .TzInner{
            margin:' . $portfolio_margin . ';
        }
    ');
}

?>
<?php if (isset($list) && !empty($list)) {
    $ids = '';
    $d = 1;
    foreach ($list as $item) {
        if ($d == 1) {
            $ids .= $item->contentid;
        } else {
            $ids .= ',' . $item->contentid;
        }
        $d++;
    }
    $db = JFactory::getDbo();
    $query = "SELECT DISTINCT tagsid, name, published FROM #__tz_portfolio_tags_xref AS tx LEFT JOIN #__tz_portfolio_tags  AS pt ON (tx.tagsid = pt.id) WHERE contentid IN ($ids) AND published=1 ";
    $db->setQuery($query);
    $tags = $db->loadObjectList();
    $cout_tag = count($tags);
} ?>
<div id="home_content_portfolio">

    <?php if ($show_portfolio_filter == 1) { ?>
        <div id="tz_options" class="text-center clearfix">
            <nav id="filter"
                 class="option-set clearfix portfolio-filter <?php echo $params->get('bg_filter'); ?> skew-25"
                 data-option-key="filter">
                <span class="skew25 left filter-by">Filter by:</span>
                <ul id="filters">
                    <li class="active">
                        <a data-option-value="*" href="#" class="active skew25">
                            <?php echo $portfolio_show_all; ?>
                        </a>
                    </li>
                    <?php if ($tags): ?>
                        <?php foreach ($tags as $tag): ?>
                            <li>
                                <a data-option-value=".<?php echo JApplication::stringURLSafe($tag->name); ?>"
                                   href="#<?php echo JApplication::stringURLSafe($tag->name); ?>"
                                   class="skew25">
                                    <?php echo $tag->name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div><!-- end text-center -->
    <?php } ?>

<div id="container" class="margin-left-right ">

    <?php if (isset($list) && !empty($list)) {
        foreach ($list as $item) {
            $media = $item->type_media;
            $id = $item->contentid;
            $db = JFactory::getDbo();
            $query = "SELECT  tagsid, name, published FROM #__tz_portfolio_tags_xref AS tx LEFT JOIN #__tz_portfolio_tags  AS pt ON (tx.tagsid = pt.id) WHERE contentid=$id and published=1";
            $db->setQuery($query);
            $tags_articles = $db->loadObjectList();
            $item_tags = '';
            if ($tags_articles) {
                foreach ($tags_articles as $tags_article) {
                    $item_tags .= JApplication::stringURLSafe($tags_article->name) . ' ';
                }
            }
            $imagetype = '';
            if ($show_portfolio_feature == 1) {
                if ($media == 'image') {
                    $imageProperties = JImage::getImageFileProperties($item->image);
                    $imageWidth = $imageProperties->width;
                    $imageHeight = $imageProperties->height;
                    $ratio = $imageWidth / $imageHeight;
                    $imagetype = '';

                    if ($ratio > 2) {
                        $imagetype = 'landscape tz_feature_item';
                    }
                    if ($item->featured == 1) {
                        $imagetype .= 'tz_feature_item';
                    }

                }
            }
            ?>

            <div class="item entry item-h2 <?php echo $imagetype . ' ';
            echo $item_tags; ?>" data-category="transition">
                <div class="TzInner portfolio-item">
                    <div class="img-holder">
                        <div class="img-over">
                            <a href="<?php echo $item->link; ?>" class="fx link">
                                <b class="fa fa-link"></b>
                            </a>
                            <a href="<?php echo $item->image; ?>" class="fx zoom">
                                <b class="fa fa-search-plus"></b>
                            </a>
                        </div>
                        <img src="<?php echo $item->image; ?>" alt=""/>
                    </div>
                    <div class="name-holder">
                        <a href="<?php echo $item->link; ?>" class="project-name">
                            <?php echo $item->title; ?>
                        </a>
                        <span class="project-options">
                            <?php echo $item->title; ?>
                        </span>

                        <!-- end magnifier -->
                    </div>

                </div>
            </div>
        <?php } ?>
    <?php } ?>


</div>
<!-- #container -->
<div class="clearfix"></div>
<?php if ($show_all_product == 1) { ?>
    <div class="view-all-projects">

        <a href="<?php echo $TzNewLinkItemID; ?> " title=""><?php echo $TzNewLink; ?></a>

    </div>

<?php } ?>
<script type="text/javascript">
    function tz_init(defaultwidth) {
        var contentWidth = jQuery('#container').width();
        var columnWidth = defaultwidth;
        var curColCount = 0;

        var maxColCount = 0;
        var newColCount = 0;
        var newColWidth = 0;
        var featureColWidth = 0;
        var feature_options = <?php echo $show_portfolio_featured; ?>;

        curColCount = Math.floor(contentWidth / columnWidth);

        maxColCount = curColCount + 1;
        if ((maxColCount - (contentWidth / columnWidth)) > ((contentWidth / columnWidth) - curColCount)) {
            newColCount = curColCount;
        }
        else {
            newColCount = maxColCount;
        }

        newColWidth = contentWidth;
        featureColWidth = contentWidth;


        if (newColCount > 1) {
            newColWidth = Math.floor(contentWidth / newColCount);
            featureColWidth = newColWidth * 2;
        }

        jQuery('.item').width(newColWidth);
        if (feature_options == 1) {
            jQuery('.tz_feature_item').width(featureColWidth);
        }

        var $container = jQuery('#container');
        $container.imagesLoaded(function () {
            $container.isotope({
                masonry: {
                    columnWidth: newColWidth
                }
            });

        });
        TzTemplateResizeImage(jQuery('.TzInner'), <?php echo $params->get('tz_new_portfolio_height_content');?>);
    }

</script>
<script type="text/javascript">


    var resizeTimer = null;
    jQuery(window).bind('load resize', function () {
        var item_Width = <?php echo $default_width ?>;
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout("tz_init(item_Width)", 100);
    });

    var $container = jQuery('#container');
    var container_Width = $container.width();
    var item_Width = <?php echo $default_width ?>;
    $container.imagesLoaded(function () {
        $container.isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            getSortData: {
                name: function ($elem) {
                    var name = $elem.find('.name'),
                        itemText = name.length ? name : $elem;
                    return itemText.text();
                },
                date: function ($elem) {
                    var number = $elem.hasClass('element') ?
                        $elem.find('.create').text() :
                        $elem.attr('data-date');
                    return number;

                }
            }
        });
        tz_init(item_Width);
    });

    function loadPortfolio() {
        var $optionSets = jQuery('#tz_options .option-set'),
            $optionLinks = $optionSets.find('a');
        $optionLinks.click(function (event) {
            event.preventDefault();
            var $this = jQuery(this);
            // don't proceed if already selected
            if ($this.hasClass('active')) {
                return false;
            }
            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.active').removeClass('active');
            $this.addClass('active');
            $this.parent().find('.active').removeClass('active');
            $this.parent().addClass('active');
            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
            // parse 'false' as false boolean

            value = value === 'false' ? false : value;
            options[ key ] = value;

            if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {

                // changes in layout modes need extra logic
                changeLayoutMode($this, options)
            } else {
                // otherwise, apply new options
                $container.isotope(options);
            }
            return false;
        });

    }
    //    isotopeinit();
    loadPortfolio();
    jQuery('#container > div').each(function () {
        var $this = jQuery(this),
            $index = $this.index(),
            contents = $this.find('.img-over');
        $this.hover(function () {
            contents.fadeIn(400).find('.link').removeClass('animated fadeOutUp').addClass('animated fadeInDown');
            contents.find('.zoom').removeClass('animated fadeOutDown').addClass('animated fadeInUp');
            return false;
        }, function () {
            contents.fadeOut(400).find('.link').removeClass('animated fadeInDown').addClass('animated fadeOutUp');
            contents.find('.zoom').removeClass('animated fadeInUp').addClass('animated fadeOutDown');
            return false;
        });
    });
</script>

</div> <!-- #content -->
