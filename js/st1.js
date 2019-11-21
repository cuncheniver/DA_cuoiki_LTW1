$(document).ready(function() {
    var panelOne = $('.form-panel.two').height(),
      panelTwo = $('.form-panel.two')[0].scrollHeight;
  
    $('.form-panel.two').not('.form-panel.two.active').on('click', function(e) {
     
  
      $('.form-toggle').addClass('visible');
  
      $('.form-panel.two').addClass('active');
     
    });
  
    $('.form-toggle').on('click', function(e) {
     
      $(this).removeClass('visible');
     
      $('.form-panel.two').removeClass('active');
   
    });
  });