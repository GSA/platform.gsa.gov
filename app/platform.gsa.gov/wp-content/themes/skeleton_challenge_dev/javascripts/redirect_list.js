jQuery(document).ready(function($) {


    if ($('.front-challenge-item-container').length > 0) {
        $('.edit-challenge-link>a').click(function(e) {
            e.stopPropagation();
        });
        $('.challenge-posted-by>a').click(function(e) {
            e.stopPropagation();
        });

        $('.front-challenge-innertext>a').click(function(e){
            e.stopPropagation();
        });

      $('.front-challenge-item-container').click(function(e) {
          var a_anchor = $(this).find('.challenge-title');
          var new_url = a_anchor.attr('href');
          var a_target = a_anchor.attr('target');

          if (a_target=="_blank") {
              window.open(new_url, '_blank');
          }
          else {
              window.location.href = new_url;
          }
      });
    }

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