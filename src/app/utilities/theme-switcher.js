$(function() {
  const themeAttrElement = "html"
  const themeDataAttrName = "data-theme"
  const themeIdentifier = "theme-variant"
  const themeToggleElement = "#theme-toggle"
  
  // Function tor toggling theme
  function _themeSwitcher(isDark) {
  
    // Toggling theme class
    if (isDark) {
      $(themeAttrElement).attr(themeDataAttrName, "light")
      $(themeAttrElement).css('color-scheme', 'light')
      $(themeToggleElement).children("i").removeClass("fa-sun").addClass("fa-moon")
      localStorage.setItem(themeIdentifier, "light")
    } else {
      $(themeAttrElement).attr(themeDataAttrName, "dark")
      $(themeAttrElement).css('color-scheme', 'dark')
      $(themeToggleElement).children("i").removeClass("fa-moon").addClass("fa-sun")
      localStorage.setItem(themeIdentifier, "dark")
    }
  }
  
  // Change default theme by local storage
  if (localStorage.getItem(themeIdentifier)) {
    _themeSwitcher(localStorage.getItem(themeIdentifier) == "light")
  }
  
  $(themeToggleElement).on("click", function() {
    const isDark = $(themeAttrElement).attr(themeDataAttrName) == "dark"
    
    // Switching theme
    _themeSwitcher(isDark)
  })
})