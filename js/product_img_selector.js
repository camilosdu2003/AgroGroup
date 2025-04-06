const mainImg = document.querySelector('.imagen-main');
const containerImages = document.querySelectorAll('.images_secondary');

containerImages.forEach(image =>{
    image.addEventListener('click', function(){
        const active = document.querySelector('.active');
        active.classList.remove('active')
        this.classList.add('active')
        mainImg.src = image.src
    })
})