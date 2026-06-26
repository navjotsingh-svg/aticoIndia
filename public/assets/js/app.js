$(document).ready(function() {
   $('a[href*=#]').on('click', function(e) {
      e.preventDefault();
      var target = this.hash.replace(/#/g, '');
      if (target) {
         $('html,body').animate({ scrollTop: $('#' + target).offset().top }, 1000);
      }
   });
});
