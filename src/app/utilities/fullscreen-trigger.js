$(function() {
  $('#fullscreen-trigger').on('click', function() {
    const active = $('body').data('fullscreen-active')

    // Toggling fullscreen mode
    active ? document.exitFullscreen() : document.documentElement.requestFullscreen()
  })

  // Listen fullscreen event
  document.onfullscreenchange = function() {

    // Toggling fullscreen-active class
    if (document.fullscreenElement) {
      $('body').addClass('fullscreen-active')
      $('body').data('fullscreen-active', true)
    } else {
      $('body').removeClass('fullscreen-active')
      $('body').data('fullscreen-active', false)
    }
  }
})