console.log("coucou");
var toggleBtn = document.getElementById('toggleBtn');
        var messageParent = document.getElementById('messageParent');
        var currentIndex = 0;

        function toggleMessage() {
            currentIndex++;
            if (currentIndex >= messages.length) {
                currentIndex = 0;
            }
            messageParent.innerHTML = `<h1 id="messageContent" class=${messages[currentIndex].type}>${messages[currentIndex].content}</h1>`
        }
        toggleBtn.addEventListener('click', toggleMessage);