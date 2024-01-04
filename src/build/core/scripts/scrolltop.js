(function(factory) {
  if (typeof define === "function" && define.amd) {
    define(["jquery"], factory);
  } else if (typeof module === "object" && module.exports) {
    module.exports = factory(require("jquery"));
  } else {
    factory(jQuery);
  }
})(function($) {
  "use strict";
  $.scrollToTop = function() {
    // Default variables
    var defaults = {
      element: ".scrolltop",
      activeClass: "active",
      scrollHeight: 200,
      transitionDuration: 500
    };
    var settings = $.extend({}, defaults, $.scrollToTop.defaults);

    // Method to scroll to top
    function _scroll() {
      $("html").animate(
        {
          scrollTop: 0
        },
        settings.transitionDuration
      );
    }

    // Hide toggle element
    function _hide() {
      $(settings.element).removeClass(settings.activeClass);
    }

    // Show toggle element
    function _show() {
      $(settings.element).addClass(settings.activeClass);
    }

    // Showing toggle element when page loaded and scroll height breakpoint reached
    if ($(window).scrollTop() >= settings.scrollHeight) {
      _show();
    }

    // Listening window scrolling event
    $(window).scroll(function() {
      $(this).scrollTop() >= settings.scrollHeight ? _show() : _hide();
    });

    // Setting event listener for toggle element
    $(settings.element).on("click", function() {
      _scroll();
    });
  };

  $(function() {
    // Initialize scroll to top plugin
    $.scrollToTop();
  });
});
