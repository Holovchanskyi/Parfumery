/**
 * Created by TuanMap on 10/7/14.
 */

jQuery.fn.accordion = function (options) {
    var defaults = {
        direction: 'vertical'
    };
    var options = jQuery.extend({}, defaults, options),
        accItem = jQuery(this).find('li'),
        activeItem = accItem.eq(0),
        accLink = accItem.find('h3'),
        accPane = accItem.find('.accordion-panel');
    $(activeItem).addClass('active');
    if (options.direction == "vertical") {
        accPane.slideUp();
        accPane.eq(0).slideDown();
        accLink.prepend('<u/>');
    } else if (options.direction == "horizontal") {
        jQuery(this).addClass('accordion-horizontal');
    }
    accItem.find('h3').click(function (e) {
        if (!jQuery(this).parent().hasClass('active')) {
            e.preventDefault();
            accItem.removeClass('active');
            jQuery(this).parent().addClass('active');
            if (options.direction == "vertical") {
                accPane.slideUp(350);
                $(this).next().slideDown(350);
            } else {
                accItem.animate({width: "40px"}, {duration: 350, queue: false});
                $(this).parent().animate({width: "80%"}, {duration: 350, queue: false});
            }
        } else {
            if (options.direction == "vertical") {
                e.preventDefault();
                accItem.removeClass('active');
                if (options.direction == "vertical") {
                    accPane.slideUp(350);
                }
            }
            return false;
        }
    });
}
