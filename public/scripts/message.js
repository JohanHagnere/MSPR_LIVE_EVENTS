let toggleBtn = document.getElementById('toggleBtn');
let messageParent = document.getElementById('messageParent');
let currentIndex = 0;

function toggleMessage() {
    currentIndex++;
    if (currentIndex >= messages.length) {
        currentIndex = 0;
    }
 let messageContent = document.getElementById('messageContent');
    messageContent.textContent = messages[currentIndex].content;
    messageContent.className = messages[currentIndex].type;}
toggleBtn.addEventListener('click', toggleMessage);

let subMenu = document.querySelector('.sub-menu');
let menuPlus = document.querySelector('.menu-plus');

menuPlus.addEventListener('click', () => {
    subMenu.classList.toggle('show')
})

