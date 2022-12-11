'use strict';

const userInput = document.getElementById('otherUser');
const deadlineInput = document.getElementById('deadline');

function setColorUserInput() {
    const classColor = 'text-primary';
    if (userInput.value[0] === '@') {
        userInput.classList.add(classColor);
    }else{
        userInput.classList.remove(classColor);
    }
}

function setColorDeadlineInput() {
    const classColor = 'text-danger';

    if (deadlineInput.value != "" && deadlineInput.value < new Date().toISOString().split('T')[0]) {
        deadlineInput.classList.add(classColor);
    }else{
        deadlineInput.classList.remove(classColor);
    }
}

deadlineInput.onchange = function(){setColorDeadlineInput()};
setColorDeadlineInput();

userInput.onkeyup = function(){setColorUserInput()};
setColorUserInput();
