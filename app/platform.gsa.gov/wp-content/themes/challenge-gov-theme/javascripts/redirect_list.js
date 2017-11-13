jQuery(document).ready(function($) {

    // check external link timer
    if ($('.external_link_timer').length > 0) {
        var interval;

        interval = setInterval(function() {
            var cur_time = $('.internal_timer').html();
            if (cur_time == 1) {
                clearInterval(interval);
                var red_url = $('.external_link_path').attr('href');
                window.open(red_url, '_blank');
            }
            else {
                $('.internal_timer').html(cur_time - 1);
            }
        }, 1000);
    }
});