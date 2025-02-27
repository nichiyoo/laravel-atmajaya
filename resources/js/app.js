import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
  const deleteButtons = document.querySelectorAll(".delete-btn")
  const deleteForm = document.getElementById("deleteForm")
  const deleteConfirmationMessage = document.getElementById("deleteConfirmationMessage")
  const deleteConfirmationModal = document.getElementById("deleteConfirmationModal")

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault()
      const deleteUrl = this.getAttribute("data-delete-url")
      const itemName = this.getAttribute("data-item-name")
      const itemType = this.getAttribute("data-item-type")

      deleteForm.setAttribute("action", deleteUrl)
      deleteConfirmationMessage.textContent = `Do you really want to delete this ${itemType} "${itemName}"? This action cannot be undone.`

      const modal = new bootstrap.Modal(deleteConfirmationModal)
      modal.show()
    })
  })
})

