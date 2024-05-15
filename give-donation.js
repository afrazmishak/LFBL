

document.addEventListener("DOMContentLoaded", function() {
    const readMoreButton = document.querySelector('.readmore');
    const extraContent = document.querySelector('.extra-content');

    readMoreButton.addEventListener('click', function() {
        extraContent.classList.toggle('show');
        toggleButtonText();
    });

    const toggleButtonText = () => {
        if (extraContent.classList.contains('show')) {
            readMoreButton.textContent = 'Shrink Up';
        } else {
            readMoreButton.textContent = 'Read More';
        }
    };

    toggleButtonText(); // Set initial button text

    const shrinkButton = document.createElement('button');
    shrinkButton.textContent = 'Shrink Up';
    shrinkButton.classList.add('shrink-btn');
    document.querySelector('.donation-content').appendChild(shrinkButton);

    shrinkButton.addEventListener('click', function() {
        extraContent.classList.remove('show');
        toggleButtonText();
    });
});
