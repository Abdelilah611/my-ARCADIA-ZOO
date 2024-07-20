document.addEventListener('DOMContentLoaded', function () {
  document.addEventListener('turbo:load', function () {
    // Select all buttons with an ID
    const buttons = document.querySelectorAll('button[id]')

    // Loop through each button and add a click event listener
    buttons.forEach((button) => {
      button.addEventListener('click', () => {
        // Get the ID of the button
        const buttonId = button.getAttribute('id')

        // Toggle the corresponding details section
        const detailsId = `${buttonId}-details`
        const detailsElement = document.getElementById(detailsId)
        detailsElement.classList.toggle('hidden')

        const icon = button.querySelector('i')
        if (icon) {
          // Toggle a class to rotate the icon
          icon.classList.toggle('rotate-180')
        }
      })
    })
  })
})
