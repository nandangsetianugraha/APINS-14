(function(factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    module.exports = factory(require('jquery'));
  } else {
    factory(jQuery);
  }
}(function($) {
  "use strict";
  $.aside = function(action) {

    // Default variables
    var defaults = {
      element: {
        main: '.aside',
        backdrop: '#aside-backdrop',
        toggle: '[data-toggle="aside"]'
      },
      breakpoint: 1025,
      class: {
        minimizedDesktop: 'aside-desktop-minimized',
          minimizedMobile: 'aside-mobile-minimized',
          maximizedDesktop: 'aside-desktop-maximized',
          maximizedMobile: 'aside-mobile-maximized',
          hover: 'aside-hover',
      },
      localStorage: 'aside-storage',
      transitionDuration: 200,
      easing: 'linear',
    }
    var settings = $.extend({}, defaults, $.aside.defaults);

    // Method list
    var methods = [{
        event: 'init',
        action: function(el) {
          _init(el);
        }
      },
      {
        event: 'toggle',
        action: function() {
          _toggle();
        }
      },
      {
        event: 'minimize',
        action: function() {
          _minimize();
        }
      },
      {
        event: 'maximize',
        action: function() {
          _maximize();
        }
      }
    ]

    function _init() {
      var trigger = $(settings.element.toggle);
      var asideStorage = localStorage.getItem(settings.localStorage);

      // Check wheter local storage is exist
      if (asideStorage) {
        var asideMinimized = JSON.parse(asideStorage).minimized

        // Toggle Aside by local storage
        if ($(window).width() >= settings.breakpoint) {
          if (asideMinimized) {
            _minimizeDesktop();

            // Adding aside element hover class by timer
            setTimeout(function() {
              $(".aside, .wrapper").css("transition", "");
            }, settings.transitionDuration)
          } else {
            _maximizeDesktop();
            $(".aside, .wrapper").css("transition", "");
          }
        }
      } else {

        // When aside in minimized condition, it will add .aside-hover for hover behavior
        if ($('body').hasClass(settings.class.minimizedDesktop)) {
          $(settings.element.main).addClass(settings.class.hover);
        }

        $(".aside, .wrapper").css("transition", "");
      }

      // Make aside toggle event listener
      trigger.on('click', function() {
        var dataTarget = $(trigger.data('target'));
        var target = dataTarget.length > 0 ? dataTarget : $(settings.element.main);

        _toggle(target);
      })
    }

    // Toggle maximize and minimize
    function _toggle() {
      var target = $(settings.element.main);

      if (target.length > 0) {
        var isMinimized = $(window).width() >= settings.breakpoint ? settings.class.minimizedDesktop : settings.class.minimizedMobile;

        $('body').hasClass(isMinimized) ? _maximize() : _minimize();
      }
    }

    // Minimize aside element
    function _minimize() {
      var target = $(settings.element.main);

      if (target.length > 0) {
        $(window).width() >= settings.breakpoint ? _minimizeDesktop() : _minimizeMobile();
      }
    }

    // Maximize aside element
    function _maximize(target) {
      var target = $(settings.element.main);

      if (target.length > 0) {
        $(window).width() >= settings.breakpoint ? _maximizeDesktop() : _maximizeMobile();
      }
    }

    // Set body classes when aside element minimized
    function _minimizeBodyClass() {
      var addClass, removeClass;

      if ($(window).width() >= settings.breakpoint) {
        addClass = settings.class.minimizedDesktop;
        removeClass = settings.class.maximizedDesktop;
      } else {
        addClass = settings.class.minimizedMobile;
        removeClass = settings.class.maximizedMobile;
      }

      $('body').addClass(addClass);
      $('body').removeClass(removeClass);
    }

    // Set body classes when aside element maximized
    function _maximizeBodyClass() {
      var addClass, removeClass;

      if ($(window).width() >= settings.breakpoint) {
        addClass = settings.class.maximizedDesktop;
        removeClass = settings.class.minimizedDesktop;
      } else {
        addClass = settings.class.maximizedMobile;
        removeClass = settings.class.minimizedMobile;
      }

      $('body').addClass(addClass);
      $('body').removeClass(removeClass);
    }

    function _minimizeMobile() {
      // Setting body classess
      _minimizeBodyClass();

      // Animate backdrop
      var backdropElement = $(settings.element.backdrop);
      backdropElement.removeClass("show");
      backdropElement.off();
      backdropElement.remove();
    }

    function _maximizeMobile() {
      // Backdrop HTML string
      var backdrop = '<div id="' + settings.element.backdrop.substr(1) + '"></div>';

      // Setting body classess
      _maximizeBodyClass();

      // Creating backdrop and animate it
      var backropElement = $(backdrop).appendTo('body');
      backropElement.addClass("fade");
      backropElement.addClass("show");
      backropElement.on('click', function() {
        _minimizeMobile();
      });
    }

    function _minimizeDesktop() {
      var target = $(settings.element.main);

      // Setting body classess
      _minimizeBodyClass();

      // Set state in local storage
      localStorage.setItem(settings.localStorage, JSON.stringify({ minimized: true }))

      // Adding aside element hover class by timer
      setTimeout(function() {
        target.first().addClass(settings.class.hover);
      }, settings.transitionDuration)

      // Triggering window resize event
      $(window).trigger('resize');
    }

    function _maximizeDesktop() {
      var target = $(settings.element.main);

      // Setting body classess
      _maximizeBodyClass();

      // Set state in local storage
      localStorage.setItem(settings.localStorage, JSON.stringify({ minimized: false }))

      // Removing aside element hover class
      target.first().removeClass(settings.class.hover);

      // Triggering window resize event
      $(window).trigger('resize');
    }

    var element = $(this);

    if (typeof action == 'string') {
      methods.forEach(function(method) {
        if (action == method.event) {
          method.action(element)
        }
      })
    }

    return this
  }

  // Remove Transition
  if ($(window).width() >= 1025) {
    $(".aside, .wrapper").css("transition", "none");
  }

  $(function() {
    // Initializing
    $.aside('init');
  })

}));