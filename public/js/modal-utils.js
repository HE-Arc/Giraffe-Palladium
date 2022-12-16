'use strict';

function focusInput(modalName, inputName) {
    const modal = document.getElementById(modalName)
    const input = document.getElementById(inputName)

    modal.addEventListener('shown.bs.modal', () => {
        input.focus()
    })
}
