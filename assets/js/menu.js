// To be sure that the DOM is fully loaded before executing the code
document.addEventListener('DOMContentLoaded', function () {
  document.addEventListener('turbo:load', function () {
    // Select the components to be manipulated
    const toggleMenuBtn = document.querySelector('#menu-btn')
    const toggleMenuImg = document.querySelector('#menu-btn img')
    const toggledMenu = document.querySelector('#toggled-menu')
    const header = document.querySelector('header')
    const hero = document.getElementById('hero')

    // Add an event listener to the menu button to toggle the navigation menu
    toggleMenuBtn.addEventListener('click', toggleNav)

    // Function to toggle the navigation menu
    function toggleNav() {
      toggledMenu.classList.toggle('-translate-y-[150%]') //

      // Change the menu button image and aria-expanded attribute based on the menu visibility
      if (toggledMenu.classList.contains('-translate-y-[150%]')) {
        toggleMenuImg.setAttribute('src', 'images/icons/menu.svg')
        toggleMenuBtn.setAttribute('aria-expanded', 'false')
        header.classList.add('border-b-[0.5px]')
      } else {
        toggleMenuImg.setAttribute('src', 'images/icons/cross-menu.svg')
        toggleMenuBtn.setAttribute('aria-expanded', 'true')
        header.classList.remove('border-b-[0.5px]')
      }
    }

    // Add an event listener to the window to change the header background color on scroll
    window.addEventListener('scroll', function () {
      // Calculate the height of the hero section & header
      const heroHeight = hero.offsetHeight
      const headerHeight = header.offsetHeight

      // Calculate the height to scroll before changing the header background color
      const scrollHeight = heroHeight - headerHeight

      // Calculate the scroll position
      const scrollPosition = window.scrollY

      // Check if the hero section is fully scrolled
      if (scrollPosition >= scrollHeight) {
        // Add a CSS class to the header to change its background color
        header.classList.add('bg-[#071501]/60')
        toggledMenu.classList.add('bg-[#071501]/60')
      } else {
        // Remove the CSS class if the hero section is not fully scrolled
        header.classList.remove('bg-[#071501]/60')
        toggledMenu.classList.remove('bg-[#071501]/60')
      }
    })
  })
})
