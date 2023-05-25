console.log("coucou");
var toggleBtn = document.getElementById('toggleBtn');
var messageParent = document.getElementById('messageParent');
var currentIndex = 0;

function toggleMessage() {
    currentIndex++;
    if (currentIndex >= messages.length) {
        currentIndex = 0;
    }
    var messageContent = document.getElementById('messageContent');
    messageContent.textContent = messages[currentIndex].content;
    messageContent.className = messages[currentIndex].type;}
    
toggleBtn.addEventListener('click', toggleMessage);

let subMenu = document.querySelector('.sub-menu');
let menuPlus = document.querySelector('.menu-plus');

menuPlus.addEventListener('click', () => {
    subMenu.classList.toggle('show')
})



// $(document).ready(function() {
//     $('.footer-menu-item').click(function(e) {
//         e.preventDefault();
//         $(this).find('.sub-menu').toggle();
//     });
// });

