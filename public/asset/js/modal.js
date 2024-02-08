$(document).ready(function() {
  var modal = $('#myModals');
  var btn = $('#openModal');
  var span = $('#closeModal');
  
  btn.click(function() {
    modal.css('display', 'block');
  });
  
  span.click(function() {
    modal.css('display', 'none');
  });
  $('.clo').click(function() {
    modal.css('display', 'none');
  });
  $(window).click(function(event) {
    if (event.target == modal[0]) {
      modal.css('display', 'none');
    }
  });
});