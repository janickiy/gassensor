//porting from old
(function scroll_sky() {
  var sky_pos = 0;
  var speed = 70;
  var step = 1;
  var sky = document.getElementById('sky-wrap');

  if (!sky) {
    return
  }

  setInterval( function() {
    sky_pos++;
    sky.style.backgroundPosition =  ( sky_pos / speed ) + 'em 0px';
  }, step);

})();

$( "#mmenu_toggle" ).on('click', function() {
  $(this).toggleClass( "active" );

  if ($(this).hasClass( "active" )) {
    $('.mobile-nav').stop(true, true).slideDown();
  }else{
    $('.mobile-nav').stop(true, true).slideUp();
  }
});
