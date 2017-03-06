/**
 * Created by TuanMap on 10/7/14.
 */
jQuery.fn.tabs = function (options) {
    var defaults = {
        direction: ''
    };
    var options = jQuery.extend({}, defaults, options);
    if (options.direction == "vertical") {
        jQuery(this).addClass('tabs-vertical');
    }
    var tabsUl = jQuery(this).find(' > ul'),
        activeTab = tabsUl.find('li.active').index(),
        tabsPane = jQuery(this).find('.tabs-pane');
    tabsPane.find('.tab-panel').fadeOut();
    tabsPane.find('.tab-panel').eq(activeTab).fadeIn();
    tabsUl.find('li').find('a').click(function (e) {
        if (!jQuery(this).parent().hasClass('active')) {
            e.preventDefault();
            var ind = jQuery(this).parent().index();
            tabsUl.find('li').removeClass('active');
            jQuery(this).parent().addClass('active');
            tabsPane.find('.tab-panel').fadeOut(0).removeClass('active');
            tabsPane.find('.tab-panel').eq(ind).fadeIn(350).addClass('active');
            return false;
        } else {
            return false;
        }
    });
}