(function($, OE, document){
    var $doc = $(document);

    // Common functions
    OE.flexslider = {
        caller: function() {
            var namespace = 'flexslider'
              , sliders = $('.oe-slider, [data-' + namespace + ']').toArray();

            // Shift the being synced
            //   to the start of the queue
            // @see http://flexslider.woothemes.com/thumbnail-slider.html
            for(var idx in sliders) {
                if(!$(sliders[idx]).data(namespace + '-as-nav-for')) {
                    sliders.push(sliders.splice(idx, 1)[0]);
                }
            }

            $.each(sliders, function(idx, slider) {
                var opts = $.extend({
                    }, $.flexslider.defaults)
                  , $slider = $(slider)
                  , k, v;

                // Config by a single 
                //   attribute as a JSON string
                v = $slider.data(namespace);
                if(typeof v != 'undefined') {
                    try {
                        v = $.parseJSON(v);
                        opts = $.extend(opts, v);
                    } catch(e) {}
                }

                // Config by single attributes
                for(k in opts) {
                    v = $slider.data(
                        namespace 
                        + '-'
                        + k.replace(
                              /[A-Z]/g,
                              function(c){ return '-' + c.toLowerCase() }
                          )
                    );
                    if(typeof v != 'undefined') {
                        opts[k] = v;
                    }
                }

                // Init the flex slider
                $slider.flexslider(opts);
            });
        }
    };
})(jQuery, window.OE, window.document);

jQuery(function() {
    OE.flexslider.caller();
});