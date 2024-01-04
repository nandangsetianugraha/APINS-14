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
  $.headerNav = function() {
    // Default variables
    var defaults = {
      headerNavElement: '[data-toggle*="header-nav"]',
      headerTabElement: '[data-toggle*="header-tab"]',
      headerLinkElement: '[data-href]',
      navLinkElement: '.nav-link',
      activeClass: 'active'
    };
    var settings = $.extend({}, defaults, $.headerNav.defaults);
    var breakLoop = false;

    // Loop all header tab elements
    $(settings.headerNavElement).find(settings.headerTabElement).each(function() {
      var headerTabElement = $(this);
      var currentPath = window.location.pathname;

      // Loop all header link elements
      headerTabElement.find(settings.headerLinkElement).each(function() {

        // Check whether the link href with current pathlocation
        if ($(this).data("href") == currentPath) {

          // Toggle active tab
          $(settings.headerTabElement).removeClass(settings.activeClass);
          headerTabElement.find(settings.navLinkElement).addClass(settings.activeClass);

          // Break the loop
          breakLoop = true;
          return false;
        }
      });

      // Break the loop
      if (breakLoop) {
        return false;
      }
    });
  };

  $(function() {
    // Initialize header nav plugin
    $.headerNav();
  });
});
