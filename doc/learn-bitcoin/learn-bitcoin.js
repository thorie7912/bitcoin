$(document).ready(function() {

  $('.line').click(function(event) {
      var questionIds = $(this).find('.comment').attr('data');
      if (questionIds) {
          $('.line').removeClass('highlight');
          $(this).addClass('highlight');
          $('.right-pane').html('<div class="q-zone"></div>');
          var screenTop = $(document).scrollTop();
          var rightPaneTop = $('.right-pane').offset().top;
          // Don't go above right pane
          if (screenTop < rightPaneTop) {
              screenTop = rightPaneTop;
          }
          $('.q-zone').css('top', screenTop);
          $('.q-zone').load('../get-questions.php?q='+questionIds);
      } else {
          $('.line').removeClass('highlight');
          $('.q-zone').html('');
      }
  });
 
      
});

function registerTitles() {
  $('.q-title').click(function(event) {
     var questionId = $(this).attr('data');
     if ($('#expand'+questionId).is(":visible")) {
        $('#expand'+questionId).hide();
        $('#triangle'+questionId).html('&#9654;');
     } else {
        $('#expand'+questionId).show();
        $('#triangle'+questionId).html('&#9660;');
     }
     event.stopPropagation();
     event.preventDefault();
  });
}
