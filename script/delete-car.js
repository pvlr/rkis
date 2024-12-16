document.querySelectorAll('.plate').forEach((plate) => {

    plate.addEventListener('click', () => {

        document.querySelectorAll('.plate-overlay').forEach((overlay) => {

            if ( overlay !== plate.querySelector('.plate-overlay') ) {

                overlay.classList.add('hidden');
            }
        });

        const overlay = plate.querySelector('.plate-overlay');
        overlay.classList.toggle('hidden');
    });


    const btnNo = plate.querySelector('.btn-no');
    if ( btnNo ) {

        btnNo.addEventListener('click', (event) => {

            event.stopPropagation();
            plate.querySelector('.plate-overlay').classList.add('hidden');
        });
    }

    plate.querySelector('.btn-yes').addEventListener('click', () => {

        const plateId = plate.querySelector('.value').innerHTML;
        const plateImage = plate.querySelector('.plate-image').getAttribute('src');

        fetch('vendor/delete-car.php', {

            method: 'DELETE',
            headers: {
                'Content-Type': 'text/plain'
            },
            body: JSON.stringify({
                id: plateId,
                image: plateImage
            })
        })

        .then(response => response.json())
        .then(data => {

            if ( data.success ) {

                console.log('Запись успешно удалена');
                window.location.reload();

            } else {

                console.error('Ошибка удаления:', data.error);
            }
        })

        .catch(error => console.error('Ошибка запроса:', error));
    })
});
