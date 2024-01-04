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
  $.preload = function(action) {
    // Default variables
    var defaults = {
      bodyHideClass: "preload-hide",
      bodyActiveClass: "preload-active"
    };
    var settings = $.extend({}, defaults, $.preload.defaults);

    // Method list
    var methods = [
      {
        event: "show",
        action: function() {
          _show();
        }
      },
      {
        event: "hide",
        action: function() {
          _hide();
        }
      }
    ];

    // Show preload
    function _show() {
      $("body").removeClass(settings.bodyHideClass);
      $("body").addClass(settings.bodyActiveClass);
    }

    // Hide preload
    function _hide() {
      $("body").addClass(settings.bodyHideClass);
      $("body").removeClass(settings.bodyActiveClass);
    }

    var element = $(this);

    if (typeof action == "string") {
      methods.forEach(function(method) {
        if (action == method.event) {
          method.action(element);
        }
      });
    }

    return this;
  };

  setTimeout(function() {
    $.preload("hide");
  }, 6000);

  $(function() {
    $.preload("hide");
  });
});
