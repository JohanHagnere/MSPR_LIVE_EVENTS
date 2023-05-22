console.log("coucou");
var toggleBtn = document.getElementById('toggleBtn');
        var messageContent = document.getElementById('messageContent');
        var currentIndex = 0;

        function toggleMessage() {
            currentIndex++;
            if (currentIndex >= messages.length) {
                currentIndex = 0;
            }
            messageContent.innerHTML = `<h1 id="messageContent" class="${messages[currentIndex].type}">${messages[currentIndex].content}</h1>`
        }
       // console.log(messageContent);
        toggleBtn.addEventListener('click', toggleMessage);