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
  $.fn.portlet = function(action) {
    // Default variables
    var defaults = {
      element: {
        main: ".portlet",
        body: ".portlet-body"
      },
      data: {
        hidden: "portlet-hidden"
      },
      collapsedClass: "portlet-collapsed",
      destroyMethod: "fade", // fade|slide
      easing: "linear",
      transitionDuration: 200
    };
    var settings = $.extend({}, defaults, $.fn.portlet.defaults);

    // Method list
    var methods = [
      {
        event: "collapse",
        action: function(target) {
          _collapse(target);
        }
      },
      {
        event: "uncollapse",
        action: function(target) {
          _uncollapse(target);
        }
      },
      {
        event: "toggleCollapse",
        action: function(target) {
          _toggleCollapse(target);
        }
      },
      {
        event: "destroy",
        action: function(target) {
          _destroy(target);
        }
      }
    ];

    // Remove portlet with animation
    function _destroy(target) {
      // Validating target element whether it has .portlet class
      if (target.hasClass(settings.element.main.substr(1))) {
        var type = settings.destroyMethod;

        if (type === "fade") {
          target.fadeOut(settings.transitionDuration);
        } else if (type === "slide") {
          target.slideUp(settings.transitionDuration);
        } else {
          target.fadeOut(settings.transitionDuration);
        }
      }
    }

    // Collapse .portlet-body element
    function _collapse(target) {
      // Validating target element whether it has .portlet class
      if (target.hasClass(settings.element.main.substr(1))) {
        target.find(settings.element.body).slideUp({
          duration: settings.transitionDuration,
          easing: settings.easing,
          complete: function() {
            target.data(settings.data.hidden, true);
            target.addClass(settings.collapsedClass);
          }
        });
      }
    }

    // Uncollapse .portlet-body element
    function _uncollapse(target) {
      // Validating target element whether it has .portlet class
      if (target.hasClass(settings.element.main.substr(1))) {
        target
          .find(settings.element.body)
          .slideDown({
            duration: settings.transitionDuration,
            easing: settings.easing,
            complete: function() {
              target.data(settings.data.hidden, false);
            }
          })
          .removeClass(settings.collapsedClass);
      }
    }

    // Toggle collapse .portlet-body element
    function _toggleCollapse(target) {
      target.data(settings.data.hidden) ? _uncollapse(target) : _collapse(target);
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
});
