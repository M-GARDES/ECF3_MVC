$(document).ready(function() {
  var myNavbar = $('#navbarNav');
  var myNavbarLinks = myNavbar.find('.nav-link');

  myNavbarLinks.click(function(e) {
    if (myNavbar.hasClass('show')) {
      myNavbar.removeClass('show');
    }
  });
});