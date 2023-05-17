

const cardHeaders = document.querySelectorAll('.card-header');

cardHeaders.forEach(header => {
    header.addEventListener('click', () => {
        const cardBody = header.nextElementSibling;
        cardBody.classList.toggle('collapse');
    });
});

