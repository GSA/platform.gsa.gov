jQuery(document).ready(function($) {

  /// get rid of indentation
  $('#parent_id')
    .css('width','100%')
    .select2()
    .find('option').each(function(i,option)
    {
      $o = $(option);
      $o.html( $o.html().replace(/^(\s|\&nbsp;)+/,'') );
    });

});
