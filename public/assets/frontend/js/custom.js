// SCROLL TO SECTION JS STARTS
  function smoothScrollTo(selector, time, fromTop){
    $('html, body').animate({
      scrollTop: $(selector).offset().top - fromTop
    }, time);
  }
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})