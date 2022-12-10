'use strict';

const userInput = document.getElementById('otherUser');
const deadlineInput = document.getElementById('deadline');

function setColorUserInput() {
    const classColor = 'text-primary'; // Bootstrap class for text color
    if (userInput.value[0] === '@') {
        userInput.classList.add(classColor);
    }else{
        userInput.classList.remove(classColor);
    }
}

function setColorDeadlineInput() {
    const classColor = 'text-danger'; // Bootstrap class for text color
    // if deadline passed
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

