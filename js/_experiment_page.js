(function($){ 
  $(function() {
    $('.experiment_delete > a').click(function() {
      $(this).parent().submit();
      return false;
    });
  });
}) (jQuery); 