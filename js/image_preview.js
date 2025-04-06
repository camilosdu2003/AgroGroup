const defaultFile = '../img/defaultImg.png'
const input = document.getElementById('inputImg');

const img0 = document.getElementById('containerImg0');
const img1 = document.getElementById('containerImg1');
const img2 = document.getElementById('containerImg2');
const img3 = document.getElementById('containerImg3');

input.addEventListener('change', e =>{

    if(e.target.files[0]){
        const reader = new FileReader();
        reader.onload = function(e){
            img0.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0])
    }else{
        img0.src= defaultFile;
    };

    if(e.target.files[1]){
        const reader = new FileReader();
        reader.onload = function(e){
            img1.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[1])
    }else{
        img1.src= defaultFile;
    };

    if(e.target.files[2]){
        const reader = new FileReader();
        reader.onload = function(e){
            img2.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[2])
    }else{
        img2.src= defaultFile;
    };

    if(e.target.files[3]){
        const reader = new FileReader();
        reader.onload = function(e){
            img3.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[3])
    }else{
        img3.src= defaultFile;
    };


});