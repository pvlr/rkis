const toggleButton = document.getElementById('toggle-button');
toggleButton.addEventListener('click', () => { overlay.classList.toggle('hidden') });


const closeButton = document.getElementById('close-button');
closeButton.addEventListener('click', () => { overlay.classList.add('hidden') });


const overlay = document.getElementById('overlay');
overlay.addEventListener('click', ( event ) => {

    if ( event.target.classList[0] == 'overlay' ) {

        overlay.classList.add('hidden')
    }
});


document.getElementById('file-input').addEventListener('change', function () {
    
    const fileName = this.files[0] ? this.files[0].name : 'No file selected';
    document.querySelector('.file-name').textContent = fileName;
});



document.getElementById('brand').addEventListener('input', (event) => {

    event.target.value = event.target.value.toUpperCase();
});

document.getElementById('model').addEventListener('input', (event) => {

    event.target.value = event.target.value.toUpperCase();
});

document.getElementById('color').addEventListener('input', (event) => {

    event.target.value = event.target.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
});
