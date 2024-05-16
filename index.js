document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery .item');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const imgSrc = item.querySelector('img').getAttribute('src');
            const imgTitle = item.querySelector('.title').textContent;

            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${imgSrc}" alt="${imgTitle}">
                    <p>${imgTitle}</p>
                </div>
                <span class="close">&times;</span>
            `;

            document.body.appendChild(lightbox);

            const closeButton = lightbox.querySelector('.close');
            closeButton.addEventListener('click', () => {
                lightbox.remove();
            });
        });
    });
});