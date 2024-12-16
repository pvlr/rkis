document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('search');
    const plates = document.querySelectorAll('.plate');

    searchInput.addEventListener('input', function () {

        const searchQuery = this.value.toLowerCase();

        plates.forEach(plate => {

            const carName = plate.querySelector('.plate-header').textContent.toLowerCase();

            if (carName.includes(searchQuery)) {

                plate.classList.remove('hide');

            } else {

                plate.classList.add('hide');
            }
        });
    });
});

console.log('done');
