<?php


defined('_JEXEC') or die();
$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . 'modules/mod_tz_testimonial/js/slick.min.js');

if ($list): ?>


    <div class="testimonials-1 <?php echo $module->id ?>">
        <?php foreach ($list as $item): ?>
            <div>
                <div class="testimonials-bg">
                    <img alt="" src="<?php echo $item->testimonial_image ?>" class="testimonials-img">
                    <strong>
                        <?php echo $item->testimonial_author ?>:
                    </strong> <br>
                    <?php echo $item->testimonial_quotations ?>


                </div>
                <div class="testimonials-name">
                    <h4>  </h4>
                    <?php echo $item->testimonial_website ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<div class="padd-top-20"><a href="/index.php/o-nas#add_review" class="btn btn-small empty alter-border" style="display: block;">Оставить отзыв</a>
</div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.testimonials-1.<?php echo $module->id?>').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 2,
                touchMove: true,
                slidesToScroll: 1,
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
        });
    </script>
<?php endif; ?>